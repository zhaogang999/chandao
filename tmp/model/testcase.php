<?php
helper::import('F:\zentao\chandao\module\testcase\model.php');
class exttestcaseModel extends testcaseModel 
{
/**
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
        ->add('status', 'normal')
        ->add('version', 1)
        ->add('fromBug', $bugID)
        ->setIF($this->post->story != false, 'storyVersion', $this->loadModel('story')->getVersion((int)$this->post->story))
        ->remove('steps,expects,files,labels')
        ->setDefault('story', 0)
        ->join('stage', ',')
        ->get();

    $result = $this->loadModel('common')->removeDuplicate('case', $case, "product={$case->product}");
    if($result['stop']) return array('status' => 'exists', 'id' => $result['duplicate']);

    /* value of story may be showmore. */
    $case->story = (int)$case->story;
    $this->dao->insert(TABLE_CASE)->data($case)->autoCheck()->batchCheck($this->config->testcase->create->requiredFields, 'notempty')->exec();
    if(!$this->dao->isError())
    {
        $caseID = $this->dao->lastInsertID();
        $this->loadModel('file')->saveUpload('testcase', $caseID);
        foreach($this->post->steps as $stepID => $stepDesc)
        {
            if(empty($stepDesc)) continue;
            $step          = new stdClass();
            $step->case    = $caseID;
            $step->version = 1;
            $step->desc    = htmlspecialchars($stepDesc);
            //不转义特殊字符
            //$step->expect  = htmlspecialchars($this->post->expects[$stepID]);
            $step->expect  = $this->post->expects[$stepID];

            $this->dao->insert(TABLE_CASESTEP)->data($step)->autoCheck()->exec();
        }
        return array('status' => 'created', 'id' => $caseID);
    }
}
public function setListValue($productID, $branch = 0)
{
    return $this->loadExtension('excel')->setListValue($productID, $branch);
}

public function createFromImport($productID, $branch = 0)
{
    return $this->loadExtension('excel')->createFromImport($productID, $branch);
}
/**
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
        ->setDefault('story', 0)
        ->join('stage', ',')
        ->remove('comment,steps,expects,files,labels')
        ->get();
    $this->dao->update(TABLE_CASE)->data($case)->autoCheck()->batchCheck($this->config->testcase->edit->requiredFields, 'notempty')->where('id')->eq((int)$caseID)->exec();
    if(!$this->dao->isError())
    {
        if($stepChanged)
        {
            foreach($this->post->steps as $stepID => $stepDesc)
            {
                if(empty($stepDesc)) continue;
                $step = new stdclass();
                $step->case    = $caseID;
                $step->version = $version;
                $step->desc    = htmlspecialchars($stepDesc);
                //不转义特殊字符
                //$step->expect  = htmlspecialchars($this->post->expects[$stepID]);
                $step->expect  = $this->post->expects[$stepID];

                $this->dao->insert(TABLE_CASESTEP)->data($step)->autoCheck()->exec();
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