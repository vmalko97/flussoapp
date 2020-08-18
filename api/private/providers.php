<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/app/resources/system/init.php");
require_once "security/private_locker.php";

if (isset($_GET)) {

    if (isset($_GET['all'])) {
        $obj_provider = new Providers();
        $provider = $obj_provider->getAll();
        $json = json_encode($provider);
        echo $json;
    }
    if (isset($_GET['id'])) {
        $obj_provider = new Providers();
        $provider = $obj_provider->getById($_GET['id']);
        $json = json_encode($provider);
        echo $json;
    }


}