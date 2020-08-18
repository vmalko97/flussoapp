<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/app/resources/system/init.php");

if (isset($_GET)) {

    if (isset($_GET['file_hash'])) {
        $data = $_GET['file_hash'];
        $obj_invoice = new Invoices();
        $invoice = $obj_invoice->getInfoByFileHash($data);
        $dataTable = $obj_invoice->getDataTableById($invoice[0]['id']);


        $json = "{\"invoice\": {";
        for ($i = 0; $i < count($invoice); $i++) {
            $json .= "\"provider\":\"" . $invoice[$i]['company_id'] . "\",";
            $json .= "\"customer\":\"" . $invoice[$i]['receiver_customer_id'] . "\",";
            $json .= "\"payer\":\"" . $invoice[$i]['payer_customer_id'] . "\",";
            $json .= "\"same\":\"" . $invoice[$i]['same'] . "\",";
            $json .= "\"invoice_number\":\"" . $invoice[$i]['invoce_number'] . "\",";
            $json .= "\"date\":\"" . $invoice[$i]['date'] . "\",";
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
            $json .= "\"total_without_vat\":\"" . $invoice[$i]['total_without_vat'] . "\",";
            $json .= "\"total_vat\":\"" . $invoice[$i]['vat'] . "\",";
            $json .= "\"total_with_vat\":\"" . $invoice[$i]['total'] . "\",";
            $json .= "\"written_by\":\"" . $invoice[$i]['written_by'] . "\",";
            $json .= "\"finalize\":\"" . $invoice[$i]['finalize'] . "\",";
            $json .= "\"security_hash\":\"" . $invoice[$i]['security_hash'] . "\",";
            $json .= "\"file_hash\":\"" . $invoice[$i]['file_hash'] . "\",";
            $json .= "\"finalized_path\":\"" . $invoice[$i]['finalized_path'] . "\"} }";
        }
        echo $json;
    }
    if (isset($_GET['security_hash'])) {
        $data = $_GET['security_hash'];
        $obj_invoice = new Invoices();
        $invoice = $obj_invoice->getInfoBySecurityHash($data);
        $dataTable = $obj_invoice->getDataTableById($invoice[0]['id']);


        $json = "{\"invoice\": {";
        for ($i = 0; $i < count($invoice); $i++) {
            $json .= "\"provider\":\"" . $invoice[$i]['company_id'] . "\",";
            $json .= "\"customer\":\"" . $invoice[$i]['receiver_customer_id'] . "\",";
            $json .= "\"payer\":\"" . $invoice[$i]['payer_customer_id'] . "\",";
            $json .= "\"same\":\"" . $invoice[$i]['same'] . "\",";
            $json .= "\"invoice_number\":\"" . $invoice[$i]['invoce_number'] . "\",";
            $json .= "\"date\":\"" . $invoice[$i]['date'] . "\",";
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
            $json .= "\"total_without_vat\":\"" . $invoice[$i]['total_without_vat'] . "\",";
            $json .= "\"total_vat\":\"" . $invoice[$i]['vat'] . "\",";
            $json .= "\"total_with_vat\":\"" . $invoice[$i]['total'] . "\",";
            $json .= "\"written_by\":\"" . $invoice[$i]['written_by'] . "\",";
            $json .= "\"finalize\":\"" . $invoice[$i]['finalize'] . "\",";
            $json .= "\"security_hash\":\"" . $invoice[$i]['security_hash'] . "\",";
            $json .= "\"file_hash\":\"" . $invoice[$i]['file_hash'] . "\",";
            $json .= "\"finalized_path\":\"" . $invoice[$i]['finalized_path'] . "\"} }";
        }
        echo $json;
    }
    if (isset($_GET['all'])) {
        $obj_invoice = new Invoices();
        $invoice = $obj_invoice->getComplexAll();
        $json = json_encode($invoice);
        echo $json;
    }
    if (isset($_GET['finalized'])) {
        $obj_invoice = new Invoices();
        $invoice = $obj_invoice->getFinalizedComplexAll();
        $json = json_encode($invoice);
        echo $json;
    }
    if (isset($_GET['getById'])) {
        $obj_invoice = new Invoices();
        $invoice = $obj_invoice->getById($_GET['getById']);
        $json = json_encode($invoice);
        echo $json;
    }
    if (isset($_GET['getByCustomer'])) {
        $obj_invoice = new Invoices();
        $invoice = $obj_invoice->getAllByCustomerId($_GET['getByCustomer']);
        $json = json_encode($invoice);
        echo $json;
    }
    if (isset($_GET['getFinalizedByCustomer'])) {
        $obj_invoice = new Invoices();
        $invoice = $obj_invoice->getAllFinalizedByCustomerId($_GET['getFinalizedByCustomer']);
        $json = json_encode($invoice);
        echo $json;
    }

    if (isset($_GET['allComplex'])) {
        $obj_invoice = new Invoices();
        $invoice = $obj_invoice->getComplexAll();
        $json = "[";
        for ($i = 0; $i < count($invoice); $i++) {
            $dataTable = $obj_invoice->getDataTableById($invoice[$i]['id']);
            $json .= "{";
            $json .= "\"invoice\": {";
            $json .= "\"provider\":\"" . $invoice[$i]['company_id'] . "\",";
            $json .= "\"customer\":\"" . $invoice[$i]['receiver_customer_id'] . "\",";
            $json .= "\"payer\":\"" . $invoice[$i]['payer_customer_id'] . "\",";
            $json .= "\"same\":\"" . $invoice[$i]['same'] . "\",";
            $json .= "\"invoice_number\":\"" . $invoice[$i]['invoce_number'] . "\",";
            $json .= "\"date\":\"" . $invoice[$i]['date'] . "\",";
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
            $json .= "\"total_without_vat\":\"" . $invoice[$i]['total_without_vat'] . "\",";
            $json .= "\"total_vat\":\"" . $invoice[$i]['vat'] . "\",";
            $json .= "\"total_with_vat\":\"" . $invoice[$i]['total'] . "\",";
            $json .= "\"written_by\":\"" . $invoice[$i]['written_by'] . "\",";
            $json .= "\"finalize\":\"" . $invoice[$i]['finalize'] . "\",";
            $json .= "\"security_hash\":\"" . $invoice[$i]['security_hash'] . "\",";
            $json .= "\"file_hash\":\"" . $invoice[$i]['file_hash'] . "\",";
            $json .= "\"finalized_path\":\"" . $invoice[$i]['finalized_path'] . "\"}";
            if ($i == count($invoice) - 1) {
                $json .= "}";
            } else {
                $json .= "},";
            }
        }
        $json .= "]";
        echo $json;
    }
    if (isset($_GET['getComplexById'])) {
        $obj_invoice = new Invoices();
        $invoice = $obj_invoice->getById($_GET['getComplexById']);
        $json = "[";
        for ($i = 0; $i < count($invoice); $i++) {
            $dataTable = $obj_invoice->getDataTableById($invoice[$i]['id']);
            $json .= "{";
            $json .= "\"invoice\": {";
            $json .= "\"provider\":\"" . $invoice[$i]['company_id'] . "\",";
            $json .= "\"customer\":\"" . $invoice[$i]['receiver_customer_id'] . "\",";
            $json .= "\"payer\":\"" . $invoice[$i]['payer_customer_id'] . "\",";
            $json .= "\"same\":\"" . $invoice[$i]['same'] . "\",";
            $json .= "\"invoice_number\":\"" . $invoice[$i]['invoce_number'] . "\",";
            $json .= "\"date\":\"" . $invoice[$i]['date'] . "\",";
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
            $json .= "\"total_without_vat\":\"" . $invoice[$i]['total_without_vat'] . "\",";
            $json .= "\"total_vat\":\"" . $invoice[$i]['vat'] . "\",";
            $json .= "\"total_with_vat\":\"" . $invoice[$i]['total'] . "\",";
            $json .= "\"written_by\":\"" . $invoice[$i]['written_by'] . "\",";
            $json .= "\"finalize\":\"" . $invoice[$i]['finalize'] . "\",";
            $json .= "\"security_hash\":\"" . $invoice[$i]['security_hash'] . "\",";
            $json .= "\"file_hash\":\"" . $invoice[$i]['file_hash'] . "\",";
            $json .= "\"finalized_path\":\"" . $invoice[$i]['finalized_path'] . "\"}";
            if ($i == count($invoice) - 1) {
                $json .= "}";
            } else {
                $json .= "},";
            }
        }
        $json .= "]";
        echo $json;
    }

}