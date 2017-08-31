<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2017 OA Wu Design
 * @license     http://creativecommons.org/licenses/by-nc/2.0/tw/
 */

class Article extends OaModel {

  static $table_name = 'articles';

  static $has_one = array (
  );

  static $has_many = array (
    array ('mappings', 'class_name' => 'ArticleTagMapping'),
    array ('tags',     'class_name' => 'Tag', 'through' => 'mappings'),
    array ('sources',  'class_name' => 'ArticleSource'),
    array ('images',  'class_name' => 'ArticleImage')
  );

  static $belongs_to = array (
    array ('user', 'class_name' => 'User'),
  );

  const TIMELINE_1 = 1;
  const TIMELINE_2 = 2;

  static $timelineNames = array (
    self::TIMELINE_1 => '不要',
    self::TIMELINE_2 => '要',
  );

  const CASE_1 = 1;
  const CASE_2 = 2;

  static $caseNames = array (
    self::CASE_1 => '不是',
    self::CASE_2 => '是',
  );

  const STATUS_1 = 1;
  const STATUS_2 = 2;
  const STATUS_3 = 3;

  static $statusNames = array (
    self::STATUS_1 => '刪除',
    self::STATUS_2 => '下架',
    self::STATUS_3 => '上架',
  );

  const TYPE_1 = 1;
  const TYPE_2 = 2;
  const TYPE_3 = 3;
  const TYPE_4 = 4;
  const TYPE_5 = 5;
  const TYPE_6 = 6;
  const TYPE_7 = 7;

  static $typeNames = array (
    self::TYPE_1 => '首頁',
    self::TYPE_2 => '授權',
    self::TYPE_3 => '實作',
    self::TYPE_4 => '生活',
    self::TYPE_5 => '開箱',
    self::TYPE_6 => '相簿',
    self::TYPE_7 => '重要事件',
  );

  public function __construct ($attributes = array (), $guard_attributes = true, $instantiating_via_find = false, $new_record = true) {
    parent::__construct ($attributes, $guard_attributes, $instantiating_via_find, $new_record);

    OrmImageUploader::bind ('icon', 'ArticleIconImageUploader');
    OrmImageUploader::bind ('cover', 'ArticleCoverImageUploader');
  }
  public function mini_title ($length = 50) {
    if (!isset ($this->title)) return '';
    return $length ? mb_strimwidth (remove_ckedit_tag ($this->title), 0, $length, '…','UTF-8') : remove_ckedit_tag ($this->title);
  }
  public function mini_content ($length = 100) {
    if (!isset ($this->content)) return '';
    return $length ? mb_strimwidth (remove_ckedit_tag ($this->content), 0, $length, '…','UTF-8') : remove_ckedit_tag ($this->content);
  }
  public function destroy () {
    if (!(isset ($this->id) && isset ($this->status))) return false;
    
    $this->status = Article::STATUS_1;

    return $this->save ();

    // if ($this->mappings)
    //   foreach ($this->mappings as $mapping)
    //     if (!$mapping->destroy ())
    //       return false;

    // if ($this->sources)
    //   foreach ($this->sources as $source)
    //     if (!$source->destroy ())
    //       return false;

    // return $this->delete ();
  }
}