<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/app/resources/system/init.php");
require_once "security/private_locker.php";

if (isset($_GET)) {

    if (isset($_GET['all'])) {
        $obj_user = new Users();
        $user = $obj_user->getAll();
        $json = json_encode($user);
        echo $json;
    }
    if (isset($_GET['id'])) {
        $obj_user = new Users();
        $user = $obj_user->getById($_GET['id']);
        $json = json_encode($user);
        echo $json;
    }
}