<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/app/resources/system/init.php");

if (isset($_GET)) {

    if (isset($_GET['all'])) {
        $obj_company = new Companies();
        $company = $obj_company->getAll();
        $json = json_encode($company);
        echo $json;
    }
    if (isset($_GET['id'])) {
        $obj_company = new Companies();
        $company = $obj_company->getById($_GET['id']);
        $json = json_encode($company);
        echo $json;
    }
}