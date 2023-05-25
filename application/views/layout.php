<!doctype html>
<html lang="en">

<head>
	<title>Admin -> <?php echo $page_title; ?></title>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo base_url("assets/css/material-dashboard.min.css"); ?>" />
	<link rel="stylesheet" href="<?php echo base_url("tmp/css/style.css"); ?>" />
</head>

<body>
	<div class="wrapper">
		<div class="sidebar" data-color="azure" data-background-color="black" data-image="../../assets/img/sidebar-1.jpg">
			<div class="logo">
				<a href="" class="simple-text logo-mini">HA</a>
				<a href="" class="simple-text logo-normal">Admin</a>
			</div>
			<div class="sidebar-wrapper">
				<div class="user">
					<div class="photo">
						<img src="<?php echo base_url("tmp/img/avatar_default.jpg") ?>">
					</div>
					<div class="user-info">
						<a data-toggle="collapse" href="#collapseExample" class="username" aria-expanded="true">
							<span><?php echo $this->session->displayname ?> <b class="caret"></b></span>
						</a>
						<div class="collapse show" id="collapseExample">
							<ul class="nav">
								<li class="nav-item">
									<a class="nav-link" href="<?php echo base_url("member?action=editprofile") ?>">
										<span class="sidebar-mini">IF</span>
										<span class="sidebar-normal">Thông tin</span>
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="<?php echo base_url("member?action=changepassword") ?>">
										<span class="sidebar-mini">PS</span>
										<span class="sidebar-normal">Thay mật khẩu</span>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<ul class="nav">
					<li class='nav-item <?php echo (isset($page_menu_index) && $page_menu_index == 1) ? 'active' : '' ?>'><a class="nav-link" href="<?php echo base_url("dashbroad") ?>"><i class="material-icons">dashboard</i>
							<p>Thống kê</p>
						</a></li>
					<li class="nav-item <?php echo (isset($page_menu_index) && $page_menu_index == 2) ? 'active' : '' ?>"><a class="nav-link" href="<?php echo base_url("song?page=1") ?>"><i class="material-icons">audiotrack</i>
							<p>Bài hát</p>
						</a></li>
					<li class="nav-item <?php echo (isset($page_menu_index) && (39 >= $page_menu_index && $page_menu_index >= 30)) ? 'active' : '' ?>">
						<a class="nav-link" href="#category-toggle" data-toggle="collapse"><i class="material-icons">storage</i>
							<p>Danh mục<b class="caret"></b></p>
						</a>
						<div class="collapse <?php echo (isset($page_menu_index) && (39 >= $page_menu_index && $page_menu_index >= 30)) ? 'show' : '' ?>" id="category-toggle">
							<ul class="nav">
								<li class="nav-item <?php echo (isset($page_menu_index) && $page_menu_index == 31) ? 'active' : '' ?>"><a href="<?php echo base_url("category?slug=chuyen-muc&page=1") ?>" class="nav-link"><span>Chuyên mục</span></a></li>
								<li class="nav-item <?php echo (isset($page_menu_index) && $page_menu_index == 32) ? 'active' : '' ?>"><a href="<?php echo base_url("category?slug=tac-gia&page=1") ?>" class="nav-link"><span>Tác giả</span></a></li>
								<li class="nav-item <?php echo (isset($page_menu_index) && $page_menu_index == 33) ? 'active' : '' ?>"><a href="<?php echo base_url("category?slug=bang-chu-cai&page=1") ?>" class="nav-link"><span>Bảng chữ cái</span></a></li>
								<li class="nav-item <?php echo (isset($page_menu_index) && $page_menu_index == 34) ? 'active' : '' ?>"><a href="<?php echo base_url("category?slug=dieu-bai-hat&page=1") ?>" class="nav-link"><span>Điệu</span></a></li>
							</ul>
						</div>
					</li>
					<li class="nav-item <?php echo (isset($page_menu_index) && (49 >= $page_menu_index && $page_menu_index >= 40)) ? 'active' : '' ?>">
						<a class="nav-link" href="#category-toggle-1" data-toggle="collapse"><i class="material-icons">audio_file</i>
							<p>Thánh ca hàng tuần<b class="caret"></b></p>
						</a>
						<div class="collapse <?php echo (isset($page_menu_index) && (49 >= $page_menu_index && $page_menu_index >= 40)) ? 'show' : '' ?>" id="category-toggle-1">
							<ul class="nav">
								<li class="nav-item <?php echo (isset($page_menu_index) && $page_menu_index == 41) ? 'active' : '' ?>"><a href="<?php echo base_url("weekly?page=1") ?>" class="nav-link"><span>Soạn bài hát</span></a></li>
								<li class="nav-item <?php echo (isset($page_menu_index) && $page_menu_index == 42) ? 'active' : '' ?>"><a href="<?php echo base_url("category?slug=phan-hat&page=1") ?>" class="nav-link"><span>Phần hát</span></a></li>
								<li class="nav-item <?php echo (isset($page_menu_index) && $page_menu_index == 43) ? 'active' : '' ?>"><a href="<?php echo base_url("category?slug=nam-phung-vu&page=1") ?>" class="nav-link"><span>Năm phụng vụ</span></a></li>
							</ul>
						</div>
					</li>
					<?php
					if (check_admin()) {
					?>
						<li class="nav-item <?php echo (isset($page_menu_index) && $page_menu_index == 4) ? 'active' : '' ?>"><a class="nav-link" href="<?php echo base_url("user") ?>"><i class="material-icons">supervisor_account</i>
								<p>Thành viên</p>
							</a></li>
						<li class="nav-item <?php echo (isset($page_menu_index) && $page_menu_index == 5) ? 'active' : '' ?>"><a class="nav-link" href="<?php echo base_url("database") ?>"><i class="material-icons">business_center</i>
								<p>Dữ liệu</p>
							</a></li>
						<li class="nav-item <?php echo (isset($page_menu_index) && (69 >= $page_menu_index && $page_menu_index >= 60)) ? 'active' : '' ?>">
							<a class="nav-link" href="#category-toggle-2" data-toggle="collapse"><i class="material-icons">build</i>
								<p>Cấu hình<b class="caret"></b></p>
							</a>
							<div class="collapse <?php echo (isset($page_menu_index) && (69 >= $page_menu_index && $page_menu_index >= 60)) ? 'show' : '' ?>" id="category-toggle-2">
								<ul class="nav">
									<li class="nav-item <?php echo (isset($page_menu_index) && $page_menu_index == 61) ? 'active' : '' ?>"><a href="<?php echo base_url("config?action=setting") ?>" class="nav-link"><span>Tùy chỉnh</span></a></li>
									<li class="nav-item <?php echo (isset($page_menu_index) && $page_menu_index == 62) ? 'active' : '' ?>"><a href="<?php echo base_url("config?action=maintain") ?>" class="nav-link"><span>Bảo trì</span></a></li>
								</ul>
							</div>
						</li>
					<?php
					}
					?>
					<li class="nav-item <?php echo (isset($page_menu_index) && $page_menu_index == 7) ? 'active' : '' ?>"><a class="nav-link" href="<?php echo base_url("login/logout") ?>"><i class="material-icons">undo</i>
							<p>Đăng xuất</p>
						</a></li>
				</ul>
			</div>
			<div class="sidebar-background"></div>
		</div>
		<div class="main-panel">
			<!-- Navbar -->
			<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
				<div class="container-fluid">
					<div class="navbar-wrapper">
						<a class="navbar-brand" href="javascript:;"><?php echo $page_title; ?></a>
					</div>
					<button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
						<span class="sr-only">Toggle navigation</span>
						<span class="navbar-toggler-icon icon-bar"></span>
						<span class="navbar-toggler-icon icon-bar"></span>
						<span class="navbar-toggler-icon icon-bar"></span>
					</button>
					<div class="collapse navbar-collapse justify-content-end">
						<ul class="navbar-nav">
							<li class="nav-item dropdown">
								<a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<i class="material-icons">person</i>
									<p class="d-lg-none d-md-block">Account</p>
								</a>
								<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
									<a class="dropdown-item" href="<?php echo base_url("member?action=editprofile") ?>">Thông tin</a>
									<a class="dropdown-item" href="<?php echo base_url("member?action=changepassword") ?>">Thay mật khẩu</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="<?php echo base_url('login/logout'); ?>">Đăng xuất</a>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</nav>
			<!-- End Navbar -->
			<div class="content">
				<div class="container-fluid">
					<?php $this->load->view($page_view); ?>
				</div>
			</div>
			<footer class="footer">
				<div class="container-fluid">
					<nav class="float-left">
						<ul>
							<li><a href="http://hopamthanhca.com">Hợp âm thánh ca</a></li>
						</ul>
					</nav>
					<div class="copyright float-right">@ <script>
							document.write(new Date().getFullYear())
						</script> Hopamthanhca.com</a></div>
				</div>
			</footer>
		</div>
	</div>
	<script src="<?php echo base_url("assets/js/core/jquery.min.js"); ?>"></script>
	<script src="<?php echo base_url("assets/js/core/popper.min.js"); ?>"></script>
	<script src="<?php echo base_url("assets/js/core/bootstrap-material-design.min.js"); ?>"></script>
	<script src="<?php echo base_url("assets/js/plugins/perfect-scrollbar.jquery.min.js"); ?>"></script>
	<script src="<?php echo base_url("assets/js/plugins/sweetalert2.js"); ?>"></script>
	<script src="<?php echo base_url("assets/js/material-dashboard.js?v=2.1.2"); ?>" type="text/javascript"></script>
	<!-- PLUGIN -->
	<script src="<?php echo base_url("assets/js/plugins/sweetalert2.js"); ?>" type="text/javascript"></script>
	<script src="<?php echo base_url("assets/js/plugins/bootstrap-selectpicker.js"); ?>"></script>
	<script src="<?php echo base_url("assets/js/plugins/jquery.ui.js"); ?>"></script>
	<!-- STYLE -->
	<script src="<?php echo base_url("tmp/js/style.js"); ?>"></script>
	<script src="<?php echo base_url("tmp/js/style-song-add.js"); ?>"></script>
	<script src="<?php echo base_url("tmp/js/style-weekly-add.js"); ?>"></script>
	<script>
		const base_url = '<?php echo base_url() ?>'
	</script>
</body>

</html>