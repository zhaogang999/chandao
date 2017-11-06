<?php
/**
 * Created by PhpStorm.
 * User: 月下亭中人
 * Date: 2017/11/1
 * Time: 17:17
 */

/**
 * Undelete a record.
 *
 * @param  int      $actionID
 * @access public
 * @return void
 */
public function undelete($actionID)
{
    $action = $this->getById($actionID);
    if($action->action != 'deleted') return;
    if($action->objectType == 'product')
    {
        $product = $this->dao->select('name,code')->from(TABLE_PRODUCT)->where('id')->eq($action->objectID)->fetch();
        $count   = $this->dao->select('COUNT(*) AS count')->from(TABLE_PRODUCT)->where('deleted')->eq('0')->andWhere("(`name`='{$product->name}' OR `code`='{$product->code}')")->fetch('count');
        if($count > 0)
        {
            echo js::alert(sprintf($this->lang->action->needEdit, $this->lang->action->objectTypes['product']));
            die(js::locate(helper::createLink('product', 'edit', "productID=$action->objectID&action=undelete&extra=$actionID"), 'parent'));
        }
    }
    elseif($action->objectType == 'project')
    {
        $project = $this->dao->select('name,code')->from(TABLE_PROJECT)->where('id')->eq($action->objectID)->fetch();
        $count   = $this->dao->select('COUNT(*) AS count')->from(TABLE_PROJECT)->where('deleted')->eq('0')->andWhere("(`name`='{$project->name}' OR `code`='{$project->code}')")->fetch('count');
        if($count > 0)
        {
            echo js::alert(sprintf($this->lang->action->needEdit, $this->lang->action->objectTypes['project']));
            die(js::locate(helper::createLink('project', 'edit', "projectID=$action->objectID&action=undelete&extra=$actionID"), 'parent'));
        }
    }

    /* Update deleted field in object table. */
    $table = $this->config->objectTables[$action->objectType];
    $this->dao->update($table)->set('deleted')->eq(0)->where('id')->eq($action->objectID)->exec();

    if ($action->objectType == 'task')
    {
        $script = $this->dao->select('*')->from(TABLE_SCRIPT)->where('task')->eq($action->objectID)->andWhere('deleted')->eq('1')->fetch();
        if ($script)
        {
            $this->dao->update(TABLE_SCRIPT)->set('deleted')->eq(0)->where('id')->eq($script->id)->exec();
        }
    }

    /* Revert doclib when undelet product or project. */
    if($action->objectType == 'project' or $action->objectType == 'product')
    {
        $this->dao->update(TABLE_DOCLIB)->set('deleted')->eq(0)->where($action->objectType)->eq($action->objectID)->exec();
    }

    /* Update action record in action table. */
    $this->dao->update(TABLE_ACTION)->set('extra')->eq(ACTIONMODEL::BE_UNDELETED)->where('id')->eq($actionID)->exec();
    $this->create($action->objectType, $action->objectID, 'undeleted');
}