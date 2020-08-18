<?php

class Secure
{
    private $data;

    public function __construct()
    {

    }
    public function add($security_hash,$file_hash,$document_type,$document_id){
        global $mysqli;
        $this->data = $mysqli->query("INSERT INTO wf_secure (security_hash, file_hash, document_type, document_id) VALUES ('$security_hash', '$file_hash', '$document_type', '$document_id')");
        return $this->data;
    }

}