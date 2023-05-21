<?php
if (isset($alert)) {
	print_alert($alert);
}
?>
<div class="card">
	<div class="card-header card-header-rose card-header-text">
		<div class="card-text">
			<h4 class="card-title">Điều chỉnh</h4>
		</div>
	</div>
	<div class="card-body">
		<div class="row">
			<div class="col-12 col-lg-6">
				<form action="<?php echo base_url('config?action=maintain') ?>" method="post">
					<div class="row">
						<label class="col-sm-2 col-form-label">Trạng thái</label>
						<div class="col-sm-10">
							<div class="form-check">
								<label class="form-check-label">
									<input class="form-check-input" type="radio" name="status" value="0" <?php echo $maintain["status"] == "0" ? "checked" : "" ?>> Tắt
									<span class="circle"><span class="check"></span></span>
								</label>
							</div>
							<div class="form-check">
								<label class="form-check-label">
									<input class="form-check-input" type="radio" name="status" value="1" <?php echo $maintain["status"] == "1" ? "checked" : "" ?>> Bật
									<span class="circle"><span class="check"></span></span>
								</label>
							</div>
						</div>
					</div>
					<div class="row">
						<label class="col-sm-2 col-form-label">Tiêu đề</label>
						<div class="col-sm-10">
							<div class="form-group bmd-form-group"><input type="text" name="title" class="form-control" value="<?php echo $maintain["title"] ?>"></div>
						</div>
					</div>
					<div class="row">
						<label class="col-sm-2 col-form-label">Nội dung</label>
						<div class="col-sm-10">
							<div class="form-group bmd-form-group"><textarea type="text" name="content" class="form-control" style="height: 100px !important"><?php echo $maintain["content"] ?></textarea></div>
						</div>
					</div>
					<div class="row">
						<label class="col-sm-2 col-form-label">Background</label>
						<div class="col-sm-10">
							<div class="form-group bmd-form-group"><input type="text" name="background" class="form-control" value="<?php echo $maintain["background"] ?>"></div>
						</div>
					</div>
					<div class="clearfix">
						<div class="pull-right">
							<button type='submit' class='btn btn-success' name="update">Đồng ý</button>
						</div>
					</div>
					<div class="text-right">
						<small>Bấm đồng ý để thấy sự thay đổi về nội dung</small>
					</div>
				</form>
			</div>
			<div class="col-12 col-lg-6">
				<div class="demoMaintain" style="background-image: url(<?php echo $maintain["background"] ?>)">
					<div class="wrap">
						<div class="title"><?php echo $maintain["title"] ?></div>
						<div class="content"><?php echo $maintain["content"] ?></div>
						<div class="social">
							<ul>
								<li><a href="https://www.facebook.com/hopamthanhca/" target="_blank"><i class="fa fa-facebook"></i></a></li>
								<li><a href=""><i class="fa fa-google"></i></a></li>
								<li><a href=""><i class="fa fa-youtube"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>