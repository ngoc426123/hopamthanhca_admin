<!doctype html>
<html lang="en">
<head>
    <title>Hello, world!</title>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url("assets/css/material-dashboard.min.css"); ?>"/>
    <link rel="stylesheet" href="<?php echo base_url("tmp/css/style.css"); ?>"/>
</head>

<body class="page-login">
    <div class="wrapper wrapper-full-page">
        <div class="page-header login-page header-filter" filter-color="black"
            style="background-image: url('<?php echo base_url("assets/img/login.jpg"); ?>'); background-size: cover; background-position: top center;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
                        <form class="form" method="" action="">
                            <div class="card card-login">
                                <div class="card-header card-header-info text-center">
                                    <h4 class="card-title">Login</h4>
                                </div>
                                <div class="card-body ">
                                    <span class="bmd-form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="material-icons">email</i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Email..." id="username" autocomplete="off">
                                        </div>
                                    </span>
                                    <span class="bmd-form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="material-icons">lock_outline</i>
                                                </span>
                                            </div>
                                            <input type="password" class="form-control" placeholder="Password..." id="password" autocomplete="off">
                                        </div>
                                    </span>
                                </div>
                                <div class="card-footer justify-content-center">
                                    <a href="#pablo" class="btn btn-info btn-link btn-lg" id="btn-login">Lets Go</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo base_url("assets/js/core/jquery.min.js"); ?>"></script>
    <script src="<?php echo base_url("tmp/js/style.js"); ?>"></script>
    <script> const base_url = '<?php echo base_url() ?>'</script>
</body>
</html>