<?php
class excelTestcase extends testcaseModel
{
    public function setListValue($productID, $branch = 0)
    {
        $product   = $this->loadModel('product')->getByID($productID);
        $modules   = $this->loadModel('tree')->getOptionMenu($productID, 'case', 0, $branch);
        $stories   = $this->loadModel('story')->getProductStories($productID, $branch);
        $typeList  = $this->lang->testcase->typeList;
        $priList   = $this->lang->testcase->priList;
        $stageList = $this->lang->testcase->stageList;
        $statusList = $this->lang->testcase->statusList;

        unset($typeList['']);
        unset($stageList['']);
        foreach($modules as $id => $module) $modules[$id] .= "(#$id)";
        foreach($stories as $id => $story)  $stories[$id]  = "$story->title(#$story->id)";

        $this->post->set('moduleList', array_values($modules));
        $this->post->set('storyList',  $stories);
        $this->post->set('typeList',   join(',', $typeList));
        $this->post->set('priList',    join(',', $priList));
        $this->post->set('stageList',  join(',', $stageList));
        $this->post->set('statusList', join(',', $statusList));
        $this->post->set('listStyle',  $this->config->testcase->export->listFields);
        $this->post->set('extraNum',   0);
        $this->post->set('product',    $product->name);
    }

    public function createFromImport($productID, $branch)
    {
        $this->loadModel('action');
        $this->loadModel('story');
        $this->loadModel('file');
        $now    = helper::now();
        $branch = (int)$branch;
        $data   = fixer::input('post')->get();

        if(!empty($_POST['id']))
        {
            $oldSteps = $this->dao->select('t2.*')->from(TABLE_CASE)->alias('t1')
                ->leftJoin(TABLE_CASESTEP)->alias('t2')->on('t1.id = t2.case')
                ->where('t1.id')->in(($_POST['id']))
                ->andWhere('t1.product')->eq($productID)
                ->andWhere('t1.version=t2.version')
                ->orderBy('t2.id')
                ->fetchGroup('case');
            $oldCases = $this->dao->select('*')->from(TABLE_CASE)->where('id')->in($_POST['id'])->fetchAll('id');
        }

        foreach($data->product as $key => $product)
        {
            dao::getError();
            $caseData = new stdclass();

            $caseData->product      = $product;
            $caseData->module       = $data->module[$key];
            $caseData->story        = (int)$data->story[$key];
            $caseData->title        = $data->title[$key];
            $caseData->pri          = (int)$data->pri[$key];
            $caseData->type         = $data->type[$key];
            $caseData->status       = $data->status[$key];
            $caseData->stage        = join(',', $data->stage[$key]);
            $caseData->frequency    = 1;
            //解决bug，post没传该值
            //$caseData->linkCase    = $data->linkCase[$key];
            $caseData->keywords     = $data->keywords[$key];
            $caseData->precondition = $data->precondition[$key];

            if(isset($this->config->testcase->create->requiredFields))
            {
                $requiredFields = explode(',', $this->config->testcase->create->requiredFields);
                $invalid = false;
                foreach($requiredFields as $requiredField)
                {
                    $requiredField = trim($requiredField);
                    if(empty($caseData->$requiredField)) $invalid = true;
                }
                if($invalid) continue;
            }

            $caseID = 0;
            if(!empty($_POST['id'][$key]) and empty($_POST['insert']))
            {
                $caseID = $data->id[$key];
                if(!isset($oldCases[$caseID])) $caseID = 0;
            }

            if($caseID)
            {
                $stepChanged = false;
                $steps       = array();
                $oldStep     = isset($oldSteps[$caseID]) ? $oldSteps[$caseID] : array();
                $oldCase     = $oldCases[$caseID];

                /* Remove the empty setps in post. */
                $steps = array();
                if(isset($_POST['desc'][$key]))
                {
                    foreach($data->desc[$key] as $id => $desc)
                    {
                        $desc = trim($desc);
                        if(empty($desc))continue;
                        $step = new stdclass();
                        $step->desc   = $desc;
                        $step->expect = trim($data->expect[$key][$id]);

                        $steps[] = $step;
                    }
                }

                /* If step count changed, case changed. */
                if((!$oldStep != !$steps) or (count($oldStep) != count($steps)))
                {
                    $stepChanged = true;
                }
                else
                {
                    /* Compare every step. */
                    foreach($oldStep as $id => $oldStep)
                    {
                        if(trim($oldStep->desc) != trim($steps[$id]->desc) or trim($oldStep->expect) != $steps[$id]->expect)
                        {
                            $stepChanged = true;
                            break;
                        }
                    }
                }

                $version           = $stepChanged ? $oldCase->version + 1 : $oldCase->version;
                $caseData->version = $version;
                $changes           = common::createChanges($oldCase, $caseData); 
                if(!$changes and !$stepChanged) continue;

                if($changes or $stepChanged)
                {
                    $caseData->lastEditedBy   = $this->app->user->account;
                    $caseData->lastEditedDate = $now;
                    $this->dao->update(TABLE_CASE)->data($caseData)->where('id')->eq($caseID)->autoCheck()->exec();
                    if($stepChanged)
                    {
                        foreach($steps as $id => $step)
                        {
                            $step = (array)$step;
                            if(empty($step['desc'])) continue;
                            $stepData = new stdclass();
                            $stepData->case    = $caseID;
                            $stepData->version = $version;
                            $stepData->desc    = $step['desc'];
                            $stepData->expect  = $step['expect'];
                            $this->dao->insert(TABLE_CASESTEP)->data($stepData)->autoCheck()->exec();
                        }
                    }
                    $oldCase->steps  = $this->joinStep($oldStep);
                    $caseData->steps = $this->joinStep($steps);
                    $changes = common::createChanges($oldCase, $caseData);
                    $actionID = $this->action->create('case', $caseID, 'Edited');
                    $this->action->logHistory($actionID, $changes);
                }
            }
            else
            {
                $caseData->version    = 1;
                $caseData->openedBy   = $this->app->user->account;
                $caseData->openedDate = $now;
                $caseData->branch     = $branch;
                $this->dao->insert(TABLE_CASE)->data($caseData)->autoCheck()->exec();

                if(!dao::isError())
                {
                    $caseID = $this->dao->lastInsertID();
                    foreach($data->desc[$key] as $id => $desc)
                    {
                        $desc = trim($desc);
                        if(empty($desc)) continue;
                        $stepData = new stdclass();
                        $stepData->case    = $caseID;
                        $stepData->version = 1;
                        $stepData->desc    = $desc;
                        $stepData->expect  = $data->expect[$key][$id];
                        $this->dao->insert(TABLE_CASESTEP)->data($stepData)->autoCheck()->exec();
                    }
                    $this->action->create('case', $caseID, 'Opened');
                }
            }
        }

        unlink($this->session->importFile);
        unset($_SESSION['importFile']);
    }
}
