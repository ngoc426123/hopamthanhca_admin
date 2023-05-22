<?php
if (isset($alert)) {
  print_alert($alert);
}
?>
<div data-weekly-add>
  <form action="<?php echo base_url("song?action=add"); ?>" method="post">
    <div class="row">
      <div class="col-12">
        <div class="form-group bmd-form-group">
          <label class="bmd-label-floating">Tên thánh lễ</label>
          <input type="text" class="form-control" id="songTitle" name="title" value='' required data-song-title>
        </div>
      </div>
      <div class="col-12 col-lg-8 col-xl-9">
        <div class="card" data-card-phase>
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
              <input class="form-check-input" name="chuyenmuc[]" type="checkbox" value="<?php echo $item['id'] ?>"> <?php echo $item['cat_name'] ?>
              <span class="form-check-sign"><span class="check"></span></span>
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
</div>