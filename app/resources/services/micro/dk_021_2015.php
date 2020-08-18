<?php

function getObjDK_021_2015(){
    $result = null;
    global $mysqli;
    $result = $mysqli->query("SELECT * FROM wf_dk_021_2015 ORDER BY id ASC")->fetch_all(MYSQLI_ASSOC);
    return $result;
}

function getObjDK_021_2015ValueUA($id){
    $result = null;
    global $mysqli;
    $obj = $mysqli->query("SELECT * FROM wf_dk_021_2015 WHERE id =".$id)->fetch_object();
    $result = $obj->cpv." ". "\"".$obj->description."\"";
    return $result;
}
function getObjDK_021_2015ValueEN($id){
    $result = null;
    global $mysqli;
    $obj = $mysqli->query("SELECT * FROM wf_dk_021_2015 WHERE id =".$id)->fetch_object();
    $result = $obj->cpv." ". "\"".$obj->description_en."\"";
    return $result;
}