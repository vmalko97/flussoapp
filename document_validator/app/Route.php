<?php

class Route
{
    static function start()
    {
        $page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!empty($page) && file_exists(RESOURCES_URL . '/pages/' . $page . '.php')) {
            require_once RESOURCES_URL . "/pages/" . $page . ".php";
        } elseif (empty($page)) {
            echo "<script type='text/javascript'>location.replace('/document_validator/?page=main')</script>";
        }else{
            require_once RESOURCES_URL . "/pages/404.php";
        }
    }
}