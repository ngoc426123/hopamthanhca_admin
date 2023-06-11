<?php 
// pr($list_song);
?>
<div class="card">
  <div class="card-header card-header-rose card-header-text">
    <div class="card-text">
      <h4 class="card-title">Danh sách bài hát</h4>
    </div>
    <div class="pull-right d-flex">
      <form action="<?php echo base_url("song"); ?>" method="GET" style="margin-right: 20px">
        <div class="form-group bmd-form-group">
          <input type="hidden" name="action" value="search">
          <input type="text" class="form-control" name="keyword" placeholder="Tìm kiếm">
        </div>
      </form>
      <a href="<?php echo base_url("song?action=add") ?>" class="btn btn-success">Thêm bài<div class="ripple-container"></div></a>
    </div>
  </div>
  <div class="card-body">
    <input type="hidden" id="url" value="<?php echo current_url()."?".$_SERVER['QUERY_STRING']; ?>">
    <div class="table-responsive">
      <table class="table text-nowrap">
        <thead class="text-info">
          <tr>
            <th>ID</th>
            <th>Bài hát</th>
            <th>Slug</th>
            <th>Lượt xem</th>
            <th>Ngày</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
        <?php
        if (isset($list_song) && count($list_song) > 0) {
          foreach ($list_song as $song) {
          ?>
            <tr>
              <td><?php echo $song["id"]; ?></td>
              <td><a href="<?php echo base_url("song?action=edit&id={$song["id"]}"); ?>"><?php echo $song["title"]; ?></a></td>
              <td><?php echo $song["slug"]; ?></td>
              <td><?php echo isset($song["meta"]["luotxem"])?fmt_number($song["meta"]["luotxem"]):"0"; ?></td>
              <td>
                <div><?php echo $song["status"]; ?></div>
                <small><?php echo $song["date"]; ?></small>
              </td>
              <td class="td-actions text-right">
                <?php
                  if ($this->session->permission == 1 || $this->session->id == $song["author"]) {
                ?>
                  <a href="#" class="btn btn-rose quickEdit" rel="tooltip" class="btn btn-rose"><i class="material-icons">edit</i></a>
                  <button data-id="<?php echo $song["id"] ?>" el="tooltip" class="btn btn-danger btn-remove-song"><i class="material-icons">restore_from_trash</i></button>
                <?php
                  }
                ?>
                <a href="<?php echo "http://hopamthanhca.com/bai-hat/{$song["slug"]}" ?>" rel="tooltip" class="btn btn-info"><i class="material-icons">visibility</i></a>
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
  if ( isset($pagination_song) ) {
  ?>
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
  <?php
  }
  ?>
</div>