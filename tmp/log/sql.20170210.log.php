<?php
 die();
?>
20170210 14:54:28: 
  SELECT * FROM `zt_company` ORDER BY `id`  LIMIT 1 
  SELECT * FROM `zt_config` WHERE owner IN ('system','') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20170210 14:54:28: 
  SELECT * FROM `zt_company` ORDER BY `id`  LIMIT 1 
  SELECT * FROM `zt_config` WHERE owner IN ('system','') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20170210 14:54:28: /upgrade.php
  SELECT * FROM `zt_config` WHERE owner IN ('system','') ORDER BY `id` 

20170210 14:55:00: /upgrade.php
  SELECT * FROM `zt_config` WHERE owner IN ('system','') ORDER BY `id` 

20170210 14:55:00: /upgrade.php?m=upgrade&f=backup
  SELECT * FROM `zt_config` WHERE owner IN ('system','') ORDER BY `id` 

20170210 14:55:02: /upgrade.php?m=upgrade&f=checkExtension
  SELECT * FROM `zt_config` WHERE owner IN ('system','') ORDER BY `id` 
  SELECT * FROM `zt_extension` WHERE status  = 'installed'

20170210 14:55:03: /upgrade.php?m=upgrade&f=selectVersion
  SELECT * FROM `zt_config` WHERE owner IN ('system','') ORDER BY `id` 

20170210 14:55:08: /upgrade.php?m=upgrade&f=confirm
  SELECT * FROM `zt_config` WHERE owner IN ('system','') ORDER BY `id` 

20170210 14:55:10: /upgrade.php?m=upgrade&f=execute
  SELECT * FROM `zt_config` WHERE owner IN ('system','') ORDER BY `id` 
  SELECT `group` FROM `zt_grouppriv` WHERE module  = 'testtask' AND  method  = 'results'
  REPLACE `zt_grouppriv` SET `group` = '1',`module` = 'testcase',`method` = 'bugs'
  REPLACE `zt_grouppriv` SET `group` = '2',`module` = 'testcase',`method` = 'bugs'
  REPLACE `zt_grouppriv` SET `group` = '3',`module` = 'testcase',`method` = 'bugs'
  REPLACE `zt_grouppriv` SET `group` = '5',`module` = 'testcase',`method` = 'bugs'
  REPLACE `zt_grouppriv` SET `group` = '6',`module` = 'testcase',`method` = 'bugs'
  REPLACE `zt_grouppriv` SET `group` = '7',`module` = 'testcase',`method` = 'bugs'
  REPLACE `zt_grouppriv` SET `group` = '8',`module` = 'testcase',`method` = 'bugs'
  REPLACE `zt_grouppriv` SET `group` = '9',`module` = 'testcase',`method` = 'bugs'
  REPLACE `zt_grouppriv` SET `group` = '11',`module` = 'testcase',`method` = 'bugs'
  SELECT `group` FROM `zt_grouppriv` WHERE module  = 'mail' AND  method  = 'delete'
  REPLACE `zt_grouppriv` SET `group` = '1',`module` = 'mail',`method` = 'resend'
  DELETE FROM `zt_extension` WHERE type  = 'patch'
  DELETE FROM `zt_extension` WHERE code IN ('zentaopatch','patch')

20170210 14:55:10: /upgrade.php?m=upgrade&f=afterExec&fromVersion=8_4
  SELECT * FROM `zt_config` WHERE owner IN ('system','') ORDER BY `id` 
  REPLACE `zt_config` SET `owner` = 'system',`module` = 'common',`section` = 'global',`key` = 'version',`value` = '9.0'

20170210 14:55:12: 
  SELECT * FROM `zt_config` WHERE owner IN ('system','') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20170210 14:55:13: user-login-Lw==
  SELECT * FROM `zt_config` WHERE owner IN ('system','') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT account, realname, deleted FROM `zt_user` WHERE deleted  = '0' ORDER BY `account` 

20170210 14:55:19: user-login-Lw==
  SELECT * FROM `zt_config` WHERE owner IN ('system','') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT locked FROM `zt_user` WHERE account  = 'admin'
  SELECT * FROM `zt_user` WHERE account  = 'admin' AND  deleted  = '0'
  UPDATE `zt_user` SET  visits = visits + 1, `ip` = '127.0.0.1', `last` = '1486709718' WHERE account  = 'admin'
  UPDATE `zt_user` SET  `fails` = '0', `locked` = '0000-00-00 00:00:00' WHERE account  = 'admin'
  SELECT t1.acl FROM `zt_group` AS t1  LEFT JOIN `zt_usergroup` AS t2  ON t1.id=t2.group  WHERE t2.account  = 'admin'
  SELECT module, method FROM `zt_usergroup` AS t1  LEFT JOIN `zt_grouppriv` AS t2  ON t1.group = t2.group  WHERE t1.account  = 'admin'
  SELECT `group` FROM `zt_usergroup` WHERE `account` = 'admin' 
  INSERT INTO `zt_action` SET `objectType` = 'user',`objectID` = '1',`actor` = 'admin',`action` = 'login',`date` = '2017-02-10 14:55:18',`comment` = '',`extra` = '',`product` = ',0,',`project` = '0'

20170210 14:55:19: 
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20170210 14:55:19: my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE account  = 'admin' AND  module  = 'my' AND  hidden  = '0' ORDER BY `order` 

20170210 14:55:19: block-printBlock-5-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '5'
  SELECT * FROM `zt_product` WHERE deleted  = '0' AND  status  != 'closed' ORDER BY `order` desc 
  SELECT * FROM `zt_product` WHERE id IN ('7','6','2','1') ORDER BY `order` desc 
  SELECT COUNT(*) AS recTotal FROM `zt_product` WHERE id IN ('7','6','2','1') 
  SELECT * FROM `zt_product` WHERE id IN ('7','6','2','1') ORDER BY `order` desc 
  SELECT product, status, count(status) AS count FROM `zt_story` WHERE deleted  = '0' AND  product IN ('7','6','2','1') GROUP BY product, status
  SELECT product, count(*) AS count FROM `zt_productplan` WHERE deleted  = '0' AND  product IN ('7','6','2','1') AND  end  > '2017-02-10 14:55:19' GROUP BY product
  SELECT product, count(*) AS count FROM `zt_release` WHERE deleted  = '0' AND  product IN ('7','6','2','1') GROUP BY product
  SELECT product,count(*) AS conut FROM `zt_bug` WHERE deleted  = '0' AND  product IN ('7','6','2','1') GROUP BY product
  SELECT product,count(*) AS count FROM `zt_bug` WHERE status  = 'active' AND  deleted  = '0' AND  product IN ('7','6','2','1') GROUP BY product
  SELECT product,count(*) AS count FROM `zt_bug` WHERE AssignedTo  = '' AND  deleted  = '0' AND  product IN ('7','6','2','1') GROUP BY product

20170210 14:55:19: block-printBlock-3-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '3'
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  status  != 'done' AND  deleted  = '0' ORDER BY `order` desc 
  SELECT * FROM `zt_project` WHERE id IN ('12','11','10','9','3','2') ORDER BY `order` desc 
  SELECT COUNT(*) AS recTotal FROM `zt_project` WHERE id IN ('12','11','10','9','3','2') 
  SELECT * FROM `zt_project` WHERE id IN ('12','11','10','9','3','2') ORDER BY `order` desc 
  SELECT id, project, estimate, consumed, `left`, status, closedReason FROM `zt_task` WHERE project IN ('12','11','10','9','3','2') AND  deleted  = '0'
  SELECT project, date AS name, `left` AS value FROM `zt_burn` WHERE project IN ('12','11','10','9','3','2') ORDER BY `date` desc 

20170210 14:55:19: block-printBlock-1-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '1'

20170210 14:55:20: block-printBlock-6-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '6'
  SELECT t1.*, t2.id as projectID, t2.name as projectName, t3.id as storyID, t3.title as storyTitle, t3.status AS storyStatus, t3.version AS latestStoryVersion FROM `zt_task` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project = t2.id  LEFT JOIN `zt_story` AS t3  ON t1.story = t3.id  WHERE t1.deleted  = '0' AND  t1.assignedTo  = 'admin' ORDER BY `id` desc  LIMIT 15 
  SELECT t1.*, t2.id as projectID, t2.name as projectName, t3.id as storyID, t3.title as storyTitle, t3.status AS storyStatus, t3.version AS latestStoryVersion FROM `zt_task` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project = t2.id  LEFT JOIN `zt_story` AS t3  ON t1.story = t3.id  WHERE t1.deleted  = '0' AND  t1.assignedTo  = 'admin' ORDER BY `id` desc  LIMIT 15 

20170210 14:55:20: block-printBlock-2-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '2'
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT * FROM `zt_action` WHERE 1  AND  date  > '2017-02-10' AND  date  < '2017-02-11' AND  (1)  ORDER BY `date` desc 
  SELECT commiter, account, realname FROM `zt_user` WHERE commiter  != ''
  SELECT id, account AS name FROM `zt_user` WHERE id IN ('1')
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 

20170210 14:55:20: block-printBlock-4-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '4'
  SELECT * FROM `zt_todo` WHERE account  = 'admin' AND  date  >= '1970-01-01' AND  date  <= '2109-01-01' AND  status IN ('wait','doing') ORDER BY `date`,`status`,`begin`  LIMIT 20 
  SELECT * FROM `zt_todo` WHERE account  = 'admin' AND  date  >= '1970-01-01' AND  date  <= '2109-01-01' AND  status IN ('wait','doing') ORDER BY `date`,`status`,`begin`  LIMIT 20 

20170210 14:55:20: block-printBlock-7-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '7'
  SELECT * FROM `zt_bug` WHERE deleted  = '0' AND  assignedTo  = 'admin' ORDER BY `id` desc  LIMIT 15 

20170210 14:55:20: block-printBlock-8-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '8'
  SELECT t1.*, t2.name as productTitle FROM `zt_story` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.deleted  = '0' AND  assignedTo  = 'admin' ORDER BY `id` desc 
  SELECT COUNT(*) AS recTotal FROM `zt_story` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.deleted  = '0' AND  assignedTo  = 'admin' 
  SELECT t1.*, t2.name as productTitle FROM `zt_story` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.deleted  = '0' AND  assignedTo  = 'admin' ORDER BY `id` desc 
  SELECT t1.*, t2.name as productTitle FROM `zt_story` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.deleted  = '0' AND  assignedTo  = 'admin' ORDER BY `id` desc 
  SELECT t1.*, t2.name as productTitle FROM `zt_story` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.deleted  = '0' AND  assignedTo  = 'admin' ORDER BY `id` desc 
  SELECT id,title FROM `zt_productplan` WHERE product IN ('6','1') AND  deleted  = '0'
  SELECT * FROM `zt_storystage` WHERE branch IN ('0')

20170210 14:55:20: block-printBlock-9-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '9'
  SELECT t1.assignedTo AS assignedTo, t2.* FROM `zt_testrun` AS t1  LEFT JOIN `zt_case` AS t2  ON t1.case = t2.id  LEFT JOIN `zt_testtask` AS t3  ON t1.task = t3.id  WHERE t1.assignedTo  = 'admin' AND  t1.status  != 'done' AND  t3.status  != 'done' AND  t3.deleted  = '0' AND  t2.deleted  = '0' ORDER BY `id` desc  LIMIT 15 

20170210 14:55:29: admin
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20170210 14:55:31: project
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 

20170210 14:55:31: project-task
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT * FROM `zt_project` WHERE `id` = '10' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '10' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '10'
  SELECT t2.id, t2.name, t2.type, t1.branch FROM `zt_projectproduct` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.project  = '10'
  SELECT id, name FROM `zt_project` WHERE parent  = '10'
  SELECT t1.*, t1.hours * t1.days AS totalHours, if(t2.deleted='0', t2.realname, t1.account) as realname FROM `zt_team` AS t1  LEFT JOIN `zt_user` AS t2  ON t1.account = t2.account  WHERE t1.project  = '10'
  SELECT commiter, account, realname FROM `zt_user` WHERE commiter  != ''
  SELECT * FROM `zt_action` WHERE objectType IN('project', 'testtask', 'build')  AND  project  = '10' ORDER BY `date`,`id` 
  SELECT * FROM `zt_history` WHERE action IN ('1240','1250','1252','1257','1260','1379','1510','1534','1535','1536','1537','1538') ORDER BY `id` 
  SELECT name FROM `zt_build` WHERE id  = '4'
  SELECT name FROM `zt_testtask` WHERE id  = '6'
  SELECT name FROM `zt_testtask` WHERE id  = '8'
  SELECT name FROM `zt_testtask` WHERE id  = '9'
  SELECT * FROM `zt_project` WHERE `id` = '10' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '10' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '10'
  SELECT * FROM `zt_project` WHERE `id` = '10' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '10' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '10'
  SELECT t1.product, t2.name FROM `zt_projectproduct` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.project  = '10'
  SELECT t1.*, t2.id AS storyID, t2.title AS storyTitle, t2.product, t2.branch, t2.version AS latestStoryVersion, t2.status AS storyStatus, t3.realname AS assignedToRealName FROM `zt_task` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_user` AS t3  ON t1.assignedTo = t3.account  WHERE t1.project  = '10' AND  t1.deleted  = '0' AND  t1.status IN ('','wait','doing','done','pause','cancel') ORDER BY `status`,`id` desc 
  SELECT COUNT(*) AS recTotal FROM `zt_task` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_user` AS t3  ON t1.assignedTo = t3.account  WHERE t1.project  = '10' AND  t1.deleted  = '0' AND  t1.status IN ('','wait','doing','done','pause','cancel') 
  SELECT t1.*, t2.id AS storyID, t2.title AS storyTitle, t2.product, t2.branch, t2.version AS latestStoryVersion, t2.status AS storyStatus, t3.realname AS assignedToRealName FROM `zt_task` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_user` AS t3  ON t1.assignedTo = t3.account  WHERE t1.project  = '10' AND  t1.deleted  = '0' AND  t1.status IN ('','wait','doing','done','pause','cancel') ORDER BY `status`,`id` desc 
  SELECT t1.*, t2.id AS storyID, t2.title AS storyTitle, t2.product, t2.branch, t2.version AS latestStoryVersion, t2.status AS storyStatus, t3.realname AS assignedToRealName FROM `zt_task` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_user` AS t3  ON t1.assignedTo = t3.account  WHERE t1.project  = '10' AND  t1.deleted  = '0' AND  t1.status IN ('','wait','doing','done','pause','cancel') ORDER BY `status`,`id` desc 
  SELECT * FROM `zt_product` WHERE `id` = '6' 
  SELECT * FROM `zt_product` WHERE `id` = '6' 
  SELECT * FROM `zt_product` WHERE `id` = '6' 
  SELECT * FROM `zt_product` WHERE `id` = '6' 
  SELECT * FROM `zt_product` WHERE `id` = '6' 
  SELECT * FROM `zt_product` WHERE `id` = '6' 
  SELECT * FROM `zt_product` WHERE `id` = '6' 
  SELECT * FROM `zt_product` WHERE `id` = '6' 
  SELECT * FROM `zt_product` WHERE `id` = '6' 
  SELECT * FROM `zt_product` WHERE `id` = '6' 
  SELECT * FROM `zt_product` WHERE `id` = '6' 
  SELECT * FROM `zt_product` WHERE `id` = '6' 
  SELECT * FROM `zt_product` WHERE `id` = '6' 
  SELECT t1.product, t2.name FROM `zt_projectproduct` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.project  = '10'
  SELECT * FROM `zt_branch` WHERE product IN ('6') AND  deleted  = '0' ORDER BY `order` 
  SELECT * FROM `zt_product` WHERE id IN ('6')
  SELECT openedVersion FROM `zt_project` WHERE id  = '10'
  SELECT product,branch FROM `zt_projectproduct` WHERE project  = '10'
  SELECT id,root,branch FROM `zt_module` WHERE root IN ('6') AND  type  = 'story' AND  deleted  = '0'
  SELECT id FROM `zt_module` WHERE root  = '10' AND  type  = 'task' AND  deleted  = '0'
  SELECT DISTINCT t1.id FROM `zt_module` AS t1  LEFT JOIN `zt_task` AS t2  ON t1.id=t2.module  WHERE t2.module  != '0' AND  t2.project  = '10' AND  t2.deleted  = '0' AND  t1.type  = 'story' AND  t1.deleted  = '0'
  SELECT * FROM `zt_module` WHERE root = 10 and type = 'task' and parent = 0  AND  deleted  = '0'
  SELECT * FROM `zt_module` WHERE ((root = 10 and type = 'task') OR (root = 6 and type = 'story'))  AND  deleted  = '0' ORDER BY `grade` desc,`branch`,`type`,`order` 
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 
  SELECT t1.product, t2.name FROM `zt_projectproduct` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.project  = '10'
  SELECT * FROM `zt_branch` WHERE product IN ('6') AND  deleted  = '0' ORDER BY `order` 
  SELECT * FROM `zt_product` WHERE id IN ('6')
  SELECT openedVersion FROM `zt_project` WHERE id  = '10'
  SELECT product,branch FROM `zt_projectproduct` WHERE project  = '10'
  SELECT id,root,branch FROM `zt_module` WHERE root IN ('6') AND  type  = 'story' AND  deleted  = '0'
  SELECT id FROM `zt_module` WHERE root  = '10' AND  type  = 'task' AND  deleted  = '0'
  SELECT DISTINCT t1.id FROM `zt_module` AS t1  LEFT JOIN `zt_task` AS t2  ON t1.id=t2.module  WHERE t2.module  != '0' AND  t2.project  = '10' AND  t2.deleted  = '0' AND  t1.type  = 'story' AND  t1.deleted  = '0'
  SELECT * FROM `zt_module` WHERE root = 10 and type = 'task' and parent = 0  AND  deleted  = '0'
  SELECT * FROM `zt_module` WHERE ((root = 10 and type = 'task') OR (root = 6 and type = 'story'))  AND  deleted  = '0' ORDER BY `grade` desc,`branch`,`type`,`order` 
  SELECT t1.product, t2.name FROM `zt_projectproduct` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.project  = '10'
  SELECT * FROM `zt_branch` WHERE product IN ('6') AND  deleted  = '0' ORDER BY `order` 
  SELECT * FROM `zt_product` WHERE id IN ('6')
  SELECT openedVersion FROM `zt_project` WHERE id  = '10'
  SELECT DISTINCT t3.path FROM `zt_projectstory` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_module` AS t3  ON t2.module = t3.id  WHERE t1.project  = '10' AND  t3.deleted  = '0'
  SELECT path FROM `zt_module` WHERE root  = '10' AND  type  = 'task' AND  deleted  = '0'
  SELECT DISTINCT t1.path FROM `zt_module` AS t1  LEFT JOIN `zt_task` AS t2  ON t1.id=t2.module  WHERE t2.module  != '0' AND  t2.project  = '10' AND  t2.deleted  = '0' AND  t1.type  = 'story' AND  t1.deleted  = '0'
  SELECT * FROM `zt_module` WHERE ((root = 10 and type = 'task' and parent != 0) OR (root = 6 and type = 'story' and branch ='0'))  AND  deleted  = '0' ORDER BY `grade` desc,`type`,`order` 
  SELECT * FROM `zt_module` WHERE root = 10 and type = 'task'  AND  deleted  = '0' ORDER BY `grade` desc,`type`,`order` 
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 
  SELECT t1.id, t1.name,t1.status, t2.product FROM `zt_project` AS t1  LEFT JOIN `zt_projectproduct` AS t2  ON t1.id = t2.project  WHERE t1.deleted  = '0'
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `order` desc 
  SELECT * FROM `zt_branch` WHERE product IN ('6') AND  deleted  = '0' ORDER BY `order` 
  SELECT * FROM `zt_product` WHERE id IN ('6')

20170210 14:55:34: project-story-10
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT * FROM `zt_project` WHERE `id` = '10' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '10' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '10'
  SELECT t2.id, t2.name, t2.type, t1.branch FROM `zt_projectproduct` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.project  = '10'
  SELECT id, name FROM `zt_project` WHERE parent  = '10'
  SELECT t1.*, t1.hours * t1.days AS totalHours, if(t2.deleted='0', t2.realname, t1.account) as realname FROM `zt_team` AS t1  LEFT JOIN `zt_user` AS t2  ON t1.account = t2.account  WHERE t1.project  = '10'
  SELECT commiter, account, realname FROM `zt_user` WHERE commiter  != ''
  SELECT * FROM `zt_action` WHERE objectType IN('project', 'testtask', 'build')  AND  project  = '10' ORDER BY `date`,`id` 
  SELECT * FROM `zt_history` WHERE action IN ('1240','1250','1252','1257','1260','1379','1510','1534','1535','1536','1537','1538') ORDER BY `id` 
  SELECT name FROM `zt_build` WHERE id  = '4'
  SELECT name FROM `zt_testtask` WHERE id  = '6'
  SELECT name FROM `zt_testtask` WHERE id  = '8'
  SELECT name FROM `zt_testtask` WHERE id  = '9'
  SELECT * FROM `zt_project` WHERE `id` = '10' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '10' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '10'
  SELECT * FROM `zt_project` WHERE `id` = '10' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '10' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '10'
  SELECT distinct t1.*, t2.*,t3.branch as productBranch,t4.type as productType,t2.version as version FROM `zt_projectstory` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_projectproduct` AS t3  ON t1.project = t3.project  LEFT JOIN `zt_product` AS t4  ON t2.product = t4.id  WHERE t1.project  = '10' AND  t2.deleted  = '0' ORDER BY `pri`,`id` asc 
  SELECT COUNT(distinct t2.id) AS recTotal FROM `zt_projectstory` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_projectproduct` AS t3  ON t1.project = t3.project  LEFT JOIN `zt_product` AS t4  ON t2.product = t4.id  WHERE t1.project  = '10' AND  t2.deleted  = '0' 
  SELECT distinct t1.*, t2.*,t3.branch as productBranch,t4.type as productType,t2.version as version FROM `zt_projectstory` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_projectproduct` AS t3  ON t1.project = t3.project  LEFT JOIN `zt_product` AS t4  ON t2.product = t4.id  WHERE t1.project  = '10' AND  t2.deleted  = '0' ORDER BY `pri`,`id` asc 
  SELECT distinct t1.*, t2.*,t3.branch as productBranch,t4.type as productType,t2.version as version FROM `zt_projectstory` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_projectproduct` AS t3  ON t1.project = t3.project  LEFT JOIN `zt_product` AS t4  ON t2.product = t4.id  WHERE t1.project  = '10' AND  t2.deleted  = '0' ORDER BY `pri`,`id` asc 
  SELECT distinct t1.*, t2.*,t3.branch as productBranch,t4.type as productType,t2.version as version FROM `zt_projectstory` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_projectproduct` AS t3  ON t1.project = t3.project  LEFT JOIN `zt_product` AS t4  ON t2.product = t4.id  WHERE t1.project  = '10' AND  t2.deleted  = '0' ORDER BY `pri`,`id` asc 
  SELECT story, COUNT(*) AS tasks FROM `zt_task` WHERE story IN ('37','38','40','41','36','39') AND  deleted  = '0' AND  project  = '10' GROUP BY story
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 
  SELECT t1.product, t2.name FROM `zt_projectproduct` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.project  = '10'
  SELECT t2.id, t2.name, t2.type, t1.branch FROM `zt_projectproduct` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.project  = '10'
  SELECT * FROM `zt_product` WHERE `id` = '6' 
  SELECT * FROM `zt_module` WHERE root  = '6' AND  type  = 'story' AND  deleted  = '0' ORDER BY `grade` desc,`order` 
  SELECT * FROM `zt_branch` WHERE product IN ('6') AND  deleted  = '0' ORDER BY `order` 
  SELECT * FROM `zt_product` WHERE id IN ('6')
  SELECT id,title FROM `zt_productplan` WHERE product IN ('6') AND  deleted  = '0' ORDER BY `begin` desc 
  SELECT product FROM `zt_projectproduct` WHERE project  = '10'
  SELECT t1.project, t2.name FROM `zt_projectproduct` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project = t2.id  WHERE t2.deleted  = '0' AND  t1.product  = '6' AND  t1.project  != '10'
  SELECT DISTINCT story FROM `zt_case` WHERE story IN ('37','38','40','41','36','39')
  SELECT DISTINCT t3.path FROM `zt_projectstory` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_module` AS t3  ON t2.module = t3.id  WHERE t1.project  = '10' AND  t3.deleted  = '0'
  SELECT path FROM `zt_module` WHERE root  = '10' AND  type  = 'task' AND  deleted  = '0'
  SELECT DISTINCT t1.path FROM `zt_module` AS t1  LEFT JOIN `zt_task` AS t2  ON t1.id=t2.module  WHERE t2.module  != '0' AND  t2.project  = '10' AND  t2.deleted  = '0' AND  t1.type  = 'story' AND  t1.deleted  = '0'
  SELECT t1.product, t2.name FROM `zt_projectproduct` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.project  = '10'
  SELECT * FROM `zt_branch` WHERE product IN ('6') AND  deleted  = '0' ORDER BY `order` 
  SELECT * FROM `zt_product` WHERE id IN ('6')
  SELECT * FROM `zt_module` WHERE (root = 6 and type = 'story')  AND  deleted  = '0' ORDER BY `grade` desc,`branch`,`type`,`order` 

20170210 14:55:34: search-buildForm
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 
  SELECT id, title FROM `zt_userquery` WHERE account  = 'admin' AND  module  = 'projectStory' ORDER BY `id` asc 

20170210 14:55:40: project-batchChangeProject-11-10
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  UPDATE `zt_projectstory` SET  `project` = '11' WHERE story  = '37' AND  project  = '10' LIMIT 1 
  UPDATE `zt_action` SET  `project` = '11', `extra` = '11' WHERE objectID  = '37' AND  project  = '10' AND  action  = 'linked2project' LIMIT 1 
  SELECT * FROM `zt_build` WHERE project  = '10' AND  deleted  = '0'
  UPDATE `zt_build` SET  `stories` = '38,36' WHERE id  = '4' AND  deleted  = '0'
  SELECT * FROM `zt_build` WHERE project  = '11' AND  deleted  = '0' AND  name  = '1.0'
  UPDATE `zt_build` SET  `stories` = ',37' WHERE id  = '10' AND  deleted  = '0'
  UPDATE `zt_task` SET  `project` = '11' WHERE story  = '37' AND  project  = '10' AND  deleted  = '0'
  SELECT * FROM `zt_task` WHERE story  = '37' AND  project  = '11' AND  deleted  = '0'
  UPDATE `zt_bug` SET  `project` = '11' WHERE story  = '37' AND  project  = '10' AND  deleted  = '0'
  SELECT * FROM `zt_case` WHERE story  = '37' AND  deleted  = '0'
  UPDATE `zt_projectstory` SET  `project` = '11' WHERE story  = '38' AND  project  = '10' LIMIT 1 
  UPDATE `zt_action` SET  `project` = '11', `extra` = '11' WHERE objectID  = '38' AND  project  = '10' AND  action  = 'linked2project' LIMIT 1 
  SELECT * FROM `zt_build` WHERE project  = '10' AND  deleted  = '0'
  UPDATE `zt_build` SET  `stories` = '36' WHERE id  = '4' AND  deleted  = '0'
  SELECT * FROM `zt_build` WHERE project  = '11' AND  deleted  = '0' AND  name  = '1.0'
  UPDATE `zt_build` SET  `stories` = ',37,38' WHERE id  = '10' AND  deleted  = '0'
  UPDATE `zt_task` SET  `project` = '11' WHERE story  = '38' AND  project  = '10' AND  deleted  = '0'
  SELECT * FROM `zt_task` WHERE story  = '38' AND  project  = '11' AND  deleted  = '0'
  UPDATE `zt_bug` SET  `project` = '11' WHERE story  = '38' AND  project  = '10' AND  deleted  = '0'
  SELECT * FROM `zt_case` WHERE story  = '38' AND  deleted  = '0'
  UPDATE `zt_projectstory` SET  `project` = '11' WHERE story  = '40' AND  project  = '10' LIMIT 1 
  UPDATE `zt_action` SET  `project` = '11', `extra` = '11' WHERE objectID  = '40' AND  project  = '10' AND  action  = 'linked2project' LIMIT 1 
  SELECT * FROM `zt_build` WHERE project  = '10' AND  deleted  = '0'
  UPDATE `zt_task` SET  `project` = '11' WHERE story  = '40' AND  project  = '10' AND  deleted  = '0'
  SELECT * FROM `zt_task` WHERE story  = '40' AND  project  = '11' AND  deleted  = '0'
  UPDATE `zt_bug` SET  `project` = '11' WHERE story  = '40' AND  project  = '10' AND  deleted  = '0'
  SELECT * FROM `zt_case` WHERE story  = '40' AND  deleted  = '0'
  UPDATE `zt_projectstory` SET  `project` = '11' WHERE story  = '41' AND  project  = '10' LIMIT 1 
  UPDATE `zt_action` SET  `project` = '11', `extra` = '11' WHERE objectID  = '41' AND  project  = '10' AND  action  = 'linked2project' LIMIT 1 
  SELECT * FROM `zt_build` WHERE project  = '10' AND  deleted  = '0'
  UPDATE `zt_task` SET  `project` = '11' WHERE story  = '41' AND  project  = '10' AND  deleted  = '0'
  SELECT * FROM `zt_task` WHERE story  = '41' AND  project  = '11' AND  deleted  = '0'
  UPDATE `zt_bug` SET  `project` = '11' WHERE story  = '41' AND  project  = '10' AND  deleted  = '0'
  SELECT * FROM `zt_case` WHERE story  = '41' AND  deleted  = '0'
  UPDATE `zt_projectstory` SET  `project` = '11' WHERE story  = '36' AND  project  = '10' LIMIT 1 
  UPDATE `zt_action` SET  `project` = '11', `extra` = '11' WHERE objectID  = '36' AND  project  = '10' AND  action  = 'linked2project' LIMIT 1 
  SELECT * FROM `zt_build` WHERE project  = '10' AND  deleted  = '0'
  UPDATE `zt_build` SET  `stories` = '' WHERE id  = '4' AND  deleted  = '0'
  SELECT * FROM `zt_build` WHERE project  = '11' AND  deleted  = '0' AND  name  = '1.0'
  UPDATE `zt_build` SET  `stories` = ',37,38,36' WHERE id  = '10' AND  deleted  = '0'
  UPDATE `zt_task` SET  `project` = '11' WHERE story  = '36' AND  project  = '10' AND  deleted  = '0'
  SELECT * FROM `zt_task` WHERE story  = '36' AND  project  = '11' AND  deleted  = '0'
  SELECT * FROM `zt_team` WHERE project  = '11' AND  account  = 'admin'
  SELECT * FROM `zt_team` WHERE project  = '11' AND  account  = 'dev1'
  SELECT * FROM `zt_team` WHERE project  = '11' AND  account  = 'productManager'
  SELECT * FROM `zt_team` WHERE project  = '11' AND  account  = 'projectManager'
  SELECT * FROM `zt_team` WHERE project  = '11' AND  account  = 'projectManager'
  SELECT * FROM `zt_team` WHERE project  = '11' AND  account  = 'testManager'
  SELECT * FROM `zt_team` WHERE project  = '11' AND  account  = 'admin'
  SELECT * FROM `zt_team` WHERE project  = '11' AND  account  = 'admin'
  SELECT * FROM `zt_team` WHERE project  = '11' AND  account  = 'admin'
  SELECT * FROM `zt_team` WHERE project  = '11' AND  account  = 'dev1'
  SELECT * FROM `zt_team` WHERE project  = '11' AND  account  = 'productManager'
  UPDATE `zt_bug` SET  `project` = '11' WHERE story  = '36' AND  project  = '10' AND  deleted  = '0'
  SELECT * FROM `zt_case` WHERE story  = '36' AND  deleted  = '0'
  SELECT t2.id, t2.name FROM `zt_testrun` AS t1  LEFT JOIN `zt_testtask` AS t2  ON t1.task = t2.id  WHERE t1.`case`  = '7' AND  t2.`project`  = '10' AND  t2.`deleted`  = '0'
  SELECT * FROM `zt_testtask` WHERE `id`  = '8' AND  deleted  = '0'
  SELECT * FROM `zt_testtask` WHERE `name`  = '测试1' AND  `project`  = '11' AND  deleted  = '0'
  UPDATE `zt_testrun` SET  `task` = '10' WHERE `case`  = '7' AND  `task`  = '8'
  SELECT * FROM `zt_testtask` WHERE `id`  = '9' AND  deleted  = '0'
  SELECT * FROM `zt_testtask` WHERE `name`  = 'bug改后测试' AND  `project`  = '11' AND  deleted  = '0'
  UPDATE `zt_testrun` SET  `task` = '11' WHERE `case`  = '7' AND  `task`  = '9'
  SELECT t2.id, t2.name FROM `zt_testrun` AS t1  LEFT JOIN `zt_testtask` AS t2  ON t1.task = t2.id  WHERE t1.`case`  = '8' AND  t2.`project`  = '10' AND  t2.`deleted`  = '0'
  SELECT * FROM `zt_testtask` WHERE `id`  = '8' AND  deleted  = '0'
  SELECT * FROM `zt_testtask` WHERE `name`  = '测试1' AND  `project`  = '11' AND  deleted  = '0'
  UPDATE `zt_testrun` SET  `task` = '10' WHERE `case`  = '8' AND  `task`  = '8'
  UPDATE `zt_projectstory` SET  `project` = '11' WHERE story  = '39' AND  project  = '10' LIMIT 1 
  UPDATE `zt_action` SET  `project` = '11', `extra` = '11' WHERE objectID  = '39' AND  project  = '10' AND  action  = 'linked2project' LIMIT 1 
  SELECT * FROM `zt_build` WHERE project  = '10' AND  deleted  = '0'
  UPDATE `zt_task` SET  `project` = '11' WHERE story  = '39' AND  project  = '10' AND  deleted  = '0'
  SELECT * FROM `zt_task` WHERE story  = '39' AND  project  = '11' AND  deleted  = '0'
  UPDATE `zt_bug` SET  `project` = '11' WHERE story  = '39' AND  project  = '10' AND  deleted  = '0'
  SELECT * FROM `zt_case` WHERE story  = '39' AND  deleted  = '0'

20170210 14:55:40: project-story-10
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT * FROM `zt_project` WHERE `id` = '10' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '10' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '10'
  SELECT t2.id, t2.name, t2.type, t1.branch FROM `zt_projectproduct` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.project  = '10'
  SELECT id, name FROM `zt_project` WHERE parent  = '10'
  SELECT t1.*, t1.hours * t1.days AS totalHours, if(t2.deleted='0', t2.realname, t1.account) as realname FROM `zt_team` AS t1  LEFT JOIN `zt_user` AS t2  ON t1.account = t2.account  WHERE t1.project  = '10'
  SELECT commiter, account, realname FROM `zt_user` WHERE commiter  != ''
  SELECT * FROM `zt_action` WHERE objectType IN('project', 'testtask', 'build')  AND  project  = '10' ORDER BY `date`,`id` 
  SELECT * FROM `zt_history` WHERE action IN ('1240','1250','1252','1257','1260','1379','1510','1534','1535','1536','1537','1538') ORDER BY `id` 
  SELECT name FROM `zt_build` WHERE id  = '4'
  SELECT name FROM `zt_testtask` WHERE id  = '6'
  SELECT name FROM `zt_testtask` WHERE id  = '8'
  SELECT name FROM `zt_testtask` WHERE id  = '9'
  SELECT * FROM `zt_project` WHERE `id` = '10' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '10' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '10'
  SELECT * FROM `zt_project` WHERE `id` = '10' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '10' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '10'
  SELECT distinct t1.*, t2.*,t3.branch as productBranch,t4.type as productType,t2.version as version FROM `zt_projectstory` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_projectproduct` AS t3  ON t1.project = t3.project  LEFT JOIN `zt_product` AS t4  ON t2.product = t4.id  WHERE t1.project  = '10' AND  t2.deleted  = '0' ORDER BY `pri`,`id` asc 
  SELECT COUNT(distinct t2.id) AS recTotal FROM `zt_projectstory` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_projectproduct` AS t3  ON t1.project = t3.project  LEFT JOIN `zt_product` AS t4  ON t2.product = t4.id  WHERE t1.project  = '10' AND  t2.deleted  = '0' 
  SELECT distinct t1.*, t2.*,t3.branch as productBranch,t4.type as productType,t2.version as version FROM `zt_projectstory` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_projectproduct` AS t3  ON t1.project = t3.project  LEFT JOIN `zt_product` AS t4  ON t2.product = t4.id  WHERE t1.project  = '10' AND  t2.deleted  = '0' ORDER BY `pri`,`id` asc 
  SELECT distinct t1.*, t2.*,t3.branch as productBranch,t4.type as productType,t2.version as version FROM `zt_projectstory` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_projectproduct` AS t3  ON t1.project = t3.project  LEFT JOIN `zt_product` AS t4  ON t2.product = t4.id  WHERE t1.project  = '10' AND  t2.deleted  = '0' ORDER BY `pri`,`id` asc 
  SELECT distinct t1.*, t2.*,t3.branch as productBranch,t4.type as productType,t2.version as version FROM `zt_projectstory` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_projectproduct` AS t3  ON t1.project = t3.project  LEFT JOIN `zt_product` AS t4  ON t2.product = t4.id  WHERE t1.project  = '10' AND  t2.deleted  = '0' ORDER BY `pri`,`id` asc 
  SELECT story, COUNT(*) AS tasks FROM `zt_task` WHERE story IN ('') AND  deleted  = '0' AND  project  = '10' GROUP BY story
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 
  SELECT t1.product, t2.name FROM `zt_projectproduct` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.project  = '10'
  SELECT t2.id, t2.name, t2.type, t1.branch FROM `zt_projectproduct` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.project  = '10'
  SELECT * FROM `zt_product` WHERE `id` = '6' 
  SELECT * FROM `zt_module` WHERE root  = '6' AND  type  = 'story' AND  deleted  = '0' ORDER BY `grade` desc,`order` 
  SELECT * FROM `zt_branch` WHERE product IN ('6') AND  deleted  = '0' ORDER BY `order` 
  SELECT * FROM `zt_product` WHERE id IN ('6')
  SELECT id,title FROM `zt_productplan` WHERE product IN ('6') AND  deleted  = '0' ORDER BY `begin` desc 
  SELECT product FROM `zt_projectproduct` WHERE project  = '10'
  SELECT t1.project, t2.name FROM `zt_projectproduct` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project = t2.id  WHERE t2.deleted  = '0' AND  t1.product  = '6' AND  t1.project  != '10'
  SELECT DISTINCT story FROM `zt_case` WHERE story IN ('')
  SELECT DISTINCT t3.path FROM `zt_projectstory` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_module` AS t3  ON t2.module = t3.id  WHERE t1.project  = '10' AND  t3.deleted  = '0'
  SELECT path FROM `zt_module` WHERE root  = '10' AND  type  = 'task' AND  deleted  = '0'
  SELECT DISTINCT t1.path FROM `zt_module` AS t1  LEFT JOIN `zt_task` AS t2  ON t1.id=t2.module  WHERE t2.module  != '0' AND  t2.project  = '10' AND  t2.deleted  = '0' AND  t1.type  = 'story' AND  t1.deleted  = '0'
  SELECT t1.product, t2.name FROM `zt_projectproduct` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.project  = '10'
  SELECT * FROM `zt_branch` WHERE product IN ('6') AND  deleted  = '0' ORDER BY `order` 
  SELECT * FROM `zt_product` WHERE id IN ('6')
  SELECT * FROM `zt_module` WHERE (root = 6 and type = 'story')  AND  deleted  = '0' ORDER BY `grade` desc,`branch`,`type`,`order` 

20170210 14:55:41: search-buildForm
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 
  SELECT id, title FROM `zt_userquery` WHERE account  = 'admin' AND  module  = 'projectStory' ORDER BY `id` asc 

20170210 14:55:43: project-ajaxGetDropMenu-10-project-story-
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT * FROM `zt_project` WHERE id IN ('3','12','11','10','9','2','1') ORDER BY `order` desc 

20170210 14:55:45: project-story-11
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT * FROM `zt_project` WHERE `id` = '11' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '11' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '11'
  SELECT t2.id, t2.name, t2.type, t1.branch FROM `zt_projectproduct` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.project  = '11'
  SELECT id, name FROM `zt_project` WHERE parent  = '11'
  SELECT t1.*, t1.hours * t1.days AS totalHours, if(t2.deleted='0', t2.realname, t1.account) as realname FROM `zt_team` AS t1  LEFT JOIN `zt_user` AS t2  ON t1.account = t2.account  WHERE t1.project  = '11'
  SELECT commiter, account, realname FROM `zt_user` WHERE commiter  != ''
  SELECT * FROM `zt_action` WHERE objectType IN('project', 'testtask', 'build')  AND  project  = '11' ORDER BY `date`,`id` 
  SELECT * FROM `zt_history` WHERE action IN ('1255','1376','1391','1511','1512') ORDER BY `id` 
  SELECT * FROM `zt_project` WHERE `id` = '11' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '11' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '11'
  SELECT * FROM `zt_project` WHERE `id` = '11' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '11' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '11'
  SELECT distinct t1.*, t2.*,t3.branch as productBranch,t4.type as productType,t2.version as version FROM `zt_projectstory` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_projectproduct` AS t3  ON t1.project = t3.project  LEFT JOIN `zt_product` AS t4  ON t2.product = t4.id  WHERE t1.project  = '11' AND  t2.deleted  = '0' ORDER BY `pri`,`id` asc 
  SELECT COUNT(distinct t2.id) AS recTotal FROM `zt_projectstory` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_projectproduct` AS t3  ON t1.project = t3.project  LEFT JOIN `zt_product` AS t4  ON t2.product = t4.id  WHERE t1.project  = '11' AND  t2.deleted  = '0' 
  SELECT distinct t1.*, t2.*,t3.branch as productBranch,t4.type as productType,t2.version as version FROM `zt_projectstory` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_projectproduct` AS t3  ON t1.project = t3.project  LEFT JOIN `zt_product` AS t4  ON t2.product = t4.id  WHERE t1.project  = '11' AND  t2.deleted  = '0' ORDER BY `pri`,`id` asc 
  SELECT distinct t1.*, t2.*,t3.branch as productBranch,t4.type as productType,t2.version as version FROM `zt_projectstory` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_projectproduct` AS t3  ON t1.project = t3.project  LEFT JOIN `zt_product` AS t4  ON t2.product = t4.id  WHERE t1.project  = '11' AND  t2.deleted  = '0' ORDER BY `pri`,`id` asc 
  SELECT distinct t1.*, t2.*,t3.branch as productBranch,t4.type as productType,t2.version as version FROM `zt_projectstory` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_projectproduct` AS t3  ON t1.project = t3.project  LEFT JOIN `zt_product` AS t4  ON t2.product = t4.id  WHERE t1.project  = '11' AND  t2.deleted  = '0' ORDER BY `pri`,`id` asc 
  SELECT story, COUNT(*) AS tasks FROM `zt_task` WHERE story IN ('37','38','40','41','36','39') AND  deleted  = '0' AND  project  = '11' GROUP BY story
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 
  SELECT t1.product, t2.name FROM `zt_projectproduct` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.project  = '11'
  SELECT t2.id, t2.name, t2.type, t1.branch FROM `zt_projectproduct` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.project  = '11'
  SELECT * FROM `zt_product` WHERE `id` = '6' 
  SELECT * FROM `zt_module` WHERE root  = '6' AND  type  = 'story' AND  deleted  = '0' ORDER BY `grade` desc,`order` 
  SELECT * FROM `zt_branch` WHERE product IN ('6') AND  deleted  = '0' ORDER BY `order` 
  SELECT * FROM `zt_product` WHERE id IN ('6')
  SELECT id,title FROM `zt_productplan` WHERE product IN ('6') AND  deleted  = '0' ORDER BY `begin` desc 
  SELECT product FROM `zt_projectproduct` WHERE project  = '11'
  SELECT t1.project, t2.name FROM `zt_projectproduct` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project = t2.id  WHERE t2.deleted  = '0' AND  t1.product  = '6' AND  t1.project  != '11'
  SELECT DISTINCT story FROM `zt_case` WHERE story IN ('37','38','40','41','36','39')
  SELECT DISTINCT t3.path FROM `zt_projectstory` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_module` AS t3  ON t2.module = t3.id  WHERE t1.project  = '11' AND  t3.deleted  = '0'
  SELECT path FROM `zt_module` WHERE root  = '11' AND  type  = 'task' AND  deleted  = '0'
  SELECT DISTINCT t1.path FROM `zt_module` AS t1  LEFT JOIN `zt_task` AS t2  ON t1.id=t2.module  WHERE t2.module  != '0' AND  t2.project  = '11' AND  t2.deleted  = '0' AND  t1.type  = 'story' AND  t1.deleted  = '0'
  SELECT t1.product, t2.name FROM `zt_projectproduct` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.project  = '11'
  SELECT * FROM `zt_branch` WHERE product IN ('6') AND  deleted  = '0' ORDER BY `order` 
  SELECT * FROM `zt_product` WHERE id IN ('6')
  SELECT * FROM `zt_module` WHERE (root = 6 and type = 'story')  AND  deleted  = '0' ORDER BY `grade` desc,`branch`,`type`,`order` 

20170210 14:55:45: search-buildForm
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 
  SELECT id, title FROM `zt_userquery` WHERE account  = 'admin' AND  module  = 'projectStory' ORDER BY `id` asc 

20170210 14:55:47: story-view-41-1-project-11
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_story` WHERE `id` = '41' 
  SELECT title,spec,verify FROM `zt_storyspec` WHERE story  = '41' AND  version  = '1'
  SELECT t1.project, t2.name, t2.status FROM `zt_projectstory` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project = t2.id  WHERE t1.story  = '41' ORDER BY t1.`project` DESC 
  SELECT id, name, assignedTo, project, status, consumed, `left` FROM `zt_task` WHERE story  = '41' AND  deleted  = '0' ORDER BY `id` DESC 
  SELECT * FROM `zt_storystage` WHERE story  = '41'
  SELECT id, name, assignedTo, project, type, status, consumed, `left` FROM `zt_task` WHERE story  = '41' AND  deleted  = '0' ORDER BY `id` DESC 
  SELECT * FROM `zt_file` WHERE objectType  = 'story' AND  objectID  = '41' AND  extra  != 'editor'
  SELECT name, id, type FROM `zt_product` WHERE `id` = '6' 
  SELECT title FROM `zt_productplan` WHERE `id` = '' 
  SELECT id,title FROM `zt_bug` WHERE story  = '41' AND  deleted  = '0'
  SELECT id,title FROM `zt_bug` WHERE toStory  = '41'
  SELECT id,title FROM `zt_case` WHERE story  = '41' AND  deleted  = '0'
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 
  SELECT * FROM `zt_product` WHERE `id` = '6' 
  SELECT * FROM `zt_project` WHERE `id` = '11' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '11' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '11'
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT commiter, account, realname FROM `zt_user` WHERE commiter  != ''
  SELECT * FROM `zt_action` WHERE objectType  = 'story' AND  objectID  = '41' ORDER BY `date`,`id` 
  SELECT * FROM `zt_history` WHERE action IN ('1586','1587') ORDER BY `id` 
  SELECT name FROM `zt_project` WHERE id  = '11'

20170210 14:55:51: story-view-39-1-project-11
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_story` WHERE `id` = '39' 
  SELECT title,spec,verify FROM `zt_storyspec` WHERE story  = '39' AND  version  = '1'
  SELECT t1.project, t2.name, t2.status FROM `zt_projectstory` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project = t2.id  WHERE t1.story  = '39' ORDER BY t1.`project` DESC 
  SELECT id, name, assignedTo, project, status, consumed, `left` FROM `zt_task` WHERE story  = '39' AND  deleted  = '0' ORDER BY `id` DESC 
  SELECT * FROM `zt_storystage` WHERE story  = '39'
  SELECT id, name, assignedTo, project, type, status, consumed, `left` FROM `zt_task` WHERE story  = '39' AND  deleted  = '0' ORDER BY `id` DESC 
  SELECT * FROM `zt_file` WHERE objectType  = 'story' AND  objectID  = '39' AND  extra  != 'editor'
  SELECT name, id, type FROM `zt_product` WHERE `id` = '6' 
  SELECT title FROM `zt_productplan` WHERE `id` = '' 
  SELECT id,title FROM `zt_bug` WHERE story  = '39' AND  deleted  = '0'
  SELECT id,title FROM `zt_bug` WHERE toStory  = '39'
  SELECT id,title FROM `zt_case` WHERE story  = '39' AND  deleted  = '0'
  SELECT path FROM `zt_module` WHERE id  = '16'
  SELECT * FROM `zt_module` WHERE id IN ('16') AND  deleted  = '0' ORDER BY `grade` 
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 
  SELECT * FROM `zt_product` WHERE `id` = '6' 
  SELECT * FROM `zt_project` WHERE `id` = '11' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '11' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '11'
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT commiter, account, realname FROM `zt_user` WHERE commiter  != ''
  SELECT * FROM `zt_action` WHERE objectType  = 'story' AND  objectID  = '39' ORDER BY `date`,`id` 
  SELECT * FROM `zt_history` WHERE action IN ('1582','1583','1584') ORDER BY `id` 
  SELECT name FROM `zt_project` WHERE id  = '11'

