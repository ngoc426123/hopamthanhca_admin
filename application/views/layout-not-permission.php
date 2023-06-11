<!doctype html>
<html lang="en">

<head>
	<title>Truy cập giới hạn về quyền</title>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo base_url("assets/css/material-dashboard.min.css"); ?>" />
</head>

<body class="off-canvas-sidebar">
	<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top text-white">
		<div class="container">
			<div class="navbar-wrapper">
				<a class="navbar-brand" href="#pablo">502 Page<div class="ripple-container"></div></a>
			</div>
			<button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
				<span class="sr-only">Toggle navigation</span>
				<span class="navbar-toggler-icon icon-bar"></span>
				<span class="navbar-toggler-icon icon-bar"></span>
				<span class="navbar-toggler-icon icon-bar"></span>
			</button>
			<div class="collapse navbar-collapse justify-content-end">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a href="<?php echo base_url("dashbroad") ?>" class="nav-link">
							<i class="material-icons">dashboard</i> Thống kê
						</a>
					</li>
					<li class="nav-item ">
						<a href="<?php echo base_url("song?page=1") ?>" class="nav-link">
							<i class="material-icons">audiotrack</i> Bài hát
						</a>
					</li>
					<li class="nav-item ">
						<a href="<?php echo base_url("login/logout") ?>" class="nav-link">
							<i class="material-icons">undo</i> Đăng xuất
						</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<div class="wrapper wrapper-full-page">
		<div class="page-header error-page header-filter" style="background-image: url('<?php echo base_url("assets/img/veil.jpg") ?>')">
			<!--   you can change the color of the filter page using: data-color="blue | green | orange | red | purple" -->
			<div class="content-center">
				<div class="row">
					<div class="col-md-12">
						<h1 class="title">502</h1>
						<h2>Bạn không có quyền truy cập</h2>
						<h4>Truyền truy cập bị giới hạn do bạn không có đủ quyền hạn sử dụng trên đường dẫn hoặc trang bạn muốn truy cập :(</h4>
					</div>
				</div>
			</div>
		</div>
		<div>
</body>

</html>