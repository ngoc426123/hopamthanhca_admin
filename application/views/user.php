<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header card-header-rose card-header-text">
				<div class="card-text">
					<h4 class="card-title">Danh sách thành viên</h4>
				</div>
				<div class="pull-right">
					<a href="<?php echo base_url("user?action=add") ?>" class="btn btn-success">Thêm thành viên<div class="ripple-container"></div></a>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table text-nowrap">
						<thead class="text-info">
							<tr>
								<th>ID</th>
								<th>Tên</th>
								<th>Tên hiển thị</th>
								<th>Username</th>
								<th>Password</th>
								<th>Email</th>
								<th>Ngày đăng ký</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach ($list_user as $key => $value) {
								$stt = $key++;
							?>
								<tr>
									<td><?php echo $stt; ?></td>
									<td>
										<div><?php echo $value["name"]; ?></div>
										<div class="togglebutton">
											<label>
												<input
													class="changePermission"
													type="checkbox"
													<?php echo ($value["permission"] == 1) ? "checked" : ""; ?>
													value="<?php echo $value["id"]; ?>"
												/>
													Admin: <span class="toggle"></span>
												</label>
										</div>
									</td>
									<td><?php echo $value["displayname"]; ?></td>
									<td><?php echo $value["username"]; ?></td>
									<td>
										<div>****************</div>
										<button class="btn btn-sm btn-success btnChangePass" value="<?php echo $value["id"]; ?>">Change</button>
									</td>
									<td><?php echo $value["username"]; ?></td>
									<td><?php echo $value["dateregister"]; ?></td>
									<td class="td-actions text-right">
										<a href="<?php echo base_url("user?action=edit&id={$value["id"]}") ?>" class="btn btn-success"><i class="material-icons">build</i></a>
									</td>
								</tr>
							<?php
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>