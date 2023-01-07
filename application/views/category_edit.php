<?php
if (isset($alert)) {
	print_alert($alert);
}
?>
<div class="card">
	<div class="card-body">
		<div class="row justify-content-center">
			<div class="col-12 col-md-7">
				<form action="<?php echo base_url("category?slug={$slug}&action=update&id={$cat['id']}"); ?>" method="post">
					<div class="row">
						<label class="col-sm-2 col-form-label">Tiêu đề</label>
						<div class="col-sm-10">
							<div class="form-group bmd-form-group">
								<input class="form-control" type="text" name="name" required value='<?php echo $cat['cat_name'] ?>'>
							</div>
						</div>
					</div>
					<div class="row">
						<label class="col-sm-2 col-form-label">Ghi chú</label>
						<div class="col-sm-10">
							<div class="form-group bmd-form-group">
								<textarea class="form-control" type="text" name="des"><?php echo $cat['cat_des'] ?></textarea>
							</div>
						</div>
					</div>
					<div class="form-group clearfix">
						<div class="pull-right">
							<button type='button' id="update_meta_seo_cat" class="btn btn-rose btn-sm"><i class="material-icons">file_copy</i>
								<div class="ripple-container"></div>
								<div class="ripple-container"></div>
							</button>
						</div>
					</div>
					<div class="row">
						<label class="col-sm-2 col-form-label">SEO Tiêu đề</label>
						<div class="col-sm-10">
							<div class="form-group bmd-form-group">
								<input class="form-control" type="text" name="seotitle" required value='<?php echo $cat['meta']['seotitle'] ?>'>
								<small>Tiêu đề này được dùng để hiển thị trên google</small>
							</div>
						</div>
					</div>
					<div class="row">
						<label class="col-sm-2 col-form-label">SEO Đường dẫn</label>
						<div class="col-sm-10">
							<div class="form-group bmd-form-group">
								<input class="form-control" type="text" name="seourl" required value='<?php echo $cat['meta']['seourl'] ?>'>
								<small>Đường dẫn này được dùng để hiển thị ngoài google</small>
							</div>
						</div>
					</div>
					<div class="row">
						<label class="col-sm-2 col-form-label">SEO keywork</label>
						<div class="col-sm-10">
							<div class="form-group bmd-form-group">
								<input class="form-control" type="text" name="seokeywork" required value='<?php echo $cat['meta']['seokeywork'] ?>'>
								<small>Keywork được hiển thị ngoài web, dùng dấu , để ngăn cách giữa các keywork</small>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-sm-2"></div>
							<div class="col-sm-10">
								<div class="box-seo">
									<div class="seo-header"><i class="fa fa-google"></i> Search Engine Optimization</div>
									<div class="seo-content">
										<div class="seo-title" id="seo-title"><?php echo $cat['meta']['seotitle'] ?></div>
										<div class="seo-url" id="seo-url">http://hopamthanhca.com/danh-muc/<?php echo $cat['meta']['seourl'] ?></div>
										<div class="seo-desc"><?php echo $cat['meta']['seokeywork'] ?></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group clearfix">
						<div class="pull-right">
							<button type="submit" name="ok" class="btn btn-success">Đồng ý<div class="ripple-container"></div>
								<div class="ripple-container"></div>
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>