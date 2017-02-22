<?php
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
    