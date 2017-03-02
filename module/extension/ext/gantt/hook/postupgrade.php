<?php
if((strpos($extension, 'gantt') !== false and version_compare($this->post->installedVersion, '2.2', '<=')) or (strpos($extension, 'bizext') !== false and version_compare($this->post->installedVersion, '5.0.1', '<=')))
{
        $extensionPath = $this->app->getModulePath('', 'extension') . 'ext' . DS . $extension . DS . 'db' . DS . 'update5.0.1.sql';
        $this->loadModel('upgrade')->execSQL($extensionPath);
}
if((strpos($extension, 'gantt') !== false and version_compare($this->post->installedVersion, '1.5', '<=')) or (strpos($extension, 'bizext') !== false and version_compare($this->post->installedVersion, '2.1', '<=')))
{
    if(!isset($execedSql['2.1']))
    {
        $extensionPath = $this->app->getModulePath('', 'extension') . 'ext' . DS . $extension . DS . 'db' . DS . 'update2.1.sql';
        $this->loadModel('upgrade')->execSQL($extensionPath);
        $execedSql['2.1'] = true;
    }
}

if(version_compare($this->config->version, '3.1', '<='))
{
    $sql = "ALTER TABLE `zt_task` CHANGE `estimateStartDate` `estStarted` DATE NOT NULL , CHANGE `actualStartDate` `realStarted` DATE NOT NULL";
    $sql = str_replace('zt_', $this->config->db->prefix, $sql);
    try
    {
        $this->dbh->exec($sql);
    }
    catch (PDOException $e) 
    {
    }
}

if((strpos($extension, 'gantt') !== false and version_compare($this->post->installedVersion, '1.8', '<=')) or (strpos($extension, 'bizext') !== false and version_compare($this->post->installedVersion, '3.3', '<=')))
{
    $results    = $this->dbh->query("show Variables like '%table_names'")->fetchAll();
    $hasLowered = false;
    foreach($results as $result)
    {
        if(strtolower($result->Variable_name) == 'lower_case_table_names' and $result->Value == 1)
        {
            $hasLowered = true;
            break;
        }
    }

    if(!$hasLowered)
    {
        $tablesExists = $this->dbh->query('SHOW TABLES')->fetchAll();
        foreach($tablesExists as $key => $table) $tablesExists[$key] = current((array)$table);
        $tablesExists = array_flip($tablesExists);

        $oldTable = $this->config->db->prefix . 'relationOfTasks';
        $newTable = $this->config->db->prefix . 'relationoftasks';

        if(isset($tablesExists[$oldTable])) 
        {
            $upgradebak = $newTable . '_othertablebak';
            if(isset($tablesExists[$upgradebak])) $this->dbh->query("DROP TABLE `$upgradebak`");
            if(isset($tablesExists[$newTable])) $this->dbh->query("RENAME TABLE `$newTable` TO `$upgradebak`");

            $tempTable = $oldTable . '_zentaotmp';
            $this->dbh->query("RENAME TABLE `$oldTable` TO `$tempTable`");
            $this->dbh->query("RENAME TABLE `$tempTable` TO `$newTable`");
        }
    }
}
