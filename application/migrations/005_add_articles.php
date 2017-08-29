<?php if (!defined ('BASEPATH')) exit ('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2017 OA Wu Design
 * @license     http://creativecommons.org/licenses/by-nc/2.0/tw/
 */

class Migration_Add_articles extends CI_Migration {
  public function up () {
    $this->db->query (
      "CREATE TABLE `articles` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,

        `icon` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '小封面',
        `cover` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '封面',

        `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '標題',
        `bio` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '關於',
        `content` text NOT NULL COMMENT '內容',
        `date_at` date DEFAULT NULL COMMENT '文章日期',

        `type` tinyint(4) unsigned NOT NULL DEFAULT 1 COMMENT '類型，1 首頁，2 實作，3 生活，4 開箱文，5 相簿',
        `status` tinyint(4) unsigned NOT NULL DEFAULT 1 COMMENT '狀態，1 刪除，2 下架，3 上架',
        `timeline` tinyint(4) unsigned NOT NULL DEFAULT 1 COMMENT '里程碑，1 不要，2 要',

        `pv` int(11) unsigned NOT NULL DEFAULT 0 COMMENT 'Page view',

        `updated_at` datetime NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "' COMMENT '更新時間',
        `created_at` datetime NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "' COMMENT '新增時間',
        PRIMARY KEY (`id`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;"
    );
  }
  public function down () {
    $this->db->query (
      "DROP TABLE `articles`;"
    );
  }
}