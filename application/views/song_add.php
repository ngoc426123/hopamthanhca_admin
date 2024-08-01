<?php 
if (isset($alert)) {
  print_alert($alert);
}
?>
<div data-song-add>
<form action="<?php echo base_url("song?action=add"); ?>" method="post">
<div class="row">
  <div class="col-12">
    <div class="form-group bmd-form-group">
      <label class="bmd-label-floating">Tên bài hát</label>
      <input type="text" class="form-control heading-input" id="songTitle" name="title" value='' required data-song-title>
    </div>
  </div>
  <div class="col-12 d-none" data-song-exist>
    <p class="tiz-note">Có phải ý bạn là bài:</p>
    <ul class="tiz-list" data-list-song-exist></ul>
  </div>
</div>
<div class="row">
  <div class="col-12 col-lg-8 col-xl-9">
    <div class="card">
      <div class="card-header card-header-rose card-header-text">
        <div class="card-text">
          <h4 class="card-title">Nội dung</h4>
        </div>
      </div>
      <div class="card-body">
        <textarea id="editor" name="content"></textarea>
      </div>
    </div>
    <div class="card">
      <div class="card-header card-header-rose card-header-text">
        <div class="card-text">
          <h4 class="card-title">Meta bài hát</h4>
        </div>
      </div>
      <div class="card-body">
        <div class="form-group bmd-form-group">
          <label class="bmd-label-floating">File nhạc</label>
          <input type="text" class="form-control" name='pdffile'>
        </div>
        <div class="form-group bmd-form-group">
          <label class="bmd-label-floating">Lời đầu</label>
          <input class="form-control" name="excerpt">
        </div>
        <div class="form-group bmd-form-group">
          <label class="bmd-label-floating">Hợp âm chính</label>
          <input class="form-control" name="hopamchinh">
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header card-header-rose card-header-text">
        <div class="card-text">
          <h4 class="card-title">Seo Engine</h4>
        </div>
        <div class="pull-right">
          <button type='button' class='btn btn-sm btn-primary' id="update_meta_seo"><i class="material-icons">file_copy</i></button>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-12 col-md-6">
            <div class="form-group bmd-form-group">
              <label class="bmd-label-floating">SEO Title</label>
              <input type="text" class="form-control" name="seotitle" required>
            </div>
            <div class="form-group bmd-form-group">
              <label class="bmd-label-floating">SEO Url</label>
              <input type="text" class="form-control" name="seourl" required>
            </div>
            <div class="form-group bmd-form-group">
              <label class="bmd-label-floating">SEO Meta decription</label>
              <input type="text" class="form-control" name="seodes" required>
            </div>
            <div class="form-group bmd-form-group">
              <label class="bmd-label-floating">SEO Keyworks</label>
              <input type="text" class="form-control" name="seokeywork" required>
            </div>
          </div>
          <div class="col-12 col-md-6">
            <div class="box-seo">
              <div class="seo-header"><i class="fa fa-google"></i> Search Engine Optimization</div>
              <div class="seo-content">
                <div class="seo-title"></div>
                <div class="seo-url"></div>
                <div class="seo-desc"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-12 col-lg-4 col-xl-3">
    <div class="card">
      <div class="card-body">
        <div class="togglebutton">
          <label>
            <input type="checkbox" name="status" <?php echo ($setting["post_defaultstatus"] == "publish") ? "checked" : "" ?>>
            Publish <span class="toggle"></span>
          </label>
        </div>
        <div>Publish on: <b class='font-weight-bold'><?= get_date_now() ?></b></div>
      </div>
      <div class="card-footer justify-content-end">
        <button type='submit' class='btn btn-success' name="ok">Đồng ý</button>
      </div>
    </div>
    <div class="card">
      <div class="card-header card-header-rose card-header-text">
        <div class="card-text">
          <h4 class="card-title">Chuyên mục</h4>
        </div>
      </div>
      <div class="card-body">
        <div class="card-over card-form-check" data-cat-find>
        <?php
        foreach ($cat['chuyen-muc'] as $item) {
        ?>
          <div class="form-check">
            <label class="form-check-label">
              <input class="form-check-input" name="chuyenmuc[]" type="checkbox" value="<?php echo $item['id'] ?>">
              <?php echo $item['cat_name'] ?>
              <span class="form-check-sign"><span class="check"></span></span>
            </label>
          </div>
        <?php
        }
        ?>
        </div>
        <input type="text" class="input-find" data-input-find>
      </div>
    </div>
    <div class="card">
      <div class="card-header card-header-rose card-header-text">
        <div class="card-text">
          <h4 class="card-title">Tác giả</h4>
        </div>
      </div>
      <div class="card-body">
        <div class="card-over card-form-check" data-cat-find>
        <?php
        foreach ($cat['tac-gia'] as $item) {
        ?>
          <div class="form-check">
            <label class="form-check-label">
              <input class="form-check-input" name="tacgia[]" type="checkbox" value="<?php echo $item['id'] ?>">
              <?php echo $item['cat_name'] ?>
              <span class="form-check-sign"><span class="check"></span></span>
            </label>
          </div>
        <?php
        }
        ?>
        </div>
        <input type="text" class="input-find" data-input-find>
      </div>
    </div>
    <div class="card">
      <div class="card-header card-header-rose card-header-text">
        <div class="card-text">
          <h4 class="card-title">Bảng chữ cái</h4>
        </div>
      </div>
      <div class="card-body">
        <div class="card-over card-form-check" data-cat-find>
        <?php
        foreach ($cat['bang-chu-cai'] as $item) {
        ?>
          <div class="form-check">
            <label class="form-check-label">
              <input class="form-check-input" name="bangchucai[]" type="checkbox" value="<?php echo $item['id'] ?>">
              <?php echo $item['cat_name'] ?>
              <span class="form-check-sign"><span class="check"></span></span>
            </label>
          </div>
        <?php
        }
        ?>
        </div>
        <input type="text" class="input-find" data-input-find>
      </div>
    </div>
    <div class="card">
        <div class="card-header card-header-rose card-header-text">
          <div class="card-text">
            <h4 class="card-title">Điệu bài hát</h4>
          </div>
        </div>
        <div class="card-body">
          <div class="card-over card-form-check" data-cat-find>
          <?php
          foreach ($cat['dieu-bai-hat'] as $item) {
          ?>
            <div class="form-check">
              <label class="form-check-label">
                <input class="form-check-input" name="dieubaihat[]" type="checkbox" value="<?php echo $item['id'] ?>">
                <?php echo $item['cat_name'] ?>
                <span class="form-check-sign"><span class="check"></span></span>
              </label>
            </div>
          <?php
          }
          ?>
          </div>
          <input type="text" class="input-find" data-input-find>
        </div>
    </div>
  </div>
</div>
</form>
</div>
<script src="<?php echo base_url('tmp/js/ckeditor5/ckeditor.js'); ?>"></script>
<script>
ClassicEditor
  .create( document.querySelector( '#editor' ) )
  .catch( error => {
      console.error( error );
  });
</script>