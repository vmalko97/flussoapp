<!doctype html>
<html class="no-js " lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="description" content="<?= APP_DESCRIPTION ?>">

    <title><?= APP_NAME ?></title>

    <!-- Custom Css -->
    <link rel="stylesheet" href="<?= RESOURCES_URL . "/assets/plugins/bootstrap/css/bootstrap.min.css"; ?>">
    <link rel="stylesheet" href="<?= RESOURCES_URL . "/assets/css/style.min.css"; ?>">
</head>

<body class="theme-blush">

<div class="authentication">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-sm-12">
                <form class="card auth_form" method="post">
                    <div class="header">
                        <img class="logo" src="<?= RESOURCES_URL . "/assets/images/logo.svg" ?>" alt="">
                        <h5>Вхід в систему</h5>
                    </div>
                    <div class="body">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="username" placeholder="Логін">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="zmdi zmdi-account-circle"></i></span>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" name="password" placeholder="Пароль">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="zmdi zmdi-lock"></i></a></span>
                            </div>
                        </div>
                        <div class="checkbox">
                            <input id="remember_me" type="checkbox">
                            <label for="remember_me">Запам'ятати мене</label>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block waves-effect waves-light">Увійти</button>
                    </div>
                </form>
<!--                <div class="copyright text-center">-->
<!--                    &copy;-->
<!--                    <script>document.write(new Date().getFullYear())</script>-->
<!--                    ,-->
<!--                    <span>Powered by <a href="https://vladyslav.pro/" target="_blank">Vladyslav Malko</a></span>-->
<!--                </div>-->
            </div>
            <div class="col-lg-8 col-sm-12">
                <div class="card">
                    <img src="<?= RESOURCES_URL . "/assets/images/signin.svg" ?>" alt="Sign In"/>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Jquery Core Js -->
<script src="<?= RESOURCES_URL . "/assets/bundles/libscripts.bundle.js" ?>"></script>
<script src="<?= RESOURCES_URL . "/assets/bundles/vendorscripts.bundle.js" ?>"></script> <!-- Lib Scripts Plugin Js -->
</body>
</html>