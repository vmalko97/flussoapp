<?php

class Contracts
{
    private $data;

    public function __construct()
    {

    }

    public function getAll()
    {
        global $mysqli;
        $this->data = $mysqli->query("SELECT * FROM wf_contracts")->fetch_all(MYSQLI_ASSOC);
        return $this->data;
    }

    public function getById($id)
    {
        global $mysqli;
        $this->data = $mysqli->query("SELECT * FROM wf_contracts WHERE id = " . $id)->fetch_all(MYSQLI_ASSOC);
        return $this->data;
    }

    public function getAsyncDataJsonById($id)
    {
        $json = "{\"async_data\": {";
        global $mysqli;
        $contract = $mysqli->query("SELECT * FROM wf_contracts WHERE id=" . $id)->fetch_all(MYSQLI_ASSOC);
        for ($i = 0; $i < count($contract); $i++) {
            $json .= "\"contract_number\":\"" . $contract[$i]['contract_number'] . "\",";
            $json .= "\"city\":\"" . $contract[$i]['city'] . "\",";
            $json .= "\"date\":\"" . $contract[$i]['date'] . "\",";
            $json .= "\"provider\":\"" . $contract[$i]['provider_id'] . "\",";
            $json .= "\"provider_position\":\"" . $contract[$i]['provider_position'] . "\",";
            $json .= "\"provider_person\":\"" . $contract[$i]['provider_person'] . "\",";
            $json .= "\"provider_basis\":\"" . $contract[$i]['provider_basis'] . "\",";
            $json .= "\"customer\":\"" . $contract[$i]['customer_id'] . "\",";
            $json .= "\"customer_position\":\"" . $contract[$i]['customer_position'] . "\",";
            $json .= "\"customer_person\":\"" . $contract[$i]['customer_person'] . "\",";
            $json .= "\"customer_basis\":\"" . $contract[$i]['customer_basis'] . "\",";
            $json .= "\"classificatory_code\":\"" . $contract[$i]['classificatory_code'] . "\",";
            $json .= "\"contract_sum\":\"" . $contract[$i]['contract_sum'] . "\",";
            $json .= "\"paying_form\":\"" . $contract[$i]['paying_form'] . "\",";
            $json .= "\"condition_of_calculation\":\"" . $contract[$i]['condition_of_calculation'] . "\",";
            $json .= "\"terms_of_delivery\":\"" . $contract[$i]['terms_of_delivery'] . "\",";
            $json .= "\"provider_tax_status\":\"" . $contract[$i]['provider_tax_status'] . "\",";
            $json .= "\"expire_date\":\"" . $contract[$i]['expire_date'] . "\"} }";
        }
        return $json;
    }

    public function getFinalizeAsyncDataJsonById($id)
    {
        $json = "{\"async_data\": {";
        global $mysqli;
        $contract = $mysqli->query("SELECT * FROM wf_contracts WHERE id=" . $id)->fetch_all(MYSQLI_ASSOC);
        for ($i = 0; $i < count($contract); $i++) {
            $json .= "\"id\":\"" . $contract[$i]['id'] . "\",";
            $json .= "\"contract_number\":\"" . $contract[$i]['contract_number'] . "\",";
            $json .= "\"city\":\"" . $contract[$i]['city'] . "\",";
            $json .= "\"date\":\"" . $contract[$i]['date'] . "\",";
            $json .= "\"provider\":\"" . $contract[$i]['provider_id'] . "\",";
            $json .= "\"provider_position\":\"" . $contract[$i]['provider_position'] . "\",";
            $json .= "\"provider_person\":\"" . $contract[$i]['provider_person'] . "\",";
            $json .= "\"provider_basis\":\"" . $contract[$i]['provider_basis'] . "\",";
            $json .= "\"customer\":\"" . $contract[$i]['customer_id'] . "\",";
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
            $json .= "\"finalize\": 1 } }";
        }
        return $json;
    }

    public function create($contract_number, $city, $date, $provider_id, $provider_position, $provider_person, $provider_basis, $customer_id, $customer_position, $customer_person, $customer_basis, $classificatory_code, $contract_sum, $paying_form, $condition_of_calculation, $terms_of_delivery, $provider_tax_status, $expire_date, $contract_type, $finalize)
    {
        global $mysqli;
        $this->data = $mysqli->query("INSERT INTO wf_contracts (contract_number, city, date, provider_id, provider_position, provider_person, provider_basis, customer_id, customer_position, customer_person, customer_basis, classificatory_code, contract_sum, paying_form, condition_of_calculation, terms_of_delivery, provider_tax_status, expire_date, contract_type, finalize) 
                                            VALUES ('$contract_number', '$city', '$date', '$provider_id', '$provider_position', '$provider_person', '$provider_basis', '$customer_id', '$customer_position', '$customer_person', '$customer_basis', '$classificatory_code', '$contract_sum', '$paying_form', '$condition_of_calculation', '$terms_of_delivery', '$provider_tax_status', '$expire_date', '$contract_type',' $finalize')"
        );
        return $mysqli->insert_id;
    }

    public function createAndFinalize($contract_number, $city, $date, $provider_id, $provider_position, $provider_person, $provider_basis, $customer_id, $customer_position, $customer_person, $customer_basis, $classificatory_code, $contract_sum, $paying_form, $condition_of_calculation, $terms_of_delivery, $provider_tax_status, $expire_date, $contract_type, $finalize, $security_hash, $file_hash, $finalized_path)
    {
        global $mysqli;
        $this->data = $mysqli->query("INSERT INTO wf_contracts (contract_number, city, date, provider_id, provider_position, provider_person, provider_basis, customer_id, customer_position, customer_person, customer_basis, classificatory_code, contract_sum, paying_form, condition_of_calculation, terms_of_delivery, provider_tax_status, expire_date, contract_type, finalize, security_hash, file_hash, finalized_path) 
                                            VALUES ('$contract_number', '$city', '$date', '$provider_id', '$provider_position', '$provider_person', '$provider_basis', '$customer_id', '$customer_position', '$customer_person', '$customer_basis', '$classificatory_code', '$contract_sum', '$paying_form', '$condition_of_calculation', '$terms_of_delivery', '$provider_tax_status', '$expire_date', '$contract_type',' $finalize','$security_hash','$file_hash','$finalized_path')"
        );

        return $mysqli->insert_id;
    }

    public function deleteById($id)
    {
        global $mysqli;
        $this->data = $mysqli->query("DELETE FROM wf_contracts WHERE id=" . $id);
        return $this->data;
    }

    public function finalize($id, $security_hash, $file_hash, $finalized_path)
    {
        global $mysqli;
        $this->data = $mysqli->query("UPDATE wf_contracts SET finalize ='1', security_hash = '$security_hash', file_hash = '$file_hash', finalized_path = '$finalized_path' WHERE id=" . $id);
        return $this->data;
    }

    public function getComplexAll()
    {
        global $mysqli;
        $this->data = $mysqli->query("
SELECT
    wf_contracts.id,
    wf_contracts.contract_number,
    wf_contracts.city,
    wf_contracts.date,
    wf_contracts.provider_id,
    wf_companies.name AS provider,
    wf_contracts.provider_position,
    wf_contracts.provider_person,
    wf_contracts.provider_basis,
    wf_contracts.customer_id,
    wf_customers.name AS customer,
    wf_contracts.customer_position,
    wf_contracts.customer_person,
    wf_contracts.customer_basis,
    wf_contracts.classificatory_code,
    wf_contracts.contract_sum,
    wf_contracts.paying_form,
    wf_contracts.condition_of_calculation,
    wf_contracts.terms_of_delivery,
    wf_contracts.provider_tax_status,
    wf_contracts.expire_date,
    wf_contracts.contract_type,
    wf_contracts.finalize,
    wf_contracts.security_hash,
    wf_contracts.file_hash,
    wf_contracts.finalized_path
FROM
    wf_contracts,
    wf_customers,
    wf_companies
WHERE
        wf_contracts.provider_id = wf_companies.id AND
        wf_contracts.customer_id = wf_customers.id
ORDER BY
    wf_contracts.id
")->fetch_all(MYSQLI_ASSOC);
        return $this->data;
    }

    public function getFinalizedComplexAll()
    {
        global $mysqli;
        $this->data = $mysqli->query("
SELECT
    wf_contracts.id,
    wf_contracts.contract_number,
    wf_contracts.city,
    wf_contracts.date,
    wf_contracts.provider_id,
    wf_companies.name AS provider,
    wf_contracts.provider_position,
    wf_contracts.provider_person,
    wf_contracts.provider_basis,
    wf_contracts.customer_id,
    wf_customers.name AS customer,
    wf_contracts.customer_position,
    wf_contracts.customer_person,
    wf_contracts.customer_basis,
    wf_contracts.classificatory_code,
    wf_contracts.contract_sum,
    wf_contracts.paying_form,
    wf_contracts.condition_of_calculation,
    wf_contracts.terms_of_delivery,
    wf_contracts.provider_tax_status,
    wf_contracts.expire_date,
    wf_contracts.contract_type,
    wf_contracts.finalize,
    wf_contracts.security_hash,
    wf_contracts.file_hash,
    wf_contracts.finalized_path
FROM
    wf_contracts,
    wf_customers,
    wf_companies
WHERE
        wf_contracts.provider_id = wf_companies.id AND
        wf_contracts.customer_id = wf_customers.id AND
        wf_contracts.finalize = '1'
ORDER BY
    wf_contracts.id
")->fetch_all(MYSQLI_ASSOC);
        return $this->data;
    }

    public function getCustomer($contract_id)
    {
        global $mysqli;
        $contract = $this->getById($contract_id);
        $customer_id = $contract[0]['customer_id'];
        $this->data = $mysqli->query("SELECT * FROM wf_customers WHERE id =" . $customer_id)->fetch_all(MYSQLI_ASSOC);
        return $this->data;
    }

    public function getInfoByFileHash($hash)
    {
        global $mysqli;
        $this->data = $mysqli->query("SELECT * FROM wf_contracts WHERE file_hash = '$hash'")->fetch_all(MYSQLI_ASSOC);
        return $this->data;
    }

    public function getInfoBySecurityHash($hash)
    {
        global $mysqli;
        $this->data = $mysqli->query("SELECT * FROM wf_contracts WHERE security_hash = '$hash'")->fetch_all(MYSQLI_ASSOC);
        return $this->data;
    }

    public function getAllByCustomerId($id)
    {
        global $mysqli;
        $this->data = $mysqli->query("SELECT * FROM wf_contracts WHERE customer_id = '$id'")->fetch_all(MYSQLI_ASSOC);
        return $this->data;
    }

    public function getAllFinalizedByCustomerId($id)
    {
        global $mysqli;
        $this->data = $mysqli->query("SELECT * FROM wf_contracts WHERE customer_id = '$id' AND finalize = 1 ")->fetch_all(MYSQLI_ASSOC);
        return $this->data;
    }

    public function update($id, $contract_number, $city, $date, $provider_id, $provider_position, $provider_person, $provider_basis, $customer_id, $customer_position, $customer_person, $customer_basis, $classificatory_code, $contract_sum, $paying_form, $condition_of_calculation, $terms_of_delivery, $provider_tax_status, $expire_date, $contract_type, $finalize)
    {
        global $mysqli;
        $this->data = $mysqli->query("
UPDATE 
    wf_contracts 
SET
   contract_number = '$contract_number', 
   city = '$city', 
   date = '$date', 
   provider_id = '$provider_id', 
   provider_position = '$provider_position', 
   provider_person = '$provider_person', 
   provider_basis = '$provider_basis', 
   customer_id = '$customer_id', 
   customer_position = '$customer_position', 
   customer_person = '$customer_person', 
   customer_basis = '$customer_basis', 
   classificatory_code = '$classificatory_code', 
   contract_sum = '$contract_sum', 
   paying_form = '$paying_form', 
   condition_of_calculation = '$condition_of_calculation', 
   terms_of_delivery = '$terms_of_delivery', 
   provider_tax_status = '$provider_tax_status', 
   expire_date = '$expire_date', 
   contract_type = '$contract_type', 
   finalize = '$finalize'
WHERE
id = '$id'          
");
        return $this->data;
    }
}