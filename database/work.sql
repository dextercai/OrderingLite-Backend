/*
Navicat MySQL Data Transfer

Source Server Version : 50726
Source Host           : 10.144.0.1:3306
Source Database       : work

Target Server Type    : MYSQL
Target Server Version : 50726
File Encoding         : 65001

Date: 2021-06-22 00:36:35
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `t_dish`
-- ----------------------------
DROP TABLE IF EXISTS `t_dish`;
CREATE TABLE `t_dish` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tid` int(10) unsigned NOT NULL,
  `price` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tid` (`tid`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of t_dish
-- ----------------------------
INSERT INTO `t_dish` VALUES ('1', '红烧狮子头', '2', '100', '主要配方：猪肉，葱姜蒜');
INSERT INTO `t_dish` VALUES ('2', '京酱肉丝', '2', '50', '本店招牌菜');
INSERT INTO `t_dish` VALUES ('3', '贵州飞天茅台', '4', '1888', '贵州飞天茅台');
INSERT INTO `t_dish` VALUES ('4', '八二年拉菲', '4', '2888', '八二年拉菲');
INSERT INTO `t_dish` VALUES ('5', '花生米', '1', '18', '精选山东大花生');
INSERT INTO `t_dish` VALUES ('6', '炒牛河', '5', '58', '炒牛河');
INSERT INTO `t_dish` VALUES ('7', '小炒肉', '5', '38', '小炒肉');
INSERT INTO `t_dish` VALUES ('8', '纸巾', '1', '2', '纸巾');
INSERT INTO `t_dish` VALUES ('9', '涪陵榨菜', '1', '18', '涪陵榨菜');
INSERT INTO `t_dish` VALUES ('10', '香酥鸡', '5', '38', '经典香酥鸡');
INSERT INTO `t_dish` VALUES ('11', '椒盐排条', '1', '48', '椒盐风味');
INSERT INTO `t_dish` VALUES ('12', '酸麻鱼头汤', '2', '388', '本店特色');

-- ----------------------------
-- Table structure for `t_dtype`
-- ----------------------------
DROP TABLE IF EXISTS `t_dtype`;
CREATE TABLE `t_dtype` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of t_dtype
-- ----------------------------
INSERT INTO `t_dtype` VALUES ('1', '默认');
INSERT INTO `t_dtype` VALUES ('2', '招牌菜');
INSERT INTO `t_dtype` VALUES ('4', '酒水饮料');
INSERT INTO `t_dtype` VALUES ('5', '精选小炒');

-- ----------------------------
-- Table structure for `t_order`
-- ----------------------------
DROP TABLE IF EXISTS `t_order`;
CREATE TABLE `t_order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `did` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `amount` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of t_order
-- ----------------------------
INSERT INTO `t_order` VALUES ('15', '1', '25', '已出菜', '1');
INSERT INTO `t_order` VALUES ('16', '3', '25', '正制作', '1');
INSERT INTO `t_order` VALUES ('17', '12', '25', '已下单', '1');
INSERT INTO `t_order` VALUES ('18', '5', '25', '已下单', '3');
INSERT INTO `t_order` VALUES ('19', '9', '25', '已下单', '1');
INSERT INTO `t_order` VALUES ('20', '11', '25', '已下单', '4');
INSERT INTO `t_order` VALUES ('21', '3', '25', '已下单', '1');
INSERT INTO `t_order` VALUES ('22', '4', '25', '已下单', '2');

-- ----------------------------
-- Table structure for `t_session`
-- ----------------------------
DROP TABLE IF EXISTS `t_session`;
CREATE TABLE `t_session` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `isDone` int(1) NOT NULL,
  `starttime` int(11) NOT NULL,
  `endtime` int(11) DEFAULT NULL,
  `uid` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of t_session
-- ----------------------------
INSERT INTO `t_session` VALUES ('22', '1', '1623391444', '1623396176', '1', '1');
INSERT INTO `t_session` VALUES ('23', '1', '1623994665', '1623996847', '1', '1');
INSERT INTO `t_session` VALUES ('24', '1', '1623998743', '1623998808', '1', '1');
INSERT INTO `t_session` VALUES ('25', '0', '1624155266', null, '1', '1');
INSERT INTO `t_session` VALUES ('26', '0', '1624278658', null, '1', '2');

-- ----------------------------
-- Table structure for `t_table`
-- ----------------------------
DROP TABLE IF EXISTS `t_table`;
CREATE TABLE `t_table` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of t_table
-- ----------------------------
INSERT INTO `t_table` VALUES ('1', '大厅①桌', 'SQ853');
INSERT INTO `t_table` VALUES ('2', '大厅②桌', 'I97QJW');
INSERT INTO `t_table` VALUES ('3', '大厅③桌', '');
INSERT INTO `t_table` VALUES ('4', '大厅④桌', '');
INSERT INTO `t_table` VALUES ('5', '大厅⑤桌', '');

-- ----------------------------
-- Table structure for `t_user`
-- ----------------------------
DROP TABLE IF EXISTS `t_user`;
CREATE TABLE `t_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of t_user
-- ----------------------------
INSERT INTO `t_user` VALUES ('1', 'admin', '$2a$10$mKPGzmWbm9ul7tEnZPSSG.NLK2J832nDTC8BPaXTylK4/d2UoYVzq', '2');

-- ----------------------------
-- View structure for `v_od`
-- ----------------------------
DROP VIEW IF EXISTS `v_od`;
CREATE ALGORITHM=UNDEFINED DEFINER=`opuser`@`%` SQL SECURITY DEFINER VIEW `v_od` AS select `t_order`.`id` AS `id`,`t_dish`.`name` AS `name`,`t_order`.`amount` AS `amount`,`t_dish`.`price` AS `price`,`t_order`.`status` AS `status`,`t_session`.`starttime` AS `starttime`,`t_session`.`endtime` AS `endtime`,`t_session`.`isDone` AS `isDone` from ((`t_order` join `t_dish` on((`t_order`.`did` = `t_dish`.`id`))) join `t_session` on((`t_order`.`sid` = `t_session`.`id`))) ;

-- ----------------------------
-- View structure for `v_ods`
-- ----------------------------
DROP VIEW IF EXISTS `v_ods`;
CREATE ALGORITHM=UNDEFINED DEFINER=`opuser`@`%` SQL SECURITY DEFINER VIEW `v_ods` AS select `t_order`.`id` AS `id`,`t_dish`.`name` AS `name`,sum(`t_order`.`amount`) AS `amount` from ((`t_order` join `t_dish` on((`t_order`.`did` = `t_dish`.`id`))) join `t_session` on((`t_order`.`sid` = `t_session`.`id`))) where (`t_order`.`amount` <> 0) group by `t_dish`.`id`,`t_order`.`id`,`t_dish`.`name`,`t_dish`.`price`,`t_order`.`status`,`t_session`.`starttime`,`t_session`.`endtime`,`t_session`.`isDone` order by `amount` desc limit 0,10 ;

-- ----------------------------
-- View structure for `v_ostu`
-- ----------------------------
DROP VIEW IF EXISTS `v_ostu`;
CREATE ALGORITHM=UNDEFINED DEFINER=`opuser`@`%` SQL SECURITY DEFINER VIEW `v_ostu` AS select `o`.`id` AS `id`,`o`.`did` AS `did`,`o`.`sid` AS `sid`,`o`.`status` AS `status`,`o`.`amount` AS `amount`,`d`.`name` AS `name`,`t`.`name` AS `tName`,`u`.`username` AS `username`,`s`.`isDone` AS `isDone`,`s`.`starttime` AS `starttime`,`s`.`endtime` AS `endtime` from ((((`t_order` `o` join `t_dish` `d` on((`o`.`did` = `d`.`id`))) join `t_session` `s` on((`s`.`id` = `o`.`sid`))) join `t_table` `t` on((`t`.`id` = `s`.`tid`))) join `t_user` `u` on((`u`.`id` = `s`.`uid`))) ;

-- ----------------------------
-- View structure for `v_uso`
-- ----------------------------
DROP VIEW IF EXISTS `v_uso`;
CREATE ALGORITHM=UNDEFINED DEFINER=`opuser`@`%` SQL SECURITY DEFINER VIEW `v_uso` AS select `u`.`username` AS `username`,`u`.`id` AS `id`,count(`s`.`id`) AS `serverTime`,sum(`o`.`amount`) AS `amount` from (((`t_user` `u` join `t_session` `s` on((`u`.`id` = `s`.`uid`))) join `t_session` `su` on((`u`.`id` = `su`.`uid`))) join `t_order` `o` on((`su`.`id` = `o`.`sid`))) group by `u`.`username`,`u`.`id` ;
