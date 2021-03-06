<!DOCTYPE html>
<html lang="zh">
  <head>
    <?php echo isset ($meta_list) ? $meta_list : ''; ?>

    <title><?php echo isset ($title) ? $title : ''; ?></title>

<?php echo isset ($css_list) ? $css_list : ''; ?>

<?php echo isset ($js_list) ? $js_list : ''; ?>

  </head>
  <body lang="zh-tw">
    <?php echo isset ($hidden_list) ? $hidden_list : ''; ?>

    <input type='checkbox' class='hckb' id='menu_ckb' />
    <input type='checkbox' class='hckb' id='user_ckb' />

    <header id='header'>
      <div class='logo'>
        <span><i><?php echo Cfg::setting ('company', 'char');?></i></span>
        <span><?php echo Cfg::setting ('company', 'ename');?></span>
      </div>
      <div class='midle'>
        <label class='icon-menu' for='menu_ckb'></label>
      </div>
      <div class='avatar' data-cntrole='notice'>
        <label for='user_ckb' class='_ic'>
          <img src='<?php echo User::current ()->avatar ();?>' />
        </label>
      </div>
    </header>

    <div id='main'>
      <div class='ani1'>
  <?php if ($t = Session::getData ('_fi', true)) { ?><label class='alert type1'><?php echo $t;?></label><?php } ?>
  <?php if ($t = Session::getData ('_fd', true)) { ?><label class='alert type3'><?php echo $t;?></label><?php } ?>
  <?php echo isset ($content) ? $content : ''; ?>
      </div>
    </div>

    <div id='menu'>
      <header>
        <span><?php echo Cfg::setting ('company', 'name');?></span>
        <span>管理系統</span>
      </header>

<?php if (User::current ()->in_roles (array ('member'))) { ?>
        <div class='group'>
          <span class='icon-u'>一般管理</span>
          <div>
            <a class='icon-home<?php echo ($url = base_url ('admin')) && isset ($_url) && ($url == $_url) ? ' show' : '';?>' href='<?php echo $url;?>'>後台首頁</a>
            <a class='icon-price-tags<?php echo ($url = base_url ('admin', 'tags')) && isset ($_url) && ($url == $_url) ? ' show' : '';?>' href='<?php echo $url;?>'>標籤列表</a>
            <a class='icon-home<?php echo ($url = base_url ('admin', 'homes')) && isset ($_url) && ($url == $_url) ? ' show' : '';?>' href='<?php echo $url;?>'>首頁文章</a>
            <a class='icon-copyright<?php echo ($url = base_url ('admin', 'licenses')) && isset ($_url) && ($url == $_url) ? ' show' : '';?>' href='<?php echo $url;?>'>授權聲明</a>
          </div>
        </div>
        <div class='group'>
          <span class='icon-file-text2'>文章管理</span>
          <div>
            <a class='icon-t<?php echo ($url = base_url ('admin', 'devs')) && isset ($_url) && ($url == $_url) ? ' show' : '';?>' href='<?php echo $url;?>'>開發心得</a>
            <a class='icon-b<?php echo ($url = base_url ('admin', 'blogs')) && isset ($_url) && ($url == $_url) ? ' show' : '';?>' href='<?php echo $url;?>'>生活紀錄</a>
            <a class='icon-g<?php echo ($url = base_url ('admin', 'unboxings')) && isset ($_url) && ($url == $_url) ? ' show' : '';?>' href='<?php echo $url;?>'>開箱文章</a>
            <a class='icon-images<?php echo ($url = base_url ('admin', 'albums')) && isset ($_url) && ($url == $_url) ? ' show' : '';?>' href='<?php echo $url;?>'>個人相簿</a>
            <a class='icon-star-full<?php echo ($url = base_url ('admin', 'stars')) && isset ($_url) && ($url == $_url) ? ' show' : '';?>' href='<?php echo $url;?>'>重要事件</a>
          </div>
        </div>
        <div class='group'>
          <span class='icon-user-secret'>系統管理</span>
          <div>
            <a class='icon-loop2<?php echo ($url = base_url ('admin', 'deploys')) && isset ($_url) && ($url == $_url) ? ' show' : '';?>' href='<?php echo $url;?>'>部署紀錄</a>
          </div>
        </div>
<?php } ?>

      <footer>© <?php echo date ('Y');?> <?php echo Cfg::setting ('company', 'domain');?></footer>
    </div><label class='icon-cross' for='menu_ckb'></label>

    <div id='user'>
      <div>
        <span>Hi, <b><?php echo User::current ()->name;?></b> 您好。</span>
          <span>目前登入次數：<b><?php echo number_format (User::current ()->cnt_login);?></b>次</span>
          <span>上次登入：<time datetime='<?php echo User::current ()->logined_at->format ('Y-m-d H:i:s');?>'><?php echo User::current ()->logined_at->format ('Y-m-d H:i:s');?></time></span>
        <a href='<?php echo base_url ('logout');?>' class='icon-power'>登出</a>
      </div>
    </div><label for='user_ckb'></label>

    <div id='tip_texts'></div>

    <div id='loading'>
      <div><span>請稍後..</span></div>
    </div>

  </body>
</html>