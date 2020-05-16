<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header card-header-rose card-header-text">
                <div class="card-text">
                    <h4 class="card-title">Danh sách thành viên</h4>
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
                            <tr>
                                <td>1</td>
                                <td>
                                    <div>Hoàng Minh Ngọc</div>
                                    <div class="togglebutton">
                                        <label><input type="checkbox" checked>Admin: <span class="toggle"></span></label>
                                    </div>
                                </td>
                                <td>Minhngoc.ith</td>
                                <td>admin</td>
                                <td>**************** <a href="">Chang</a></td>
                                <td>minhngoc.ith@gmail.com</td>
                                <td>2020/10/5 15:58:00</td>
                                <td class="td-actions text-right">
                                    <a href="<?php echo base_url("user/edit") ?>" class="btn btn-success"><i class="material-icons">build</i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>
                                    <div>Nguyễn Anh Đức</div>
                                    <div class="togglebutton">
                                        <label><input type="checkbox">Admin: <span class="toggle"></span></label>
                                    </div>
                                </td>
                                <td>AnhduaVoluin</td>
                                <td>anhduc</td>
                                <td>**************** <a href="">Chang</a></td>
                                <td>anhduc1996@gmail.com</td>
                                <td>2020/10/5 15:58:00</td>
                                <td class="td-actions text-right">
                                    <a href="<?php echo base_url("user/edit") ?>" class="btn btn-success"><i class="material-icons">build</i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
	</div>
</div>