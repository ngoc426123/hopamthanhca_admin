<?php 
if (isset($alert)) {
    print_alert($alert);
}
?>
<div class="row">
  <div class="col-12 col-md-6 col-lg-4">
    <form action="<?php echo base_url("category?slug={$slug}&action=add&page={$page}"); ?>" method='post'>
      <div class="form-group bmd-form-group">
        <label class="bmd-label-floating">Tiêu đề</label>
        <input type="text" class="form-control" name="name" required>
        <small>Tiêu đề danh mục ghi rõ ràng, hạn chế sử dụng các ký tự đặc biệt như , . ( { [ ` ' " ..vv.vv..</small>
      </div>
      <div class="form-group bmd-form-group">
        <label class="bmd-label-floating">Ghi chú</label>
        <textarea class="form-control" name="des"></textarea>
        <small>Ghi chú cho danh mục</small>
      </div>
      <div class="form-group clearfix">
        <div class="pull-right">
          <button type='button' id="update_meta_seo_cat" class="btn btn-rose btn-sm">
            <i class="material-icons">file_copy</i>
            <div class="ripple-container"></div>
            <div class="ripple-container"></div>
          </button>
        </div>
      </div>
      <div class="form-group bmd-form-group">
        <label class="bmd-label-floating">SEO Tiêu đề</label>
        <input type="text" class="form-control" name="seotitle" required>
        <small>Tiêu đề này được dùng để hiển thị trên google</small>
      </div>
      <div class="form-group bmd-form-group">
        <label class="bmd-label-floating">SEO Đường dẫn</label>
        <input type="text" class="form-control" name="seourl" required>
        <small>Đường dẫn này được dùng để hiển thị ngoài google</small>
      </div>
      <div class="form-group bmd-form-group">
        <label class="bmd-label-floating">SEO keywork</label>
        <input type="text" class="form-control" name="seokeywork" required>
        <small>Keywork được hiển thị ngoài web, dùng dấu , để ngăn cách giữa các keywork</small>
      </div>
      <div class="form-group">
        <div class="box-seo">
          <div class="seo-header"><i class="fa fa-google"></i> Search Engine Optimization</div>
          <div class="seo-content">
            <div class="seo-title" id="seo-title">Mùa thường niên</div>
            <div class="seo-url" id="seo-url">http://hopamthanhca.com/danh-muc/mua-thuong-nien</div>
          </div>
        </div>
      </div>
      <div class="form-group clearfix">
        <div class="pull-right">
          <button type="submit" name="ok" class="btn btn-success">Thêm danh mục<div class="ripple-container"></div><div class="ripple-container"></div></button>
        </div>
      </div>
    </form>
  </div>
  <div class="col-12 col-md-6 col-lg-8">
    <div class="card">
      <div class="card-header card-header-rose card-header-text">
        <div class="card-text">
          <h4 class="card-title">Danh mục</h4>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table text-nowrap">
            <thead class="text-info">
              <tr>
                <th>ID</th>
                <th>Danh mục</th>
                <th>Slug</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
            <?php
            // pr($list_cat);
            foreach ($list_cat as $key => $value) {
            ?>
              <tr>
                <td><?php echo $value['id_cat'] ?></td>
                <td><a href="<?php echo base_url("category?slug={$value['type_slug']}&action=edit&id={$value['id_cat']}") ?>"><?php echo $value['cat_name'] ?></a></td>
                <td><?php echo $value['cat_slug'] ?></td>
                <td class="td-actions text-right">
                  <a href="<?php echo base_url("category?slug={$value['type_slug']}&cat_id={$value['id_cat']}&page=1") ?>" rel="tooltip" class="btn btn-info">
                    <i class="material-icons">list</i>
                  </a>
                  <a href="<?php echo base_url("category?slug={$value['type_slug']}&action=edit&id={$value['id_cat']}") ?>" rel="tooltip" class="btn btn-success">
                    <i class="material-icons">build</i>
                  </a>
                </td>
              </tr>
            <?php
            }
            ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="card-footer justify-content-end">
        <nav>
          <ul class="pagination pagination-primary">
          <?php
          foreach ($pagination_song as $value) {
          ?>
            <li class="page-item <?php echo ($value['active']===1)?'active':'' ?>"><a class="page-link" href="<?php echo $value['link'] ?>"><?php echo $value['number'] ?></a></li>
          <?php
          }
          ?>
          </ul>
        </nav>
      </div>
    </div>
	</div>
</div>