<?php
/**
 * Print changes of every action.
 *
 * @param  string    $objectType
 * @param  array     $histories
 * @access public
 * @return void
 */
public function printChanges($objectType, $histories)
{
    if(empty($histories)) return;

    $maxLength            = 0;          // The max length of fields names.
    $historiesWithDiff    = array();    // To save histories without diff info.
    $historiesWithoutDiff = array();    // To save histories with diff info.

    /* Diff histories by hasing diff info or not. Thus we can to make sure the field with diff show at last. */
    foreach($histories as $history)
    {
        $fieldName = $history->field;

        //2291 需求或任务修改记录中的值请显示前台调用的值，不要显示后台的ID号
        if ($fieldName == 'plan' || $fieldName == 'customPlan')
        {
            if ($history->old != '' && $history->old != 0)
            {
                $oldHistory = $this->loadModel('productplan')->getByID($history->old);
                $history->old = '#' . $history->old . ' ' . $oldHistory->title;
            }
            if ($history->new != '' && $history->new != 0)
            {
                $newHistory = $this->loadModel('productplan')->getByID($history->new);
                $history->new = '#' . $history->new . ' ' . $newHistory->title;
            }
        }
        if ($fieldName == 'module')
        {
            if ($history->new != 0)
            {
                $newHistory = $this->loadModel('tree')->getByID($history->new);
                $history->new = '#' . $history->new . ' ' . $newHistory->name;
           }
           if ($history->old != 0)
           {
               $oldHistory = $this->loadModel('tree')->getByID($history->old);
               $history->old = '#' . $history->old . ' ' . $oldHistory->name;
           }
        }

        $history->fieldLabel = (isset($this->lang->$objectType) && isset($this->lang->$objectType->$fieldName)) ? $this->lang->$objectType->$fieldName : $fieldName;
        if(($length = strlen($history->fieldLabel)) > $maxLength) $maxLength = $length;
        $history->diff ? $historiesWithDiff[] = $history : $historiesWithoutDiff[] = $history;
    }
    $histories = array_merge($historiesWithoutDiff, $historiesWithDiff);

    foreach($histories as $history)
    {
        $history->fieldLabel = str_pad($history->fieldLabel, $maxLength, $this->lang->action->label->space);
        if($history->diff != '')
        {
            $history->diff      = str_replace(array('<ins>', '</ins>', '<del>', '</del>'), array('[ins]', '[/ins]', '[del]', '[/del]'), $history->diff);
            $history->diff      = ($history->field != 'subversion' and $history->field != 'git') ? htmlspecialchars($history->diff) : $history->diff;   // Keep the diff link.
            $history->diff      = str_replace(array('[ins]', '[/ins]', '[del]', '[/del]'), array('<ins>', '</ins>', '<del>', '</del>'), $history->diff);
            $history->diff      = nl2br($history->diff);
            $history->noTagDiff = preg_replace('/&lt;\/?([a-z][a-z0-9]*)[^\/]*\/?&gt;/Ui', '', $history->diff);
            printf($this->lang->action->desc->diff2, $history->fieldLabel, $history->noTagDiff, $history->diff);
        }
        else
        {
            printf($this->lang->action->desc->diff1, $history->fieldLabel, $history->old, $history->new);
        }
    }
}