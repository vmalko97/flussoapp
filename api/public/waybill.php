<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/app/resources/system/init.php");

if (isset($_GET)) {
    if (isset($_GET['file_hash'])) {
        $data = $_GET['file_hash'];
        $obj_waybill = new Waybills();
        $waybill = $obj_waybill->getInfoByFileHash($data);
        $dataTable = $obj_waybill->getDataTableById($waybill[0]['id']);
        $json = "{\"waybill\": {";
        for ($i = 0; $i < count($waybill); $i++) {
            $json .= "\"provider\":\"" . $waybill[$i]['company_id'] . "\",";
            $json .= "\"customer\":\"" . $waybill[$i]['receiver_customer_id'] . "\",";
            $json .= "\"payer\":\"" . $waybill[$i]['payer_customer_id'] . "\",";
            $json .= "\"same\":\"" . $waybill[$i]['same'] . "\",";
            $json .= "\"waybill_number\":\"" . $waybill[$i]['waybill_number'] . "\",";
            $json .= "\"date\":\"" . $waybill[$i]['date'] . "\",";
            $json .= "\"dataTable\":[";
            for ($j = 0, $count = count($dataTable); $j < $count; $j++) {
                $json .= "{";
                $json .= "\"name\":\"" . $dataTable[$j]['product_name'] . "\",";
                $json .= "\"units\":\"" . $dataTable[$j]['units'] . "\",";
                $json .= "\"quantity\":\"" . $dataTable[$j]['quantity'] . "\",";
                $json .= "\"price\":\"" . $dataTable[$j]['price_without_vat'] . "\",";
                $json .= "\"sum\":\"" . $dataTable[$j]['sum'] . "\"";
                if ($j == $count - 1) {
                    $json .= "}";
                } else {
                    $json .= "},";
                }
            }
            $json .= "],";
            $json .= "\"total_without_vat\":\"" . $waybill[$i]['total_without_vat'] . "\",";
            $json .= "\"total_vat\":\"" . $waybill[$i]['vat'] . "\",";
            $json .= "\"total_with_vat\":\"" . $waybill[$i]['total'] . "\",";
            $json .= "\"finalize\":\"" . $waybill[$i]['finalize'] . "\",";
            $json .= "\"security_hash\":\"" . $waybill[$i]['security_hash'] . "\",";
            $json .= "\"file_hash\":\"" . $waybill[$i]['file_hash'] . "\",";
            $json .= "\"finalized_path\":\"" . $waybill[$i]['finalized_path'] . "\"} }";
        }
        echo $json;
    }
    if (isset($_GET['security_hash'])) {
        $data = $_GET['security_hash'];
        $obj_waybill = new Waybills();
        $waybill = $obj_waybill->getInfoBySecurityHash($data);
        $dataTable = $obj_waybill->getDataTableById($waybill[0]['id']);
        $json = "{\"waybill\": {";
        for ($i = 0; $i < count($waybill); $i++) {
            $json .= "\"provider\":\"" . $waybill[$i]['company_id'] . "\",";
            $json .= "\"customer\":\"" . $waybill[$i]['receiver_customer_id'] . "\",";
            $json .= "\"payer\":\"" . $waybill[$i]['payer_customer_id'] . "\",";
            $json .= "\"same\":\"" . $waybill[$i]['same'] . "\",";
            $json .= "\"waybill_number\":\"" . $waybill[$i]['waybill_number'] . "\",";
            $json .= "\"date\":\"" . $waybill[$i]['date'] . "\",";
            $json .= "\"dataTable\":[";
            for ($j = 0, $count = count($dataTable); $j < $count; $j++) {
                $json .= "{";
                $json .= "\"name\":\"" . $dataTable[$j]['product_name'] . "\",";
                $json .= "\"units\":\"" . $dataTable[$j]['units'] . "\",";
                $json .= "\"quantity\":\"" . $dataTable[$j]['quantity'] . "\",";
                $json .= "\"price\":\"" . $dataTable[$j]['price_without_vat'] . "\",";
                $json .= "\"sum\":\"" . $dataTable[$j]['sum'] . "\"";
                if ($j == $count - 1) {
                    $json .= "}";
                } else {
                    $json .= "},";
                }
            }
            $json .= "],";
            $json .= "\"total_without_vat\":\"" . $waybill[$i]['total_without_vat'] . "\",";
            $json .= "\"total_vat\":\"" . $waybill[$i]['vat'] . "\",";
            $json .= "\"total_with_vat\":\"" . $waybill[$i]['total'] . "\",";
            $json .= "\"finalize\":\"" . $waybill[$i]['finalize'] . "\",";
            $json .= "\"security_hash\":\"" . $waybill[$i]['security_hash'] . "\",";
            $json .= "\"file_hash\":\"" . $waybill[$i]['file_hash'] . "\",";
            $json .= "\"finalized_path\":\"" . $waybill[$i]['finalized_path'] . "\"} }";
        }
        echo $json;
    }


    if (isset($_GET['all'])) {
        $obj_waybill = new Waybills();
        $waybill = $obj_waybill->getComplexAll();
        $json = json_encode($waybill);
        echo $json;
    }
    if (isset($_GET['finalized'])) {
        $obj_waybill = new Waybills();
        $waybill = $obj_waybill->getFinalizedComplexAll();
        $json = json_encode($waybill);
        echo $json;
    }
    if (isset($_GET['getById'])) {
        $obj_waybill = new Waybills();
        $waybill = $obj_waybill->getById($_GET['getById']);
        $json = json_encode($waybill);
        echo $json;
    }
    if (isset($_GET['getByCustomer'])) {
        $obj_waybill = new Waybills();
        $waybill = $obj_waybill->getAllByCustomerId($_GET['getByCustomer']);
        $json = json_encode($waybill);
        echo $json;
    }
    if (isset($_GET['getFinalizedByCustomer'])) {
        $obj_waybill = new Waybills();
        $waybill = $obj_waybill->getAllFinalizedByCustomerId($_GET['getFinalizedByCustomer']);
        $json = json_encode($waybill);
        echo $json;
    }

    if (isset($_GET['allComplex'])) {
        $obj_waybill = new Waybills();
        $waybill = $obj_waybill->getComplexAll();
        $json = "[";
        for ($i = 0; $i < count($waybill); $i++) {
            $dataTable = $obj_waybill->getDataTableById($waybill[$i]['id']);
            $json .= "{";
            $json .= "\"waybill\": {";
            $json .= "\"provider\":\"" . $waybill[$i]['company_id'] . "\",";
            $json .= "\"customer\":\"" . $waybill[$i]['receiver_customer_id'] . "\",";
            $json .= "\"payer\":\"" . $waybill[$i]['payer_customer_id'] . "\",";
            $json .= "\"same\":\"" . $waybill[$i]['same'] . "\",";
            $json .= "\"waybill_number\":\"" . $waybill[$i]['waybill_number'] . "\",";
            $json .= "\"date\":\"" . $waybill[$i]['date'] . "\",";
            $json .= "\"dataTable\":[";
            for ($j = 0, $count = count($dataTable); $j < $count; $j++) {
                $json .= "{";
                $json .= "\"name\":\"" . $dataTable[$j]['product_name'] . "\",";
                $json .= "\"units\":\"" . $dataTable[$j]['units'] . "\",";
                $json .= "\"quantity\":\"" . $dataTable[$j]['quantity'] . "\",";
                $json .= "\"price\":\"" . $dataTable[$j]['price_without_vat'] . "\",";
                $json .= "\"sum\":\"" . $dataTable[$j]['sum'] . "\"";
                if ($j == $count - 1) {
                    $json .= "}";
                } else {
                    $json .= "},";
                }
            }
            $json .= "],";
            $json .= "\"total_without_vat\":\"" . $waybill[$i]['total_without_vat'] . "\",";
            $json .= "\"total_vat\":\"" . $waybill[$i]['vat'] . "\",";
            $json .= "\"total_with_vat\":\"" . $waybill[$i]['total'] . "\",";
            $json .= "\"finalize\":\"" . $waybill[$i]['finalize'] . "\",";
            $json .= "\"security_hash\":\"" . $waybill[$i]['security_hash'] . "\",";
            $json .= "\"file_hash\":\"" . $waybill[$i]['file_hash'] . "\",";
            $json .= "\"finalized_path\":\"" . $waybill[$i]['finalized_path'] . "\"}";
            if ($i == count($waybill) - 1) {
                $json .= "}";
            } else {
                $json .= "},";
            }
        }
        $json .= "]";
        echo $json;
    }
    if (isset($_GET['getComplexById'])) {
        $obj_waybill = new Waybills();
        $waybill = $obj_waybill->getById($_GET['getComplexById']);
        $json = "[";
        for ($i = 0; $i < count($waybill); $i++) {
            $dataTable = $obj_waybill->getDataTableById($waybill[$i]['id']);
            $json .= "{";
            $json .= "\"waybill\": {";
            $json .= "\"provider\":\"" . $waybill[$i]['company_id'] . "\",";
            $json .= "\"customer\":\"" . $waybill[$i]['receiver_customer_id'] . "\",";
            $json .= "\"payer\":\"" . $waybill[$i]['payer_customer_id'] . "\",";
            $json .= "\"same\":\"" . $waybill[$i]['same'] . "\",";
            $json .= "\"waybill_number\":\"" . $waybill[$i]['waybill_number'] . "\",";
            $json .= "\"date\":\"" . $waybill[$i]['date'] . "\",";
            $json .= "\"dataTable\":[";
            for ($j = 0, $count = count($dataTable); $j < $count; $j++) {
                $json .= "{";
                $json .= "\"name\":\"" . $dataTable[$j]['product_name'] . "\",";
                $json .= "\"units\":\"" . $dataTable[$j]['units'] . "\",";
                $json .= "\"quantity\":\"" . $dataTable[$j]['quantity'] . "\",";
                $json .= "\"price\":\"" . $dataTable[$j]['price_without_vat'] . "\",";
                $json .= "\"sum\":\"" . $dataTable[$j]['sum'] . "\"";
                if ($j == $count - 1) {
                    $json .= "}";
                } else {
                    $json .= "},";
                }
            }
            $json .= "],";
            $json .= "\"total_without_vat\":\"" . $waybill[$i]['total_without_vat'] . "\",";
            $json .= "\"total_vat\":\"" . $waybill[$i]['vat'] . "\",";
            $json .= "\"total_with_vat\":\"" . $waybill[$i]['total'] . "\",";
            $json .= "\"finalize\":\"" . $waybill[$i]['finalize'] . "\",";
            $json .= "\"security_hash\":\"" . $waybill[$i]['security_hash'] . "\",";
            $json .= "\"file_hash\":\"" . $waybill[$i]['file_hash'] . "\",";
            $json .= "\"finalized_path\":\"" . $waybill[$i]['finalized_path'] . "\"}";
            if ($i == count($waybill) - 1) {
                $json .= "}";
            } else {
                $json .= "},";
            }
        }
        $json .= "]";
        echo $json;
    }
}