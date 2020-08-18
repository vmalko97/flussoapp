<?php

class KeyInspector
{
    public $data;

    public function __construct()
    {

    }

    public function getDocumentType($hash){
        global $mysqli;
        $secure = $mysqli->query("SELECT * FROM wf_secure WHERE security_hash = '$hash'")->fetch_all(MYSQLI_ASSOC);
        $this->data = $secure[0]['document_type'];
        return $this->data;
    }

    public function inspect($hash)
    {
        global $mysqli;

        $secure = $mysqli->query("SELECT * FROM wf_secure WHERE security_hash = '$hash'")->fetch_all(MYSQLI_ASSOC);

        switch ($secure[0]['document_type']) {

            case 'invoice':
                $API_PATH = PUBLIC_API_URL . "invoice.php?security_hash=" . $hash;
                $json = file_get_contents($API_PATH);
                $this->data = json_decode($json);
                break;

            case "outcoming_waybill":
                $API_PATH = PUBLIC_API_URL . "waybill.php?security_hash=" . $hash;
                $json = file_get_contents($API_PATH);
                $this->data = json_decode($json);
                break;

                case "incoming_waybill":
                $API_PATH = PUBLIC_API_URL . "incoming_waybill.php?security_hash=" . $hash;
                $json = file_get_contents($API_PATH);
                $this->data = json_decode($json);
                break;

            case "specification":
                $API_PATH = PUBLIC_API_URL . "specification.php?security_hash=" . $hash;
                $json = file_get_contents($API_PATH);
                $this->data = json_decode($json);
                break;

            case "contract":
                $API_PATH = PUBLIC_API_URL . "contract.php?security_hash=" . $hash;
                $json = file_get_contents($API_PATH);
                $this->data = json_decode($json);
                break;

            default:
                $this->data = NULL;
                break;
        }
        return $this->data;
    }
}