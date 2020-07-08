<?php

?>
CREATE TABLE `<?=$MUNConfig["Database"]["table_pre"]?><?=$ConferenceTitle?>_Bulletin`
(
    `id`   int unsigned NOT NULL AUTO_INCREMENT COMMENT '編號',
    `title` varchar(255) NOT NULL COMMENT '公告名稱',
    `publisher` varchar(255) NOT NULL COMMENT '發布者',
    `time` date         NOT NULL COMMENT '新增時間',
    PRIMARY KEY (`id`)
);
CREATE TABLE `<?=$MUNConfig["Database"]["table_pre"]?><?=$ConferenceTitle?>_Bulletin_Draft`
(
    `id`   int unsigned NOT NULL AUTO_INCREMENT COMMENT '編號',
    `title` varchar(255) NOT NULL COMMENT '公告名稱',
    `publisher` varchar(255) NOT NULL COMMENT '發布者',
    `time` date         NOT NULL COMMENT '新增時間',
    PRIMARY KEY (`id`)
);