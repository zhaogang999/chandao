<?php
/**
 * Send mail
 *
 * @param  int    $storyID
 * @param  int    $actionID
 * @access public
 * @return void
 */
public function sendmail($storyID, $actionID)
{
    $this->loadModel('mail');
    $story       = $this->getById($storyID);
    $storyDetail       = $this->dao->select('*')->from(TABLE_STORY)->where('id')->eq($storyID)->fetch();
    //var_dump($storyDetail);die;
    $productName = $this->loadModel('product')->getById($story->product)->name;
    $users       = $this->loadModel('user')->getPairs('noletter');

    /* Get actions. */
    $action  = $this->loadModel('action')->getById($actionID);
    $history = $this->action->getHistory($actionID);
    $action->history    = isset($history[$actionID]) ? $history[$actionID] : array();
    $action->appendLink = '';
    if(strpos($action->extra, ':')!== false)
    {
        list($extra, $id) = explode(':', $action->extra);
        $action->extra    = $extra;
        if($id)
        {
            $name  = $this->dao->select('title')->from(TABLE_STORY)->where('id')->eq($id)->fetch('title');
            if($name) $action->appendLink = html::a(zget($this->config->mail, 'domain', common::getSysURL()) . helper::createLink($action->objectType, 'view', "id=$id"), "#$id " . $name);
        }
    }

    /* Get mail content. */
    $modulePath = $this->app->getModulePath($appName = '', 'story');
    $oldcwd     = getcwd();
    $viewFile   = $modulePath . 'view/sendmail.html.php';
    chdir($modulePath . 'view');
    if(file_exists($modulePath . 'ext/view/sendmail.html.php'))
    {
        $viewFile = $modulePath . 'ext/view/sendmail.html.php';
        chdir($modulePath . 'ext/view');
    }
    ob_start();
    include $viewFile;
    foreach(glob($modulePath . 'ext/view/sendmail.*.html.hook.php') as $hookFile) include $hookFile;
    $mailContent = ob_get_contents();
    ob_end_clean();
    chdir($oldcwd);

    /* Set toList and ccList. */

    $toList = $storyDetail->assignedTo;
    $ccList = str_replace(' ', '', trim($storyDetail->mailto, ','));

    //2284 需求发生任何变动，需要触发邮件（含编辑，备注，变更等所有操作）并且收件人不光含抄送人，还需包含需求原始提出人
    $ccList = $ccList . ',' . $storyDetail->openedBy;

    /* If the action is changed or reviewed, mail to the project team. */
    if(strtolower($action->action) == 'changed' or strtolower($action->action) == 'reviewed')
    {
        $prjMembers = $this->getProjectMembers($storyID);
        if($prjMembers)
        {
            $ccList .= ',' . join(',', $prjMembers);
            $ccList = ltrim($ccList, ',');
        }
    }

    if(empty($toList))
    {
        if(empty($ccList)) return;
        if(strpos($ccList, ',') === false)
        {
            $toList = $ccList;
            $ccList = '';
        }
        else
        {
            $commaPos = strpos($ccList, ',');
            $toList   = substr($ccList, 0, $commaPos);
            $ccList   = substr($ccList, $commaPos + 1);
        }
    }
    elseif($toList == 'closed')
    {
        $toList = $storyDetail->openedBy;
    }

    /* Send it. */
    $this->mail->send($toList, 'STORY #' . $storyDetail->id . ' ' . $storyDetail->title . ' - ' . $productName, $mailContent, $ccList);
    if($this->mail->isError()) trigger_error(join("\n", $this->mail->getError()));
}
