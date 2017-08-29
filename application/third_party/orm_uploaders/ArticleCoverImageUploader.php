<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2017 OA Wu Design
 * @license     http://creativecommons.org/licenses/by-nc/2.0/tw/
 */

class ArticleCoverImageUploader extends OrmImageUploader {

  public function getVersions () {
    return array (
        '' => array (),
        'c630x315' => array ('adaptiveResizeQuadrant', 630, 315, 'c'),
        'c1200x630' => array ('adaptiveResizeQuadrant', 1200, 630, 't'),
      );
  }
}