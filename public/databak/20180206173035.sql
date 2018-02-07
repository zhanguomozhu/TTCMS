/*
MySQL Database Backup Tools
Server:127.0.0.1:3306
Database:tl_cms
Data:2018-02-06 17:30:35
*/
SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for tp_ad
-- ----------------------------
DROP TABLE IF EXISTS `tp_ad`;
CREATE TABLE `tp_ad` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '广告位名称',
  `type` enum('单图','多图') NOT NULL DEFAULT '单图' COMMENT '广告类型',
  `category_id` int(10) unsigned NOT NULL COMMENT '栏目id',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `sort` int(11) NOT NULL DEFAULT '50',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
-- ----------------------------
-- Records of tp_ad
-- ----------------------------
INSERT INTO `tp_ad` (`id`,`name`,`type`,`category_id`,`status`,`sort`,`create_time`,`update_time`) VALUES ('1','首页轮播图','多图','0','1','50','0','0');
INSERT INTO `tp_ad` (`id`,`name`,`type`,`category_id`,`status`,`sort`,`create_time`,`update_time`) VALUES ('3','左上300*600','单图','0','1','2','0','0');

-- ----------------------------
-- Table structure for tp_admin
-- ----------------------------
DROP TABLE IF EXISTS `tp_admin`;
CREATE TABLE `tp_admin` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL COMMENT '管理员名称',
  `password` char(32) NOT NULL COMMENT '管理员密码',
  `avatar` varchar(250) DEFAULT NULL COMMENT '头像',
  `phone` varchar(11) NOT NULL DEFAULT '' COMMENT '手机',
  `logintime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上一次登录时间',
  `loginip` char(20) NOT NULL DEFAULT '' COMMENT '上一次登录ip',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否锁定',
  `admin` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否是超级管理员【0：普通管理员，1：超级管理员】',
  `num` int(11) NOT NULL DEFAULT '0' COMMENT '登陆次数',
  `session_id` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL COMMENT '邮件激活token',
  `token_exptime` int(11) NOT NULL COMMENT 'token有效时间',
  `create_time` int(10) unsigned NOT NULL COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`),
  KEY `phone` (`phone`),
  KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
-- ----------------------------
-- Records of tp_admin
-- ----------------------------
INSERT INTO `tp_admin` (`id`,`username`,`password`,`avatar`,`phone`,`logintime`,`loginip`,`status`,`admin`,`num`,`session_id`,`token`,`token_exptime`,`create_time`,`update_time`) VALUES ('1','admin','e10adc3949ba59abbe56e057f20f883e','uploads/images/20180121\3c3aa8ae04e8e7b0c26606e4d2dc2a8a.jpg','15617578175','1517907907','127.0.0.1','0','1','79','qgvjshlkko7jo7frcv5s5939c6','','0','0','0');
INSERT INTO `tp_admin` (`id`,`username`,`password`,`avatar`,`phone`,`logintime`,`loginip`,`status`,`admin`,`num`,`session_id`,`token`,`token_exptime`,`create_time`,`update_time`) VALUES ('4','admin1','e00cf25ad42683b3df678c61f42c6bda','uploads/images/20180123\f3b592e2860da9593ea748aa62cf4097.jpg','15617577173','1516694275','127.0.0.1','0','0','4','b728b0gand0qjge164ldhanl96','','0','0','0');
INSERT INTO `tp_admin` (`id`,`username`,`password`,`avatar`,`phone`,`logintime`,`loginip`,`status`,`admin`,`num`,`session_id`,`token`,`token_exptime`,`create_time`,`update_time`) VALUES ('5','admin2','c84258e9c39059a89ab77d846ddab909','uploads/images/20180206\4e56157aaf8c0fa47cac15c3b73627f6.jpg','15617578122','0','','0','0','0','','','0','0','0');

-- ----------------------------
-- Table structure for tp_article
-- ----------------------------
DROP TABLE IF EXISTS `tp_article`;
CREATE TABLE `tp_article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(10) unsigned NOT NULL COMMENT '栏目ID',
  `title` varchar(200) NOT NULL COMMENT '标题',
  `keywords` varchar(100) DEFAULT NULL COMMENT '标签',
  `description` varchar(255) DEFAULT NULL COMMENT '摘要',
  `image_url` varchar(200) DEFAULT NULL COMMENT '图片',
  `content` text COMMENT '内容',
  `author` varchar(20) DEFAULT NULL COMMENT '文章作者',
  `source` varchar(30) DEFAULT NULL COMMENT '文章来源',
  `clicks` int(10) unsigned DEFAULT '0' COMMENT '点击量',
  `is_recommend` tinyint(1) DEFAULT '0' COMMENT '是否推荐',
  `is_top` tinyint(4) DEFAULT '0' COMMENT '是否置顶',
  `url` varchar(250) DEFAULT NULL COMMENT '文章链接',
  `sort` int(10) unsigned NOT NULL DEFAULT '50',
  `status` int(10) unsigned NOT NULL DEFAULT '1',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  KEY `hits` (`clicks`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
-- ----------------------------
-- Records of tp_article
-- ----------------------------
INSERT INTO `tp_article` (`id`,`category_id`,`title`,`keywords`,`description`,`image_url`,`content`,`author`,`source`,`clicks`,`is_recommend`,`is_top`,`url`,`sort`,`status`,`create_time`,`update_time`) VALUES ('9','4','dasdasdasd','dasdas','dsada','uploads/images/20180206\8a41f1339b635962c08f147327eee1c2.jpg','<p>dasdas</p>','admin','','0','1','0','dasd','50','1','1517906285','0');

-- ----------------------------
-- Table structure for tp_auth_group
-- ----------------------------
DROP TABLE IF EXISTS `tp_auth_group`;
CREATE TABLE `tp_auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` varchar(255) NOT NULL DEFAULT '',
  `create_time` int(10) unsigned NOT NULL,
  `update_time` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
-- ----------------------------
-- Records of tp_auth_group
-- ----------------------------
INSERT INTO `tp_auth_group` (`id`,`title`,`status`,`rules`,`create_time`,`update_time`) VALUES ('1','超级管理员','1','1,24,25,26,27,28,29,50,51,52,53,54,5,22,21,20,19,18,23,55,56,57,58,59,45,46,47,48,49,60,61,62,63,64,40,41,42,43,44,35,36,37,38,39,30,31,32,33,34,4,17,16,15,14,3,13,12,11,10,2,9,8,7,6','1509167505','1509167505');
INSERT INTO `tp_auth_group` (`id`,`title`,`status`,`rules`,`create_time`,`update_time`) VALUES ('2','普通管理员','1','24,25,4,17,16,15,14,2,9,8,7,6','1509167505','1509167505');
INSERT INTO `tp_auth_group` (`id`,`title`,`status`,`rules`,`create_time`,`update_time`) VALUES ('4','编辑','1','','0','0');

-- ----------------------------
-- Table structure for tp_auth_group_access
-- ----------------------------
DROP TABLE IF EXISTS `tp_auth_group_access`;
CREATE TABLE `tp_auth_group_access` (
  `admin_id` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  UNIQUE KEY `admin_group_id` (`admin_id`,`group_id`),
  KEY `admin_id` (`admin_id`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- ----------------------------
-- Records of tp_auth_group_access
-- ----------------------------
INSERT INTO `tp_auth_group_access` (`admin_id`,`group_id`,`create_time`,`update_time`) VALUES ('1','1','1509167505','1509167505');
INSERT INTO `tp_auth_group_access` (`admin_id`,`group_id`,`create_time`,`update_time`) VALUES ('4','2','0','0');
INSERT INTO `tp_auth_group_access` (`admin_id`,`group_id`,`create_time`,`update_time`) VALUES ('5','1','0','0');

-- ----------------------------
-- Table structure for tp_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `tp_auth_rule`;
CREATE TABLE `tp_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(80) NOT NULL DEFAULT '',
  `title` char(20) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `condition` char(100) NOT NULL DEFAULT '',
  `pid` int(11) NOT NULL DEFAULT '0',
  `level` tinyint(1) NOT NULL DEFAULT '0',
  `icon` varchar(255) NOT NULL DEFAULT 'fa-list-ol' COMMENT '菜单显示图标',
  `sort` int(5) NOT NULL DEFAULT '50',
  `create_time` int(10) unsigned NOT NULL,
  `update_time` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8;
-- ----------------------------
-- Records of tp_auth_rule
-- ----------------------------
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('1','#','后台管理','1','0','','0','0','fa-list-ol','0','0','0');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('2','admin/lst','用户管理','1','1','','1','1','fa-user','1','0','0');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('3','authGroup/lst','角色管理','1','1','','1','1','fa-smile-o','2','0','0');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('4','authRule/lst','权限管理','1','1','','1','1','fa-sitemap','3','0','0');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('5','conf/lst','系统设置','1','1','','1','1','fa-cog','10','0','0');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('6','admin/admin/lst','用户列表','1','1','','2','2','fa-tasks','1','0','0');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('7','admin/admin/add','添加用户','1','0','','2','2','fa-tasks','2','0','0');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('8','admin/admin/edit','编辑用户','1','0','','2','2','fa-tasks','3','0','0');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('9','admi/admin/del','删除用户','1','0','','2','2','fa-tasks','4','0','0');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('10','authGroup/lst','角色列表','1','1','','3','2','fa-tasks','1','0','0');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('11','authGroup/add','添加角色','1','0','','3','2','fa-tasks','2','0','0');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('12','authGroup/edit','编辑角色','1','0','','3','2','fa-tasks','3','0','0');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('13','authGroup/del	','删除角色','1','0','','3','2','fa-tasks','4','0','0');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('14','authRule/lst','权限列表','1','1','','4','2','fa-tasks','1','0','0');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('15','authRule/add','添加权限','1','0','','4','2','fa-tasks','2','0','0');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('16','authRule/edit','编辑权限','1','0','','4','2','fa-tasks','3','0','0');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('17','authRule/del	','删除权限','1','0','','4','2','fa-tasks','4','0','0');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('18','conf/lst','配置列表','1','1','','5','2','fa-tasks','1','0','0');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('19','conf/conf','设置配置','1','1','','5','2','fa-tasks','2','0','0');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('20','conf/add','添加配置','1','0','','5','2','fa-tasks','3','0','0');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('21','conf/edit','编辑配置','1','0','','5','2','fa-tasks','4','0','0');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('22','conf/del','删除配置','1','0','','5','2','fa-tasks','5','0','0');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('23','confCate/lst','配置分类','1','1','','5','2','fa-tasks','0','0','0');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('24','sqlbak/index','数据库管理','1','1','','1','1','fa-cloud-download','13','0','0');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('25','admin/sqlbak/index','列表','1','1','','24','2','fa-tasks','50','0','0');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('26','admin/sqlbak/backup','备份','1','0','','24','2','fa-tasks','50','0','0');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('27','admin/sqlbak/dowonload','下载','1','0','','24','2','fa-tasks','50','0','0');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('28','admin/sqlbak/restore','还原','1','0','','24','2','fa-tasks','50','0','0');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('29','admin/sqlbak/del','删除','1','0','','24','2','fa-tasks','50','0','0');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('30','category/lst','栏目管理','1','1','','1','1',' fa-sort-amount-asc','4','0','0');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('31','admin/category/lst','栏目列表','1','1','','30','2','fa-tasks','50','0','0');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('32','admin/category/add','添加栏目','1','0','','30','2','fa-tasks','50','0','0');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('33','admin/category/edit','编辑栏目','1','0','','30','2','fa-tasks','50','0','0');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('34','admin/category/del','删除栏目','1','0','','30','2','fa-tasks','50','0','0');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('35','article/lst','文章管理','1','1','','1','1',' fa-pencil','5','0','0');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('36','admin/article/add','添加文章','1','0','','35','2','fa-tasks','2','0','0');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('37','admin/article/edit','编辑文章','1','0','','35','2','fa-tasks','3','0','0');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('38','admin/article/lst','文章列表','1','1','','35','2','fa-tasks','1','0','0');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('39','admin/article/del','删除文章','1','0','','35','2','fa-tasks','4','0','0');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('40','flink/lst','友链管理','1','1','','1','1','fa-link','6','0','0');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('41','admin/flink/lst','友链列表','1','1','','40','2','fa-tasks','50','0','0');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('42','admin/flink/add','添加友链','1','0','','40','2','fa-tasks','50','0','0');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('43','admin/flink/edit','编辑友链','1','0','','40','2','fa-tasks','50','0','0');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('44','admin/flink/del','删除友链','1','0','','40','2','fa-tasks','50','0','0');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('45','banner/lst','广告管理','1','1','','1','1','fa-th-large','8','0','0');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('46','admin/banner/lst','广告列表','1','1','','45','2','fa-tasks','50','0','0');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('47','admin/banner/add','添加广告','1','0','','45','2','fa-tasks','50','0','0');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('48','admin/banner/edit','编辑广告','1','0','','45','2','fa-tasks','50','0','0');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('49','admin/banner/del','删除广告','1','0','','45','2','fa-tasks','50','0','0');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('50','model/lst','模型管理','1','1','','1','1','fa-arrows','11','0','0');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('51','admin/model/lst','模型列表','1','1','','50','2','fa-tasks','50','0','0');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('52','admin/model/add','添加模型','1','0','','50','2','fa-tasks','50','0','0');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('53','admin/model/edit','编辑模型','1','0','','50','2','fa-tasks','50','0','0');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('54','admin/model/del','删除模型','1','0','','50','2','fa-tasks','50','0','0');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('55','featured/lst','推荐位管理','1','1','','1','1',' fa-bullseye','9','0','0');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('56','admin/featured/lst','推荐位列表','1','1','','55','2','fa-tasks','50','0','0');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('57','admin/featured/add','添加推荐位','1','0','','55','2','fa-tasks','50','0','0');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('58','admin/featured/edit','编辑推荐位','1','0','','55','2','fa-tasks','50','0','0');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('59','admin/featured/del','删除推荐位','1','0','','55','2','fa-tasks','50','0','0');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('60','ad/lst','广告位管理','1','1','','1','1',' fa-crosshairs','7','0','0');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('61','admin/ad/lst','广告位列表','1','1','','60','2','fa-tasks','50','0','0');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('62','admin/ad/add','添加广告位','1','0','','60','2','fa-tasks','50','0','0');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('63','admin/ad/edit','编辑广告位','1','0','','60','2','fa-tasks','50','0','0');
INSERT INTO `tp_auth_rule` (`id`,`name`,`title`,`type`,`status`,`condition`,`pid`,`level`,`icon`,`sort`,`create_time`,`update_time`) VALUES ('64','admin/ad/del','删除广告位','1','0','','60','2','fa-tasks','50','0','0');

-- ----------------------------
-- Table structure for tp_banner
-- ----------------------------
DROP TABLE IF EXISTS `tp_banner`;
CREATE TABLE `tp_banner` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ad_id` int(11) NOT NULL DEFAULT '0' COMMENT '推荐位',
  `img_url` varchar(255) NOT NULL DEFAULT '' COMMENT '图片地址',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT 'banner标题',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '简介',
  `jump_url` varchar(255) NOT NULL DEFAULT '' COMMENT '跳转链接',
  `sort` int(5) NOT NULL DEFAULT '50' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '显示',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
-- ----------------------------
-- Records of tp_banner
-- ----------------------------
INSERT INTO `tp_banner` (`id`,`ad_id`,`img_url`,`title`,`description`,`jump_url`,`sort`,`status`,`create_time`,`update_time`) VALUES ('2','1','uploads/images/20180125\29dbfb162b435e7b24c9b1d80ba307cc.jpg','美女啊','美女啊美女啊美女啊美女啊','http://www.baidu.com','0','1','0','0');
INSERT INTO `tp_banner` (`id`,`ad_id`,`img_url`,`title`,`description`,`jump_url`,`sort`,`status`,`create_time`,`update_time`) VALUES ('13','3','uploads/images/20180206\32b33444249a6d47d72b774b220bd813.jpg','dsadasd','dsadsd','dsadsd','50','1','0','0');

-- ----------------------------
-- Table structure for tp_category
-- ----------------------------
DROP TABLE IF EXISTS `tp_category`;
CREATE TABLE `tp_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(10) unsigned NOT NULL COMMENT '上级id',
  `model_id` tinyint(3) unsigned NOT NULL COMMENT '模型id',
  `name` varchar(30) NOT NULL COMMENT '栏目名称',
  `image_url` varchar(255) DEFAULT NULL COMMENT '栏目图片',
  `description` varchar(255) DEFAULT NULL COMMENT '栏目描述',
  `is_menu` tinyint(1) unsigned DEFAULT NULL COMMENT '是否导航显示',
  `sort` tinyint(3) unsigned NOT NULL DEFAULT '20' COMMENT '排序',
  `meta_keywords` varchar(200) DEFAULT NULL COMMENT '页面关键词',
  `meta_description` varchar(255) DEFAULT NULL COMMENT '页面描述',
  `index_template` varchar(50) NOT NULL DEFAULT 'index' COMMENT '主页模版',
  `list_template` varchar(50) NOT NULL DEFAULT 'list' COMMENT '列表模版',
  `show_template` varchar(50) NOT NULL DEFAULT 'show' COMMENT '详情页模版',
  `url` varchar(200) NOT NULL COMMENT '栏目链接',
  `is_cover` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否有封面页',
  PRIMARY KEY (`id`),
  KEY `parent_id` (`pid`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
-- ----------------------------
-- Records of tp_category
-- ----------------------------
INSERT INTO `tp_category` (`id`,`pid`,`model_id`,`name`,`image_url`,`description`,`is_menu`,`sort`,`meta_keywords`,`meta_description`,`index_template`,`list_template`,`show_template`,`url`,`is_cover`) VALUES ('2','3','7','php','uploads/images/20180124\7692a54e8f9b7a502df3bdbc4d6bb4ab.png','phpphpphpphpphpphpphp','1','1','php','phpphpphpphpphpphpphp','index','list','show','','1');
INSERT INTO `tp_category` (`id`,`pid`,`model_id`,`name`,`image_url`,`description`,`is_menu`,`sort`,`meta_keywords`,`meta_description`,`index_template`,`list_template`,`show_template`,`url`,`is_cover`) VALUES ('3','0','8','案例展示','uploads/images/20180125\a452218147c32619825bb45a3b9c26b7.png','案例展示案例展示案例展示案例展示案例展示案例展示','1','2','案例展示','案例展示案例展示案例展示案例展示案例展示案例展示','index','list','show','','1');
INSERT INTO `tp_category` (`id`,`pid`,`model_id`,`name`,`image_url`,`description`,`is_menu`,`sort`,`meta_keywords`,`meta_description`,`index_template`,`list_template`,`show_template`,`url`,`is_cover`) VALUES ('4','2','7','PHP语法','uploads/images/20180125\66daa2f8fa83e9c74b51aa1b711a5876.png','PHP语法PHP语法PHP语法PHP语法','1','1','PHP语法','PHP语法PHP语法PHP语法PHP语法','index','list','show','','1');

-- ----------------------------
-- Table structure for tp_conf
-- ----------------------------
DROP TABLE IF EXISTS `tp_conf`;
CREATE TABLE `tp_conf` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `conf_cate_id` int(10) unsigned NOT NULL COMMENT '配置分类id',
  `cnname` varchar(50) NOT NULL COMMENT '中文名称',
  `enname` varchar(50) NOT NULL COMMENT '英文名称',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '配置类型[1:单行文本框2:文本域3:单选按钮4:复选框5:下拉菜单]',
  `value` varchar(255) NOT NULL COMMENT '配置值',
  `values` varchar(255) DEFAULT NULL COMMENT '配置可选值[1.单行文本2.多行文本3.单选按钮4.复选框5.下拉菜单]',
  `sort` int(11) NOT NULL DEFAULT '50' COMMENT '排序',
  `create_time` int(10) unsigned NOT NULL,
  `update_time` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;
-- ----------------------------
-- Records of tp_conf
-- ----------------------------
INSERT INTO `tp_conf` (`id`,`conf_cate_id`,`cnname`,`enname`,`type`,`value`,`values`,`sort`,`create_time`,`update_time`) VALUES ('10','2','站点名称','sitename','1','TTCMS','','1','1510122582','1510123095');
INSERT INTO `tp_conf` (`id`,`conf_cate_id`,`cnname`,`enname`,`type`,`value`,`values`,`sort`,`create_time`,`update_time`) VALUES ('11','2','站点描述','description','2','TTCMS','','2','1510122724','1510123095');
INSERT INTO `tp_conf` (`id`,`conf_cate_id`,`cnname`,`enname`,`type`,`value`,`values`,`sort`,`create_time`,`update_time`) VALUES ('13','1','是否启用验证码','code','3','是','是,否','5','1510124164','1510124503');
INSERT INTO `tp_conf` (`id`,`conf_cate_id`,`cnname`,`enname`,`type`,`value`,`values`,`sort`,`create_time`,`update_time`) VALUES ('14','1','自动清空缓存','cache','5','3小时','1小时,2小时,3小时','3','1510124354','1510124354');
INSERT INTO `tp_conf` (`id`,`conf_cate_id`,`cnname`,`enname`,`type`,`value`,`values`,`sort`,`create_time`,`update_time`) VALUES ('16','1','status','status','3','开启','开启,关闭','10','1510124425','1510124448');
INSERT INTO `tp_conf` (`id`,`conf_cate_id`,`cnname`,`enname`,`type`,`value`,`values`,`sort`,`create_time`,`update_time`) VALUES ('17','3','喜欢的运动','like','4','篮球,足球,橄榄球','篮球,足球,橄榄球,羽毛球','50','0','0');
INSERT INTO `tp_conf` (`id`,`conf_cate_id`,`cnname`,`enname`,`type`,`value`,`values`,`sort`,`create_time`,`update_time`) VALUES ('18','1','网站logo','logo','6','uploads/images/201801159235e7ff36f1dc1f5f2edfc4b56cd86.jpg','','50','0','0');
INSERT INTO `tp_conf` (`id`,`conf_cate_id`,`cnname`,`enname`,`type`,`value`,`values`,`sort`,`create_time`,`update_time`) VALUES ('19','3','站长名称','sitemaster_name','1','杜亚琼','','50','0','0');
INSERT INTO `tp_conf` (`id`,`conf_cate_id`,`cnname`,`enname`,`type`,`value`,`values`,`sort`,`create_time`,`update_time`) VALUES ('53','6','系统名称','system_name','1','TTCMS','','50','0','0');
INSERT INTO `tp_conf` (`id`,`conf_cate_id`,`cnname`,`enname`,`type`,`value`,`values`,`sort`,`create_time`,`update_time`) VALUES ('54','6','开发作者','author','1','杜亚琼','','50','0','0');
INSERT INTO `tp_conf` (`id`,`conf_cate_id`,`cnname`,`enname`,`type`,`value`,`values`,`sort`,`create_time`,`update_time`) VALUES ('55','6','官网','website','1','http://blog.renwulieren.cn','','50','0','0');
INSERT INTO `tp_conf` (`id`,`conf_cate_id`,`cnname`,`enname`,`type`,`value`,`values`,`sort`,`create_time`,`update_time`) VALUES ('56','6','项目地址','project_address','1','https://github.com/zhanguomozhu/TTCMS.git','','50','0','0');
INSERT INTO `tp_conf` (`id`,`conf_cate_id`,`cnname`,`enname`,`type`,`value`,`values`,`sort`,`create_time`,`update_time`) VALUES ('57','6','QQ交流群','qq_group','2','976352324
<a target="_blank" href="//shang.qq.com/wpa/qunwpa?idkey=9e3d8ac1ba7022b4cc6a492c7645e0198a06afbde7e6d55cab5ca5dbbac5c186">
                 <img border="0" src="//pub.idqqimg.com/wpa/images/group.png" alt="TTCMS交流群" title="TTCMS交流群">
</a>','','50','0','0');

-- ----------------------------
-- Table structure for tp_conf_cate
-- ----------------------------
DROP TABLE IF EXISTS `tp_conf_cate`;
CREATE TABLE `tp_conf_cate` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `enname` varchar(255) NOT NULL DEFAULT '' COMMENT '英文名称',
  `cnname` varchar(255) NOT NULL DEFAULT '' COMMENT '中文名称',
  `sort` int(3) unsigned NOT NULL DEFAULT '50' COMMENT '排序',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
-- ----------------------------
-- Records of tp_conf_cate
-- ----------------------------
INSERT INTO `tp_conf_cate` (`id`,`enname`,`cnname`,`sort`,`status`) VALUES ('1','site','网站配置','1','1');
INSERT INTO `tp_conf_cate` (`id`,`enname`,`cnname`,`sort`,`status`) VALUES ('2','seo','SEO配置','2','1');
INSERT INTO `tp_conf_cate` (`id`,`enname`,`cnname`,`sort`,`status`) VALUES ('3','station_master','站长配置','4','1');
INSERT INTO `tp_conf_cate` (`id`,`enname`,`cnname`,`sort`,`status`) VALUES ('6','developer','开发者配置','50','1');

-- ----------------------------
-- Table structure for tp_download
-- ----------------------------
DROP TABLE IF EXISTS `tp_download`;
CREATE TABLE `tp_download` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(10) unsigned NOT NULL,
  `title` varchar(50) NOT NULL COMMENT '标题',
  `image_url` varchar(250) DEFAULT NULL COMMENT '封面图片',
  `file_url` varchar(250) DEFAULT NULL COMMENT '下载文件',
  `filename` varchar(100) DEFAULT NULL COMMENT '文件名',
  `is_recommend` tinyint(1) DEFAULT '0' COMMENT '是否推荐',
  `description` varchar(255) DEFAULT NULL COMMENT '文件描述',
  `create_time` datetime DEFAULT NULL COMMENT '上传时间',
  `hits` int(11) DEFAULT NULL COMMENT '点击量',
  `download_num` int(11) DEFAULT NULL COMMENT '下载次数',
  `url` varchar(200) DEFAULT NULL COMMENT '链接',
  `demo_url` varchar(200) DEFAULT NULL COMMENT '演示链接',
  `is_top` tinyint(4) DEFAULT '0' COMMENT '是否置顶',
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- ----------------------------
-- Records of tp_download
-- ----------------------------

-- ----------------------------
-- Table structure for tp_featured
-- ----------------------------
DROP TABLE IF EXISTS `tp_featured`;
CREATE TABLE `tp_featured` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '推荐位名称',
  `category_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属栏目',
  `sort` int(5) unsigned NOT NULL DEFAULT '50' COMMENT '排序',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
-- ----------------------------
-- Records of tp_featured
-- ----------------------------
INSERT INTO `tp_featured` (`id`,`name`,`category_id`,`sort`,`create_time`,`update_time`) VALUES ('3','最新文章','4','2','0','0');
INSERT INTO `tp_featured` (`id`,`name`,`category_id`,`sort`,`create_time`,`update_time`) VALUES ('2','热点文章','1','4','0','0');

-- ----------------------------
-- Table structure for tp_feedback
-- ----------------------------
DROP TABLE IF EXISTS `tp_feedback`;
CREATE TABLE `tp_feedback` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `member_id` int(10) unsigned NOT NULL COMMENT '会员ID',
  `title` varchar(50) DEFAULT NULL COMMENT '留言标题',
  `content` text COMMENT '留言内容',
  `create_time` datetime DEFAULT NULL COMMENT '留言时间',
  `reply` text COMMENT '回复内容',
  `reply_time` datetime DEFAULT NULL COMMENT '回复时间',
  `admin_name` varchar(20) DEFAULT NULL COMMENT '管理员名称',
  `admin_avatar` varchar(250) DEFAULT NULL COMMENT '管理员头像',
  PRIMARY KEY (`id`),
  KEY `member_id` (`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- ----------------------------
-- Records of tp_feedback
-- ----------------------------

-- ----------------------------
-- Table structure for tp_flink
-- ----------------------------
DROP TABLE IF EXISTS `tp_flink`;
CREATE TABLE `tp_flink` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `sort` int(11) NOT NULL DEFAULT '50',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
-- ----------------------------
-- Records of tp_flink
-- ----------------------------
INSERT INTO `tp_flink` (`id`,`name`,`url`,`sort`,`status`,`create_time`,`update_time`) VALUES ('1','百度','http://www.baidu.com','50','1','0','0');

-- ----------------------------
-- Table structure for tp_link
-- ----------------------------
DROP TABLE IF EXISTS `tp_link`;
CREATE TABLE `tp_link` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(10) unsigned NOT NULL COMMENT '栏目ID',
  `title` varchar(50) NOT NULL COMMENT '标题',
  `image_url` varchar(200) DEFAULT NULL COMMENT '图片',
  `url` varchar(200) DEFAULT NULL COMMENT '链接地址',
  `description` varchar(255) DEFAULT NULL COMMENT '连接描述',
  `is_recommend` tinyint(1) DEFAULT '0' COMMENT '是否推荐',
  `is_top` tinyint(4) DEFAULT '0' COMMENT '是否置顶',
  `sort` int(11) DEFAULT '50',
  `status` tinyint(4) DEFAULT '1',
  `create_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- ----------------------------
-- Records of tp_link
-- ----------------------------

-- ----------------------------
-- Table structure for tp_member
-- ----------------------------
DROP TABLE IF EXISTS `tp_member`;
CREATE TABLE `tp_member` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `openid` char(32) DEFAULT NULL COMMENT '第三方登陆openid',
  `nickname` varchar(50) DEFAULT NULL COMMENT '昵称',
  `avatar` varchar(250) DEFAULT NULL COMMENT '头像',
  `create_time` datetime DEFAULT NULL COMMENT '注册时间',
  `sex` char(2) DEFAULT '未知' COMMENT '性别',
  `update_time` datetime DEFAULT NULL COMMENT '修改时间',
  `last_login_time` datetime DEFAULT NULL COMMENT '最后登陆时间',
  PRIMARY KEY (`id`),
  KEY `openid` (`openid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- ----------------------------
-- Records of tp_member
-- ----------------------------

-- ----------------------------
-- Table structure for tp_model
-- ----------------------------
DROP TABLE IF EXISTS `tp_model`;
CREATE TABLE `tp_model` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL COMMENT '模型名称',
  `tablename` char(20) NOT NULL COMMENT '表名',
  `index_template` char(30) NOT NULL DEFAULT 'index' COMMENT '封面页模板',
  `list_template` char(30) NOT NULL DEFAULT 'list' COMMENT '列表模板',
  `show_template` char(30) NOT NULL DEFAULT 'show' COMMENT '详情页模板',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='模型表';
-- ----------------------------
-- Records of tp_model
-- ----------------------------
INSERT INTO `tp_model` (`id`,`name`,`tablename`,`index_template`,`list_template`,`show_template`) VALUES ('6','单页模型','page','index','list','show');
INSERT INTO `tp_model` (`id`,`name`,`tablename`,`index_template`,`list_template`,`show_template`) VALUES ('7','文章模型','article','index','list','show');
INSERT INTO `tp_model` (`id`,`name`,`tablename`,`index_template`,`list_template`,`show_template`) VALUES ('8','图集模型','picture','index','list','show');
INSERT INTO `tp_model` (`id`,`name`,`tablename`,`index_template`,`list_template`,`show_template`) VALUES ('9','链接模型','link','index','list','show');
INSERT INTO `tp_model` (`id`,`name`,`tablename`,`index_template`,`list_template`,`show_template`) VALUES ('10','下载模型','download','index','list','show');

-- ----------------------------
-- Table structure for tp_page
-- ----------------------------
DROP TABLE IF EXISTS `tp_page`;
CREATE TABLE `tp_page` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(10) unsigned NOT NULL COMMENT '分类ID',
  `title` varchar(200) NOT NULL COMMENT '标题',
  `description` varchar(255) DEFAULT NULL COMMENT '摘要',
  `content` text COMMENT '内容',
  `image_url` varchar(200) DEFAULT NULL COMMENT '图片',
  `create_time` datetime DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- ----------------------------
-- Records of tp_page
-- ----------------------------

-- ----------------------------
-- Table structure for tp_picture
-- ----------------------------
DROP TABLE IF EXISTS `tp_picture`;
CREATE TABLE `tp_picture` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(10) unsigned NOT NULL COMMENT '栏目ID',
  `title` varchar(50) DEFAULT NULL COMMENT '图片名称',
  `image_url` varchar(200) DEFAULT '' COMMENT '封面图片',
  `images` text COMMENT '图集地址json',
  `content` text COMMENT '详情',
  `description` varchar(255) DEFAULT NULL COMMENT '图片描述',
  `is_recommend` tinyint(1) DEFAULT '0' COMMENT '是否推荐',
  `create_time` datetime DEFAULT NULL COMMENT '添加时间',
  `hits` int(11) DEFAULT NULL COMMENT '点击量',
  `url` varchar(200) DEFAULT NULL COMMENT '地址',
  `is_top` tinyint(4) DEFAULT '0' COMMENT '是否置顶',
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  KEY `is_recommend` (`is_recommend`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- ----------------------------
-- Records of tp_picture
-- ----------------------------

-- ----------------------------
-- Table structure for tp_setting
-- ----------------------------
DROP TABLE IF EXISTS `tp_setting`;
CREATE TABLE `tp_setting` (
  `key` varchar(200) NOT NULL DEFAULT '',
  `value` text NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='设置表';
-- ----------------------------
-- Records of tp_setting
-- ----------------------------
INSERT INTO `tp_setting` (`key`,`value`) VALUES ('site_name','TTCMS博客系统');
INSERT INTO `tp_setting` (`key`,`value`) VALUES ('title_add','个人博客系统');
INSERT INTO `tp_setting` (`key`,`value`) VALUES ('keywords','TTCMS博客系统');
INSERT INTO `tp_setting` (`key`,`value`) VALUES ('description','TTCMS博客系统');

