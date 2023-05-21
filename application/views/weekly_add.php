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
          <label class="bmd-label-floating">Tên thánh lễ</label>
          <input type="text" class="form-control" id="songTitle" name="title" value='' required data-song-title>
        </div>
      </div>
    </div>
  </form>
</div>