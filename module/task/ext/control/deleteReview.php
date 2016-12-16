<?php
include '../../control.php';
class myTask extends task
{
    public function deleteReview($reviewDetailID)
    {

        $emptyReviewDetail = '';

        $emptyReviewDetail->number = '';
        $emptyReviewDetail->reviewer = '';
        $emptyReviewDetail->item = '';
        $emptyReviewDetail->line = '';
        $emptyReviewDetail->severity = '';
        $emptyReviewDetail->description = '';
        $emptyReviewDetail->proposal = '';
        $emptyReviewDetail->changed = '';
        $emptyReviewDetail->action = '';
        $emptyReviewDetail->chkd = '';

        $reviewDetail = $this->dao->select('*')->from(TABLE_REVIEWDETAIL)->where('id')->eq($reviewDetailID)->andWhere('deleted')->eq('0')->fetch();
        //$this->dao->delete()->from(TABLE_REVIEWDETAIL)->where('id')->eq($reviewDetailID)->exec();
        $this->dao->update(TABLE_REVIEWDETAIL)
            ->set('deleted')->eq('1')
            ->where('id')->eq($reviewDetailID)
            ->exec();
        if (!dao::isError())
        {
            $changes = common::createChanges($reviewDetail, $emptyReviewDetail);
            $taskID = $this->dao->select('task')->from(TABLE_REVIEW)->where('id')->eq($reviewDetail->reviewID)->fetch();

            $this->commonAction($taskID->task);
            $actionID = $this->action->create('task', $taskID->task, 'Edited');
            if(!empty($changes)) $this->action->logHistory($actionID, $changes);
<<<<<<< HEAD
            $this->task->sendmail($taskID, $actionID);
=======
            $this->sendmail($taskID, $actionID);
>>>>>>> 56ce38b3ee68171c3a03a5f43eb2e61413da34c5
            return 1;
        }
    }
}