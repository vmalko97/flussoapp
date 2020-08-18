<?php

class Specifications
{
    private $data;

    public function __construct()
    {

    }

    public function getAll()
    {
        global $mysqli;
        $this->data = $mysqli->query("SELECT * FROM wf_specifications")->fetch_all(MYSQLI_ASSOC);
        return $this->data;
    }

    public function getAsyncDataJsonById($id)
    {
        $json = "{\"async_data\": {";
        global $mysqli;
        $specification = $mysqli->query("SELECT * FROM wf_specifications WHERE id=" . $id)->fetch_all(MYSQLI_ASSOC);
        $record = $mysqli->query("SELECT * FROM wf_specification_records WHERE specification_id=" . $id . " ORDER BY position ASC")->fetch_all(MYSQLI_ASSOC);
        for ($i = 0; $i < count($specification); $i++) {
            $json .= "\"specification_number\":\"" . $specification[$i]['specification_number'] . "\",";
            $json .= "\"contract_id\":\"" . $specification[$i]['contract_id'] . "\",";
            $json .= "\"date\":\"" . $specification[$i]['date'] . "\",";
            $json .= "\"dataTable\":[";
            for ($j = 0, $count = count($record); $j < $count; $j++) {
                $json .= "{";
                $json .= "\"name\":\"" . $record[$j]['product_name'] . "\",";
                $json .= "\"units\":\"" . $record[$j]['units'] . "\",";
                $json .= "\"quantity\":\"" . $record[$j]['quantity'] . "\",";
                $json .= "\"price\":\"" . $record[$j]['price_without_vat'] . "\",";
                $json .= "\"sum\":\"" . $record[$j]['sum'] . "\"";
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
            $json .= "\"finalize\":\"" . $specification[$i]['finalize'] . "\"} }";
        }
        return $json;
    }

    public function getFinalizeAsyncDataJsonById($id)
    {
        $json = "{\"async_data\": {";
        global $mysqli;
        $specification = $mysqli->query("SELECT * FROM wf_specifications WHERE id=" . $id)->fetch_all(MYSQLI_ASSOC);
        $record = $mysqli->query("SELECT * FROM wf_specification_records WHERE specification_id=" . $id . " ORDER BY position ASC")->fetch_all(MYSQLI_ASSOC);
        for ($i = 0; $i < count($specification); $i++) {
            $json .= "\"id\":\"" . $specification[$i]['id'] . "\",";
            $json .= "\"specification\":\"" . $specification[$i]['specification_number'] . "\",";
            $json .= "\"contract_id\":\"" . $specification[$i]['contract_id'] . "\",";
            $json .= "\"date\":\"" . $specification[$i]['date'] . "\",";
            $json .= "\"dataTable\":[";
            for ($j = 0, $count = count($record); $j < $count; $j++) {
                $json .= "{";
                $json .= "\"name\":\"" . $record[$j]['product_name'] . "\",";
                $json .= "\"units\":\"" . $record[$j]['units'] . "\",";
                $json .= "\"quantity\":\"" . $record[$j]['quantity'] . "\",";
                $json .= "\"price\":\"" . $record[$j]['price_without_vat'] . "\",";
                $json .= "\"sum\":\"" . $record[$j]['sum'] . "\"";
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
            $json .= "\"finalize\": 1 } }";
        }
        return $json;
    }

    public function getComplexAll()
    {
        global $mysqli;
        $this->data = $mysqli->query("SELECT
       wf_specifications.id,
       wf_specifications.specification_number,
       wf_specifications.contract_id,
       wf_contracts.contract_number as contract,
       wf_specifications.date,
       wf_specifications.total_without_vat,
       wf_specifications.total,
       wf_specifications.vat,
       wf_specifications.finalize,
       wf_specifications.security_hash,
       wf_specifications.file_hash,
       wf_specifications.finalized_path
    FROM 
         wf_specifications, 
         wf_contracts
    WHERE 
      wf_specifications.contract_id = wf_contracts.id;
         ")->fetch_all(MYSQLI_ASSOC);
        return $this->data;
    }

    public function getFinalizedComplexAll()
    {
        global $mysqli;
        $this->data = $mysqli->query("SELECT
       wf_specifications.id,
       wf_specifications.specification_number,
       wf_specifications.contract_id,
       wf_contracts.contract_number as contract,
       wf_specifications.date,
       wf_specifications.total_without_vat,
       wf_specifications.total,
       wf_specifications.vat,
       wf_specifications.finalize,
       wf_specifications.security_hash,
       wf_specifications.file_hash,
       wf_specifications.finalized_path
    FROM 
         wf_specifications, 
         wf_contracts
    WHERE 
      wf_specifications.contract_id = wf_contracts.id AND
          wf_specifications.finalize = '1';
         ")->fetch_all(MYSQLI_ASSOC);
        return $this->data;
    }

    public function create($specification_number, $contract_id, $date, $total_without_vat, $total, $vat, $finalize, $dataTable)
    {
        global $mysqli;
        $this->data = $mysqli->query("INSERT INTO wf_specifications (specification_number, contract_id, date, total_without_vat, total, vat, finalize) 
                         VALUES ('$specification_number', '$contract_id', '$date', '$total_without_vat', '$total', '$vat', '$finalize')");
        $specification_id = $mysqli->insert_id;
        for ($i = 0; $i < count($dataTable); $i++) {
            $mysqli->query("INSERT INTO wf_specification_records (product_id,product_name,units,quantity,
                                                                   price_without_vat,vat,sum,specification_id,position) 
                         VALUES ('" . $dataTable[$i]['product_id'] . "', '" . $dataTable[$i]['product_name'] . "', 
                                 '" . $dataTable[$i]['units'] . "', '" . $dataTable[$i]['quantity'] . "', 
                                 '" . $dataTable[$i]['price_without_vat'] . "', '" . $dataTable[$i]['vat'] . "', 
                                 '" . $dataTable[$i]['sum'] . "', '" . $specification_id . "', 
                                 '" . $dataTable[$i]['position'] . "')");
        }
        return $specification_id;
    }

    public function createAndFinalize($specification_number, $contract_id, $date, $total_without_vat, $total, $vat, $finalize, $security_hash, $file_hash, $finalized_path, $dataTable)
    {
        global $mysqli;
        $this->data = $mysqli->query("INSERT INTO wf_specifications (specification_number, contract_id, date, total_without_vat, total, vat, finalize, security_hash, file_hash, finalized_path) 
                         VALUES ('$specification_number', '$contract_id', '$date', '$total_without_vat', '$total', '$vat', '$finalize', '$security_hash', '$file_hash', '$finalized_path')");
        $specification_id = $mysqli->insert_id;
        for ($i = 0; $i < count($dataTable); $i++) {
            $mysqli->query("INSERT INTO wf_specification_records (product_id,product_name,units,quantity,
                                                                   price_without_vat,vat,sum,specification_id,position) 
                         VALUES ('" . $dataTable[$i]['product_id'] . "', '" . $dataTable[$i]['product_name'] . "', 
                                 '" . $dataTable[$i]['units'] . "', '" . $dataTable[$i]['quantity'] . "', 
                                 '" . $dataTable[$i]['price_without_vat'] . "', '" . $dataTable[$i]['vat'] . "', 
                                 '" . $dataTable[$i]['sum'] . "', '" . $specification_id . "', 
                                 '" . $dataTable[$i]['position'] . "')");
        }
        return $specification_id;
    }

    public function finalize($id, $security_hash, $file_hash, $finalized_path)
    {
        global $mysqli;
        $this->data = $mysqli->query("UPDATE wf_specifications SET finalize ='1', security_hash = '$security_hash', file_hash = '$file_hash', finalized_path = '$finalized_path' WHERE id=" . $id);
        return $this->data;
    }

    public function deleteById($id)
    {
        global $mysqli;
        $this->data = $mysqli->query("DELETE FROM wf_specifications WHERE id=" . $id);
        $this->data = $mysqli->query("DELETE FROM wf_specification_records WHERE specification_id=" . $id);
        return $this->data;
    }

    public function deleteDataTableById($id)
    {
        global $mysqli;
        $this->data = $mysqli->query("DELETE FROM wf_specification_records WHERE specification_id=" . $id);
        return $this->data;
    }

    public function getInfoByFileHash($hash)
    {
        global $mysqli;
        $this->data = $mysqli->query("SELECT * FROM wf_specifications WHERE file_hash = '$hash'")->fetch_all(MYSQLI_ASSOC);
        return $this->data;
    }

    public function getInfoBySecurityHash($hash)
    {
        global $mysqli;
        $this->data = $mysqli->query("SELECT * FROM wf_specifications WHERE security_hash = '$hash'")->fetch_all(MYSQLI_ASSOC);
        return $this->data;
    }

    public function getDataTableById($id)
    {
        global $mysqli;
        $this->data = $mysqli->query("SELECT * FROM wf_specification_records WHERE specification_id =" . $id . " ORDER BY position ASC")->fetch_all(MYSQLI_ASSOC);
        return $this->data;
    }

    public function getById($id)
    {
        global $mysqli;
        $this->data = $mysqli->query("SELECT * FROM wf_specifications WHERE id = '$id'")->fetch_all(MYSQLI_ASSOC);
        return $this->data;
    }

    public function getAllByContractId($id)
    {
        global $mysqli;
        $this->data = $mysqli->query("SELECT * FROM wf_specifications WHERE contract_id = '$id'")->fetch_all(MYSQLI_ASSOC);
        return $this->data;
    }

    public function getAllFinalizedByContractId($id)
    {
        global $mysqli;
        $this->data = $mysqli->query("SELECT * FROM wf_specifications WHERE contract_id = '$id' AND finalize = 1 ")->fetch_all(MYSQLI_ASSOC);
        return $this->data;
    }

    public function update($id, $contract_id, $specification, $date, $total_without_vat, $total_vat, $total_with_vat, $finalize, $dataTable)
    {
        global $mysqli;
        $this->data = $mysqli->query("
UPDATE 
    wf_specifications 
SET
    contract_id = '$contract_id',
    specification_number = '$specification',
    date = '$date',
    total_without_vat = '$total_without_vat',
    vat = '$total_vat',
    total = '$total_with_vat',
    finalize = '$finalize'
WHERE
    id ='$id'
    ");
        for ($i = 0; $i < count($dataTable); $i++) {
            $mysqli->query("INSERT INTO wf_specification_records (product_id,product_name,units,quantity,
                                                                   price_without_vat,vat,sum,specification_id,position) 
                         VALUES ('" . $dataTable[$i]['product_id'] . "', '" . $dataTable[$i]['product_name'] . "', 
                                 '" . $dataTable[$i]['units'] . "', '" . $dataTable[$i]['quantity'] . "', 
                                 '" . $dataTable[$i]['price_without_vat'] . "', '" . $dataTable[$i]['vat'] . "', 
                                 '" . $dataTable[$i]['sum'] . "', '" . $id . "', 
                                 '" . $dataTable[$i]['position'] . "')");
        }
        return $this->data;
    }
}