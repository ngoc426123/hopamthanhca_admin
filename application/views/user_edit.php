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
				<div class="pull-right">
					<div class="togglebutton">
						<label>
							<input form="formUser" type="checkbox" name="checkadmin" <?php echo ($user["permission"]==1) ? "checked" : "" ?>><span class="toggle"></span> Admin
						</label> 
					</div>
				</div>
			</div>
			<div class="card-body">
				<form action="<?php echo base_url("user?action=update&id={$id}") ?>" method="post" id="formUser">
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
				<div class="form-check mr-auto">
					<label class="form-check-label">
						<input class="form-check-input" type="checkbox" name="checkChangePass" id="changePassword" form="formUser"> Thay mật khẩu
						<span class="form-check-sign">
							<span class="check"></span>
						</span>
					</label>
				</div>
				<div id="divChangePass" style="display: none">
					<div class="form-group">
						<button type="button" class="btn btn-info btn-sm">Tạo mật khẩu<div class="ripple-container"></div><div class="ripple-container"></div></button>
					</div>
					<div class="form-group bmd-form-group">
						<label class="bmd-label-floating">Mật khẩu mới</label>
						<input type="password" class="form-control" name="password" form="formUser">
					</div>
					<div class="form-group bmd-form-group">
						<label class="bmd-label-floating">Nhập lại mật khẩu</label>
						<input type="password" class="form-control" name="passwordAgain" form="formUser">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>