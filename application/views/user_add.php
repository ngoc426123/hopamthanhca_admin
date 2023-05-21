<?php
if (isset($alert)) {
	print_alert($alert);
}
?>
<div class="row justify-content-center">
	<div class="col-12 col-md-6">
		<form action="<?php echo base_url("user?action=add") ?>" method="post">
			<div class="card">
				<div class="card-header card-header-rose card-header-text">
					<div class="card-text">
						<h4 class="card-title">Thông tin thành viên</h4>
					</div>
					<div class="pull-right">
						<div class="togglebutton">
							<label>
								<input type="checkbox" name="checkadmin"><span class="toggle"></span> Admin
							</label>
						</div>
					</div>
				</div>
				<div class="card-body">
					<div class="form-group bmd-form-group">
						<label class="bmd-label-floating">Tài khoản</label>
						<input type="text" class="form-control" name="username" required>
					</div>
					<div class="form-group bmd-form-group">
						<label class="bmd-label-floating">Họ tên</label>
						<input type="text" class="form-control" name="name" required>
					</div>
					<div class="form-group bmd-form-group">
						<label class="bmd-label-floating">Tên hiển thị</label>
						<input type="text" class="form-control" name="displayname" required>
					</div>
					<div class="form-group bmd-form-group">
						<label class="bmd-label-floating">Gmail</label>
						<input type="text" class="form-control" autocomplete="off" name="email" required>
					</div>
					<div class="form-group">
						<button type="button" class="btn btn-info btn-sm btnCreatePassword">Tạo mật khẩu<div class="ripple-container"></div>
							<div class="ripple-container"></div>
						</button>
					</div>
					<div class="form-group bmd-form-group">
						<label class="bmd-label-floating">Mật khẩu</label>
						<input type="password" class="form-control" name="password" required>
					</div>
					<div class="form-group clearfix">
						<div class="pull-right">
							<button class="btn btn-success" name="ok">Đồng ý<div class="ripple-container"></div>
								<div class="ripple-container"></div>
							</button>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>