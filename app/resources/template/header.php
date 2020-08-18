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


    <!-- Bootstrap Select Css -->
    <link rel="stylesheet" href="<?= RESOURCES_URL . "/assets/plugins/bootstrap-select/css/bootstrap-select.css" ?>"/>

    <!-- noUISlider Css -->
    <link rel="stylesheet" href="<?= RESOURCES_URL . "/assets/plugins/nouislider/nouislider.min.css"; ?>"/>

    <!-- Select2 -->
    <link rel="stylesheet" href="<?= RESOURCES_URL . "/assets/plugins/select2/select2.css"; ?>"/>
    <link rel="stylesheet" href="<?= RESOURCES_URL . "/assets/css/style.min.css"; ?>">

    <script src="<?= RESOURCES_URL . "/assets/js/jquery-3.4.1.min.js"; ?>"></script>


</head>

<body class="theme-blue">

 <div class="page-loader-wrapper">
     <div class="loader">
         <div class="m-t-30"><img src="<?= RESOURCES_URL . "/assets/images/loader.gif"; ?>"
                                  style="width: auto;" alt=""></div>
         <p>Завантаження...</p>
     </div>
 </div>


<div class="overlay"></div>


<div id="search">
    <button id="close" type="button" class="close btn btn-primary btn-icon btn-icon-mini btn-round">x</button>
    <form>
        <input type="search" value="" placeholder="Пошук..."/>
        <button type="submit" class="btn btn-primary">Пошук</button>
    </form>
</div>



