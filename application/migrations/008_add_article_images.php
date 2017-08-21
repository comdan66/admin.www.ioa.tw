<?php if (!defined ('BASEPATH')) exit ('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2017 OA Wu Design
 * @license     http://creativecommons.org/licenses/by-nc/2.0/tw/
 */

class Migration_Add_article_images extends CI_Migration {
  public function up () {
    $this->db->query (
      "CREATE TABLE `article_images` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
        `article_id` int(11) unsigned NOT NULL COMMENT 'Article ID',
        `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '標題',
        `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '名稱',
        `pv` int(11) unsigned NOT NULL DEFAULT 0 COMMENT 'Page View',
        `created_at` datetime NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "' COMMENT '新增時間',
        PRIMARY KEY (`id`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;"
    );
  }
  public function down () {
    $this->db->query (
      "DROP TABLE `article_images`;"
    );
  }
}