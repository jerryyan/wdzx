/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50540
Source Host           : localhost:3306
Source Database       : datazx

Target Server Type    : MYSQL
Target Server Version : 50540
File Encoding         : 65001

Date: 2014-11-28 14:33:36
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `wdzx_navigation_users`
-- ----------------------------
DROP TABLE IF EXISTS `wdzx_navigation_users`;
CREATE TABLE `wdzx_navigation_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(55) NOT NULL COMMENT '用户名',
  `pwd` varchar(55) NOT NULL COMMENT '密码',
  `flat` varchar(4) DEFAULT NULL COMMENT '随机码',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wdzx_navigation_users
-- ----------------------------
INSERT INTO `wdzx_navigation_users` VALUES ('1', 'admin', '83a4e18fc95d68e5fd4a1a0ca92a115c', 'asdf');
