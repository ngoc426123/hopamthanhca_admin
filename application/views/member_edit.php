<?php 
if (isset($alert)) {
    print_alert($alert);
}
?>
<div class="row justify-content-center">
	<div class="col-12 col-md-6">
		<div class="card">
			<div class="card-header card-header-rose card-header-text">
				<div class="card-text">
					<h4 class="card-title">Thông tin thành viên</h4>
				</div>
			</div>
			<div class="card-body">
				<form action="<?php echo base_url("member?action=updateprofile&id={$id}") ?>" method="post" id="formUser">
					<div class="form-group bmd-form-group">
						<label class="bmd-label-floating">Tài khoản</label>
						<input type="text" class="form-control" name="username" value="<?php echo $user["username"] ?>" disabled>
					</div>
					<div class="form-group bmd-form-group">
						<label class="bmd-label-floating">Họ tên</label>
						<input type="text" class="form-control" name="name" value="<?php echo $user["name"] ?>" required>
					</div>
					<div class="form-group bmd-form-group">
						<label class="bmd-label-floating">Tên hiển thị</label>
						<input type="text" class="form-control" name="displayname" value="<?php echo $user["displayname"] ?>" required>
					</div>
					<div class="form-group bmd-form-group">
						<label class="bmd-label-floating">Gmail</label>
						<input type="text" class="form-control" autocomplete="off" name="email" value="<?php echo $user["email"] ?>" required>
					</div>
					
					<div class="form-group clearfix">
						<div class="pull-right">
							<button type="submit" name="ok" class="btn btn-success">Đồng ý<div class="ripple-container"></div><div class="ripple-container"></div></button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>