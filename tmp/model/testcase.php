<?php
global $app;
helper::cd($app->getBasePath());
helper::import('module\testcase\model.php');
helper::cd();
class exttestcaseModel extends testcaseModel 
{
/**
 * Build search form.
 *
 * @param  int    $productID
 * @param  array  $products
 * @param  int    $queryID
 * @param  string $actionURL
 * @access public
 * @return void
 */
public function buildSearchForm($productID, $products, $queryID, $actionURL)
{
    $this->config->testcase->search['params']['product']['values'] = array($productID => $products[$productID], 'all' => $this->lang->testcase->allProduct);
    //优化搜索功能搜索条件增加空选项
    $this->config->testcase->search['params']['module']['values']  = array('' => '') + $this->loadModel('tree')->getOptionMenu($productID, $viewType = 'case');
    //新增相关需求
    $this->config->testcase->search['params']['story']['values']= $this->loadModel('story')->getProductStoryPairs($productID);

    if($this->session->currentProductType == 'normal')
    {
        unset($this->config->testcase->search['fields']['branch']);
        unset($this->config->testcase->search['params']['branch']);
    }
    else
    {
        $this->config->testcase->search['fields']['branch'] = $this->lang->product->branch;
        $this->config->testcase->search['params']['branch']['values'] = array('' => '') + $this->loadModel('branch')->getPairs($productID, 'noempty') + array('all' => $this->lang->branch->all);
    }
    if(!$this->config->testcase->needReview) unset($this->config->testcase->search['params']['status']['values']['wait']);
    $this->config->testcase->search['actionURL'] = $actionURL;
    $this->config->testcase->search['queryID']   = $queryID;

    $this->loadModel('search')->setSearchParams($this->config->testcase->search);
}/**
 * Create a case.
 *
 * @param int $bugID
 * @access public
 * @return void
 */
function create($bugID)
{
    $now  = helper::now();
    $case = fixer::input('post')
        ->add('openedBy', $this->app->user->account)
        ->add('openedDate', $now)
        ->add('status', $this->forceReview() ? 'wait' : 'normal')
        ->add('version', 1)
        ->add('fromBug', $bugID)
        ->setIF($this->post->story != false, 'storyVersion', $this->loadModel('story')->getVersion((int)$this->post->story))
        ->remove('steps,expects,files,labels,stepType')
        ->setDefault('story', 0)
        ->join('stage', ',')
        ->get();

    $param = '';
    if(!empty($case->lib))$param = "lib={$case->lib}";
    if(!empty($case->product))$param = "product={$case->product}";
    $result = $this->loadModel('common')->removeDuplicate('case', $case, $param);
    if($result['stop']) return array('status' => 'exists', 'id' => $result['duplicate']);

    /* value of story may be showmore. */
    $case->story = (int)$case->story;
    $this->dao->insert(TABLE_CASE)->data($case)->autoCheck()->batchCheck($this->config->testcase->create->requiredFields, 'notempty')->exec();
    if(!$this->dao->isError())
    {
        $caseID = $this->dao->lastInsertID();
        $this->loadModel('file')->saveUpload('testcase', $caseID);
        $parentStepID = 0;
        foreach($this->post->steps as $stepID => $stepDesc)
        {
            if(empty($stepDesc)) continue;
            $stepType      = $this->post->stepType;
            $step          = new stdClass();
            $step->type    = ($stepType[$stepID] == 'item' and $parentStepID == 0) ? 'step' : $stepType[$stepID];
            $step->parent  = ($step->type == 'item') ? $parentStepID : 0;
            $step->case    = $caseID;
            $step->version = 1;
            $step->desc    = htmlspecialchars($stepDesc);
            //不转义特殊字符
            //$step->expect  = htmlspecialchars($this->post->expects[$stepID]);
            $step->expect  = $this->post->expects[$stepID];

            $this->dao->insert(TABLE_CASESTEP)->data($step)->autoCheck()->exec();
            if($step->type == 'group') $parentStepID = $this->dao->lastInsertID();
            if($step->type == 'step')  $parentStepID = 0;
        }
        return array('status' => 'created', 'id' => $caseID);
    }
}public function setListValue($productID, $branch = 0)
{
    return $this->loadExtension('excel')->setListValue($productID, $branch);
}

public function createFromImport($productID, $branch = 0)
{
    return $this->loadExtension('excel')->createFromImport($productID, $branch);
}/**
 * Update a case.
 *
 * @param  int    $caseID
 * @access public
 * @return void
 */
public function update($caseID)
{
    $oldCase     = $this->getById($caseID);
    if(isset($_POST['lastEditedDate']) and $oldCase->lastEditedDate != $this->post->lastEditedDate)
    {
        dao::$errors[] = $this->lang->error->editedByOther;
        return false;
    }

    $now         = helper::now();
    $stepChanged = false;
    $steps       = array();

    //---------------- Judge steps changed or not.-------------------- */

    /* Remove the empty setps in post. */
    foreach($this->post->steps as $key => $desc)
    {
        $desc = trim($desc);
        if(!empty($desc)) $steps[] = array('desc' => $desc, 'expect' => trim($this->post->expects[$key]));
    }

    /* If step count changed, case changed. */
    if(count($oldCase->steps) != count($steps))
    {
        $stepChanged = true;
    }
    else
    {
        /* Compare every step. */
        foreach($oldCase->steps as $key => $oldStep)
        {
            if(trim($oldStep->desc) != trim($steps[$key]['desc']) or trim($oldStep->expect) != $steps[$key]['expect'])
            {
                $stepChanged = true;
                break;
            }
        }
    }
    $version = $stepChanged ? $oldCase->version + 1 : $oldCase->version;

    $case = fixer::input('post')
        ->add('lastEditedBy', $this->app->user->account)
        ->add('lastEditedDate', $now)
        ->add('version', $version)
        ->setIF($this->post->story != false and $this->post->story != $oldCase->story, 'storyVersion', $this->loadModel('story')->getVersion($this->post->story))
        ->setDefault('story,branch', 0)
        ->join('stage', ',')
        ->remove('comment,steps,expects,files,labels,stepType')
        ->get();
    if($this->forceReview() and $stepChanged) $case->status = 'wait';
    $this->dao->update(TABLE_CASE)->data($case)->autoCheck()->batchCheck($this->config->testcase->edit->requiredFields, 'notempty')->where('id')->eq((int)$caseID)->exec();
    if(!$this->dao->isError())
    {
        if($stepChanged)
        {
            $parentStepID = 0;
            foreach($this->post->steps as $stepID => $stepDesc)
            {
                if(empty($stepDesc)) continue;
                $stepType = $this->post->stepType;
                $step = new stdclass();
                $step->type    = ($stepType[$stepID] == 'item' and $parentStepID == 0) ? 'step' : $stepType[$stepID];
                $step->parent  = ($step->type == 'item') ? $parentStepID : 0;
                $step->case    = $caseID;
                $step->version = $version;
                $step->desc    = htmlspecialchars($stepDesc);
                //不转义特殊字符
                //$step->expect  = htmlspecialchars($this->post->expects[$stepID]);
                $step->expect  = $this->post->expects[$stepID];

                $this->dao->insert(TABLE_CASESTEP)->data($step)->autoCheck()->exec();
                if($step->type == 'group') $parentStepID = $this->dao->lastInsertID();
                if($step->type == 'step')  $parentStepID = 0;
            }
        }

        /* Join the steps to diff. */
        if($stepChanged)
        {
            $oldCase->steps = $this->joinStep($oldCase->steps);
            $case->steps    = $this->joinStep($this->getById($caseID, $version)->steps);
        }
        else
        {
            unset($oldCase->steps);
        }
        return common::createChanges($oldCase, $case);
    }
}
//**//
}