--
-- 表的结构 `tp_admin`
--

CREATE TABLE IF NOT EXISTS `tp_admin` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL COMMENT '管理员名称',
  `password` char(32) NOT NULL COMMENT '管理员密码',
  `avatar` varchar(250) DEFAULT NULL COMMENT '头像',
  `phone` varchar(11) NOT NULL DEFAULT '' COMMENT '手机',
  `logintime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上一次登录时间',
  `loginip` char(20) NOT NULL DEFAULT '' COMMENT '上一次登录ip',
  `lock` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否锁定',
  `admin` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否是超级管理员【0：普通管理员，1：超级管理员】',
  `num` int(11) NOT NULL DEFAULT '0' COMMENT '登陆次数',
  `session_id` varchar(250) NOT NULL DEFAULT '' COMMENT 'session_id',
  `create_time` int(10) unsigned NOT NULL COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`),
  KEY `phone` (`phone`),
  KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `tp_auth_group`
--
CREATE TABLE IF NOT EXISTS `tp_auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` varchar(255) NOT NULL DEFAULT '',
  `create_time` int(10) unsigned NOT NULL,
  `update_time` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `tp_auth_group_access`
--
CREATE TABLE IF NOT EXISTS `tp_auth_group_access` (
  `admin_id` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  UNIQUE KEY `admin_group_id` (`admin_id`,`group_id`),
  KEY `admin_id` (`admin_id`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `tp_auth_rule`
--
CREATE TABLE IF NOT EXISTS `tp_auth_rule` (
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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `tp_article`
--

CREATE TABLE IF NOT EXISTS `tp_article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(10) unsigned NOT NULL COMMENT '栏目ID',
  `title` varchar(200) NOT NULL COMMENT '标题',
  `keywords` varchar(100) DEFAULT NULL COMMENT '标签',
  `description` varchar(255) DEFAULT NULL COMMENT '摘要',
  `image_url` varchar(200) DEFAULT NULL COMMENT '图片',
  `content` text COMMENT '内容',
  `create_time` datetime DEFAULT NULL COMMENT '添加时间',
  `update_time` datetime DEFAULT NULL COMMENT '更新时间',
  `author` varchar(20) DEFAULT NULL COMMENT '文章作者',
  `source` varchar(30) DEFAULT NULL COMMENT '文章来源',
  `hits` int(10) unsigned DEFAULT '0' COMMENT '点击量',
  `is_recommend` tinyint(1) DEFAULT '0' COMMENT '是否推荐',
  `is_top` tinyint(4) DEFAULT '0' COMMENT '是否置顶',
  `url` varchar(250) DEFAULT NULL COMMENT '文章链接',
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  KEY `hits` (`hits`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tp_category`
--

CREATE TABLE IF NOT EXISTS `tp_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned NOT NULL COMMENT '上级id',
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
  KEY `parent_id` (`parent_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tp_download`
--

CREATE TABLE IF NOT EXISTS `tp_download` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tp_feedback`
--

CREATE TABLE IF NOT EXISTS `tp_feedback` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tp_link`
--

CREATE TABLE IF NOT EXISTS `tp_link` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(10) unsigned NOT NULL COMMENT '栏目ID',
  `title` varchar(50) NOT NULL COMMENT '标题',
  `image_url` varchar(200) DEFAULT NULL COMMENT '图片',
  `url` varchar(200) DEFAULT NULL COMMENT '链接地址',
  `description` varchar(255) DEFAULT NULL COMMENT '连接描述',
  `create_time` datetime DEFAULT NULL COMMENT '添加时间',
  `is_recommend` tinyint(1) DEFAULT '0' COMMENT '是否推荐',
  `is_top` tinyint(4) DEFAULT '0' COMMENT '是否置顶',
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tp_member`
--

CREATE TABLE IF NOT EXISTS `tp_member` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tp_model`
--

CREATE TABLE IF NOT EXISTS `tp_model` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL COMMENT '模型名称',
  `tablename` char(20) NOT NULL COMMENT '表名',
  `index_template` char(30) NOT NULL DEFAULT 'index' COMMENT '封面页模板',
  `list_template` char(30) NOT NULL DEFAULT 'list' COMMENT '列表模板',
  `show_template` char(30) NOT NULL DEFAULT 'show' COMMENT '详情页模板',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='模型表' AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- 表的结构 `tp_page`
--

CREATE TABLE IF NOT EXISTS `tp_page` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(10) unsigned NOT NULL COMMENT '分类ID',
  `title` varchar(200) NOT NULL COMMENT '标题',
  `description` varchar(255) DEFAULT NULL COMMENT '摘要',
  `content` text COMMENT '内容',
  `image_url` varchar(200) DEFAULT NULL COMMENT '图片',
  `create_time` datetime DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tp_picture`
--

CREATE TABLE IF NOT EXISTS `tp_picture` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tp_setting`
--

CREATE TABLE IF NOT EXISTS `tp_setting` (
  `key` varchar(200) NOT NULL DEFAULT '',
  `value` text NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='设置表';