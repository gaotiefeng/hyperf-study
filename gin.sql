/*
Navicat MySQL Data Transfer

Source Server         : 192.168.41.99
Source Server Version : 50723
Source Host           : 192.168.41.99:3306
Source Database       : gin

Target Server Type    : MYSQL
Target Server Version : 50723
File Encoding         : 65001

Date: 2019-09-26 11:19:37
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `user_name` varchar(32) NOT NULL DEFAULT '' COMMENT '名称',
  `mobile` char(11) NOT NULL DEFAULT '' COMMENT '手机号',
  `password` varchar(64) NOT NULL COMMENT '密码',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('1', 'admin', '15904435047', '$2y$11$3RCjBGuQG9qMt9ME1rHAFOEAkxx9lTw9LFR4UlKIYUZjRdeX6EaFa', null, null);
INSERT INTO `admin` VALUES ('2', 'ed', '15904435555', '$2y$11$4aELVqgOoA4db6VvYXEDMOrj/BfJxdPLKEJr8DeD0KdvnlCWC/StG', null, null);

-- ----------------------------
-- Table structure for admin_role
-- ----------------------------
DROP TABLE IF EXISTS `admin_role`;
CREATE TABLE `admin_role` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of admin_role
-- ----------------------------

-- ----------------------------
-- Table structure for article
-- ----------------------------
DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `title` varchar(64) NOT NULL DEFAULT '' COMMENT '标题',
  `content` text COMMENT '内容',
  `likes` int(10) NOT NULL DEFAULT '0' COMMENT '点赞数',
  `page_views` int(10) NOT NULL DEFAULT '0' COMMENT '点击量',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34636204385558530 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of article
-- ----------------------------

-- ----------------------------
-- Table structure for article_user
-- ----------------------------
DROP TABLE IF EXISTS `article_user`;
CREATE TABLE `article_user` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `article_id` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of article_user
-- ----------------------------

-- ----------------------------
-- Table structure for role
-- ----------------------------
DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL DEFAULT '' COMMENT '角色名称',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of role
-- ----------------------------

-- ----------------------------
-- Table structure for role_route
-- ----------------------------
DROP TABLE IF EXISTS `role_route`;
CREATE TABLE `role_route` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `route_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of role_route
-- ----------------------------

-- ----------------------------
-- Table structure for route
-- ----------------------------
DROP TABLE IF EXISTS `route`;
CREATE TABLE `route` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `route` varchar(32) NOT NULL DEFAULT '',
  `name` varchar(32) NOT NULL,
  `icon` varchar(64) NOT NULL DEFAULT '',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `method` varchar(12) NOT NULL DEFAULT '',
  `is_read` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of route
-- ----------------------------

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `mobile` varchar(11) NOT NULL DEFAULT '' COMMENT '手机号',
  `password` varchar(64) NOT NULL DEFAULT '' COMMENT '密码',
  `name` varchar(64) NOT NULL DEFAULT '' COMMENT '用户名称',
  `head_url` varchar(255) NOT NULL DEFAULT '' COMMENT '图形地址',
  `address` varchar(64) NOT NULL DEFAULT '' COMMENT '地址',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mobile` (`mobile`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', '15904435047', '$2y$11$9jPoidnqNmMc01GBN6SnsOSKxrQHIbadHBh7Lb01wRc44.gnqENHq', '', '', '', '2019-08-22 05:37:56', '2019-08-22 05:37:56');
