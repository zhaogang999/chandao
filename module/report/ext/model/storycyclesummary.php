<?php
/**
 * get info of storyCycleSummary
 *
 * @param $project
 * @access public
 * @return array
*/
public function storyCycleSummary($project)
{
    $data =array();

    $this->loadModel('story');
    $this->loadModel('project');

    $stories = $this->story->getProjectStories($project,'id_desc');
    $projectInfo = $this->project->getByID($project);

    foreach ($stories as $storyID =>$story)
    {
        $tasks = $this->dao->select('id, name,type, status, estimate, consumed, assignedTo, estStarted, deadline, realStarted, finishedDate')
            ->from(TABLE_TASK)
            ->where('story')->eq((int)$storyID)
            ->andWhere('deleted')->eq(0)
            ->andWhere('parent')->eq(0)
            ->andWhere('project')->eq($project)
            ->fetchAll('id');

        $data[$storyID] = new stdClass();
        $data[$storyID]-> title = $story->title;
        $data[$storyID]->	estimate = 0;//预计消耗
        $data[$storyID]->	consumed = 0;//实际消耗
        $data[$storyID]->	developEstimate = 0; //开发预计
        $data[$storyID]->	testEstimate = 0; //测试预计
        $data[$storyID]->	developConsumed = 0; //开发消耗
        $data[$storyID]->	testConsumed = 0; //测试消耗

        foreach ($tasks as $task)
        {
            if ($task->deadline == '0000-00-00') $task->deadline = $projectInfo->end;
            if ($task->estimate == '0000-00-00') $task->estimate = $projectInfo->begin;
//var_dump($task);die;
            switch ($task->type)
            {
                case 'test':
                    $data[$storyID]->	estimate += $task->estimate;
                    $data[$storyID]->	consumed += $task->consumed;
                    if (!empty($task->assignedTo))
                    {
                        $data[$storyID]->	testEstimate += ceil((strtotime($task->deadline) - strtotime($task->estStarted))/60/60/24) + 1;
                    }
                    if ($task->status == 'done' || $task->status == 'closed')
                    {
                        $data[$storyID]->	testConsumed += ceil((strtotime($task->finishedDate) - strtotime($task->realStarted))/60/60/24) + 1;
                    }
                    break;
                case 'devel' || 'fos' || 'ios' || 'android' || 'sdk' || 'web':
                    $data[$storyID]->	estimate += $task->estimate;
                    $data[$storyID]->	consumed += $task->consumed;
                    if (!empty($task->assignedTo))
                    {
                        $data[$storyID]->	developEstimate += ceil((strtotime($task->deadline) - strtotime($task->estStarted))/60/60/24) + 1;
                    }
                    if ($task->status == 'done' || $task->status == 'closed')
                    {
                        $data[$storyID]->	developConsumed += ceil((strtotime($task->finishedDate) - strtotime($task->realStarted))/60/60/24) + 1;
                    }
                    break;
                default:
                    $data[$storyID]->	estimate += $task->estimate;
                    $data[$storyID]->	consumed += $task->consumed;
            }
        }
    }
    
    return $data;
}