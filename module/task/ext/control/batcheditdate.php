<?php
include '../../control.php';
/**
 * Created by PhpStorm.
 * User: 月下亭中人
 * Date: 2018/04/16
 * Time: 15:53
 */
class myTask extends task
{
    /**
     * 4218批量编辑截止日期
     *
     * @param $field
     * @param $changeDate
     */
    public function batchEditDate($field, $changeDate)
    {
        $task = new stdClass();

        $field = $field == 'deadline' ? 'deadline' : '';
        $task->lastEditedDate = helper::now();
        $task->lastEditedBy     = $this->app->user->account;
        $changeDate = $changeDate/1000-8*60*60;
        $task->$field = date('Y-m-d', $changeDate);

        $taskIDList = $this->post->taskIDList ? $this->post->taskIDList : die(js::locate($this->session->taskList, 'parent'));
        //var_dump($_POST);die;
        $taskIDList = implode(',', array_values(array_unique($taskIDList)));
        $oldTasksInfo = $this->dao->select('*')->from(TABLE_TASK)->where('id')->in($taskIDList)->fetchPairs('id', $field);
        //var_dump($taskIDList,$oldTasksInfo);die;

        $this->dao->update(TABLE_TASK)->data($task)->autoCheck()->where('id')->in("$taskIDList")->exec();
        if (!dao::isError())
        {
            $tasks = explode(',', $taskIDList);
            foreach ($tasks as $taskID)
            {
                $changes = array();
                $changes[] = array('field' => $field, 'old' => $oldTasksInfo[$taskID], 'new' => $task->$field);
                $action   = 'Edited';
                $actionID = $this->loadModel('action')->create('task', $taskID, $action);
                $this->action->logHistory($actionID, $changes);
                $this->task->sendmail($taskID, $actionID);
            }
            
            die(js::locate($this->session->taskList, 'parent'));
        }
    }
}