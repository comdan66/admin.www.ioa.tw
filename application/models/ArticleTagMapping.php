<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2017 OA Wu Design
 * @license     http://creativecommons.org/licenses/by-nc/2.0/tw/
 */

class ArticleTagMapping extends OaModel {

  static $table_name = 'article_tag_mappings';

  static $has_one = array (
  );

  static $has_many = array (
    array ('tags',     'class_name' => 'Tag'),
    array ('articles', 'class_name' => 'Article'),
  );

  static $belongs_to = array (
  );

  public function __construct ($attributes = array (), $guard_attributes = true, $instantiating_via_find = false, $new_record = true) {
    parent::__construct ($attributes, $guard_attributes, $instantiating_via_find, $new_record);
  }
  public function destroy () {
    if (!isset ($this->id)) return false;
    
    return $this->delete ();
  }
}