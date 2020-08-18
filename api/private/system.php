<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/app/resources/system/init.php");
require_once "security/private_locker.php";

if (isset($_GET)) {

    if (isset($_GET['config'])) {
        $obj_service = new Service();
        $service = $obj_service->getConfig();
        $json = json_encode($service);
        echo $json;
    }
    if (isset($_GET['getProductCategories'])) {
        $obj_service = new Service();
        $service = $obj_service->getAllProductCategories();
        $json = json_encode($service);
        echo $json;
    }
    if (isset($_GET['getUnits'])) {
        $obj_service = new Service();
        $service = $obj_service->getAllUnits();
        $json = json_encode($service);
        echo $json;
    }
    if (isset($_GET['getVatTypes'])) {
        $obj_service = new Service();
        $service = $obj_service->getAllVatTypes();
        $json = json_encode($service);
        echo $json;
    }
    if (isset($_GET['getProductCategoryById'])) {
        $obj_service = new Service();
        $service = $obj_service->getProductCategoryById($_GET['getProductCategoryById']);
        $json = json_encode($service);
        echo $json;
    }
    if (isset($_GET['getUnitById'])) {
        $obj_service = new Service();
        $service = $obj_service->getUnitById($_GET['getUnitById']);
        $json = json_encode($service);
        echo $json;
    }
    if (isset($_GET['getVatTypeById'])) {
        $obj_service = new Service();
        $service = $obj_service->getVatTypeById($_GET['getVatTypeById']);
        $json = json_encode($service);
        echo $json;
    }
}