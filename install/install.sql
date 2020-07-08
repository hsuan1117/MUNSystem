CREATE DATABASE `MUNSystem`;
use `MUNSystem`;
CREATE TABLE `Account`
(
    `id`       int unsigned NOT NULL AUTO_INCREMENT COMMENT '編號',
    `account`  varchar(255) NOT NULL COMMENT '帳號',
    `password` varchar(255) NOT NULL COMMENT '密碼',
    `email`    varchar(255) NOT NULL COMMENT 'Email',
    `nickname` varchar(255) NOT NULL DEFAULT '' COMMENT '暱稱',
    `level`    int unsigned NOT NULL DEFAULT 1 COMMENT '帳戶權限',
    PRIMARY KEY (`id`)
);
CREATE TABLE `Conference`
(
    `id`     int unsigned NOT NULL AUTO_INCREMENT COMMENT '編號',
    `title`  varchar(255) NOT NULL COMMENT '會議名稱',
    `time`   varchar(255) NOT NULL COMMENT '新增時間',
    `chairs` varchar(255) NOT NULL COMMENT '主席',
    PRIMARY KEY (`id`)
);