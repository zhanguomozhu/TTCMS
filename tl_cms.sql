/*
Navicat MySQL Data Transfer

Source Server         : 本地数据库
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : tl_cms

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-02-12 17:00:49
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
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_ad
-- ----------------------------
INSERT INTO `tp_ad` VALUES ('1', '首页轮播图', '多图', '0', '1', '3', '0', '0');
INSERT INTO `tp_ad` VALUES ('3', '左上300*600', '单图', '0', '1', '5', '0', '0');

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
  `email` varchar(255) NOT NULL COMMENT '邮箱',
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
INSERT INTO `tp_admin` VALUES ('1', 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'uploads/images/20180121\\3c3aa8ae04e8e7b0c26606e4d2dc2a8a.jpg', '18603854371', '976352323@qq.com', '1518425370', '127.0.0.1', '1', '1', '140', 'ip77tujlguo2r1nbrlf60e5ea7', '', '0', '0', '0');
INSERT INTO `tp_admin` VALUES ('4', 'admin1', 'e00cf25ad42683b3df678c61f42c6bda', 'uploads/images/20180123\\f3b592e2860da9593ea748aa62cf4097.jpg', '15617577173', '', '1518058918', '127.0.0.1', '1', '0', '6', 'jqmppsn6edf88tns47m0i5ekb4', '', '0', '0', '0');
INSERT INTO `tp_admin` VALUES ('5', 'admin2', 'c84258e9c39059a89ab77d846ddab909', 'uploads/images/20180206\\4e56157aaf8c0fa47cac15c3b73627f6.jpg', '15617578122', '', '0', '', '1', '0', '0', '', '', '0', '0', '0');

-- ----------------------------
-- Table structure for tp_article
-- ----------------------------
DROP TABLE IF EXISTS `tp_article`;
CREATE TABLE `tp_article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '文章ID',
  `category_id` int(10) unsigned NOT NULL COMMENT '栏目ID',
  `title` varchar(200) NOT NULL COMMENT '标题',
  `keywords` varchar(100) DEFAULT NULL COMMENT '关键词',
  `description` varchar(255) DEFAULT NULL COMMENT '摘要',
  `image_url` varchar(200) DEFAULT NULL COMMENT '图片',
  `author` varchar(20) DEFAULT NULL COMMENT '文章作者',
  `source` varchar(30) DEFAULT NULL COMMENT '文章来源',
  `clicks` int(10) unsigned DEFAULT '0' COMMENT '点击量',
  `flag` varchar(255) DEFAULT '' COMMENT '标签',
  `is_recommend` tinyint(1) DEFAULT '0' COMMENT '是否推荐',
  `is_top` tinyint(1) DEFAULT '0' COMMENT '是否置顶',
  `url` varchar(250) DEFAULT NULL COMMENT '文章链接',
  `sort` int(5) unsigned NOT NULL DEFAULT '50' COMMENT '排序',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  KEY `clicks` (`clicks`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_article
-- ----------------------------
INSERT INTO `tp_article` VALUES ('9', '4', 'dasdasdasd', 'dasdas', 'dasdas', 'uploads/images/20180206\\8a41f1339b635962c08f147327eee1c2.jpg', 'admin', '', '5', '', '1', '0', 'dasd', '1', '1', '1517906285', '1517966025');
INSERT INTO `tp_article` VALUES ('12', '2', 'dsadasd', 'dasd', 'dasd', '', 'admin', '', '50', '', '1', '0', 'dasd', '44', '1', '1517992144', '0');
INSERT INTO `tp_article` VALUES ('21', '3', 'dadasdasdasdasd', 'dasd', 'dasd', '', 'admin', '', '0', '', '0', '0', '', '50', '1', '1517993066', '0');
INSERT INTO `tp_article` VALUES ('22', '5', 'asdasdasdasdas', 'dasdas', 'dasd', 'uploads/images/20180207\\eeee923d3e1aba720943b0314ea43f37.jpg', 'admin', '', '50', '', '0', '1', 'dasd', '50', '1', '1517993790', '0');
INSERT INTO `tp_article` VALUES ('28', '3', 'dasdasd', 'dasd', 'dasd', 'uploads/images/20180207\\e02aae7db764ed4c89531da1efb7f2e7.jpg', 'admin', '', '50', '', '1', '0', 'dasd', '50', '1', '1517994918', '0');
INSERT INTO `tp_article` VALUES ('29', '5', 'dasdasd', 'dasdas', 'ddasdasd', 'uploads/images/20180207\\11a88710efa05c3a68c54e1b1def57ff.jpg', 'admin', '', '50', '', '0', '0', 'dsad', '50', '1', '1517994951', '0');
INSERT INTO `tp_article` VALUES ('36', '4', 'dsadasdasdasdasdasdasas', 'dasdas', 'das', 'uploads/images/20180211\\aa0a3ee928a07cdb5a177a4672a94dbe.jpg', 'admin', null, '50', '', '0', '0', 'dasdasd', '50', '1', '1518329777', '0');
INSERT INTO `tp_article` VALUES ('49', '4', 'dasdasdas', 'dasdas', 'ddasdsa', 'uploads/images/20180211\\77be9fd5b45e1b285183f0d1fe450071.jpg', 'admin', 'dasd', '50', '', '1', '0', 'dasd', '50', '1', '1518332628', '0');
INSERT INTO `tp_article` VALUES ('51', '5', 'dasdasd', 'dasd', 'dasd', 'uploads/images/20180211\\cfbfee957d6dd8fb536ce38838bae43d.jpg', 'admin', 'dasd', '50', '', '0', '1', 'dasd', '50', '1', '1518333241', '0');

-- ----------------------------
-- Table structure for tp_article_field
-- ----------------------------
DROP TABLE IF EXISTS `tp_article_field`;
CREATE TABLE `tp_article_field` (
  `article_id` int(10) unsigned NOT NULL COMMENT '文章id',
  `content` text NOT NULL COMMENT '文章内容',
  `value` text NOT NULL COMMENT '字段内容'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_article_field
-- ----------------------------
INSERT INTO `tp_article_field` VALUES ('49', '&lt;p&gt;dasdas&lt;/p&gt;', '{\"Focus\":\"dsad\"}');
INSERT INTO `tp_article_field` VALUES ('51', '&lt;p&gt;dasd&lt;/p&gt;', '{\"Focus\":\"dasd\"}');

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
INSERT INTO `tp_auth_group` VALUES ('1', '超级管理员', '1', '1,2,6,7,8,9,3,10,11,12,13,4,14,15,16,17,30,31,32,33,34,35,38,36,37,39,40,41,42,43,44,60,61,62,63,64,45,46,47,48,49,55,56,57,58,59,5,23,65,66,67,68,18,19,20,21,22,50,51,52,53,54,69,70,71,72,73,24,25,26,27,28,29', '1509167505', '1509167505');
INSERT INTO `tp_auth_group` VALUES ('2', '普通管理员', '1', '4,17,16,15,14,2,9,8,7,6', '1509167505', '1509167505');
INSERT INTO `tp_auth_group` VALUES ('4', '编辑', '1', '', '0', '0');

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
INSERT INTO `tp_auth_group_access` VALUES ('1', '1', '1509167505', '1509167505');
INSERT INTO `tp_auth_group_access` VALUES ('4', '2', '0', '0');
INSERT INTO `tp_auth_group_access` VALUES ('5', '1', '0', '0');
INSERT INTO `tp_auth_group_access` VALUES ('6', '2', '0', '0');
INSERT INTO `tp_auth_group_access` VALUES ('7', '2', '0', '0');
INSERT INTO `tp_auth_group_access` VALUES ('8', '2', '0', '0');
INSERT INTO `tp_auth_group_access` VALUES ('9', '2', '0', '0');
INSERT INTO `tp_auth_group_access` VALUES ('10', '2', '0', '0');

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
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_auth_rule
-- ----------------------------
INSERT INTO `tp_auth_rule` VALUES ('1', 'admin/Index/index', '后台首页', '1', '0', '', '0', '0', 'fa-list-ol', '0', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('2', 'admin/Admin/lst', '用户管理', '1', '1', '', '1', '1', 'fa-user', '1', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('3', 'admin/AuthGroup/lst', '角色管理', '1', '1', '', '1', '1', 'fa-smile-o', '2', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('4', 'admin/AuthRule/lst', '权限管理', '1', '1', '', '1', '1', 'fa-sitemap', '3', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('5', 'admin/Conf/lst', '系统设置', '1', '1', '', '1', '1', 'fa-cog', '10', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('6', 'admin/Admin/lst', '用户列表', '1', '1', '', '2', '2', 'fa-tasks', '1', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('7', 'admin/Admin/add', '添加用户', '1', '0', '', '2', '2', 'fa-tasks', '2', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('8', 'admin/Admin/edit', '编辑用户', '1', '0', '', '2', '2', 'fa-tasks', '3', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('9', 'admin/Admin/del', '删除用户', '1', '0', '', '2', '2', 'fa-tasks', '4', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('10', 'admin/AuthGroup/lst', '角色列表', '1', '1', '', '3', '2', 'fa-tasks', '1', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('11', 'admin/AuthGroup/add', '添加角色', '1', '0', '', '3', '2', 'fa-tasks', '2', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('12', 'admin/AuthGroup/edit', '编辑角色', '1', '0', '', '3', '2', 'fa-tasks', '3', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('13', 'admin/AuthGroup/del	', '删除角色', '1', '0', '', '3', '2', 'fa-tasks', '4', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('14', 'admin/AuthRule/lst', '权限列表', '1', '1', '', '4', '2', 'fa-tasks', '1', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('15', 'admin/AuthRule/add', '添加权限', '1', '0', '', '4', '2', 'fa-tasks', '2', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('16', 'admin/AuthRule/edit', '编辑权限', '1', '0', '', '4', '2', 'fa-tasks', '3', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('17', 'admin/AuthRule/del	', '删除权限', '1', '0', '', '4', '2', 'fa-tasks', '4', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('18', 'admin/Conf/lst', '配置列表', '1', '1', '', '5', '2', 'fa-tasks', '1', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('19', 'admin/Conf/conf', '设置配置', '1', '1', '', '5', '2', 'fa-tasks', '2', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('20', 'admin/Conf/add', '添加配置', '1', '0', '', '5', '2', 'fa-tasks', '3', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('21', 'admin/Conf/edit', '编辑配置', '1', '0', '', '5', '2', 'fa-tasks', '4', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('22', 'admin/Conf/del', '删除配置', '1', '0', '', '5', '2', 'fa-tasks', '5', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('23', 'admin/ConfCate/lst', '配置分类管理', '1', '1', '', '5', '2', 'fa-tasks', '0', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('24', 'admin/Sqlbak/index', '数据库管理', '1', '1', '', '1', '1', 'fa-cloud-download', '14', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('25', 'admin/Sqlbak/index', '备份列表', '1', '1', '', '24', '2', 'fa-tasks', '50', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('26', 'admin/Sqlbak/backup', '备份', '1', '0', '', '24', '2', 'fa-tasks', '50', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('27', 'admin/Sqlbak/dowonload', '下载', '1', '0', '', '24', '2', 'fa-tasks', '50', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('28', 'admin/Sqlbak/restore', '还原', '1', '0', '', '24', '2', 'fa-tasks', '50', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('29', 'admin/Sqlbak/del', '删除', '1', '0', '', '24', '2', 'fa-tasks', '50', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('30', 'admin/Category/lst', '栏目管理', '1', '1', '', '1', '1', ' fa-sort-amount-asc', '4', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('31', 'admin/Category/lst', '栏目列表', '1', '1', '', '30', '2', 'fa-tasks', '50', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('32', 'admin/Category/add', '添加栏目', '1', '0', '', '30', '2', 'fa-tasks', '50', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('33', 'admin/Category/edit', '编辑栏目', '1', '0', '', '30', '2', 'fa-tasks', '50', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('34', 'admin/Category/del', '删除栏目', '1', '0', '', '30', '2', 'fa-tasks', '50', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('35', 'admin/Article/lst', '文章管理', '1', '1', '', '1', '1', ' fa-pencil', '5', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('36', 'admin/Article/add', '添加文章', '1', '0', '', '35', '2', 'fa-tasks', '2', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('37', 'admin/Article/edit', '编辑文章', '1', '0', '', '35', '2', 'fa-tasks', '3', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('38', 'admin/Article/lst', '文章列表', '1', '1', '', '35', '2', 'fa-tasks', '1', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('39', 'admin/Article/del', '删除文章', '1', '0', '', '35', '2', 'fa-tasks', '4', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('40', 'admin/Flink/lst', '友链管理', '1', '1', '', '1', '1', 'fa-link', '6', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('41', 'admin/Flink/lst', '友链列表', '1', '1', '', '40', '2', 'fa-tasks', '50', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('42', 'admin/Flink/add', '添加友链', '1', '0', '', '40', '2', 'fa-tasks', '50', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('43', 'admin/Flink/edit', '编辑友链', '1', '0', '', '40', '2', 'fa-tasks', '50', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('44', 'admin/Flink/del', '删除友链', '1', '0', '', '40', '2', 'fa-tasks', '50', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('45', 'admin/Banner/lst', '广告管理', '1', '1', '', '1', '1', 'fa-th-large', '8', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('46', 'admin/Banner/lst', '广告列表', '1', '1', '', '45', '2', 'fa-tasks', '50', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('47', 'admin/Banner/add', '添加广告', '1', '0', '', '45', '2', 'fa-tasks', '50', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('48', 'admin/Banner/edit', '编辑广告', '1', '0', '', '45', '2', 'fa-tasks', '50', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('49', 'admin/Banner/del', '删除广告', '1', '0', '', '45', '2', 'fa-tasks', '50', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('50', 'admin/Model/lst', '模型管理', '1', '1', '', '1', '1', 'fa-arrows', '11', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('51', 'admin/Model/lst', '模型列表', '1', '1', '', '50', '2', 'fa-tasks', '50', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('52', 'admin/Model/add', '添加模型', '1', '0', '', '50', '2', 'fa-tasks', '50', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('53', 'admin/Model/edit', '编辑模型', '1', '0', '', '50', '2', 'fa-tasks', '50', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('54', 'admin/Model/del', '删除模型', '1', '0', '', '50', '2', 'fa-tasks', '50', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('55', 'admin/Featured/lst', '推荐位管理', '1', '1', '', '1', '1', ' fa-bullseye', '9', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('56', 'admin/Featured/lst', '推荐位列表', '1', '1', '', '55', '2', 'fa-tasks', '50', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('57', 'admin/Featured/add', '添加推荐位', '1', '0', '', '55', '2', 'fa-tasks', '50', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('58', 'admin/Featured/edit', '编辑推荐位', '1', '0', '', '55', '2', 'fa-tasks', '50', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('59', 'admin/Featured/del', '删除推荐位', '1', '0', '', '55', '2', 'fa-tasks', '50', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('60', 'admin/Ad/lst', '广告位管理', '1', '1', '', '1', '1', ' fa-crosshairs', '7', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('61', 'admin/Ad/lst', '广告位列表', '1', '1', '', '60', '2', 'fa-tasks', '50', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('62', 'admin/Ad/add', '添加广告位', '1', '0', '', '60', '2', 'fa-tasks', '50', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('63', 'admin/Ad/edit', '编辑广告位', '1', '0', '', '60', '2', 'fa-tasks', '50', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('64', 'admin/Ad/del', '删除广告位', '1', '0', '', '60', '2', 'fa-tasks', '50', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('65', 'admin/ConfCate/lst', '配置分类列表', '1', '0', '', '23', '2', 'fa-tasks', '50', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('66', 'admin/ConfCate/add', '添加配置分类', '1', '0', '', '23', '2', 'fa-tasks', '50', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('67', 'admin/ConfCate/edit', '编辑配置分类', '1', '0', '', '23', '2', 'fa-tasks', '50', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('68', 'admin/ConfCate/del', '删除配置分类', '1', '0', '', '23', '2', 'fa-tasks', '50', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('69', 'admin/ModelField/lst', '模型字段管理', '1', '0', '', '50', '2', 'fa-tasks', '50', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('70', 'admin/ModelField/lst', '模型字段列表', '1', '0', '', '69', '2', 'fa-tasks', '50', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('71', 'admin/ModelField/add', '添加模型字段', '1', '0', '', '69', '2', 'fa-tasks', '50', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('72', 'admin/ModelField/edit', '编辑模型字段', '1', '0', '', '69', '2', 'fa-tasks', '50', '0', '0');
INSERT INTO `tp_auth_rule` VALUES ('73', 'admin/ModelField/del', '删除模型字段', '1', '0', '', '69', '2', 'fa-tasks', '50', '0', '0');

-- ----------------------------
-- Table structure for tp_bank
-- ----------------------------
DROP TABLE IF EXISTS `tp_bank`;
CREATE TABLE `tp_bank` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_bank
-- ----------------------------

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
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_banner
-- ----------------------------
INSERT INTO `tp_banner` VALUES ('2', '1', 'uploads/images/20180125\\29dbfb162b435e7b24c9b1d80ba307cc.jpg', '美女啊', '美女啊美女啊美女啊美女啊', 'http://www.baidu.com', '0', '1', '0', '0');
INSERT INTO `tp_banner` VALUES ('13', '3', 'uploads/images/20180206\\32b33444249a6d47d72b774b220bd813.jpg', 'dsadasd', 'dsadsd', 'dsadsd', '1', '1', '0', '0');

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
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_category
-- ----------------------------
INSERT INTO `tp_category` VALUES ('5', '0', '11', '医师团队', 'uploads/images/2018020788d40eef59c82087e55720071230e5bd.jpg', '医师团队医师团队医师团队医师团队医师团队', '1', '50', '医师团队', '医师团队医师团队医师团队医师团队医师团队', 'index_doc', 'list_doc', 'article_doc', '', '1');
INSERT INTO `tp_category` VALUES ('2', '3', '2', 'php', 'uploads/images/201801247692a54e8f9b7a502df3bdbc4d6bb4ab.png', 'phpphpphpphpphpphpphp', '1', '1', 'php', 'phpphpphpphpphpphpphp', 'index', 'list', 'show', '', '1');
INSERT INTO `tp_category` VALUES ('3', '0', '1', '案例展示', 'uploads/images/20180125a452218147c32619825bb45a3b9c26b7.png', '案例展示案例展示案例展示案例展示案例展示案例展示', '1', '2', '案例展示', '案例展示案例展示案例展示案例展示案例展示案例展示', 'index', 'list', 'show', '', '1');
INSERT INTO `tp_category` VALUES ('4', '2', '2', 'PHP语法', 'uploads/images/2018012566daa2f8fa83e9c74b51aa1b711a5876.png', 'PHP语法PHP语法PHP语法PHP语法', '1', '1', 'PHP语法', 'PHP语法PHP语法PHP语法PHP语法', 'index', 'list', 'show', '', '1');
INSERT INTO `tp_category` VALUES ('6', '0', '3', '图集', 'uploads/images/201802081a1eb601ac54cb25516e4cbf0efca128.jpg', 'dsadas', '1', '50', '图集', 'dsadas', 'index', 'list', 'show', '', '1');
INSERT INTO `tp_category` VALUES ('7', '0', '4', '链接', 'uploads/images/201802081a379dc3a7c12a9a03f86a8bb845f3b6.jpg', 'dasdasd', '1', '50', '链接', 'dasdasd', 'index', 'list', 'show', '', '1');
INSERT INTO `tp_category` VALUES ('8', '0', '5', '下载', 'uploads/images/20180208a984c73059c243c0be74f9894ccf8792.jpg', '飒飒多', '1', '50', '下载', '飒飒多', 'index', 'list', 'show', '', '1');

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
) ENGINE=MyISAM AUTO_INCREMENT=60 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_conf
-- ----------------------------
INSERT INTO `tp_conf` VALUES ('10', '2', '站点名称', 'sitename', '1', 'TTCMS', '', '1', '1510122582', '1510123095');
INSERT INTO `tp_conf` VALUES ('11', '2', '站点描述', 'description', '2', 'TTCMS', '', '2', '1510122724', '1510123095');
INSERT INTO `tp_conf` VALUES ('13', '1', '是否启用验证码', 'code', '3', '是', '是,否', '5', '1510124164', '1510124503');
INSERT INTO `tp_conf` VALUES ('14', '1', '自动清空缓存', 'cache', '5', '3小时', '1小时,2小时,3小时', '3', '1510124354', '1510124354');
INSERT INTO `tp_conf` VALUES ('16', '1', 'status', 'status', '3', '开启', '开启,关闭', '10', '1510124425', '1510124448');
INSERT INTO `tp_conf` VALUES ('17', '3', '喜欢的运动', 'like', '4', '篮球,足球,橄榄球', '篮球,足球,橄榄球,羽毛球', '50', '0', '0');
INSERT INTO `tp_conf` VALUES ('18', '1', '网站logo', 'logo', '6', 'uploads/images/201802087f857d2e796e38b00a0a2451f6edd3ed.gif', '', '50', '0', '0');
INSERT INTO `tp_conf` VALUES ('19', '3', '站长名称', 'sitemaster_name', '1', '杜亚琼', '', '50', '0', '0');
INSERT INTO `tp_conf` VALUES ('53', '6', '系统名称', 'system_name', '1', 'TTCMS', '', '50', '0', '0');
INSERT INTO `tp_conf` VALUES ('54', '6', '开发作者', 'author', '1', '杜亚琼', '', '50', '0', '0');
INSERT INTO `tp_conf` VALUES ('55', '6', '官网', 'website', '1', 'http://blog.renwulieren.cn', '', '50', '0', '0');
INSERT INTO `tp_conf` VALUES ('56', '6', '项目地址', 'project_address', '1', 'https://github.com/zhanguomozhu/TTCMS.git', '', '50', '0', '0');
INSERT INTO `tp_conf` VALUES ('57', '6', 'QQ交流群', 'qq_group', '2', '976352324<a target=\"_blank\" href=\"//shang.qq.com/wpa/qunwpa?idkey=9e3d8ac1ba7022b4cc6a492c7645e0198a06afbde7e6d55cab5ca5dbbac5c186\">                 <img border=\"0\" src=\"//pub.idqqimg.com/wpa/images/group.png\" alt=\"TTCMS交流群\" title=\"TTCMS交流群\"></a>', '', '50', '0', '0');

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
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_conf_cate
-- ----------------------------
INSERT INTO `tp_conf_cate` VALUES ('1', 'site', '网站配置', '1', '1');
INSERT INTO `tp_conf_cate` VALUES ('2', 'seo', 'SEO配置', '2', '1');
INSERT INTO `tp_conf_cate` VALUES ('3', 'station_master', '站长配置', '4', '1');
INSERT INTO `tp_conf_cate` VALUES ('6', 'developer', '开发者配置', '50', '1');

-- ----------------------------
-- Table structure for tp_download
-- ----------------------------
DROP TABLE IF EXISTS `tp_download`;
CREATE TABLE `tp_download` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `category_id` int(10) unsigned NOT NULL COMMENT '栏目ID',
  `title` varchar(50) NOT NULL COMMENT '标题',
  `image_url` varchar(250) DEFAULT NULL COMMENT '封面图片',
  `file_url` varchar(250) DEFAULT NULL COMMENT '下载文件',
  `filename` varchar(100) DEFAULT NULL COMMENT '文件名',
  `description` varchar(255) DEFAULT NULL COMMENT '文件描述',
  `clicks` int(11) unsigned DEFAULT '0' COMMENT '点击量',
  `download_num` int(11) unsigned DEFAULT '0' COMMENT '下载次数',
  `url` varchar(200) DEFAULT '' COMMENT '链接',
  `demo_url` varchar(200) DEFAULT '' COMMENT '演示链接',
  `is_recommend` tinyint(1) unsigned DEFAULT '0' COMMENT '是否推荐',
  `is_top` tinyint(1) unsigned DEFAULT '0' COMMENT '是否置顶',
  `sort` int(11) unsigned DEFAULT '50' COMMENT '排序',
  `author` varchar(255) DEFAULT '' COMMENT '作者',
  `status` tinyint(3) unsigned DEFAULT '1' COMMENT '状态',
  `create_time` int(11) unsigned DEFAULT '0' COMMENT '上传时间',
  `update_time` int(11) unsigned DEFAULT '0' COMMENT '修改时间',
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  KEY `is_recommend` (`is_recommend`),
  KEY `is_top` (`is_top`),
  KEY `status` (`status`)
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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_featured
-- ----------------------------
INSERT INTO `tp_featured` VALUES ('3', '最新文章', '4', '2', '0', '0');
INSERT INTO `tp_featured` VALUES ('2', '热点文章', '0', '4', '0', '0');

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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_flink
-- ----------------------------
INSERT INTO `tp_flink` VALUES ('1', '百度', 'http://www.baidu.com', '50', '1', '0', '0');

-- ----------------------------
-- Table structure for tp_link
-- ----------------------------
DROP TABLE IF EXISTS `tp_link`;
CREATE TABLE `tp_link` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `category_id` int(10) unsigned NOT NULL COMMENT '栏目ID',
  `title` varchar(50) NOT NULL COMMENT '标题',
  `image_url` varchar(200) DEFAULT NULL COMMENT '图片',
  `url` varchar(200) DEFAULT NULL COMMENT '链接地址',
  `description` varchar(255) DEFAULT NULL COMMENT '连接描述',
  `is_recommend` tinyint(1) unsigned DEFAULT '0' COMMENT '是否推荐',
  `is_top` tinyint(1) unsigned DEFAULT '0' COMMENT '是否置顶',
  `sort` int(11) unsigned DEFAULT '50' COMMENT '排序',
  `clicks` int(11) unsigned DEFAULT '0' COMMENT '点击数',
  `status` tinyint(1) unsigned DEFAULT '1' COMMENT '状态',
  `author` varchar(255) DEFAULT '' COMMENT '作者',
  `create_time` int(11) unsigned DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned DEFAULT '0' COMMENT '修改时间',
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  KEY `is_recommend` (`is_recommend`),
  KEY `is_top` (`is_top`),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_link
-- ----------------------------
INSERT INTO `tp_link` VALUES ('1', '7', 'dasdasd', 'uploads/images/20180211\\f224488b5fe376424e7b5e7ce37d9285.jpg', 'das', 'dasd', '1', '1', '50', '0', '1', '', '1518336245', '0');
INSERT INTO `tp_link` VALUES ('2', '7', 'dasdas', 'uploads/images/20180211\\4777460fac329ef492971fc7abb89feb.jpg', 'dasd', 'dasd', '1', '1', '50', '0', '1', 'admin', '1518338216', '0');

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
  `is_sys` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否系统模型',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=75 DEFAULT CHARSET=utf8 COMMENT='模型表';

-- ----------------------------
-- Records of tp_model
-- ----------------------------
INSERT INTO `tp_model` VALUES ('1', '单页模型', 'page', 'index', 'list', 'show', '1');
INSERT INTO `tp_model` VALUES ('2', '文章模型', 'article', 'index', 'list', 'show', '1');
INSERT INTO `tp_model` VALUES ('3', '图集模型', 'picture', 'index', 'list', 'show', '1');
INSERT INTO `tp_model` VALUES ('4', '链接模型', 'link', 'index', 'list', 'show', '1');
INSERT INTO `tp_model` VALUES ('5', '下载模型', 'download', 'index', 'list', 'show', '1');
INSERT INTO `tp_model` VALUES ('72', '银行模型', 'bank', 'index_bank', 'list_bank', 'article_bank', '0');

-- ----------------------------
-- Table structure for tp_model_field
-- ----------------------------
DROP TABLE IF EXISTS `tp_model_field`;
CREATE TABLE `tp_model_field` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `model_id` int(11) NOT NULL COMMENT '模型id',
  `cnname` varchar(255) NOT NULL DEFAULT '' COMMENT '表单名称',
  `enname` varchar(255) NOT NULL DEFAULT '' COMMENT '字段表单中文名称',
  `tips` varchar(255) DEFAULT '' COMMENT '表单提示',
  `max_length` int(11) unsigned DEFAULT '250' COMMENT '最大长度',
  `formtype` tinyint(5) unsigned NOT NULL DEFAULT '1' COMMENT '表单类型【1：单行文本2：多行文本3：单选按钮4：多选按钮5：下拉菜单6：上传按钮】',
  `value` varchar(255) DEFAULT '' COMMENT '字段值',
  `values` varchar(255) DEFAULT '' COMMENT '可选值',
  `sort` int(11) unsigned NOT NULL DEFAULT '50',
  `status` tinyint(4) unsigned NOT NULL DEFAULT '1',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_model_field
-- ----------------------------
INSERT INTO `tp_model_field` VALUES ('1', '11', '医师姓名', 'doc_name', '医师姓名', '250', '1', '', '', '2', '1', '0', '0');
INSERT INTO `tp_model_field` VALUES ('2', '11', '医师擅长', 'doc_sc', '医师擅长', '250', '2', '', '', '3', '1', '0', '0');
INSERT INTO `tp_model_field` VALUES ('3', '2', '关注', 'Focus', '只能是数字', '250', '1', '', '', '50', '1', '0', '0');
INSERT INTO `tp_model_field` VALUES ('4', '11', '医师姓名详情', 'doc_body', '医师姓名详情', '250', '7', '', '', '50', '1', '0', '0');
INSERT INTO `tp_model_field` VALUES ('5', '11', '医师姓别', 'doc_sex', '医师姓别', '250', '3', '', '男,女', '50', '1', '0', '0');
INSERT INTO `tp_model_field` VALUES ('6', '11', '医师爱好', 'doc_like', '医师爱好', '250', '4', '', '篮球,足球,排球', '50', '1', '0', '0');
INSERT INTO `tp_model_field` VALUES ('7', '11', '医师上班时间', 'doc_woke', '医师上班时间', '250', '5', '', '星期一,星期二,星期三', '50', '1', '0', '0');
INSERT INTO `tp_model_field` VALUES ('8', '11', '医师下班时间', 'doc_time', '医师下班时间', '250', '8', '', '', '50', '1', '0', '0');
INSERT INTO `tp_model_field` VALUES ('9', '11', '上传', 'doc_upload', '上传', '250', '9', '', '', '50', '1', '0', '0');

-- ----------------------------
-- Table structure for tp_page
-- ----------------------------
DROP TABLE IF EXISTS `tp_page`;
CREATE TABLE `tp_page` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `category_id` int(10) unsigned NOT NULL COMMENT '栏目ID',
  `title` varchar(200) NOT NULL COMMENT '标题',
  `description` varchar(255) DEFAULT NULL COMMENT '摘要',
  `content` text COMMENT '内容',
  `image_url` varchar(200) DEFAULT NULL COMMENT '图片',
  `clicks` int(11) unsigned DEFAULT '0' COMMENT '点击数',
  `author` varchar(255) DEFAULT '' COMMENT '作者',
  `status` tinyint(1) unsigned DEFAULT '1' COMMENT '状态',
  `create_time` int(11) DEFAULT '0' COMMENT '添加时间',
  `update_time` int(11) DEFAULT '0' COMMENT '修改时间',
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
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `category_id` int(10) unsigned NOT NULL COMMENT '栏目ID',
  `title` varchar(50) DEFAULT NULL COMMENT '图片名称',
  `image_url` varchar(200) DEFAULT '' COMMENT '封面图片',
  `images` text COMMENT '图集地址json',
  `description` varchar(255) DEFAULT NULL COMMENT '图片描述',
  `is_recommend` tinyint(1) unsigned DEFAULT '0' COMMENT '是否推荐',
  `clicks` int(11) unsigned DEFAULT '0' COMMENT '点击量',
  `url` varchar(200) DEFAULT NULL COMMENT '地址',
  `sort` int(10) unsigned DEFAULT '50' COMMENT '排序',
  `author` varchar(255) DEFAULT '' COMMENT '作者',
  `is_top` tinyint(1) unsigned DEFAULT '0' COMMENT '是否置顶',
  `status` tinyint(1) unsigned DEFAULT '1' COMMENT '状态',
  `create_time` int(11) unsigned DEFAULT '0' COMMENT '添加时间',
  `update_time` int(11) unsigned DEFAULT '0' COMMENT '修改时间',
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
INSERT INTO `tp_setting` VALUES ('site_name', 'TTCMS博客系统');
INSERT INTO `tp_setting` VALUES ('title_add', '个人博客系统');
INSERT INTO `tp_setting` VALUES ('keywords', 'TTCMS博客系统');
INSERT INTO `tp_setting` VALUES ('description', 'TTCMS博客系统');
