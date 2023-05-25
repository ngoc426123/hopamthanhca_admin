<?php
if (isset($alert)) {
  print_alert($alert);
}
?>
<div data-weekly-add>
  <form action="<?php echo base_url("weekly?action=add"); ?>" method="post">
    <div class="row">
      <div class="col-12">
        <div class="form-group bmd-form-group">
          <label class="bmd-label-floating">Tên lễ</label>
          <input type="text" class="form-control" id="weeklyTitle" name="title" value='Chúa nhật I  - Mùa thường niên' required data-song-title>
        </div>
      </div>
      <div class="col-12 col-lg-8 col-xl-9">
        <div class="card">
          <div class="card-body">
            <div class="form-group d-flex justify-content-end">
              <select class="selectpicker" data-style="btn btn-primary" title="Single Select" data-select-phase>
                <option selected value="0">Thêm phần hát</option>
                <?php
                foreach ($cat["phan-hat"] as $key => $value) {
                ?>
                  <option value="<?php echo $value["id_cat"] ?>" data-slug="<?php echo $value["cat_slug"] ?>"><?php echo $value["cat_name"] ?></option>
                <?php
                }
                ?>
              </select>
            </div>
            <div data-content-phase></div>
          </div>
        </div>
        <div class="card">
          <div class="card-header card-header-rose card-header-text">
            <div class="card-text">
              <h4 class="card-title">Meta</h4>
            </div>
          </div>
          <div class="card-body">
            <div class="form-group bmd-form-group">
              <label class="bmd-label-floating">Miêu tả</label>
              <input type="text" class="form-control" name='excerpt'>
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
            <div>Publish on: <b class='font-weight-bold'>15/20/2020</b></div>
          </div>
          <div class="card-footer justify-content-end">
            <button type='submit' class='btn btn-success' name="ok">Đồng ý</button>
          </div>
        </div>
        <div class="card">
      <div class="card-header card-header-rose card-header-text">
        <div class="card-text">
          <h4 class="card-title">Năm phụng vụ</h4>
        </div>
      </div>
      <div class="card-body">
        <div class="card-form-check">
        <?php
        foreach ($cat['nam-phung-vu'] as $item) {
        ?>
          <div class="form-check">
            <label class="form-check-label">
              <input class="form-check-input" name="chuyenmuc[]" type="radio" value="<?php echo $item['id'] ?>"> <?php echo $item['cat_name'] ?>
              <span class="circle"><span class="check"></span></span>
            </label>
          </div>
        <?php
        }
        ?>
        </div>
      </div>
    </div>
      </div>
    </div>
  </form>
  <div class="d-flex justify-content-end w-100 position-fixed top-0 bottom-0 start-0 end-0 zindex-1 pl-5 transition opacity-0 invisible bg-gr-black" data-popup-list-song>
    <div class="d-flex flex-column bg-white border-start border-color-1 w-100 max-w-sm h-100 position-relative transition transform-x-100" data-popup-inner>
      <button class='w-45 h-45 p-0 border-0 bg-transparent cursor-pointer position-absolute top-0 end-0 z-1' data-popup-close>
        <i class="d-block text-md material-icons">close</i>
      </button>
      <div class="form-group bmd-form-group py-3 mt-1">
        <input type="text" class="form-control pl-2" id="songTitle" name="title" value='' placeholder='Tên bài hát' required data-search-song>
      </div>
      <div class="lex-shrink-0 h-100 overflow-auto" data-list-song></div>
    </div>
  </div>
</div>

<style>
  .sidebar { display: none !important; }
</style>