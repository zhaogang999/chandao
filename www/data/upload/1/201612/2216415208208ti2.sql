/*
Navicat MySQL Data Transfer

Source Server         : zentao
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : zentao

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2016-12-14 15:17:51
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for zt_review
-- ----------------------------
DROP TABLE IF EXISTS `zt_review`;
CREATE TABLE `zt_review` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '评审id',
  `fileNO` varchar(60) NOT NULL COMMENT '文件编号',
  `recorder` varchar(20) NOT NULL COMMENT '记录人员',
  `reviewName` varchar(30) NOT NULL COMMENT '评审类型',
  `task` int(10) unsigned NOT NULL,
  `doc` varchar(45) NOT NULL,
  `referenceDoc` varchar(45) NOT NULL COMMENT '参考文档',
  `reference` varchar(60) NOT NULL COMMENT '文件版本',
  `pages` tinyint(4) unsigned NOT NULL COMMENT '文件页数',
  `reviewers` varchar(200) NOT NULL COMMENT '参评人员',
  `reviewDate` date NOT NULL COMMENT '评审日期',
  `reviewScope` varchar(255) NOT NULL COMMENT '评审范围',
  `reviewPlace` varchar(60) NOT NULL COMMENT '评审地点',
  `effort` smallint(5) unsigned NOT NULL COMMENT '评审所用时间',
  `conclusion` varchar(15) NOT NULL COMMENT '评审结论',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;
