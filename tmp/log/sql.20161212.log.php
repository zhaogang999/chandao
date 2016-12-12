<?php
 die();
?>
20161212 09:31:11: 
  SELECT * FROM `zt_company` ORDER BY `id`  LIMIT 1 
  SELECT * FROM `zt_config` WHERE owner IN ('system','') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_user` WHERE account  = 'admin' AND  deleted  = '0'

20161212 09:31:11: user-login-Lw==
  SELECT * FROM `zt_config` WHERE owner IN ('system','') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT account, realname, deleted FROM `zt_user` WHERE deleted  = '0' ORDER BY `account` 

20161212 09:31:27: user-login-Lw==
  SELECT * FROM `zt_config` WHERE owner IN ('system','') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT locked FROM `zt_user` WHERE account  = 'admin'
  SELECT * FROM `zt_user` WHERE account  = 'admin' AND  deleted  = '0'
  UPDATE `zt_user` SET  visits = visits + 1, `ip` = '127.0.0.1', `last` = '1481506286' WHERE account  = 'admin'
  UPDATE `zt_user` SET  `fails` = '0', `locked` = '0000-00-00 00:00:00' WHERE account  = 'admin'
  SELECT t1.acl FROM `zt_group` AS t1  LEFT JOIN `zt_usergroup` AS t2  ON t1.id=t2.group  WHERE t2.account  = 'admin'
  SELECT module, method FROM `zt_usergroup` AS t1  LEFT JOIN `zt_grouppriv` AS t2  ON t1.group = t2.group  WHERE t1.account  = 'admin'
  SELECT `group` FROM `zt_usergroup` WHERE `account` = 'admin' 
  INSERT INTO `zt_action` SET `objectType` = 'user',`objectID` = '1',`actor` = 'admin',`action` = 'login',`date` = '2016-12-12 09:31:26',`comment` = '',`extra` = '',`product` = ',0,',`project` = '0'

20161212 09:31:27: 
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 09:31:28: my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE account  = 'admin' AND  module  = 'my' AND  hidden  = '0' ORDER BY `order` 

20161212 09:31:29: block-printBlock-1-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '1'

20161212 09:31:30: block-printBlock-2-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '2'
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT * FROM `zt_action` WHERE 1  AND  date  > '2016-12-12' AND  date  < '2016-12-13' AND  (1)  ORDER BY `date` desc 
  SELECT commiter, account, realname FROM `zt_user` WHERE commiter  != ''
  SELECT id, account AS name FROM `zt_user` WHERE id IN ('1')
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 

20161212 09:31:30: block-printBlock-3-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '3'
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  status  != 'done' AND  deleted  = '0' ORDER BY `order` desc 
  SELECT * FROM `zt_project` WHERE id IN ('4','3','2') ORDER BY `order` desc 
  SELECT COUNT(*) AS recTotal FROM `zt_project` WHERE id IN ('4','3','2') 
  SELECT * FROM `zt_project` WHERE id IN ('4','3','2') ORDER BY `order` desc 
  SELECT id, project, estimate, consumed, `left`, status, closedReason FROM `zt_task` WHERE project IN ('4','3','2') AND  deleted  = '0'
  SELECT project, date AS name, `left` AS value FROM `zt_burn` WHERE project IN ('4','3','2') ORDER BY `date` desc 

20161212 09:31:31: block-printBlock-5-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '5'
  SELECT * FROM `zt_product` WHERE deleted  = '0' AND  status  != 'closed' ORDER BY `order` desc 
  SELECT * FROM `zt_product` WHERE id IN ('3','2','1') ORDER BY `order` desc 
  SELECT COUNT(*) AS recTotal FROM `zt_product` WHERE id IN ('3','2','1') 
  SELECT * FROM `zt_product` WHERE id IN ('3','2','1') ORDER BY `order` desc 
  SELECT product, status, count(status) AS count FROM `zt_story` WHERE deleted  = '0' AND  product IN ('3','2','1') GROUP BY product, status
  SELECT product, count(*) AS count FROM `zt_productplan` WHERE deleted  = '0' AND  product IN ('3','2','1') AND  end  > '2016-12-12 09:31:30' GROUP BY product
  SELECT product, count(*) AS count FROM `zt_release` WHERE deleted  = '0' AND  product IN ('3','2','1') GROUP BY product
  SELECT product,count(*) AS conut FROM `zt_bug` WHERE deleted  = '0' AND  product IN ('3','2','1') GROUP BY product
  SELECT product,count(*) AS count FROM `zt_bug` WHERE status  = 'active' AND  deleted  = '0' AND  product IN ('3','2','1') GROUP BY product
  SELECT product,count(*) AS count FROM `zt_bug` WHERE AssignedTo  = '' AND  deleted  = '0' AND  product IN ('3','2','1') GROUP BY product

20161212 09:31:31: block-printBlock-4-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '4'
  SELECT * FROM `zt_todo` WHERE account  = 'admin' AND  date  >= '1970-01-01' AND  date  <= '2109-01-01' AND  status IN ('wait','doing') ORDER BY `date`,`status`,`begin`  LIMIT 20 
  SELECT * FROM `zt_todo` WHERE account  = 'admin' AND  date  >= '1970-01-01' AND  date  <= '2109-01-01' AND  status IN ('wait','doing') ORDER BY `date`,`status`,`begin`  LIMIT 20 

20161212 09:31:31: block-printBlock-6-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '6'
  SELECT t1.*, t2.id as projectID, t2.name as projectName, t3.id as storyID, t3.title as storyTitle, t3.status AS storyStatus, t3.version AS latestStoryVersion FROM `zt_task` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project = t2.id  LEFT JOIN `zt_story` AS t3  ON t1.story = t3.id  WHERE t1.deleted  = '0' AND  t1.assignedTo  = 'admin' ORDER BY `id` desc  LIMIT 15 
  SELECT t1.*, t2.id as projectID, t2.name as projectName, t3.id as storyID, t3.title as storyTitle, t3.status AS storyStatus, t3.version AS latestStoryVersion FROM `zt_task` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project = t2.id  LEFT JOIN `zt_story` AS t3  ON t1.story = t3.id  WHERE t1.deleted  = '0' AND  t1.assignedTo  = 'admin' ORDER BY `id` desc  LIMIT 15 

20161212 09:31:31: block-printBlock-7-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '7'
  SELECT * FROM `zt_bug` WHERE deleted  = '0' AND  assignedTo  = 'admin' ORDER BY `id` desc  LIMIT 15 

20161212 09:31:31: block-printBlock-8-my
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

20161212 09:31:31: block-printBlock-9-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '9'
  SELECT t1.assignedTo AS assignedTo, t2.* FROM `zt_testrun` AS t1  LEFT JOIN `zt_case` AS t2  ON t1.case = t2.id  LEFT JOIN `zt_testtask` AS t3  ON t1.task = t3.id  WHERE t1.assignedTo  = 'admin' AND  t1.status  != 'done' AND  t3.status  != 'done' AND  t3.deleted  = '0' AND  t2.deleted  = '0' ORDER BY `id` desc  LIMIT 15 

20161212 09:31:34: product
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 

20161212 09:31:34: product-browse
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_story` WHERE product IN ('1') AND  status IN ('','draft','active','changed') AND  deleted  = '0' ORDER BY `id` desc 
  SELECT COUNT(*) AS recTotal FROM `zt_story` WHERE product IN ('1') AND  status IN ('','draft','active','changed') AND  deleted  = '0' 
  SELECT * FROM `zt_story` WHERE product IN ('1') AND  status IN ('','draft','active','changed') AND  deleted  = '0' ORDER BY `id` desc 
  SELECT * FROM `zt_story` WHERE product IN ('1') AND  status IN ('','draft','active','changed') AND  deleted  = '0' ORDER BY `id` desc 
  SELECT id,title FROM `zt_productplan` WHERE product IN ('1') AND  deleted  = '0'
  SELECT * FROM `zt_storystage` WHERE branch IN ('0')
  SELECT * FROM `zt_story` WHERE product IN ('1') AND  status IN ('','draft','active','changed') AND  deleted  = '0' ORDER BY `id` desc 
  SELECT id,CONCAT(title, " [", begin, " ~ ", end, "]") as title FROM `zt_productplan` WHERE product IN ('1') AND  deleted  = '0' ORDER BY `begin` desc 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_module` WHERE root  = '1' AND  type  = 'story' ORDER BY `grade` desc,`order` 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT id,CONCAT(title, " [", begin, " ~ ", end, "]") as title FROM `zt_productplan` WHERE product IN ('1') AND  deleted  = '0' ORDER BY `begin` desc 
  SELECT DISTINCT story FROM `zt_case` WHERE story IN ('33','7','6','5','4','3','2','1')
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_module` WHERE root  = '1' AND  type  = 'story' ORDER BY `grade` desc,`order` 
  SELECT account, realname, deleted, INSTR(',pd,po,', role) AS roleOrder FROM `zt_user` WHERE deleted  = '0' ORDER BY `roleOrder` DESC,`account` 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_module` WHERE root  = '1' AND  type  = 'story' ORDER BY `grade` desc,`order` 
  SELECT * FROM `zt_branch` WHERE product  = '1' AND  deleted  = '0' ORDER BY `id` asc 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_storystage` WHERE story IN ('33','7','6','5','4','3','2','1')

20161212 09:32:34: doc-objectLibs-product-1-product
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT id,name FROM `zt_product` WHERE id  = '1'
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_doclib` WHERE deleted  = '0' AND  product  = '1' ORDER BY `id` 
  SELECT DISTINCT product FROM `zt_projectproduct` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project=t2.id  WHERE t1.product  = '1' AND  t2.deleted  = '0'

20161212 09:32:37: doc-browse-1-all-0-id_desc-product
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_doclib` WHERE `id` = '1' 
  SELECT t1.* FROM `zt_doclib` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product=t2.id  WHERE t1.product  != '0' AND  t1.deleted  = '0' ORDER BY t2.`order` desc,t1.`id` 
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_doc` WHERE deleted  = '0' AND  lib IN ('1') ORDER BY `id` desc 
  SELECT COUNT(*) AS recTotal FROM `zt_doc` WHERE deleted  = '0' AND  lib IN ('1') 
  SELECT * FROM `zt_doc` WHERE deleted  = '0' AND  lib IN ('1') ORDER BY `id` desc 
  SELECT * FROM `zt_doc` WHERE deleted  = '0' AND  lib IN ('1') ORDER BY `id` desc 
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT openedVersion FROM `zt_project` WHERE id  = '1doc'
  SELECT * FROM `zt_module` WHERE root  = '1' AND  type  = '0' ORDER BY `grade` desc,`order` 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_module` WHERE root  = '1' AND  type  = 'doc' ORDER BY `grade` desc,`order` 
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 

20161212 09:32:42: doc-create-1-0
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_doclib` WHERE `id` = '1' 
  SELECT t1.* FROM `zt_doclib` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product=t2.id  WHERE t1.product  != '0' AND  t1.deleted  = '0' ORDER BY t2.`order` desc,t1.`id` 
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_module` WHERE root  = '1' AND  type  = 'doc' ORDER BY `grade` desc,`order` 
  SELECT id, name FROM `zt_group`
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 

20161212 09:32:43: file-ajaxUeditorUpload-584dfe3a77d26
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 09:37:22: doc-create-1-0
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_doclib` WHERE `id` = '1' 

20161212 09:37:34: doc-create-1-0
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT id,title FROM `zt_doc` WHERE deleted  = '0' AND  title IN ('rdfgrgs') AND  addedDate  >= '2016-12-12 09:36:34' AND  lib = '1' AND module = 0 
  SELECT * FROM `zt_doclib` WHERE `id` = '1' 
  INSERT INTO `zt_doc` SET `lib` = '1',`module` = '0',`title` = 'rdfgrgs',`keywords` = '',`type` = 'url',`acl` = 'open',`users` = '',`addedBy` = 'admin',`addedDate` = '2016-12-12 09:37:34',`version` = '1',`product` = '1',`project` = '0'
  INSERT INTO `zt_doccontent` SET `title` = 'rdfgrgs',`content` = 'fgggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggghhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh',`type` = 'html',`version` = '1',`doc` = '1',`files` = ''
  SELECT * FROM `zt_doclib` WHERE `id` = '1' 
  SELECT product, project FROM `zt_doc` WHERE id  = '1'
  INSERT INTO `zt_action` SET `objectType` = 'doc',`objectID` = '1',`actor` = 'admin',`action` = 'created',`date` = '2016-12-12 09:37:34',`comment` = '',`extra` = '',`product` = ',1,',`project` = '0'

20161212 09:37:34: doc-browse-1-byModule-0-id_desc-product
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_doclib` WHERE `id` = '1' 
  SELECT t1.* FROM `zt_doclib` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product=t2.id  WHERE t1.product  != '0' AND  t1.deleted  = '0' ORDER BY t2.`order` desc,t1.`id` 
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_doc` WHERE deleted  = '0' AND  lib IN ('1') ORDER BY `id` desc 
  SELECT COUNT(*) AS recTotal FROM `zt_doc` WHERE deleted  = '0' AND  lib IN ('1') 
  SELECT * FROM `zt_doc` WHERE deleted  = '0' AND  lib IN ('1') ORDER BY `id` desc 
  SELECT * FROM `zt_doc` WHERE deleted  = '0' AND  lib IN ('1') ORDER BY `id` desc 
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT openedVersion FROM `zt_project` WHERE id  = '1doc'
  SELECT * FROM `zt_module` WHERE root  = '1' AND  type  = '0' ORDER BY `grade` desc,`order` 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_module` WHERE root  = '1' AND  type  = 'doc' ORDER BY `grade` desc,`order` 
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 

20161212 09:37:39: doc-view-1
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_doc` WHERE id  = '1'
  SELECT * FROM `zt_doccontent` WHERE doc  = '1' AND  version  = '1'
  SELECT * FROM `zt_file` WHERE objectType  = 'doc' AND  objectID  = '1' AND  extra  != 'editor'
  SELECT name FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_doclib` WHERE `id` = '1' 
  SELECT t1.* FROM `zt_doclib` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product=t2.id  WHERE t1.product  != '0' AND  t1.deleted  = '0' ORDER BY t2.`order` desc,t1.`id` 
  SELECT * FROM `zt_doclib` WHERE `id` = '1' 
  SELECT id,name FROM `zt_product` WHERE id  = '1'
  SELECT commiter, account, realname FROM `zt_user` WHERE commiter  != ''
  SELECT * FROM `zt_action` WHERE objectType  = 'doc' AND  objectID  = '1' ORDER BY `date` desc 
  SELECT * FROM `zt_history` WHERE action IN ('753') ORDER BY `id` 
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 
  SELECT * FROM `zt_doc` WHERE id  = '1' OR deleted  = '0' AND  lib IN ('1')  ORDER BY `id` desc 

20161212 09:37:40: file-ajaxUeditorUpload-584dff638ad58
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 09:38:08: doc-objectLibs-product-1-product
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT id,name FROM `zt_product` WHERE id  = '1'
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_doclib` WHERE deleted  = '0' AND  product  = '1' ORDER BY `id` 
  SELECT DISTINCT product FROM `zt_projectproduct` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project=t2.id  WHERE t1.product  = '1' AND  t2.deleted  = '0'

20161212 09:38:15: doc-browse-1-all-0-id_desc-product
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_doclib` WHERE `id` = '1' 
  SELECT t1.* FROM `zt_doclib` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product=t2.id  WHERE t1.product  != '0' AND  t1.deleted  = '0' ORDER BY t2.`order` desc,t1.`id` 
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_doc` WHERE deleted  = '0' AND  lib IN ('1') ORDER BY `id` desc 
  SELECT COUNT(*) AS recTotal FROM `zt_doc` WHERE deleted  = '0' AND  lib IN ('1') 
  SELECT * FROM `zt_doc` WHERE deleted  = '0' AND  lib IN ('1') ORDER BY `id` desc 
  SELECT * FROM `zt_doc` WHERE deleted  = '0' AND  lib IN ('1') ORDER BY `id` desc 
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT openedVersion FROM `zt_project` WHERE id  = '1doc'
  SELECT * FROM `zt_module` WHERE root  = '1' AND  type  = '0' ORDER BY `grade` desc,`order` 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_module` WHERE root  = '1' AND  type  = 'doc' ORDER BY `grade` desc,`order` 
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 

20161212 09:38:19: doc-create-1-0
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_doclib` WHERE `id` = '1' 
  SELECT t1.* FROM `zt_doclib` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product=t2.id  WHERE t1.product  != '0' AND  t1.deleted  = '0' ORDER BY t2.`order` desc,t1.`id` 
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_module` WHERE root  = '1' AND  type  = 'doc' ORDER BY `grade` desc,`order` 
  SELECT id, name FROM `zt_group`
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 

20161212 09:38:20: file-ajaxUeditorUpload-584dff8b4a260
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 09:48:20: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_config` WHERE 1 = 1  AND  owner IN ('system') AND  module IN ('common') AND  section IN ('global') AND  `key` IN ('sn')

20161212 09:51:36: doc-create-1-0
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_doclib` WHERE `id` = '1' 
  SELECT t1.* FROM `zt_doclib` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product=t2.id  WHERE t1.product  != '0' AND  t1.deleted  = '0' ORDER BY t2.`order` desc,t1.`id` 
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_module` WHERE root  = '1' AND  type  = 'doc' ORDER BY `grade` desc,`order` 
  SELECT id, name FROM `zt_group`
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 

20161212 09:51:37: file-ajaxUeditorUpload-584e02a8caa35
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 09:51:42: product-browse-1
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_story` WHERE product IN ('1') AND  status IN ('','draft','active','changed') AND  deleted  = '0' ORDER BY `id` desc 
  SELECT COUNT(*) AS recTotal FROM `zt_story` WHERE product IN ('1') AND  status IN ('','draft','active','changed') AND  deleted  = '0' 
  SELECT * FROM `zt_story` WHERE product IN ('1') AND  status IN ('','draft','active','changed') AND  deleted  = '0' ORDER BY `id` desc 
  SELECT * FROM `zt_story` WHERE product IN ('1') AND  status IN ('','draft','active','changed') AND  deleted  = '0' ORDER BY `id` desc 
  SELECT id,title FROM `zt_productplan` WHERE product IN ('1') AND  deleted  = '0'
  SELECT * FROM `zt_storystage` WHERE branch IN ('0')
  SELECT * FROM `zt_story` WHERE product IN ('1') AND  status IN ('','draft','active','changed') AND  deleted  = '0' ORDER BY `id` desc 
  SELECT id,CONCAT(title, " [", begin, " ~ ", end, "]") as title FROM `zt_productplan` WHERE product IN ('1') AND  deleted  = '0' ORDER BY `begin` desc 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_module` WHERE root  = '1' AND  type  = 'story' ORDER BY `grade` desc,`order` 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT id,CONCAT(title, " [", begin, " ~ ", end, "]") as title FROM `zt_productplan` WHERE product IN ('1') AND  deleted  = '0' ORDER BY `begin` desc 
  SELECT DISTINCT story FROM `zt_case` WHERE story IN ('33','7','6','5','4','3','2','1')
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_module` WHERE root  = '1' AND  type  = 'story' ORDER BY `grade` desc,`order` 
  SELECT account, realname, deleted, INSTR(',pd,po,', role) AS roleOrder FROM `zt_user` WHERE deleted  = '0' ORDER BY `roleOrder` DESC,`account` 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_module` WHERE root  = '1' AND  type  = 'story' ORDER BY `grade` desc,`order` 
  SELECT * FROM `zt_branch` WHERE product  = '1' AND  deleted  = '0' ORDER BY `id` asc 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_storystage` WHERE story IN ('33','7','6','5','4','3','2','1')

20161212 09:51:45: project
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 

20161212 09:51:46: project-task
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT t2.id, t2.name, t2.type, t1.branch FROM `zt_projectproduct` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.project  = '3'
  SELECT id, name FROM `zt_project` WHERE parent  = '3'
  SELECT t1.*, t1.hours * t1.days AS totalHours, if(t2.deleted='0', t2.realname, t1.account) as realname FROM `zt_team` AS t1  LEFT JOIN `zt_user` AS t2  ON t1.account = t2.account  WHERE t1.project  = '3'
  SELECT commiter, account, realname FROM `zt_user` WHERE commiter  != ''
  SELECT * FROM `zt_action` WHERE objectType IN('project', 'testtask', 'build')  AND  project  = '3' ORDER BY `date` desc 
  SELECT * FROM `zt_history` WHERE action IN ('400','354') ORDER BY `id` 
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT t1.product, t2.name FROM `zt_projectproduct` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.project  = '3'
  SELECT t1.*, t2.id AS storyID, t2.title AS storyTitle, t2.product, t2.branch, t2.version AS latestStoryVersion, t2.status AS storyStatus, t3.realname AS assignedToRealName FROM `zt_task` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_user` AS t3  ON t1.assignedTo = t3.account  WHERE t1.project  = '3' AND  t1.deleted  = '0' AND  t1.status IN ('','wait','doing','done','pause','cancel') ORDER BY `id` desc 
  SELECT COUNT(*) AS recTotal FROM `zt_task` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_user` AS t3  ON t1.assignedTo = t3.account  WHERE t1.project  = '3' AND  t1.deleted  = '0' AND  t1.status IN ('','wait','doing','done','pause','cancel') 
  SELECT t1.*, t2.id AS storyID, t2.title AS storyTitle, t2.product, t2.branch, t2.version AS latestStoryVersion, t2.status AS storyStatus, t3.realname AS assignedToRealName FROM `zt_task` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_user` AS t3  ON t1.assignedTo = t3.account  WHERE t1.project  = '3' AND  t1.deleted  = '0' AND  t1.status IN ('','wait','doing','done','pause','cancel') ORDER BY `id` desc 
  SELECT t1.*, t2.id AS storyID, t2.title AS storyTitle, t2.product, t2.branch, t2.version AS latestStoryVersion, t2.status AS storyStatus, t3.realname AS assignedToRealName FROM `zt_task` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_user` AS t3  ON t1.assignedTo = t3.account  WHERE t1.project  = '3' AND  t1.deleted  = '0' AND  t1.status IN ('','wait','doing','done','pause','cancel') ORDER BY `id` desc 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT t1.product, t2.name FROM `zt_projectproduct` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.project  = '3'
  SELECT * FROM `zt_branch` WHERE product IN ('1') AND  deleted  = '0'
  SELECT * FROM `zt_product` WHERE id IN ('1')
  SELECT openedVersion FROM `zt_project` WHERE id  = '3'
  SELECT product,branch FROM `zt_projectproduct` WHERE project  = '3'
  SELECT id,root,branch FROM `zt_module` WHERE root IN ('1') AND  type  = 'story'
  SELECT id FROM `zt_module` WHERE root  = '3' AND  type  = 'task'
  SELECT DISTINCT t1.id FROM `zt_module` AS t1  LEFT JOIN `zt_task` AS t2  ON t1.id=t2.module  WHERE t2.module  != '0' AND  t2.project  = '3' AND  t2.deleted  = '0' AND  t1.type  = 'story'
  SELECT * FROM `zt_module` WHERE root = 3 and type = 'task' and parent = 0 
  SELECT * FROM `zt_module` WHERE ((root = 3 and type = 'task') OR (root = 1 and type = 'story'))  ORDER BY `grade` desc,`branch`,`type`,`order` 
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 
  SELECT t1.product, t2.name FROM `zt_projectproduct` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.project  = '3'
  SELECT * FROM `zt_branch` WHERE product IN ('1') AND  deleted  = '0'
  SELECT * FROM `zt_product` WHERE id IN ('1')
  SELECT openedVersion FROM `zt_project` WHERE id  = '3'
  SELECT product,branch FROM `zt_projectproduct` WHERE project  = '3'
  SELECT id,root,branch FROM `zt_module` WHERE root IN ('1') AND  type  = 'story'
  SELECT id FROM `zt_module` WHERE root  = '3' AND  type  = 'task'
  SELECT DISTINCT t1.id FROM `zt_module` AS t1  LEFT JOIN `zt_task` AS t2  ON t1.id=t2.module  WHERE t2.module  != '0' AND  t2.project  = '3' AND  t2.deleted  = '0' AND  t1.type  = 'story'
  SELECT * FROM `zt_module` WHERE root = 3 and type = 'task' and parent = 0 
  SELECT * FROM `zt_module` WHERE ((root = 3 and type = 'task') OR (root = 1 and type = 'story'))  ORDER BY `grade` desc,`branch`,`type`,`order` 
  SELECT t1.product, t2.name FROM `zt_projectproduct` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.project  = '3'
  SELECT * FROM `zt_branch` WHERE product IN ('1') AND  deleted  = '0'
  SELECT * FROM `zt_product` WHERE id IN ('1')
  SELECT openedVersion FROM `zt_project` WHERE id  = '3'
  SELECT DISTINCT t3.path FROM `zt_projectstory` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_module` AS t3  ON t2.module = t3.id  WHERE t1.project  = '3'
  SELECT path FROM `zt_module` WHERE root  = '3' AND  type  = 'task'
  SELECT DISTINCT t1.path FROM `zt_module` AS t1  LEFT JOIN `zt_task` AS t2  ON t1.id=t2.module  WHERE t2.module  != '0' AND  t2.project  = '3' AND  t2.deleted  = '0' AND  t1.type  = 'story'
  SELECT * FROM `zt_module` WHERE ((root = 3 and type = 'task' and parent != 0) OR (root = 1 and type = 'story' and branch ='0'))  ORDER BY `grade` desc,`type`,`order` 
  SELECT * FROM `zt_module` WHERE root = 3 and type = 'task'  ORDER BY `grade` desc,`type`,`order` 
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 
  SELECT t1.id, t1.name,t1.status, t2.product FROM `zt_project` AS t1  LEFT JOIN `zt_projectproduct` AS t2  ON t1.id = t2.project  WHERE t1.deleted  = '0'
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `order` desc 
  SELECT * FROM `zt_branch` WHERE product IN ('1') AND  deleted  = '0'
  SELECT * FROM `zt_product` WHERE id IN ('1')

20161212 09:51:50: task-create-3--0
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT account, realname, deleted FROM `zt_user` WHERE deleted  = '0' ORDER BY `account` 
  SELECT t2.id, t2.title, t2.module, t2.pri, t2.estimate, t3.name AS product FROM `zt_projectstory` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_product` AS t3  ON t1.product = t3.id  WHERE t1.project  = '3' AND  t2.deleted  = '0'
  SELECT t1.account, t2.realname FROM `zt_team` AS t1  LEFT JOIN `zt_user` AS t2  ON t1.account = t2.account  WHERE t1.project  = '3' AND  t2.deleted  = '0'
  SELECT t1.product, t2.name FROM `zt_projectproduct` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.project  = '3'
  SELECT * FROM `zt_branch` WHERE product IN ('1') AND  deleted  = '0'
  SELECT * FROM `zt_product` WHERE id IN ('1')
  SELECT openedVersion FROM `zt_project` WHERE id  = '3'
  SELECT product,branch FROM `zt_projectproduct` WHERE project  = '3'
  SELECT id,root,branch FROM `zt_module` WHERE root IN ('1') AND  type  = 'story'
  SELECT id FROM `zt_module` WHERE root  = '3' AND  type  = 'task'
  SELECT DISTINCT t1.id FROM `zt_module` AS t1  LEFT JOIN `zt_task` AS t2  ON t1.id=t2.module  WHERE t2.module  != '0' AND  t2.project  = '3' AND  t2.deleted  = '0' AND  t1.type  = 'story'
  SELECT * FROM `zt_module` WHERE root = 3 and type = 'task' and parent = 0 
  SELECT * FROM `zt_module` WHERE ((root = 3 and type = 'task') OR (root = 1 and type = 'story'))  ORDER BY `grade` desc,`branch`,`type`,`order` 
  SELECT id, listName FROM `zt_usercontact` WHERE account  = 'admin'

20161212 09:51:54: story-ajaxGetProjectStories-3-0-0-1
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT id,type,parent FROM `zt_module` WHERE id  = '1'
  SELECT * FROM `zt_module` WHERE `id` = '1' 
  SELECT id FROM `zt_module` WHERE path  LIKE ',1,%'
  SELECT t2.id, t2.title, t2.module, t2.pri, t2.estimate, t3.name AS product FROM `zt_projectstory` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_product` AS t3  ON t1.product = t3.id  WHERE t1.project  = '3' AND  t2.deleted  = '0' AND  t2.module IN ('1')

20161212 09:52:16: task-create-3--0
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT version FROM `zt_story` WHERE id  = '1'
  SELECT id,name FROM `zt_task` WHERE deleted  = '0' AND  name IN ('首页设计和开发dddd') AND  openedDate  >= '2016-12-12 09:51:16' AND  project=3 
  INSERT INTO `zt_task` SET `module` = '1',`type` = 'review',`story` = '1',`color` = '',`name` = '首页设计和开发dddd',`pri` = '1',`estimate` = '5',`desc` = 'erdgtrshtsr',`estStarted` = '2016-12-12',`deadline` = '2016-12-12',`mailto` = ',tester3',`project` = '3',`left` = '5',`status` = 'wait',`storyVersion` = '2',`openedBy` = 'admin',`openedDate` = '2016-12-12 09:52:16',`assignedTo` = 'productManager',`assignedDate` = '2016-12-12 09:52:16'
  DELETE FROM `zt_storystage` WHERE story  = '1'
  SELECT * FROM `zt_story` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT t1.project,t3.branch FROM `zt_projectstory` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project = t2.id  LEFT JOIN `zt_projectproduct` AS t3  ON t1.project = t3.project  WHERE t1.story  = '1' AND  t2.deleted  = '0'
  SELECT type,project,status FROM `zt_task` WHERE project IN ('1','2','3') AND  story  = '1' AND  type IN ('devel','test') AND  status  != 'cancel' AND  closedReason  != 'cancel' AND  deleted  = '0'
  SELECT * FROM `zt_release` WHERE CONCAT(',', stories, ',')  LIKE '%,1,%' AND  deleted  = '0'
  UPDATE `zt_story` SET  `stage` = 'developed' WHERE id  = '1'
  SELECT * FROM `zt_file` WHERE id  = ''
  SELECT project, story FROM `zt_task` WHERE id  = '195'
  SELECT product FROM `zt_story` WHERE id  = '1'
  INSERT INTO `zt_action` SET `objectType` = 'task',`objectID` = '195',`actor` = 'admin',`action` = 'opened',`date` = '2016-12-12 09:52:16',`comment` = '',`extra` = '',`product` = ',1,',`project` = '3'
  SELECT t1.*, t2.id AS storyID, t2.title AS storyTitle, t2.version AS latestStoryVersion, t2.status AS storyStatus, t3.realname AS assignedToRealName FROM `zt_task` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_user` AS t3  ON t1.assignedTo = t3.account  WHERE t1.id  = '195'
  SELECT * FROM `zt_file` WHERE objectType  = 'task' AND  objectID  = '195' AND  extra  != 'editor'
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 
  SELECT * FROM `zt_action` WHERE `id` = '754' 
  SELECT * FROM `zt_history` WHERE action IN ('754') ORDER BY `id` 

20161212 09:52:17: task-create-3-1-0
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT account, realname, deleted FROM `zt_user` WHERE deleted  = '0' ORDER BY `account` 
  SELECT t2.id, t2.title, t2.module, t2.pri, t2.estimate, t3.name AS product FROM `zt_projectstory` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_product` AS t3  ON t1.product = t3.id  WHERE t1.project  = '3' AND  t2.deleted  = '0'
  SELECT t1.account, t2.realname FROM `zt_team` AS t1  LEFT JOIN `zt_user` AS t2  ON t1.account = t2.account  WHERE t1.project  = '3' AND  t2.deleted  = '0'
  SELECT t1.product, t2.name FROM `zt_projectproduct` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.project  = '3'
  SELECT * FROM `zt_branch` WHERE product IN ('1') AND  deleted  = '0'
  SELECT * FROM `zt_product` WHERE id IN ('1')
  SELECT openedVersion FROM `zt_project` WHERE id  = '3'
  SELECT product,branch FROM `zt_projectproduct` WHERE project  = '3'
  SELECT id,root,branch FROM `zt_module` WHERE root IN ('1') AND  type  = 'story'
  SELECT id FROM `zt_module` WHERE root  = '3' AND  type  = 'task'
  SELECT DISTINCT t1.id FROM `zt_module` AS t1  LEFT JOIN `zt_task` AS t2  ON t1.id=t2.module  WHERE t2.module  != '0' AND  t2.project  = '3' AND  t2.deleted  = '0' AND  t1.type  = 'story'
  SELECT * FROM `zt_module` WHERE root = 3 and type = 'task' and parent = 0 
  SELECT * FROM `zt_module` WHERE ((root = 3 and type = 'task') OR (root = 1 and type = 'story'))  ORDER BY `grade` desc,`branch`,`type`,`order` 
  SELECT id, listName FROM `zt_usercontact` WHERE account  = 'admin'

20161212 09:52:22: project-task-3
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT t2.id, t2.name, t2.type, t1.branch FROM `zt_projectproduct` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.project  = '3'
  SELECT id, name FROM `zt_project` WHERE parent  = '3'
  SELECT t1.*, t1.hours * t1.days AS totalHours, if(t2.deleted='0', t2.realname, t1.account) as realname FROM `zt_team` AS t1  LEFT JOIN `zt_user` AS t2  ON t1.account = t2.account  WHERE t1.project  = '3'
  SELECT commiter, account, realname FROM `zt_user` WHERE commiter  != ''
  SELECT * FROM `zt_action` WHERE objectType IN('project', 'testtask', 'build')  AND  project  = '3' ORDER BY `date` desc 
  SELECT * FROM `zt_history` WHERE action IN ('400','354') ORDER BY `id` 
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT t1.product, t2.name FROM `zt_projectproduct` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.project  = '3'
  SELECT t1.*, t2.id AS storyID, t2.title AS storyTitle, t2.product, t2.branch, t2.version AS latestStoryVersion, t2.status AS storyStatus, t3.realname AS assignedToRealName FROM `zt_task` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_user` AS t3  ON t1.assignedTo = t3.account  WHERE t1.project  = '3' AND  t1.deleted  = '0' AND  t1.status IN ('','wait','doing','done','pause','cancel') ORDER BY `id` desc 
  SELECT COUNT(*) AS recTotal FROM `zt_task` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_user` AS t3  ON t1.assignedTo = t3.account  WHERE t1.project  = '3' AND  t1.deleted  = '0' AND  t1.status IN ('','wait','doing','done','pause','cancel') 
  SELECT t1.*, t2.id AS storyID, t2.title AS storyTitle, t2.product, t2.branch, t2.version AS latestStoryVersion, t2.status AS storyStatus, t3.realname AS assignedToRealName FROM `zt_task` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_user` AS t3  ON t1.assignedTo = t3.account  WHERE t1.project  = '3' AND  t1.deleted  = '0' AND  t1.status IN ('','wait','doing','done','pause','cancel') ORDER BY `id` desc 
  SELECT t1.*, t2.id AS storyID, t2.title AS storyTitle, t2.product, t2.branch, t2.version AS latestStoryVersion, t2.status AS storyStatus, t3.realname AS assignedToRealName FROM `zt_task` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_user` AS t3  ON t1.assignedTo = t3.account  WHERE t1.project  = '3' AND  t1.deleted  = '0' AND  t1.status IN ('','wait','doing','done','pause','cancel') ORDER BY `id` desc 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT t1.product, t2.name FROM `zt_projectproduct` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.project  = '3'
  SELECT * FROM `zt_branch` WHERE product IN ('1') AND  deleted  = '0'
  SELECT * FROM `zt_product` WHERE id IN ('1')
  SELECT openedVersion FROM `zt_project` WHERE id  = '3'
  SELECT product,branch FROM `zt_projectproduct` WHERE project  = '3'
  SELECT id,root,branch FROM `zt_module` WHERE root IN ('1') AND  type  = 'story'
  SELECT id FROM `zt_module` WHERE root  = '3' AND  type  = 'task'
  SELECT DISTINCT t1.id FROM `zt_module` AS t1  LEFT JOIN `zt_task` AS t2  ON t1.id=t2.module  WHERE t2.module  != '0' AND  t2.project  = '3' AND  t2.deleted  = '0' AND  t1.type  = 'story'
  SELECT * FROM `zt_module` WHERE root = 3 and type = 'task' and parent = 0 
  SELECT * FROM `zt_module` WHERE ((root = 3 and type = 'task') OR (root = 1 and type = 'story'))  ORDER BY `grade` desc,`branch`,`type`,`order` 
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 
  SELECT t1.product, t2.name FROM `zt_projectproduct` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.project  = '3'
  SELECT * FROM `zt_branch` WHERE product IN ('1') AND  deleted  = '0'
  SELECT * FROM `zt_product` WHERE id IN ('1')
  SELECT openedVersion FROM `zt_project` WHERE id  = '3'
  SELECT product,branch FROM `zt_projectproduct` WHERE project  = '3'
  SELECT id,root,branch FROM `zt_module` WHERE root IN ('1') AND  type  = 'story'
  SELECT id FROM `zt_module` WHERE root  = '3' AND  type  = 'task'
  SELECT DISTINCT t1.id FROM `zt_module` AS t1  LEFT JOIN `zt_task` AS t2  ON t1.id=t2.module  WHERE t2.module  != '0' AND  t2.project  = '3' AND  t2.deleted  = '0' AND  t1.type  = 'story'
  SELECT * FROM `zt_module` WHERE root = 3 and type = 'task' and parent = 0 
  SELECT * FROM `zt_module` WHERE ((root = 3 and type = 'task') OR (root = 1 and type = 'story'))  ORDER BY `grade` desc,`branch`,`type`,`order` 
  SELECT t1.product, t2.name FROM `zt_projectproduct` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.project  = '3'
  SELECT * FROM `zt_branch` WHERE product IN ('1') AND  deleted  = '0'
  SELECT * FROM `zt_product` WHERE id IN ('1')
  SELECT openedVersion FROM `zt_project` WHERE id  = '3'
  SELECT DISTINCT t3.path FROM `zt_projectstory` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_module` AS t3  ON t2.module = t3.id  WHERE t1.project  = '3'
  SELECT path FROM `zt_module` WHERE root  = '3' AND  type  = 'task'
  SELECT DISTINCT t1.path FROM `zt_module` AS t1  LEFT JOIN `zt_task` AS t2  ON t1.id=t2.module  WHERE t2.module  != '0' AND  t2.project  = '3' AND  t2.deleted  = '0' AND  t1.type  = 'story'
  SELECT * FROM `zt_module` WHERE ((root = 3 and type = 'task' and parent != 0) OR (root = 1 and type = 'story' and branch ='0'))  ORDER BY `grade` desc,`type`,`order` 
  SELECT * FROM `zt_module` WHERE root = 3 and type = 'task'  ORDER BY `grade` desc,`type`,`order` 
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 
  SELECT t1.id, t1.name,t1.status, t2.product FROM `zt_project` AS t1  LEFT JOIN `zt_projectproduct` AS t2  ON t1.id = t2.project  WHERE t1.deleted  = '0'
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `order` desc 
  SELECT * FROM `zt_branch` WHERE product IN ('1') AND  deleted  = '0'
  SELECT * FROM `zt_product` WHERE id IN ('1')

20161212 09:52:26: task-view-195
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT t1.*, t2.id AS storyID, t2.title AS storyTitle, t2.version AS latestStoryVersion, t2.status AS storyStatus, t3.realname AS assignedToRealName FROM `zt_task` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_user` AS t3  ON t1.assignedTo = t3.account  WHERE t1.id  = '195'
  SELECT * FROM `zt_file` WHERE objectType  = 'task' AND  objectID  = '195' AND  extra  != 'editor'
  SELECT * FROM `zt_review` WHERE task  = '195'
  SELECT * FROM `zt_reviewDetail` WHERE reviewID  = '' AND  deleted  = '0'
  SELECT * FROM `zt_story` WHERE `id` = '1' 
  SELECT title,spec,spec2,spec3,verify FROM `zt_storyspec` WHERE story  = '1' AND  version  = '2'
  SELECT t1.project, t2.name, t2.status FROM `zt_projectstory` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project = t2.id  WHERE t1.story  = '1' ORDER BY t1.`project` DESC 
  SELECT id, name, assignedTo, project, status, consumed, `left` FROM `zt_task` WHERE story  = '1' AND  deleted  = '0' ORDER BY `id` DESC 
  SELECT * FROM `zt_storystage` WHERE story  = '1'
  SELECT id,title,branch FROM `zt_productplan` WHERE id IN ('1')
  SELECT * FROM `zt_file` WHERE objectType  = 'story' AND  objectID  = '1' AND  extra  != 'editor'
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT commiter, account, realname FROM `zt_user` WHERE commiter  != ''
  SELECT * FROM `zt_action` WHERE objectType  = 'task' AND  objectID  = '195' ORDER BY `date` desc 
  SELECT * FROM `zt_history` WHERE action IN ('754') ORDER BY `id` 
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 
  SELECT * FROM `zt_task` WHERE id  = '195' OR project  = '3' AND  deleted  = '0' AND  status IN ('','wait','doing','done','pause','cancel')  ORDER BY `id` desc 
  SELECT path FROM `zt_module` WHERE id  = '1'
  SELECT * FROM `zt_module` WHERE id  = '1'
  SELECT name FROM `zt_product` WHERE id  = '1'
  SELECT path FROM `zt_module` WHERE id  = '1'
  SELECT * FROM `zt_module` WHERE id IN ('1') ORDER BY `grade` 

20161212 09:52:39: task-start-195
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT t1.*, t2.id AS storyID, t2.title AS storyTitle, t2.version AS latestStoryVersion, t2.status AS storyStatus, t3.realname AS assignedToRealName FROM `zt_task` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_user` AS t3  ON t1.assignedTo = t3.account  WHERE t1.id  = '195'
  SELECT * FROM `zt_file` WHERE objectType  = 'task' AND  objectID  = '195' AND  extra  != 'editor'
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT t1.account, t2.realname FROM `zt_team` AS t1  LEFT JOIN `zt_user` AS t2  ON t1.account = t2.account  WHERE t1.project  = '3' AND  t2.deleted  = '0'
  SELECT commiter, account, realname FROM `zt_user` WHERE commiter  != ''
  SELECT * FROM `zt_action` WHERE objectType  = 'task' AND  objectID  = '195' ORDER BY `date` desc 
  SELECT * FROM `zt_history` WHERE action IN ('754') ORDER BY `id` 
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 

20161212 09:52:42: task-start-195
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT t1.*, t2.id AS storyID, t2.title AS storyTitle, t2.version AS latestStoryVersion, t2.status AS storyStatus, t3.realname AS assignedToRealName FROM `zt_task` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_user` AS t3  ON t1.assignedTo = t3.account  WHERE t1.id  = '195'
  SELECT * FROM `zt_file` WHERE objectType  = 'task' AND  objectID  = '195' AND  extra  != 'editor'
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT t1.account, t2.realname FROM `zt_team` AS t1  LEFT JOIN `zt_user` AS t2  ON t1.account = t2.account  WHERE t1.project  = '3' AND  t2.deleted  = '0'
  SELECT commiter, account, realname FROM `zt_user` WHERE commiter  != ''
  SELECT * FROM `zt_action` WHERE objectType  = 'task' AND  objectID  = '195' ORDER BY `date` desc 
  SELECT * FROM `zt_history` WHERE action IN ('754') ORDER BY `id` 
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT t1.*, t2.id AS storyID, t2.title AS storyTitle, t2.version AS latestStoryVersion, t2.status AS storyStatus, t3.realname AS assignedToRealName FROM `zt_task` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_user` AS t3  ON t1.assignedTo = t3.account  WHERE t1.id  = '195'
  SELECT * FROM `zt_file` WHERE objectType  = 'task' AND  objectID  = '195' AND  extra  != 'editor'
  INSERT INTO `zt_taskestimate` SET `consumed` = '0',`left` = '5',`account` = 'admin',`task` = '195',`date` = '2016-12-12'
  UPDATE `zt_task` SET `realStarted` = '2016-12-12',`consumed` = '0',`left` = '5',`assignedTo` = 'admin',`lastEditedBy` = 'admin',`lastEditedDate` = '2016-12-12 09:52:41',`assignedDate` = '2016-12-12 09:52:41',`status` = 'doing' WHERE id  = '195'
  DELETE FROM `zt_storystage` WHERE story  = '1'
  SELECT * FROM `zt_story` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT t1.project,t3.branch FROM `zt_projectstory` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project = t2.id  LEFT JOIN `zt_projectproduct` AS t3  ON t1.project = t3.project  WHERE t1.story  = '1' AND  t2.deleted  = '0'
  SELECT type,project,status FROM `zt_task` WHERE project IN ('1','2','3') AND  story  = '1' AND  type IN ('devel','test') AND  status  != 'cancel' AND  closedReason  != 'cancel' AND  deleted  = '0'
  SELECT * FROM `zt_release` WHERE CONCAT(',', stories, ',')  LIKE '%,1,%' AND  deleted  = '0'
  UPDATE `zt_story` SET  `stage` = 'developed' WHERE id  = '1'
  SELECT project, story FROM `zt_task` WHERE id  = '195'
  SELECT product FROM `zt_story` WHERE id  = '1'
  INSERT INTO `zt_action` SET `objectType` = 'task',`objectID` = '195',`actor` = 'admin',`action` = 'started',`date` = '2016-12-12 09:52:42',`comment` = '',`extra` = '',`product` = ',1,',`project` = '3'
  INSERT INTO `zt_history` SET `field` = 'realStarted',`old` = '0000-00-00',`new` = '2016-12-12',`diff` = '',`action` = '755'
  INSERT INTO `zt_history` SET `field` = 'uid',`old` = '',`new` = '584e02e7d83ba',`diff` = '',`action` = '755'
  INSERT INTO `zt_history` SET `field` = 'assignedTo',`old` = 'productManager',`new` = 'admin',`diff` = '',`action` = '755'
  INSERT INTO `zt_history` SET `field` = 'status',`old` = 'wait',`new` = 'doing',`diff` = '',`action` = '755'
  SELECT t1.*, t2.id AS storyID, t2.title AS storyTitle, t2.version AS latestStoryVersion, t2.status AS storyStatus, t3.realname AS assignedToRealName FROM `zt_task` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_user` AS t3  ON t1.assignedTo = t3.account  WHERE t1.id  = '195'
  SELECT * FROM `zt_file` WHERE objectType  = 'task' AND  objectID  = '195' AND  extra  != 'editor'
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 
  SELECT * FROM `zt_action` WHERE `id` = '755' 
  SELECT * FROM `zt_history` WHERE action IN ('755') ORDER BY `id` 
  SELECT t1.*, t2.id AS storyID, t2.title AS storyTitle, t2.version AS latestStoryVersion, t2.status AS storyStatus, t3.realname AS assignedToRealName FROM `zt_task` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_user` AS t3  ON t1.assignedTo = t3.account  WHERE t1.id  = '195'
  SELECT * FROM `zt_file` WHERE objectType  = 'task' AND  objectID  = '195' AND  extra  != 'editor'

20161212 09:52:42: task-view-195
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT t1.*, t2.id AS storyID, t2.title AS storyTitle, t2.version AS latestStoryVersion, t2.status AS storyStatus, t3.realname AS assignedToRealName FROM `zt_task` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_user` AS t3  ON t1.assignedTo = t3.account  WHERE t1.id  = '195'
  SELECT * FROM `zt_file` WHERE objectType  = 'task' AND  objectID  = '195' AND  extra  != 'editor'
  SELECT * FROM `zt_review` WHERE task  = '195'
  SELECT * FROM `zt_reviewDetail` WHERE reviewID  = '' AND  deleted  = '0'
  SELECT * FROM `zt_story` WHERE `id` = '1' 
  SELECT title,spec,spec2,spec3,verify FROM `zt_storyspec` WHERE story  = '1' AND  version  = '2'
  SELECT t1.project, t2.name, t2.status FROM `zt_projectstory` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project = t2.id  WHERE t1.story  = '1' ORDER BY t1.`project` DESC 
  SELECT id, name, assignedTo, project, status, consumed, `left` FROM `zt_task` WHERE story  = '1' AND  deleted  = '0' ORDER BY `id` DESC 
  SELECT * FROM `zt_storystage` WHERE story  = '1'
  SELECT id,title,branch FROM `zt_productplan` WHERE id IN ('1')
  SELECT * FROM `zt_file` WHERE objectType  = 'story' AND  objectID  = '1' AND  extra  != 'editor'
  UPDATE `zt_action` SET  `read` = '1' WHERE objectType  = 'task' AND  objectID  = '195' AND  `read`  = '0'
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT commiter, account, realname FROM `zt_user` WHERE commiter  != ''
  SELECT * FROM `zt_action` WHERE objectType  = 'task' AND  objectID  = '195' ORDER BY `date` desc 
  SELECT * FROM `zt_history` WHERE action IN ('755','754') ORDER BY `id` 
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 
  SELECT path FROM `zt_module` WHERE id  = '1'
  SELECT * FROM `zt_module` WHERE id  = '1'
  SELECT name FROM `zt_product` WHERE id  = '1'
  SELECT path FROM `zt_module` WHERE id  = '1'
  SELECT * FROM `zt_module` WHERE id IN ('1') ORDER BY `grade` 

20161212 09:52:57: task-edit-195
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT t1.*, t2.id AS storyID, t2.title AS storyTitle, t2.version AS latestStoryVersion, t2.status AS storyStatus, t3.realname AS assignedToRealName FROM `zt_task` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_user` AS t3  ON t1.assignedTo = t3.account  WHERE t1.id  = '195'
  SELECT * FROM `zt_file` WHERE objectType  = 'task' AND  objectID  = '195' AND  extra  != 'editor'
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT t1.account, t2.realname FROM `zt_team` AS t1  LEFT JOIN `zt_user` AS t2  ON t1.account = t2.account  WHERE t1.project  = '3' AND  t2.deleted  = '0'
  SELECT commiter, account, realname FROM `zt_user` WHERE commiter  != ''
  SELECT * FROM `zt_action` WHERE objectType  = 'task' AND  objectID  = '195' ORDER BY `date` desc 
  SELECT * FROM `zt_history` WHERE action IN ('755','754') ORDER BY `id` 
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT * FROM `zt_review` WHERE task  = '195'
  SELECT * FROM `zt_reviewDetail` WHERE reviewID  = '' AND  deleted  = '0'
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT t2.id, t2.title, t2.module, t2.pri, t2.estimate, t3.name AS product FROM `zt_projectstory` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_product` AS t3  ON t1.product = t3.id  WHERE t1.project  = '3' AND  t2.deleted  = '0'
  SELECT account, realname, deleted FROM `zt_user` WHERE deleted  = '0' ORDER BY `account` 
  SELECT account, realname, deleted FROM `zt_user` WHERE account IN ('admin','','')
  SELECT t1.product, t2.name FROM `zt_projectproduct` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.project  = '3'
  SELECT * FROM `zt_branch` WHERE product IN ('1') AND  deleted  = '0'
  SELECT * FROM `zt_product` WHERE id IN ('1')
  SELECT openedVersion FROM `zt_project` WHERE id  = '3'
  SELECT product,branch FROM `zt_projectproduct` WHERE project  = '3'
  SELECT id,root,branch FROM `zt_module` WHERE root IN ('1') AND  type  = 'story'
  SELECT id FROM `zt_module` WHERE root  = '3' AND  type  = 'task'
  SELECT DISTINCT t1.id FROM `zt_module` AS t1  LEFT JOIN `zt_task` AS t2  ON t1.id=t2.module  WHERE t2.module  != '0' AND  t2.project  = '3' AND  t2.deleted  = '0' AND  t1.type  = 'story'
  SELECT * FROM `zt_module` WHERE root = 3 and type = 'task' and parent = 0 
  SELECT * FROM `zt_module` WHERE ((root = 3 and type = 'task') OR (root = 1 and type = 'story'))  ORDER BY `grade` desc,`branch`,`type`,`order` 

20161212 09:53:04: task-edit-195
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT t1.*, t2.id AS storyID, t2.title AS storyTitle, t2.version AS latestStoryVersion, t2.status AS storyStatus, t3.realname AS assignedToRealName FROM `zt_task` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_user` AS t3  ON t1.assignedTo = t3.account  WHERE t1.id  = '195'
  SELECT * FROM `zt_file` WHERE objectType  = 'task' AND  objectID  = '195' AND  extra  != 'editor'
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT t1.account, t2.realname FROM `zt_team` AS t1  LEFT JOIN `zt_user` AS t2  ON t1.account = t2.account  WHERE t1.project  = '3' AND  t2.deleted  = '0'
  SELECT commiter, account, realname FROM `zt_user` WHERE commiter  != ''
  SELECT * FROM `zt_action` WHERE objectType  = 'task' AND  objectID  = '195' ORDER BY `date` desc 
  SELECT * FROM `zt_history` WHERE action IN ('755','754') ORDER BY `id` 
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT t1.*, t2.id AS storyID, t2.title AS storyTitle, t2.version AS latestStoryVersion, t2.status AS storyStatus, t3.realname AS assignedToRealName FROM `zt_task` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_user` AS t3  ON t1.assignedTo = t3.account  WHERE t1.id  = '195'
  SELECT * FROM `zt_file` WHERE objectType  = 'task' AND  objectID  = '195' AND  extra  != 'editor'
  SELECT version FROM `zt_story` WHERE id  = '1'
  UPDATE `zt_task` SET `color` = '',`name` = '首页设计和开发dddd',`desc` = 'erdgtrshtsr4',`lastEditedDate` = '2016-12-12 09:53:04',`consumed` = '0',`project` = '3',`module` = '1',`story` = '1',`assignedTo` = 'admin',`type` = 'review',`status` = 'doing',`pri` = '1',`mailto` = ',tester3',`estStarted` = '2016-12-12',`realStarted` = '2016-12-12',`deadline` = '2016-12-12',`estimate` = '5',`left` = '5',`finishedBy` = '',`finishedDate` = '',`canceledBy` = '',`canceledDate` = '',`closedBy` = '',`closedReason` = '',`closedDate` = '',`lastEditedBy` = 'admin' WHERE id  = '195'
  DELETE FROM `zt_storystage` WHERE story  = '1'
  SELECT * FROM `zt_story` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT t1.project,t3.branch FROM `zt_projectstory` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project = t2.id  LEFT JOIN `zt_projectproduct` AS t3  ON t1.project = t3.project  WHERE t1.story  = '1' AND  t2.deleted  = '0'
  SELECT type,project,status FROM `zt_task` WHERE project IN ('1','2','3') AND  story  = '1' AND  type IN ('devel','test') AND  status  != 'cancel' AND  closedReason  != 'cancel' AND  deleted  = '0'
  SELECT * FROM `zt_release` WHERE CONCAT(',', stories, ',')  LIKE '%,1,%' AND  deleted  = '0'
  UPDATE `zt_story` SET  `stage` = 'developed' WHERE id  = '1'
  SELECT t1.*, t2.id AS storyID, t2.title AS storyTitle, t2.version AS latestStoryVersion, t2.status AS storyStatus, t3.realname AS assignedToRealName FROM `zt_task` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_user` AS t3  ON t1.assignedTo = t3.account  WHERE t1.id  = '195'
  SELECT * FROM `zt_file` WHERE objectType  = 'task' AND  objectID  = '195' AND  extra  != 'editor'
  SELECT project, story FROM `zt_task` WHERE id  = '195'
  SELECT product FROM `zt_story` WHERE id  = '1'
  INSERT INTO `zt_action` SET `objectType` = 'task',`objectID` = '195',`actor` = 'admin',`action` = 'edited',`date` = '2016-12-12 09:53:04',`comment` = '',`extra` = '',`product` = ',1,',`project` = '3'
  INSERT INTO `zt_history` SET `field` = 'desc',`old` = 'erdgtrshtsr',`new` = 'erdgtrshtsr4',`diff` = '001- <del>erdgtrshtsr</del>\n001+ <ins>erdgtrshtsr4</ins>',`action` = '756'
  SELECT t1.*, t2.id AS storyID, t2.title AS storyTitle, t2.version AS latestStoryVersion, t2.status AS storyStatus, t3.realname AS assignedToRealName FROM `zt_task` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_user` AS t3  ON t1.assignedTo = t3.account  WHERE t1.id  = '195'
  SELECT * FROM `zt_file` WHERE objectType  = 'task' AND  objectID  = '195' AND  extra  != 'editor'
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 
  SELECT * FROM `zt_action` WHERE `id` = '756' 
  SELECT * FROM `zt_history` WHERE action IN ('756') ORDER BY `id` 

20161212 09:53:04: task-view-195
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT t1.*, t2.id AS storyID, t2.title AS storyTitle, t2.version AS latestStoryVersion, t2.status AS storyStatus, t3.realname AS assignedToRealName FROM `zt_task` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_user` AS t3  ON t1.assignedTo = t3.account  WHERE t1.id  = '195'
  SELECT * FROM `zt_file` WHERE objectType  = 'task' AND  objectID  = '195' AND  extra  != 'editor'
  SELECT * FROM `zt_review` WHERE task  = '195'
  SELECT * FROM `zt_reviewDetail` WHERE reviewID  = '' AND  deleted  = '0'
  SELECT * FROM `zt_story` WHERE `id` = '1' 
  SELECT title,spec,spec2,spec3,verify FROM `zt_storyspec` WHERE story  = '1' AND  version  = '2'
  SELECT t1.project, t2.name, t2.status FROM `zt_projectstory` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project = t2.id  WHERE t1.story  = '1' ORDER BY t1.`project` DESC 
  SELECT id, name, assignedTo, project, status, consumed, `left` FROM `zt_task` WHERE story  = '1' AND  deleted  = '0' ORDER BY `id` DESC 
  SELECT * FROM `zt_storystage` WHERE story  = '1'
  SELECT id,title,branch FROM `zt_productplan` WHERE id IN ('1')
  SELECT * FROM `zt_file` WHERE objectType  = 'story' AND  objectID  = '1' AND  extra  != 'editor'
  UPDATE `zt_action` SET  `read` = '1' WHERE objectType  = 'task' AND  objectID  = '195' AND  `read`  = '0'
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT commiter, account, realname FROM `zt_user` WHERE commiter  != ''
  SELECT * FROM `zt_action` WHERE objectType  = 'task' AND  objectID  = '195' ORDER BY `date` desc 
  SELECT * FROM `zt_history` WHERE action IN ('756','755','754') ORDER BY `id` 
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 
  SELECT path FROM `zt_module` WHERE id  = '1'
  SELECT * FROM `zt_module` WHERE id  = '1'
  SELECT name FROM `zt_product` WHERE id  = '1'
  SELECT path FROM `zt_module` WHERE id  = '1'
  SELECT * FROM `zt_module` WHERE id IN ('1') ORDER BY `grade` 

20161212 09:53:09: task-finish-195
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT t1.*, t2.id AS storyID, t2.title AS storyTitle, t2.version AS latestStoryVersion, t2.status AS storyStatus, t3.realname AS assignedToRealName FROM `zt_task` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_user` AS t3  ON t1.assignedTo = t3.account  WHERE t1.id  = '195'
  SELECT * FROM `zt_file` WHERE objectType  = 'task' AND  objectID  = '195' AND  extra  != 'editor'
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT t1.account, t2.realname FROM `zt_team` AS t1  LEFT JOIN `zt_user` AS t2  ON t1.account = t2.account  WHERE t1.project  = '3' AND  t2.deleted  = '0'
  SELECT commiter, account, realname FROM `zt_user` WHERE commiter  != ''
  SELECT * FROM `zt_action` WHERE objectType  = 'task' AND  objectID  = '195' ORDER BY `date` desc 
  SELECT * FROM `zt_history` WHERE action IN ('756','755','754') ORDER BY `id` 
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 

20161212 09:53:14: task-finish-195
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT t1.*, t2.id AS storyID, t2.title AS storyTitle, t2.version AS latestStoryVersion, t2.status AS storyStatus, t3.realname AS assignedToRealName FROM `zt_task` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_user` AS t3  ON t1.assignedTo = t3.account  WHERE t1.id  = '195'
  SELECT * FROM `zt_file` WHERE objectType  = 'task' AND  objectID  = '195' AND  extra  != 'editor'
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT t1.account, t2.realname FROM `zt_team` AS t1  LEFT JOIN `zt_user` AS t2  ON t1.account = t2.account  WHERE t1.project  = '3' AND  t2.deleted  = '0'
  SELECT commiter, account, realname FROM `zt_user` WHERE commiter  != ''
  SELECT * FROM `zt_action` WHERE objectType  = 'task' AND  objectID  = '195' ORDER BY `date` desc 
  SELECT * FROM `zt_history` WHERE action IN ('756','755','754') ORDER BY `id` 
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT t1.*, t2.id AS storyID, t2.title AS storyTitle, t2.version AS latestStoryVersion, t2.status AS storyStatus, t3.realname AS assignedToRealName FROM `zt_task` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_user` AS t3  ON t1.assignedTo = t3.account  WHERE t1.id  = '195'
  SELECT * FROM `zt_file` WHERE objectType  = 'task' AND  objectID  = '195' AND  extra  != 'editor'
  INSERT INTO `zt_taskestimate` SET `consumed` = '5',`account` = 'admin',`task` = '195',`date` = '2016-12-12',`left` = '0'
  UPDATE `zt_task` SET `consumed` = '5',`assignedTo` = 'admin',`finishedDate` = '2016-12-12 09:53:14',`left` = '0',`assignedDate` = '2016-12-12 09:53:14',`status` = 'done',`finishedBy` = 'admin',`lastEditedBy` = 'admin',`lastEditedDate` = '2016-12-12 09:53:14' WHERE id  = '195'
  DELETE FROM `zt_storystage` WHERE story  = '1'
  SELECT * FROM `zt_story` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT t1.project,t3.branch FROM `zt_projectstory` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project = t2.id  LEFT JOIN `zt_projectproduct` AS t3  ON t1.project = t3.project  WHERE t1.story  = '1' AND  t2.deleted  = '0'
  SELECT type,project,status FROM `zt_task` WHERE project IN ('1','2','3') AND  story  = '1' AND  type IN ('devel','test') AND  status  != 'cancel' AND  closedReason  != 'cancel' AND  deleted  = '0'
  SELECT * FROM `zt_release` WHERE CONCAT(',', stories, ',')  LIKE '%,1,%' AND  deleted  = '0'
  UPDATE `zt_story` SET  `stage` = 'developed' WHERE id  = '1'
  SELECT t1.*, t2.id AS storyID, t2.title AS storyTitle, t2.version AS latestStoryVersion, t2.status AS storyStatus, t3.realname AS assignedToRealName FROM `zt_task` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_user` AS t3  ON t1.assignedTo = t3.account  WHERE t1.id  = '195'
  SELECT * FROM `zt_file` WHERE objectType  = 'task' AND  objectID  = '195' AND  extra  != 'editor'
  SELECT project, story FROM `zt_task` WHERE id  = '195'
  SELECT product FROM `zt_story` WHERE id  = '1'
  INSERT INTO `zt_action` SET `objectType` = 'task',`objectID` = '195',`actor` = 'admin',`action` = 'finished',`date` = '2016-12-12 09:53:14',`comment` = '',`extra` = '',`product` = ',1,',`project` = '3'
  INSERT INTO `zt_history` SET `field` = 'consumed',`old` = '0',`new` = '5',`diff` = '',`action` = '757'
  INSERT INTO `zt_history` SET `field` = 'finishedDate',`old` = '',`new` = '2016-12-12 09:53:14',`diff` = '',`action` = '757'
  INSERT INTO `zt_history` SET `field` = 'uid',`old` = '',`new` = '584e0305eedb3',`diff` = '',`action` = '757'
  INSERT INTO `zt_history` SET `field` = 'left',`old` = '5',`new` = '0',`diff` = '',`action` = '757'
  INSERT INTO `zt_history` SET `field` = 'status',`old` = 'doing',`new` = 'done',`diff` = '',`action` = '757'
  INSERT INTO `zt_history` SET `field` = 'finishedBy',`old` = '',`new` = 'admin',`diff` = '',`action` = '757'
  SELECT t1.*, t2.id AS storyID, t2.title AS storyTitle, t2.version AS latestStoryVersion, t2.status AS storyStatus, t3.realname AS assignedToRealName FROM `zt_task` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_user` AS t3  ON t1.assignedTo = t3.account  WHERE t1.id  = '195'
  SELECT * FROM `zt_file` WHERE objectType  = 'task' AND  objectID  = '195' AND  extra  != 'editor'
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 
  SELECT * FROM `zt_action` WHERE `id` = '757' 
  SELECT * FROM `zt_history` WHERE action IN ('757') ORDER BY `id` 

20161212 09:53:14: task-view-195
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT t1.*, t2.id AS storyID, t2.title AS storyTitle, t2.version AS latestStoryVersion, t2.status AS storyStatus, t3.realname AS assignedToRealName FROM `zt_task` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_user` AS t3  ON t1.assignedTo = t3.account  WHERE t1.id  = '195'
  SELECT * FROM `zt_file` WHERE objectType  = 'task' AND  objectID  = '195' AND  extra  != 'editor'
  SELECT * FROM `zt_review` WHERE task  = '195'
  SELECT * FROM `zt_reviewDetail` WHERE reviewID  = '' AND  deleted  = '0'
  SELECT * FROM `zt_story` WHERE `id` = '1' 
  SELECT title,spec,spec2,spec3,verify FROM `zt_storyspec` WHERE story  = '1' AND  version  = '2'
  SELECT t1.project, t2.name, t2.status FROM `zt_projectstory` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project = t2.id  WHERE t1.story  = '1' ORDER BY t1.`project` DESC 
  SELECT id, name, assignedTo, project, status, consumed, `left` FROM `zt_task` WHERE story  = '1' AND  deleted  = '0' ORDER BY `id` DESC 
  SELECT * FROM `zt_storystage` WHERE story  = '1'
  SELECT id,title,branch FROM `zt_productplan` WHERE id IN ('1')
  SELECT * FROM `zt_file` WHERE objectType  = 'story' AND  objectID  = '1' AND  extra  != 'editor'
  UPDATE `zt_action` SET  `read` = '1' WHERE objectType  = 'task' AND  objectID  = '195' AND  `read`  = '0'
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT commiter, account, realname FROM `zt_user` WHERE commiter  != ''
  SELECT * FROM `zt_action` WHERE objectType  = 'task' AND  objectID  = '195' ORDER BY `date` desc 
  SELECT * FROM `zt_history` WHERE action IN ('757','756','755','754') ORDER BY `id` 
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 
  SELECT path FROM `zt_module` WHERE id  = '1'
  SELECT * FROM `zt_module` WHERE id  = '1'
  SELECT name FROM `zt_product` WHERE id  = '1'
  SELECT path FROM `zt_module` WHERE id  = '1'
  SELECT * FROM `zt_module` WHERE id IN ('1') ORDER BY `grade` 

20161212 09:53:17: task-edit-195
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT t1.*, t2.id AS storyID, t2.title AS storyTitle, t2.version AS latestStoryVersion, t2.status AS storyStatus, t3.realname AS assignedToRealName FROM `zt_task` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_user` AS t3  ON t1.assignedTo = t3.account  WHERE t1.id  = '195'
  SELECT * FROM `zt_file` WHERE objectType  = 'task' AND  objectID  = '195' AND  extra  != 'editor'
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT t1.account, t2.realname FROM `zt_team` AS t1  LEFT JOIN `zt_user` AS t2  ON t1.account = t2.account  WHERE t1.project  = '3' AND  t2.deleted  = '0'
  SELECT commiter, account, realname FROM `zt_user` WHERE commiter  != ''
  SELECT * FROM `zt_action` WHERE objectType  = 'task' AND  objectID  = '195' ORDER BY `date` desc 
  SELECT * FROM `zt_history` WHERE action IN ('757','756','755','754') ORDER BY `id` 
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT * FROM `zt_review` WHERE task  = '195'
  SELECT * FROM `zt_reviewDetail` WHERE reviewID  = '' AND  deleted  = '0'
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT t2.id, t2.title, t2.module, t2.pri, t2.estimate, t3.name AS product FROM `zt_projectstory` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_product` AS t3  ON t1.product = t3.id  WHERE t1.project  = '3' AND  t2.deleted  = '0'
  SELECT account, realname, deleted FROM `zt_user` WHERE deleted  = '0' ORDER BY `account` 
  SELECT account, realname, deleted FROM `zt_user` WHERE account IN ('admin','','')
  SELECT t1.product, t2.name FROM `zt_projectproduct` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.project  = '3'
  SELECT * FROM `zt_branch` WHERE product IN ('1') AND  deleted  = '0'
  SELECT * FROM `zt_product` WHERE id IN ('1')
  SELECT openedVersion FROM `zt_project` WHERE id  = '3'
  SELECT product,branch FROM `zt_projectproduct` WHERE project  = '3'
  SELECT id,root,branch FROM `zt_module` WHERE root IN ('1') AND  type  = 'story'
  SELECT id FROM `zt_module` WHERE root  = '3' AND  type  = 'task'
  SELECT DISTINCT t1.id FROM `zt_module` AS t1  LEFT JOIN `zt_task` AS t2  ON t1.id=t2.module  WHERE t2.module  != '0' AND  t2.project  = '3' AND  t2.deleted  = '0' AND  t1.type  = 'story'
  SELECT * FROM `zt_module` WHERE root = 3 and type = 'task' and parent = 0 
  SELECT * FROM `zt_module` WHERE ((root = 3 and type = 'task') OR (root = 1 and type = 'story'))  ORDER BY `grade` desc,`branch`,`type`,`order` 

20161212 09:53:55: task-edit-195
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT t1.*, t2.id AS storyID, t2.title AS storyTitle, t2.version AS latestStoryVersion, t2.status AS storyStatus, t3.realname AS assignedToRealName FROM `zt_task` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_user` AS t3  ON t1.assignedTo = t3.account  WHERE t1.id  = '195'
  SELECT * FROM `zt_file` WHERE objectType  = 'task' AND  objectID  = '195' AND  extra  != 'editor'
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT t1.account, t2.realname FROM `zt_team` AS t1  LEFT JOIN `zt_user` AS t2  ON t1.account = t2.account  WHERE t1.project  = '3' AND  t2.deleted  = '0'
  SELECT commiter, account, realname FROM `zt_user` WHERE commiter  != ''
  SELECT * FROM `zt_action` WHERE objectType  = 'task' AND  objectID  = '195' ORDER BY `date` desc 
  SELECT * FROM `zt_history` WHERE action IN ('757','756','755','754') ORDER BY `id` 
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT t1.*, t2.id AS storyID, t2.title AS storyTitle, t2.version AS latestStoryVersion, t2.status AS storyStatus, t3.realname AS assignedToRealName FROM `zt_task` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_user` AS t3  ON t1.assignedTo = t3.account  WHERE t1.id  = '195'
  SELECT * FROM `zt_file` WHERE objectType  = 'task' AND  objectID  = '195' AND  extra  != 'editor'
  SELECT version FROM `zt_story` WHERE id  = '1'
  SELECT * FROM `zt_review` WHERE task  = '195'
  UPDATE `zt_task` SET `module` = '1',`type` = 'review',`story` = '1',`color` = '',`name` = '首页设计和开发dddd',`pri` = '1',`estimate` = '5',`desc` = 'erdgtrshtsr4',`estStarted` = '2016-12-12',`deadline` = '2016-12-12',`mailto` = ',tester3',`project` = '3',`left` = '0',`status` = 'done',`assignedTo` = 'admin',`assignedDate` = '',`consumed` = '5',`realStarted` = '2016-12-12',`finishedBy` = 'admin',`finishedDate` = '2016-12-12 09:53:14',`canceledBy` = '',`canceledDate` = '',`closedBy` = '',`closedReason` = '',`closedDate` = '',`lastEditedBy` = 'admin',`lastEditedDate` = '2016-12-12 09:53:54' WHERE id  = '195'
  DELETE FROM `zt_storystage` WHERE story  = '1'
  SELECT * FROM `zt_story` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT t1.project,t3.branch FROM `zt_projectstory` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project = t2.id  LEFT JOIN `zt_projectproduct` AS t3  ON t1.project = t3.project  WHERE t1.story  = '1' AND  t2.deleted  = '0'
  SELECT type,project,status FROM `zt_task` WHERE project IN ('1','2','3') AND  story  = '1' AND  type IN ('devel','test') AND  status  != 'cancel' AND  closedReason  != 'cancel' AND  deleted  = '0'
  SELECT * FROM `zt_release` WHERE CONCAT(',', stories, ',')  LIKE '%,1,%' AND  deleted  = '0'
  UPDATE `zt_story` SET  `stage` = 'developed' WHERE id  = '1'

20161212 09:54:14: task-edit-195
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT t1.*, t2.id AS storyID, t2.title AS storyTitle, t2.version AS latestStoryVersion, t2.status AS storyStatus, t3.realname AS assignedToRealName FROM `zt_task` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_user` AS t3  ON t1.assignedTo = t3.account  WHERE t1.id  = '195'
  SELECT * FROM `zt_file` WHERE objectType  = 'task' AND  objectID  = '195' AND  extra  != 'editor'
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT t1.account, t2.realname FROM `zt_team` AS t1  LEFT JOIN `zt_user` AS t2  ON t1.account = t2.account  WHERE t1.project  = '3' AND  t2.deleted  = '0'
  SELECT commiter, account, realname FROM `zt_user` WHERE commiter  != ''
  SELECT * FROM `zt_action` WHERE objectType  = 'task' AND  objectID  = '195' ORDER BY `date` desc 
  SELECT * FROM `zt_history` WHERE action IN ('757','756','755','754') ORDER BY `id` 
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT t1.*, t2.id AS storyID, t2.title AS storyTitle, t2.version AS latestStoryVersion, t2.status AS storyStatus, t3.realname AS assignedToRealName FROM `zt_task` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_user` AS t3  ON t1.assignedTo = t3.account  WHERE t1.id  = '195'
  SELECT * FROM `zt_file` WHERE objectType  = 'task' AND  objectID  = '195' AND  extra  != 'editor'
  SELECT version FROM `zt_story` WHERE id  = '1'
  SELECT * FROM `zt_review` WHERE task  = '195'
  UPDATE `zt_task` SET `module` = '1',`type` = 'review',`story` = '1',`color` = '',`name` = '首页设计和开发dddd',`pri` = '1',`estimate` = '5',`desc` = 'erdgtrshtsr4',`estStarted` = '2016-12-12',`deadline` = '2016-12-12',`mailto` = ',tester3',`project` = '3',`left` = '0',`status` = 'done',`assignedTo` = 'admin',`assignedDate` = '',`consumed` = '5',`realStarted` = '2016-12-12',`finishedBy` = 'admin',`finishedDate` = '2016-12-12 09:53:14',`canceledBy` = '',`canceledDate` = '',`closedBy` = '',`closedReason` = '',`closedDate` = '',`lastEditedBy` = 'admin',`lastEditedDate` = '2016-12-12 09:54:14' WHERE id  = '195'
  DELETE FROM `zt_storystage` WHERE story  = '1'
  SELECT * FROM `zt_story` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT t1.project,t3.branch FROM `zt_projectstory` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project = t2.id  LEFT JOIN `zt_projectproduct` AS t3  ON t1.project = t3.project  WHERE t1.story  = '1' AND  t2.deleted  = '0'
  SELECT type,project,status FROM `zt_task` WHERE project IN ('1','2','3') AND  story  = '1' AND  type IN ('devel','test') AND  status  != 'cancel' AND  closedReason  != 'cancel' AND  deleted  = '0'
  SELECT * FROM `zt_release` WHERE CONCAT(',', stories, ',')  LIKE '%,1,%' AND  deleted  = '0'
  UPDATE `zt_story` SET  `stage` = 'developed' WHERE id  = '1'
  INSERT INTO `zt_review` SET `fileNO` = 'dafds',`recorder` = 'sdf',`reviewName` = 'qwq',`task` = '195',`doc` = 'fgtr',`referenceDoc` = 'qw',`reference` = 'qw',`pages` = '2',`reviewers` = 'qw',`reviewDate` = '2016-12-12',`reviewScope` = 'btr',`reviewPlace` = 'fdgfd',`effort` = '33',`conclusion` = 'sdfsd'
  INSERT INTO `zt_reviewDetail` SET `reviewID` = '30',`number` = '1',`reviewer` = 'hgfhc',`item` = 'fghf',`line` = 'sdf',`severity` = 'A',`description` = 'faeraf',`proposal` = 'ergaer',`changed` = 'N',`action` = 'rggre',`chkd` = 'Y'
  INSERT INTO `zt_reviewDetail` SET `reviewID` = '30',`number` = '2',`reviewer` = 'dgr',`item` = 'fhn',`line` = 'fbft',`severity` = 'B',`description` = 'gfbg',`proposal` = 'fgny',`changed` = 'Y',`action` = 'gfnytm',`chkd` = 'Y'
  DELETE FROM `zt_storystage` WHERE story  = '1'
  SELECT * FROM `zt_story` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT t1.project,t3.branch FROM `zt_projectstory` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project = t2.id  LEFT JOIN `zt_projectproduct` AS t3  ON t1.project = t3.project  WHERE t1.story  = '1' AND  t2.deleted  = '0'
  SELECT type,project,status FROM `zt_task` WHERE project IN ('1','2','3') AND  story  = '1' AND  type IN ('devel','test') AND  status  != 'cancel' AND  closedReason  != 'cancel' AND  deleted  = '0'
  SELECT * FROM `zt_release` WHERE CONCAT(',', stories, ',')  LIKE '%,1,%' AND  deleted  = '0'
  UPDATE `zt_story` SET  `stage` = 'developed' WHERE id  = '1'
  SELECT t1.*, t2.id AS storyID, t2.title AS storyTitle, t2.version AS latestStoryVersion, t2.status AS storyStatus, t3.realname AS assignedToRealName FROM `zt_task` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_user` AS t3  ON t1.assignedTo = t3.account  WHERE t1.id  = '195'
  SELECT * FROM `zt_file` WHERE objectType  = 'task' AND  objectID  = '195' AND  extra  != 'editor'
  SELECT project, story FROM `zt_task` WHERE id  = '195'
  SELECT product FROM `zt_story` WHERE id  = '1'
  INSERT INTO `zt_action` SET `objectType` = 'task',`objectID` = '195',`actor` = 'admin',`action` = 'edited',`date` = '2016-12-12 09:54:14',`comment` = '',`extra` = '',`product` = ',1,',`project` = '3'
  INSERT INTO `zt_history` SET `field` = 'fileNO',`old` = '',`new` = 'dafds',`diff` = '',`action` = '758'
  INSERT INTO `zt_history` SET `field` = 'recorder',`old` = '',`new` = 'sdf',`diff` = '',`action` = '758'
  INSERT INTO `zt_history` SET `field` = 'reviewName',`old` = '',`new` = 'qwq',`diff` = '',`action` = '758'
  INSERT INTO `zt_history` SET `field` = 'doc',`old` = '',`new` = 'fgtr',`diff` = '',`action` = '758'
  INSERT INTO `zt_history` SET `field` = 'referenceDoc',`old` = '',`new` = 'qw',`diff` = '',`action` = '758'
  INSERT INTO `zt_history` SET `field` = 'reference',`old` = '',`new` = 'qw',`diff` = '',`action` = '758'
  INSERT INTO `zt_history` SET `field` = 'pages',`old` = '',`new` = '2',`diff` = '',`action` = '758'
  INSERT INTO `zt_history` SET `field` = 'reviewers',`old` = '',`new` = 'qw',`diff` = '',`action` = '758'
  INSERT INTO `zt_history` SET `field` = 'reviewDate',`old` = '',`new` = '2016-12-12',`diff` = '',`action` = '758'
  INSERT INTO `zt_history` SET `field` = 'reviewScope',`old` = '',`new` = 'btr',`diff` = '',`action` = '758'
  INSERT INTO `zt_history` SET `field` = 'reviewPlace',`old` = '',`new` = 'fdgfd',`diff` = '',`action` = '758'
  INSERT INTO `zt_history` SET `field` = 'effort',`old` = '',`new` = '33',`diff` = '',`action` = '758'
  INSERT INTO `zt_history` SET `field` = 'conclusion',`old` = '',`new` = 'sdfsd',`diff` = '',`action` = '758'
  INSERT INTO `zt_history` SET `field` = 'number',`old` = '',`new` = '1',`diff` = '',`action` = '758'
  INSERT INTO `zt_history` SET `field` = 'reviewer',`old` = '',`new` = 'hgfhc',`diff` = '',`action` = '758'
  INSERT INTO `zt_history` SET `field` = 'item',`old` = '',`new` = 'fghf',`diff` = '',`action` = '758'
  INSERT INTO `zt_history` SET `field` = 'line',`old` = '',`new` = 'sdf',`diff` = '',`action` = '758'
  INSERT INTO `zt_history` SET `field` = 'severity',`old` = '',`new` = 'A',`diff` = '',`action` = '758'
  INSERT INTO `zt_history` SET `field` = 'description',`old` = '',`new` = 'faeraf',`diff` = '',`action` = '758'
  INSERT INTO `zt_history` SET `field` = 'proposal',`old` = '',`new` = 'ergaer',`diff` = '',`action` = '758'
  INSERT INTO `zt_history` SET `field` = 'changed',`old` = '',`new` = 'N',`diff` = '',`action` = '758'
  INSERT INTO `zt_history` SET `field` = 'action',`old` = '',`new` = 'rggre',`diff` = '',`action` = '758'
  INSERT INTO `zt_history` SET `field` = 'chkd',`old` = '',`new` = 'Y',`diff` = '',`action` = '758'
  INSERT INTO `zt_history` SET `field` = 'number',`old` = '',`new` = '2',`diff` = '',`action` = '758'
  INSERT INTO `zt_history` SET `field` = 'reviewer',`old` = '',`new` = 'dgr',`diff` = '',`action` = '758'
  INSERT INTO `zt_history` SET `field` = 'item',`old` = '',`new` = 'fhn',`diff` = '',`action` = '758'
  INSERT INTO `zt_history` SET `field` = 'line',`old` = '',`new` = 'fbft',`diff` = '',`action` = '758'
  INSERT INTO `zt_history` SET `field` = 'severity',`old` = '',`new` = 'B',`diff` = '',`action` = '758'
  INSERT INTO `zt_history` SET `field` = 'description',`old` = '',`new` = 'gfbg',`diff` = '',`action` = '758'
  INSERT INTO `zt_history` SET `field` = 'proposal',`old` = '',`new` = 'fgny',`diff` = '',`action` = '758'
  INSERT INTO `zt_history` SET `field` = 'changed',`old` = '',`new` = 'Y',`diff` = '',`action` = '758'
  INSERT INTO `zt_history` SET `field` = 'action',`old` = '',`new` = 'gfnytm',`diff` = '',`action` = '758'
  INSERT INTO `zt_history` SET `field` = 'chkd',`old` = '',`new` = 'Y',`diff` = '',`action` = '758'
  SELECT t1.*, t2.id AS storyID, t2.title AS storyTitle, t2.version AS latestStoryVersion, t2.status AS storyStatus, t3.realname AS assignedToRealName FROM `zt_task` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_user` AS t3  ON t1.assignedTo = t3.account  WHERE t1.id  = '195'
  SELECT * FROM `zt_file` WHERE objectType  = 'task' AND  objectID  = '195' AND  extra  != 'editor'
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 
  SELECT * FROM `zt_action` WHERE `id` = '758' 
  SELECT * FROM `zt_history` WHERE action IN ('758') ORDER BY `id` 

20161212 09:54:14: task-view-195
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT t1.*, t2.id AS storyID, t2.title AS storyTitle, t2.version AS latestStoryVersion, t2.status AS storyStatus, t3.realname AS assignedToRealName FROM `zt_task` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_user` AS t3  ON t1.assignedTo = t3.account  WHERE t1.id  = '195'
  SELECT * FROM `zt_file` WHERE objectType  = 'task' AND  objectID  = '195' AND  extra  != 'editor'
  SELECT * FROM `zt_review` WHERE task  = '195'
  SELECT * FROM `zt_reviewDetail` WHERE reviewID  = '30' AND  deleted  = '0'
  SELECT * FROM `zt_story` WHERE `id` = '1' 
  SELECT title,spec,spec2,spec3,verify FROM `zt_storyspec` WHERE story  = '1' AND  version  = '2'
  SELECT t1.project, t2.name, t2.status FROM `zt_projectstory` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project = t2.id  WHERE t1.story  = '1' ORDER BY t1.`project` DESC 
  SELECT id, name, assignedTo, project, status, consumed, `left` FROM `zt_task` WHERE story  = '1' AND  deleted  = '0' ORDER BY `id` DESC 
  SELECT * FROM `zt_storystage` WHERE story  = '1'
  SELECT id,title,branch FROM `zt_productplan` WHERE id IN ('1')
  SELECT * FROM `zt_file` WHERE objectType  = 'story' AND  objectID  = '1' AND  extra  != 'editor'
  UPDATE `zt_action` SET  `read` = '1' WHERE objectType  = 'task' AND  objectID  = '195' AND  `read`  = '0'
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT commiter, account, realname FROM `zt_user` WHERE commiter  != ''
  SELECT * FROM `zt_action` WHERE objectType  = 'task' AND  objectID  = '195' ORDER BY `date` desc 
  SELECT * FROM `zt_history` WHERE action IN ('758','757','756','755','754') ORDER BY `id` 
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 
  SELECT path FROM `zt_module` WHERE id  = '1'
  SELECT * FROM `zt_module` WHERE id  = '1'
  SELECT name FROM `zt_product` WHERE id  = '1'
  SELECT path FROM `zt_module` WHERE id  = '1'
  SELECT * FROM `zt_module` WHERE id IN ('1') ORDER BY `grade` 

20161212 09:54:20: task-edit-195
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT t1.*, t2.id AS storyID, t2.title AS storyTitle, t2.version AS latestStoryVersion, t2.status AS storyStatus, t3.realname AS assignedToRealName FROM `zt_task` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_user` AS t3  ON t1.assignedTo = t3.account  WHERE t1.id  = '195'
  SELECT * FROM `zt_file` WHERE objectType  = 'task' AND  objectID  = '195' AND  extra  != 'editor'
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT t1.account, t2.realname FROM `zt_team` AS t1  LEFT JOIN `zt_user` AS t2  ON t1.account = t2.account  WHERE t1.project  = '3' AND  t2.deleted  = '0'
  SELECT commiter, account, realname FROM `zt_user` WHERE commiter  != ''
  SELECT * FROM `zt_action` WHERE objectType  = 'task' AND  objectID  = '195' ORDER BY `date` desc 
  SELECT * FROM `zt_history` WHERE action IN ('758','757','756','755','754') ORDER BY `id` 
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT * FROM `zt_review` WHERE task  = '195'
  SELECT * FROM `zt_reviewDetail` WHERE reviewID  = '30' AND  deleted  = '0'
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT t2.id, t2.title, t2.module, t2.pri, t2.estimate, t3.name AS product FROM `zt_projectstory` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_product` AS t3  ON t1.product = t3.id  WHERE t1.project  = '3' AND  t2.deleted  = '0'
  SELECT account, realname, deleted FROM `zt_user` WHERE deleted  = '0' ORDER BY `account` 
  SELECT account, realname, deleted FROM `zt_user` WHERE account IN ('admin','','')
  SELECT t1.product, t2.name FROM `zt_projectproduct` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product = t2.id  WHERE t1.project  = '3'
  SELECT * FROM `zt_branch` WHERE product IN ('1') AND  deleted  = '0'
  SELECT * FROM `zt_product` WHERE id IN ('1')
  SELECT openedVersion FROM `zt_project` WHERE id  = '3'
  SELECT product,branch FROM `zt_projectproduct` WHERE project  = '3'
  SELECT id,root,branch FROM `zt_module` WHERE root IN ('1') AND  type  = 'story'
  SELECT id FROM `zt_module` WHERE root  = '3' AND  type  = 'task'
  SELECT DISTINCT t1.id FROM `zt_module` AS t1  LEFT JOIN `zt_task` AS t2  ON t1.id=t2.module  WHERE t2.module  != '0' AND  t2.project  = '3' AND  t2.deleted  = '0' AND  t1.type  = 'story'
  SELECT * FROM `zt_module` WHERE root = 3 and type = 'task' and parent = 0 
  SELECT * FROM `zt_module` WHERE ((root = 3 and type = 'task') OR (root = 1 and type = 'story'))  ORDER BY `grade` desc,`branch`,`type`,`order` 

20161212 09:54:26: task-edit-195
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT t1.*, t2.id AS storyID, t2.title AS storyTitle, t2.version AS latestStoryVersion, t2.status AS storyStatus, t3.realname AS assignedToRealName FROM `zt_task` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_user` AS t3  ON t1.assignedTo = t3.account  WHERE t1.id  = '195'
  SELECT * FROM `zt_file` WHERE objectType  = 'task' AND  objectID  = '195' AND  extra  != 'editor'
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT t1.account, t2.realname FROM `zt_team` AS t1  LEFT JOIN `zt_user` AS t2  ON t1.account = t2.account  WHERE t1.project  = '3' AND  t2.deleted  = '0'
  SELECT commiter, account, realname FROM `zt_user` WHERE commiter  != ''
  SELECT * FROM `zt_action` WHERE objectType  = 'task' AND  objectID  = '195' ORDER BY `date` desc 
  SELECT * FROM `zt_history` WHERE action IN ('758','757','756','755','754') ORDER BY `id` 
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT t1.*, t2.id AS storyID, t2.title AS storyTitle, t2.version AS latestStoryVersion, t2.status AS storyStatus, t3.realname AS assignedToRealName FROM `zt_task` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_user` AS t3  ON t1.assignedTo = t3.account  WHERE t1.id  = '195'
  SELECT * FROM `zt_file` WHERE objectType  = 'task' AND  objectID  = '195' AND  extra  != 'editor'
  SELECT version FROM `zt_story` WHERE id  = '1'
  SELECT * FROM `zt_review` WHERE task  = '195'
  SELECT * FROM `zt_review` WHERE id  = '30'
  UPDATE `zt_task` SET `module` = '1',`type` = 'review',`story` = '1',`color` = '',`name` = '首页设计和开发dddd',`pri` = '1',`estimate` = '5',`desc` = 'erdgtrshtsr4',`estStarted` = '2016-12-12',`deadline` = '2016-12-12',`mailto` = ',tester3',`project` = '3',`left` = '0',`status` = 'done',`assignedTo` = 'admin',`assignedDate` = '',`consumed` = '5',`realStarted` = '2016-12-12',`finishedBy` = 'admin',`finishedDate` = '2016-12-12 09:53:14',`canceledBy` = '',`canceledDate` = '',`closedBy` = '',`closedReason` = '',`closedDate` = '',`lastEditedBy` = 'admin',`lastEditedDate` = '2016-12-12 09:54:26' WHERE id  = '195'
  DELETE FROM `zt_storystage` WHERE story  = '1'
  SELECT * FROM `zt_story` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT t1.project,t3.branch FROM `zt_projectstory` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project = t2.id  LEFT JOIN `zt_projectproduct` AS t3  ON t1.project = t3.project  WHERE t1.story  = '1' AND  t2.deleted  = '0'
  SELECT type,project,status FROM `zt_task` WHERE project IN ('1','2','3') AND  story  = '1' AND  type IN ('devel','test') AND  status  != 'cancel' AND  closedReason  != 'cancel' AND  deleted  = '0'
  SELECT * FROM `zt_release` WHERE CONCAT(',', stories, ',')  LIKE '%,1,%' AND  deleted  = '0'
  UPDATE `zt_story` SET  `stage` = 'developed' WHERE id  = '1'
  UPDATE `zt_review` SET `fileNO` = 'dafds',`recorder` = 'sdf',`reviewName` = 'qwq',`task` = '195',`doc` = 'fgtr',`referenceDoc` = 'qw',`reference` = 'qw',`pages` = '2',`reviewers` = 'qw',`reviewDate` = '2016-12-12',`reviewScope` = 'btr',`reviewPlace` = 'fdgfd',`effort` = '33',`conclusion` = 'sdfsd',`id` = '30' WHERE id  = '30' LIMIT 1 
  SELECT id FROM `zt_reviewDetail` WHERE reviewID  = '30' AND  deleted  = '0'
  SELECT * FROM `zt_reviewDetail` WHERE id  = '67' AND  deleted  = '0'
  UPDATE `zt_reviewDetail` SET `id` = '67',`reviewID` = '30',`number` = '1',`reviewer` = 'hgfhc',`item` = 'fghf',`line` = 'sdf',`severity` = 'A',`description` = 'faeraf4',`proposal` = 'ergaer',`changed` = 'N',`action` = 'rggre',`chkd` = 'Y' WHERE id  = '67'
  SELECT * FROM `zt_reviewDetail` WHERE id  = '68' AND  deleted  = '0'
  UPDATE `zt_reviewDetail` SET `id` = '68',`reviewID` = '30',`number` = '2',`reviewer` = 'dgr',`item` = 'fhn',`line` = 'fbft',`severity` = 'B',`description` = 'gfbg4',`proposal` = 'fgny',`changed` = 'Y',`action` = 'gfnytm',`chkd` = 'Y' WHERE id  = '68'
  DELETE FROM `zt_storystage` WHERE story  = '1'
  SELECT * FROM `zt_story` WHERE `id` = '1' 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT t1.project,t3.branch FROM `zt_projectstory` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project = t2.id  LEFT JOIN `zt_projectproduct` AS t3  ON t1.project = t3.project  WHERE t1.story  = '1' AND  t2.deleted  = '0'
  SELECT type,project,status FROM `zt_task` WHERE project IN ('1','2','3') AND  story  = '1' AND  type IN ('devel','test') AND  status  != 'cancel' AND  closedReason  != 'cancel' AND  deleted  = '0'
  SELECT * FROM `zt_release` WHERE CONCAT(',', stories, ',')  LIKE '%,1,%' AND  deleted  = '0'
  UPDATE `zt_story` SET  `stage` = 'developed' WHERE id  = '1'
  SELECT t1.*, t2.id AS storyID, t2.title AS storyTitle, t2.version AS latestStoryVersion, t2.status AS storyStatus, t3.realname AS assignedToRealName FROM `zt_task` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_user` AS t3  ON t1.assignedTo = t3.account  WHERE t1.id  = '195'
  SELECT * FROM `zt_file` WHERE objectType  = 'task' AND  objectID  = '195' AND  extra  != 'editor'
  SELECT project, story FROM `zt_task` WHERE id  = '195'
  SELECT product FROM `zt_story` WHERE id  = '1'
  INSERT INTO `zt_action` SET `objectType` = 'task',`objectID` = '195',`actor` = 'admin',`action` = 'edited',`date` = '2016-12-12 09:54:26',`comment` = '',`extra` = '',`product` = ',1,',`project` = '3'
  INSERT INTO `zt_history` SET `field` = 'description',`old` = 'faeraf',`new` = 'faeraf4',`diff` = '',`action` = '759'
  INSERT INTO `zt_history` SET `field` = 'description',`old` = 'gfbg',`new` = 'gfbg4',`diff` = '',`action` = '759'
  SELECT t1.*, t2.id AS storyID, t2.title AS storyTitle, t2.version AS latestStoryVersion, t2.status AS storyStatus, t3.realname AS assignedToRealName FROM `zt_task` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_user` AS t3  ON t1.assignedTo = t3.account  WHERE t1.id  = '195'
  SELECT * FROM `zt_file` WHERE objectType  = 'task' AND  objectID  = '195' AND  extra  != 'editor'
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 
  SELECT * FROM `zt_action` WHERE `id` = '759' 
  SELECT * FROM `zt_history` WHERE action IN ('759') ORDER BY `id` 

20161212 09:54:26: task-view-195
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT t1.*, t2.id AS storyID, t2.title AS storyTitle, t2.version AS latestStoryVersion, t2.status AS storyStatus, t3.realname AS assignedToRealName FROM `zt_task` AS t1  LEFT JOIN `zt_story` AS t2  ON t1.story = t2.id  LEFT JOIN `zt_user` AS t3  ON t1.assignedTo = t3.account  WHERE t1.id  = '195'
  SELECT * FROM `zt_file` WHERE objectType  = 'task' AND  objectID  = '195' AND  extra  != 'editor'
  SELECT * FROM `zt_review` WHERE task  = '195'
  SELECT * FROM `zt_reviewDetail` WHERE reviewID  = '30' AND  deleted  = '0'
  SELECT * FROM `zt_story` WHERE `id` = '1' 
  SELECT title,spec,spec2,spec3,verify FROM `zt_storyspec` WHERE story  = '1' AND  version  = '2'
  SELECT t1.project, t2.name, t2.status FROM `zt_projectstory` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project = t2.id  WHERE t1.story  = '1' ORDER BY t1.`project` DESC 
  SELECT id, name, assignedTo, project, status, consumed, `left` FROM `zt_task` WHERE story  = '1' AND  deleted  = '0' ORDER BY `id` DESC 
  SELECT * FROM `zt_storystage` WHERE story  = '1'
  SELECT id,title,branch FROM `zt_productplan` WHERE id IN ('1')
  SELECT * FROM `zt_file` WHERE objectType  = 'story' AND  objectID  = '1' AND  extra  != 'editor'
  UPDATE `zt_action` SET  `read` = '1' WHERE objectType  = 'task' AND  objectID  = '195' AND  `read`  = '0'
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT commiter, account, realname FROM `zt_user` WHERE commiter  != ''
  SELECT * FROM `zt_action` WHERE objectType  = 'task' AND  objectID  = '195' ORDER BY `date` desc 
  SELECT * FROM `zt_history` WHERE action IN ('759','758','757','756','755','754') ORDER BY `id` 
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 
  SELECT path FROM `zt_module` WHERE id  = '1'
  SELECT * FROM `zt_module` WHERE id  = '1'
  SELECT name FROM `zt_product` WHERE id  = '1'
  SELECT path FROM `zt_module` WHERE id  = '1'
  SELECT * FROM `zt_module` WHERE id IN ('1') ORDER BY `grade` 

20161212 09:57:07: doc-objectLibs-project-3-project
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT id,name FROM `zt_project` WHERE id  = '3'
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT * FROM `zt_doclib` WHERE deleted  = '0' AND  project  = '3' ORDER BY `id` 

20161212 09:57:09: doc-browse-5-all-0-id_desc-project
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_doclib` WHERE `id` = '5' 
  SELECT t1.* FROM `zt_doclib` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project=t2.id  WHERE t1.project  != '0' AND  t1.deleted  = '0' ORDER BY t2.`order` desc,t1.`id` 
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT * FROM `zt_doc` WHERE deleted  = '0' AND  lib IN ('5') ORDER BY `id` desc 
  SELECT COUNT(*) AS recTotal FROM `zt_doc` WHERE deleted  = '0' AND  lib IN ('5') 
  SELECT * FROM `zt_doc` WHERE deleted  = '0' AND  lib IN ('5') ORDER BY `id` desc 
  SELECT * FROM `zt_doc` WHERE deleted  = '0' AND  lib IN ('5') ORDER BY `id` desc 
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT openedVersion FROM `zt_project` WHERE id  = '5doc'
  SELECT * FROM `zt_module` WHERE root  = '5' AND  type  = '0' ORDER BY `grade` desc,`order` 
  SELECT * FROM `zt_product` WHERE `id` = '5' 
  SELECT * FROM `zt_module` WHERE root  = '5' AND  type  = 'doc' ORDER BY `grade` desc,`order` 
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 

20161212 09:57:11: doc-create-5-0
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_doclib` WHERE `id` = '5' 
  SELECT t1.* FROM `zt_doclib` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project=t2.id  WHERE t1.project  != '0' AND  t1.deleted  = '0' ORDER BY t2.`order` desc,t1.`id` 
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT * FROM `zt_module` WHERE root  = '5' AND  type  = 'doc' ORDER BY `grade` desc,`order` 
  SELECT id, name FROM `zt_group`
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 

20161212 09:57:11: file-ajaxUeditorUpload-584e03f74e136
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 09:57:17: doc-objectLibs-project-3-project
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT id,name FROM `zt_project` WHERE id  = '3'
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT * FROM `zt_doclib` WHERE deleted  = '0' AND  project  = '3' ORDER BY `id` 

20161212 09:57:19: doc-browse-5-all-0-id_desc-project
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_doclib` WHERE `id` = '5' 
  SELECT t1.* FROM `zt_doclib` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project=t2.id  WHERE t1.project  != '0' AND  t1.deleted  = '0' ORDER BY t2.`order` desc,t1.`id` 
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT * FROM `zt_doc` WHERE deleted  = '0' AND  lib IN ('5') ORDER BY `id` desc 
  SELECT COUNT(*) AS recTotal FROM `zt_doc` WHERE deleted  = '0' AND  lib IN ('5') 
  SELECT * FROM `zt_doc` WHERE deleted  = '0' AND  lib IN ('5') ORDER BY `id` desc 
  SELECT * FROM `zt_doc` WHERE deleted  = '0' AND  lib IN ('5') ORDER BY `id` desc 
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT openedVersion FROM `zt_project` WHERE id  = '5doc'
  SELECT * FROM `zt_module` WHERE root  = '5' AND  type  = '0' ORDER BY `grade` desc,`order` 
  SELECT * FROM `zt_product` WHERE `id` = '5' 
  SELECT * FROM `zt_module` WHERE root  = '5' AND  type  = 'doc' ORDER BY `grade` desc,`order` 
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 

20161212 09:57:28: doc-objectLibs-project-3-project
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT id,name FROM `zt_project` WHERE id  = '3'
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT * FROM `zt_doclib` WHERE deleted  = '0' AND  project  = '3' ORDER BY `id` 

20161212 09:57:30: doc-browse-5-all-0-id_desc-project
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_doclib` WHERE `id` = '5' 
  SELECT t1.* FROM `zt_doclib` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project=t2.id  WHERE t1.project  != '0' AND  t1.deleted  = '0' ORDER BY t2.`order` desc,t1.`id` 
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT * FROM `zt_doc` WHERE deleted  = '0' AND  lib IN ('5') ORDER BY `id` desc 
  SELECT COUNT(*) AS recTotal FROM `zt_doc` WHERE deleted  = '0' AND  lib IN ('5') 
  SELECT * FROM `zt_doc` WHERE deleted  = '0' AND  lib IN ('5') ORDER BY `id` desc 
  SELECT * FROM `zt_doc` WHERE deleted  = '0' AND  lib IN ('5') ORDER BY `id` desc 
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT openedVersion FROM `zt_project` WHERE id  = '5doc'
  SELECT * FROM `zt_module` WHERE root  = '5' AND  type  = '0' ORDER BY `grade` desc,`order` 
  SELECT * FROM `zt_product` WHERE `id` = '5' 
  SELECT * FROM `zt_module` WHERE root  = '5' AND  type  = 'doc' ORDER BY `grade` desc,`order` 
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 

20161212 09:57:33: doc-create-5-0
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_doclib` WHERE `id` = '5' 
  SELECT t1.* FROM `zt_doclib` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project=t2.id  WHERE t1.project  != '0' AND  t1.deleted  = '0' ORDER BY t2.`order` desc,t1.`id` 
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT * FROM `zt_module` WHERE root  = '5' AND  type  = 'doc' ORDER BY `grade` desc,`order` 
  SELECT id, name FROM `zt_group`
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 

20161212 09:57:34: file-ajaxUeditorUpload-584e040d95419
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 09:59:37: doc-create-5-0
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT id,title FROM `zt_doc` WHERE deleted  = '0' AND  title IN ('sdaferg') AND  addedDate  >= '2016-12-12 09:58:36' AND  lib = '5' AND module = 0 
  SELECT * FROM `zt_doclib` WHERE `id` = '5' 
  INSERT INTO `zt_doc` SET `lib` = '5',`module` = '0',`title` = 'sdaferg',`keywords` = 'dkgd',`type` = 'url',`acl` = 'open',`users` = '',`addedBy` = 'admin',`addedDate` = '2016-12-12 09:59:36',`version` = '1',`product` = '0',`project` = '3'
  INSERT INTO `zt_doccontent` SET `title` = 'sdaferg',`content` = 'www.baidu.com/dahgdhgdhgfdhsfgjkerjkddffffffffffffffffffffffffffffffffffffffsajdfkldassssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssldfgstrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrtggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggsgsrrrrrrrrrrrrrrrrrrrrrrrtrtsssshbftgtrbtggggggggggggrrrrrrtsssssssssssssssssssssffgfs',`type` = 'html',`version` = '1',`doc` = '2',`files` = ''
  SELECT * FROM `zt_doclib` WHERE `id` = '5' 
  SELECT product, project FROM `zt_doc` WHERE id  = '2'
  INSERT INTO `zt_action` SET `objectType` = 'doc',`objectID` = '2',`actor` = 'admin',`action` = 'created',`date` = '2016-12-12 09:59:37',`comment` = '',`extra` = '',`product` = ',0,',`project` = '3'

20161212 09:59:37: doc-browse-5-byModule-0-id_desc-project
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_doclib` WHERE `id` = '5' 
  SELECT t1.* FROM `zt_doclib` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project=t2.id  WHERE t1.project  != '0' AND  t1.deleted  = '0' ORDER BY t2.`order` desc,t1.`id` 
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT * FROM `zt_project` WHERE `id` = '3' 
  SELECT 
            SUM(estimate) AS totalEstimate, 
            SUM(consumed) AS totalConsumed, 
            SUM(`left`) AS totalLeft FROM `zt_task` WHERE project  = '3' AND  status  != 'cancel' AND  deleted  = '0'
  SELECT sum(days * hours) AS totalHours FROM `zt_team` WHERE project  = '3'
  SELECT * FROM `zt_doc` WHERE deleted  = '0' AND  lib IN ('5') ORDER BY `id` desc 
  SELECT COUNT(*) AS recTotal FROM `zt_doc` WHERE deleted  = '0' AND  lib IN ('5') 
  SELECT * FROM `zt_doc` WHERE deleted  = '0' AND  lib IN ('5') ORDER BY `id` desc 
  SELECT * FROM `zt_doc` WHERE deleted  = '0' AND  lib IN ('5') ORDER BY `id` desc 
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT openedVersion FROM `zt_project` WHERE id  = '5doc'
  SELECT * FROM `zt_module` WHERE root  = '5' AND  type  = '0' ORDER BY `grade` desc,`order` 
  SELECT * FROM `zt_product` WHERE `id` = '5' 
  SELECT * FROM `zt_module` WHERE root  = '5' AND  type  = 'doc' ORDER BY `grade` desc,`order` 
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 

20161212 09:59:40: doc-view-2
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_doc` WHERE id  = '2'
  SELECT * FROM `zt_doccontent` WHERE doc  = '2' AND  version  = '1'
  SELECT * FROM `zt_file` WHERE objectType  = 'doc' AND  objectID  = '2' AND  extra  != 'editor'
  SELECT name FROM `zt_project` WHERE `id` = '3' 
  SELECT * FROM `zt_doclib` WHERE `id` = '5' 
  SELECT t1.* FROM `zt_doclib` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project=t2.id  WHERE t1.project  != '0' AND  t1.deleted  = '0' ORDER BY t2.`order` desc,t1.`id` 
  SELECT * FROM `zt_doclib` WHERE `id` = '5' 
  SELECT id,name FROM `zt_project` WHERE id  = '3'
  SELECT commiter, account, realname FROM `zt_user` WHERE commiter  != ''
  SELECT * FROM `zt_action` WHERE objectType  = 'doc' AND  objectID  = '2' ORDER BY `date` desc 
  SELECT * FROM `zt_history` WHERE action IN ('760') ORDER BY `id` 
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 
  SELECT * FROM `zt_doc` WHERE id  = '2' OR deleted  = '0' AND  lib IN ('5')  ORDER BY `id` desc 

20161212 09:59:40: file-ajaxUeditorUpload-584e048c66a72
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 10:00:04: doc-ajaxGetAllLibs
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT id,product,project,name FROM `zt_doclib` WHERE deleted  = '0' ORDER BY `product` desc,`project` desc,`id` asc 
  SELECT id,name FROM `zt_product` WHERE id IN ('3','2','1') AND  deleted  = '0' ORDER BY `order` desc 
  SELECT DISTINCT product FROM `zt_projectproduct` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project=t2.id  WHERE t1.product IN ('3','2','1') AND  t2.deleted  = '0'
  SELECT id,name FROM `zt_project` WHERE id IN ('4','3','2','1') AND  deleted  = '0' ORDER BY `order` desc 

20161212 10:00:06: doc
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT t1.* FROM `zt_doclib` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product=t2.id  WHERE t1.deleted  = '0' AND  t1.product  != '0' ORDER BY t2.`order` desc,`id` desc 
  SELECT id,name,`order` FROM `zt_product` WHERE id IN ('3','2','1') ORDER BY `order` desc,`id` desc 
  SELECT t1.* FROM `zt_doclib` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project=t2.id  WHERE t1.deleted  = '0' AND  t1.project  != '0' ORDER BY t2.`order` desc,`id` desc 
  SELECT id,name,`order` FROM `zt_project` WHERE id IN ('4','3','2','1') ORDER BY `order` desc,`id` desc 
  SELECT * FROM `zt_doclib` WHERE deleted  = '0' AND  project  = '0' AND  product  = '0' ORDER BY `id` desc 
  SELECT * FROM `zt_doclib` WHERE deleted  = '0' AND  product IN ('3','2','1') ORDER BY `id` 
  SELECT DISTINCT product FROM `zt_projectproduct` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project=t2.id  WHERE t1.product IN ('3','2','1') AND  t2.deleted  = '0'
  SELECT * FROM `zt_doclib` WHERE deleted  = '0' AND  project IN ('4','3','2','1') ORDER BY `id` 

20161212 10:00:12: product
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 

20161212 10:00:12: product-browse
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_story` WHERE product IN ('1') AND  status IN ('','draft','active','changed') AND  deleted  = '0' ORDER BY `id` desc 
  SELECT COUNT(*) AS recTotal FROM `zt_story` WHERE product IN ('1') AND  status IN ('','draft','active','changed') AND  deleted  = '0' 
  SELECT * FROM `zt_story` WHERE product IN ('1') AND  status IN ('','draft','active','changed') AND  deleted  = '0' ORDER BY `id` desc 
  SELECT * FROM `zt_story` WHERE product IN ('1') AND  status IN ('','draft','active','changed') AND  deleted  = '0' ORDER BY `id` desc 
  SELECT id,title FROM `zt_productplan` WHERE product IN ('1') AND  deleted  = '0'
  SELECT * FROM `zt_storystage` WHERE branch IN ('0')
  SELECT * FROM `zt_story` WHERE product IN ('1') AND  status IN ('','draft','active','changed') AND  deleted  = '0' ORDER BY `id` desc 
  SELECT id,CONCAT(title, " [", begin, " ~ ", end, "]") as title FROM `zt_productplan` WHERE product IN ('1') AND  deleted  = '0' ORDER BY `begin` desc 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_module` WHERE root  = '1' AND  type  = 'story' ORDER BY `grade` desc,`order` 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT id,CONCAT(title, " [", begin, " ~ ", end, "]") as title FROM `zt_productplan` WHERE product IN ('1') AND  deleted  = '0' ORDER BY `begin` desc 
  SELECT DISTINCT story FROM `zt_case` WHERE story IN ('33','7','6','5','4','3','2','1')
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_module` WHERE root  = '1' AND  type  = 'story' ORDER BY `grade` desc,`order` 
  SELECT account, realname, deleted, INSTR(',pd,po,', role) AS roleOrder FROM `zt_user` WHERE deleted  = '0' ORDER BY `roleOrder` DESC,`account` 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_module` WHERE root  = '1' AND  type  = 'story' ORDER BY `grade` desc,`order` 
  SELECT * FROM `zt_branch` WHERE product  = '1' AND  deleted  = '0' ORDER BY `id` asc 
  SELECT * FROM `zt_product` WHERE `id` = '1' 
  SELECT * FROM `zt_storystage` WHERE story IN ('33','7','6','5','4','3','2','1')

20161212 10:00:14: doc
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT t1.* FROM `zt_doclib` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product=t2.id  WHERE t1.deleted  = '0' AND  t1.product  != '0' ORDER BY t2.`order` desc,`id` desc 
  SELECT id,name,`order` FROM `zt_product` WHERE id IN ('3','2','1') ORDER BY `order` desc,`id` desc 
  SELECT t1.* FROM `zt_doclib` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project=t2.id  WHERE t1.deleted  = '0' AND  t1.project  != '0' ORDER BY t2.`order` desc,`id` desc 
  SELECT id,name,`order` FROM `zt_project` WHERE id IN ('4','3','2','1') ORDER BY `order` desc,`id` desc 
  SELECT * FROM `zt_doclib` WHERE deleted  = '0' AND  project  = '0' AND  product  = '0' ORDER BY `id` desc 
  SELECT * FROM `zt_doclib` WHERE deleted  = '0' AND  product IN ('3','2','1') ORDER BY `id` 
  SELECT DISTINCT product FROM `zt_projectproduct` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project=t2.id  WHERE t1.product IN ('3','2','1') AND  t2.deleted  = '0'
  SELECT * FROM `zt_doclib` WHERE deleted  = '0' AND  project IN ('4','3','2','1') ORDER BY `id` 

20161212 10:00:22: doc-browse-5
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_doclib` WHERE `id` = '5' 
  SELECT t1.* FROM `zt_doclib` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project=t2.id  WHERE t1.project  != '0' AND  t1.deleted  = '0' ORDER BY t2.`order` desc,t1.`id` 
  SELECT * FROM `zt_doclib` WHERE `id` = '5' 
  SELECT id,name FROM `zt_project` WHERE id  = '3'
  SELECT * FROM `zt_doc` WHERE deleted  = '0' AND  lib IN ('5') ORDER BY `id` desc 
  SELECT COUNT(*) AS recTotal FROM `zt_doc` WHERE deleted  = '0' AND  lib IN ('5') 
  SELECT * FROM `zt_doc` WHERE deleted  = '0' AND  lib IN ('5') ORDER BY `id` desc 
  SELECT * FROM `zt_doc` WHERE deleted  = '0' AND  lib IN ('5') ORDER BY `id` desc 
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT openedVersion FROM `zt_project` WHERE id  = '5doc'
  SELECT * FROM `zt_module` WHERE root  = '5' AND  type  = '0' ORDER BY `grade` desc,`order` 
  SELECT * FROM `zt_product` WHERE `id` = '5' 
  SELECT * FROM `zt_module` WHERE root  = '5' AND  type  = 'doc' ORDER BY `grade` desc,`order` 
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 

20161212 10:00:26: doc-edit-2
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_doc` WHERE id  = '2'
  SELECT * FROM `zt_doccontent` WHERE doc  = '2' AND  version  = '1'
  SELECT * FROM `zt_file` WHERE objectType  = 'doc' AND  objectID  = '2' AND  extra  != 'editor'
  SELECT name FROM `zt_project` WHERE `id` = '3' 
  SELECT * FROM `zt_doclib` WHERE `id` = '5' 
  SELECT t1.* FROM `zt_doclib` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project=t2.id  WHERE t1.project  != '0' AND  t1.deleted  = '0' ORDER BY t2.`order` desc,t1.`id` 
  SELECT * FROM `zt_doclib` WHERE `id` = '5' 
  SELECT id,name FROM `zt_project` WHERE id  = '3'
  SELECT * FROM `zt_module` WHERE root  = '5' AND  type  = 'doc' ORDER BY `grade` desc,`order` 
  SELECT id, name FROM `zt_group`
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 

20161212 10:00:27: file-ajaxUeditorUpload-584e04ba86780
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 10:10:27: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 10:20:27: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_config` WHERE 1 = 1  AND  owner IN ('system') AND  module IN ('common') AND  section IN ('global') AND  `key` IN ('sn')

20161212 10:30:35: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 10:40:36: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 10:49:35: doc-edit-2
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_doc` WHERE id  = '2'
  SELECT * FROM `zt_doccontent` WHERE doc  = '2' AND  version  = '1'
  SELECT * FROM `zt_file` WHERE objectType  = 'doc' AND  objectID  = '2' AND  extra  != 'editor'
  SELECT name FROM `zt_project` WHERE `id` = '3' 
  SELECT * FROM `zt_doclib` WHERE `id` = '5' 
  SELECT t1.* FROM `zt_doclib` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project=t2.id  WHERE t1.project  != '0' AND  t1.deleted  = '0' ORDER BY t2.`order` desc,t1.`id` 
  SELECT * FROM `zt_doclib` WHERE `id` = '5' 
  SELECT id,name FROM `zt_project` WHERE id  = '3'
  SELECT * FROM `zt_module` WHERE root  = '5' AND  type  = 'doc' ORDER BY `grade` desc,`order` 
  SELECT id, name FROM `zt_group`
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 

20161212 10:49:40: file-ajaxUeditorUpload-584e103f1b348
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 10:51:12: doc-edit-2
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_doc` WHERE id  = '2'
  SELECT * FROM `zt_doccontent` WHERE doc  = '2' AND  version  = '1'
  SELECT * FROM `zt_file` WHERE objectType  = 'doc' AND  objectID  = '2' AND  extra  != 'editor'
  SELECT name FROM `zt_project` WHERE `id` = '3' 
  SELECT * FROM `zt_doclib` WHERE `id` = '5' 
  SELECT t1.* FROM `zt_doclib` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project=t2.id  WHERE t1.project  != '0' AND  t1.deleted  = '0' ORDER BY t2.`order` desc,t1.`id` 
  SELECT * FROM `zt_doclib` WHERE `id` = '5' 
  SELECT id,name FROM `zt_project` WHERE id  = '3'
  SELECT * FROM `zt_module` WHERE root  = '5' AND  type  = 'doc' ORDER BY `grade` desc,`order` 
  SELECT id, name FROM `zt_group`
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 

20161212 10:51:13: file-ajaxUeditorUpload-584e10a069b67
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 10:56:56: 
  SELECT * FROM `zt_company` ORDER BY `id`  LIMIT 1 
  SELECT * FROM `zt_config` WHERE owner IN ('system','') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_user` WHERE account  = 'admin' AND  deleted  = '0'
  UPDATE `zt_user` SET  visits = visits + 1, `ip` = '127.0.0.1', `last` = '1481511414' WHERE account  = 'admin'
  SELECT t1.acl FROM `zt_group` AS t1  LEFT JOIN `zt_usergroup` AS t2  ON t1.id=t2.group  WHERE t2.account  = 'admin'
  SELECT module, method FROM `zt_usergroup` AS t1  LEFT JOIN `zt_grouppriv` AS t2  ON t1.group = t2.group  WHERE t1.account  = 'admin'
  SELECT `group` FROM `zt_usergroup` WHERE `account` = 'admin' 
  INSERT INTO `zt_action` SET `objectType` = 'user',`objectID` = '1',`actor` = 'admin',`action` = 'login',`date` = '2016-12-12 10:56:56',`comment` = '',`extra` = '',`product` = ',0,',`project` = '0'
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 

20161212 10:56:57: my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE account  = 'admin' AND  module  = 'my' AND  hidden  = '0' ORDER BY `order` 

20161212 10:56:58: block-printBlock-1-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '1'

20161212 10:56:58: block-printBlock-2-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '2'
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT * FROM `zt_action` WHERE 1  AND  date  > '2016-12-12' AND  date  < '2016-12-13' AND  (1)  ORDER BY `date` desc 
  SELECT commiter, account, realname FROM `zt_user` WHERE commiter  != ''
  SELECT id, account AS name FROM `zt_user` WHERE id IN ('1')
  SELECT id, title AS name FROM `zt_doc` WHERE id IN ('2','1')
  SELECT id, name AS name FROM `zt_task` WHERE id IN ('195')
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 

20161212 10:56:58: block-printBlock-3-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '3'
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  status  != 'done' AND  deleted  = '0' ORDER BY `order` desc 
  SELECT * FROM `zt_project` WHERE id IN ('4','3','2') ORDER BY `order` desc 
  SELECT COUNT(*) AS recTotal FROM `zt_project` WHERE id IN ('4','3','2') 
  SELECT * FROM `zt_project` WHERE id IN ('4','3','2') ORDER BY `order` desc 
  SELECT id, project, estimate, consumed, `left`, status, closedReason FROM `zt_task` WHERE project IN ('4','3','2') AND  deleted  = '0'
  SELECT project, date AS name, `left` AS value FROM `zt_burn` WHERE project IN ('4','3','2') ORDER BY `date` desc 

20161212 10:56:59: block-printBlock-5-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '5'
  SELECT * FROM `zt_product` WHERE deleted  = '0' AND  status  != 'closed' ORDER BY `order` desc 
  SELECT * FROM `zt_product` WHERE id IN ('3','2','1') ORDER BY `order` desc 
  SELECT COUNT(*) AS recTotal FROM `zt_product` WHERE id IN ('3','2','1') 
  SELECT * FROM `zt_product` WHERE id IN ('3','2','1') ORDER BY `order` desc 
  SELECT product, status, count(status) AS count FROM `zt_story` WHERE deleted  = '0' AND  product IN ('3','2','1') GROUP BY product, status
  SELECT product, count(*) AS count FROM `zt_productplan` WHERE deleted  = '0' AND  product IN ('3','2','1') AND  end  > '2016-12-12 10:56:59' GROUP BY product
  SELECT product, count(*) AS count FROM `zt_release` WHERE deleted  = '0' AND  product IN ('3','2','1') GROUP BY product
  SELECT product,count(*) AS conut FROM `zt_bug` WHERE deleted  = '0' AND  product IN ('3','2','1') GROUP BY product
  SELECT product,count(*) AS count FROM `zt_bug` WHERE status  = 'active' AND  deleted  = '0' AND  product IN ('3','2','1') GROUP BY product
  SELECT product,count(*) AS count FROM `zt_bug` WHERE AssignedTo  = '' AND  deleted  = '0' AND  product IN ('3','2','1') GROUP BY product

20161212 10:56:59: block-printBlock-6-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '6'
  SELECT t1.*, t2.id as projectID, t2.name as projectName, t3.id as storyID, t3.title as storyTitle, t3.status AS storyStatus, t3.version AS latestStoryVersion FROM `zt_task` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project = t2.id  LEFT JOIN `zt_story` AS t3  ON t1.story = t3.id  WHERE t1.deleted  = '0' AND  t1.assignedTo  = 'admin' ORDER BY `id` desc  LIMIT 15 
  SELECT t1.*, t2.id as projectID, t2.name as projectName, t3.id as storyID, t3.title as storyTitle, t3.status AS storyStatus, t3.version AS latestStoryVersion FROM `zt_task` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project = t2.id  LEFT JOIN `zt_story` AS t3  ON t1.story = t3.id  WHERE t1.deleted  = '0' AND  t1.assignedTo  = 'admin' ORDER BY `id` desc  LIMIT 15 

20161212 10:56:59: block-printBlock-4-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '4'
  SELECT * FROM `zt_todo` WHERE account  = 'admin' AND  date  >= '1970-01-01' AND  date  <= '2109-01-01' AND  status IN ('wait','doing') ORDER BY `date`,`status`,`begin`  LIMIT 20 
  SELECT * FROM `zt_todo` WHERE account  = 'admin' AND  date  >= '1970-01-01' AND  date  <= '2109-01-01' AND  status IN ('wait','doing') ORDER BY `date`,`status`,`begin`  LIMIT 20 

20161212 10:56:59: block-printBlock-7-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '7'
  SELECT * FROM `zt_bug` WHERE deleted  = '0' AND  assignedTo  = 'admin' ORDER BY `id` desc  LIMIT 15 

20161212 10:56:59: block-printBlock-8-my
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

20161212 10:57:00: block-printBlock-9-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '9'
  SELECT t1.assignedTo AS assignedTo, t2.* FROM `zt_testrun` AS t1  LEFT JOIN `zt_case` AS t2  ON t1.case = t2.id  LEFT JOIN `zt_testtask` AS t3  ON t1.task = t3.id  WHERE t1.assignedTo  = 'admin' AND  t1.status  != 'done' AND  t3.status  != 'done' AND  t3.deleted  = '0' AND  t2.deleted  = '0' ORDER BY `id` desc  LIMIT 15 

20161212 10:57:03: doc
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT t1.* FROM `zt_doclib` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product=t2.id  WHERE t1.deleted  = '0' AND  t1.product  != '0' ORDER BY t2.`order` desc,`id` desc 
  SELECT id,name,`order` FROM `zt_product` WHERE id IN ('3','2','1') ORDER BY `order` desc,`id` desc 
  SELECT t1.* FROM `zt_doclib` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project=t2.id  WHERE t1.deleted  = '0' AND  t1.project  != '0' ORDER BY t2.`order` desc,`id` desc 
  SELECT id,name,`order` FROM `zt_project` WHERE id IN ('4','3','2','1') ORDER BY `order` desc,`id` desc 
  SELECT * FROM `zt_doclib` WHERE deleted  = '0' AND  project  = '0' AND  product  = '0' ORDER BY `id` desc 
  SELECT * FROM `zt_doclib` WHERE deleted  = '0' AND  product IN ('3','2','1') ORDER BY `id` 
  SELECT DISTINCT product FROM `zt_projectproduct` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project=t2.id  WHERE t1.product IN ('3','2','1') AND  t2.deleted  = '0'
  SELECT * FROM `zt_doclib` WHERE deleted  = '0' AND  project IN ('4','3','2','1') ORDER BY `id` 

20161212 10:57:06: doc-browse-5
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_doclib` WHERE `id` = '5' 
  SELECT t1.* FROM `zt_doclib` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project=t2.id  WHERE t1.project  != '0' AND  t1.deleted  = '0' ORDER BY t2.`order` desc,t1.`id` 
  SELECT * FROM `zt_doclib` WHERE `id` = '5' 
  SELECT id,name FROM `zt_project` WHERE id  = '3'
  SELECT * FROM `zt_doc` WHERE deleted  = '0' AND  lib IN ('5') ORDER BY `id` desc 
  SELECT COUNT(*) AS recTotal FROM `zt_doc` WHERE deleted  = '0' AND  lib IN ('5') 
  SELECT * FROM `zt_doc` WHERE deleted  = '0' AND  lib IN ('5') ORDER BY `id` desc 
  SELECT * FROM `zt_doc` WHERE deleted  = '0' AND  lib IN ('5') ORDER BY `id` desc 
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT openedVersion FROM `zt_project` WHERE id  = '5doc'
  SELECT * FROM `zt_module` WHERE root  = '5' AND  type  = '0' ORDER BY `grade` desc,`order` 
  SELECT * FROM `zt_product` WHERE `id` = '5' 
  SELECT * FROM `zt_module` WHERE root  = '5' AND  type  = 'doc' ORDER BY `grade` desc,`order` 
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 

20161212 10:57:12: doc-create-5-0
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_doclib` WHERE `id` = '5' 
  SELECT t1.* FROM `zt_doclib` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project=t2.id  WHERE t1.project  != '0' AND  t1.deleted  = '0' ORDER BY t2.`order` desc,t1.`id` 
  SELECT * FROM `zt_doclib` WHERE `id` = '5' 
  SELECT id,name FROM `zt_project` WHERE id  = '3'
  SELECT * FROM `zt_module` WHERE root  = '5' AND  type  = 'doc' ORDER BY `grade` desc,`order` 
  SELECT id, name FROM `zt_group`
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 

20161212 10:57:12: file-ajaxUeditorUpload-584e12082e49c
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 10:57:20: doc-create-5-0
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_doclib` WHERE `id` = '5' 
  SELECT t1.* FROM `zt_doclib` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project=t2.id  WHERE t1.project  != '0' AND  t1.deleted  = '0' ORDER BY t2.`order` desc,t1.`id` 
  SELECT * FROM `zt_doclib` WHERE `id` = '5' 
  SELECT id,name FROM `zt_project` WHERE id  = '3'
  SELECT * FROM `zt_module` WHERE root  = '5' AND  type  = 'doc' ORDER BY `grade` desc,`order` 
  SELECT id, name FROM `zt_group`
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 

20161212 10:57:21: file-ajaxUeditorUpload-584e1210b9146
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 10:57:53: doc-create-5-0
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_doclib` WHERE `id` = '5' 
  SELECT t1.* FROM `zt_doclib` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project=t2.id  WHERE t1.project  != '0' AND  t1.deleted  = '0' ORDER BY t2.`order` desc,t1.`id` 
  SELECT * FROM `zt_doclib` WHERE `id` = '5' 
  SELECT id,name FROM `zt_project` WHERE id  = '3'
  SELECT * FROM `zt_module` WHERE root  = '5' AND  type  = 'doc' ORDER BY `grade` desc,`order` 
  SELECT id, name FROM `zt_group`
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 

20161212 10:57:55: file-ajaxUeditorUpload-584e12313dff9
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 10:58:36: doc-create-5-0
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_doclib` WHERE `id` = '5' 
  SELECT t1.* FROM `zt_doclib` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project=t2.id  WHERE t1.project  != '0' AND  t1.deleted  = '0' ORDER BY t2.`order` desc,t1.`id` 
  SELECT * FROM `zt_doclib` WHERE `id` = '5' 
  SELECT id,name FROM `zt_project` WHERE id  = '3'
  SELECT * FROM `zt_module` WHERE root  = '5' AND  type  = 'doc' ORDER BY `grade` desc,`order` 
  SELECT id, name FROM `zt_group`
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 

20161212 10:58:38: file-ajaxUeditorUpload-584e125c1b5c4
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 10:58:55: doc-create-5-0
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_doclib` WHERE `id` = '5' 
  SELECT t1.* FROM `zt_doclib` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project=t2.id  WHERE t1.project  != '0' AND  t1.deleted  = '0' ORDER BY t2.`order` desc,t1.`id` 
  SELECT * FROM `zt_doclib` WHERE `id` = '5' 
  SELECT id,name FROM `zt_project` WHERE id  = '3'
  SELECT * FROM `zt_module` WHERE root  = '5' AND  type  = 'doc' ORDER BY `grade` desc,`order` 
  SELECT id, name FROM `zt_group`
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 

20161212 10:58:59: file-ajaxUeditorUpload-584e126f1e9c2
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 11:01:13: doc-create-5-0
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_doclib` WHERE `id` = '5' 
  SELECT t1.* FROM `zt_doclib` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project=t2.id  WHERE t1.project  != '0' AND  t1.deleted  = '0' ORDER BY t2.`order` desc,t1.`id` 
  SELECT * FROM `zt_doclib` WHERE `id` = '5' 
  SELECT id,name FROM `zt_project` WHERE id  = '3'
  SELECT * FROM `zt_module` WHERE root  = '5' AND  type  = 'doc' ORDER BY `grade` desc,`order` 
  SELECT id, name FROM `zt_group`
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 

20161212 11:01:16: file-ajaxUeditorUpload-584e12f959403
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 11:01:22: doc-ajaxGetAllLibs
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT id,product,project,name FROM `zt_doclib` WHERE deleted  = '0' ORDER BY `product` desc,`project` desc,`id` asc 
  SELECT id,name FROM `zt_product` WHERE id IN ('3','2','1') AND  deleted  = '0' ORDER BY `order` desc 
  SELECT DISTINCT product FROM `zt_projectproduct` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project=t2.id  WHERE t1.product IN ('3','2','1') AND  t2.deleted  = '0'
  SELECT id,name FROM `zt_project` WHERE id IN ('4','3','2','1') AND  deleted  = '0' ORDER BY `order` desc 

20161212 11:01:26: doc
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT t1.* FROM `zt_doclib` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product=t2.id  WHERE t1.deleted  = '0' AND  t1.product  != '0' ORDER BY t2.`order` desc,`id` desc 
  SELECT id,name,`order` FROM `zt_product` WHERE id IN ('3','2','1') ORDER BY `order` desc,`id` desc 
  SELECT t1.* FROM `zt_doclib` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project=t2.id  WHERE t1.deleted  = '0' AND  t1.project  != '0' ORDER BY t2.`order` desc,`id` desc 
  SELECT id,name,`order` FROM `zt_project` WHERE id IN ('4','3','2','1') ORDER BY `order` desc,`id` desc 
  SELECT * FROM `zt_doclib` WHERE deleted  = '0' AND  project  = '0' AND  product  = '0' ORDER BY `id` desc 
  SELECT * FROM `zt_doclib` WHERE deleted  = '0' AND  product IN ('3','2','1') ORDER BY `id` 
  SELECT DISTINCT product FROM `zt_projectproduct` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project=t2.id  WHERE t1.product IN ('3','2','1') AND  t2.deleted  = '0'
  SELECT * FROM `zt_doclib` WHERE deleted  = '0' AND  project IN ('4','3','2','1') ORDER BY `id` 

20161212 11:01:29: doc-browse-5
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_doclib` WHERE `id` = '5' 
  SELECT t1.* FROM `zt_doclib` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project=t2.id  WHERE t1.project  != '0' AND  t1.deleted  = '0' ORDER BY t2.`order` desc,t1.`id` 
  SELECT * FROM `zt_doclib` WHERE `id` = '5' 
  SELECT id,name FROM `zt_project` WHERE id  = '3'
  SELECT * FROM `zt_doc` WHERE deleted  = '0' AND  lib IN ('5') ORDER BY `id` desc 
  SELECT COUNT(*) AS recTotal FROM `zt_doc` WHERE deleted  = '0' AND  lib IN ('5') 
  SELECT * FROM `zt_doc` WHERE deleted  = '0' AND  lib IN ('5') ORDER BY `id` desc 
  SELECT * FROM `zt_doc` WHERE deleted  = '0' AND  lib IN ('5') ORDER BY `id` desc 
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT openedVersion FROM `zt_project` WHERE id  = '5doc'
  SELECT * FROM `zt_module` WHERE root  = '5' AND  type  = '0' ORDER BY `grade` desc,`order` 
  SELECT * FROM `zt_product` WHERE `id` = '5' 
  SELECT * FROM `zt_module` WHERE root  = '5' AND  type  = 'doc' ORDER BY `grade` desc,`order` 
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 

20161212 11:01:39: doc-create-5-0
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_doclib` WHERE `id` = '5' 
  SELECT t1.* FROM `zt_doclib` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project=t2.id  WHERE t1.project  != '0' AND  t1.deleted  = '0' ORDER BY t2.`order` desc,t1.`id` 
  SELECT * FROM `zt_doclib` WHERE `id` = '5' 
  SELECT id,name FROM `zt_project` WHERE id  = '3'
  SELECT * FROM `zt_module` WHERE root  = '5' AND  type  = 'doc' ORDER BY `grade` desc,`order` 
  SELECT id, name FROM `zt_group`
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 

20161212 11:01:39: file-ajaxUeditorUpload-584e131314e67
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 11:01:49: doc-create-5-0
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT id,title FROM `zt_doc` WHERE deleted  = '0' AND  title IN ('adgr') AND  addedDate  >= '2016-12-12 11:00:49' AND  lib = '5' AND module = 0 
  SELECT * FROM `zt_doclib` WHERE `id` = '5' 
  INSERT INTO `zt_doc` SET `lib` = '5',`module` = '0',`title` = 'adgr',`keywords` = 'dsgtrs',`type` = 'url',`acl` = 'open',`users` = '',`addedBy` = 'admin',`addedDate` = '2016-12-12 11:01:49',`version` = '1',`product` = '0',`project` = '3'
  INSERT INTO `zt_doccontent` SET `title` = 'adgr',`content` = 'dsgsfhtrsnrts',`type` = 'html',`version` = '1',`doc` = '3',`files` = ''
  SELECT * FROM `zt_doclib` WHERE `id` = '5' 
  SELECT product, project FROM `zt_doc` WHERE id  = '3'
  INSERT INTO `zt_action` SET `objectType` = 'doc',`objectID` = '3',`actor` = 'admin',`action` = 'created',`date` = '2016-12-12 11:01:49',`comment` = '',`extra` = '',`product` = ',0,',`project` = '3'

20161212 11:01:50: doc-browse-5-byModule-0-id_desc-doc
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_doclib` WHERE `id` = '5' 
  SELECT t1.* FROM `zt_doclib` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project=t2.id  WHERE t1.project  != '0' AND  t1.deleted  = '0' ORDER BY t2.`order` desc,t1.`id` 
  SELECT * FROM `zt_doclib` WHERE `id` = '5' 
  SELECT id,name FROM `zt_project` WHERE id  = '3'
  SELECT * FROM `zt_doc` WHERE deleted  = '0' AND  lib IN ('5') ORDER BY `id` desc 
  SELECT COUNT(*) AS recTotal FROM `zt_doc` WHERE deleted  = '0' AND  lib IN ('5') 
  SELECT * FROM `zt_doc` WHERE deleted  = '0' AND  lib IN ('5') ORDER BY `id` desc 
  SELECT * FROM `zt_doc` WHERE deleted  = '0' AND  lib IN ('5') ORDER BY `id` desc 
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT openedVersion FROM `zt_project` WHERE id  = '5doc'
  SELECT * FROM `zt_module` WHERE root  = '5' AND  type  = '0' ORDER BY `grade` desc,`order` 
  SELECT * FROM `zt_product` WHERE `id` = '5' 
  SELECT * FROM `zt_module` WHERE root  = '5' AND  type  = 'doc' ORDER BY `grade` desc,`order` 
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 

20161212 11:05:59: doc-create-5-0
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_doclib` WHERE `id` = '5' 
  SELECT t1.* FROM `zt_doclib` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project=t2.id  WHERE t1.project  != '0' AND  t1.deleted  = '0' ORDER BY t2.`order` desc,t1.`id` 
  SELECT * FROM `zt_doclib` WHERE `id` = '5' 
  SELECT id,name FROM `zt_project` WHERE id  = '3'
  SELECT * FROM `zt_module` WHERE root  = '5' AND  type  = 'doc' ORDER BY `grade` desc,`order` 
  SELECT id, name FROM `zt_group`
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 

20161212 11:06:00: file-ajaxUeditorUpload-584e14175670d
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 11:16:00: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 11:26:00: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 11:30:26: doc-create-5-0
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_doclib` WHERE `id` = '5' 
  SELECT t1.* FROM `zt_doclib` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project=t2.id  WHERE t1.project  != '0' AND  t1.deleted  = '0' ORDER BY t2.`order` desc,t1.`id` 
  SELECT * FROM `zt_doclib` WHERE `id` = '5' 
  SELECT id,name FROM `zt_project` WHERE id  = '3'
  SELECT * FROM `zt_module` WHERE root  = '5' AND  type  = 'doc' ORDER BY `grade` desc,`order` 
  SELECT id, name FROM `zt_group`
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 

20161212 11:30:34: file-ajaxUeditorUpload-584e19d2cf284
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 11:32:39: 
  SELECT * FROM `zt_company` ORDER BY `id`  LIMIT 1 
  SELECT * FROM `zt_config` WHERE owner IN ('system','') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 11:32:39: user-login-Lw==
  SELECT * FROM `zt_config` WHERE owner IN ('system','') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT account, realname, deleted FROM `zt_user` WHERE deleted  = '0' ORDER BY `account` 

20161212 11:32:42: user-login-Lw==
  SELECT * FROM `zt_config` WHERE owner IN ('system','') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT locked FROM `zt_user` WHERE account  = 'admin'
  SELECT * FROM `zt_user` WHERE account  = 'admin' AND  deleted  = '0'
  UPDATE `zt_user` SET  visits = visits + 1, `ip` = '127.0.0.1', `last` = '1481513562' WHERE account  = 'admin'
  UPDATE `zt_user` SET  `fails` = '0', `locked` = '0000-00-00 00:00:00' WHERE account  = 'admin'
  SELECT t1.acl FROM `zt_group` AS t1  LEFT JOIN `zt_usergroup` AS t2  ON t1.id=t2.group  WHERE t2.account  = 'admin'
  SELECT module, method FROM `zt_usergroup` AS t1  LEFT JOIN `zt_grouppriv` AS t2  ON t1.group = t2.group  WHERE t1.account  = 'admin'
  SELECT `group` FROM `zt_usergroup` WHERE `account` = 'admin' 
  INSERT INTO `zt_action` SET `objectType` = 'user',`objectID` = '1',`actor` = 'admin',`action` = 'login',`date` = '2016-12-12 11:32:42',`comment` = '',`extra` = '',`product` = ',0,',`project` = '0'

20161212 11:32:42: 
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 11:32:43: my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE account  = 'admin' AND  module  = 'my' AND  hidden  = '0' ORDER BY `order` 

20161212 11:32:43: block-printBlock-2-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '2'
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT * FROM `zt_action` WHERE 1  AND  date  > '2016-12-12' AND  date  < '2016-12-13' AND  (1)  ORDER BY `date` desc 
  SELECT commiter, account, realname FROM `zt_user` WHERE commiter  != ''
  SELECT id, account AS name FROM `zt_user` WHERE id IN ('1')
  SELECT id, title AS name FROM `zt_doc` WHERE id IN ('3','2','1')
  SELECT id, name AS name FROM `zt_task` WHERE id IN ('195')
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 

20161212 11:32:43: block-printBlock-3-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '3'
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  status  != 'done' AND  deleted  = '0' ORDER BY `order` desc 
  SELECT * FROM `zt_project` WHERE id IN ('4','3','2') ORDER BY `order` desc 
  SELECT COUNT(*) AS recTotal FROM `zt_project` WHERE id IN ('4','3','2') 
  SELECT * FROM `zt_project` WHERE id IN ('4','3','2') ORDER BY `order` desc 
  SELECT id, project, estimate, consumed, `left`, status, closedReason FROM `zt_task` WHERE project IN ('4','3','2') AND  deleted  = '0'
  SELECT project, date AS name, `left` AS value FROM `zt_burn` WHERE project IN ('4','3','2') ORDER BY `date` desc 

20161212 11:32:43: block-printBlock-1-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '1'

20161212 11:32:43: block-printBlock-4-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '4'
  SELECT * FROM `zt_todo` WHERE account  = 'admin' AND  date  >= '1970-01-01' AND  date  <= '2109-01-01' AND  status IN ('wait','doing') ORDER BY `date`,`status`,`begin`  LIMIT 20 
  SELECT * FROM `zt_todo` WHERE account  = 'admin' AND  date  >= '1970-01-01' AND  date  <= '2109-01-01' AND  status IN ('wait','doing') ORDER BY `date`,`status`,`begin`  LIMIT 20 

20161212 11:32:44: block-printBlock-5-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '5'
  SELECT * FROM `zt_product` WHERE deleted  = '0' AND  status  != 'closed' ORDER BY `order` desc 
  SELECT * FROM `zt_product` WHERE id IN ('3','2','1') ORDER BY `order` desc 
  SELECT COUNT(*) AS recTotal FROM `zt_product` WHERE id IN ('3','2','1') 
  SELECT * FROM `zt_product` WHERE id IN ('3','2','1') ORDER BY `order` desc 
  SELECT product, status, count(status) AS count FROM `zt_story` WHERE deleted  = '0' AND  product IN ('3','2','1') GROUP BY product, status
  SELECT product, count(*) AS count FROM `zt_productplan` WHERE deleted  = '0' AND  product IN ('3','2','1') AND  end  > '2016-12-12 11:32:43' GROUP BY product
  SELECT product, count(*) AS count FROM `zt_release` WHERE deleted  = '0' AND  product IN ('3','2','1') GROUP BY product
  SELECT product,count(*) AS conut FROM `zt_bug` WHERE deleted  = '0' AND  product IN ('3','2','1') GROUP BY product
  SELECT product,count(*) AS count FROM `zt_bug` WHERE status  = 'active' AND  deleted  = '0' AND  product IN ('3','2','1') GROUP BY product
  SELECT product,count(*) AS count FROM `zt_bug` WHERE AssignedTo  = '' AND  deleted  = '0' AND  product IN ('3','2','1') GROUP BY product

20161212 11:32:44: block-printBlock-6-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '6'
  SELECT t1.*, t2.id as projectID, t2.name as projectName, t3.id as storyID, t3.title as storyTitle, t3.status AS storyStatus, t3.version AS latestStoryVersion FROM `zt_task` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project = t2.id  LEFT JOIN `zt_story` AS t3  ON t1.story = t3.id  WHERE t1.deleted  = '0' AND  t1.assignedTo  = 'admin' ORDER BY `id` desc  LIMIT 15 
  SELECT t1.*, t2.id as projectID, t2.name as projectName, t3.id as storyID, t3.title as storyTitle, t3.status AS storyStatus, t3.version AS latestStoryVersion FROM `zt_task` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project = t2.id  LEFT JOIN `zt_story` AS t3  ON t1.story = t3.id  WHERE t1.deleted  = '0' AND  t1.assignedTo  = 'admin' ORDER BY `id` desc  LIMIT 15 

20161212 11:32:44: block-printBlock-7-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '7'
  SELECT * FROM `zt_bug` WHERE deleted  = '0' AND  assignedTo  = 'admin' ORDER BY `id` desc  LIMIT 15 

20161212 11:32:44: block-printBlock-8-my
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

20161212 11:32:44: block-printBlock-9-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '9'
  SELECT t1.assignedTo AS assignedTo, t2.* FROM `zt_testrun` AS t1  LEFT JOIN `zt_case` AS t2  ON t1.case = t2.id  LEFT JOIN `zt_testtask` AS t3  ON t1.task = t3.id  WHERE t1.assignedTo  = 'admin' AND  t1.status  != 'done' AND  t3.status  != 'done' AND  t3.deleted  = '0' AND  t2.deleted  = '0' ORDER BY `id` desc  LIMIT 15 

20161212 11:32:58: admin
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 11:33:00: dev-api
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 11:33:02: editor-index-editor
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 11:33:37: editor-extend-doc
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 11:40:34: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 11:43:02: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 11:43:37: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 11:50:34: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 11:53:03: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 11:53:37: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_config` WHERE 1 = 1  AND  owner IN ('system') AND  module IN ('common') AND  section IN ('global') AND  `key` IN ('sn')

20161212 12:00:34: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_config` WHERE 1 = 1  AND  owner IN ('system') AND  module IN ('common') AND  section IN ('global') AND  `key` IN ('sn')

20161212 12:03:03: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 12:03:37: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_config` WHERE 1 = 1  AND  owner IN ('system') AND  module IN ('common') AND  section IN ('global') AND  `key` IN ('sn')

20161212 12:10:34: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_config` WHERE 1 = 1  AND  owner IN ('system') AND  module IN ('common') AND  section IN ('global') AND  `key` IN ('sn')

20161212 12:13:03: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_config` WHERE 1 = 1  AND  owner IN ('system') AND  module IN ('common') AND  section IN ('global') AND  `key` IN ('sn')

20161212 12:13:38: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 12:20:35: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_config` WHERE 1 = 1  AND  owner IN ('system') AND  module IN ('common') AND  section IN ('global') AND  `key` IN ('sn')

20161212 12:23:03: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 12:23:38: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_config` WHERE 1 = 1  AND  owner IN ('system') AND  module IN ('common') AND  section IN ('global') AND  `key` IN ('sn')

20161212 12:30:35: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 12:33:03: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_config` WHERE 1 = 1  AND  owner IN ('system') AND  module IN ('common') AND  section IN ('global') AND  `key` IN ('sn')

20161212 12:33:38: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 12:40:35: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 12:43:03: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_config` WHERE 1 = 1  AND  owner IN ('system') AND  module IN ('common') AND  section IN ('global') AND  `key` IN ('sn')

20161212 12:43:38: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 12:50:35: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_config` WHERE 1 = 1  AND  owner IN ('system') AND  module IN ('common') AND  section IN ('global') AND  `key` IN ('sn')

20161212 12:53:03: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_config` WHERE 1 = 1  AND  owner IN ('system') AND  module IN ('common') AND  section IN ('global') AND  `key` IN ('sn')

20161212 12:53:38: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_config` WHERE 1 = 1  AND  owner IN ('system') AND  module IN ('common') AND  section IN ('global') AND  `key` IN ('sn')

20161212 13:00:35: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 13:03:04: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 13:03:38: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_config` WHERE 1 = 1  AND  owner IN ('system') AND  module IN ('common') AND  section IN ('global') AND  `key` IN ('sn')

20161212 13:10:35: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_config` WHERE 1 = 1  AND  owner IN ('system') AND  module IN ('common') AND  section IN ('global') AND  `key` IN ('sn')

20161212 13:13:04: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_config` WHERE 1 = 1  AND  owner IN ('system') AND  module IN ('common') AND  section IN ('global') AND  `key` IN ('sn')

20161212 13:13:38: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 13:20:36: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 13:23:04: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_config` WHERE 1 = 1  AND  owner IN ('system') AND  module IN ('common') AND  section IN ('global') AND  `key` IN ('sn')

20161212 13:23:38: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_config` WHERE 1 = 1  AND  owner IN ('system') AND  module IN ('common') AND  section IN ('global') AND  `key` IN ('sn')

20161212 13:25:46: editor-edit-RjpcemVudGFvXGNoYW5kYW9cbW9kdWxlXGRvY1xtb2RlbC5waHA=-newMethod-
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 13:25:54: api-debug-RjpcemVudGFvXGNoYW5kYW9cbW9kdWxlXGRvY1xtb2RlbC5waHBcc2V0TWVudQ==-extendModel
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 13:26:48: editor-edit-RjpcemVudGFvXGNoYW5kYW9cbW9kdWxlXGRvY1xjb25maWcucGhw-extendOther-
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 13:27:32: editor-edit-RjpcemVudGFvXGNoYW5kYW9cbW9kdWxlXGRvY1x2aWV3XHZpZXcuaHRtbC5waHA=-newHook-
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 13:27:58: editor-extend-sso
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 13:28:09: editor-extend-dev
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 13:28:12: editor-extend-cron
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 13:28:17: editor-extend-doc
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 13:28:28: dev-db
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 13:30:36: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 13:38:29: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_config` WHERE 1 = 1  AND  owner IN ('system') AND  module IN ('common') AND  section IN ('global') AND  `key` IN ('sn')

20161212 13:40:36: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 13:48:29: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_config` WHERE 1 = 1  AND  owner IN ('system') AND  module IN ('common') AND  section IN ('global') AND  `key` IN ('sn')

20161212 13:50:36: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 13:58:29: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 14:00:36: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 14:07:17: dev-db
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 14:07:20: doc
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT t1.* FROM `zt_doclib` AS t1  LEFT JOIN `zt_product` AS t2  ON t1.product=t2.id  WHERE t1.deleted  = '0' AND  t1.product  != '0' ORDER BY t2.`order` desc,`id` desc 
  SELECT id,name,`order` FROM `zt_product` WHERE id IN ('3','2','1') ORDER BY `order` desc,`id` desc 
  SELECT t1.* FROM `zt_doclib` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project=t2.id  WHERE t1.deleted  = '0' AND  t1.project  != '0' ORDER BY t2.`order` desc,`id` desc 
  SELECT id,name,`order` FROM `zt_project` WHERE id IN ('4','3','2','1') ORDER BY `order` desc,`id` desc 
  SELECT * FROM `zt_doclib` WHERE deleted  = '0' AND  project  = '0' AND  product  = '0' ORDER BY `id` desc 
  SELECT * FROM `zt_doclib` WHERE deleted  = '0' AND  product IN ('3','2','1') ORDER BY `id` 
  SELECT DISTINCT product FROM `zt_projectproduct` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project=t2.id  WHERE t1.product IN ('3','2','1') AND  t2.deleted  = '0'
  SELECT * FROM `zt_doclib` WHERE deleted  = '0' AND  project IN ('4','3','2','1') ORDER BY `id` 

20161212 14:07:24: doc-browse-5
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_doclib` WHERE `id` = '5' 
  SELECT t1.* FROM `zt_doclib` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project=t2.id  WHERE t1.project  != '0' AND  t1.deleted  = '0' ORDER BY t2.`order` desc,t1.`id` 
  SELECT * FROM `zt_doclib` WHERE `id` = '5' 
  SELECT id,name FROM `zt_project` WHERE id  = '3'
  SELECT * FROM `zt_doc` WHERE deleted  = '0' AND  lib IN ('5') ORDER BY `id` desc 
  SELECT COUNT(*) AS recTotal FROM `zt_doc` WHERE deleted  = '0' AND  lib IN ('5') 
  SELECT * FROM `zt_doc` WHERE deleted  = '0' AND  lib IN ('5') ORDER BY `id` desc 
  SELECT * FROM `zt_doc` WHERE deleted  = '0' AND  lib IN ('5') ORDER BY `id` desc 
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT openedVersion FROM `zt_project` WHERE id  = '5doc'
  SELECT * FROM `zt_module` WHERE root  = '5' AND  type  = '0' ORDER BY `grade` desc,`order` 
  SELECT * FROM `zt_product` WHERE `id` = '5' 
  SELECT * FROM `zt_module` WHERE root  = '5' AND  type  = 'doc' ORDER BY `grade` desc,`order` 
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 

20161212 14:07:28: doc-create-5-0
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_doclib` WHERE `id` = '5' 
  SELECT t1.* FROM `zt_doclib` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project=t2.id  WHERE t1.project  != '0' AND  t1.deleted  = '0' ORDER BY t2.`order` desc,t1.`id` 
  SELECT * FROM `zt_doclib` WHERE `id` = '5' 
  SELECT id,name FROM `zt_project` WHERE id  = '3'
  SELECT * FROM `zt_module` WHERE root  = '5' AND  type  = 'doc' ORDER BY `grade` desc,`order` 
  SELECT id, name FROM `zt_group`
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 

20161212 14:07:28: file-ajaxUeditorUpload-584e3ea0389e1
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 14:07:50: doc-create-5-0
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_doclib` WHERE `id` = '5' 
  SELECT t1.* FROM `zt_doclib` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project=t2.id  WHERE t1.project  != '0' AND  t1.deleted  = '0' ORDER BY t2.`order` desc,t1.`id` 
  SELECT * FROM `zt_doclib` WHERE `id` = '5' 
  SELECT id,name FROM `zt_project` WHERE id  = '3'
  SELECT * FROM `zt_module` WHERE root  = '5' AND  type  = 'doc' ORDER BY `grade` desc,`order` 
  SELECT id, name FROM `zt_group`
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 

20161212 14:07:53: file-ajaxUeditorUpload-584e3eb648294
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 14:10:38: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 14:10:41: doc-create-5-0
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_doclib` WHERE `id` = '5' 
  SELECT t1.* FROM `zt_doclib` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project=t2.id  WHERE t1.project  != '0' AND  t1.deleted  = '0' ORDER BY t2.`order` desc,t1.`id` 
  SELECT * FROM `zt_doclib` WHERE `id` = '5' 
  SELECT id,name FROM `zt_project` WHERE id  = '3'
  SELECT * FROM `zt_module` WHERE root  = '5' AND  type  = 'doc' ORDER BY `grade` desc,`order` 
  SELECT id, name FROM `zt_group`
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 

20161212 14:10:46: file-ajaxUeditorUpload-584e3f615ae84
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 14:17:32: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 14:20:45: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 14:27:32: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_config` WHERE 1 = 1  AND  owner IN ('system') AND  module IN ('common') AND  section IN ('global') AND  `key` IN ('sn')

20161212 14:30:28: doc-create-5-0
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT id,title FROM `zt_doc` WHERE deleted  = '0' AND  title IN ('发') AND  addedDate  >= '2016-12-12 14:29:28' AND  lib = '5' AND module = 0 
  SELECT * FROM `zt_doclib` WHERE `id` = '5' 
  INSERT INTO `zt_doc` SET `lib` = '5',`module` = '0',`title` = '发',`keywords` = '地方沙发',`type` = 'url',`acl` = 'open',`users` = '',`addedBy` = 'admin',`addedDate` = '2016-12-12 14:30:27',`version` = '1',`product` = '0',`project` = '3'
  INSERT INTO `zt_file` SET `extension` = '7z',`pathname` = '201612/1214302806967oo2.7z',`title` = '多少复古风格',`size` = '104016019',`objectType` = 'doc',`objectID` = '4',`addedBy` = 'admin',`addedDate` = '2016-12-12',`extra` = ''
  INSERT INTO `zt_doccontent` SET `title` = '发',`content` = 'sdfeadfsd',`type` = 'html',`version` = '1',`doc` = '4',`files` = '12'
  SELECT * FROM `zt_doclib` WHERE `id` = '5' 
  SELECT product, project FROM `zt_doc` WHERE id  = '4'
  INSERT INTO `zt_action` SET `objectType` = 'doc',`objectID` = '4',`actor` = 'admin',`action` = 'created',`date` = '2016-12-12 14:30:28',`comment` = '',`extra` = '',`product` = ',0,',`project` = '3'

20161212 14:30:36: doc-browse-5-byModule-0-id_desc-doc
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_doclib` WHERE `id` = '5' 
  SELECT t1.* FROM `zt_doclib` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project=t2.id  WHERE t1.project  != '0' AND  t1.deleted  = '0' ORDER BY t2.`order` desc,t1.`id` 
  SELECT * FROM `zt_doclib` WHERE `id` = '5' 
  SELECT id,name FROM `zt_project` WHERE id  = '3'
  SELECT * FROM `zt_doc` WHERE deleted  = '0' AND  lib IN ('5') ORDER BY `id` desc 
  SELECT COUNT(*) AS recTotal FROM `zt_doc` WHERE deleted  = '0' AND  lib IN ('5') 
  SELECT * FROM `zt_doc` WHERE deleted  = '0' AND  lib IN ('5') ORDER BY `id` desc 
  SELECT * FROM `zt_doc` WHERE deleted  = '0' AND  lib IN ('5') ORDER BY `id` desc 
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT openedVersion FROM `zt_project` WHERE id  = '5doc'
  SELECT * FROM `zt_module` WHERE root  = '5' AND  type  = '0' ORDER BY `grade` desc,`order` 
  SELECT * FROM `zt_product` WHERE `id` = '5' 
  SELECT * FROM `zt_module` WHERE root  = '5' AND  type  = 'doc' ORDER BY `grade` desc,`order` 
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 

20161212 14:31:50: doc-view-4
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_doc` WHERE id  = '4'
  SELECT * FROM `zt_doccontent` WHERE doc  = '4' AND  version  = '1'
  SELECT * FROM `zt_file` WHERE objectType  = 'doc' AND  objectID  = '4' AND  extra  != 'editor'
  SELECT name FROM `zt_project` WHERE `id` = '3' 
  SELECT * FROM `zt_doclib` WHERE `id` = '5' 
  SELECT t1.* FROM `zt_doclib` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project=t2.id  WHERE t1.project  != '0' AND  t1.deleted  = '0' ORDER BY t2.`order` desc,t1.`id` 
  SELECT * FROM `zt_doclib` WHERE `id` = '5' 
  SELECT id,name FROM `zt_project` WHERE id  = '3'
  SELECT commiter, account, realname FROM `zt_user` WHERE commiter  != ''
  SELECT * FROM `zt_action` WHERE objectType  = 'doc' AND  objectID  = '4' ORDER BY `date` desc 
  SELECT * FROM `zt_history` WHERE action IN ('764') ORDER BY `id` 
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 
  SELECT * FROM `zt_doc` WHERE id  = '4' OR deleted  = '0' AND  lib IN ('5')  ORDER BY `id` desc 

20161212 14:31:52: file-ajaxUeditorUpload-584e445622e4e
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 14:31:56: file-edit-12
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_file` WHERE `id` = '12' 

20161212 14:37:18: product
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 

20161212 14:37:19: product-browse
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 
  SELECT * FROM `zt_product` WHERE `id` = '3' 
  SELECT * FROM `zt_story` WHERE product IN ('3') AND  status IN ('','draft','active','changed') AND  deleted  = '0' ORDER BY `id` desc 
  SELECT COUNT(*) AS recTotal FROM `zt_story` WHERE product IN ('3') AND  status IN ('','draft','active','changed') AND  deleted  = '0' 
  SELECT * FROM `zt_story` WHERE product IN ('3') AND  status IN ('','draft','active','changed') AND  deleted  = '0' ORDER BY `id` desc 
  SELECT * FROM `zt_story` WHERE product IN ('3') AND  status IN ('','draft','active','changed') AND  deleted  = '0' ORDER BY `id` desc 
  SELECT id,title FROM `zt_productplan` WHERE product IN ('3') AND  deleted  = '0'
  SELECT * FROM `zt_storystage` WHERE branch IN ('0')
  SELECT * FROM `zt_story` WHERE product IN ('3') AND  status IN ('','draft','active','changed') AND  deleted  = '0' ORDER BY `id` desc 
  SELECT id,CONCAT(title, " [", begin, " ~ ", end, "]") as title FROM `zt_productplan` WHERE product IN ('3') AND  deleted  = '0' ORDER BY `begin` desc 
  SELECT * FROM `zt_product` WHERE `id` = '3' 
  SELECT * FROM `zt_module` WHERE root  = '3' AND  type  = 'story' ORDER BY `grade` desc,`order` 
  SELECT * FROM `zt_product` WHERE `id` = '3' 
  SELECT id,CONCAT(title, " [", begin, " ~ ", end, "]") as title FROM `zt_productplan` WHERE product IN ('3') AND  deleted  = '0' ORDER BY `begin` desc 
  SELECT DISTINCT story FROM `zt_case` WHERE story IN ('')
  SELECT * FROM `zt_product` WHERE `id` = '3' 
  SELECT * FROM `zt_module` WHERE root  = '3' AND  type  = 'story' ORDER BY `grade` desc,`order` 
  SELECT account, realname, deleted, INSTR(',pd,po,', role) AS roleOrder FROM `zt_user` WHERE deleted  = '0' ORDER BY `roleOrder` DESC,`account` 
  SELECT * FROM `zt_product` WHERE `id` = '3' 
  SELECT * FROM `zt_module` WHERE root  = '3' AND  type  = 'story' ORDER BY `grade` desc,`order` 
  SELECT * FROM `zt_branch` WHERE product  = '3' AND  deleted  = '0' ORDER BY `id` asc 
  SELECT * FROM `zt_product` WHERE `id` = '3' 
  SELECT * FROM `zt_storystage` WHERE story IN ('')

20161212 14:37:26: product-dynamic-3
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 
  SELECT * FROM `zt_product` WHERE `id` = '3' 
  SELECT account, realname, deleted FROM `zt_user` WHERE deleted  = '0' ORDER BY `account` 
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT * FROM `zt_action` WHERE 1  AND  date  > '2016-12-12' AND  date  < '2016-12-13' AND  product  LIKE '%,3,%' AND  (1)  ORDER BY `date` desc,`id` desc 
  SELECT COUNT(*) AS recTotal FROM `zt_action` WHERE 1  AND  date  > '2016-12-12' AND  date  < '2016-12-13' AND  product  LIKE '%,3,%' AND  (1)  
  SELECT * FROM `zt_action` WHERE 1  AND  date  > '2016-12-12' AND  date  < '2016-12-13' AND  product  LIKE '%,3,%' AND  (1)  ORDER BY `date` desc,`id` desc 

20161212 14:37:28: my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE account  = 'admin' AND  module  = 'my' AND  hidden  = '0' ORDER BY `order` 

20161212 14:37:29: block-printBlock-1-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '1'

20161212 14:37:29: block-printBlock-3-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '3'
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  status  != 'done' AND  deleted  = '0' ORDER BY `order` desc 
  SELECT * FROM `zt_project` WHERE id IN ('4','3','2') ORDER BY `order` desc 
  SELECT COUNT(*) AS recTotal FROM `zt_project` WHERE id IN ('4','3','2') 
  SELECT * FROM `zt_project` WHERE id IN ('4','3','2') ORDER BY `order` desc 
  SELECT id, project, estimate, consumed, `left`, status, closedReason FROM `zt_task` WHERE project IN ('4','3','2') AND  deleted  = '0'
  SELECT project, date AS name, `left` AS value FROM `zt_burn` WHERE project IN ('4','3','2') ORDER BY `date` desc 

20161212 14:37:29: block-printBlock-2-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '2'
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 
  SELECT *, IF(INSTR(" done", status) < 2, 0, 1) AS isDone FROM `zt_project` WHERE iscat  = '0' AND  deleted  = '0' ORDER BY `isDone`,`status`,`order` desc 
  SELECT * FROM `zt_action` WHERE 1  AND  date  > '2016-12-12' AND  date  < '2016-12-13' AND  (1)  ORDER BY `date` desc 
  SELECT commiter, account, realname FROM `zt_user` WHERE commiter  != ''
  SELECT id, title AS name FROM `zt_doc` WHERE id IN ('4','3','2','1')
  SELECT id, account AS name FROM `zt_user` WHERE id IN ('1')
  SELECT id, name AS name FROM `zt_task` WHERE id IN ('195')
  SELECT account, realname, deleted FROM `zt_user` ORDER BY `account` 

20161212 14:37:29: block-printBlock-6-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '6'
  SELECT t1.*, t2.id as projectID, t2.name as projectName, t3.id as storyID, t3.title as storyTitle, t3.status AS storyStatus, t3.version AS latestStoryVersion FROM `zt_task` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project = t2.id  LEFT JOIN `zt_story` AS t3  ON t1.story = t3.id  WHERE t1.deleted  = '0' AND  t1.assignedTo  = 'admin' ORDER BY `id` desc  LIMIT 15 
  SELECT t1.*, t2.id as projectID, t2.name as projectName, t3.id as storyID, t3.title as storyTitle, t3.status AS storyStatus, t3.version AS latestStoryVersion FROM `zt_task` AS t1  LEFT JOIN `zt_project` AS t2  ON t1.project = t2.id  LEFT JOIN `zt_story` AS t3  ON t1.story = t3.id  WHERE t1.deleted  = '0' AND  t1.assignedTo  = 'admin' ORDER BY `id` desc  LIMIT 15 

20161212 14:37:30: block-printBlock-5-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '5'
  SELECT * FROM `zt_product` WHERE deleted  = '0' AND  status  != 'closed' ORDER BY `order` desc 
  SELECT * FROM `zt_product` WHERE id IN ('3','2','1') ORDER BY `order` desc 
  SELECT COUNT(*) AS recTotal FROM `zt_product` WHERE id IN ('3','2','1') 
  SELECT * FROM `zt_product` WHERE id IN ('3','2','1') ORDER BY `order` desc 
  SELECT product, status, count(status) AS count FROM `zt_story` WHERE deleted  = '0' AND  product IN ('3','2','1') GROUP BY product, status
  SELECT product, count(*) AS count FROM `zt_productplan` WHERE deleted  = '0' AND  product IN ('3','2','1') AND  end  > '2016-12-12 14:37:30' GROUP BY product
  SELECT product, count(*) AS count FROM `zt_release` WHERE deleted  = '0' AND  product IN ('3','2','1') GROUP BY product
  SELECT product,count(*) AS conut FROM `zt_bug` WHERE deleted  = '0' AND  product IN ('3','2','1') GROUP BY product
  SELECT product,count(*) AS count FROM `zt_bug` WHERE status  = 'active' AND  deleted  = '0' AND  product IN ('3','2','1') GROUP BY product
  SELECT product,count(*) AS count FROM `zt_bug` WHERE AssignedTo  = '' AND  deleted  = '0' AND  product IN ('3','2','1') GROUP BY product

20161212 14:37:30: block-printBlock-4-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '4'
  SELECT * FROM `zt_todo` WHERE account  = 'admin' AND  date  >= '1970-01-01' AND  date  <= '2109-01-01' AND  status IN ('wait','doing') ORDER BY `date`,`status`,`begin`  LIMIT 20 
  SELECT * FROM `zt_todo` WHERE account  = 'admin' AND  date  >= '1970-01-01' AND  date  <= '2109-01-01' AND  status IN ('wait','doing') ORDER BY `date`,`status`,`begin`  LIMIT 20 

20161212 14:37:30: block-printBlock-7-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '7'
  SELECT * FROM `zt_bug` WHERE deleted  = '0' AND  assignedTo  = 'admin' ORDER BY `id` desc  LIMIT 15 

20161212 14:37:30: block-printBlock-8-my
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

20161212 14:37:30: block-printBlock-9-my
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_block` WHERE id  = '9'
  SELECT t1.assignedTo AS assignedTo, t2.* FROM `zt_testrun` AS t1  LEFT JOIN `zt_case` AS t2  ON t1.case = t2.id  LEFT JOIN `zt_testtask` AS t3  ON t1.task = t3.id  WHERE t1.assignedTo  = 'admin' AND  t1.status  != 'done' AND  t3.status  != 'done' AND  t3.deleted  = '0' AND  t2.deleted  = '0' ORDER BY `id` desc  LIMIT 15 

20161212 14:37:30: product
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 

20161212 14:37:30: product-browse
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' ORDER BY `isClosed`,`order` desc 
  SELECT * FROM `zt_product` WHERE `id` = '3' 
  SELECT * FROM `zt_story` WHERE product IN ('3') AND  status IN ('','draft','active','changed') AND  deleted  = '0' ORDER BY `id` desc 
  SELECT COUNT(*) AS recTotal FROM `zt_story` WHERE product IN ('3') AND  status IN ('','draft','active','changed') AND  deleted  = '0' 
  SELECT * FROM `zt_story` WHERE product IN ('3') AND  status IN ('','draft','active','changed') AND  deleted  = '0' ORDER BY `id` desc 
  SELECT * FROM `zt_story` WHERE product IN ('3') AND  status IN ('','draft','active','changed') AND  deleted  = '0' ORDER BY `id` desc 
  SELECT id,title FROM `zt_productplan` WHERE product IN ('3') AND  deleted  = '0'
  SELECT * FROM `zt_storystage` WHERE branch IN ('0')
  SELECT * FROM `zt_story` WHERE product IN ('3') AND  status IN ('','draft','active','changed') AND  deleted  = '0' ORDER BY `id` desc 
  SELECT id,CONCAT(title, " [", begin, " ~ ", end, "]") as title FROM `zt_productplan` WHERE product IN ('3') AND  deleted  = '0' ORDER BY `begin` desc 
  SELECT * FROM `zt_product` WHERE `id` = '3' 
  SELECT * FROM `zt_module` WHERE root  = '3' AND  type  = 'story' ORDER BY `grade` desc,`order` 
  SELECT * FROM `zt_product` WHERE `id` = '3' 
  SELECT id,CONCAT(title, " [", begin, " ~ ", end, "]") as title FROM `zt_productplan` WHERE product IN ('3') AND  deleted  = '0' ORDER BY `begin` desc 
  SELECT DISTINCT story FROM `zt_case` WHERE story IN ('')
  SELECT * FROM `zt_product` WHERE `id` = '3' 
  SELECT * FROM `zt_module` WHERE root  = '3' AND  type  = 'story' ORDER BY `grade` desc,`order` 
  SELECT account, realname, deleted, INSTR(',pd,po,', role) AS roleOrder FROM `zt_user` WHERE deleted  = '0' ORDER BY `roleOrder` DESC,`account` 
  SELECT * FROM `zt_product` WHERE `id` = '3' 
  SELECT * FROM `zt_module` WHERE root  = '3' AND  type  = 'story' ORDER BY `grade` desc,`order` 
  SELECT * FROM `zt_branch` WHERE product  = '3' AND  deleted  = '0' ORDER BY `id` asc 
  SELECT * FROM `zt_product` WHERE `id` = '3' 
  SELECT * FROM `zt_storystage` WHERE story IN ('')

20161212 14:37:33: story-create-3-0-0
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT *,  IF(INSTR(" closed", status) < 2, 0, 1) AS isClosed FROM `zt_product` WHERE deleted  = '0' AND  status  != 'closed' ORDER BY `isClosed`,`order` desc 
  SELECT * FROM `zt_product` WHERE `id` = '3' 
  SELECT account, realname, deleted, INSTR(',po,pd,', role) AS roleOrder FROM `zt_user` WHERE deleted  = '0' ORDER BY `roleOrder` DESC,`account` 
  SELECT * FROM `zt_product` WHERE `id` = '3' 
  SELECT * FROM `zt_module` WHERE root  = '3' AND  type  = 'story' ORDER BY `grade` desc,`order` 
  SELECT * FROM `zt_product` WHERE `id` = '3' 
  SELECT id,CONCAT(title, " [", begin, " ~ ", end, "]") as title FROM `zt_productplan` WHERE product IN ('3') AND  deleted  = '0' AND  end  > '2016-12-12' ORDER BY `begin` desc 
  SELECT id, listName FROM `zt_usercontact` WHERE account  = 'admin'

20161212 14:41:51: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 14:41:57: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 14:47:35: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_config` WHERE 1 = 1  AND  owner IN ('system') AND  module IN ('common') AND  section IN ('global') AND  `key` IN ('sn')

20161212 14:51:52: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20161212 14:51:57: misc-ping
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_config` WHERE 1 = 1  AND  owner IN ('system') AND  module IN ('common') AND  section IN ('global') AND  `key` IN ('sn')

