<?php if (!defined ('BASEPATH')) exit ('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2017 OA Wu Design
 * @license     http://creativecommons.org/licenses/by-nc/2.0/tw/
 */

class DeployTool {
  public static function genApi () {
    $CI =& get_instance ();
    $CI->load->helper ('directory_helper');
    $api = FCPATH . 'api' . DIRECTORY_SEPARATOR;
    @directory_delete ($api, false);

    $home = Article::find ('one', array ('order' => 'id DESC', 'conditions' => array ('type = ? AND status = ?', Article::TYPE_1, Article::STATUS_3)));
    write_file ($api . 'home.json', json_encode ($home ? $home->getBackup (true) : null));
    @chmod ($api . 'home.json', 0777);

    $license = Article::find ('one', array ('order' => 'id DESC', 'conditions' => array ('type = ? AND status = ?', Article::TYPE_2, Article::STATUS_3)));
    write_file ($api . 'license.json', json_encode ($license ? $license->getBackup (true) : null));
    @chmod ($api . 'license.json', 0777);

    $tags = Tag::find ('all', array ('select' => 'id, name'));

    $objs = Article::find ('all', array ('order' => 'date_at DESC, id DESC', 'include' => array ('mappings', 'sources'), 'conditions' => array ('type = ? AND status = ?', Article::TYPE_3, Article::STATUS_3)));
    write_file ($api . 'devs.json', json_encode (array_map (function ($obj) use ($tags) { return array_merge ($obj->getBackup (true), array (
      'tags' => ($tag_ids = column_array ($obj->mappings, 'tag_id')) ? array_map (function ($tag) {
        return $tag->getBackup ();
      }, array_filter ($tags, function ($tag) use ($tag_ids) { return in_array ($tag->id, $tag_ids);})) : array (),
      'sources' => array_map (function ($source) { return $source->getBackup ();}, $obj->sources),
      'content' => preg_replace ('/alt=""/', 'alt="' . $obj->title . '"', preg_replace ('/alt=""\s+src="(https?:\/\/[a-zA-Z_0-9\.]*\/[a-zA-Z_0-9]*\/ckeditor_images\/name\/([0-9]*)\/([0-9]*)\/([0-9]*)\/([0-9]*)\/[a-zA-Z_0-9]*\.[^\"]*)"/', 'alt="" data-pvid="CkeditorImage-$2$3$4$5" src="$1"', $obj->content))
    )); }, $objs)));
    @chmod ($api . 'devs.json', 0777);
    
    $objs = Article::find ('all', array ('order' => 'date_at DESC, id DESC', 'include' => array ('mappings', 'sources'), 'conditions' => array ('type = ? AND status = ?', Article::TYPE_4, Article::STATUS_3)));
    write_file ($api . 'blogs.json', json_encode (array_map (function ($obj) use ($tags) { return array_merge ($obj->getBackup (true), array (
      'tags' => ($tag_ids = column_array ($obj->mappings, 'tag_id')) ? array_map (function ($tag) {
        return $tag->getBackup ();
      }, array_filter ($tags, function ($tag) use ($tag_ids) { return in_array ($tag->id, $tag_ids);})) : array (),
      'sources' => array_map (function ($source) { return $source->getBackup ();}, $obj->sources),
      'content' => preg_replace ('/alt=""/', 'alt="' . $obj->title . '"', preg_replace ('/alt=""\s+src="(https?:\/\/[a-zA-Z_0-9\.]*\/[a-zA-Z_0-9]*\/ckeditor_images\/name\/([0-9]*)\/([0-9]*)\/([0-9]*)\/([0-9]*)\/[a-zA-Z_0-9]*\.[^\"]*)"/', 'alt="" data-pvid="CkeditorImage-$2$3$4$5" src="$1"', $obj->content))
    )); }, $objs)));
    @chmod ($api . 'blogs.json', 0777);
    
    $objs = Article::find ('all', array ('order' => 'date_at DESC, id DESC', 'include' => array ('mappings', 'sources'), 'conditions' => array ('type = ? AND status = ?', Article::TYPE_5, Article::STATUS_3)));
    write_file ($api . 'unboxings.json', json_encode (array_map (function ($obj) use ($tags) { return array_merge ($obj->getBackup (true), array (
      'tags' => ($tag_ids = column_array ($obj->mappings, 'tag_id')) ? array_map (function ($tag) {
        return $tag->getBackup ();
      }, array_filter ($tags, function ($tag) use ($tag_ids) { return in_array ($tag->id, $tag_ids);})) : array (),
      'sources' => array_map (function ($source) { return $source->getBackup ();}, $obj->sources),
      'content' => preg_replace ('/alt=""/', 'alt="' . $obj->title . '"', preg_replace ('/alt=""\s+src="(https?:\/\/[a-zA-Z_0-9\.]*\/[a-zA-Z_0-9]*\/ckeditor_images\/name\/([0-9]*)\/([0-9]*)\/([0-9]*)\/([0-9]*)\/[a-zA-Z_0-9]*\.[^\"]*)"/', 'alt="" data-pvid="CkeditorImage-$2$3$4$5" src="$1"', $obj->content))
    )); }, $objs)));
    @chmod ($api . 'unboxings.json', 0777);

    
    $objs = Article::find ('all', array ('order' => 'date_at DESC, id DESC', 'include' => array ('mappings', 'sources', 'images'), 'conditions' => array ('type = ? AND status = ?', Article::TYPE_6, Article::STATUS_3)));
    write_file ($api . 'albums.json', json_encode (array_map (function ($obj) use ($tags) { return array_merge ($obj->getBackup (true), array (
      'tags' => ($tag_ids = column_array ($obj->mappings, 'tag_id')) ? array_map (function ($tag) {
        return $tag->getBackup ();
      }, array_filter ($tags, function ($tag) use ($tag_ids) { return in_array ($tag->id, $tag_ids);})) : array (),
      'sources' => array_map (function ($source) { return $source->getBackup ();}, $obj->sources),
      'images' => array_map (function ($image) { return $image->getBackup (true);}, $obj->images),
      'content' => preg_replace ('/alt=""/', 'alt="' . $obj->title . '"', preg_replace ('/alt=""\s+src="(https?:\/\/[a-zA-Z_0-9\.]*\/[a-zA-Z_0-9]*\/ckeditor_images\/name\/([0-9]*)\/([0-9]*)\/([0-9]*)\/([0-9]*)\/[a-zA-Z_0-9]*\.[^\"]*)"/', 'alt="" data-pvid="CkeditorImage-$2$3$4$5" src="$1"', $obj->content))
    )); }, $objs)));
    @chmod ($api . 'albums.json', 0777);
    
    $objs = Article::find ('all', array ('order' => 'date_at DESC, id DESC', 'include' => array ('mappings', 'sources', 'images'), 'conditions' => array ('type = ? AND status = ?', Article::TYPE_7, Article::STATUS_3)));
    write_file ($api . 'stars.json', json_encode (array_map (function ($obj) use ($tags) { return array_merge ($obj->getBackup (true), array (
      'content' => preg_replace ('/alt=""/', 'alt="' . $obj->title . '"', preg_replace ('/alt=""\s+src="(https?:\/\/[a-zA-Z_0-9\.]*\/[a-zA-Z_0-9]*\/ckeditor_images\/name\/([0-9]*)\/([0-9]*)\/([0-9]*)\/([0-9]*)\/[a-zA-Z_0-9]*\.[^\"]*)"/', 'alt="" data-pvid="CkeditorImage-$2$3$4$5" src="$1"', $obj->content))
    )); }, $objs)));
    @chmod ($api . 'stars.json', 0777);

    return true;
  }

  public static function userAgent () {
    $t = array (
      'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1',
      'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.76 Safari/537.36',
      'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36',
      'Mozilla/5.0 (Linux; Android 4.3; Nexus 7 Build/JSS15Q) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36',
      'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1',
    );
    return $t[array_rand ($t)];
  }
  public static function crud ($opts, &$obj) {
    $options = array (
      CURLOPT_URL => $opts['url'],
      CURLOPT_USERAGENT => self::userAgent (),
      CURLOPT_POSTFIELDS => http_build_query ($opts['data']),
      CURLOPT_TIMEOUT => 240, CURLOPT_HEADER => false, CURLOPT_POST => true, CURLOPT_MAXREDIRS => 10, CURLOPT_AUTOREFERER => true, CURLOPT_CONNECTTIMEOUT => 30, CURLOPT_RETURNTRANSFER => true, CURLOPT_FOLLOWLOCATION => true,
    );

    $ch = curl_init ($opts['url']);
    curl_setopt_array ($ch, $options);
    $data = curl_exec ($ch);
    curl_close ($ch);

    $obj->res = $data;

    
    if ($data && ($data = json_decode ($data, true)) && isset ($data['status']) && $data['status']) {
      return true;
    } else {
      // echo '<meta http-equiv="Content-type" content="text/html; charset=utf-8" /><pre>';
      // var_dump ($data);
      // exit ();
      return false;
    };
  }
  public static function callBuild (&$obj) {
    return self::crud (Cfg::setting ('deploy', 'build'), $obj);
  }
  public static function callUpload (&$obj) {
    return self::crud (Cfg::setting ('deploy', 'upload'), $obj);
  }
}