<?php
/**
 * Created by PhpStorm.
 * User: 月下亭中人
 * Date: 2017/11/14
 * Time: 15:10
 */
/**
 * Get contact list of a user.
 *
 * @param  string    $account
 * @param  string    $params   withempty|withnote
 * @access public
 * @return object
 */
public function getContactLists($account, $params= '')
{
    if(strpos($params, 'withnote')  !== false)
    {
        //2601 管理员创建的通讯组可以共享给系统内的其他成员（管理员+admin）
        $contacts = $this->dao->select('id, listName')->from(TABLE_USERCONTACT)->where('account')->in("$account,admin")->fetchPairs();
    }
    else
    {
        $contacts = $this->dao->select('id, listName')->from(TABLE_USERCONTACT)->where('account')->eq($account)->fetchPairs();
    }


    if(!$contacts) return array();

    if(strpos($params, 'withempty') !== false) $contacts = array('' => '') + $contacts;
    if(strpos($params, 'withnote')  !== false) $contacts = array('' => $this->lang->user->contacts->common) + $contacts;

    return $contacts;
}