<?php

class IncomingWaybills
{

    private $data;

    public function __construct()
    {

    }

    public function create($invoice_number, $company_id, $receiver_customer_id, $payer_customer_id, $same, $condition_of_sale, $date,
                           $total_without_vat, $total, $vat, $finalize, $dataTable)
    {
        global $mysqli;
        $this->data = $mysqli->query("INSERT INTO wf_incoming_waybills (waybill_number, company_id, receiver_customer_id, 
                                                                     payer_customer_id, same, condition_of_sale, date, total_without_vat, 
                                                                     total, vat, finalize) 
                         VALUES ('$invoice_number', '$company_id', '$receiver_customer_id', '$payer_customer_id', 
                                 '$same', '$condition_of_sale', '$date', '$total_without_vat', '$total', '$vat',
                                 '$finalize')");
        $inv_id = $mysqli->insert_id;
        for ($i = 0; $i < count($dataTable); $i++) {
            $mysqli->query("INSERT INTO wf_incoming_waybill_records (product_id,product_name,units,quantity,
                                                                   price_without_vat,vat,sum,waybill_id,position) 
                         VALUES ('" . $dataTable[$i]['product_id'] . "', '" . $dataTable[$i]['product_name'] . "', 
                                 '" . $dataTable[$i]['units'] . "', '" . $dataTable[$i]['quantity'] . "', 
                                 '" . $dataTable[$i]['price_without_vat'] . "', '" . $dataTable[$i]['vat'] . "', 
                                 '" . $dataTable[$i]['sum'] . "', '" . $inv_id . "', 
                                 '" . $dataTable[$i]['position'] . "')");
        }
        return $mysqli->insert_id;
    }

    public function createAndFinalize($waybill_number, $company_id, $receiver_customer_id, $payer_customer_id, $same, $condition_of_sale, $date,
                                      $total_without_vat, $total, $vat, $finalize, $security_hash, $file_hash, $finalized_path, $dataTable)
    {
        global $mysqli;
        $this->data = $mysqli->query("INSERT INTO wf_incoming_waybills (waybill_number, company_id, receiver_customer_id, 
                                                                     payer_customer_id, same, condition_of_sale, date, total_without_vat, 
                                                                     total, vat, finalize,security_hash,file_hash, finalized_path) 
                         VALUES ('$waybill_number', '$company_id', '$receiver_customer_id', '$payer_customer_id', 
                                 '$same','$condition_of_sale', '$date', '$total_without_vat', '$total', '$vat',
                                 '$finalize','$security_hash', '$file_hash', '$finalized_path')");
        $inv_id = $mysqli->insert_id;
        for ($i = 0; $i < count($dataTable); $i++) {
            $mysqli->query("INSERT INTO wf_incoming_waybill_records (product_id,product_name,units,quantity,
                                                                   price_without_vat,vat,sum,waybill_id,position) 
                         VALUES ('" . $dataTable[$i]['product_id'] . "', '" . $dataTable[$i]['product_name'] . "', 
                                 '" . $dataTable[$i]['units'] . "', '" . $dataTable[$i]['quantity'] . "', 
                                 '" . $dataTable[$i]['price_without_vat'] . "', '" . $dataTable[$i]['vat'] . "', 
                                 '" . $dataTable[$i]['sum'] . "', '" . $inv_id . "', 
                                 '" . $dataTable[$i]['position'] . "')");
        }
        return $mysqli->insert_id;
    }

    public function getAsyncDataJsonById($id)
    {
        $json = "{\"async_data\": {";
        global $mysqli;
        $waybill = $mysqli->query("SELECT * FROM wf_incoming_waybills WHERE id=" . $id)->fetch_all(MYSQLI_ASSOC);
        $record = $mysqli->query("SELECT * FROM wf_incoming_waybill_records WHERE waybill_id=" . $id . " ORDER BY position ASC")->fetch_all(MYSQLI_ASSOC);
        for ($i = 0; $i < count($waybill); $i++) {
            $json .= "\"provider\":\"" . $waybill[$i]['company_id'] . "\",";
            $json .= "\"customer\":\"" . $waybill[$i]['receiver_customer_id'] . "\",";
            $json .= "\"payer\":\"" . $waybill[$i]['payer_customer_id'] . "\",";
            $json .= "\"same\":\"" . $waybill[$i]['same'] . "\",";
            $json .= "\"condition_of_sale\":\"" . $waybill[$i]['condition_of_sale'] . "\",";
            $json .= "\"waybill\":\"" . $waybill[$i]['waybill_number'] . "\",";
            $json .= "\"date\":\"" . $waybill[$i]['date'] . "\",";
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
            $json .= "\"total_without_vat\":\"" . $waybill[$i]['total_without_vat'] . "\",";
            //  $json .= "vat:" . $waybill[$i][''] . ",";
            $json .= "\"total_vat\":\"" . $waybill[$i]['vat'] . "\",";
            $json .= "\"total_with_vat\":\"" . $waybill[$i]['total'] . "\",";
            $json .= "\"finalize\":\"" . $waybill[$i]['finalize'] . "\"} }";
        }
        return $json;
    }

    public function getFinalizeAsyncDataJsonById($id)
    {
        $json = "{\"async_data\": {";
        global $mysqli;
        $waybill = $mysqli->query("SELECT * FROM wf_incoming_waybills WHERE id=" . $id)->fetch_all(MYSQLI_ASSOC);
        $record = $mysqli->query("SELECT * FROM wf_incoming_waybill_records WHERE waybill_id=" . $id . " ORDER BY position ASC")->fetch_all(MYSQLI_ASSOC);
        for ($i = 0; $i < count($waybill); $i++) {
            $json .= "\"id\":\"" . $waybill[$i]['id'] . "\",";
            $json .= "\"provider\":\"" . $waybill[$i]['company_id'] . "\",";
            $json .= "\"customer\":\"" . $waybill[$i]['receiver_customer_id'] . "\",";
            $json .= "\"payer\":\"" . $waybill[$i]['payer_customer_id'] . "\",";
            $json .= "\"same\":\"" . $waybill[$i]['same'] . "\",";
            $json .= "\"condition_of_sale\":\"" . $waybill[$i]['condition_of_sale'] . "\",";
            $json .= "\"waybill\":\"" . $waybill[$i]['waybill_number'] . "\",";
            $json .= "\"date\":\"" . $waybill[$i]['date'] . "\",";
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
            $json .= "\"total_without_vat\":\"" . $waybill[$i]['total_without_vat'] . "\",";
            //  $json .= "vat:" . $waybill[$i][''] . ",";
            $json .= "\"total_vat\":\"" . $waybill[$i]['vat'] . "\",";
            $json .= "\"total_with_vat\":\"" . $waybill[$i]['total'] . "\",";
            $json .= "\"finalize\": 1 } }";
        }
        return $json;
    }

    public function getComplexAll()
    {
        global $mysqli;
        $this->data = $mysqli->query("SELECT wf_incoming_waybills.id, wf_incoming_waybills.waybill_number, wf_incoming_waybills.company_id, wf_companies.name AS receiver, wf_incoming_waybills.payer_customer_id, wf_incoming_waybills.same, wf_incoming_waybills.condition_of_sale, wf_incoming_waybills.date, wf_incoming_waybills.total_without_vat, wf_incoming_waybills.total, wf_incoming_waybills.vat, wf_incoming_waybills.finalize, wf_incoming_waybills.security_hash, wf_incoming_waybills.file_hash, wf_incoming_waybills.finalized_path FROM wf_incoming_waybills, wf_companies WHERE wf_incoming_waybills.receiver_customer_id = wf_companies.id ORDER BY waybill_number DESC")->fetch_all(MYSQLI_ASSOC);
        return $this->data;
    }

    public function getFinalizedComplexAll()
    {
        global $mysqli;
        $this->data = $mysqli->query("SELECT wf_incoming_waybills.id, wf_incoming_waybills.waybill_number, wf_incoming_waybills.company_id, wf_customers.name AS receiver, wf_incoming_waybills.payer_customer_id, wf_incoming_waybills.same, wf_incoming_waybills.condition_of_sale, wf_incoming_waybills.date, wf_incoming_waybills.total_without_vat, wf_incoming_waybills.total, wf_incoming_waybills.vat, wf_incoming_waybills.finalize, wf_incoming_waybills.security_hash, wf_incoming_waybills.file_hash, wf_incoming_waybills.finalized_path FROM wf_incoming_waybills, wf_customers WHERE wf_incoming_waybills.receiver_customer_id = wf_customers.id AND wf_incoming_waybills.finalize = '1' ORDER BY waybill_number DESC")->fetch_all(MYSQLI_ASSOC);
        return $this->data;
    }

    public function deleteById($id)
    {
        global $mysqli;
        $this->data = $mysqli->query("DELETE FROM wf_incoming_waybills WHERE id=" . $id);
        $this->data = $mysqli->query("DELETE FROM wf_incoming_waybill_records WHERE waybill_id=" . $id);
        return $this->data;
    }

    public function deleteDataTableById($id)
    {
        global $mysqli;
        $this->data = $mysqli->query("DELETE FROM wf_incoming_waybill_records WHERE waybill_id=" . $id);
        return $this->data;
    }

    public function finalize($id, $security_hash, $file_hash, $finalized_path)
    {
        global $mysqli;
        $this->data = $mysqli->query("UPDATE wf_incoming_waybills SET finalize ='1', security_hash = '$security_hash', file_hash = '$file_hash', finalized_path = '$finalized_path' WHERE id=" . $id);
        return $this->data;
    }

    public function getInfoByFileHash($hash)
    {
        global $mysqli;
        $this->data = $mysqli->query("SELECT * FROM wf_incoming_waybills WHERE file_hash = '$hash'")->fetch_all(MYSQLI_ASSOC);
        return $this->data;
    }

    public function getInfoBySecurityHash($hash)
    {
        global $mysqli;
        $this->data = $mysqli->query("SELECT * FROM wf_incoming_waybills WHERE security_hash = '$hash'")->fetch_all(MYSQLI_ASSOC);
        return $this->data;
    }

    public function getDataTableById($id)
    {
        global $mysqli;
        $this->data = $mysqli->query("SELECT * FROM wf_incoming_waybill_records WHERE waybill_id =" . $id . " ORDER BY position ASC")->fetch_all(MYSQLI_ASSOC);
        return $this->data;
    }

    public function getAllByCustomerId($id)
    {
        global $mysqli;
        $this->data = $mysqli->query("SELECT * FROM wf_incoming_waybills WHERE receiver_customer_id = '$id'")->fetch_all(MYSQLI_ASSOC);
        return $this->data;
    }

    public function getAllFinalizedByCustomerId($id)
    {
        global $mysqli;
        $this->data = $mysqli->query("SELECT * FROM wf_incoming_waybills WHERE receiver_customer_id = '$id' AND finalize = 1 ")->fetch_all(MYSQLI_ASSOC);
        return $this->data;
    }

    public function getById($id)
    {
        global $mysqli;
        $this->data = $mysqli->query("SELECT * FROM wf_incoming_waybills WHERE id = '$id'")->fetch_all(MYSQLI_ASSOC);
        return $this->data;
    }

    public function update($id, $waybill_number, $company_id, $receiver_customer_id, $payer_customer_id, $same, $condition_of_sale, $date,
                           $total_without_vat, $total, $vat, $finalize, $dataTable)
    {
        global $mysqli;
        $this->data = $mysqli->query("
UPDATE 
    wf_incoming_waybills 
SET
    waybill_number ='$waybill_number',
    company_id = '$company_id',
    receiver_customer_id ='$receiver_customer_id',
    payer_customer_id = '$payer_customer_id',
    same = '$same',
    condition_of_sale = '$condition_of_sale',
    date = '$date',
    total_without_vat = '$total_without_vat',
    total = '$total',
    vat = '$vat',
    finalize = '$finalize'
WHERE
    id ='$id'
    ");
        for ($i = 0; $i < count($dataTable); $i++) {
            $mysqli->query("INSERT INTO wf_incoming_waybill_records (product_id,product_name,units,quantity,
                                                                   price_without_vat,vat,sum,waybill_id,position) 
                         VALUES ('" . $dataTable[$i]['product_id'] . "', '" . $dataTable[$i]['product_name'] . "', 
                                 '" . $dataTable[$i]['units'] . "', '" . $dataTable[$i]['quantity'] . "', 
                                 '" . $dataTable[$i]['price_without_vat'] . "', '" . $dataTable[$i]['vat'] . "', 
                                 '" . $dataTable[$i]['sum'] . "', '" . $id . "', 
                                 '" . $dataTable[$i]['position'] . "')");
        }
        return $this->data;
    }
}
