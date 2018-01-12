<?php
/**
 * Created by PhpStorm.
 * User: 月下亭中人
 * Date: 2018/1/12
 * Time: 10:07
 */
include '../../control.php';
class myTask extends  task
{
    /**
     * Batch create task.
     *
     * @param int $projectID
     * @param int $storyID
     * @param int $iframe
     * @param int $taskID
     *
     * @access public
     * @return void
     */
    public function batchCreate($projectID = 0, $storyID = 0, $iframe = 0, $taskID = 0)
    {
        $project   = $this->project->getById($projectID);
        $taskLink  = $this->createLink('project', 'browse', "projectID=$projectID&tab=task");
        $storyLink = $this->session->storyList ? $this->session->storyList : $this->createLink('project', 'story', "projectID=$projectID");

        /* Set menu. */
        $this->project->setMenu($this->project->getPairs(), $project->id);

        if(!empty($_POST))
        {
            $mails = $this->task->batchCreate($projectID);
            if(dao::isError()) die(js::error(dao::getError()));

            foreach($mails as $mail) $this->task->sendmail($mail->taskID, $mail->actionID);

            /* Locate the browser. */
            if($iframe) die(js::reload('parent.parent'));
            die(js::locate($storyLink, 'parent'));
        }

        /* Set Custom*/
        foreach(explode(',', $this->config->task->customBatchCreateFields) as $field) $customFields[$field] = $this->lang->task->$field;
        $this->view->customFields = $customFields;
        $this->view->showFields   = $this->config->task->custom->batchCreateFields;

        $stories = $this->story->getProjectStoryPairs($projectID, 0, 0, 0, 'short');
        $members = $this->project->getTeamMemberPairs($projectID, 'nodeleted');
        $modules = $this->loadModel('tree')->getTaskOptionMenu($projectID);
        $title      = $project->name . $this->lang->colon . $this->lang->task->batchCreate;
        $position[] = html::a($taskLink, $project->name);
        $position[] = $this->lang->task->common;
        $position[] = $this->lang->task->batchCreate;

        //创建子任务时子任务优先级继承父任务
        if ($taskID != 0)
        {
            $this->view->parentTask = $this->task->getByID($taskID);
        }
        $this->view->title      = $title;
        $this->view->position   = $position;
        $this->view->project    = $project;
        $this->view->stories    = $stories;
        $this->view->modules    = $modules;
        $this->view->parent     = $taskID;
        $this->view->storyID    = $storyID;
        $this->view->story      = $this->story->getByID($storyID);
        $this->view->storyTasks = $this->task->getStoryTaskCounts(array_keys($stories), $projectID);
        $this->view->members    = $members;
        $this->display();
    }
}