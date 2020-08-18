<?php

class Users
{
    private $data;

    function __construct()
    {

    }

    public function getAll()
    {
        global $mysqli;
        $this->data = $mysqli->query("SELECT * FROM wf_users")->fetch_all(MYSQLI_ASSOC);
        return $this->data;
    }

    public function getById($id)
    {
        global $mysqli;
        $this->data = $mysqli->query("SELECT * FROM wf_users WHERE id =".$id)->fetch_all(MYSQLI_ASSOC);
        return $this->data;
    }
    public function getByIdObject($id)
    {
        global $mysqli;
        $this->data = $mysqli->query("SELECT * FROM wf_users WHERE id =".$id)->fetch_object();
        return $this->data;
    }

    public function add($full_name, $username, $password, $status)
    {
        global $mysqli;
        $this->data = $mysqli->query("INSERT INTO wf_users (username, password, full_name, status) VALUES ('$username','$password','$full_name','$status')");
        return $this->data;
    }

    public function update($id, $full_name, $username, $password, $status)
    {
        global $mysqli;
        if ($password != null) {
            $mysqli->query("UPDATE wf_users SET username = '$username', password = '$password', full_name ='$full_name', status = '$status' WHERE id =" . $id);
        }else{
            $mysqli->query("UPDATE wf_users SET username = '$username', full_name ='$full_name', status = '$status' WHERE id =" . $id);

        }
        return $this->data;
    }

    public function delete($id)
    {
        global $mysqli;
        $this->data = $mysqli->query("DELETE FROM wf_users WHERE id =" . $id);
        return $this->data;
    }
    public function checkStatus($id){
        global $mysqli;
        $user = $mysqli->query("SELECT status FROM wf_users WHERE id =".$id)->fetch_object();
        $this->data = $user->status;
        return $this->data;
    }
}