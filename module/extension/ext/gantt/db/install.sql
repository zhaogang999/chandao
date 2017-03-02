 -- DROP TABLE IF EXISTS `zt_relationoftasks`;
CREATE TABLE IF NOT EXISTS `zt_relationoftasks` (
  `id` MEDIUMINT( 8 ) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `project` MEDIUMINT( 8 ) UNSIGNED NOT NULL ,
  `pretask` MEDIUMINT( 8 ) UNSIGNED NOT NULL ,
  `condition` ENUM( 'begin', 'end' ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
  `task` MEDIUMINT( 8 ) UNSIGNED NOT NULL ,
  `action` ENUM( 'begin', 'end' ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
  PRIMARY KEY (`id`),
  KEY `relationoftasks` (`project`,`task`)
) ENGINE = MYISAM CHARACTER SET utf8 COLLATE utf8_general_ci;
INSERT INTO `zt_grouppriv` (`group`, `module`, `method`) VALUES
(1, 'project', 'deleterelation'),
(1, 'project', 'gantt'),
(2, 'project', 'gantt'),
(3, 'project', 'gantt'),
(4, 'project', 'gantt'),
(5, 'project', 'gantt'),
(6, 'project', 'gantt'),
(7, 'project', 'gantt'),
(8, 'project', 'gantt'),
(9, 'project', 'gantt'),
(10, 'project', 'gantt'),
(1, 'project', 'relation'),
(2, 'project', 'relation'),
(3, 'project', 'relation'),
(4, 'project', 'relation'),
(5, 'project', 'relation'),
(6, 'project', 'relation'),
(7, 'project', 'relation'),
(8, 'project', 'relation'),
(9, 'project', 'relation'),
(10, 'project', 'relation');
