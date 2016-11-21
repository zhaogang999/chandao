<?php
 die();
?>
20161121 09:03:25: 
  SELECT * FROM `zt_company` ORDER BY `id`  LIMIT 1 
  SELECT * FROM `zt_config` WHERE owner IN ('system','') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_user` WHERE account  = 'admin' AND  deleted  = '0'
  UPDATE `zt_user` SET  visits = visits + 1, `ip` = '127.0.0.1', `last` = '1479690203' WHERE account  = 'admin'
  SELECT t1.acl FROM `zt_group` AS t1  LEFT JOIN `zt_usergroup` AS t2  ON t1.id=t2.group  WHERE t2.account  = 'admin'
  SELECT module, method FROM `zt_usergroup` AS t1  LEFT JOIN `zt_grouppriv` AS t2  ON t1.group = t2.group  WHERE t1.account  = 'admin'
  SELECT `group` FROM `zt_usergroup` WHERE `account` = 'admin' 
  INSERT INTO `zt_action` SET `objectType` = 'user',`objectID` = '1',`actor` = 'admin',`action` = 'login',`date` = '2016-11-21 09:03:25',`comment` = '',`extra` = '',`product` = ',0,',`project` = '0'
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 

20161121 09:03:25: my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE account  = 'admin' AND  module  = 'my' AND  hidden  = '0' ORDER BY `order` 

20161121 09:03:27: block-printBlock-1-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '1'

20161121 09:03:27: block-printBlock-6-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '6'
  SELECT t1.*, t2.id as projectID, t2.name as projectName, t3.id as storyID, t3.title as storyTitle, t3.status AS storyStatus, t3.version AS latestStoryVersion FROM `zt_task` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project = t2.id  LEFT JOIN `zt_story` AS t3  ON t1.story = t3.id  WHERE t1.deleted  = '0' AND  t1.assignedTo  = 'admin' ORDER BY `id` desc  LIMIT 15 
  SELECT t1.*, t2.id as projectID, t2.name as projectName, t3.id as storyID, t3.title as storyTitle, t3.status AS storyStatus, t3.version AS latestStoryVersion FROM `zt_task` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project = t2.id  LEFT JOIN `zt_story` AS t3  ON t1.story = t3.id  WHERE t1.deleted  = '0' AND  t1.assignedTo  = 'admin' ORDER BY `id` desc  LIMIT 15 

20161121 09:03:27: block-printBlock-5-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '5'
  SELECT * FROM `zt_product` WHERE deleted  = '0' AND  status  != 'closed' ORDER BY `order` desc 
  SELECT * FROM `zt_product` WHERE id IN ('2','1') ORDER BY `order` desc 
  SELECT COUNT(*) AS recTotal FROM `zt_product` WHERE id IN ('2','1') 
  SELECT * FROM `zt_product` WHERE id IN ('2','1') ORDER BY `order` desc 
  SELECT product, status, count(status) AS count FROM `zt_story` WHERE deleted  = '0' AND  product IN ('2','1') GROUP BY product, status
  SELECT product, count(*) AS count FROM `zt_productplan` WHERE deleted  = '0' AND  product IN ('2','1') AND  end  > '2016-11-21 09:03:27' GROUP BY product
  SELECT product, count(*) AS count FROM `zt_release` WHERE deleted  = '0' AND  product IN ('2','1') GROUP BY product
  SELECT product,count(*) AS conut FROM `zt_bug` WHERE deleted  = '0' AND  product IN ('2','1') GROUP BY product
  SELECT product,count(*) AS count FROM `zt_bug` WHERE status  = 'active' AND  deleted  = '0' AND  product IN ('2','1') GROUP BY product
  SELECT product,count(*) AS count FROM `zt_bug` WHERE AssignedTo  = '' AND  deleted  = '0' AND  product IN ('2','1') GROUP BY product

20161121 09:03:28: block-printBlock-4-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '4'
  SELECT * FROM `zt_todo` WHERE account  = 'admin' AND  date  >= '1970-01-01' AND  date  <= '2109-01-01' AND  status IN ('wait','doing') ORDER BY `date`,`status`,`begin`  LIMIT 20 
  SELECT * FROM `zt_todo` WHERE account  = 'admin' AND  date  >= '1970-01-01' AND  date  <= '2109-01-01' AND  status IN ('wait','doing') ORDER BY `date`,`status`,`begin`  LIMIT 20 

20161121 09:03:28: block-printBlock-2-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '2'
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT * FROM `zt_action` WHERE 1  AND  date  > '2016-11-21' AND  date  < '2016-11-22' AND  (1)  ORDER BY `date` desc 
  SELECT commiter, account, realname FROM `zt_user` WHERE commiter  != ''
  SELECT id, account AS name FROM `zt_user` WHERE id IN ('1')
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 

20161121 09:03:28: block-printBlock-3-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '3'
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  status  != 'done' AND  deleted  = '0' ORDER BY `order` desc 
  SELECT * FROM `zt_project` WHERE id IN ('2') ORDER BY `order` desc 
  SELECT COUNT(*) AS recTotal FROM `zt_project` WHERE id IN ('2') 
  SELECT * FROM `zt_project` WHERE id IN ('2') ORDER BY `order` desc 
  SELECT id, project, estimate, consumed, `left`, status, closedReason FROM `zt_task` WHERE project IN ('2') AND  deleted  = '0'
  SELECT project, date AS name, `left` AS value FROM `zt_burn` WHERE project IN ('2') ORDER BY `date` desc 

20161121 09:03:28: block-printBlock-7-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '7'
  SELECT * FROM `zt_bug` WHERE deleted  = '0' AND  assignedTo  = 'admin' ORDER BY `id` desc  LIMIT 15 

20161121 09:03:28: block-printBlock-8-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '8'
  SELECT t1.*, t2.name as productTitle FROM `zt_story` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.deleted  = '0' AND  assignedTo  = 'admin' ORDER BY `id` desc 
  SELECT COUNT(*) AS recTotal FROM `zt_story` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.deleted  = '0' AND  assignedTo  = 'admin' 
  SELECT t1.*, t2.name as productTitle FROM `zt_story` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.deleted  = '0' AND  assignedTo  = 'admin' ORDER BY `id` desc 
  SELECT t1.*, t2.name as productTitle FROM `zt_story` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.deleted  = '0' AND  assignedTo  = 'admin' ORDER BY `id` desc 
  SELECT t1.*, t2.name as productTitle FROM `zt_story` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.deleted  = '0' AND  assignedTo  = 'admin' ORDER BY `id` desc 
  SELECT id,title FROM `zt_productplan` WHERE product IN ('1') AND  deleted  = '0'
  SELECT * FROM `zt_storystage` WHERE branch IN ('0')

20161121 09:03:28: block-printBlock-9-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '9'
  SELECT t1.assignedTo AS assignedTo, t2.* FROM `zt_testrun` AS t1  LEFT JOIN `zt_case` AS t2  ON t1.case = t2.id  LEFT JOIN `zt_testtask` AS t3  ON t1.task = t3.id  WHERE t1.assignedTo  = 'admin' AND  t1.status  != 'done' AND  t3.status  != 'done' AND  t3.deleted  = '0' AND  t2.deleted  = '0' ORDER BY `id` desc  LIMIT 15 

20161121 09:09:01: misc-qrCode
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161121 09:09:27: my-story
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT t1.*, t2.name as productTitle FROM `zt_story` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.deleted  = '0' AND  assignedTo  = 'admin' ORDER BY `id` desc 
  SELECT COUNT(*) AS recTotal FROM `zt_story` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.deleted  = '0' AND  assignedTo  = 'admin' 
  SELECT t1.*, t2.name as productTitle FROM `zt_story` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.deleted  = '0' AND  assignedTo  = 'admin' ORDER BY `id` desc 
  SELECT t1.*, t2.name as productTitle FROM `zt_story` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.deleted  = '0' AND  assignedTo  = 'admin' ORDER BY `id` desc 
  SELECT t1.*, t2.name as productTitle FROM `zt_story` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.deleted  = '0' AND  assignedTo  = 'admin' ORDER BY `id` desc 
  SELECT id,title FROM `zt_productplan` WHERE product IN ('1') AND  deleted  = '0'
  SELECT * FROM `zt_storystage` WHERE branch IN ('0')
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 

20161121 09:09:46: my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE account  = 'admin' AND  module  = 'my' AND  hidden  = '0' ORDER BY `order` 

20161121 09:09:46: block-printBlock-2-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '2'
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT * FROM `zt_action` WHERE 1  AND  date  > '2016-11-21' AND  date  < '2016-11-22' AND  (1)  ORDER BY `date` desc 
  SELECT commiter, account, realname FROM `zt_user` WHERE commiter  != ''
  SELECT id, account AS name FROM `zt_user` WHERE id IN ('1')
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 

20161121 09:09:46: block-printBlock-1-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '1'

20161121 09:09:46: block-printBlock-6-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '6'
  SELECT t1.*, t2.id as projectID, t2.name as projectName, t3.id as storyID, t3.title as storyTitle, t3.status AS storyStatus, t3.version AS latestStoryVersion FROM `zt_task` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project = t2.id  LEFT JOIN `zt_story` AS t3  ON t1.story = t3.id  WHERE t1.deleted  = '0' AND  t1.assignedTo  = 'admin' ORDER BY `id` desc  LIMIT 15 
  SELECT t1.*, t2.id as projectID, t2.name as projectName, t3.id as storyID, t3.title as storyTitle, t3.status AS storyStatus, t3.version AS latestStoryVersion FROM `zt_task` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project = t2.id  LEFT JOIN `zt_story` AS t3  ON t1.story = t3.id  WHERE t1.deleted  = '0' AND  t1.assignedTo  = 'admin' ORDER BY `id` desc  LIMIT 15 

20161121 09:09:46: block-printBlock-4-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '4'
  SELECT * FROM `zt_todo` WHERE account  = 'admin' AND  date  >= '1970-01-01' AND  date  <= '2109-01-01' AND  status IN ('wait','doing') ORDER BY `date`,`status`,`begin`  LIMIT 20 
  SELECT * FROM `zt_todo` WHERE account  = 'admin' AND  date  >= '1970-01-01' AND  date  <= '2109-01-01' AND  status IN ('wait','doing') ORDER BY `date`,`status`,`begin`  LIMIT 20 

20161121 09:09:46: block-printBlock-5-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '5'
  SELECT * FROM `zt_product` WHERE deleted  = '0' AND  status  != 'closed' ORDER BY `order` desc 
  SELECT * FROM `zt_product` WHERE id IN ('2','1') ORDER BY `order` desc 
  SELECT COUNT(*) AS recTotal FROM `zt_product` WHERE id IN ('2','1') 
  SELECT * FROM `zt_product` WHERE id IN ('2','1') ORDER BY `order` desc 
  SELECT product, status, count(status) AS count FROM `zt_story` WHERE deleted  = '0' AND  product IN ('2','1') GROUP BY product, status
  SELECT product, count(*) AS count FROM `zt_productplan` WHERE deleted  = '0' AND  product IN ('2','1') AND  end  > '2016-11-21 09:09:46' GROUP BY product
  SELECT product, count(*) AS count FROM `zt_release` WHERE deleted  = '0' AND  product IN ('2','1') GROUP BY product
  SELECT product,count(*) AS conut FROM `zt_bug` WHERE deleted  = '0' AND  product IN ('2','1') GROUP BY product
  SELECT product,count(*) AS count FROM `zt_bug` WHERE status  = 'active' AND  deleted  = '0' AND  product IN ('2','1') GROUP BY product
  SELECT product,count(*) AS count FROM `zt_bug` WHERE AssignedTo  = '' AND  deleted  = '0' AND  product IN ('2','1') GROUP BY product

20161121 09:09:46: block-printBlock-3-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '3'
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  status  != 'done' AND  deleted  = '0' ORDER BY `order` desc 
  SELECT * FROM `zt_project` WHERE id IN ('2') ORDER BY `order` desc 
  SELECT COUNT(*) AS recTotal FROM `zt_project` WHERE id IN ('2') 
  SELECT * FROM `zt_project` WHERE id IN ('2') ORDER BY `order` desc 
  SELECT id, project, estimate, consumed, `left`, status, closedReason FROM `zt_task` WHERE project IN ('2') AND  deleted  = '0'
  SELECT project, date AS name, `left` AS value FROM `zt_burn` WHERE project IN ('2') ORDER BY `date` desc 

20161121 09:09:46: block-printBlock-7-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '7'
  SELECT * FROM `zt_bug` WHERE deleted  = '0' AND  assignedTo  = 'admin' ORDER BY `id` desc  LIMIT 15 

20161121 09:09:46: block-printBlock-8-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '8'
  SELECT t1.*, t2.name as productTitle FROM `zt_story` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.deleted  = '0' AND  assignedTo  = 'admin' ORDER BY `id` desc 
  SELECT COUNT(*) AS recTotal FROM `zt_story` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.deleted  = '0' AND  assignedTo  = 'admin' 
  SELECT t1.*, t2.name as productTitle FROM `zt_story` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.deleted  = '0' AND  assignedTo  = 'admin' ORDER BY `id` desc 
  SELECT t1.*, t2.name as productTitle FROM `zt_story` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.deleted  = '0' AND  assignedTo  = 'admin' ORDER BY `id` desc 
  SELECT t1.*, t2.name as productTitle FROM `zt_story` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.deleted  = '0' AND  assignedTo  = 'admin' ORDER BY `id` desc 
  SELECT id,title FROM `zt_productplan` WHERE product IN ('1') AND  deleted  = '0'
  SELECT * FROM `zt_storystage` WHERE branch IN ('0')

20161121 09:09:46: block-printBlock-9-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '9'
  SELECT t1.assignedTo AS assignedTo, t2.* FROM `zt_testrun` AS t1  LEFT JOIN `zt_case` AS t2  ON t1.case = t2.id  LEFT JOIN `zt_testtask` AS t3  ON t1.task = t3.id  WHERE t1.assignedTo  = 'admin' AND  t1.status  != 'done' AND  t3.status  != 'done' AND  t3.deleted  = '0' AND  t2.deleted  = '0' ORDER BY `id` desc  LIMIT 15 

20161121 09:09:47: my-story
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT t1.*, t2.name as productTitle FROM `zt_story` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.deleted  = '0' AND  assignedTo  = 'admin' ORDER BY `id` desc 
  SELECT COUNT(*) AS recTotal FROM `zt_story` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.deleted  = '0' AND  assignedTo  = 'admin' 
  SELECT t1.*, t2.name as productTitle FROM `zt_story` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.deleted  = '0' AND  assignedTo  = 'admin' ORDER BY `id` desc 
  SELECT t1.*, t2.name as productTitle FROM `zt_story` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.deleted  = '0' AND  assignedTo  = 'admin' ORDER BY `id` desc 
  SELECT t1.*, t2.name as productTitle FROM `zt_story` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.deleted  = '0' AND  assignedTo  = 'admin' ORDER BY `id` desc 
  SELECT id,title FROM `zt_productplan` WHERE product IN ('1') AND  deleted  = '0'
  SELECT * FROM `zt_storystage` WHERE branch IN ('0')
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 

20161121 09:09:50: product
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 

20161121 09:09:51: product-browse
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_story` WHERE product IN ('1') AND  status IN ('','draft','active','changed') AND  deleted  = '0' ORDER BY `id` desc 
  SELECT COUNT(*) AS recTotal FROM `zt_story` WHERE product IN ('1') AND  status IN ('','draft','active','changed') AND  deleted  = '0' 
  SELECT * FROM `zt_story` WHERE product IN ('1') AND  status IN ('','draft','active','changed') AND  deleted  = '0' ORDER BY `id` desc   limit 0, 20 
  SELECT * FROM `zt_story` WHERE product IN ('1') AND  status IN ('','draft','active','changed') AND  deleted  = '0' ORDER BY `id` desc   limit 0, 20 
  SELECT id,title FROM `zt_productplan` WHERE product IN ('1') AND  deleted  = '0'
  SELECT * FROM `zt_storystage` WHERE branch IN ('0')
  SELECT * FROM `zt_story` WHERE product IN ('1') AND  status IN ('','draft','active','changed') AND  deleted  = '0' ORDER BY `id` desc   limit 0, 20 
  SELECT id,CONCAT(title, " [", begin, " ~ ", end, "]") as title FROM `zt_productplan` WHERE product IN ('1') AND  deleted  = '0' ORDER BY `begin` desc 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_module` WHERE root  = '1' AND  type  = 'story' ORDER BY `grade` desc,`order` 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT id,CONCAT(title, " [", begin, " ~ ", end, "]") as title FROM `zt_productplan` WHERE product IN ('1') AND  deleted  = '0' ORDER BY `begin` desc 
  SELECT DISTINCT story FROM `zt_case` WHERE story IN ('31','30','29','28','27','26','25','24','23','22','21','20','19','18','17','16','15','14','13','12')
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_module` WHERE root  = '1' AND  type  = 'story' ORDER BY `grade` desc,`order` 
  SELECT account, realname, deleted, INSTR(',pd,po,', role) AS roleOrder FROM `zt_user` WHERE deleted  = '0' ORDER BY `roleOrder` DESC,`account` 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_module` WHERE root  = '1' AND  type  = 'story' ORDER BY `grade` desc,`order` 
  SELECT * FROM `zt_branch` WHERE product  = '1' AND  deleted  = '0' ORDER BY `id` asc 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_storystage` WHERE story IN ('31','30','29','28','27','26','25','24','23','22','21','20','19','18','17','16','15','14','13','12')

20161121 09:10:15: story-export-1-id_desc
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT id,title,content,public FROM `zt_usertpl` WHERE type  = 'exportstory' AND ( account  = 'admin' OR public  = '1') ORDER BY `id` 

20161121 09:10:22: story-export-1-id_desc
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_story` WHERE product IN ('1') AND  status IN ('','draft','active','changed') AND  deleted  = '0'  AND  id IN ('31') ORDER BY `id` desc 
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 
  SELECT id, name FROM `zt_module` WHERE id IN ('0')
  SELECT id, title FROM `zt_productplan` WHERE id IN ('3')
  SELECT id,title FROM `zt_story` WHERE id IN ('')
  SELECT id, objectID, pathname, title FROM `zt_file` WHERE objectType  = 'story' AND  objectID IN ('31')
  SELECT * FROM `zt_storyspec` WHERE `story` IN ('31') ORDER BY `version` desc 
  SELECT * FROM `zt_product` WHERE id  = '1'
  SELECT t2.id, t2.path, t2.name, t2.parent, t2.grade, t1.id as kindID, t2.order FROM `zt_story` AS t1  LEFT JOIN `zt_module` AS t2  ON t1.module=t2.id  WHERE t1.id IN ('31') ORDER BY t2.`grade` asc,t2.`order` asc 
  SELECT id,path,name,parent,grade,`order` FROM `zt_module` WHERE id IN ('') ORDER BY `grade` asc,`order` asc 

20161121 09:19:51: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_config` WHERE 1 = 1  AND  owner IN ('system') AND  module IN ('common') AND  section IN ('global') AND  `key` IN ('sn')

20161121 09:20:16: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_config` WHERE 1 = 1  AND  owner IN ('system') AND  module IN ('common') AND  section IN ('global') AND  `key` IN ('sn')

20161121 09:29:15: story-export-1-id_desc
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT id,title,content,public FROM `zt_usertpl` WHERE type  = 'exportstory' AND ( account  = 'admin' OR public  = '1') ORDER BY `id` 

20161121 09:29:51: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161121 09:36:08: misc-qrCode
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161121 09:39:16: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161121 09:39:52: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161121 09:44:41: 
  SELECT * FROM `zt_company` ORDER BY `id`  LIMIT 1 
  SELECT * FROM `zt_config` WHERE owner IN ('system','') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_user` WHERE account  = 'admin' AND  deleted  = '0'

20161121 09:44:43: user-login-Lw==
  SELECT * FROM `zt_config` WHERE owner IN ('system','') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT account, realname, deleted FROM `zt_user` WHERE deleted  = '0' ORDER BY `account` 

20161121 09:49:16: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_config` WHERE 1 = 1  AND  owner IN ('system') AND  module IN ('common') AND  section IN ('global') AND  `key` IN ('sn')

20161121 09:49:52: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_config` WHERE 1 = 1  AND  owner IN ('system') AND  module IN ('common') AND  section IN ('global') AND  `key` IN ('sn')

20161121 09:51:19: extension-obtain-bySearch
  SELECT * FROM `zt_config` WHERE owner IN ('system','') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_user` WHERE account  = 'admin' AND  deleted  = '0'

20161121 09:51:19: user-login-L2V4dGVuc2lvbi1vYnRhaW4tYnlTZWFyY2guaHRtbA==
  SELECT * FROM `zt_config` WHERE owner IN ('system','') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT account, realname, deleted FROM `zt_user` WHERE deleted  = '0' ORDER BY `account` 

20161121 09:59:17: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161121 09:59:53: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_config` WHERE 1 = 1  AND  owner IN ('system') AND  module IN ('common') AND  section IN ('global') AND  `key` IN ('sn')

20161121 10:09:17: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161121 10:09:53: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_config` WHERE 1 = 1  AND  owner IN ('system') AND  module IN ('common') AND  section IN ('global') AND  `key` IN ('sn')

20161121 10:19:18: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161121 10:19:54: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161121 10:21:17: company
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161121 10:21:18: company-browse
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_dept` WHERE `id` = '0' 
  SELECT * FROM `zt_dept` ORDER BY `grade` desc,`order` 
  SELECT * FROM `zt_user` WHERE deleted  = '0' ORDER BY `id` 
  SELECT COUNT(*) AS recTotal FROM `zt_user` WHERE deleted  = '0' 
  SELECT * FROM `zt_user` WHERE deleted  = '0' ORDER BY `id` 
  SELECT id, title FROM `zt_userquery` WHERE account  = 'admin' AND  module  = 'user' ORDER BY `id` asc 
  SELECT * FROM `zt_dept` WHERE `id` = '0' 
  SELECT * FROM `zt_dept` ORDER BY `grade` desc,`order` 

20161121 10:21:26: admin
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161121 10:21:29: company
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161121 10:21:29: company-browse
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_dept` WHERE `id` = '0' 
  SELECT * FROM `zt_dept` ORDER BY `grade` desc,`order` 
  SELECT * FROM `zt_user` WHERE deleted  = '0' ORDER BY `id` 
  SELECT COUNT(*) AS recTotal FROM `zt_user` WHERE deleted  = '0' 
  SELECT * FROM `zt_user` WHERE deleted  = '0' ORDER BY `id` 
  SELECT id, title FROM `zt_userquery` WHERE account  = 'admin' AND  module  = 'user' ORDER BY `id` asc 
  SELECT * FROM `zt_dept` WHERE `id` = '0' 
  SELECT * FROM `zt_dept` ORDER BY `grade` desc,`order` 

20161121 10:21:33: user-create-0
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT id, name, role FROM `zt_group`
  SELECT * FROM `zt_dept` WHERE `id` = '0' 
  SELECT * FROM `zt_dept` ORDER BY `grade` desc,`order` 

20161121 10:22:44: user-create-0
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161121 10:23:05: user-create-0
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  INSERT INTO `zt_user` SET `dept` = '5',`account` = 'product',`realname` = 'product',`role` = 'po',`email` = '',`commiter` = '',`join` = '2016-11-21',`gender` = 'm',`password` = 'e10adc3949ba59abbe56e057f20f883e'
  INSERT INTO `zt_usergroup` SET `account` = 'product',`group` = '5'

20161121 10:23:05: company-browse
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_dept` WHERE `id` = '0' 
  SELECT * FROM `zt_dept` ORDER BY `grade` desc,`order` 
  SELECT * FROM `zt_user` WHERE deleted  = '0' ORDER BY `id` 
  SELECT COUNT(*) AS recTotal FROM `zt_user` WHERE deleted  = '0' 
  SELECT * FROM `zt_user` WHERE deleted  = '0' ORDER BY `id` 
  SELECT id, title FROM `zt_userquery` WHERE account  = 'admin' AND  module  = 'user' ORDER BY `id` asc 
  SELECT * FROM `zt_dept` WHERE `id` = '0' 
  SELECT * FROM `zt_dept` ORDER BY `grade` desc,`order` 

20161121 10:23:41: user-view-productManager
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161121 10:23:42: user-todo-productManager
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_user` WHERE account  = 'productManager'
  SELECT * FROM `zt_todo` WHERE account  = 'productManager' AND  date  >= '20161121' AND  date  <= '20161121' ORDER BY `date`,`status`,`begin`,`id` asc 
  SELECT COUNT(*) AS recTotal FROM `zt_todo` WHERE account  = 'productManager' AND  date  >= '20161121' AND  date  <= '20161121' 
  SELECT * FROM `zt_todo` WHERE account  = 'productManager' AND  date  >= '20161121' AND  date  <= '20161121' ORDER BY `date`,`status`,`begin`,`id` asc 
  SELECT * FROM `zt_todo` WHERE account  = 'productManager' AND  date  >= '20161121' AND  date  <= '20161121' ORDER BY `date`,`status`,`begin`,`id` asc 
  SELECT account, realname, deleted FROM `zt_user` WHERE deleted  = '0' ORDER BY `account` 

20161121 10:23:52: admin
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161121 10:23:54: company
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161121 10:23:55: company-browse
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_dept` WHERE `id` = '0' 
  SELECT * FROM `zt_dept` ORDER BY `grade` desc,`order` 
  SELECT * FROM `zt_user` WHERE deleted  = '0' ORDER BY `id` 
  SELECT COUNT(*) AS recTotal FROM `zt_user` WHERE deleted  = '0' 
  SELECT * FROM `zt_user` WHERE deleted  = '0' ORDER BY `id` 
  SELECT id, title FROM `zt_userquery` WHERE account  = 'admin' AND  module  = 'user' ORDER BY `id` asc 
  SELECT * FROM `zt_dept` WHERE `id` = '0' 
  SELECT * FROM `zt_dept` ORDER BY `grade` desc,`order` 

20161121 10:24:03: company-browse
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_dept` WHERE `id` = '0' 
  SELECT * FROM `zt_dept` ORDER BY `grade` desc,`order` 
  SELECT * FROM `zt_user` WHERE deleted  = '0' ORDER BY `id` 
  SELECT COUNT(*) AS recTotal FROM `zt_user` WHERE deleted  = '0' 
  SELECT * FROM `zt_user` WHERE deleted  = '0' ORDER BY `id` 
  SELECT id, title FROM `zt_userquery` WHERE account  = 'admin' AND  module  = 'user' ORDER BY `id` asc 
  SELECT * FROM `zt_dept` WHERE `id` = '0' 
  SELECT * FROM `zt_dept` ORDER BY `grade` desc,`order` 

20161121 10:24:09: user-view-productManager
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161121 10:24:09: user-todo-productManager
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_user` WHERE account  = 'productManager'
  SELECT * FROM `zt_todo` WHERE account  = 'productManager' AND  date  >= '20161121' AND  date  <= '20161121' ORDER BY `date`,`status`,`begin`,`id` asc 
  SELECT COUNT(*) AS recTotal FROM `zt_todo` WHERE account  = 'productManager' AND  date  >= '20161121' AND  date  <= '20161121' 
  SELECT * FROM `zt_todo` WHERE account  = 'productManager' AND  date  >= '20161121' AND  date  <= '20161121' ORDER BY `date`,`status`,`begin`,`id` asc 
  SELECT * FROM `zt_todo` WHERE account  = 'productManager' AND  date  >= '20161121' AND  date  <= '20161121' ORDER BY `date`,`status`,`begin`,`id` asc 
  SELECT account, realname, deleted FROM `zt_user` WHERE deleted  = '0' ORDER BY `account` 

20161121 10:24:33: company-browse
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_dept` WHERE `id` = '0' 
  SELECT * FROM `zt_dept` ORDER BY `grade` desc,`order` 
  SELECT * FROM `zt_user` WHERE deleted  = '0' ORDER BY `id` 
  SELECT COUNT(*) AS recTotal FROM `zt_user` WHERE deleted  = '0' 
  SELECT * FROM `zt_user` WHERE deleted  = '0' ORDER BY `id` 
  SELECT id, title FROM `zt_userquery` WHERE account  = 'admin' AND  module  = 'user' ORDER BY `id` asc 
  SELECT * FROM `zt_dept` WHERE `id` = '0' 
  SELECT * FROM `zt_dept` ORDER BY `grade` desc,`order` 

20161121 10:24:38: user-edit-2-company
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_user` WHERE id  = '2'
  SELECT t2.* FROM `zt_usergroup` AS t1  LEFT JOIN `zt_group` AS t2  ON t1.group = t2.id  WHERE t1.account  = 'productManager'
  SELECT * FROM `zt_dept` WHERE `id` = '0' 
  SELECT * FROM `zt_dept` ORDER BY `grade` desc,`order` 
  SELECT id, name FROM `zt_group`

20161121 10:34:39: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161121 10:35:53: user-edit-2-company
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_user` WHERE id  = '2'
  SELECT t2.* FROM `zt_usergroup` AS t1  LEFT JOIN `zt_group` AS t2  ON t1.group = t2.id  WHERE t1.account  = 'productManager'
  SELECT * FROM `zt_dept` WHERE `id` = '0' 
  SELECT * FROM `zt_dept` ORDER BY `grade` desc,`order` 
  SELECT id, name FROM `zt_group`

20161121 10:35:56: product
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 

20161121 10:35:57: product-browse
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_story` WHERE product IN ('1') AND  status IN ('','draft','active','changed') AND  deleted  = '0' ORDER BY `id` desc 
  SELECT COUNT(*) AS recTotal FROM `zt_story` WHERE product IN ('1') AND  status IN ('','draft','active','changed') AND  deleted  = '0' 
  SELECT * FROM `zt_story` WHERE product IN ('1') AND  status IN ('','draft','active','changed') AND  deleted  = '0' ORDER BY `id` desc   limit 0, 20 
  SELECT * FROM `zt_story` WHERE product IN ('1') AND  status IN ('','draft','active','changed') AND  deleted  = '0' ORDER BY `id` desc   limit 0, 20 
  SELECT id,title FROM `zt_productplan` WHERE product IN ('1') AND  deleted  = '0'
  SELECT * FROM `zt_storystage` WHERE branch IN ('0')
  SELECT * FROM `zt_story` WHERE product IN ('1') AND  status IN ('','draft','active','changed') AND  deleted  = '0' ORDER BY `id` desc   limit 0, 20 
  SELECT id,CONCAT(title, " [", begin, " ~ ", end, "]") as title FROM `zt_productplan` WHERE product IN ('1') AND  deleted  = '0' ORDER BY `begin` desc 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_module` WHERE root  = '1' AND  type  = 'story' ORDER BY `grade` desc,`order` 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT id,CONCAT(title, " [", begin, " ~ ", end, "]") as title FROM `zt_productplan` WHERE product IN ('1') AND  deleted  = '0' ORDER BY `begin` desc 
  SELECT DISTINCT story FROM `zt_case` WHERE story IN ('31','30','29','28','27','26','25','24','23','22','21','20','19','18','17','16','15','14','13','12')
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_module` WHERE root  = '1' AND  type  = 'story' ORDER BY `grade` desc,`order` 
  SELECT account, realname, deleted, INSTR(',pd,po,', role) AS roleOrder FROM `zt_user` WHERE deleted  = '0' ORDER BY `roleOrder` DESC,`account` 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_module` WHERE root  = '1' AND  type  = 'story' ORDER BY `grade` desc,`order` 
  SELECT * FROM `zt_branch` WHERE product  = '1' AND  deleted  = '0' ORDER BY `id` asc 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_storystage` WHERE story IN ('31','30','29','28','27','26','25','24','23','22','21','20','19','18','17','16','15','14','13','12')

20161121 10:36:00: story-create-1-0-0
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' AND  status  != 'closed' ORDER BY `isClosed`,`order` desc 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT account, realname, deleted, INSTR(',po,pd,', role) AS roleOrder FROM `zt_user` WHERE deleted  = '0' ORDER BY `roleOrder` DESC,`account` 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_module` WHERE root  = '1' AND  type  = 'story' ORDER BY `grade` desc,`order` 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT id,CONCAT(title, " [", begin, " ~ ", end, "]") as title FROM `zt_productplan` WHERE product IN ('1') AND  deleted  = '0' AND  end  > '2016-11-21' ORDER BY `begin` desc 
  SELECT id, listName FROM `zt_usercontact` WHERE account  = 'admin'

20161121 10:37:47: story-create-1-0-0
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' AND  status  != 'closed' ORDER BY `isClosed`,`order` desc 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT account, realname, deleted, INSTR(',po,pd,', role) AS roleOrder FROM `zt_user` WHERE deleted  = '0' ORDER BY `roleOrder` DESC,`account` 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_module` WHERE root  = '1' AND  type  = 'story' ORDER BY `grade` desc,`order` 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT id,CONCAT(title, " [", begin, " ~ ", end, "]") as title FROM `zt_productplan` WHERE product IN ('1') AND  deleted  = '0' AND  end  > '2016-11-21' ORDER BY `begin` desc 
  SELECT id, listName FROM `zt_usercontact` WHERE account  = 'admin'

20161121 10:38:59: story-create-1-0-0
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' AND  status  != 'closed' ORDER BY `isClosed`,`order` desc 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT account, realname, deleted, INSTR(',po,pd,', role) AS roleOrder FROM `zt_user` WHERE deleted  = '0' ORDER BY `roleOrder` DESC,`account` 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_module` WHERE root  = '1' AND  type  = 'story' ORDER BY `grade` desc,`order` 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT id,CONCAT(title, " [", begin, " ~ ", end, "]") as title FROM `zt_productplan` WHERE product IN ('1') AND  deleted  = '0' AND  end  > '2016-11-21' ORDER BY `begin` desc 
  SELECT id, listName FROM `zt_usercontact` WHERE account  = 'admin'

20161121 10:39:14: product-browse-1
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_story` WHERE product IN ('1') AND  status IN ('','draft','active','changed') AND  deleted  = '0' ORDER BY `id` desc 
  SELECT COUNT(*) AS recTotal FROM `zt_story` WHERE product IN ('1') AND  status IN ('','draft','active','changed') AND  deleted  = '0' 
  SELECT * FROM `zt_story` WHERE product IN ('1') AND  status IN ('','draft','active','changed') AND  deleted  = '0' ORDER BY `id` desc   limit 0, 20 
  SELECT * FROM `zt_story` WHERE product IN ('1') AND  status IN ('','draft','active','changed') AND  deleted  = '0' ORDER BY `id` desc   limit 0, 20 
  SELECT id,title FROM `zt_productplan` WHERE product IN ('1') AND  deleted  = '0'
  SELECT * FROM `zt_storystage` WHERE branch IN ('0')
  SELECT * FROM `zt_story` WHERE product IN ('1') AND  status IN ('','draft','active','changed') AND  deleted  = '0' ORDER BY `id` desc   limit 0, 20 
  SELECT id,CONCAT(title, " [", begin, " ~ ", end, "]") as title FROM `zt_productplan` WHERE product IN ('1') AND  deleted  = '0' ORDER BY `begin` desc 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_module` WHERE root  = '1' AND  type  = 'story' ORDER BY `grade` desc,`order` 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT id,CONCAT(title, " [", begin, " ~ ", end, "]") as title FROM `zt_productplan` WHERE product IN ('1') AND  deleted  = '0' ORDER BY `begin` desc 
  SELECT DISTINCT story FROM `zt_case` WHERE story IN ('31','30','29','28','27','26','25','24','23','22','21','20','19','18','17','16','15','14','13','12')
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_module` WHERE root  = '1' AND  type  = 'story' ORDER BY `grade` desc,`order` 
  SELECT account, realname, deleted, INSTR(',pd,po,', role) AS roleOrder FROM `zt_user` WHERE deleted  = '0' ORDER BY `roleOrder` DESC,`account` 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_module` WHERE root  = '1' AND  type  = 'story' ORDER BY `grade` desc,`order` 
  SELECT * FROM `zt_branch` WHERE product  = '1' AND  deleted  = '0' ORDER BY `id` asc 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_storystage` WHERE story IN ('31','30','29','28','27','26','25','24','23','22','21','20','19','18','17','16','15','14','13','12')

20161121 10:39:19: story-view-31
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_story` WHERE `id` = '31' 
  SELECT title,spec,spec2,spec3,verify FROM `zt_storyspec` WHERE story  = '31' AND  version  = '1'
  SELECT t1.project, t2.name, t2.status FROM `zt_projectstory` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project = t2.id  WHERE t1.story  = '31' ORDER BY t1.`project` DESC 
  SELECT id, name, assignedTo, project, status, consumed, `left` FROM `zt_task` WHERE story  = '31' AND  deleted  = '0' ORDER BY `id` DESC 
  SELECT * FROM `zt_storystage` WHERE story  = '31'
  SELECT id,title,branch FROM `zt_productplan` WHERE id IN ('3')
  SELECT * FROM `zt_file` WHERE objectType  = 'story' AND  objectID  = '31' AND  extra  != 'editor'
  SELECT name, id, type FROM `zt_product` WHERE `id` = '1' 
  SELECT title FROM `zt_productplan` WHERE `id` = '3' 
  SELECT id,title FROM `zt_bug` WHERE story  = '31' AND  deleted  = '0'
  SELECT id,title FROM `zt_bug` WHERE toStory  = '31'
  SELECT id,title FROM `zt_case` WHERE story  = '31' AND  deleted  = '0'
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT commiter, account, realname FROM `zt_user` WHERE commiter  != ''
  SELECT * FROM `zt_action` WHERE objectType  = 'story' AND  objectID  = '31' ORDER BY `date`,`id` 
  SELECT * FROM `zt_history` WHERE action IN ('173') ORDER BY `id` 
  SELECT * FROM `zt_story` WHERE id  = '31' OR product IN ('1') AND  status IN ('','draft','active','changed') AND  deleted  = '0'  ORDER BY `id` desc 

20161121 10:39:27: story-change-31
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_story` WHERE `id` = '31' 
  SELECT title,spec,spec2,spec3,verify FROM `zt_storyspec` WHERE story  = '31' AND  version  = '1'
  SELECT t1.project, t2.name, t2.status FROM `zt_projectstory` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project = t2.id  WHERE t1.story  = '31' ORDER BY t1.`project` DESC 
  SELECT id, name, assignedTo, project, status, consumed, `left` FROM `zt_task` WHERE story  = '31' AND  deleted  = '0' ORDER BY `id` DESC 
  SELECT * FROM `zt_storystage` WHERE story  = '31'
  SELECT id,title,branch FROM `zt_productplan` WHERE id IN ('3')
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_module` WHERE root  = '1' AND  type  = 'story' ORDER BY `grade` desc,`order` 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT id,CONCAT(title, " [", begin, " ~ ", end, "]") as title FROM `zt_productplan` WHERE product IN ('1') AND  deleted  = '0' ORDER BY `begin` desc 
  SELECT commiter, account, realname FROM `zt_user` WHERE commiter  != ''
  SELECT * FROM `zt_action` WHERE objectType  = 'story' AND  objectID  = '31' ORDER BY `date`,`id` 
  SELECT * FROM `zt_history` WHERE action IN ('173') ORDER BY `id` 
  SELECT * FROM `zt_bug` WHERE `story` = '31'  AND  status  != 'closed' AND  deleted  = '0' ORDER BY `id` desc 
  SELECT * FROM `zt_case` WHERE `story` = '31'  AND  deleted  = '0'
  SELECT account, realname, deleted, INSTR(',pd,po,', role) AS roleOrder FROM `zt_user` WHERE deleted  = '0' ORDER BY `roleOrder` DESC,`account` 

20161121 10:41:16: product-browse-1
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_story` WHERE product IN ('1') AND  status IN ('','draft','active','changed') AND  deleted  = '0' ORDER BY `id` desc 
  SELECT COUNT(*) AS recTotal FROM `zt_story` WHERE product IN ('1') AND  status IN ('','draft','active','changed') AND  deleted  = '0' 
  SELECT * FROM `zt_story` WHERE product IN ('1') AND  status IN ('','draft','active','changed') AND  deleted  = '0' ORDER BY `id` desc   limit 0, 20 
  SELECT * FROM `zt_story` WHERE product IN ('1') AND  status IN ('','draft','active','changed') AND  deleted  = '0' ORDER BY `id` desc   limit 0, 20 
  SELECT id,title FROM `zt_productplan` WHERE product IN ('1') AND  deleted  = '0'
  SELECT * FROM `zt_storystage` WHERE branch IN ('0')
  SELECT * FROM `zt_story` WHERE product IN ('1') AND  status IN ('','draft','active','changed') AND  deleted  = '0' ORDER BY `id` desc   limit 0, 20 
  SELECT id,CONCAT(title, " [", begin, " ~ ", end, "]") as title FROM `zt_productplan` WHERE product IN ('1') AND  deleted  = '0' ORDER BY `begin` desc 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_module` WHERE root  = '1' AND  type  = 'story' ORDER BY `grade` desc,`order` 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT id,CONCAT(title, " [", begin, " ~ ", end, "]") as title FROM `zt_productplan` WHERE product IN ('1') AND  deleted  = '0' ORDER BY `begin` desc 
  SELECT DISTINCT story FROM `zt_case` WHERE story IN ('31','30','29','28','27','26','25','24','23','22','21','20','19','18','17','16','15','14','13','12')
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_module` WHERE root  = '1' AND  type  = 'story' ORDER BY `grade` desc,`order` 
  SELECT account, realname, deleted, INSTR(',pd,po,', role) AS roleOrder FROM `zt_user` WHERE deleted  = '0' ORDER BY `roleOrder` DESC,`account` 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_module` WHERE root  = '1' AND  type  = 'story' ORDER BY `grade` desc,`order` 
  SELECT * FROM `zt_branch` WHERE product  = '1' AND  deleted  = '0' ORDER BY `id` asc 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_storystage` WHERE story IN ('31','30','29','28','27','26','25','24','23','22','21','20','19','18','17','16','15','14','13','12')

20161121 10:41:18: story-view-31
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_story` WHERE `id` = '31' 
  SELECT title,spec,spec2,spec3,verify FROM `zt_storyspec` WHERE story  = '31' AND  version  = '1'
  SELECT t1.project, t2.name, t2.status FROM `zt_projectstory` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project = t2.id  WHERE t1.story  = '31' ORDER BY t1.`project` DESC 
  SELECT id, name, assignedTo, project, status, consumed, `left` FROM `zt_task` WHERE story  = '31' AND  deleted  = '0' ORDER BY `id` DESC 
  SELECT * FROM `zt_storystage` WHERE story  = '31'
  SELECT id,title,branch FROM `zt_productplan` WHERE id IN ('3')
  SELECT * FROM `zt_file` WHERE objectType  = 'story' AND  objectID  = '31' AND  extra  != 'editor'
  SELECT name, id, type FROM `zt_product` WHERE `id` = '1' 
  SELECT title FROM `zt_productplan` WHERE `id` = '3' 
  SELECT id,title FROM `zt_bug` WHERE story  = '31' AND  deleted  = '0'
  SELECT id,title FROM `zt_bug` WHERE toStory  = '31'
  SELECT id,title FROM `zt_case` WHERE story  = '31' AND  deleted  = '0'
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT commiter, account, realname FROM `zt_user` WHERE commiter  != ''
  SELECT * FROM `zt_action` WHERE objectType  = 'story' AND  objectID  = '31' ORDER BY `date`,`id` 
  SELECT * FROM `zt_history` WHERE action IN ('173') ORDER BY `id` 

20161121 10:51:19: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161121 11:01:19: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161121 11:11:20: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161121 11:20:41: 
  SELECT * FROM `zt_company` ORDER BY `id`  LIMIT 1 
  SELECT * FROM `zt_config` WHERE owner IN ('system','') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_user` WHERE account  = 'admin' AND  deleted  = '0'

20161121 11:20:42: user-login-Lw==
  SELECT * FROM `zt_config` WHERE owner IN ('system','') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT account, realname, deleted FROM `zt_user` WHERE deleted  = '0' ORDER BY `account` 

20161121 11:21:20: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_config` WHERE 1 = 1  AND  owner IN ('system') AND  module IN ('common') AND  section IN ('global') AND  `key` IN ('sn')

20161121 11:31:20: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161121 11:41:21: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_config` WHERE 1 = 1  AND  owner IN ('system') AND  module IN ('common') AND  section IN ('global') AND  `key` IN ('sn')

20161121 11:51:21: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161121 12:01:22: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161121 12:11:22: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161121 12:21:23: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161121 12:31:23: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161121 12:41:24: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161121 12:51:24: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_config` WHERE 1 = 1  AND  owner IN ('system') AND  module IN ('common') AND  section IN ('global') AND  `key` IN ('sn')

20161121 13:01:25: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_config` WHERE 1 = 1  AND  owner IN ('system') AND  module IN ('common') AND  section IN ('global') AND  `key` IN ('sn')

20161121 13:11:25: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161121 13:21:26: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_config` WHERE 1 = 1  AND  owner IN ('system') AND  module IN ('common') AND  section IN ('global') AND  `key` IN ('sn')

20161121 13:31:26: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161121 13:41:27: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_config` WHERE 1 = 1  AND  owner IN ('system') AND  module IN ('common') AND  section IN ('global') AND  `key` IN ('sn')

20161121 13:51:27: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_config` WHERE 1 = 1  AND  owner IN ('system') AND  module IN ('common') AND  section IN ('global') AND  `key` IN ('sn')

20161121 13:55:11: 

20161121 13:55:24: 

20161121 13:55:28: 

20161121 13:59:56: 

20161121 14:08:51: 
  SELECT * FROM `zt_config` WHERE owner IN ('system','') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_user` WHERE account  = 'admin' AND  deleted  = '0'

20161121 14:08:57: 
  SELECT * FROM `zt_config` WHERE owner IN ('system','') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_user` WHERE account  = 'admin' AND  deleted  = '0'

20161121 14:08:57: 
  SELECT * FROM `zt_config` WHERE owner IN ('system','') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_user` WHERE account  = 'admin' AND  deleted  = '0'

20161121 14:08:58: user-login-Lw==
  SELECT * FROM `zt_config` WHERE owner IN ('system','') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT account, realname, deleted FROM `zt_user` WHERE deleted  = '0' ORDER BY `account` 

20161121 14:09:02: user-login-Lw==
  SELECT * FROM `zt_config` WHERE owner IN ('system','') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT locked FROM `zt_user` WHERE account  = 'admin'
  SELECT * FROM `zt_user` WHERE account  = 'admin' AND  deleted  = '0'
  UPDATE `zt_user` SET  visits = visits + 1, `ip` = '127.0.0.1', `last` = '1479708541' WHERE account  = 'admin'
  UPDATE `zt_user` SET  `fails` = '0', `locked` = '0000-00-00 00:00:00' WHERE account  = 'admin'
  SELECT t1.acl FROM `zt_group` AS t1  LEFT JOIN `zt_usergroup` AS t2  ON t1.id=t2.group  WHERE t2.account  = 'admin'
  SELECT module, method FROM `zt_usergroup` AS t1  LEFT JOIN `zt_grouppriv` AS t2  ON t1.group = t2.group  WHERE t1.account  = 'admin'
  SELECT `group` FROM `zt_usergroup` WHERE `account` = 'admin' 
  INSERT INTO `zt_action` SET `objectType` = 'user',`objectID` = '1',`actor` = 'admin',`action` = 'login',`date` = '2016-11-21 14:09:02',`comment` = '',`extra` = '',`product` = ',0,',`project` = '0'

20161121 14:09:02: 
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161121 14:09:03: my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE account  = 'admin' AND  module  = 'my' AND  hidden  = '0' ORDER BY `order` 

20161121 14:09:04: block-printBlock-1-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '1'

20161121 14:09:05: block-printBlock-6-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '6'
  SELECT t1.*, t2.id as projectID, t2.name as projectName, t3.id as storyID, t3.title as storyTitle, t3.status AS storyStatus, t3.version AS latestStoryVersion FROM `zt_task` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project = t2.id  LEFT JOIN `zt_story` AS t3  ON t1.story = t3.id  WHERE t1.deleted  = '0' AND  t1.assignedTo  = 'admin' ORDER BY `id` desc  LIMIT 15 
  SELECT t1.*, t2.id as projectID, t2.name as projectName, t3.id as storyID, t3.title as storyTitle, t3.status AS storyStatus, t3.version AS latestStoryVersion FROM `zt_task` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project = t2.id  LEFT JOIN `zt_story` AS t3  ON t1.story = t3.id  WHERE t1.deleted  = '0' AND  t1.assignedTo  = 'admin' ORDER BY `id` desc  LIMIT 15 

20161121 14:09:05: block-printBlock-4-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '4'
  SELECT * FROM `zt_todo` WHERE account  = 'admin' AND  date  >= '1970-01-01' AND  date  <= '2109-01-01' AND  status IN ('wait','doing') ORDER BY `date`,`status`,`begin`  LIMIT 20 
  SELECT * FROM `zt_todo` WHERE account  = 'admin' AND  date  >= '1970-01-01' AND  date  <= '2109-01-01' AND  status IN ('wait','doing') ORDER BY `date`,`status`,`begin`  LIMIT 20 

20161121 14:09:05: block-printBlock-3-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '3'
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  status  != 'done' AND  deleted  = '0' ORDER BY `order` desc 
  SELECT * FROM `zt_project` WHERE id IN ('2') ORDER BY `order` desc 
  SELECT COUNT(*) AS recTotal FROM `zt_project` WHERE id IN ('2') 
  SELECT * FROM `zt_project` WHERE id IN ('2') ORDER BY `order` desc 
  SELECT id, project, estimate, consumed, `left`, status, closedReason FROM `zt_task` WHERE project IN ('2') AND  deleted  = '0'
  SELECT project, date AS name, `left` AS value FROM `zt_burn` WHERE project IN ('2') ORDER BY `date` desc 

20161121 14:09:05: block-printBlock-2-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '2'
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT * FROM `zt_action` WHERE 1  AND  date  > '2016-11-21' AND  date  < '2016-11-22' AND  (1)  ORDER BY `date` desc 
  SELECT commiter, account, realname FROM `zt_user` WHERE commiter  != ''
  SELECT id, account AS name FROM `zt_user` WHERE id IN ('1')
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 

20161121 14:09:06: block-printBlock-7-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '7'
  SELECT * FROM `zt_bug` WHERE deleted  = '0' AND  assignedTo  = 'admin' ORDER BY `id` desc  LIMIT 15 

20161121 14:09:06: block-printBlock-5-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '5'
  SELECT * FROM `zt_product` WHERE deleted  = '0' AND  status  != 'closed' ORDER BY `order` desc 
  SELECT * FROM `zt_product` WHERE id IN ('2','1') ORDER BY `order` desc 
  SELECT COUNT(*) AS recTotal FROM `zt_product` WHERE id IN ('2','1') 
  SELECT * FROM `zt_product` WHERE id IN ('2','1') ORDER BY `order` desc 
  SELECT product, status, count(status) AS count FROM `zt_story` WHERE deleted  = '0' AND  product IN ('2','1') GROUP BY product, status
  SELECT product, count(*) AS count FROM `zt_productplan` WHERE deleted  = '0' AND  product IN ('2','1') AND  end  > '2016-11-21 14:09:06' GROUP BY product
  SELECT product, count(*) AS count FROM `zt_release` WHERE deleted  = '0' AND  product IN ('2','1') GROUP BY product
  SELECT product,count(*) AS conut FROM `zt_bug` WHERE deleted  = '0' AND  product IN ('2','1') GROUP BY product
  SELECT product,count(*) AS count FROM `zt_bug` WHERE status  = 'active' AND  deleted  = '0' AND  product IN ('2','1') GROUP BY product
  SELECT product,count(*) AS count FROM `zt_bug` WHERE AssignedTo  = '' AND  deleted  = '0' AND  product IN ('2','1') GROUP BY product

20161121 14:09:06: block-printBlock-8-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '8'
  SELECT t1.*, t2.name as productTitle FROM `zt_story` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.deleted  = '0' AND  assignedTo  = 'admin' ORDER BY `id` desc 
  SELECT COUNT(*) AS recTotal FROM `zt_story` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.deleted  = '0' AND  assignedTo  = 'admin' 
  SELECT t1.*, t2.name as productTitle FROM `zt_story` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.deleted  = '0' AND  assignedTo  = 'admin' ORDER BY `id` desc 
  SELECT t1.*, t2.name as productTitle FROM `zt_story` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.deleted  = '0' AND  assignedTo  = 'admin' ORDER BY `id` desc 
  SELECT t1.*, t2.name as productTitle FROM `zt_story` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.deleted  = '0' AND  assignedTo  = 'admin' ORDER BY `id` desc 
  SELECT id,title FROM `zt_productplan` WHERE product IN ('1') AND  deleted  = '0'
  SELECT * FROM `zt_storystage` WHERE branch IN ('0')

20161121 14:09:06: block-printBlock-9-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '9'
  SELECT t1.assignedTo AS assignedTo, t2.* FROM `zt_testrun` AS t1  LEFT JOIN `zt_case` AS t2  ON t1.case = t2.id  LEFT JOIN `zt_testtask` AS t3  ON t1.task = t3.id  WHERE t1.assignedTo  = 'admin' AND  t1.status  != 'done' AND  t3.status  != 'done' AND  t3.deleted  = '0' AND  t2.deleted  = '0' ORDER BY `id` desc  LIMIT 15 

20161121 14:09:07: my-story
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT t1.*, t2.name as productTitle FROM `zt_story` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.deleted  = '0' AND  assignedTo  = 'admin' ORDER BY `id` desc 
  SELECT COUNT(*) AS recTotal FROM `zt_story` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.deleted  = '0' AND  assignedTo  = 'admin' 
  SELECT t1.*, t2.name as productTitle FROM `zt_story` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.deleted  = '0' AND  assignedTo  = 'admin' ORDER BY `id` desc 
  SELECT t1.*, t2.name as productTitle FROM `zt_story` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.deleted  = '0' AND  assignedTo  = 'admin' ORDER BY `id` desc 
  SELECT t1.*, t2.name as productTitle FROM `zt_story` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.deleted  = '0' AND  assignedTo  = 'admin' ORDER BY `id` desc 
  SELECT id,title FROM `zt_productplan` WHERE product IN ('1') AND  deleted  = '0'
  SELECT * FROM `zt_storystage` WHERE branch IN ('0')
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 

20161121 14:09:10: product
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 

20161121 14:09:12: product-browse
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_story` WHERE product IN ('1') AND  status IN ('','draft','active','changed') AND  deleted  = '0' ORDER BY `id` desc 
  SELECT COUNT(*) AS recTotal FROM `zt_story` WHERE product IN ('1') AND  status IN ('','draft','active','changed') AND  deleted  = '0' 
  SELECT * FROM `zt_story` WHERE product IN ('1') AND  status IN ('','draft','active','changed') AND  deleted  = '0' ORDER BY `id` desc   limit 0, 20 
  SELECT * FROM `zt_story` WHERE product IN ('1') AND  status IN ('','draft','active','changed') AND  deleted  = '0' ORDER BY `id` desc   limit 0, 20 
  SELECT id,title FROM `zt_productplan` WHERE product IN ('1') AND  deleted  = '0'
  SELECT * FROM `zt_storystage` WHERE branch IN ('0')
  SELECT * FROM `zt_story` WHERE product IN ('1') AND  status IN ('','draft','active','changed') AND  deleted  = '0' ORDER BY `id` desc   limit 0, 20 
  SELECT id,CONCAT(title, " [", begin, " ~ ", end, "]") as title FROM `zt_productplan` WHERE product IN ('1') AND  deleted  = '0' ORDER BY `begin` desc 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_module` WHERE root  = '1' AND  type  = 'story' ORDER BY `grade` desc,`order` 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT id,CONCAT(title, " [", begin, " ~ ", end, "]") as title FROM `zt_productplan` WHERE product IN ('1') AND  deleted  = '0' ORDER BY `begin` desc 
  SELECT DISTINCT story FROM `zt_case` WHERE story IN ('31','30','29','28','27','26','25','24','23','22','21','20','19','18','17','16','15','14','13','12')
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_module` WHERE root  = '1' AND  type  = 'story' ORDER BY `grade` desc,`order` 
  SELECT account, realname, deleted, INSTR(',pd,po,', role) AS roleOrder FROM `zt_user` WHERE deleted  = '0' ORDER BY `roleOrder` DESC,`account` 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_module` WHERE root  = '1' AND  type  = 'story' ORDER BY `grade` desc,`order` 
  SELECT * FROM `zt_branch` WHERE product  = '1' AND  deleted  = '0' ORDER BY `id` asc 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_storystage` WHERE story IN ('31','30','29','28','27','26','25','24','23','22','21','20','19','18','17','16','15','14','13','12')

20161121 14:09:15: story-create-1-0-0
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' AND  status  != 'closed' ORDER BY `isClosed`,`order` desc 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT account, realname, deleted, INSTR(',po,pd,', role) AS roleOrder FROM `zt_user` WHERE deleted  = '0' ORDER BY `roleOrder` DESC,`account` 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_module` WHERE root  = '1' AND  type  = 'story' ORDER BY `grade` desc,`order` 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT id,CONCAT(title, " [", begin, " ~ ", end, "]") as title FROM `zt_productplan` WHERE product IN ('1') AND  deleted  = '0' AND  end  > '2016-11-21' ORDER BY `begin` desc 
  SELECT id, listName FROM `zt_usercontact` WHERE account  = 'admin'

20161121 14:09:44: story-create-1-0-0
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT id,title FROM `zt_story` WHERE deleted  = '0' AND  title IN ('11') AND  openedDate  >= '2016-11-21 14:08:44' AND  product=1 
  INSERT INTO `zt_story` SET `product` = '1',`module` = '0',`plan` = '3',`source` = '',`sourceNote` = '',`assignedTo` = 'productManager',`color` = '',`title` = '11',`pri` = '0',`estimate` = '',`mailto` = ',tester1',`keywords` = '111',`openedBy` = 'admin',`openedDate` = '2016-11-21 14:09:43',`assignedDate` = '2016-11-21 14:09:43',`version` = '1',`status` = 'draft',`stage` = 'planned'
  INSERT INTO `zt_storyspec` SET `story` = '32',`version` = '1',`title` = '11',`spec` = '11',`spec2` = '111',`spec3` = '1111',`verify` = '111'
  DELETE FROM `zt_storystage` WHERE story  = '32'
  SELECT * FROM `zt_story` WHERE `id` = '32' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT t1.project,t3.branch FROM `zt_projectstory` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project = t2.id  LEFT JOIN `zt_projectproduct` AS t3  ON t1.project = t3.project  WHERE t1.story  = '32' AND  t2.deleted  = '0'
  UPDATE `zt_story` SET  `stage` = 'wait' WHERE id  = '32' AND  plan  = ''
  UPDATE `zt_story` SET  `stage` = 'planned' WHERE id  = '32' AND  (plan != '' AND plan != '0') 
  SELECT type,project,status FROM `zt_task` WHERE project IN ('') AND  story  = '32' AND  type IN ('devel','test') AND  status  != 'cancel' AND  closedReason  != 'cancel' AND  deleted  = '0'
  SELECT * FROM `zt_release` WHERE CONCAT(',', stories, ',')  LIKE '%,32,%' AND  deleted  = '0'
  SELECT product FROM `zt_story` WHERE id  = '32'
  SELECT project FROM `zt_projectstory` WHERE story  = '32'
  INSERT INTO `zt_action` SET `objectType` = 'story',`objectID` = '32',`actor` = 'admin',`action` = 'opened',`date` = '2016-11-21 14:09:44',`comment` = '',`extra` = '',`product` = ',1,',`project` = '0'
  SELECT * FROM `zt_story` WHERE `id` = '32' 
  SELECT title,spec,spec2,spec3,verify FROM `zt_storyspec` WHERE story  = '32' AND  version  = '1'
  SELECT t1.project, t2.name, t2.status FROM `zt_projectstory` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project = t2.id  WHERE t1.story  = '32' ORDER BY t1.`project` DESC 
  SELECT id, name, assignedTo, project, status, consumed, `left` FROM `zt_task` WHERE story  = '32' AND  deleted  = '0' ORDER BY `id` DESC 
  SELECT * FROM `zt_storystage` WHERE story  = '32'
  SELECT id,title,branch FROM `zt_productplan` WHERE id IN ('3')
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT commiter, account, realname FROM `zt_user` WHERE commiter  != ''
  SELECT * FROM `zt_action` WHERE objectType  = 'story' AND  objectID  = '32' ORDER BY `date`,`id` 
  SELECT * FROM `zt_history` WHERE action IN ('176') ORDER BY `id` 
  SELECT * FROM `zt_history` WHERE action IN ('176') ORDER BY `id` 
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 

20161121 14:09:44: story-view-32
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_story` WHERE `id` = '32' 
  SELECT title,spec,spec2,spec3,verify FROM `zt_storyspec` WHERE story  = '32' AND  version  = '1'
  SELECT t1.project, t2.name, t2.status FROM `zt_projectstory` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project = t2.id  WHERE t1.story  = '32' ORDER BY t1.`project` DESC 
  SELECT id, name, assignedTo, project, status, consumed, `left` FROM `zt_task` WHERE story  = '32' AND  deleted  = '0' ORDER BY `id` DESC 
  SELECT * FROM `zt_storystage` WHERE story  = '32'
  SELECT id,title,branch FROM `zt_productplan` WHERE id IN ('3')
  SELECT * FROM `zt_file` WHERE objectType  = 'story' AND  objectID  = '32' AND  extra  != 'editor'
  SELECT name, id, type FROM `zt_product` WHERE `id` = '1' 
  SELECT title FROM `zt_productplan` WHERE `id` = '3' 
  SELECT id,title FROM `zt_bug` WHERE story  = '32' AND  deleted  = '0'
  SELECT id,title FROM `zt_bug` WHERE toStory  = '32'
  SELECT id,title FROM `zt_case` WHERE story  = '32' AND  deleted  = '0'
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT commiter, account, realname FROM `zt_user` WHERE commiter  != ''
  SELECT * FROM `zt_action` WHERE objectType  = 'story' AND  objectID  = '32' ORDER BY `date`,`id` 
  SELECT * FROM `zt_history` WHERE action IN ('176') ORDER BY `id` 
  SELECT * FROM `zt_story` WHERE id  = '32' OR product IN ('1') AND  status IN ('','draft','active','changed') AND  deleted  = '0'  ORDER BY `id` desc 

20161121 14:09:52: story-change-32
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_story` WHERE `id` = '32' 
  SELECT title,spec,spec2,spec3,verify FROM `zt_storyspec` WHERE story  = '32' AND  version  = '1'
  SELECT t1.project, t2.name, t2.status FROM `zt_projectstory` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project = t2.id  WHERE t1.story  = '32' ORDER BY t1.`project` DESC 
  SELECT id, name, assignedTo, project, status, consumed, `left` FROM `zt_task` WHERE story  = '32' AND  deleted  = '0' ORDER BY `id` DESC 
  SELECT * FROM `zt_storystage` WHERE story  = '32'
  SELECT id,title,branch FROM `zt_productplan` WHERE id IN ('3')
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_module` WHERE root  = '1' AND  type  = 'story' ORDER BY `grade` desc,`order` 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT id,CONCAT(title, " [", begin, " ~ ", end, "]") as title FROM `zt_productplan` WHERE product IN ('1') AND  deleted  = '0' ORDER BY `begin` desc 
  SELECT commiter, account, realname FROM `zt_user` WHERE commiter  != ''
  SELECT * FROM `zt_action` WHERE objectType  = 'story' AND  objectID  = '32' ORDER BY `date`,`id` 
  SELECT * FROM `zt_history` WHERE action IN ('176') ORDER BY `id` 
  SELECT * FROM `zt_bug` WHERE `story` = '32'  AND  status  != 'closed' AND  deleted  = '0' ORDER BY `id` desc 
  SELECT * FROM `zt_case` WHERE `story` = '32'  AND  deleted  = '0'
  SELECT account, realname, deleted, INSTR(',pd,po,', role) AS roleOrder FROM `zt_user` WHERE deleted  = '0' ORDER BY `roleOrder` DESC,`account` 
  SELECT account, realname, deleted, INSTR(',pd,po,', role) AS roleOrder FROM `zt_user` WHERE account IN ('productManager')

20161121 14:10:06: story-change-32
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_story` WHERE `id` = '32' 
  SELECT title,spec,spec2,spec3,verify FROM `zt_storyspec` WHERE story  = '32' AND  version  = '1'
  SELECT t1.project, t2.name, t2.status FROM `zt_projectstory` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project = t2.id  WHERE t1.story  = '32' ORDER BY t1.`project` DESC 
  SELECT id, name, assignedTo, project, status, consumed, `left` FROM `zt_task` WHERE story  = '32' AND  deleted  = '0' ORDER BY `id` DESC 
  SELECT * FROM `zt_storystage` WHERE story  = '32'
  SELECT id,title,branch FROM `zt_productplan` WHERE id IN ('3')
  UPDATE `zt_story` SET `assignedTo` = 'productManager',`title` = '11',`lastEditedDate` = '2016-11-21 14:10:06',`lastEditedBy` = 'admin',`version` = '2',`reviewedBy` = '',`closedBy` = '',`closedReason` = '' WHERE id  = '32'
  INSERT INTO `zt_storyspec` SET `story` = '32',`version` = '2',`title` = '11',`spec` = '11',`spec2` = '111222',`spec3` = '111122',`verify` = '11122'
  SELECT version FROM `zt_story` WHERE `id` = '32' 
  SELECT product FROM `zt_story` WHERE id  = '32'
  SELECT project FROM `zt_projectstory` WHERE story  = '32'
  INSERT INTO `zt_action` SET `objectType` = 'story',`objectID` = '32',`actor` = 'admin',`action` = 'changed',`date` = '2016-11-21 14:10:06',`comment` = '22',`extra` = '',`product` = ',1,',`project` = '0'
  INSERT INTO `zt_history` SET `field` = 'spec2',`old` = '111',`new` = '111222',`diff` = '',`action` = '177'
  INSERT INTO `zt_history` SET `field` = 'spec3',`old` = '1111',`new` = '111122',`diff` = '',`action` = '177'
  INSERT INTO `zt_history` SET `field` = 'verify',`old` = '111',`new` = '11122',`diff` = '001- <del>111</del>\n001+ <ins>11122</ins>',`action` = '177'
  INSERT INTO `zt_history` SET `field` = 'version',`old` = '1',`new` = '2',`diff` = '',`action` = '177'
  SELECT * FROM `zt_story` WHERE `id` = '32' 
  SELECT title,spec,spec2,spec3,verify FROM `zt_storyspec` WHERE story  = '32' AND  version  = '2'
  SELECT t1.project, t2.name, t2.status FROM `zt_projectstory` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project = t2.id  WHERE t1.story  = '32' ORDER BY t1.`project` DESC 
  SELECT id, name, assignedTo, project, status, consumed, `left` FROM `zt_task` WHERE story  = '32' AND  deleted  = '0' ORDER BY `id` DESC 
  SELECT * FROM `zt_storystage` WHERE story  = '32'
  SELECT id,title,branch FROM `zt_productplan` WHERE id IN ('3')
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT commiter, account, realname FROM `zt_user` WHERE commiter  != ''
  SELECT * FROM `zt_action` WHERE objectType  = 'story' AND  objectID  = '32' ORDER BY `date`,`id` 
  SELECT * FROM `zt_history` WHERE action IN ('176','177') ORDER BY `id` 
  SELECT * FROM `zt_history` WHERE action IN ('177') ORDER BY `id` 
  SELECT project FROM `zt_projectstory` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project = t2.id  WHERE t1.story  = '32' AND  t2.status  = 'doing' AND  t2.deleted  = '0'
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 

20161121 14:10:06: story-view-32
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_story` WHERE `id` = '32' 
  SELECT title,spec,spec2,spec3,verify FROM `zt_storyspec` WHERE story  = '32' AND  version  = '2'
  SELECT t1.project, t2.name, t2.status FROM `zt_projectstory` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project = t2.id  WHERE t1.story  = '32' ORDER BY t1.`project` DESC 
  SELECT id, name, assignedTo, project, status, consumed, `left` FROM `zt_task` WHERE story  = '32' AND  deleted  = '0' ORDER BY `id` DESC 
  SELECT * FROM `zt_storystage` WHERE story  = '32'
  SELECT id,title,branch FROM `zt_productplan` WHERE id IN ('3')
  SELECT * FROM `zt_file` WHERE objectType  = 'story' AND  objectID  = '32' AND  extra  != 'editor'
  SELECT name, id, type FROM `zt_product` WHERE `id` = '1' 
  SELECT title FROM `zt_productplan` WHERE `id` = '3' 
  SELECT id,title FROM `zt_bug` WHERE story  = '32' AND  deleted  = '0'
  SELECT id,title FROM `zt_bug` WHERE toStory  = '32'
  SELECT id,title FROM `zt_case` WHERE story  = '32' AND  deleted  = '0'
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT commiter, account, realname FROM `zt_user` WHERE commiter  != ''
  SELECT * FROM `zt_action` WHERE objectType  = 'story' AND  objectID  = '32' ORDER BY `date`,`id` 
  SELECT * FROM `zt_history` WHERE action IN ('176','177') ORDER BY `id` 

20161121 14:12:17: product-browse-1
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_story` WHERE product IN ('1') AND  status IN ('','draft','active','changed') AND  deleted  = '0' ORDER BY `id` desc 
  SELECT COUNT(*) AS recTotal FROM `zt_story` WHERE product IN ('1') AND  status IN ('','draft','active','changed') AND  deleted  = '0' 
  SELECT * FROM `zt_story` WHERE product IN ('1') AND  status IN ('','draft','active','changed') AND  deleted  = '0' ORDER BY `id` desc   limit 0, 20 
  SELECT * FROM `zt_story` WHERE product IN ('1') AND  status IN ('','draft','active','changed') AND  deleted  = '0' ORDER BY `id` desc   limit 0, 20 
  SELECT id,title FROM `zt_productplan` WHERE product IN ('1') AND  deleted  = '0'
  SELECT * FROM `zt_storystage` WHERE branch IN ('0')
  SELECT * FROM `zt_story` WHERE product IN ('1') AND  status IN ('','draft','active','changed') AND  deleted  = '0' ORDER BY `id` desc   limit 0, 20 
  SELECT id,CONCAT(title, " [", begin, " ~ ", end, "]") as title FROM `zt_productplan` WHERE product IN ('1') AND  deleted  = '0' ORDER BY `begin` desc 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_module` WHERE root  = '1' AND  type  = 'story' ORDER BY `grade` desc,`order` 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT id,CONCAT(title, " [", begin, " ~ ", end, "]") as title FROM `zt_productplan` WHERE product IN ('1') AND  deleted  = '0' ORDER BY `begin` desc 
  SELECT DISTINCT story FROM `zt_case` WHERE story IN ('32','31','30','29','28','27','26','25','24','23','22','21','20','19','18','17','16','15','14','13')
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_module` WHERE root  = '1' AND  type  = 'story' ORDER BY `grade` desc,`order` 
  SELECT account, realname, deleted, INSTR(',pd,po,', role) AS roleOrder FROM `zt_user` WHERE deleted  = '0' ORDER BY `roleOrder` DESC,`account` 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_module` WHERE root  = '1' AND  type  = 'story' ORDER BY `grade` desc,`order` 
  SELECT * FROM `zt_branch` WHERE product  = '1' AND  deleted  = '0' ORDER BY `id` asc 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_storystage` WHERE story IN ('32','31','30','29','28','27','26','25','24','23','22','21','20','19','18','17','16','15','14','13')

20161121 14:12:21: story-export-1-id_desc
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT id,title,content,public FROM `zt_usertpl` WHERE type  = 'exportstory' AND ( account  = 'admin' OR public  = '1') ORDER BY `id` 

20161121 14:12:26: story-export-1-id_desc
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_story` WHERE product IN ('1') AND  status IN ('','draft','active','changed') AND  deleted  = '0'  AND  id IN ('32') ORDER BY `id` desc 
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 
  SELECT id, name FROM `zt_module` WHERE id IN ('0')
  SELECT id, title FROM `zt_productplan` WHERE id IN ('3')
  SELECT id,title FROM `zt_story` WHERE id IN ('')
  SELECT id, objectID, pathname, title FROM `zt_file` WHERE objectType  = 'story' AND  objectID IN ('32')
  SELECT * FROM `zt_storyspec` WHERE `story` IN ('32') ORDER BY `version` desc 
  SELECT * FROM `zt_product` WHERE id  = '1'
  SELECT t2.id, t2.path, t2.name, t2.parent, t2.grade, t1.id as kindID, t2.order FROM `zt_story` AS t1  LEFT JOIN `zt_module` AS t2  ON t1.module=t2.id  WHERE t1.id IN ('32') ORDER BY t2.`grade` asc,t2.`order` asc 
  SELECT id,path,name,parent,grade,`order` FROM `zt_module` WHERE id IN ('') ORDER BY `grade` asc,`order` asc 

20161121 14:13:31: story-create-1-0-0
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' AND  status  != 'closed' ORDER BY `isClosed`,`order` desc 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT account, realname, deleted, INSTR(',po,pd,', role) AS roleOrder FROM `zt_user` WHERE deleted  = '0' ORDER BY `roleOrder` DESC,`account` 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_module` WHERE root  = '1' AND  type  = 'story' ORDER BY `grade` desc,`order` 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT id,CONCAT(title, " [", begin, " ~ ", end, "]") as title FROM `zt_productplan` WHERE product IN ('1') AND  deleted  = '0' AND  end  > '2016-11-21' ORDER BY `begin` desc 
  SELECT id, listName FROM `zt_usercontact` WHERE account  = 'admin'

20161121 14:14:42: product-browse-1
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_story` WHERE product IN ('1') AND  status IN ('','draft','active','changed') AND  deleted  = '0' ORDER BY `id` desc 
  SELECT COUNT(*) AS recTotal FROM `zt_story` WHERE product IN ('1') AND  status IN ('','draft','active','changed') AND  deleted  = '0' 
  SELECT * FROM `zt_story` WHERE product IN ('1') AND  status IN ('','draft','active','changed') AND  deleted  = '0' ORDER BY `id` desc   limit 0, 20 
  SELECT * FROM `zt_story` WHERE product IN ('1') AND  status IN ('','draft','active','changed') AND  deleted  = '0' ORDER BY `id` desc   limit 0, 20 
  SELECT id,title FROM `zt_productplan` WHERE product IN ('1') AND  deleted  = '0'
  SELECT * FROM `zt_storystage` WHERE branch IN ('0')
  SELECT * FROM `zt_story` WHERE product IN ('1') AND  status IN ('','draft','active','changed') AND  deleted  = '0' ORDER BY `id` desc   limit 0, 20 
  SELECT id,CONCAT(title, " [", begin, " ~ ", end, "]") as title FROM `zt_productplan` WHERE product IN ('1') AND  deleted  = '0' ORDER BY `begin` desc 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_module` WHERE root  = '1' AND  type  = 'story' ORDER BY `grade` desc,`order` 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT id,CONCAT(title, " [", begin, " ~ ", end, "]") as title FROM `zt_productplan` WHERE product IN ('1') AND  deleted  = '0' ORDER BY `begin` desc 
  SELECT DISTINCT story FROM `zt_case` WHERE story IN ('32','31','30','29','28','27','26','25','24','23','22','21','20','19','18','17','16','15','14','13')
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_module` WHERE root  = '1' AND  type  = 'story' ORDER BY `grade` desc,`order` 
  SELECT account, realname, deleted, INSTR(',pd,po,', role) AS roleOrder FROM `zt_user` WHERE deleted  = '0' ORDER BY `roleOrder` DESC,`account` 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_module` WHERE root  = '1' AND  type  = 'story' ORDER BY `grade` desc,`order` 
  SELECT * FROM `zt_branch` WHERE product  = '1' AND  deleted  = '0' ORDER BY `id` asc 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_storystage` WHERE story IN ('32','31','30','29','28','27','26','25','24','23','22','21','20','19','18','17','16','15','14','13')

20161121 14:14:46: story-view-32
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_story` WHERE `id` = '32' 
  SELECT title,spec,spec2,spec3,verify FROM `zt_storyspec` WHERE story  = '32' AND  version  = '2'
  SELECT t1.project, t2.name, t2.status FROM `zt_projectstory` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project = t2.id  WHERE t1.story  = '32' ORDER BY t1.`project` DESC 
  SELECT id, name, assignedTo, project, status, consumed, `left` FROM `zt_task` WHERE story  = '32' AND  deleted  = '0' ORDER BY `id` DESC 
  SELECT * FROM `zt_storystage` WHERE story  = '32'
  SELECT id,title,branch FROM `zt_productplan` WHERE id IN ('3')
  SELECT * FROM `zt_file` WHERE objectType  = 'story' AND  objectID  = '32' AND  extra  != 'editor'
  SELECT name, id, type FROM `zt_product` WHERE `id` = '1' 
  SELECT title FROM `zt_productplan` WHERE `id` = '3' 
  SELECT id,title FROM `zt_bug` WHERE story  = '32' AND  deleted  = '0'
  SELECT id,title FROM `zt_bug` WHERE toStory  = '32'
  SELECT id,title FROM `zt_case` WHERE story  = '32' AND  deleted  = '0'
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT commiter, account, realname FROM `zt_user` WHERE commiter  != ''
  SELECT * FROM `zt_action` WHERE objectType  = 'story' AND  objectID  = '32' ORDER BY `date`,`id` 
  SELECT * FROM `zt_history` WHERE action IN ('176','177') ORDER BY `id` 

20161121 14:15:28: product-browse-1
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_story` WHERE product IN ('1') AND  status IN ('','draft','active','changed') AND  deleted  = '0' ORDER BY `id` desc 
  SELECT COUNT(*) AS recTotal FROM `zt_story` WHERE product IN ('1') AND  status IN ('','draft','active','changed') AND  deleted  = '0' 
  SELECT * FROM `zt_story` WHERE product IN ('1') AND  status IN ('','draft','active','changed') AND  deleted  = '0' ORDER BY `id` desc   limit 0, 20 
  SELECT * FROM `zt_story` WHERE product IN ('1') AND  status IN ('','draft','active','changed') AND  deleted  = '0' ORDER BY `id` desc   limit 0, 20 
  SELECT id,title FROM `zt_productplan` WHERE product IN ('1') AND  deleted  = '0'
  SELECT * FROM `zt_storystage` WHERE branch IN ('0')
  SELECT * FROM `zt_story` WHERE product IN ('1') AND  status IN ('','draft','active','changed') AND  deleted  = '0' ORDER BY `id` desc   limit 0, 20 
  SELECT id,CONCAT(title, " [", begin, " ~ ", end, "]") as title FROM `zt_productplan` WHERE product IN ('1') AND  deleted  = '0' ORDER BY `begin` desc 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_module` WHERE root  = '1' AND  type  = 'story' ORDER BY `grade` desc,`order` 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT id,CONCAT(title, " [", begin, " ~ ", end, "]") as title FROM `zt_productplan` WHERE product IN ('1') AND  deleted  = '0' ORDER BY `begin` desc 
  SELECT DISTINCT story FROM `zt_case` WHERE story IN ('32','31','30','29','28','27','26','25','24','23','22','21','20','19','18','17','16','15','14','13')
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_module` WHERE root  = '1' AND  type  = 'story' ORDER BY `grade` desc,`order` 
  SELECT account, realname, deleted, INSTR(',pd,po,', role) AS roleOrder FROM `zt_user` WHERE deleted  = '0' ORDER BY `roleOrder` DESC,`account` 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_module` WHERE root  = '1' AND  type  = 'story' ORDER BY `grade` desc,`order` 
  SELECT * FROM `zt_branch` WHERE product  = '1' AND  deleted  = '0' ORDER BY `id` asc 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_storystage` WHERE story IN ('32','31','30','29','28','27','26','25','24','23','22','21','20','19','18','17','16','15','14','13')

20161121 14:15:31: story-view-32
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_story` WHERE `id` = '32' 
  SELECT title,spec,spec2,spec3,verify FROM `zt_storyspec` WHERE story  = '32' AND  version  = '2'
  SELECT t1.project, t2.name, t2.status FROM `zt_projectstory` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project = t2.id  WHERE t1.story  = '32' ORDER BY t1.`project` DESC 
  SELECT id, name, assignedTo, project, status, consumed, `left` FROM `zt_task` WHERE story  = '32' AND  deleted  = '0' ORDER BY `id` DESC 
  SELECT * FROM `zt_storystage` WHERE story  = '32'
  SELECT id,title,branch FROM `zt_productplan` WHERE id IN ('3')
  SELECT * FROM `zt_file` WHERE objectType  = 'story' AND  objectID  = '32' AND  extra  != 'editor'
  SELECT name, id, type FROM `zt_product` WHERE `id` = '1' 
  SELECT title FROM `zt_productplan` WHERE `id` = '3' 
  SELECT id,title FROM `zt_bug` WHERE story  = '32' AND  deleted  = '0'
  SELECT id,title FROM `zt_bug` WHERE toStory  = '32'
  SELECT id,title FROM `zt_case` WHERE story  = '32' AND  deleted  = '0'
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT commiter, account, realname FROM `zt_user` WHERE commiter  != ''
  SELECT * FROM `zt_action` WHERE objectType  = 'story' AND  objectID  = '32' ORDER BY `date`,`id` 
  SELECT * FROM `zt_history` WHERE action IN ('176','177') ORDER BY `id` 

20161121 14:15:36: story-edit-32
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_story` WHERE `id` = '32' 
  SELECT title,spec,spec2,spec3,verify FROM `zt_storyspec` WHERE story  = '32' AND  version  = '2'
  SELECT t1.project, t2.name, t2.status FROM `zt_projectstory` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project = t2.id  WHERE t1.story  = '32' ORDER BY t1.`project` DESC 
  SELECT id, name, assignedTo, project, status, consumed, `left` FROM `zt_task` WHERE story  = '32' AND  deleted  = '0' ORDER BY `id` DESC 
  SELECT * FROM `zt_storystage` WHERE story  = '32'
  SELECT id,title,branch FROM `zt_productplan` WHERE id IN ('3')
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_module` WHERE root  = '1' AND  type  = 'story' ORDER BY `grade` desc,`order` 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT id,CONCAT(title, " [", begin, " ~ ", end, "]") as title FROM `zt_productplan` WHERE product IN ('1') AND  deleted  = '0' ORDER BY `begin` desc 
  SELECT commiter, account, realname FROM `zt_user` WHERE commiter  != ''
  SELECT * FROM `zt_action` WHERE objectType  = 'story' AND  objectID  = '32' ORDER BY `date`,`id` 
  SELECT * FROM `zt_history` WHERE action IN ('176','177') ORDER BY `id` 
  SELECT * FROM `zt_story` WHERE `id` = '32' 
  SELECT title,spec,spec2,spec3,verify FROM `zt_storyspec` WHERE story  = '32' AND  version  = '2'
  SELECT t1.project, t2.name, t2.status FROM `zt_projectstory` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project = t2.id  WHERE t1.story  = '32' ORDER BY t1.`project` DESC 
  SELECT id, name, assignedTo, project, status, consumed, `left` FROM `zt_task` WHERE story  = '32' AND  deleted  = '0' ORDER BY `id` DESC 
  SELECT * FROM `zt_storystage` WHERE story  = '32'
  SELECT id,title,branch FROM `zt_productplan` WHERE id IN ('3')
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT account, realname, deleted, INSTR(',pd,po,', role) AS roleOrder FROM `zt_user` WHERE deleted  = '0' ORDER BY `roleOrder` DESC,`account` 
  SELECT account, realname, deleted, INSTR(',pd,po,', role) AS roleOrder FROM `zt_user` WHERE account IN ('productManager','admin','')

20161121 14:15:49: story-change-32
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_story` WHERE `id` = '32' 
  SELECT title,spec,spec2,spec3,verify FROM `zt_storyspec` WHERE story  = '32' AND  version  = '2'
  SELECT t1.project, t2.name, t2.status FROM `zt_projectstory` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project = t2.id  WHERE t1.story  = '32' ORDER BY t1.`project` DESC 
  SELECT id, name, assignedTo, project, status, consumed, `left` FROM `zt_task` WHERE story  = '32' AND  deleted  = '0' ORDER BY `id` DESC 
  SELECT * FROM `zt_storystage` WHERE story  = '32'
  SELECT id,title,branch FROM `zt_productplan` WHERE id IN ('3')
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_module` WHERE root  = '1' AND  type  = 'story' ORDER BY `grade` desc,`order` 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT id,CONCAT(title, " [", begin, " ~ ", end, "]") as title FROM `zt_productplan` WHERE product IN ('1') AND  deleted  = '0' ORDER BY `begin` desc 
  SELECT commiter, account, realname FROM `zt_user` WHERE commiter  != ''
  SELECT * FROM `zt_action` WHERE objectType  = 'story' AND  objectID  = '32' ORDER BY `date`,`id` 
  SELECT * FROM `zt_history` WHERE action IN ('176','177') ORDER BY `id` 
  SELECT * FROM `zt_bug` WHERE `story` = '32'  AND  status  != 'closed' AND  deleted  = '0' ORDER BY `id` desc 
  SELECT * FROM `zt_case` WHERE `story` = '32'  AND  deleted  = '0'
  SELECT account, realname, deleted, INSTR(',pd,po,', role) AS roleOrder FROM `zt_user` WHERE deleted  = '0' ORDER BY `roleOrder` DESC,`account` 
  SELECT account, realname, deleted, INSTR(',pd,po,', role) AS roleOrder FROM `zt_user` WHERE account IN ('productManager')

20161121 14:17:15: product-browse-1
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_story` WHERE product IN ('1') AND  status IN ('','draft','active','changed') AND  deleted  = '0' ORDER BY `id` desc 
  SELECT COUNT(*) AS recTotal FROM `zt_story` WHERE product IN ('1') AND  status IN ('','draft','active','changed') AND  deleted  = '0' 
  SELECT * FROM `zt_story` WHERE product IN ('1') AND  status IN ('','draft','active','changed') AND  deleted  = '0' ORDER BY `id` desc   limit 0, 20 
  SELECT * FROM `zt_story` WHERE product IN ('1') AND  status IN ('','draft','active','changed') AND  deleted  = '0' ORDER BY `id` desc   limit 0, 20 
  SELECT id,title FROM `zt_productplan` WHERE product IN ('1') AND  deleted  = '0'
  SELECT * FROM `zt_storystage` WHERE branch IN ('0')
  SELECT * FROM `zt_story` WHERE product IN ('1') AND  status IN ('','draft','active','changed') AND  deleted  = '0' ORDER BY `id` desc   limit 0, 20 
  SELECT id,CONCAT(title, " [", begin, " ~ ", end, "]") as title FROM `zt_productplan` WHERE product IN ('1') AND  deleted  = '0' ORDER BY `begin` desc 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_module` WHERE root  = '1' AND  type  = 'story' ORDER BY `grade` desc,`order` 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT id,CONCAT(title, " [", begin, " ~ ", end, "]") as title FROM `zt_productplan` WHERE product IN ('1') AND  deleted  = '0' ORDER BY `begin` desc 
  SELECT DISTINCT story FROM `zt_case` WHERE story IN ('32','31','30','29','28','27','26','25','24','23','22','21','20','19','18','17','16','15','14','13')
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_module` WHERE root  = '1' AND  type  = 'story' ORDER BY `grade` desc,`order` 
  SELECT account, realname, deleted, INSTR(',pd,po,', role) AS roleOrder FROM `zt_user` WHERE deleted  = '0' ORDER BY `roleOrder` DESC,`account` 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_module` WHERE root  = '1' AND  type  = 'story' ORDER BY `grade` desc,`order` 
  SELECT * FROM `zt_branch` WHERE product  = '1' AND  deleted  = '0' ORDER BY `id` asc 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_storystage` WHERE story IN ('32','31','30','29','28','27','26','25','24','23','22','21','20','19','18','17','16','15','14','13')

20161121 14:17:26: story-view-32
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_story` WHERE `id` = '32' 
  SELECT title,spec,spec2,spec3,verify FROM `zt_storyspec` WHERE story  = '32' AND  version  = '2'
  SELECT t1.project, t2.name, t2.status FROM `zt_projectstory` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project = t2.id  WHERE t1.story  = '32' ORDER BY t1.`project` DESC 
  SELECT id, name, assignedTo, project, status, consumed, `left` FROM `zt_task` WHERE story  = '32' AND  deleted  = '0' ORDER BY `id` DESC 
  SELECT * FROM `zt_storystage` WHERE story  = '32'
  SELECT id,title,branch FROM `zt_productplan` WHERE id IN ('3')
  SELECT * FROM `zt_file` WHERE objectType  = 'story' AND  objectID  = '32' AND  extra  != 'editor'
  SELECT name, id, type FROM `zt_product` WHERE `id` = '1' 
  SELECT title FROM `zt_productplan` WHERE `id` = '3' 
  SELECT id,title FROM `zt_bug` WHERE story  = '32' AND  deleted  = '0'
  SELECT id,title FROM `zt_bug` WHERE toStory  = '32'
  SELECT id,title FROM `zt_case` WHERE story  = '32' AND  deleted  = '0'
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT commiter, account, realname FROM `zt_user` WHERE commiter  != ''
  SELECT * FROM `zt_action` WHERE objectType  = 'story' AND  objectID  = '32' ORDER BY `date`,`id` 
  SELECT * FROM `zt_history` WHERE action IN ('176','177') ORDER BY `id` 

20161121 14:17:30: story-edit-32
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_story` WHERE `id` = '32' 
  SELECT title,spec,spec2,spec3,verify FROM `zt_storyspec` WHERE story  = '32' AND  version  = '2'
  SELECT t1.project, t2.name, t2.status FROM `zt_projectstory` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project = t2.id  WHERE t1.story  = '32' ORDER BY t1.`project` DESC 
  SELECT id, name, assignedTo, project, status, consumed, `left` FROM `zt_task` WHERE story  = '32' AND  deleted  = '0' ORDER BY `id` DESC 
  SELECT * FROM `zt_storystage` WHERE story  = '32'
  SELECT id,title,branch FROM `zt_productplan` WHERE id IN ('3')
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_module` WHERE root  = '1' AND  type  = 'story' ORDER BY `grade` desc,`order` 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT id,CONCAT(title, " [", begin, " ~ ", end, "]") as title FROM `zt_productplan` WHERE product IN ('1') AND  deleted  = '0' ORDER BY `begin` desc 
  SELECT commiter, account, realname FROM `zt_user` WHERE commiter  != ''
  SELECT * FROM `zt_action` WHERE objectType  = 'story' AND  objectID  = '32' ORDER BY `date`,`id` 
  SELECT * FROM `zt_history` WHERE action IN ('176','177') ORDER BY `id` 
  SELECT * FROM `zt_story` WHERE `id` = '32' 
  SELECT title,spec,spec2,spec3,verify FROM `zt_storyspec` WHERE story  = '32' AND  version  = '2'
  SELECT t1.project, t2.name, t2.status FROM `zt_projectstory` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project = t2.id  WHERE t1.story  = '32' ORDER BY t1.`project` DESC 
  SELECT id, name, assignedTo, project, status, consumed, `left` FROM `zt_task` WHERE story  = '32' AND  deleted  = '0' ORDER BY `id` DESC 
  SELECT * FROM `zt_storystage` WHERE story  = '32'
  SELECT id,title,branch FROM `zt_productplan` WHERE id IN ('3')
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT account, realname, deleted, INSTR(',pd,po,', role) AS roleOrder FROM `zt_user` WHERE deleted  = '0' ORDER BY `roleOrder` DESC,`account` 
  SELECT account, realname, deleted, INSTR(',pd,po,', role) AS roleOrder FROM `zt_user` WHERE account IN ('productManager','admin','')

20161121 14:27:31: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161121 14:27:49: story-edit-32
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_story` WHERE `id` = '32' 
  SELECT title,spec,spec2,spec3,verify FROM `zt_storyspec` WHERE story  = '32' AND  version  = '2'
  SELECT t1.project, t2.name, t2.status FROM `zt_projectstory` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project = t2.id  WHERE t1.story  = '32' ORDER BY t1.`project` DESC 
  SELECT id, name, assignedTo, project, status, consumed, `left` FROM `zt_task` WHERE story  = '32' AND  deleted  = '0' ORDER BY `id` DESC 
  SELECT * FROM `zt_storystage` WHERE story  = '32'
  SELECT id,title,branch FROM `zt_productplan` WHERE id IN ('3')
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_module` WHERE root  = '1' AND  type  = 'story' ORDER BY `grade` desc,`order` 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT id,CONCAT(title, " [", begin, " ~ ", end, "]") as title FROM `zt_productplan` WHERE product IN ('1') AND  deleted  = '0' ORDER BY `begin` desc 
  SELECT commiter, account, realname FROM `zt_user` WHERE commiter  != ''
  SELECT * FROM `zt_action` WHERE objectType  = 'story' AND  objectID  = '32' ORDER BY `date`,`id` 
  SELECT * FROM `zt_history` WHERE action IN ('176','177') ORDER BY `id` 
  SELECT * FROM `zt_story` WHERE `id` = '32' 
  SELECT title,spec,spec2,spec3,verify FROM `zt_storyspec` WHERE story  = '32' AND  version  = '2'
  SELECT t1.project, t2.name, t2.status FROM `zt_projectstory` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project = t2.id  WHERE t1.story  = '32' ORDER BY t1.`project` DESC 
  SELECT id, name, assignedTo, project, status, consumed, `left` FROM `zt_task` WHERE story  = '32' AND  deleted  = '0' ORDER BY `id` DESC 
  SELECT * FROM `zt_storystage` WHERE story  = '32'
  SELECT id,title,branch FROM `zt_productplan` WHERE id IN ('3')
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT account, realname, deleted, INSTR(',pd,po,', role) AS roleOrder FROM `zt_user` WHERE deleted  = '0' ORDER BY `roleOrder` DESC,`account` 
  SELECT account, realname, deleted, INSTR(',pd,po,', role) AS roleOrder FROM `zt_user` WHERE account IN ('productManager','admin','')

20161121 14:28:15: story-edit-32
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_story` WHERE `id` = '32' 
  SELECT title,spec,spec2,spec3,verify FROM `zt_storyspec` WHERE story  = '32' AND  version  = '2'
  SELECT t1.project, t2.name, t2.status FROM `zt_projectstory` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project = t2.id  WHERE t1.story  = '32' ORDER BY t1.`project` DESC 
  SELECT id, name, assignedTo, project, status, consumed, `left` FROM `zt_task` WHERE story  = '32' AND  deleted  = '0' ORDER BY `id` DESC 
  SELECT * FROM `zt_storystage` WHERE story  = '32'
  SELECT id,title,branch FROM `zt_productplan` WHERE id IN ('3')
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_module` WHERE root  = '1' AND  type  = 'story' ORDER BY `grade` desc,`order` 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT id,CONCAT(title, " [", begin, " ~ ", end, "]") as title FROM `zt_productplan` WHERE product IN ('1') AND  deleted  = '0' ORDER BY `begin` desc 
  SELECT commiter, account, realname FROM `zt_user` WHERE commiter  != ''
  SELECT * FROM `zt_action` WHERE objectType  = 'story' AND  objectID  = '32' ORDER BY `date`,`id` 
  SELECT * FROM `zt_history` WHERE action IN ('176','177') ORDER BY `id` 
  SELECT * FROM `zt_story` WHERE `id` = '32' 
  SELECT title,spec,spec2,spec3,verify FROM `zt_storyspec` WHERE story  = '32' AND  version  = '2'
  SELECT t1.project, t2.name, t2.status FROM `zt_projectstory` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project = t2.id  WHERE t1.story  = '32' ORDER BY t1.`project` DESC 
  SELECT id, name, assignedTo, project, status, consumed, `left` FROM `zt_task` WHERE story  = '32' AND  deleted  = '0' ORDER BY `id` DESC 
  SELECT * FROM `zt_storystage` WHERE story  = '32'
  SELECT id,title,branch FROM `zt_productplan` WHERE id IN ('3')
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT account, realname, deleted, INSTR(',pd,po,', role) AS roleOrder FROM `zt_user` WHERE deleted  = '0' ORDER BY `roleOrder` DESC,`account` 
  SELECT account, realname, deleted, INSTR(',pd,po,', role) AS roleOrder FROM `zt_user` WHERE account IN ('productManager','admin','')

20161121 14:47:40: 
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161121 14:47:40: my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE account  = 'admin' AND  module  = 'my' AND  hidden  = '0' ORDER BY `order` 

20161121 14:47:40: block-printBlock-2-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '2'
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT * FROM `zt_action` WHERE 1  AND  date  > '2016-11-21' AND  date  < '2016-11-22' AND  (1)  ORDER BY `date` desc 
  SELECT commiter, account, realname FROM `zt_user` WHERE commiter  != ''
  SELECT id, title AS name FROM `zt_story` WHERE id IN ('32')
  SELECT id, account AS name FROM `zt_user` WHERE id IN ('1')
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 

20161121 14:47:40: block-printBlock-6-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '6'
  SELECT t1.*, t2.id as projectID, t2.name as projectName, t3.id as storyID, t3.title as storyTitle, t3.status AS storyStatus, t3.version AS latestStoryVersion FROM `zt_task` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project = t2.id  LEFT JOIN `zt_story` AS t3  ON t1.story = t3.id  WHERE t1.deleted  = '0' AND  t1.assignedTo  = 'admin' ORDER BY `id` desc  LIMIT 15 
  SELECT t1.*, t2.id as projectID, t2.name as projectName, t3.id as storyID, t3.title as storyTitle, t3.status AS storyStatus, t3.version AS latestStoryVersion FROM `zt_task` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project = t2.id  LEFT JOIN `zt_story` AS t3  ON t1.story = t3.id  WHERE t1.deleted  = '0' AND  t1.assignedTo  = 'admin' ORDER BY `id` desc  LIMIT 15 

20161121 14:47:40: block-printBlock-5-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '5'
  SELECT * FROM `zt_product` WHERE deleted  = '0' AND  status  != 'closed' ORDER BY `order` desc 
  SELECT * FROM `zt_product` WHERE id IN ('2','1') ORDER BY `order` desc 
  SELECT COUNT(*) AS recTotal FROM `zt_product` WHERE id IN ('2','1') 
  SELECT * FROM `zt_product` WHERE id IN ('2','1') ORDER BY `order` desc 
  SELECT product, status, count(status) AS count FROM `zt_story` WHERE deleted  = '0' AND  product IN ('2','1') GROUP BY product, status
  SELECT product, count(*) AS count FROM `zt_productplan` WHERE deleted  = '0' AND  product IN ('2','1') AND  end  > '2016-11-21 14:47:40' GROUP BY product
  SELECT product, count(*) AS count FROM `zt_release` WHERE deleted  = '0' AND  product IN ('2','1') GROUP BY product
  SELECT product,count(*) AS conut FROM `zt_bug` WHERE deleted  = '0' AND  product IN ('2','1') GROUP BY product
  SELECT product,count(*) AS count FROM `zt_bug` WHERE status  = 'active' AND  deleted  = '0' AND  product IN ('2','1') GROUP BY product
  SELECT product,count(*) AS count FROM `zt_bug` WHERE AssignedTo  = '' AND  deleted  = '0' AND  product IN ('2','1') GROUP BY product

20161121 14:47:40: block-printBlock-4-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '4'
  SELECT * FROM `zt_todo` WHERE account  = 'admin' AND  date  >= '1970-01-01' AND  date  <= '2109-01-01' AND  status IN ('wait','doing') ORDER BY `date`,`status`,`begin`  LIMIT 20 
  SELECT * FROM `zt_todo` WHERE account  = 'admin' AND  date  >= '1970-01-01' AND  date  <= '2109-01-01' AND  status IN ('wait','doing') ORDER BY `date`,`status`,`begin`  LIMIT 20 

20161121 14:47:40: block-printBlock-3-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '3'
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  status  != 'done' AND  deleted  = '0' ORDER BY `order` desc 
  SELECT * FROM `zt_project` WHERE id IN ('2') ORDER BY `order` desc 
  SELECT COUNT(*) AS recTotal FROM `zt_project` WHERE id IN ('2') 
  SELECT * FROM `zt_project` WHERE id IN ('2') ORDER BY `order` desc 
  SELECT id, project, estimate, consumed, `left`, status, closedReason FROM `zt_task` WHERE project IN ('2') AND  deleted  = '0'
  SELECT project, date AS name, `left` AS value FROM `zt_burn` WHERE project IN ('2') ORDER BY `date` desc 

20161121 14:47:40: block-printBlock-1-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '1'

20161121 14:47:40: block-printBlock-7-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '7'
  SELECT * FROM `zt_bug` WHERE deleted  = '0' AND  assignedTo  = 'admin' ORDER BY `id` desc  LIMIT 15 

20161121 14:47:40: block-printBlock-8-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '8'
  SELECT t1.*, t2.name as productTitle FROM `zt_story` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.deleted  = '0' AND  assignedTo  = 'admin' ORDER BY `id` desc 
  SELECT COUNT(*) AS recTotal FROM `zt_story` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.deleted  = '0' AND  assignedTo  = 'admin' 
  SELECT t1.*, t2.name as productTitle FROM `zt_story` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.deleted  = '0' AND  assignedTo  = 'admin' ORDER BY `id` desc 
  SELECT t1.*, t2.name as productTitle FROM `zt_story` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.deleted  = '0' AND  assignedTo  = 'admin' ORDER BY `id` desc 
  SELECT t1.*, t2.name as productTitle FROM `zt_story` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.deleted  = '0' AND  assignedTo  = 'admin' ORDER BY `id` desc 
  SELECT id,title FROM `zt_productplan` WHERE product IN ('1') AND  deleted  = '0'
  SELECT * FROM `zt_storystage` WHERE branch IN ('0')

20161121 14:47:40: block-printBlock-9-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '9'
  SELECT t1.assignedTo AS assignedTo, t2.* FROM `zt_testrun` AS t1  LEFT JOIN `zt_case` AS t2  ON t1.case = t2.id  LEFT JOIN `zt_testtask` AS t3  ON t1.task = t3.id  WHERE t1.assignedTo  = 'admin' AND  t1.status  != 'done' AND  t3.status  != 'done' AND  t3.deleted  = '0' AND  t2.deleted  = '0' ORDER BY `id` desc  LIMIT 15 

20161121 14:47:45: 
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161121 14:47:45: my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE account  = 'admin' AND  module  = 'my' AND  hidden  = '0' ORDER BY `order` 

20161121 14:47:46: block-printBlock-1-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '1'

20161121 14:47:46: block-printBlock-2-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '2'
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT * FROM `zt_action` WHERE 1  AND  date  > '2016-11-21' AND  date  < '2016-11-22' AND  (1)  ORDER BY `date` desc 
  SELECT commiter, account, realname FROM `zt_user` WHERE commiter  != ''
  SELECT id, title AS name FROM `zt_story` WHERE id IN ('32')
  SELECT id, account AS name FROM `zt_user` WHERE id IN ('1')
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 

20161121 14:47:46: block-printBlock-4-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '4'
  SELECT * FROM `zt_todo` WHERE account  = 'admin' AND  date  >= '1970-01-01' AND  date  <= '2109-01-01' AND  status IN ('wait','doing') ORDER BY `date`,`status`,`begin`  LIMIT 20 
  SELECT * FROM `zt_todo` WHERE account  = 'admin' AND  date  >= '1970-01-01' AND  date  <= '2109-01-01' AND  status IN ('wait','doing') ORDER BY `date`,`status`,`begin`  LIMIT 20 

20161121 14:47:46: block-printBlock-3-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '3'
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  status  != 'done' AND  deleted  = '0' ORDER BY `order` desc 
  SELECT * FROM `zt_project` WHERE id IN ('2') ORDER BY `order` desc 
  SELECT COUNT(*) AS recTotal FROM `zt_project` WHERE id IN ('2') 
  SELECT * FROM `zt_project` WHERE id IN ('2') ORDER BY `order` desc 
  SELECT id, project, estimate, consumed, `left`, status, closedReason FROM `zt_task` WHERE project IN ('2') AND  deleted  = '0'
  SELECT project, date AS name, `left` AS value FROM `zt_burn` WHERE project IN ('2') ORDER BY `date` desc 

20161121 14:47:46: block-printBlock-6-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '6'
  SELECT t1.*, t2.id as projectID, t2.name as projectName, t3.id as storyID, t3.title as storyTitle, t3.status AS storyStatus, t3.version AS latestStoryVersion FROM `zt_task` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project = t2.id  LEFT JOIN `zt_story` AS t3  ON t1.story = t3.id  WHERE t1.deleted  = '0' AND  t1.assignedTo  = 'admin' ORDER BY `id` desc  LIMIT 15 
  SELECT t1.*, t2.id as projectID, t2.name as projectName, t3.id as storyID, t3.title as storyTitle, t3.status AS storyStatus, t3.version AS latestStoryVersion FROM `zt_task` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project = t2.id  LEFT JOIN `zt_story` AS t3  ON t1.story = t3.id  WHERE t1.deleted  = '0' AND  t1.assignedTo  = 'admin' ORDER BY `id` desc  LIMIT 15 

20161121 14:47:46: block-printBlock-5-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '5'
  SELECT * FROM `zt_product` WHERE deleted  = '0' AND  status  != 'closed' ORDER BY `order` desc 
  SELECT * FROM `zt_product` WHERE id IN ('2','1') ORDER BY `order` desc 
  SELECT COUNT(*) AS recTotal FROM `zt_product` WHERE id IN ('2','1') 
  SELECT * FROM `zt_product` WHERE id IN ('2','1') ORDER BY `order` desc 
  SELECT product, status, count(status) AS count FROM `zt_story` WHERE deleted  = '0' AND  product IN ('2','1') GROUP BY product, status
  SELECT product, count(*) AS count FROM `zt_productplan` WHERE deleted  = '0' AND  product IN ('2','1') AND  end  > '2016-11-21 14:47:46' GROUP BY product
  SELECT product, count(*) AS count FROM `zt_release` WHERE deleted  = '0' AND  product IN ('2','1') GROUP BY product
  SELECT product,count(*) AS conut FROM `zt_bug` WHERE deleted  = '0' AND  product IN ('2','1') GROUP BY product
  SELECT product,count(*) AS count FROM `zt_bug` WHERE status  = 'active' AND  deleted  = '0' AND  product IN ('2','1') GROUP BY product
  SELECT product,count(*) AS count FROM `zt_bug` WHERE AssignedTo  = '' AND  deleted  = '0' AND  product IN ('2','1') GROUP BY product

20161121 14:47:46: block-printBlock-7-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '7'
  SELECT * FROM `zt_bug` WHERE deleted  = '0' AND  assignedTo  = 'admin' ORDER BY `id` desc  LIMIT 15 

20161121 14:47:46: block-printBlock-8-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '8'
  SELECT t1.*, t2.name as productTitle FROM `zt_story` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.deleted  = '0' AND  assignedTo  = 'admin' ORDER BY `id` desc 
  SELECT COUNT(*) AS recTotal FROM `zt_story` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.deleted  = '0' AND  assignedTo  = 'admin' 
  SELECT t1.*, t2.name as productTitle FROM `zt_story` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.deleted  = '0' AND  assignedTo  = 'admin' ORDER BY `id` desc 
  SELECT t1.*, t2.name as productTitle FROM `zt_story` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.deleted  = '0' AND  assignedTo  = 'admin' ORDER BY `id` desc 
  SELECT t1.*, t2.name as productTitle FROM `zt_story` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.deleted  = '0' AND  assignedTo  = 'admin' ORDER BY `id` desc 
  SELECT id,title FROM `zt_productplan` WHERE product IN ('1') AND  deleted  = '0'
  SELECT * FROM `zt_storystage` WHERE branch IN ('0')

20161121 14:47:46: block-printBlock-9-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '9'
  SELECT t1.assignedTo AS assignedTo, t2.* FROM `zt_testrun` AS t1  LEFT JOIN `zt_case` AS t2  ON t1.case = t2.id  LEFT JOIN `zt_testtask` AS t3  ON t1.task = t3.id  WHERE t1.assignedTo  = 'admin' AND  t1.status  != 'done' AND  t3.status  != 'done' AND  t3.deleted  = '0' AND  t2.deleted  = '0' ORDER BY `id` desc  LIMIT 15 

20161121 14:47:48: admin
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161121 14:47:53: extension-browse
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_extension` WHERE status  = 'installed'

20161121 14:48:00: extension-upload
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161121 14:48:29: extension-upload
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_extension` WHERE code  = 'excel'

20161121 14:48:30: extension-install-excel
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161121 14:49:35: extension-install-excel
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161121 14:51:16: extension-install-excel
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_extension` WHERE status  = 'installed'

20161121 14:51:22: extension-install-excel----no-no-no-yes-no
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_extension` WHERE status  = 'installed'
  REPLACE `zt_extension` SET `name` = 'Excel导出',`code` = 'excel',`version` = '3.9',`author` = 'wangyidong<yidong@cnezsoft.com>',`desc` = '安装该插件可以支持Excel导出功能。',`site` = 'http://www.zentao.net',`license` = '本“软件”是由青岛易软天创独立开发，除非您接受本《协议》条款，否则您无权下载、安装或使用本“软件”及其相关服务。您的安装使用行为将视为对本《协议》的接受，并同意接受本《协议》各项条款的约束。未经易软天创授权，任何拷贝、销售、转让、出租、修改本“软件”的行为均被认为是侵权行为。\n\n青岛易软天创将授权软件提供给授权用户，同时提供授权软件的安装说明、使用说明等文档，授权网站和用户依法享有该软件的使用权。但青岛易软天创不保证对免费版永远免费。\n授权用户拥有其系统内全部会员资料、商品资料、订单资料及相关信息的所有权，并独立承担与其的相关法律义务。\n对每份许可协议，用户可以在一台计算机、终端机、工作站或其他数字电子仪器（下简称“计算机”）上安装、使用、显示、运行本“软件”。\n保留权利：未明示授权的其他一切权利仍归青岛易软天创所有，用户使用其他权利时须另外取得青岛易软天创的书面同意。\n除本《协议》有明确规定外，本《协议》并未对本“软件”以外的青岛易软天创的其他服务的服务条款作出规定。对于这些服务，可能有单独的服务条款加以规范，请用户在使用有关服务时另行了解与确认。如用户使用该服务，视为对相关服务条款的接受。\n\n青岛易软天创保留对本协议的最终解释权。',`zentaoCompatible` = '8.3,8.3.1',`type` = 'extension',`depends` = '',`status` = 'available'
  UPDATE `zt_extension` SET `status` = 'installed',`dirs` = '[\"module\\/file\\/ext\\/model\\/class\",\"module\\/bug\\/ext\\/view\",\"module\\/bug\\/ext\\/model\\/class\",\"module\\/bug\\/ext\\/control\",\"module\\/bug\\/ext\\/lang\\/zh-cn\",\"module\\/bug\\/ext\\/lang\\/en\",\"module\\/bug\\/ext\\/lang\\/zh-tw\",\"module\\/bug\\/ext\\/config\",\"module\\/bug\\/ext\\/css\\/showimport\",\"module\\/bug\\/ext\\/css\\/browse\",\"module\\/product\\/ext\\/css\\/browse\",\"module\\/task\\/ext\\/view\",\"module\\/task\\/ext\\/model\\/class\",\"module\\/task\\/ext\\/control\",\"module\\/task\\/ext\\/lang\\/zh-cn\",\"module\\/task\\/ext\\/lang\\/en\",\"module\\/task\\/ext\\/lang\\/zh-tw\",\"module\\/task\\/ext\\/config\",\"module\\/task\\/ext\\/css\\/showimport\",\"module\\/story\\/ext\\/model\\/class\",\"module\\/story\\/ext\\/css\\/showimport\",\"module\\/testcase\\/ext\\/model\\/class\",\"module\\/testcase\\/ext\\/css\\/browse\",\"module\\/project\\/ext\\/css\\/task\",\"lib\\/phpexcel\\/PHPExcel\",\"lib\\/phpexcel\\/PHPExcel\\/CachedObjectStorage\",\"lib\\/phpexcel\\/PHPExcel\\/Style\",\"lib\\/phpexcel\\/PHPExcel\\/Calculation\",\"lib\\/phpexcel\\/PHPExcel\\/Calculation\\/Token\",\"lib\\/phpexcel\\/PHPExcel\\/Worksheet\\/AutoFilter\",\"lib\\/phpexcel\\/PHPExcel\\/Worksheet\\/AutoFilter\\/Column\",\"lib\\/phpexcel\\/PHPExcel\\/Worksheet\\/Drawing\",\"lib\\/phpexcel\\/PHPExcel\\/CalcEngine\",\"lib\\/phpexcel\\/PHPExcel\\/Cell\",\"lib\\/phpexcel\\/PHPExcel\\/Reader\",\"lib\\/phpexcel\\/PHPExcel\\/Reader\\/Excel5\",\"lib\\/phpexcel\\/PHPExcel\\/Reader\\/Excel2007\",\"lib\\/phpexcel\\/PHPExcel\\/Shared\",\"lib\\/phpexcel\\/PHPExcel\\/Shared\\/OLE\\/PPS\",\"lib\\/phpexcel\\/PHPExcel\\/Shared\\/PCLZip\",\"lib\\/phpexcel\\/PHPExcel\\/Shared\\/Escher\\/DgContainer\\/SpgrContainer\",\"lib\\/phpexcel\\/PHPExcel\\/Shared\\/Escher\\/DggContainer\",\"lib\\/phpexcel\\/PHPExcel\\/Shared\\/Escher\\/DggContainer\\/BstoreContainer\",\"lib\\/phpexcel\\/PHPExcel\\/Shared\\/Escher\\/DggContainer\\/BstoreContainer\\/BSE\",\"lib\\/phpexcel\\/PHPExcel\\/Shared\\/trend\",\"lib\\/phpexcel\\/PHPExcel\\/Writer\",\"lib\\/phpexcel\\/PHPExcel\\/Writer\\/PDF\",\"lib\\/phpexcel\\/PHPExcel\\/Writer\\/Excel5\",\"lib\\/phpexcel\\/PHPExcel\\/Writer\\/Excel2007\",\"lib\\/phpexcel\\/PHPExcel\\/RichText\",\"lib\\/phpexcel\\/PHPExcel\\/locale\\/pt\\/br\",\"lib\\/phpexcel\\/PHPExcel\\/locale\\/nl\",\"lib\\/phpexcel\\/PHPExcel\\/locale\\/pl\",\"lib\\/phpexcel\\/PHPExcel\\/locale\\/bg\",\"lib\\/phpexcel\\/PHPExcel\\/locale\\/it\",\"lib\\/phpexcel\\/PHPExcel\\/locale\\/en\\/uk\",\"lib\\/phpexcel\\/PHPExcel\\/locale\\/sv\",\"lib\\/phpexcel\\/PHPExcel\\/locale\\/ru\",\"lib\\/phpexcel\\/PHPExcel\\/locale\\/es\",\"lib\\/phpexcel\\/PHPExcel\\/locale\\/da\",\"lib\\/phpexcel\\/PHPExcel\\/locale\\/de\",\"lib\\/phpexcel\\/PHPExcel\\/locale\\/tr\",\"lib\\/phpexcel\\/PHPExcel\\/locale\\/fr\",\"lib\\/phpexcel\\/PHPExcel\\/locale\\/no\",\"lib\\/phpexcel\\/PHPExcel\\/locale\\/cs\",\"lib\\/phpexcel\\/PHPExcel\\/locale\\/fi\",\"lib\\/phpexcel\\/PHPExcel\\/locale\\/hu\",\"lib\\/phpexcel\\/PHPExcel\\/Chart\",\"lib\\/phpexcel\\/PHPExcel\\/Chart\\/Renderer\",\"lib\\/phpexcel\\/xlsx\\/xl\",\"lib\\/phpexcel\\/xlsx\\/xl\\/theme\",\"lib\\/phpexcel\\/xlsx\\/xl\\/_rels\",\"lib\\/phpexcel\\/xlsx\\/xl\\/worksheets\",\"lib\\/phpexcel\\/xlsx\\/docProps\",\"lib\\/phpexcel\\/xlsx\\/_rels\"]',`files` = '{\"config\\\\license\\/excel3.9.txt\":\"7a6ab67b157377979e005a16533eb334\",\"lib\\\\phpexcel\\\\PHPExcel\\/Autoloader.php\":\"829aef425771dbe207a07c8c056f41fe\",\"lib\\\\phpexcel\\\\PHPExcel\\\\CachedObjectStorage\\/APC.php\":\"1c41c7cb2d913823e65ea25b9b067a34\",\"lib\\\\phpexcel\\\\PHPExcel\\\\CachedObjectStorage\\/CacheBase.php\":\"45ec0389643f44555f45b7f732fb9328\",\"lib\\\\phpexcel\\\\PHPExcel\\\\CachedObjectStorage\\/DiscISAM.php\":\"792c27a7920a33100d082e3a1e863e0f\",\"lib\\\\phpexcel\\\\PHPExcel\\\\CachedObjectStorage\\/ICache.php\":\"1f2af9d27a32d3bfadb9af4df5bedbdc\",\"lib\\\\phpexcel\\\\PHPExcel\\\\CachedObjectStorage\\/Igbinary.php\":\"9caa0af653e56e5c3ad9f9ee6bcdf71c\",\"lib\\\\phpexcel\\\\PHPExcel\\\\CachedObjectStorage\\/Memcache.php\":\"e9c9fd2dfa1ef0c7df194f32a55c584c\",\"lib\\\\phpexcel\\\\PHPExcel\\\\CachedObjectStorage\\/Memory.php\":\"67d943f12ce373b554c44a8427950f5e\",\"lib\\\\phpexcel\\\\PHPExcel\\\\CachedObjectStorage\\/MemoryGZip.php\":\"7cfc009c1634fbbbdf229e1ccf4b193f\",\"lib\\\\phpexcel\\\\PHPExcel\\\\CachedObjectStorage\\/MemorySerialized.php\":\"b9498b0c52a0e9635557841db318ed79\",\"lib\\\\phpexcel\\\\PHPExcel\\\\CachedObjectStorage\\/PHPTemp.php\":\"8cbab31264df67172d4753abaea3028f\",\"lib\\\\phpexcel\\\\PHPExcel\\\\CachedObjectStorage\\/SQLite.php\":\"705f689486dee5e55cb54560a743e847\",\"lib\\\\phpexcel\\\\PHPExcel\\\\CachedObjectStorage\\/SQLite3.php\":\"2be3feafefad4a501232156beff5ae94\",\"lib\\\\phpexcel\\\\PHPExcel\\\\CachedObjectStorage\\/Wincache.php\":\"649b95ef8f1d8b9b1fce1c32d8e13670\",\"lib\\\\phpexcel\\\\PHPExcel\\/CachedObjectStorageFactory.php\":\"7d4bf23a5c30fa32febd05464db47ca4\",\"lib\\\\phpexcel\\\\PHPExcel\\\\CalcEngine\\/CyclicReferenceStack.php\":\"b95ea04521788a9c3c5f311ba98db929\",\"lib\\\\phpexcel\\\\PHPExcel\\\\CalcEngine\\/Logger.php\":\"7ea3145a0dfe1d9da222884bdc89a606\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Calculation\\/Database.php\":\"ab2155979557b00ecef7c1b7c7e8958d\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Calculation\\/DateTime.php\":\"4456ef4ddfcadde7b479cacfe46c1f39\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Calculation\\/Engineering.php\":\"dfe86760bf0f9899b0fcfc86c7172bdc\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Calculation\\/Exception.php\":\"090f70ef38b639a7eb61c17dd6fc09a7\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Calculation\\/ExceptionHandler.php\":\"1cbd40249a14b7ef003c8a6f44e3022a\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Calculation\\/Financial.php\":\"e1e9ddc20eafcd968f8c9f51a56736ea\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Calculation\\/FormulaParser.php\":\"4d924d6b8d09a243f14a16202e3266bd\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Calculation\\/FormulaToken.php\":\"62b7de49a5677852bdc59e5c849173a0\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Calculation\\/Function.php\":\"33f4b1f8e4c449cbf4a01710b3de380e\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Calculation\\/Functions.php\":\"3fe76e0f0782364db62969a16a391373\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Calculation\\/Logical.php\":\"2bd3bf69b9320a995e80c7ce85af673a\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Calculation\\/LookupRef.php\":\"ecdfde02f33a63b14166a42680cf8cdb\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Calculation\\/MathTrig.php\":\"4129d479726c923853f533863980b485\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Calculation\\/Statistical.php\":\"e85ad470880e4acf2c2c76e288216b26\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Calculation\\/TextData.php\":\"dc02ad9bb7d7cbf9c8cee893284bc9d8\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Calculation\\\\Token\\/Stack.php\":\"f0bf96a5e49457f8031630df2134222f\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Calculation\\/functionlist.txt\":\"a44608185f9bc21f28dd0173739f023b\",\"lib\\\\phpexcel\\\\PHPExcel\\/Calculation.php\":\"bcbd68efc7bbe8f64d1dcea62b0ef39e\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Cell\\/AdvancedValueBinder.php\":\"dfb33b91b611417dd4aa229ebff9e7d9\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Cell\\/DataType.php\":\"060e704e080033d19da3d279e0080913\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Cell\\/DataValidation.php\":\"3f1fc62470db30f980446bc250cc2b19\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Cell\\/DefaultValueBinder.php\":\"5ca78dbb9603e64cc7630f1e45aa7eeb\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Cell\\/Hyperlink.php\":\"dce41ebd1e3eaddd92aa77cb18ae23c3\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Cell\\/IValueBinder.php\":\"119ddf7becb7ec0533a2d1af9144f4f9\",\"lib\\\\phpexcel\\\\PHPExcel\\/Cell.php\":\"87c0ddff94acf4073911f561e66e9c56\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Chart\\/DataSeries.php\":\"0d16f75fa10e866a576667e4e0dfe825\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Chart\\/DataSeriesValues.php\":\"44acaa258dd743bd7e274205a2f36288\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Chart\\/Exception.php\":\"0c1c0f5a4bf1ea99ac241c8604d70d3e\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Chart\\/Layout.php\":\"70c0fc61adcb15addb3a06df5a810932\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Chart\\/Legend.php\":\"abe5aff33c491eff6b115bc16eb0badb\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Chart\\/PlotArea.php\":\"450e1e6dbddd31e411110de6f18a5b4b\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Chart\\\\Renderer\\/PHP Charting Libraries.txt\":\"6ce1c907ce7043d81288b98e1ffd8c35\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Chart\\\\Renderer\\/jpgraph.php\":\"279ce653db7b4177d1c378c421dd4ffe\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Chart\\/Title.php\":\"ebddf398f5da69049cfe4167b5e6b880\",\"lib\\\\phpexcel\\\\PHPExcel\\/Chart.php\":\"f8228e3250f191a1f69dfca422396b3b\",\"lib\\\\phpexcel\\\\PHPExcel\\/Comment.php\":\"27701a1de23da787b0d3491b886f6966\",\"lib\\\\phpexcel\\\\PHPExcel\\/DocumentProperties.php\":\"7e1c640c2f39ba23ab72652ba6bb0825\",\"lib\\\\phpexcel\\\\PHPExcel\\/DocumentSecurity.php\":\"e90fcba79e73f0813da74b92517043d8\",\"lib\\\\phpexcel\\\\PHPExcel\\/Exception.php\":\"3d57d24d680dec4818f4357f2cba6268\",\"lib\\\\phpexcel\\\\PHPExcel\\/HashTable.php\":\"1dd7b0e81060df90697a59af9e892e0e\",\"lib\\\\phpexcel\\\\PHPExcel\\/IComparable.php\":\"bb214b2b022f8a410aa7bce1e92724fd\",\"lib\\\\phpexcel\\\\PHPExcel\\/IOFactory.php\":\"99d181ffb366ca1d65449ab8d7f73233\",\"lib\\\\phpexcel\\\\PHPExcel\\/NamedRange.php\":\"457ba7f711105eba233443a3f1c6fffe\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Reader\\/Abstract.php\":\"9f5036a9754b83c78ef667a5ba915f8a\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Reader\\/CSV.php\":\"b833ba10c2a43fb30378db9d53fcd3c0\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Reader\\/DefaultReadFilter.php\":\"ae7d425c162f8fdcc31b6780c5f60aa4\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Reader\\/Excel2003XML.php\":\"be8192ecd06e39c897bd970b436d6293\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Reader\\\\Excel2007\\/Chart.php\":\"7739e48ce21ce35cd78f1247b6eed711\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Reader\\\\Excel2007\\/Theme.php\":\"7b177c892a85d8a3eee3a7b482d01e2e\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Reader\\/Excel2007.php\":\"e3ef3bf3556ae02dc94a2bdc360d2d49\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Reader\\\\Excel5\\/Escher.php\":\"1b7a1789b75594414fe2f0533422557b\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Reader\\\\Excel5\\/MD5.php\":\"d68b958fab17ee3c8e933beeafdd9881\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Reader\\\\Excel5\\/RC4.php\":\"beb2be314774a6dc4412ac7eb5211306\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Reader\\/Excel5.php\":\"0a440d3c5a6797eb0d3bebbcff230cf1\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Reader\\/Exception.php\":\"f6aff5dbba38184dd8998c576b3093ad\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Reader\\/Gnumeric.php\":\"7f3af95b8429cb1135f1d0b6f38e89e4\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Reader\\/HTML.php\":\"c22e2d91ffd4f71ffe56f32989d1c3a1\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Reader\\/IReadFilter.php\":\"e9c60631b682b4d70caba0c8abde2db7\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Reader\\/IReader.php\":\"601214922e3c23f448755f48fa6d7f7e\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Reader\\/OOCalc.php\":\"8adf723e1ca06d2217f132ad66b3d112\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Reader\\/SYLK.php\":\"d5897a77179001eb8dbbb0aa1de54193\",\"lib\\\\phpexcel\\\\PHPExcel\\/ReferenceHelper.php\":\"fd45c67989eed6b7d3881ac7d660ef68\",\"lib\\\\phpexcel\\\\PHPExcel\\\\RichText\\/ITextElement.php\":\"6094b341562284a4596ec75bcbd37deb\",\"lib\\\\phpexcel\\\\PHPExcel\\\\RichText\\/Run.php\":\"07c586be90bdcc5c8429c4285d1d357c\",\"lib\\\\phpexcel\\\\PHPExcel\\\\RichText\\/TextElement.php\":\"dcbcccd74064350045ebca7ff9c61c4f\",\"lib\\\\phpexcel\\\\PHPExcel\\/RichText.php\":\"dde30bfe8bfcbe0ee166386b64256dc5\",\"lib\\\\phpexcel\\\\PHPExcel\\/Settings.php\":\"46f428233c350f445ca9dedae4f362fa\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Shared\\/CodePage.php\":\"08b7348a9439950035cc7511a0fcddf6\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Shared\\/Date.php\":\"d94304e12bf6cbd4f8f000c4fc563766\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Shared\\/Drawing.php\":\"53a1ad86cb3f04d69b9dcb275a3db684\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Shared\\\\Escher\\\\DgContainer\\\\SpgrContainer\\/SpContainer.php\":\"edd95eb12e0cf72e391e897c595ee289\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Shared\\\\Escher\\\\DgContainer\\/SpgrContainer.php\":\"8c6212c872e88f2009fb441f68a1ae74\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Shared\\\\Escher\\/DgContainer.php\":\"47144408dbbf4a7eba63f1761a499508\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Shared\\\\Escher\\\\DggContainer\\\\BstoreContainer\\\\BSE\\/Blip.php\":\"a8408f6208da9f44b381e808b83c1bb9\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Shared\\\\Escher\\\\DggContainer\\\\BstoreContainer\\/BSE.php\":\"0cb495cc714a0583c0a45a65079cb2b7\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Shared\\\\Escher\\\\DggContainer\\/BstoreContainer.php\":\"c871f031ea048c72acf364943d927ca6\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Shared\\\\Escher\\/DggContainer.php\":\"2d31c00eb7f8d4a4fd960971e4809d31\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Shared\\/Escher.php\":\"c532a9793127f95ef92106e37194499c\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Shared\\/Excel5.php\":\"0f47c9d67789b573d2f22181f55c3636\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Shared\\/File.php\":\"ba3387a36f0bc8fd51e880c434d426b9\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Shared\\/Font.php\":\"4a1790fb8c8aacf08aa645cde5f07d0f\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Shared\\\\OLE\\/ChainedBlockStream.php\":\"5f8489eed8d4b6b7b13da0bbda876dac\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Shared\\\\OLE\\\\PPS\\/File.php\":\"7f90ecb330695a1f3d6e3b7212bfd804\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Shared\\\\OLE\\\\PPS\\/Root.php\":\"c852953f1a43c07d64966072fcd914bd\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Shared\\\\OLE\\/PPS.php\":\"7ecb0c1313a804acf7cca3bfc2af5371\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Shared\\/OLE.php\":\"e9042b477814247c6860233246c57163\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Shared\\/OLERead.php\":\"bd8a3d70f7c061e94386466b0e52d9ef\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Shared\\\\PCLZip\\/gnu-lgpl.txt\":\"f14599a2f089f6ff8c97e2baa4e3d575\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Shared\\\\PCLZip\\/pclzip.lib.php\":\"3ee0a4d8a06cedc0a56f29e8f351ef72\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Shared\\\\PCLZip\\/readme.txt\":\"0d82536577908a1f78e1b5c6220f5810\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Shared\\/PasswordHasher.php\":\"ff0d3b2b34e3e09b44827b46cef20d43\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Shared\\/String.php\":\"e6bf12ee8555d9fdc3d0f2c42940436b\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Shared\\/TimeZone.php\":\"5abc90c303abc0281a323c53d1e44c2b\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Shared\\/XMLWriter.php\":\"cfe68492dea5ba16eaa85ff232bafdb6\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Shared\\/ZipArchive.php\":\"53f42b65c3712a2ca5f7afc148c110b7\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Shared\\/ZipStreamWrapper.php\":\"87b259cdf18e697f87a8d65092a7a049\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Shared\\\\trend\\/bestFitClass.php\":\"1b2e22f2a95597db45c8af5af3852506\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Shared\\\\trend\\/exponentialBestFitClass.php\":\"63003d078e0b8c6321f303661321bc33\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Shared\\\\trend\\/linearBestFitClass.php\":\"96b453f1c7b3bf0485319a462084db96\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Shared\\\\trend\\/logarithmicBestFitClass.php\":\"ab2a6b84195ac4739dd22f429a36c13b\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Shared\\\\trend\\/polynomialBestFitClass.php\":\"7615dbe480f829b7a967a0562c8e7221\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Shared\\\\trend\\/powerBestFitClass.php\":\"d138cba0fea34603f4196dc5153d8e26\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Shared\\\\trend\\/trendClass.php\":\"755728ff7720434f400c85c4d7e9c0b5\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Style\\/Alignment.php\":\"2b69d68dd6f5a829982f6d563ef62442\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Style\\/Border.php\":\"2f0031ab554d1ae49ff97db3764b33c5\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Style\\/Borders.php\":\"16ee4b07a337b4e9e04a6cd919bb48c7\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Style\\/Color.php\":\"713cc92bd897d941b740aef1bfbb64ee\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Style\\/Conditional.php\":\"7abe01720f55b034034b834b89ec1306\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Style\\/Fill.php\":\"d01f94a52840ed0da0fe14c3e70d3592\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Style\\/Font.php\":\"b3bfc3ff51c1b630a842fd2a8c430fb0\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Style\\/NumberFormat.php\":\"7d4348022e6489408cec85c94210ff99\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Style\\/Protection.php\":\"485c9e075ba3a2a36de5bc546f7e07e9\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Style\\/Supervisor.php\":\"0f42b24f6a1b9eba72b885c94dfd2c4d\",\"lib\\\\phpexcel\\\\PHPExcel\\/Style.php\":\"da67e2754b466b467f9b97d7dce1b367\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Worksheet\\\\AutoFilter\\\\Column\\/Rule.php\":\"a3d8f09c515e695e7ea3d3ff6fecdc3e\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Worksheet\\\\AutoFilter\\/Column.php\":\"9a095583d4968210c428aa671f7fd05c\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Worksheet\\/AutoFilter.php\":\"372d1bc3cc32141d16e6828bfcb7f15c\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Worksheet\\/BaseDrawing.php\":\"b7f7a8a0717691a5fadb72ed9b953930\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Worksheet\\/CellIterator.php\":\"f1d09aba4db36c2f1016eb065fcda1d3\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Worksheet\\/ColumnDimension.php\":\"a234de35961af948a38652010a26c9d5\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Worksheet\\\\Drawing\\/Shadow.php\":\"26c15cb43424cb0a5f4374b2f23205ba\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Worksheet\\/Drawing.php\":\"8a4d8793abe8403cc6f5ab4af734250d\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Worksheet\\/HeaderFooter.php\":\"9687706ae4cad55d5caf9cf7a193968c\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Worksheet\\/HeaderFooterDrawing.php\":\"4d611ad3939347626d994450645914d6\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Worksheet\\/MemoryDrawing.php\":\"5e8879bea2ca8523121328fee835fb98\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Worksheet\\/PageMargins.php\":\"1c6f773292c37fbd5665c68439399aa4\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Worksheet\\/PageSetup.php\":\"daa89e4bf8a6d7258ac1bcaa889c518f\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Worksheet\\/Protection.php\":\"2fb90091fdcd91c7033e2b9d43cd89b0\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Worksheet\\/Row.php\":\"2aab5b22f214a5fa75ff9d57f1dcf4fd\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Worksheet\\/RowDimension.php\":\"eb2c70a5c76c563e7e350275c8ea8b31\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Worksheet\\/RowIterator.php\":\"a6af0861d20de8d67561f9c09aee738e\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Worksheet\\/SheetView.php\":\"3f13f4441c56f049f641638ed8523035\",\"lib\\\\phpexcel\\\\PHPExcel\\/Worksheet.php\":\"6e58f3763d79400efb63ce5c692dfdb4\",\"lib\\\\phpexcel\\\\PHPExcel\\/WorksheetIterator.php\":\"af897df7208934f59a4f5746db0f3e7c\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Writer\\/Abstract.php\":\"58faad0c53a97548125937e2ac0079e7\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Writer\\/CSV.php\":\"8b202634562ae4c51e87598498acfb9d\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Writer\\\\Excel2007\\/Chart.php\":\"d4e5e96dcf25b31361aa0ef68ea9dad2\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Writer\\\\Excel2007\\/Comments.php\":\"a51ecda844cf3dd21ab391e71d8f9af0\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Writer\\\\Excel2007\\/ContentTypes.php\":\"d36e0b9cb8cda905d16adb7f4ac97832\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Writer\\\\Excel2007\\/DocProps.php\":\"e78a29ba0df7c9bef147defe5ed5c296\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Writer\\\\Excel2007\\/Drawing.php\":\"6148d30ad1a4bdd7d0937358d6b461e7\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Writer\\\\Excel2007\\/Rels.php\":\"c38cfaedd5384ac4c0ba3765581d9475\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Writer\\\\Excel2007\\/RelsRibbon.php\":\"9ca66b984093a947484d8b50abaa4329\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Writer\\\\Excel2007\\/RelsVBA.php\":\"1db9cc9d11e448fe8b6668158c187728\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Writer\\\\Excel2007\\/StringTable.php\":\"91784f44ac5d4a6ca2290e44242c4d3b\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Writer\\\\Excel2007\\/Style.php\":\"c2bfcd0f8843aa94180737e3c6824593\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Writer\\\\Excel2007\\/Theme.php\":\"5a4b646decff7132463240f4f57b3592\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Writer\\\\Excel2007\\/Workbook.php\":\"c20ba6ecad9f9c1d2a041c9aa59410f2\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Writer\\\\Excel2007\\/Worksheet.php\":\"7a8bab6fc66b5d2ce4f152bcabb0acbc\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Writer\\\\Excel2007\\/WriterPart.php\":\"ed2e03a937832c0f36ef4ab568db8105\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Writer\\/Excel2007.php\":\"a52e6402293e6704ece85c2abbbc244b\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Writer\\\\Excel5\\/BIFFwriter.php\":\"ff8cffaec052817493a619c4b5de14bb\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Writer\\\\Excel5\\/Escher.php\":\"435a535b406ba64c00f9d6eca9455f30\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Writer\\\\Excel5\\/Font.php\":\"8cd1881440ae64839a38ff9838ea6aff\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Writer\\\\Excel5\\/Parser.php\":\"bbeb679422f9fd8474d9c635d6a81806\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Writer\\\\Excel5\\/Workbook.php\":\"aca6d8c08e6c663bea2a2e89811a7c58\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Writer\\\\Excel5\\/Worksheet.php\":\"3ddfb7689e5681029ebe9d8308fbe2c6\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Writer\\\\Excel5\\/Xf.php\":\"c5b833c89e8077c9a61ff61d82cda36b\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Writer\\/Excel5.php\":\"e3ec127b7e8b2bd7e8e1766d1a36db7b\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Writer\\/Exception.php\":\"38b17de188c75ee96abcedfbad061a58\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Writer\\/HTML.php\":\"c125f0136ce8d49614938238294fe6b0\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Writer\\/IWriter.php\":\"16915cb7d9769afd557cf5ec03de59a4\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Writer\\\\PDF\\/Core.php\":\"3c0b5fd7b2a333bce8026e36d3b551ac\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Writer\\\\PDF\\/DomPDF.php\":\"653edba822938ce0b1589595b26ab274\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Writer\\\\PDF\\/mPDF.php\":\"2868b5c28a90d590cbf4413c8aead039\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Writer\\\\PDF\\/tcPDF.php\":\"d714db26f9bbae92fcfe6189feb04af3\",\"lib\\\\phpexcel\\\\PHPExcel\\\\Writer\\/PDF.php\":\"c1be273bd3bcaa02fde483945228edef\",\"lib\\\\phpexcel\\\\PHPExcel\\\\locale\\\\bg\\/config\":\"a4de80718e7e6be4513f6285140e68f7\",\"lib\\\\phpexcel\\\\PHPExcel\\\\locale\\\\cs\\/config\":\"5bec343ec684797f504042520ee2d770\",\"lib\\\\phpexcel\\\\PHPExcel\\\\locale\\\\cs\\/functions\":\"dd9b6a53208a2d9128a0dbed5a192c61\",\"lib\\\\phpexcel\\\\PHPExcel\\\\locale\\\\da\\/config\":\"3c9e6275eeb4e3e8b0227e6fa1cc7e99\",\"lib\\\\phpexcel\\\\PHPExcel\\\\locale\\\\da\\/functions\":\"2be89aab61a219f5102367274eb6ebbd\",\"lib\\\\phpexcel\\\\PHPExcel\\\\locale\\\\de\\/config\":\"eb1de3a4a017502843d25740d42f0a2c\",\"lib\\\\phpexcel\\\\PHPExcel\\\\locale\\\\de\\/functions\":\"000406260d68b33e72ea78dfeb00b5ff\",\"lib\\\\phpexcel\\\\PHPExcel\\\\locale\\\\en\\\\uk\\/config\":\"24025d0951937faf37cf1c6e0f3dc126\",\"lib\\\\phpexcel\\\\PHPExcel\\\\locale\\\\es\\/config\":\"65290b4e3b67ebb9a97a90b9222c7e15\",\"lib\\\\phpexcel\\\\PHPExcel\\\\locale\\\\es\\/functions\":\"a703deb701efd97e00291db5333afb3c\",\"lib\\\\phpexcel\\\\PHPExcel\\\\locale\\\\fi\\/config\":\"14d9c9df4ce03460ea96c3d80399ae57\",\"lib\\\\phpexcel\\\\PHPExcel\\\\locale\\\\fi\\/functions\":\"b5e2892f1b2a3a4961e1afcc3a6ee640\",\"lib\\\\phpexcel\\\\PHPExcel\\\\locale\\\\fr\\/config\":\"027f624b5a6e245629eb0c61e3885e32\",\"lib\\\\phpexcel\\\\PHPExcel\\\\locale\\\\fr\\/functions\":\"a77aca7f185e1d209515a4496bafee4e\",\"lib\\\\phpexcel\\\\PHPExcel\\\\locale\\\\hu\\/config\":\"5fa5ca22943755f450c54c677cdc9746\",\"lib\\\\phpexcel\\\\PHPExcel\\\\locale\\\\hu\\/functions\":\"1fb62789d3bac98fa779cd4b41b586ae\",\"lib\\\\phpexcel\\\\PHPExcel\\\\locale\\\\it\\/config\":\"150afe868eb2c018cf6821f24e4cbd61\",\"lib\\\\phpexcel\\\\PHPExcel\\\\locale\\\\it\\/functions\":\"33abdfe7001d4fdbe302900074323b0e\",\"lib\\\\phpexcel\\\\PHPExcel\\\\locale\\\\nl\\/config\":\"491f94c0f2bfb810f70ad2318163cd4d\",\"lib\\\\phpexcel\\\\PHPExcel\\\\locale\\\\nl\\/functions\":\"0c67a37f97efc98f45722cc2f4fcc35b\",\"lib\\\\phpexcel\\\\PHPExcel\\\\locale\\\\no\\/config\":\"279bbcda77bc7f0730e22a4bea7e3802\",\"lib\\\\phpexcel\\\\PHPExcel\\\\locale\\\\no\\/functions\":\"5028d6a07e300f28f5ee32bb5aae7133\",\"lib\\\\phpexcel\\\\PHPExcel\\\\locale\\\\pl\\/config\":\"6a58549706b2da7200b5d78f4ab41f92\",\"lib\\\\phpexcel\\\\PHPExcel\\\\locale\\\\pl\\/functions\":\"38738374816955fbdff6f86f6fa8a94a\",\"lib\\\\phpexcel\\\\PHPExcel\\\\locale\\\\pt\\\\br\\/config\":\"f43c1e73bb43432e18d724b8f5b478c5\",\"lib\\\\phpexcel\\\\PHPExcel\\\\locale\\\\pt\\\\br\\/functions\":\"c4790f115b3abc4a12c66b943c1902a9\",\"lib\\\\phpexcel\\\\PHPExcel\\\\locale\\\\pt\\/config\":\"da578667203b7cda77565744077e7841\",\"lib\\\\phpexcel\\\\PHPExcel\\\\locale\\\\pt\\/functions\":\"d7cd17cfee5fddc681e19f9e59ddd133\",\"lib\\\\phpexcel\\\\PHPExcel\\\\locale\\\\ru\\/config\":\"567fc66512232e26a7fb27f953190805\",\"lib\\\\phpexcel\\\\PHPExcel\\\\locale\\\\ru\\/functions\":\"3ee40439feab895f7b43021bc3ee0d74\",\"lib\\\\phpexcel\\\\PHPExcel\\\\locale\\\\sv\\/config\":\"e1db96fd21891c616ba3ea744fea210d\",\"lib\\\\phpexcel\\\\PHPExcel\\\\locale\\\\sv\\/functions\":\"c61ab2dbccc729b8587a118debbce06b\",\"lib\\\\phpexcel\\\\PHPExcel\\\\locale\\\\tr\\/config\":\"579938059c4a3c5114e398229ca5d081\",\"lib\\\\phpexcel\\\\PHPExcel\\\\locale\\\\tr\\/functions\":\"f1d72a47a1efcefe2979d5c12db88a6c\",\"lib\\\\phpexcel\\/license.txt\":\"20c56adc22ef33765d16ea446dd3f8eb\",\"lib\\\\phpexcel\\/phpexcel.class.php\":\"ea9a1482ad33f300fe916ba0fec4c6b7\",\"lib\\\\phpexcel\\\\xlsx\\/[Content_Types].xml\":\"b7c962ec584d327ca563db65e80817bb\",\"lib\\\\phpexcel\\\\xlsx\\\\_rels\\/.rels\":\"69984e911a8e36d7f6eab75bf36c6d01\",\"lib\\\\phpexcel\\\\xlsx\\\\docProps\\/app.xml\":\"7f19328624573616db5616dbe9f1d719\",\"lib\\\\phpexcel\\\\xlsx\\\\docProps\\/core.xml\":\"0124609a2361b28f0f5387a4b68882fd\",\"lib\\\\phpexcel\\\\xlsx\\\\xl\\\\_rels\\/workbook.xml.rels\":\"9f4304783718c06e9f5f47f0ed36154a\",\"lib\\\\phpexcel\\\\xlsx\\\\xl\\/sharedStrings.xml\":\"355f88cfcf136bd5eb683455adff72a9\",\"lib\\\\phpexcel\\\\xlsx\\\\xl\\/styles.xml\":\"ef8301646bf59d22ba807460053c378e\",\"lib\\\\phpexcel\\\\xlsx\\\\xl\\\\theme\\/theme1.xml\":\"8ce5097bcaf2efe71b4068215d97b6de\",\"lib\\\\phpexcel\\\\xlsx\\\\xl\\/workbook.xml\":\"c8d1b6ee975cdda765fab6034b660a79\",\"lib\\\\phpexcel\\\\xlsx\\\\xl\\\\worksheets\\/sheet1.xml\":\"4b19e570856996aa3ab10402a8be6fb4\",\"lib\\\\phpexcel\\\\xlsx\\\\xl\\\\worksheets\\/sheet2.xml\":\"29b1e8377119900ec0c8717318de7364\",\"module\\\\bug\\\\ext\\\\config\\/excel.php\":\"faf188ad17358e19bb324db477666a39\",\"module\\\\bug\\\\ext\\\\control\\/export.php\":\"f6bbff0467d313ce374fb1bb9131b4a5\",\"module\\\\bug\\\\ext\\\\control\\/exporttemplet.php\":\"4f449e8ad5d3ea21321d9075c38f6acc\",\"module\\\\bug\\\\ext\\\\control\\/import.php\":\"cf8c53de85ea8293dea2924c94885fd4\",\"module\\\\bug\\\\ext\\\\control\\/showimport.php\":\"1b8dfda086c170468739bb6d10a31cac\",\"module\\\\bug\\\\ext\\\\css\\\\browse\\/excel.css\":\"d41d8cd98f00b204e9800998ecf8427e\",\"module\\\\bug\\\\ext\\\\css\\\\showimport\\/excel.css\":\"9c53e5037a3111b50827242d531d4eed\",\"module\\\\bug\\\\ext\\\\lang\\\\en\\/execel.php\":\"32b479bf20f8aad2334cb7a471019db0\",\"module\\\\bug\\\\ext\\\\lang\\\\zh-cn\\/execel.php\":\"cd9c6ad990de2a2ab722e37ce1f4754d\",\"module\\\\bug\\\\ext\\\\lang\\\\zh-tw\\/execel.php\":\"b3806391c7de759baf0ae733d63401d0\",\"module\\\\bug\\\\ext\\\\model\\\\class\\/excel.class.php\":\"95ba5e865719eb6f809efa2e4a796069\",\"module\\\\bug\\\\ext\\\\model\\/excel.php\":\"6453ab7ad3d393be8330b70e9a7e8701\",\"module\\\\bug\\\\ext\\\\view\\/browse.excel.html.hook.php\":\"f7c2233ee33ab3377554c22c2d9d870e\",\"module\\\\bug\\\\ext\\\\view\\/exporttemplet.html.php\":\"f0cc34d278a60f40379ee6769180488a\",\"module\\\\bug\\\\ext\\\\view\\/import.html.php\":\"cd9f8b818f636095bc04e3f8470f886d\",\"module\\\\bug\\\\ext\\\\view\\/showimport.html.php\":\"1c2c8d5aff9d8fbdb1716cceba41c7cc\",\"module\\\\common\\\\ext\\\\lang\\\\en\\/excel.php\":\"4ee38323bf2ba71d76c7c02520962646\",\"module\\\\common\\\\ext\\\\lang\\\\zh-cn\\/excel.php\":\"6f55259ac6341b124ba74ef245ba2431\",\"module\\\\common\\\\ext\\\\lang\\\\zh-tw\\/excel.php\":\"8d212716fb02baa01f0a12fdf1a1dd78\",\"module\\\\common\\\\ext\\\\view\\/affix.html.php\":\"2859301f4352d568e80ae792d9b02169\",\"module\\\\file\\\\ext\\\\config\\/excel.php\":\"393dd40e8a01b9d59e4f8b24ff87d5fa\",\"module\\\\file\\\\ext\\\\control\\/export2xls.php\":\"046240d66d5452971d657475c3fe86ef\",\"module\\\\file\\\\ext\\\\control\\/export2xlsx.php\":\"5d430d96f7ff9fd049570c355c8d99aa\",\"module\\\\file\\\\ext\\\\lang\\\\en\\/excel.php\":\"58d05c91af36cb6df45cd4fd9b4ab3c6\",\"module\\\\file\\\\ext\\\\lang\\\\zh-cn\\/excel.php\":\"c8cee3bce0cc682f5250314f7c08431f\",\"module\\\\file\\\\ext\\\\lang\\\\zh-tw\\/excel.php\":\"f6fd4d6a0a5433037b64d31944de128f\",\"module\\\\file\\\\ext\\\\model\\\\class\\/excel.class.php\":\"0b87aa6190435a1d6a47055a2c2646b5\",\"module\\\\file\\\\ext\\\\model\\/excel.php\":\"d28d0e9255334313d63796bde0de7bea\",\"module\\\\group\\\\ext\\\\lang\\\\en\\/excel.php\":\"a423c526bb48e114b4524b4c4cf5b47f\",\"module\\\\group\\\\ext\\\\lang\\\\zh-cn\\/excel.php\":\"a423c526bb48e114b4524b4c4cf5b47f\",\"module\\\\group\\\\ext\\\\lang\\\\zh-tw\\/excel.php\":\"a423c526bb48e114b4524b4c4cf5b47f\",\"module\\\\product\\\\ext\\\\css\\\\browse\\/excel.css\":\"d41d8cd98f00b204e9800998ecf8427e\",\"module\\\\product\\\\ext\\\\view\\/browse.excel.html.hook.php\":\"925d91cbb89b02046e4f5ed6df80e2b5\",\"module\\\\project\\\\ext\\\\css\\\\task\\/execl.css\":\"d41d8cd98f00b204e9800998ecf8427e\",\"module\\\\project\\\\ext\\\\view\\/task.excel.html.hook.php\":\"cd2af48d73c390113c39c3d8b5205a28\",\"module\\\\story\\\\ext\\\\config\\/excel.php\":\"afe67f5c064fdf39f3c51edca9a16a6a\",\"module\\\\story\\\\ext\\\\control\\/export.php\":\"b8d2e886360232cc4f89f9298c57ca15\",\"module\\\\story\\\\ext\\\\control\\/exporttemplet.php\":\"9ce52fc73e9fd53e1c4ce7af5242c142\",\"module\\\\story\\\\ext\\\\control\\/import.php\":\"bd17f1d9cbd6c8e9e639b2769b44b4a7\",\"module\\\\story\\\\ext\\\\control\\/showimport.php\":\"093400230e0026cd335f99ed9ee01052\",\"module\\\\story\\\\ext\\\\css\\\\showimport\\/excel.css\":\"9c53e5037a3111b50827242d531d4eed\",\"module\\\\story\\\\ext\\\\lang\\\\en\\/execel.php\":\"7520f0c0c865551b7abd98a0f608d9fd\",\"module\\\\story\\\\ext\\\\lang\\\\zh-cn\\/execel.php\":\"3283f60d85f54fee31b23b8c2e714612\",\"module\\\\story\\\\ext\\\\lang\\\\zh-tw\\/execel.php\":\"e6315b7ae67c37178b1d26e83f7de060\",\"module\\\\story\\\\ext\\\\model\\\\class\\/excel.class.php\":\"ba0f693e478d79a96e691b8082352a4c\",\"module\\\\story\\\\ext\\\\model\\/excel.php\":\"6453ab7ad3d393be8330b70e9a7e8701\",\"module\\\\story\\\\ext\\\\view\\/exporttemplet.html.php\":\"1b0b9bfe768093756ad33bf0b9abed7b\",\"module\\\\story\\\\ext\\\\view\\/import.html.php\":\"ba0754bb0a3e1290e2e88b3af10cc352\",\"module\\\\story\\\\ext\\\\view\\/showimport.html.php\":\"cf5448486ff5ca610a73865f1938d305\",\"module\\\\task\\\\ext\\\\config\\/excel.php\":\"0b9f9e87b469276aea20068158f9d193\",\"module\\\\task\\\\ext\\\\control\\/export.php\":\"27420ac495bc19b7a3ffd080936c5b5a\",\"module\\\\task\\\\ext\\\\control\\/exporttemplet.php\":\"aedb98a3da4123d197f98b93638d06b1\",\"module\\\\task\\\\ext\\\\control\\/import.php\":\"36a87c22bd2860026fc419953a32114a\",\"module\\\\task\\\\ext\\\\control\\/showimport.php\":\"615858c836638cfdb69481a0d61aa952\",\"module\\\\task\\\\ext\\\\css\\\\showimport\\/excel.css\":\"9c53e5037a3111b50827242d531d4eed\",\"module\\\\task\\\\ext\\\\lang\\\\en\\/execel.php\":\"5a48780ccac1f728afcbf1b1c67e2b42\",\"module\\\\task\\\\ext\\\\lang\\\\zh-cn\\/execel.php\":\"abe1f7db6ed52c8ab6fa686873ef1b9d\",\"module\\\\task\\\\ext\\\\lang\\\\zh-tw\\/execel.php\":\"41d22600dfcde02a629060ab7b068b32\",\"module\\\\task\\\\ext\\\\model\\\\class\\/excel.class.php\":\"7168024b090a852b5e95815f29050af6\",\"module\\\\task\\\\ext\\\\model\\/excel.php\":\"df74dad0e16dc851ca68eeb99e775b3a\",\"module\\\\task\\\\ext\\\\view\\/exporttemplet.html.php\":\"5d230f1b72c11fc22264c29e10dfdbf4\",\"module\\\\task\\\\ext\\\\view\\/import.html.php\":\"e7cc07014f250be8be6fa44cc0021ce2\",\"module\\\\task\\\\ext\\\\view\\/showimport.html.php\":\"3b13258b932ffd8d40a8985bd5972142\",\"module\\\\testcase\\\\ext\\\\config\\/excel.php\":\"b5ac0f884456f2e9c92ddca336746d97\",\"module\\\\testcase\\\\ext\\\\control\\/export.php\":\"871ffb8e51d1b148bed9229a18eeb213\",\"module\\\\testcase\\\\ext\\\\control\\/exporttemplet.php\":\"ce75edf981a33c942a87b2a300c74ca9\",\"module\\\\testcase\\\\ext\\\\control\\/import.php\":\"02a25ce8b78a78315b384c7ec5b8f4da\",\"module\\\\testcase\\\\ext\\\\control\\/showimport.php\":\"dc34403ffd26de264959b55fefdbcc74\",\"module\\\\testcase\\\\ext\\\\css\\\\browse\\/excel.css\":\"d41d8cd98f00b204e9800998ecf8427e\",\"module\\\\testcase\\\\ext\\\\lang\\\\en\\/execel.php\":\"a33dca74e2a033b8b2154b22c5234c99\",\"module\\\\testcase\\\\ext\\\\lang\\\\zh-cn\\/execel.php\":\"ada73d071ab8f202b9b263353d96c9ad\",\"module\\\\testcase\\\\ext\\\\lang\\\\zh-tw\\/execel.php\":\"aeeb08ccee6727c3727680d3b14387a1\",\"module\\\\testcase\\\\ext\\\\model\\\\class\\/excel.class.php\":\"8baffc8de7097854ce48f4c2a5beb70c\",\"module\\\\testcase\\\\ext\\\\model\\/excel.php\":\"6453ab7ad3d393be8330b70e9a7e8701\",\"module\\\\testcase\\\\ext\\\\view\\/browse.excel.html.hook.php\":\"451775330cfe55aa22d442bb30c4bb81\",\"module\\\\testcase\\\\ext\\\\view\\/exporttemplet.html.php\":\"e4d165ca73865935ce29504fdcb03f90\",\"module\\\\testcase\\\\ext\\\\view\\/import.html.php\":\"38ed22d790acefe802681816c72fee9e\",\"module\\\\testcase\\\\ext\\\\view\\/showimport.html.php\":\"d4e9198eedd36df15743d13d3897519a\"}',`installedTime` = '2016-11-21 14:51:22' WHERE code  = 'excel'

20161121 14:51:57: extension-browse
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_extension` WHERE status  = 'installed'

20161121 15:14:57: extension-obtain-bySearch
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_extension` WHERE status  = 'installed'

20161121 15:15:20: extension-obtain-bySearch
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_extension` WHERE status  = 'installed'

