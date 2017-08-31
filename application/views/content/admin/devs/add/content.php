<h1<?php echo isset ($icon) && $icon ? ' class="' . $icon . '"' : '';?>>新增<?php echo $title;?></h1>

<div class='panel'>
  <form class='form-type1 loading' action='<?php echo base_url ($uri_1);?>' method='post' enctype='multipart/form-data'>

    <div class='row min'>
      <b class='need'>是否上架</b>
      <label class='switch'>
        <input type='checkbox' name='status'<?php echo (isset ($posts['status']) ? $posts['status'] : Article::STATUS_2) == Article::STATUS_3 ? ' checked' : '';?> value='<?php echo Article::STATUS_3;?>' />
        <span></span>
      </label>
    </div>
    
    <div class='row min'>
      <b class='need'>是否里程碑</b>
      <label class='switch'>
        <input type='checkbox' name='timeline'<?php echo (isset ($posts['timeline']) ? $posts['timeline'] : Article::TIMELINE_1) == Article::TIMELINE_2 ? ' checked' : '';?> value='<?php echo Article::TIMELINE_2;?>' />
        <span></span>
      </label>
    </div>
    
    <div class='row min'>
      <b class='need'>是否為接案</b>
      <label class='switch'>
        <input type='checkbox' name='case'<?php echo (isset ($posts['case']) ? $posts['case'] : Article::CASE_1) == Article::CASE_2 ? ' checked' : '';?> value='<?php echo Article::CASE_2;?>' />
        <span></span>
      </label>
    </div>

    <div class='row'>
      <b class='need'><?php echo $title;?>標題</b>
      <input type='text' name='title' value='<?php echo isset ($posts['title']) ? $posts['title'] : '';?>' placeholder='請輸入<?php echo $title;?>標題..' maxlength='200' pattern='.{1,200}' required title='輸入<?php echo $title;?>標題!' autofocus />
    </div>

    <div class='row'>
      <b class='need'><?php echo $title;?>副標題</b>
      <input type='text' name='bio' value='<?php echo isset ($posts['bio']) ? $posts['bio'] : '';?>' placeholder='請輸入<?php echo $title;?>副標題..' maxlength='200' pattern='.{1,200}' required title='輸入<?php echo $title;?>副標題!' />
    </div>

    <div class='row'>
      <b class='need'><?php echo $title;?>時間</b>
      <input type='date' name='date_at' value='<?php echo isset ($posts['date_at']) ? $posts['date_at'] : date ('Y-m-d');?>' placeholder='請選擇<?php echo $title;?>時間..' maxlength='200' pattern='.{1,200}' required title='選擇<?php echo $title;?>時間!' />
    </div>
    
    <div class='row'>
      <b class='need' data-title='預覽僅示意，未按比例。'><?php echo $title;?>小圖</b>
      <div class='drop_img'>
        <img src='' />
        <input type='file' name='icon' />
      </div>
    </div>
    
    <div class='row'>
      <b class='need' data-title='預覽僅示意，未按比例。'><?php echo $title;?>封面</b>
      <div class='drop_img'>
        <img src='' />
        <input type='file' name='cover' />
      </div>
    </div>

    <div class='row'>
      <b class='need'><?php echo $title;?>內容</b>
      <textarea class='cke' name='content' placeholder='請輸入<?php echo $title;?>內容..'><?php echo isset ($posts['content']) ? $posts['content'] : '';?></textarea>
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

    <div class='row muti' data-vals='<?php echo json_encode ($sources);?>' data-cnt='<?php echo count ($row_muti);?>' data-attrs='<?php echo json_encode ($row_muti);?>'>
      <b><?php echo $title;?>參考</b>
      <span><a></a></span>
    </div>

    <div class='row'>
      <button type='submit'>確定送出</button>
      <button type='reset'>重新填寫</button>
      <a href='<?php echo base_url ($uri_1);?>'>回列表頁</a>
    </div>
  </form>
</div>
