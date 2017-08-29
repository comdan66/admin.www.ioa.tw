<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2017 OA Wu Design
 * @license     http://creativecommons.org/licenses/by-nc/2.0/tw/
 */

class ArticleIconImageUploader extends OrmImageUploader {

  public function getVersions () {
    return array (
        '' => array (),
        'c300x300' => array ('adaptiveResizeQuadrant', 300, 300, 'c'),
      );
  }
}