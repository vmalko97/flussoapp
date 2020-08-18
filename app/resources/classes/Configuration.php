<?php

class Configuration
{

    private $data;

    public function __construct()
    {
    }

    public function getConfig()
    {
        global $mysqli;
        $this->data = $mysqli->query('SELECT * FROM wf_configuration WHERE id = 1')->fetch_object();
        return $this->data;
    }

}
