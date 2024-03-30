<?php
	if (isset($alert)) {
		print_alert($alert);
	}
	$post_defaultcategory = unserialize($setting["post_defaultcategory"]);
?>
<ul class="nav nav-pills nav-pills-warning nav-pills-icons justify-content-center" role="tablist">
	<li class="nav-item">
		<a class="nav-link <?php echo $tab == "config" ? "active" : "" ?>" data-toggle="tab" href="#config" role="tablist">
			<i class="material-icons">home</i> <span class='d-none d-lg-block'>Cấu hình</span>
		</a>
	</li>
	<li class="nav-item">
		<a class="nav-link <?php echo $tab == "default-cat" ? "active" : "" ?>" data-toggle="tab" href="#default-cat" role="tablist">
			<i class="material-icons">storage</i> <span class='d-none d-lg-block'>Mặc định</span>
		</a>
	</li>
	<li class="nav-item">
		<a class="nav-link <?php echo $tab == "social" ? "active" : "" ?>" data-toggle="tab" href="#social" role="tablist">
			<i class="material-icons">share</i> <span class='d-none d-lg-block'>Mạng xã hội</span>
		</a>
	</li>
	<li class="nav-item">
		<a class="nav-link <?php echo $tab == "cache" ? "active" : "" ?>" data-toggle="tab" href="#cache" role="tablist">
			<i class="material-icons">cached</i> <span class='d-none d-lg-block'>Bộ nhớ đệm</span>
		</a>
	</li>
</ul>
<div class="tab-content tab-space tab-subcategories">
	<div class="tab-pane <?php echo $tab == "config" ? "active" : "" ?>" id="config">
		<form action="<?php echo base_url("/config?action=setting&tab=config") ?>" method="post" class="form-horizontal">
			<div class="card">
				<div class="card-body">
						<div class="row">
							<div class="col-lg-6">
								<div class="row">
									<label class="col-sm-4 col-form-label">Đường dẫn chính</label>
									<div class="col-sm-8">
										<div class="form-group bmd-form-group">
											<input type="text" name="site_url" class="form-control" value="<?php echo $setting["site_url"] ?>">
										</div>
									</div>
								</div>
								<div class="row">
									<label class="col-sm-4 col-form-label">Trang chủ</label>
									<div class="col-sm-8">
										<div class="form-group bmd-form-group">
											<input type="text" name="home_url" class="form-control" value="<?php echo $setting["home_url"] ?>">
										</div>
									</div>
								</div>
								<div class="row">
									<label class="col-sm-4 col-form-label">Tiêu đề Trang web</label>
									<div class="col-sm-8">
										<div class="form-group bmd-form-group">
											<input type="text" name="title" class="form-control" value="<?php echo $setting["title"] ?>">
										</div>
									</div>
								</div>
								<div class="row">
									<label class="col-sm-4 col-form-label">Từ khoá</label>
									<div class="col-sm-8">
										<div class="form-group bmd-form-group">
											<input type="text" name="keywork" class="form-control" value="<?php echo $setting["keywork"] ?>">
										</div>
									</div>
								</div>
								<div class="row">
									<label class="col-sm-4 col-form-label">Giới thiệu</label>
									<div class="col-sm-8">
										<div class="form-group bmd-form-group">
											<input type="text" name="desc" class="form-control" value="<?php echo $setting["desc"] ?>">
										</div>
									</div>
								</div>
								<div class="row">
									<label class="col-sm-4 col-form-label">Favicon</label>
									<div class="col-sm-8">
										<div class="form-group bmd-form-group">
											<input type="text" name="favicon" class="form-control" value="<?php echo $setting["favicon"] ?>">
										</div>
									</div>
								</div>
								<div class="row">
									<label class="col-sm-4 col-form-label">Email</label>
									<div class="col-sm-8">
										<div class="form-group bmd-form-group">
											<input type="text" name="email" class="form-control" value="<?php echo $setting["email"] ?>">
										</div>
									</div>
								</div>
								<div class="row">
									<label class="col-sm-4 col-form-label">Phone</label>
									<div class="col-sm-8">
										<div class="form-group bmd-form-group">
											<input type="text" name="phonenumber" class="form-control" value="<?php echo $setting["phonenumber"] ?>">
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="row">
									<label class="col-sm-4 col-form-label label-checkbox">Định dạng ngày tháng</label>
									<div class="col-sm-8 checkbox-radios">
										<?php
										$arr_date_format = [
											"dd/mm/yyyy" => "24/10/1993",
											"mm/dd/yyyy" => "10/24/1993",
											"yyyy/dd/mm" => "1993/10/24",
											"dd-mm-yyyy" => "24-10-1993",
											"mm-dd-yyyy" => "10-24-1993",
											"yyyy-dd-mm" => "1993-10-24",
										];
										foreach ($arr_date_format as $key => $value) {
										?>
											<div class="form-check">
												<label class="form-check-label">
													<input
														class="form-check-input"
														type="radio"
														name="dateformat"
														value="<?php echo $key ?>"
														<?php echo ($setting["dateformat"] == $key ? "checked" : "") ?>
													/>
													<?php echo $value ?>
													<span class="circle"><span class="check"></span></span>
												</label>
											</div>
										<?php
										}
										?>

									</div>
								</div>
								<div class="row">
									<label class="col-sm-4 col-form-label label-checkbox">Định dạng thòi gian</label>
									<div class="col-sm-8 checkbox-radios">
										<?php
										$arr_date_format = [
											"H:s" => "0:19",
											"HH:ss" => "00:19",
											"h:ss a" => "2:19 am",
											"hh:ss a" => "02:19 am",
										];
										foreach ($arr_date_format as $key => $value) {
										?>
											<div class="form-check">
												<label class="form-check-label">
													<input
														class="form-check-input"
														type="radio"
														name="timeformat"
														value="<?php echo $key ?>"
														<?php echo ($setting["timeformat"] == $key ? "checked" : "") ?>
													/>
													<?php echo $value ?>
													<span class="circle"><span class="check"></span></span>
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
				<div class="card-footer text-right">
					<div class="mr-auto"></div>
					<button type='submit' class='btn btn-success' name="update">Đồng ý</button>
				</div>
			</div>
		</form>
	</div>
	<div class="tab-pane <?php echo $tab == "default-cat" ? "active" : "" ?>" id="default-cat">
		<form action="<?php echo base_url("/config?action=setting&tab=default-cat") ?>" method="post" class="form-horizontal">
			<div class="card">
				<div class="card-body">
					<div class="row justify-content-center">
						<div class="col-lg-7">
							<div class="row">
								<label class="col-sm-4 col-form-label">Trạng thái mặc định</label>
								<div class="col-sm-8">
									<div class="form-group bmd-form-group">
										<select name="post_defaultstatus" class="selectpicker" data-style="btn btn-primary btn-round">
											<option value="publish" >Publish</option>
											<option value="private" <?php echo ($setting["post_defaultstatus"] == "private") ? "selected" : "" ?>>Private</option>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<label class="col-sm-4 col-form-label">Chuyên mục mặc định</label>
								<div class="col-sm-8">
									<div class="form-group bmd-form-group">
										<select name="post_defaultcategory[chuyen-muc]" class="selectpicker" data-style="btn btn-primary btn-round">
											<?php
											foreach ($cat['chuyen-muc'] as $item) {
												$checked = ($item['id'] == $post_defaultcategory['chuyen-muc']) ? "selected" : "";
											?>
												<option value="<?php echo $item['id'] ?>" <?php echo $checked ?>><?php echo $item['cat_name'] ?></option>
											<?php
											}
											?>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<label class="col-sm-4 col-form-label">Tác giả mặc định</label>
								<div class="col-sm-8">
									<div class="form-group bmd-form-group">
										<select name="post_defaultcategory[tac-gia]" class="selectpicker" data-style="btn btn-primary btn-round">
											<?php
											foreach ($cat['tac-gia'] as $item) {
												$checked = ($item['id'] == $post_defaultcategory['tac-gia']) ? "selected" : "";
											?>
												<option value="<?php echo $item['id'] ?>" <?php echo $checked ?>><?php echo $item['cat_name'] ?></option>
											<?php
											}
											?>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<label class="col-sm-4 col-form-label">Chữ cái mặc định</label>
								<div class="col-sm-8">
									<div class="form-group bmd-form-group">
										<select name="post_defaultcategory[bang-chu-cai]" class="selectpicker" data-style="btn btn-primary btn-round">
											<?php
											foreach ($cat['bang-chu-cai'] as $item) {
												$checked = ($item['id'] == $post_defaultcategory['bang-chu-cai']) ? "selected" : "";
											?>
												<option value="<?php echo $item['id'] ?>" <?php echo $checked ?>><?php echo $item['cat_name'] ?></option>
											<?php
											}
											?>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<label class="col-sm-4 col-form-label">Điệu mặc định</label>
								<div class="col-sm-8">
									<div class="form-group bmd-form-group">
										<select name="post_defaultcategory[dieu-bai-hat]" class="selectpicker" data-style="btn btn-primary btn-round">
											<?php
											foreach ($cat['dieu-bai-hat'] as $item) {
												$checked = ($item['id'] == $post_defaultcategory['dieu-bai-hat']) ? "selected" : "";
											?>
												<option value="<?php echo $item['id'] ?>" <?php echo $checked ?>><?php echo $item['cat_name'] ?></option>
											<?php
											}
											?>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<label class="col-sm-4 col-form-label">Năm phụng vụ mặc định</label>
								<div class="col-sm-8">
									<div class="form-group bmd-form-group">
										<select name="post_defaultcategory[nam-phung-vu]" class="selectpicker" data-style="btn btn-primary btn-round">
											<?php
											foreach ($cat['nam-phung-vu'] as $item) {
												$checked = $item['id'] == $post_defaultcategory['nam-phung-vu'] ? "selected" : "";
											?>
												<option value="<?php echo $item['id'] ?>" <?php echo $checked ?>><?php echo $item['cat_name'] ?></option>
											<?php
											}
											?>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer text-right">
					<div class="mr-auto"></div>
					<button type='submit' class='btn btn-success' name="update">Đồng ý</button>
				</div>
			</div>
		</form>
	</div>
	<div class="tab-pane <?php echo $tab == "social" ? "active" : "" ?>" id="social">
		<form action="<?php echo base_url("/config?action=setting&tab=social") ?>" method="post" class="form-horizontal">
			<div class="card">
				<div class="card-body">
					<div class="row justify-content-center">
						<div class="col-lg-7">
							<div class="row">
								<label class="col-sm-4 col-form-label">Facebook</label>
								<div class="col-sm-8">
									<div class="form-group bmd-form-group">
										<input
											type="text"
											name="social_facebook"
											class="form-control"
											value="<?php echo isset($setting["social_facebook"]) ? $setting["social_facebook"] : '' ?>"
										/>
									</div>
								</div>
							</div>
							<div class="row">
								<label class="col-sm-4 col-form-label">Youtube</label>
								<div class="col-sm-8">
									<div class="form-group bmd-form-group">
										<input
											type="text"
											name="social_youtube"
											class="form-control"
											value="<?php echo isset($setting["social_youtube"]) ? $setting["social_youtube"] : '' ?>"
										/>
									</div>
								</div>
							</div>
							<div class="row">
								<label class="col-sm-4 col-form-label">Twitter</label>
								<div class="col-sm-8">
									<div class="form-group bmd-form-group">
										<input
											type="text"
											name="social_twitter"
											class="form-control"
											value="<?php echo isset($setting["social_twitter"]) ? $setting["social_youtube"] : '' ?>"
										/>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer text-right">
					<div class="mr-auto"></div>
					<button type='submit' class='btn btn-success' name="update">Đồng ý</button>
				</div>
			</div>
		</form>
	</div>
	<div class="tab-pane <?php echo $tab == "cache" ? "active" : "" ?>" id="cache">
		<form action="<?php echo base_url("/config?action=setting&tab=cache") ?>" method="post" class="form-horizontal">
			<div class="card">
				<div class="card-body">
					<div class="row justify-content-center">
						<div class="col-lg-7">
							<div class="row">
								<label class="col-sm-4 col-form-label">Giá trị lưu trữ</label>
								<div class="col-sm-8">
									<div class="row">
										<div class="col-9">
											<div class="form-group bmd-form-group">
												<input type="text" name="cache_value" class="form-control" value="<?php echo isset($setting["cache_value"]) ? $setting["cache_value"] : '' ?>">
											</div>
										</div>
										<div class="col-3">
											<select name="cache_unit" class="selectpicker" data-style="btn btn-primary btn-round">
												<option value="hours" <?php echo isset($setting["cache_unit"]) && $setting["cache_unit"] === 'hours' ? 'selected' : '' ?>>Giờ</option>
												<option value="days" <?php echo isset($setting["cache_unit"]) && $setting["cache_unit"] === 'days' ? 'selected' : '' ?>>Ngày</option>
												<option value="weeks" <?php echo isset($setting["cache_unit"]) && $setting["cache_unit"] === 'weeks' ? 'selected' : '' ?>>Tuần</option>
												<option value="months" <?php echo isset($setting["cache_unit"]) && $setting["cache_unit"] === 'months' ? 'selected' : '' ?>>Tháng</option>
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer text-right">
					<div class="mr-auto"></div>
					<button class="btn btn-primary" data-clear-cache="admin" type="button">
						<i class="material-icons">cleaning_services</i> Admin
					</button>
					<button class="btn btn-primary" data-clear-cache="site" type="button">
						<i class="material-icons">cleaning_services</i> Site
					</button>
					<button type='submit' class='btn btn-success' name="update">Đồng ý</button>
				</div>
			</div>
		</form>
	</div>
</div>