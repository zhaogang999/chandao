<?php
global $app;
helper::cd($app->getBasePath());
helper::import('module\search\model.php');
helper::cd();
class extsearchModel extends searchModel 
{
/**
 * Build the query to execute.
 *
 * @access public
 * @return void
 */
public function buildQuery()
{
    /* Init vars. */
    $where      = '';
    $groupItems = $this->config->search->groupItems;
    $groupAndOr = strtoupper($this->post->groupAndOr);
    if($groupAndOr != 'AND' and $groupAndOr != 'OR') $groupAndOr = 'AND';
    $scoreNum = 0;
    for($i = 1; $i <= $groupItems * 2; $i ++)
    {
        /* The and or between two groups. */
        if($i == 1) $where .= '(( 1  ';
        if($i == $groupItems + 1) $where .= " ) $groupAndOr ( 1 ";

        /* Set var names. */
        $fieldName    = "field$i";
        $andOrName    = "andOr$i";
        $operatorName = "operator$i";
        $valueName    = "value$i";

        /* Skip empty values. */
        if($this->post->$fieldName == 'activatedCount' and $this->post->$valueName == '0') $this->post->$valueName = 'ZERO';
        if($this->post->$valueName == false) continue;
        if($this->post->$valueName == 'null') $this->post->$valueName = '';  // Null is special, stands to empty.
        if($this->post->$valueName == 'ZERO') $this->post->$valueName = 0;   // ZERO is special, stands to 0.

        $scoreNum += 1;

        /* Set and or. */
        $andOr = strtoupper($this->post->$andOrName);
        if($andOr != 'AND' and $andOr != 'OR') $andOr = 'AND';

        /* Set operator. */
        $value    = $this->post->$valueName;
        $operator = $this->post->$operatorName;
        if(!isset($this->lang->search->operators[$operator])) $operator = '=';

        /* Set condition. */
        $condition = '';
        if($operator == "include")
        {
            $condition = ' LIKE ' . $this->dbh->quote("%$value%");
        }
        elseif($operator == "notinclude")
        {
            $condition = ' NOT LIKE ' . $this->dbh->quote("%$value%");
        }
        elseif($operator == 'belong')
        {
            if($this->post->$fieldName == 'module')
            {
                $allModules = $this->loadModel('tree')->getAllChildId($value);
                if($allModules) $condition = helper::dbIN($allModules);
            }
            elseif($this->post->$fieldName == 'dept')
            {
                $allDepts = $this->loadModel('dept')->getAllChildId($value);
                $condition = helper::dbIN($allDepts);
            }
            else
            {
                //4120 产品发布时，版本关联需求可实现按指定需求ID搜索并关联到该版本上
                //$condition = ' = ' . $this->dbh->quote($value) . ' ';
                $condition = helper::dbIN($value);
            }
        }
        else
        {
            $condition = $operator . ' ' . $this->dbh->quote($value) . ' ';
        }

        /* Set filed name. */
        if($operator == '=' and preg_match('/^[0-9]{4}-[0-9]{1,2}-[0-9]{1,2}$/', $value))
        {
            $condition  = '`' . $this->post->$fieldName . "` >= '$value' AND `" . $this->post->$fieldName . "` <= '$value 23:59:59'";
            $where     .= " $andOr ($condition)";
        }
        elseif($condition)
        {
            $where .= " $andOr " . '`' . $this->post->$fieldName . '` ' . $condition;
        }
    }

    $where .=" ))";
    $where  = $this->replaceDynamic($where);

    /* Save to session. */
    $querySessionName = $this->post->module . 'Query';
    $formSessionName  = $this->post->module . 'Form';
    $this->session->set($querySessionName, $where);
    $this->session->set($formSessionName,  $_POST);
    if($scoreNum > 2 && !dao::isError()) $this->loadModel('score')->create('search', 'saveQueryAdvanced');
}
//**//
}