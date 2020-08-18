<?php

class Invoices
{

    private $data;

    public function __construct()
    {

    }

    public function create($invoice_number, $company_id, $receiver_customer_id, $payer_customer_id, $same, $date,
                           $total_without_vat, $total, $vat, $written_by, $finalize, $dataTable)
    {
        global $mysqli;
        $this->data = $mysqli->query("INSERT INTO wf_invoices (invoce_number, company_id, receiver_customer_id, 
                                                                     payer_customer_id, same, date, total_without_vat, 
                                                                     total, vat, written_by, finalize) 
                         VALUES ('$invoice_number', '$company_id', '$receiver_customer_id', '$payer_customer_id', 
                                 '$same', '$date', '$total_without_vat', '$total', '$vat', '$written_by',
                                 '$finalize')");
        $inv_id = $mysqli->insert_id;
        for ($i = 0; $i < count($dataTable); $i++) {
            $mysqli->query("INSERT INTO wf_invoice_records (product_id,product_name,units,quantity,
                                                                   price_without_vat,vat,sum,invoice_id,position) 
                         VALUES ('" . $dataTable[$i]['product_id'] . "', '" . $dataTable[$i]['product_name'] . "', 
                                 '" . $dataTable[$i]['units'] . "', '" . $dataTable[$i]['quantity'] . "', 
                                 '" . $dataTable[$i]['price_without_vat'] . "', '" . $dataTable[$i]['vat'] . "', 
                                 '" . $dataTable[$i]['sum'] . "', '" . $inv_id . "', 
                                 '" . $dataTable[$i]['position'] . "')");
        }
        return $mysqli->insert_id;
    }

    public function createAndFinalize($invoice_number, $company_id, $receiver_customer_id, $payer_customer_id, $same, $date,
                                      $total_without_vat, $total, $vat, $written_by, $finalize, $security_hash, $file_hash, $finalized_path, $dataTable)
    {
        global $mysqli;
        $this->data = $mysqli->query("INSERT INTO wf_invoices (invoce_number, company_id, receiver_customer_id, 
                                                                     payer_customer_id, same, date, total_without_vat, 
                                                                     total, vat, written_by, finalize,security_hash,file_hash, finalized_path) 
                         VALUES ('$invoice_number', '$company_id', '$receiver_customer_id', '$payer_customer_id', 
                                 '$same', '$date', '$total_without_vat', '$total', '$vat', '$written_by',
                                 '$finalize','$security_hash', '$file_hash', '$finalized_path')");
        $inv_id = $mysqli->insert_id;
        for ($i = 0; $i < count($dataTable); $i++) {
            $mysqli->query("INSERT INTO wf_invoice_records (product_id,product_name,units,quantity,
                                                                   price_without_vat,vat,sum,invoice_id,position) 
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
//        {
//                            function: async,
//                            async_data: {
//                                provider: provider,
//                                customer: customer,
//                                payer: payer,
//                                same: same,
//                                invoice: invoice,
//                                date: date,
//                                dataTable: dataTable,
//                                total_without_vat: total_without_vat,
//                                vat: vat,
//                                total_vat: total_vat,
//                                total_with_vat: total_with_vat,
//                                written_by: written_by,
//                                finalize: finalize
//                            }
//                        }
        $json = "{\"async_data\": {";
        global $mysqli;
        $invoice = $mysqli->query("SELECT * FROM wf_invoices WHERE id=" . $id)->fetch_all(MYSQLI_ASSOC);
        $record = $mysqli->query("SELECT * FROM wf_invoice_records WHERE invoice_id=" . $id . " ORDER BY position ASC")->fetch_all(MYSQLI_ASSOC);
        for ($i = 0; $i < count($invoice); $i++) {
            $json .= "\"provider\":\"" . $invoice[$i]['company_id'] . "\",";
            $json .= "\"customer\":\"" . $invoice[$i]['receiver_customer_id'] . "\",";
            $json .= "\"payer\":\"" . $invoice[$i]['payer_customer_id'] . "\",";
            $json .= "\"same\":\"" . $invoice[$i]['same'] . "\",";
            $json .= "\"invoice\":\"" . $invoice[$i]['invoce_number'] . "\",";
            $json .= "\"date\":\"" . $invoice[$i]['date'] . "\",";
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
            $json .= "\"total_without_vat\":\"" . $invoice[$i]['total_without_vat'] . "\",";
            //  $json .= "vat:" . $invoice[$i][''] . ",";
            $json .= "\"total_vat\":\"" . $invoice[$i]['vat'] . "\",";
            $json .= "\"total_with_vat\":\"" . $invoice[$i]['total'] . "\",";
            $json .= "\"written_by\":\"" . $invoice[$i]['written_by'] . "\",";
            $json .= "\"finalize\":\"" . $invoice[$i]['finalize'] . "\"} }";
        }
        return $json;
    }

    public function getFinalizeAsyncDataJsonById($id)
    {
        $json = "{\"async_data\": {";
        global $mysqli;
        $invoice = $mysqli->query("SELECT * FROM wf_invoices WHERE id=" . $id)->fetch_all(MYSQLI_ASSOC);
        $record = $mysqli->query("SELECT * FROM wf_invoice_records WHERE invoice_id=" . $id . " ORDER BY position ASC")->fetch_all(MYSQLI_ASSOC);
        for ($i = 0; $i < count($invoice); $i++) {
            $json .= "\"id\":\"" . $invoice[$i]['id'] . "\",";
            $json .= "\"provider\":\"" . $invoice[$i]['company_id'] . "\",";
            $json .= "\"customer\":\"" . $invoice[$i]['receiver_customer_id'] . "\",";
            $json .= "\"payer\":\"" . $invoice[$i]['payer_customer_id'] . "\",";
            $json .= "\"same\":\"" . $invoice[$i]['same'] . "\",";
            $json .= "\"invoice\":\"" . $invoice[$i]['invoce_number'] . "\",";
            $json .= "\"date\":\"" . $invoice[$i]['date'] . "\",";
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
            $json .= "\"total_without_vat\":\"" . $invoice[$i]['total_without_vat'] . "\",";
            //  $json .= "vat:" . $invoice[$i][''] . ",";
            $json .= "\"total_vat\":\"" . $invoice[$i]['vat'] . "\",";
            $json .= "\"total_with_vat\":\"" . $invoice[$i]['total'] . "\",";
            $json .= "\"written_by\":\"" . $invoice[$i]['written_by'] . "\",";
            $json .= "\"finalize\": 1 } }";
        }
        return $json;
    }

    public function getComplexAll()
    {
        global $mysqli;
        $this->data = $mysqli->query("SELECT wf_invoices.id, wf_invoices.invoce_number, wf_invoices.company_id, wf_customers.name AS receiver, wf_invoices.payer_customer_id, wf_invoices.same, wf_invoices.date, wf_invoices.total_without_vat, wf_invoices.total, wf_invoices.vat, wf_invoices.written_by, wf_invoices.finalize, wf_invoices.security_hash, wf_invoices.file_hash, wf_invoices.finalized_path FROM wf_invoices, wf_customers WHERE wf_invoices.receiver_customer_id = wf_customers.id ORDER BY invoce_number DESC")->fetch_all(MYSQLI_ASSOC);
        return $this->data;
    }

    public function getFinalizedComplexAll()
    {
        global $mysqli;
        $this->data = $mysqli->query("SELECT wf_invoices.id, wf_invoices.invoce_number, wf_invoices.company_id, wf_customers.name AS receiver, wf_invoices.payer_customer_id, wf_invoices.same, wf_invoices.date, wf_invoices.total_without_vat, wf_invoices.total, wf_invoices.vat, wf_invoices.written_by, wf_invoices.finalize, wf_invoices.security_hash, wf_invoices.file_hash, wf_invoices.finalized_path FROM wf_invoices, wf_customers WHERE wf_invoices.receiver_customer_id = wf_customers.id AND wf_invoices.finalize = '1' ORDER BY invoce_number DESC")->fetch_all(MYSQLI_ASSOC);
        return $this->data;
    }

    public function deleteById($id)
    {
        global $mysqli;
        $this->data = $mysqli->query("DELETE FROM wf_invoices WHERE id=" . $id);
        $this->data = $mysqli->query("DELETE FROM wf_invoice_records WHERE invoice_id=" . $id);
        return $this->data;
    }


    public function deleteDataTableById($id)
    {
        global $mysqli;
        $this->data = $mysqli->query("DELETE FROM wf_invoice_records WHERE invoice_id=" . $id);
        return $this->data;
    }

    public function finalize($id, $security_hash, $file_hash, $finalized_path)
    {
        global $mysqli;
        $this->data = $mysqli->query("UPDATE wf_invoices SET finalize ='1', security_hash = '$security_hash', file_hash = '$file_hash', finalized_path = '$finalized_path' WHERE id=" . $id);
        return $this->data;
    }

    public function getInfoByFileHash($hash)
    {
        global $mysqli;
        $this->data = $mysqli->query("SELECT * FROM wf_invoices WHERE file_hash = '$hash'")->fetch_all(MYSQLI_ASSOC);
        return $this->data;
    }

    public function getInfoBySecurityHash($hash)
    {
        global $mysqli;
        $this->data = $mysqli->query("SELECT * FROM wf_invoices WHERE security_hash = '$hash'")->fetch_all(MYSQLI_ASSOC);
        return $this->data;
    }

    public function getDataTableById($id)
    {
        global $mysqli;
        $this->data = $mysqli->query("SELECT * FROM wf_invoice_records WHERE invoice_id=" . $id . " ORDER BY position ASC")->fetch_all(MYSQLI_ASSOC);
        return $this->data;
    }
    public function getAllByCustomerId($id)
    {
        global $mysqli;
        $this->data = $mysqli->query("SELECT * FROM wf_invoices WHERE receiver_customer_id = '$id'")->fetch_all(MYSQLI_ASSOC);
        return $this->data;
    }

    public function getAllFinalizedByCustomerId($id)
    {
        global $mysqli;
        $this->data = $mysqli->query("SELECT * FROM wf_invoices WHERE receiver_customer_id = '$id' AND finalize = 1 ")->fetch_all(MYSQLI_ASSOC);
        return $this->data;
    }
    public function getById($id)
    {
        global $mysqli;
        $this->data = $mysqli->query("SELECT * FROM wf_invoices WHERE id = '$id'")->fetch_all(MYSQLI_ASSOC);
        return $this->data;
    }

    public function update($id, $invoice_number, $company_id, $receiver_customer_id, $payer_customer_id, $same, $date,
                           $total_without_vat, $total, $vat, $written_by, $finalize, $dataTable)
    {
        global $mysqli;
        $this->data = $mysqli->query("
UPDATE 
    wf_invoices 
SET
    invoce_number ='$invoice_number',
    company_id = '$company_id',
    receiver_customer_id ='$receiver_customer_id',
    payer_customer_id = '$payer_customer_id',
    same = '$same',
    date = '$date',
    total_without_vat = '$total_without_vat',
    total = '$total',
    vat = '$vat',
    written_by = '$written_by',
    finalize = '$finalize'
WHERE
    id ='$id'
    ");
        for ($i = 0; $i < count($dataTable); $i++) {
            $mysqli->query("INSERT INTO wf_invoice_records (product_id,product_name,units,quantity,
                                                                   price_without_vat,vat,sum,invoice_id,position) 
                         VALUES ('" . $dataTable[$i]['product_id'] . "', '" . $dataTable[$i]['product_name'] . "', 
                                 '" . $dataTable[$i]['units'] . "', '" . $dataTable[$i]['quantity'] . "', 
                                 '" . $dataTable[$i]['price_without_vat'] . "', '" . $dataTable[$i]['vat'] . "', 
                                 '" . $dataTable[$i]['sum'] . "', '" . $id . "', 
                                 '" . $dataTable[$i]['position'] . "')");
        }
        return $this->data;
    }
}
