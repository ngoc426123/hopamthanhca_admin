<?php 
if (isset($alert)) {
    print_alert($alert);
}
?>
<div class="row justify-content-center">
	<div class="col-12 col-md-6">
		<div class="card">
			<div class="card-body">
				<form action="<?php echo base_url("member?action=changepassword") ?>" method="post">
					<div class="form-group bmd-form-group">
						<label class="bmd-label-floating">Mật khẩu cũ</label>
						<input type="password" class="form-control" required name="passwordOld">
					</div>
					<div class="form-group">
						<button type="button" class="btn btn-info btn-sm btnCreatePassword">Tạo mật khẩu<div class="ripple-container"></div><div class="ripple-container"></div></button>
					</div>
					<div class="form-group bmd-form-group">
						<label class="bmd-label-floating">Mật khẩu mới</label>
						<input type="password" class="form-control" required name="password">
					</div>
					<div class="form-group bmd-form-group">
						<label class="bmd-label-floating">Nhập lại mật khẩu</label>
						<input type="password" class="form-control" required name="passwordAgain">
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