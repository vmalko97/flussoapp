<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/app/resources/system/init.php");
require_once "security/private_locker.php";

if (isset($_GET)) {

    if (isset($_GET['all'])) {
        $obj_customer = new Customers();
        $customer = $obj_customer->getAll();
        $json = json_encode($customer);
        echo $json;
    }
    if (isset($_GET['id'])) {
        $obj_customer = new Customers();
        $customer = $obj_customer->getById($_GET['id']);
        $json = json_encode($customer);
        echo $json;
    }


}