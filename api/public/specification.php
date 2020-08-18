<?php

require_once ($_SERVER['DOCUMENT_ROOT']."/app/resources/system/init.php");

if(isset($_GET)){

    if(isset($_GET['file_hash'])) {
        $data = $_GET['file_hash'];
        $obj_specification = new Specifications();
        $specification = $obj_specification->getInfoByFileHash($data);
        $dataTable = $obj_specification->getDataTableById($specification[0]['id']);


        $json = "{\"specification\": {";
        for ($i = 0; $i < count($specification); $i++) {
            $json .= "\"specification_number\":\"" . $specification[$i]['specification_number'] . "\",";
            $json .= "\"contract_id\":\"" . $specification[$i]['contract_id'] . "\",";
            $json .= "\"date\":\"" . $specification[$i]['date'] . "\",";
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
            $json .= "\"total_without_vat\":\"" . $specification[$i]['total_without_vat'] . "\",";
            $json .= "\"total_vat\":\"" . $specification[$i]['vat'] . "\",";
            $json .= "\"total_with_vat\":\"" . $specification[$i]['total'] . "\",";
            $json .= "\"finalize\":\"" . $specification[$i]['finalize'] . "\",";
            $json .= "\"security_hash\":\"" . $specification[$i]['security_hash'] . "\",";
            $json .= "\"file_hash\":\"" . $specification[$i]['file_hash'] . "\",";
            $json .= "\"finalized_path\":\"" . $specification[$i]['finalized_path'] . "\"} }";
        }
        echo $json;
    }

    if(isset($_GET['security_hash'])) {
        $data = $_GET['security_hash'];
        $obj_specification = new Specifications();
        $specification = $obj_specification->getInfoBySecurityHash($data);
        $dataTable = $obj_specification->getDataTableById($specification[0]['id']);


        $json = "{\"specification\": {";
        for ($i = 0; $i < count($specification); $i++) {
            $json .= "\"specification_number\":\"" . $specification[$i]['specification_number'] . "\",";
            $json .= "\"contract_id\":\"" . $specification[$i]['contract_id'] . "\",";
            $json .= "\"date\":\"" . $specification[$i]['date'] . "\",";
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
            $json .= "\"total_without_vat\":\"" . $specification[$i]['total_without_vat'] . "\",";
            $json .= "\"total_vat\":\"" . $specification[$i]['vat'] . "\",";
            $json .= "\"total_with_vat\":\"" . $specification[$i]['total'] . "\",";
            $json .= "\"finalize\":\"" . $specification[$i]['finalize'] . "\",";
            $json .= "\"security_hash\":\"" . $specification[$i]['security_hash'] . "\",";
            $json .= "\"file_hash\":\"" . $specification[$i]['file_hash'] . "\",";
            $json .= "\"finalized_path\":\"" . $specification[$i]['finalized_path'] . "\"} }";
        }
        echo $json;
    }
    if (isset($_GET['all'])) {
        $obj_specification = new Specifications();
        $specification = $obj_specification->getComplexAll();
        $json = json_encode($specification);
        echo $json;
    }
    if (isset($_GET['finalized'])) {
        $obj_specification = new Specifications();
        $specification = $obj_specification->getFinalizedComplexAll();
        $json = json_encode($specification);
        echo $json;
    }
    if (isset($_GET['getById'])) {
        $obj_specification = new Specifications();
        $specification = $obj_specification->getById($_GET['getById']);
        $json = json_encode($specification);
        echo $json;
    }
    if (isset($_GET['getByContract'])) {
        $obj_specification = new Specifications();
        $specification = $obj_specification->getAllByContractId($_GET['getByContract']);
        $json = json_encode($specification);
        echo $json;
    }
    if (isset($_GET['getFinalizedByContract'])) {
        $obj_specification = new Specifications();
        $specification = $obj_specification->getAllFinalizedByContractId($_GET['getFinalizedByContract']);
        $json = json_encode($specification);
        echo $json;
    }

    if (isset($_GET['allComplex'])) {
        $obj_specification = new Specifications();
        $specification = $obj_specification->getComplexAll();
        $json = "[";
        for ($i = 0; $i < count($specification); $i++) {
            $dataTable = $obj_specification->getDataTableById($specification[$i]['id']);
            $json .= "{";
            $json .= "\"specification\": {";
            $json .= "\"specification_number\":\"" . $specification[$i]['specification_number'] . "\",";
            $json .= "\"contract_id\":\"" . $specification[$i]['contract_id'] . "\",";
            $json .= "\"date\":\"" . $specification[$i]['date'] . "\",";
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
            $json .= "\"total_without_vat\":\"" . $specification[$i]['total_without_vat'] . "\",";
            $json .= "\"total_vat\":\"" . $specification[$i]['vat'] . "\",";
            $json .= "\"total_with_vat\":\"" . $specification[$i]['total'] . "\",";
            $json .= "\"finalize\":\"" . $specification[$i]['finalize'] . "\",";
            $json .= "\"security_hash\":\"" . $specification[$i]['security_hash'] . "\",";
            $json .= "\"file_hash\":\"" . $specification[$i]['file_hash'] . "\",";
            $json .= "\"finalized_path\":\"" . $specification[$i]['finalized_path'] . "\"}";
            if ($i == count($specification) - 1) {
                $json .= "}";
            } else {
                $json .= "},";
            }
        }
        $json .= "]";
        echo $json;
    }
    if (isset($_GET['getComplexById'])) {
        $obj_specification = new Specifications();
        $specification = $obj_specification->getById($_GET['getComplexById']);
        $json = "[";
        for ($i = 0; $i < count($specification); $i++) {
            $dataTable = $obj_specification->getDataTableById($specification[$i]['id']);
            $json .= "{";
            $json .= "\"specification\": {";
            $json .= "\"specification_number\":\"" . $specification[$i]['specification_number'] . "\",";
            $json .= "\"contract_id\":\"" . $specification[$i]['contract_id'] . "\",";
            $json .= "\"date\":\"" . $specification[$i]['date'] . "\",";
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
            $json .= "\"total_without_vat\":\"" . $specification[$i]['total_without_vat'] . "\",";
            $json .= "\"total_vat\":\"" . $specification[$i]['vat'] . "\",";
            $json .= "\"total_with_vat\":\"" . $specification[$i]['total'] . "\",";
            $json .= "\"finalize\":\"" . $specification[$i]['finalize'] . "\",";
            $json .= "\"security_hash\":\"" . $specification[$i]['security_hash'] . "\",";
            $json .= "\"file_hash\":\"" . $specification[$i]['file_hash'] . "\",";
            $json .= "\"finalized_path\":\"" . $specification[$i]['finalized_path'] . "\"}";
            if ($i == count($specification) - 1) {
                $json .= "}";
            } else {
                $json .= "},";
            }
        }
        $json .= "]";
        echo $json;
    }

}