<?php 
// pr($list_weekly);
?>
<div class="card">
  <div class="card-header card-header-rose card-header-text">
    <div class="card-text">
      <h4 class="card-title">Danh sách soạn</h4>
    </div>
    <div class="pull-right d-flex">
      <form action="<?php echo base_url("song"); ?>" method="GET" style="margin-right: 20px">
        <div class="form-group bmd-form-group">
          <input type="hidden" name="action" value="search">
          <input type="text" class="form-control" name="keyword" placeholder="Tìm kiếm">
        </div>
      </form>
      <a href="<?php echo base_url("weekly?action=add") ?>" class="btn btn-success">Thêm<div class="ripple-container"></div></a>
    </div>
  </div>
  <div class="card-body">
    <input type="hidden" id="url" value="<?php echo current_url()."?".$_SERVER['QUERY_STRING']; ?>">
    <div class="table-responsive">
      <table class="table text-nowrap">
        <thead class="text-info">
          <tr>
            <th>ID</th>
            <th>Lễ</th>
            <th>Năm phụng vụ</th>
            <th>Ngày</th>
            <th>Ghi chú</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
        <?php
        if (isset($list_weekly) && count($list_weekly) > 0) {
          foreach ($list_weekly as $weekly) {
          ?>
            <tr>
              <td><?php echo $weekly["id"]; ?></td>
              <td><a href="<?php echo base_url("weekly?action=edit&id={$weekly["id"]}"); ?>"><?php echo $weekly["name"]; ?></a></td>
              <td><?php echo $weekly["cat"]["nam-phung-vu"][0]["cat_name"]; ?></td>
              <td>
                <div><?php echo $weekly["status"]; ?></div>
                <small><?php echo $weekly["date"]; ?></small>
              </td>
              <td><?php echo $weekly["note"]; ?></td>
              <td class="td-actions text-right">
                <a href="<?php echo "http://hopamthanhca.com/thanh-ca-hang-tuan/{$weekly["slug"]}" ?>" rel="tooltip" class="btn btn-info"><i class="material-icons">visibility</i></a>
                <button data-id="<?php echo $weekly["id"] ?>" el="tooltip" class="btn btn-danger btn-remove-weekly"><i class="material-icons">restore_from_trash</i></button>
              </td>
            </tr>
          <?php
          }
        }
        ?>
        </tbody>
      </table>
    </div>
  </div>
  <?php 
  if ( isset($pagination_weekly) ) {
  ?>
  <div class="card-footer justify-content-end">
    <nav>
      <ul class="pagination pagination-primary">
      <?php
      foreach ($pagination_weekly as $value) {
      ?>
        <li class="page-item <?php echo ($value['active']===1)?'active':'' ?>"><a class="page-link" href="<?php echo $value['link'] ?>"><?php echo $value['number'] ?></a></li>
      <?php
      }
      ?>
      </ul>
    </nav>
  </div>
  <?php
  }
  ?>
</div>