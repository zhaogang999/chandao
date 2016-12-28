<?php
include '../../control.php';
class myTask extends task
{
    public function deleteAudit($auditID)
    {
        $emptyAuditDetail = '';

        $emptyAuditDetail->auditID = '';
        $emptyAuditDetail->noDec = '';
        $emptyAuditDetail->noType = '';
        $emptyAuditDetail->serious = '';
        $emptyAuditDetail->cause = '';
        $emptyAuditDetail->measures = '';

        $auditDetail = $this->dao->select('*')->from(TABLE_QAAUDIT)->where('id')->eq($auditID)->andWhere('deleted')->eq('0')->fetch();
        //$this->dao->delete()->from(TABLE_REVIEWDETAIL)->where('id')->eq($reviewDetailID)->exec();
        $this->dao->update(TABLE_QAAUDIT)
            ->set('deleted')->eq('1')
            ->where('id')->eq($auditID)
            ->exec();
        if (!dao::isError())
        {
            $changes = common::createChanges($auditDetail, $emptyAuditDetail);
            $taskID = $this->dao->select('task')->from(TABLE_QAAUDIT)->where('id')->eq($auditID)->fetch();

            $this->commonAction($taskID->task);
            $actionID = $this->action->create('task', $taskID->task, 'Edited');
            if(!empty($changes)) $this->action->logHistory($actionID, $changes);
            $this->task->sendmail($taskID, $actionID);
            return 1;
        }
    }
}