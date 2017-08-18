<?php if (!defined ('BASEPATH')) exit ('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2017 OA Wu Design
 * @license     http://creativecommons.org/licenses/by-nc/2.0/tw/
 */

class Platform extends Site_controller {

  public function __construct () {
    parent::__construct ();
    $this->load->library ('fb');
  }
  
  public function login () {
    if (User::current () && User::current ()->is_login ()) return redirect_message (array ('admin', 'my'), array ());
    else $this->set_frame_path ('frame', 'pure')
              ->set_title ('登入')
              ->load_view (array (
                  'posts' => Session::getData ('posts', true)
                ));
  }
  public function fb_sign_in () {
    if (!(Fb::login () && ($me = Fb::me ()) && ((isset ($me['name']) && ($name = $me['name'])) && (isset ($me['email']) && ($email = $me['email'])) && (isset ($me['id']) && ($fid = $me['id'])))))
      return redirect_message (array ('login'), array ('_fd' => 'Facebook 登入錯誤，請通知程式設計人員!(1)'));

    if (!($user = User::find ('one', array ('conditions' => array ('fid = ?', $fid)))))
      if (!User::transaction (function () use (&$user, $fid, $name, $email) {
        return verifyCreateOrm ($user = User::create (array_intersect_key (array (
          'fid' => $fid,
          'account' => '',
          'password' => '',
          'token' => token ($fid),
          'name' => $name,
          'email' => $email,
        ), User::table ()->columns))) && $user->create_set ();
      }))
        return redirect_message (array ('login'), array ('_fd' => 'Facebook 登入錯誤，請通知程式設計人員!(2)'));

    // $user->name = $name;
    // $user->email = $email;
    
    if (!$user->set) $user->create_set ();

    $user->set->login_count += 1;
    $user->set->logined_at = date ('Y-m-d H:i:s');

    if (!User::transaction (function () use ($user) { return $user->save () && $user->set->save (); }))
      return redirect_message (array ('login'), array ('_fd' => 'Facebook 登入錯誤，請通知程式設計人員!(3)'));

    Session::setData ('user_token', $user->token);
    return redirect_message (func_get_args (), array ('_fi' => '使用 Facebook 登入成功!'));
  }

  public function logout () {
    Session::setData ('user_token', '');
    return redirect_message ('login', array ('_fi' => '登出成功!'));
  }
}
