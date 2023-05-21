<div class="card">
	<div class="card-header">
		<div class="pull-right">
			<a href="<?php echo base_url("database/backup"); ?>" class="btn btn-success">Backup Database<div class="ripple-container"></div></a>
		</div>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table text-nowrap">
				<thead class="text-info">
					<tr>
						<th>Tên bảng</th>
						<th>Trường</th>
						<th>Số lượng record</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach ($list_tables as $key => $value) {
					?>
						<tr>
							<td><?php echo $key; ?></td>
							<td>
								<?php
								foreach ($value["field"] as $k => $v) {
								?>
									<small><?php echo $v; ?></small>,
								<?php
								}
								?>
							</td>
							<td><?php echo fmt_number($value["record"]); ?></td>
							<td class="td-actions text-right">
								<a href="<?php echo base_url("database/emptytable/{$key}"); ?>" class="btn btn-sm btn-rose"><i class="fa fa-times"></i></a>
								<a href="<?php echo base_url("database/optimizetable/{$key}"); ?>" class="btn btn-sm btn-primary"><i class="fa fa-repeat"></i></a>
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