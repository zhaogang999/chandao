<?php
include '../../control.php';
/**
 * Created by PhpStorm.
 * User: 月下亭中人
 * Date: 2017/12/21
 * Time: 16:08
 */
class myCustom extends custom
{
    /**
     * Custom
     *
     * @param  string $module
     * @param  string $field
     * @param  string $lang
     * @access public
     * @return void
     */
    public function set($module = 'story', $field = 'priList', $lang = 'zh_cn')
    {
        if($module == 'patchbuild' and $field == 'priList') $field = 'workSeasonList';//2944 补丁版中的目标环境的值域做成后台可自定义配置项
        if($module == 'user' and $field == 'priList') $field = 'roleList';
        if($module == 'block' and $field == 'priList') $field = 'closed';
        $currentLang = $this->app->getClientLang();

        $this->app->loadLang($module);
        $fieldList = zget($this->lang->$module, $field, '');

        if($module == 'bug' and $field == 'typeList')
        {
            unset($fieldList['designchange']);
            unset($fieldList['newfeature']);
            unset($fieldList['trackthings']);
        }
        if(($module == 'story' or $module == 'testcase') and $field == 'review')
        {
            $this->app->loadConfig($module);
            $this->view->users = $this->loadModel('user')->getPairs('noclosed|nodeleted');
            $this->view->needReview      = zget($this->config->$module, 'needReview', 1);
            $this->view->forceReview     = zget($this->config->$module, 'forceReview', '');
            $this->view->forceNotReview  = zget($this->config->$module, 'forceNotReview', '');
        }
        if($module == 'task' and $field == 'hours')
        {
            $this->app->loadConfig('project');
            $this->view->weekend   = $this->config->project->weekend;
            $this->view->workhours = $this->config->project->defaultWorkhours;
        }
        if($module == 'bug' and $field == 'longlife')
        {
            $this->app->loadConfig('bug');
            $this->view->longlife  = $this->config->bug->longlife;
        }
        if($module == 'block' and $field == 'closed')
        {
            $this->loadModel('block');
            $closedBlock = isset($this->config->block->closed) ? $this->config->block->closed : '';

            $this->view->blockPairs  = $this->block->getClosedBlockPairs($closedBlock);
            $this->view->closedBlock = $closedBlock;
        }
        if($module == 'user' and $field == 'deleted')
        {
            $this->loadModel('user');
            $this->view->showDeleted = isset($this->config->user->showDeleted) ? $this->config->user->showDeleted : '0';
        }

        if(strtolower($_SERVER['REQUEST_METHOD']) == "post")
        {
            if(($module == 'story' or $module == 'testcase') and $field == 'review')
            {
                $review = fixer::input('post')->get();
                if($review->needReview) $data = fixer::input('post')->join('forceNotReview', ',')->remove('forceReview')->get();
                if(!$review->needReview) $data = fixer::input('post')->join('forceReview', ',')->remove('forceNotReview')->get();
                $this->loadModel('setting')->setItems("system.$module", $data);
            }
            elseif($module == 'task' and $field == 'hours')
            {
                $this->loadModel('setting')->setItems('system.project', fixer::input('post')->get());
            }
            elseif($module == 'bug' and $field == 'longlife')
            {
                $this->loadModel('setting')->setItems('system.bug', fixer::input('post')->get());
            }
            elseif($module == 'block' and $field == 'closed')
            {
                $data = fixer::input('post')->join('closed', ',')->get();
                $this->loadModel('setting')->setItem('system.block.closed', zget($data, 'closed', ''));
            }
            elseif($module == 'user' and $field == 'deleted')
            {
                $data = fixer::input('post')->get();
                $this->loadModel('setting')->setItem('system.user.showDeleted', $data->showDeleted);
            }
            else
            {
                $lang = $_POST['lang'];
                $this->custom->deleteItems("lang=$lang&module=$module&section=$field");
                foreach($_POST['keys'] as $index => $key)
                {
                    $value  = $_POST['values'][$index];
                    $system = $_POST['systems'][$index];

                    //if(!$system and (!$value or !$key)) continue; //Fix bug #951.

                    /* Fix bug #942. */
                    if($field == 'priList' and !is_numeric($key)) die(js::alert($this->lang->custom->notice->priListKey));
                    if($module == 'bug' and $field == 'severityList' and !is_numeric($key)) die(js::alert($this->lang->custom->notice->severityListKey));
                    if(!empty($key) and $key != 'n/a' and !validater::checkREG($key, '/^[a-zA-Z_0-9]+$/')) die(js::alert($this->lang->custom->notice->keyList));

                    /* the length of role is 20, check it when save. */
                    if($module == 'user' and $field == 'roleList' and strlen($key) > 20) die(js::alert($this->lang->custom->notice->userRole));

                    $this->custom->setItem("{$lang}.{$module}.{$field}.{$key}.{$system}", $value);
                }
            }
            if(dao::isError()) die(js::error(dao::getError()));
            die(js::locate($this->createLink('custom', 'set', "module=$module&field=$field&lang=" . str_replace('-', '_', $lang)), 'parent'));
        }

        /* Check whether the current language has been customized. */
        $lang = str_replace('_', '-', $lang);
        $dbFields = $this->custom->getItems("lang=$lang&module=$module&section=$field");
        if(empty($dbFields)) $dbFields = $this->custom->getItems("lang=" . ($lang == $currentLang ? 'all' : $currentLang) . "&module=$module&section=$field");
        if($dbFields)
        {
            $dbField = reset($dbFields);
            if($lang != $dbField->lang)
            {
                $lang = str_replace('-', "_", $dbField->lang);
                foreach($fieldList as $key => $value)
                {
                    if(isset($dbFields[$key]) and $value != $dbFields[$key]->value) $fieldList[$key] = $dbFields[$key]->value;
                }
            }
        }

        $this->view->title       = $this->lang->custom->common . $this->lang->colon . $this->lang->$module->common;
        $this->view->position[]  = $this->lang->custom->common;
        $this->view->position[]  = $this->lang->$module->common;
        $this->view->fieldList   = $fieldList;
        $this->view->dbFields    = $dbFields;
        $this->view->field       = $field;
        $this->view->lang2Set     = str_replace('_', '-', $lang);
        $this->view->module      = $module;
        $this->view->currentLang = $currentLang;
        $this->view->canAdd      = strpos($this->config->custom->canAdd[$module], $field) !== false;

        $this->display();
    }
}