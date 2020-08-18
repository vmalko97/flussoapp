<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/app/resources/system/init.php");

if (isset($_GET)) {

    if (isset($_GET['file_hash'])) {
        $data = $_GET['file_hash'];
        $obj_contract = new Contracts();
        $contract = $obj_contract->getInfoByFileHash($data);


        $json = "{\"contract\": {";
        for ($i = 0; $i < count($contract); $i++) {
            $json .= "\"contract_number\":\"" . $contract[$i]['contract_number'] . "\",";
            $json .= "\"city\":\"" . $contract[$i]['city'] . "\",";
            $json .= "\"date\":\"" . $contract[$i]['date'] . "\",";
            $json .= "\"provider_id\":\"" . $contract[$i]['provider_id'] . "\",";
            $json .= "\"provider_position\":\"" . $contract[$i]['provider_position'] . "\",";
            $json .= "\"provider_person\":\"" . $contract[$i]['provider_person'] . "\",";
            $json .= "\"provider_basis\":\"" . $contract[$i]['provider_basis'] . "\",";
            $json .= "\"customer_id\":\"" . $contract[$i]['customer_id'] . "\",";
            $json .= "\"customer_position\":\"" . $contract[$i]['customer_position'] . "\",";
            $json .= "\"customer_person\":\"" . $contract[$i]['customer_person'] . "\",";
            $json .= "\"customer_basis\":\"" . $contract[$i]['customer_basis'] . "\",";
            $json .= "\"classificatory_code\":\"" . $contract[$i]['classificatory_code'] . "\",";
            $json .= "\"contract_sum\":\"" . $contract[$i]['contract_sum'] . "\",";
            $json .= "\"paying_form\":\"" . $contract[$i]['paying_form'] . "\",";
            $json .= "\"condition_of_calculation\":\"" . $contract[$i]['condition_of_calculation'] . "\",";
            $json .= "\"terms_of_delivery\":\"" . $contract[$i]['terms_of_delivery'] . "\",";
            $json .= "\"provider_tax_status\":\"" . $contract[$i]['provider_tax_status'] . "\",";
            $json .= "\"expire_date\":\"" . $contract[$i]['expire_date'] . "\",";
            $json .= "\"contract_type\":\"" . $contract[$i]['contract_type'] . "\",";
            $json .= "\"finalize\":\"" . $contract[$i]['finalize'] . "\",";
            $json .= "\"security_hash\":\"" . $contract[$i]['security_hash'] . "\",";
            $json .= "\"file_hash\":\"" . $contract[$i]['file_hash'] . "\",";
            $json .= "\"finalized_path\":\"" . $contract[$i]['finalized_path'] . "\"} }";
        }
        echo $json;
    } elseif (isset($_GET['security_hash'])) {
        $data = $_GET['security_hash'];
        $obj_contract = new Contracts();
        $contract = $obj_contract->getInfoBySecurityHash($data);

        $json = "{\"contract\": {";
        for ($i = 0; $i < count($contract); $i++) {
            $json .= "\"contract_number\":\"" . $contract[$i]['contract_number'] . "\",";
            $json .= "\"city\":\"" . $contract[$i]['city'] . "\",";
            $json .= "\"date\":\"" . $contract[$i]['date'] . "\",";
            $json .= "\"provider_id\":\"" . $contract[$i]['provider_id'] . "\",";
            $json .= "\"provider_position\":\"" . $contract[$i]['provider_position'] . "\",";
            $json .= "\"provider_person\":\"" . $contract[$i]['provider_person'] . "\",";
            $json .= "\"provider_basis\":\"" . $contract[$i]['provider_basis'] . "\",";
            $json .= "\"customer_id\":\"" . $contract[$i]['customer_id'] . "\",";
            $json .= "\"customer_position\":\"" . $contract[$i]['customer_position'] . "\",";
            $json .= "\"customer_person\":\"" . $contract[$i]['customer_person'] . "\",";
            $json .= "\"customer_basis\":\"" . $contract[$i]['customer_basis'] . "\",";
            $json .= "\"classificatory_code\":\"" . $contract[$i]['classificatory_code'] . "\",";
            $json .= "\"contract_sum\":\"" . $contract[$i]['contract_sum'] . "\",";
            $json .= "\"paying_form\":\"" . $contract[$i]['paying_form'] . "\",";
            $json .= "\"condition_of_calculation\":\"" . $contract[$i]['condition_of_calculation'] . "\",";
            $json .= "\"terms_of_delivery\":\"" . $contract[$i]['terms_of_delivery'] . "\",";
            $json .= "\"provider_tax_status\":\"" . $contract[$i]['provider_tax_status'] . "\",";
            $json .= "\"expire_date\":\"" . $contract[$i]['expire_date'] . "\",";
            $json .= "\"contract_type\":\"" . $contract[$i]['contract_type'] . "\",";
            $json .= "\"finalize\":\"" . $contract[$i]['finalize'] . "\",";
            $json .= "\"security_hash\":\"" . $contract[$i]['security_hash'] . "\",";
            $json .= "\"file_hash\":\"" . $contract[$i]['file_hash'] . "\",";
            $json .= "\"finalized_path\":\"" . $contract[$i]['finalized_path'] . "\"} }";
        }
        echo $json;
    }
    if (isset($_GET['all'])) {
        $obj_contract = new Contracts();
        $contract = $obj_contract->getComplexAll();
        $json = json_encode($contract);
        echo $json;
    }
    if (isset($_GET['finalized'])) {
        $obj_contract = new Contracts();
        $contract = $obj_contract->getFinalizedComplexAll();
        $json = json_encode($contract);
        echo $json;
    }
    if (isset($_GET['getById'])) {
        $obj_contract = new Contracts();
        $contract = $obj_contract->getById($_GET['getById']);
        $json = json_encode($contract);
        echo $json;
    }
    if (isset($_GET['getByCustomer'])) {
        $obj_contract = new Contracts();
        $contract = $obj_contract->getAllByCustomerId($_GET['getByCustomer']);
        $json = json_encode($contract);
        echo $json;
    }
    if (isset($_GET['getFinalizedByCustomer'])) {
        $obj_contract = new Contracts();
        $contract = $obj_contract->getAllFinalizedByCustomerId($_GET['getFinalizedByCustomer']);
        $json = json_encode($contract);
        echo $json;
    }

    if (isset($_GET['allComplex'])) {
        $obj_contract = new Contracts();
        $contract = $obj_contract->getComplexAll();
        $json = "[";
        for ($i = 0; $i < count($contract); $i++) {
            $json .= "{";
            $json .= "\"contract\": {";
            $json .= "\"contract_number\":\"" . $contract[$i]['contract_number'] . "\",";
            $json .= "\"city\":\"" . $contract[$i]['city'] . "\",";
            $json .= "\"date\":\"" . $contract[$i]['date'] . "\",";
            $json .= "\"provider_id\":\"" . $contract[$i]['provider_id'] . "\",";
            $json .= "\"provider_position\":\"" . $contract[$i]['provider_position'] . "\",";
            $json .= "\"provider_person\":\"" . $contract[$i]['provider_person'] . "\",";
            $json .= "\"provider_basis\":\"" . $contract[$i]['provider_basis'] . "\",";
            $json .= "\"customer_id\":\"" . $contract[$i]['customer_id'] . "\",";
            $json .= "\"customer_position\":\"" . $contract[$i]['customer_position'] . "\",";
            $json .= "\"customer_person\":\"" . $contract[$i]['customer_person'] . "\",";
            $json .= "\"customer_basis\":\"" . $contract[$i]['customer_basis'] . "\",";
            $json .= "\"classificatory_code\":\"" . $contract[$i]['classificatory_code'] . "\",";
            $json .= "\"contract_sum\":\"" . $contract[$i]['contract_sum'] . "\",";
            $json .= "\"paying_form\":\"" . $contract[$i]['paying_form'] . "\",";
            $json .= "\"condition_of_calculation\":\"" . $contract[$i]['condition_of_calculation'] . "\",";
            $json .= "\"terms_of_delivery\":\"" . $contract[$i]['terms_of_delivery'] . "\",";
            $json .= "\"provider_tax_status\":\"" . $contract[$i]['provider_tax_status'] . "\",";
            $json .= "\"expire_date\":\"" . $contract[$i]['expire_date'] . "\",";
            $json .= "\"contract_type\":\"" . $contract[$i]['contract_type'] . "\",";
            $json .= "\"finalize\":\"" . $contract[$i]['finalize'] . "\",";
            $json .= "\"security_hash\":\"" . $contract[$i]['security_hash'] . "\",";
            $json .= "\"file_hash\":\"" . $contract[$i]['file_hash'] . "\",";
            $json .= "\"finalized_path\":\"" . $contract[$i]['finalized_path'] . "\"}";
            if ($i == count($contract) - 1) {
                $json .= "}";
            } else {
                $json .= "},";
            }
        }
        $json .= "]";
        echo $json;
    }
    if (isset($_GET['getComplexById'])) {
        $obj_contract = new Contracts();
        $contract = $obj_contract->getById($_GET['getComplexById']);
        $json = "[";
        for ($i = 0; $i < count($contract); $i++) {
            $json .= "{";
            $json .= "\"contract\": {";
            $json .= "\"contract_number\":\"" . $contract[$i]['contract_number'] . "\",";
            $json .= "\"city\":\"" . $contract[$i]['city'] . "\",";
            $json .= "\"date\":\"" . $contract[$i]['date'] . "\",";
            $json .= "\"provider_id\":\"" . $contract[$i]['provider_id'] . "\",";
            $json .= "\"provider_position\":\"" . $contract[$i]['provider_position'] . "\",";
            $json .= "\"provider_person\":\"" . $contract[$i]['provider_person'] . "\",";
            $json .= "\"provider_basis\":\"" . $contract[$i]['provider_basis'] . "\",";
            $json .= "\"customer_id\":\"" . $contract[$i]['customer_id'] . "\",";
            $json .= "\"customer_position\":\"" . $contract[$i]['customer_position'] . "\",";
            $json .= "\"customer_person\":\"" . $contract[$i]['customer_person'] . "\",";
            $json .= "\"customer_basis\":\"" . $contract[$i]['customer_basis'] . "\",";
            $json .= "\"classificatory_code\":\"" . $contract[$i]['classificatory_code'] . "\",";
            $json .= "\"contract_sum\":\"" . $contract[$i]['contract_sum'] . "\",";
            $json .= "\"paying_form\":\"" . $contract[$i]['paying_form'] . "\",";
            $json .= "\"condition_of_calculation\":\"" . $contract[$i]['condition_of_calculation'] . "\",";
            $json .= "\"terms_of_delivery\":\"" . $contract[$i]['terms_of_delivery'] . "\",";
            $json .= "\"provider_tax_status\":\"" . $contract[$i]['provider_tax_status'] . "\",";
            $json .= "\"expire_date\":\"" . $contract[$i]['expire_date'] . "\",";
            $json .= "\"contract_type\":\"" . $contract[$i]['contract_type'] . "\",";
            $json .= "\"finalize\":\"" . $contract[$i]['finalize'] . "\",";
            $json .= "\"security_hash\":\"" . $contract[$i]['security_hash'] . "\",";
            $json .= "\"file_hash\":\"" . $contract[$i]['file_hash'] . "\",";
            $json .= "\"finalized_path\":\"" . $contract[$i]['finalized_path'] . "\"}";
            if ($i == count($contract) - 1) {
                $json .= "}";
            } else {
                $json .= "},";
            }
        }
        $json .= "]";
        echo $json;
    }
}