DROP TABLE `zt_relationoftasks`;
DELETE FROM `zt_grouppriv` WHERE `module` = 'project' AND `method` = 'gantt';
DELETE FROM `zt_grouppriv` WHERE `module` = 'project' AND `method` = 'relation';

DELETE FROM `zt_grouppriv` WHERE `group` = 1 AND `module` = 'project' AND `method` = 'deleterelation';
