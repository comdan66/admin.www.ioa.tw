<h1<?php echo isset ($icon) && $icon ? ' class="' . $icon . '"' : '';?>>修改<?php echo $title;?></h1>

<div class='panel'>
  <form class='form-type1 loading' action='<?php echo base_url ($uri_1, $obj->id);?>' method='post' enctype='multipart/form-data'>
    <input type='hidden' name='_method' value='put' />

    <div class='row min'>
      <b class='need'>是否上架</b>
      <label class='switch'>
        <input type='checkbox' name='status'<?php echo (isset ($posts['status']) ? $posts['status'] : $obj->status) == Article::STATUS_3 ? ' checked' : '';?> value='<?php echo Article::STATUS_3;?>' />
        <span></span>
      </label>
    </div>


    <div class='row'>
      <b class='need'><?php echo $title;?>標題</b>
      <input type='text' name='title' value='<?php echo isset ($posts['title']) ? $posts['title'] : $obj->title;?>' placeholder='請輸入<?php echo $title;?>標題..' maxlength='200' pattern='.{1,200}' required title='輸入<?php echo $title;?>標題!' autofocus />
    </div>

    <div class='row'>
      <b class='need'><?php echo $title;?>副標題</b>
      <input type='text' name='bio' value='<?php echo isset ($posts['bio']) ? $posts['bio'] : $obj->bio;?>' placeholder='請輸入<?php echo $title;?>副標題..' maxlength='200' pattern='.{1,200}' required title='輸入<?php echo $title;?>副標題!' />
    </div>
    
    <div class='row'>
      <b class='need' data-title='預覽僅示意，未按比例。'><?php echo $title;?>封面</b>
      <div class='drop_img'>
        <img src='<?php echo $obj->cover->url ();?>' />
        <input type='file' name='cover' />
      </div>
    </div>


    <div class='row'>
      <b class='need'><?php echo $title;?>時間</b>
      <input type='date' name='date_at' value='<?php echo isset ($posts['date_at']) ? $posts['date_at'] : $obj->date_at->format ('Y-m-d');?>' placeholder='請選擇<?php echo $title;?>時間..' maxlength='200' pattern='.{1,200}' required title='選擇<?php echo $title;?>時間!' />
    </div>

    <div class='row'>
      <b>其他照片</b>
      <div class='drop_imgs'>
        
  <?php foreach ($obj->images as $image) { ?>
          <div class='drop_img'>
            <img src='<?php echo $image->name->url ();?>' />
            <input type='hidden' name='oldimg[]' value='<?php echo $image->id; ?>' />
            <input type='file' name='images[]' />
            <a class='icon-bin'></a>
          </div>
  <?php }?>
        <div class='drop_img'>
          <img src='' />
          <input type='file' name='images[]' />
          <a class='icon-bin'></a>
        </div>

      </div>
    </div>

<?php if ($tags = Tag::all ()) { ?>
        <div class='row'>
          <b>文章分類</b>
    <?php foreach ($tags as $tag) { ?>
            <label class='checkbox'>
              <input type='checkbox' name='tag_ids[]' value='<?php echo $tag->id;?>'<?php echo $tag_ids && in_array ($tag->id, $tag_ids) ? ' checked' : '';?>>
              <span></span>
              <?php echo $tag->name;?>
            </label>
    <?php } ?>
        </div>
<?php }?>
    <div class='row'>
      <b class='need'><?php echo $title;?>內容</b>
      <textarea class='cke' name='content' placeholder='請輸入<?php echo $title;?>內容..'><?php echo isset ($posts['content']) ? $posts['content'] : $obj->content;?></textarea>
    </div>

    <div class='row'>
      <button type='submit'>確定送出</button>
      <button type='reset'>重新填寫</button>
      <a href='<?php echo base_url ($uri_1);?>'>回列表頁</a>
    </div>
  </form>
</div>
