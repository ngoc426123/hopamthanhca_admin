<!doctype html>
<html lang="en">
<head>
    <title>Hello, world!</title>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url("assets/css/material-dashboard.css"); ?>" />
    <link rel="stylesheet" href="<?php echo base_url("tmp/css/style.css"); ?>" />
</head>

<body>
    <div class="wrapper ">
        <div class="sidebar" data-color="azure" data-background-color="white">
            <div class="logo">
                <a href="http://www.creative-tim.com" class="simple-text logo-mini"><img src="<?php echo base_url("tmp/img/logo.svg"); ?>" alt=""></a>
            </div>
            <div class="sidebar-wrapper">
                <ul class="nav">
                    <li class="nav-item active"><a class="nav-link" href="#"><i class="material-icons">dashboard</i><p>Thống kê</p></a></li>
                    <li class="nav-item"><a class="nav-link" href="#menu1"><i class="material-icons">audiotrack</i><p>Bài hát</p></a></li>
                    <li class="nav-item"><a class="nav-link" href="#0"><i class="material-icons">storage</i><p>Danh mục</p></a></li>
                    <li class="nav-item"><a class="nav-link" href="#0"><i class="material-icons">supervisor_account</i><p>Thành viên</p></a></li>
                    <li class="nav-item"><a class="nav-link" href="#0"><i class="material-icons">business_center</i><p>Dữ liệu</p></a></li>
                    <li class="nav-item"><a class="nav-link" href="#0"><i class="material-icons">build</i><p>Cấu hình</p></a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo base_url('login/logout'); ?>"><i class="material-icons">undo</i><p>Đăng xuất</p></a></li>
                </ul>
            </div>
            <div class="sidebar-background"></div>
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
                <div class="container-fluid">
                    <div class="navbar-wrapper">
                        <a class="navbar-brand" href="javascript:;">Thống kê toàn trang</a>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="navbar-toggler-icon icon-bar"></span>
                        <span class="navbar-toggler-icon icon-bar"></span>
                        <span class="navbar-toggler-icon icon-bar"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end">
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">person</i>
                                    <p class="d-lg-none d-md-block">Account</p>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                                    <a class="dropdown-item" href="#">Thông tin</a>
                                    <a class="dropdown-item" href="#">Thay mật khẩu</a>
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
                    
                </div>
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <nav class="float-left">
                        <ul>
                            <li><a href="http://hopamthanhca.com">Hợp âm thánh ca</a></li>
                        </ul>
                    </nav>
                    <div class="copyright float-right">@ <script>document.write(new Date().getFullYear())</script> Hopamthanhca.com</a></div>
                </div>
            </footer>
        </div>
    </div>
    <script src="<?php echo base_url("assets/js/core/jquery.min.js"); ?>"></script>
    <script src="<?php echo base_url("assets/js/core/popper.min.js"); ?>"></script>
    <script src="<?php echo base_url("assets/js/core/bootstrap-material-design.min.js"); ?>"></script>
    <script src="<?php echo base_url("assets/js/plugins/perfect-scrollbar.jquery.min.js"); ?>"></script>
    <script src="<?php echo base_url("assets/js/material-dashboard.js?v=2.1.2"); ?>" type="text/javascript"></script>
</body>

</html>