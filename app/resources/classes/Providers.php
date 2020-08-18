<?php

class Providers
{
    private $data;

    public function __construct()
    {
    }

    public function getAll()
    {
        global $mysqli;
        $this->data = $mysqli->query("SELECT * FROM wf_providers")->fetch_all(MYSQLI_ASSOC);
        return $this->data;
    }

    public function getById($id)
    {
        global $mysqli;
        $this->data = $mysqli->query("SELECT * FROM wf_providers WHERE id =" . $id)->fetch_all(MYSQLI_ASSOC);
        return $this->data;
    }

    public function add($name, $legal_address, $actual_address, $telephones, $code, $tax_number, $certificate_number, $director, $chief_accountant, $current_account, $bank_code,
                        $bank_name, $civil_contract_type, $vat, $email, $website, $additional_field_0, $additional_field_1, $additional_field_2, $additional_field_3, $additional_field_4)
    {
        global $mysqli;
        $this->data = $mysqli->query("INSERT INTO wf_providers (name, legal_address, actual_address, telephones, code, tax_number, certificate_number,
                          director, chief_accountant, current_account, bank_code, bank_name, civil_contract_type, vat,
                          email, website, additional_field_0, additional_field_1, additional_field_2,
                          additional_field_3, additional_field_4)
VALUES 
       ('$name', '$legal_address', '$actual_address', '$telephones', '$code', '$tax_number', '$certificate_number', '$director',
        '$chief_accountant', '$current_account', '$bank_code', '$bank_name', '$civil_contract_type',
        '$vat', '$email', '$website', '$additional_field_0', '$additional_field_1', '$additional_field_2',
        '$additional_field_3', '$additional_field_4')");
        return $this->data;
    }

    public function update($id, $name, $legal_address, $actual_address, $telephones, $code, $tax_number, $certificate_number, $director, $chief_accountant, $current_account, $bank_code,
                           $bank_name, $civil_contract_type, $vat, $email, $website, $additional_field_0, $additional_field_1, $additional_field_2, $additional_field_3, $additional_field_4)
    {
        global $mysqli;
        $this->data = $mysqli->query("UPDATE wf_providers SET name = '$name', legal_address = '$legal_address', actual_address = '$actual_address', telephones = '$telephones',
code = '$code', tax_number = '$tax_number', certificate_number = '$certificate_number', director = '$director', chief_accountant = '$chief_accountant', current_account = '$current_account',
bank_code = '$bank_code', bank_name = '$bank_name', civil_contract_type = '$civil_contract_type', vat = '$vat', email = '$email', website = '$website', additional_field_0 = '$additional_field_0',
additional_field_1 = '$additional_field_1', additional_field_2 = '$additional_field_2', additional_field_3 = '$additional_field_3', additional_field_4 = '$additional_field_4' WHERE id =".$id);
        return $this->data;
    }

    public function deleteById($id)
    {
        global $mysqli;
        $this->data = $mysqli->query("DELETE FROM wf_providers WHERE id =" . $id);
        return $this->data;
    }
}