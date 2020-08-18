<?php

class Service
{
    public $data;

    function __construct()
    {

    }

    /** Product categories **/

    public function getAllProductCategories()
    {
        global $mysqli;
        $this->data = $mysqli->query("SELECT * FROM wf_product_categories")->fetch_all(MYSQLI_ASSOC);
        return $this->data;
    }

    public function getProductCategoryById($id)
    {
        global $mysqli;
        $this->data = $mysqli->query("SELECT * FROM wf_product_categories WHERE id =" . $id)->fetch_all(MYSQLI_ASSOC);
        return $this->data;
    }

    public function addProductCategory($name)
    {
        global $mysqli;
        $this->data = $mysqli->query("INSERT INTO wf_product_categories (name) VALUES ('$name')");
        return $this->data;
    }

    public function updateProductCategory($id, $name)
    {
        global $mysqli;
        $this->data = $mysqli->query("UPDATE wf_product_categories SET name = '$name' WHERE id =" . $id);
        return $this->data;
    }

    public function deleteProductCategoryById($id)
    {
        global $mysqli;
        $this->data = $mysqli->query("DELETE FROM wf_product_categories WHERE id =" . $id);
        return $this->data;
    }

    /** Units **/
    public function getAllUnits()
    {
        global $mysqli;
        $this->data = $mysqli->query("SELECT * FROM wf_units")->fetch_all(MYSQLI_ASSOC);
        return $this->data;
    }

    public function getUnitById($id)
    {
        global $mysqli;
        $this->data = $mysqli->query("SELECT * FROM wf_units WHERE id =" . $id)->fetch_all(MYSQLI_ASSOC);
        return $this->data;
    }

    public function addUnit($name)
    {
        global $mysqli;
        $this->data = $mysqli->query("INSERT INTO wf_units (name) VALUES ('$name')");
        return $this->data;
    }

    public function updateUnit($id, $name)
    {
        global $mysqli;
        $this->data = $mysqli->query("UPDATE wf_units SET name = '$name' WHERE id =" . $id);
        return $this->data;
    }

    public function deleteUnitById($id)
    {
        global $mysqli;
        $this->data = $mysqli->query("DELETE FROM wf_units WHERE id =" . $id);
        return $this->data;
    }

    /** VAT types **/
    public function getAllVatTypes()
    {
        global $mysqli;
        $this->data = $mysqli->query("SELECT * FROM wf_vat_types")->fetch_all(MYSQLI_ASSOC);
        return $this->data;
    }

    public function getVatTypeById($id)
    {
        global $mysqli;
        $this->data = $mysqli->query("SELECT * FROM wf_vat_types WHERE id =" . $id)->fetch_all(MYSQLI_ASSOC);
        return $this->data;
    }

    public function addVatType($name, $percent)
    {
        global $mysqli;
        $this->data = $mysqli->query("INSERT INTO wf_vat_types (name,percent) VALUES ('$name', '$percent')");
        return $this->data;
    }

    public function updateVatType($id, $name, $percent)
    {
        global $mysqli;
        $this->data = $mysqli->query("UPDATE wf_vat_types SET name = '$name', percent = '$percent' WHERE id =" . $id);
        return $this->data;
    }

    public function deleteVatTypeById($id)
    {
        global $mysqli;
        $this->data = $mysqli->query("DELETE FROM wf_vat_types WHERE id =" . $id);
        return $this->data;
    }

    public function updateConfiguration($app_name, $app_description, $verifier_url, $license_key, $company_id)
    {
        global $mysqli;
        $this->data = $mysqli->query("UPDATE wf_configuration SET app_name = '$app_name', app_description = '$app_description', verifier_url = '$verifier_url', license_key = '$license_key', company_id = '$company_id' WHERE id = 1");
        return $this->data;
    }

    public function getConfig()
    {
        global $mysqli;
        $this->data = $mysqli->query("SELECT * FROM wf_configuration WHERE id = 1")->fetch_object();
        return $this->data;
    }

    public function getAPIKeys()
    {
        global $mysqli;
        $this->data = $mysqli->query("SELECT * FROM wf_private_api_keys ORDER BY id DESC")->fetch_all(MYSQLI_ASSOC);
        return $this->data;
    }

    public function deleteAPIKeyById($id)
    {
        global $mysqli;
        $this->data = $mysqli->query("DELETE FROM wf_private_api_keys WHERE id = '$id'");
        return $this->data;
    }

    public function updateStatusAPIKeyById($status,$id)
    {
        global $mysqli;
        $this->data = $mysqli->query("UPDATE wf_private_api_keys SET active = '$status' WHERE id = '$id'");
        return $this->data;
    }

    public function generateAPIKey()
    {
        global $mysqli;
        $key = bin2hex(random_bytes(32));
        $this->data = $mysqli->query("INSERT INTO wf_private_api_keys (api_key,active) VALUES ('$key','1')");
        return $this->data;
    }

    public function IsActiveAPIKey($key)
    {
        global $mysqli;
        $api = $mysqli->query("SELECT * FROM wf_private_api_keys WHERE api_key = '$key' ")->fetch_object();
        $this->data = $api->active;
        return $this->data;
    }
}