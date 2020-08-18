<?php
if (isset($_POST['temp'])){
    unlink($_SERVER['DOCUMENT_ROOT'].'/temp/'.$_POST['temp']);
}