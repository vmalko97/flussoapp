<?php

class Products
{
    private $data;

    public function __construct()
    {
    }

    public function getAll()
    {
        global $mysqli;
        $this->data = $mysqli->query(
            "SELECT  wf_products.id,
                            wf_products.name,
                            wf_units.name AS units,
                            wf_products.price,
                            wf_products.count,
                            wf_products.infinity,
                            wf_vat_types.name AS vat,
                            wf_product_categories.name AS category
                    FROM
                            wf_products, wf_units, wf_vat_types, wf_product_categories 
                    WHERE 
                            wf_products.unit_id = wf_units.id AND 
                            wf_products.vat_type_id = wf_vat_types.id AND 
                            wf_products.category_id = wf_product_categories.id")->fetch_all(MYSQLI_ASSOC);
        return $this->data;
    }

    public function getById($id)
    {
        global $mysqli;
        $this->data = $mysqli->query(
            "SELECT * FROM wf_products WHERE id =" . $id)->fetch_all(MYSQLI_ASSOC);
        return $this->data;
    }

    public function getComplexById($id)
    {
        global $mysqli;
        $this->data = $mysqli->query(
            "SELECT  wf_products.id,
                            wf_products.name,
                            wf_units.name AS units,
                            wf_products.price,
                            wf_products.count,
                            wf_products.infinity,
                            wf_vat_types.name AS vat,
                            wf_product_categories.name AS category
                    FROM
                            wf_products, wf_units, wf_vat_types, wf_product_categories 
                    WHERE 
                            wf_products.unit_id = wf_units.id AND 
                            wf_products.vat_type_id = wf_vat_types.id AND 
                            wf_products.category_id = wf_product_categories.id AND
                            wf_products.id =" . $id)->fetch_all(MYSQLI_ASSOC);
        return $this->data;
    }

    public function add($name, $unit_id, $price, $count, $infinity, $vat_type_id, $category_id)
    {
        global $mysqli;
        $this->data = $mysqli->query(
            "INSERT INTO wf_products (name, unit_id, price, count, infinity, vat_type_id, category_id) 
                    VALUES
                           ('$name','$unit_id','$price','$count','$infinity','$vat_type_id','$category_id')");
        return $this->data;
    }

    public function update($id, $name, $unit_id, $price, $count, $infinity, $vat_type_id, $category_id)
    {
        global $mysqli;
        $this->data = $mysqli->query(
            "UPDATE wf_products 
                    SET
                        name='$name',
                        unit_id='$unit_id',
                        price='$price',
                        count='$count',
                        infinity='$infinity',
                        vat_type_id='$vat_type_id',
                        category_id='$category_id'
                    WHERE 
                          id =" . $id);
        return $this->data;
    }

    public function deleteById($id)
    {
        global $mysqli;
        $this->data = $mysqli->query("DELETE FROM wf_products WHERE id =" . $id);
        return $this->data;
    }
}