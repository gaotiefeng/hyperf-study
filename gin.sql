/*
Navicat MySQL Data Transfer

Source Server         : 192.168.41.99
Source Server Version : 50723
Source Host           : 192.168.41.99:3306
Source Database       : gin

Target Server Type    : MYSQL
Target Server Version : 50723
File Encoding         : 65001

Date: 2019-09-03 13:59:16
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for article
-- ----------------------------
DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `title` varchar(64) NOT NULL DEFAULT '' COMMENT '标题',
  `content` text COMMENT '内容',
  `likes` int(10) NOT NULL DEFAULT '0' COMMENT '点赞数',
  `page_views` int(10) NOT NULL DEFAULT '0' COMMENT '点击量',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of article
-- ----------------------------

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mobile` varchar(11) NOT NULL DEFAULT '' COMMENT '手机号',
  `password` varchar(64) NOT NULL DEFAULT '' COMMENT '密码',
  `name` varchar(64) NOT NULL DEFAULT '' COMMENT '用户名称',
  `head_url` varchar(255) NOT NULL DEFAULT '' COMMENT '图形地址',
  `address` varchar(64) NOT NULL DEFAULT '' COMMENT '地址',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mobile` (`mobile`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `article_user`;
CREATE TABLE `article_user` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `article_id` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', '15904435047', '$2y$11$9jPoidnqNmMc01GBN6SnsOSKxrQHIbadHBh7Lb01wRc44.gnqENHq', '', '', '', '2019-08-22 05:37:56', '2019-08-22 05:37:56');
