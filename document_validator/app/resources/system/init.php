<?php


define('APP', 'ok'); //DEBUG
define('FRAMEWORK', 'WF_PHP'); //Name of framework
define('WF_VERSION', '1.0 BETA'); // FRAMEWORK VERSION

//INITIALIZE SESSION
session_start();


//CONFIG DB
$db_host = "master"; // master / slave

if($db_host == "master") {
    define('DB_HOST', 'localhost');
}elseif($db_host == "slave"){
    define('DB_HOST', '159.224.65.236');
}
define('DB_USERNAME', 'v55600_flusso');
define('DB_PASSWORD', 'fY4PxPd@bcIn~Kfp');
define('DB_NAME', 'v55600_flusso');

//INITIALIZE Database
$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
$mysqli->query("set names utf8");

//INITIALIZE CLASSES
spl_autoload_register(function ($class_name) {
    include $_SERVER['DOCUMENT_ROOT'].'/app/resources/classes/' . $class_name . '.php';
});

//INITIALIZE FRAMEWORK FUNCTIONS
function RQ_ONCE($require_file)
{
    require_once($require_file);
}

function POST_SAFE($post)
{
    $post_var = filter_input(INPUT_POST,$post);
    return htmlspecialchars($post_var);
}

//INITIALIZE ENGINE DEFAULT VALUES
define('APP_URL', './app');
define('RESOURCES_URL', './app/resources');
define('SYSTEM_URL', './app/resources/system');
define('WF_ROUTES', './app/Route.php');
define('WF_HEADER', './app/resources/template/header.php');
define('WF_FOOTER', './app/resources/template/footer.php');
define('WF_LEFT_SIDEBAR', './app/resources/template/leftSidebar.php');
define('WF_RIGHT_SIDEBAR', './app/resources/template/rightSidebar.php');

//API
define('PUBLIC_API_URL','https://flusso.vladyslav.pro/api/public/');


$obj_config = new Configuration();
$config = $obj_config->getConfig();


//INITIALIZE APP DEFAULT STRINGS

define('APP_NAME', $config->app_name);
define('APP_DESCRIPTION', $config->app_description);
define('APP_VERSION', $config->app_version);
$date_local = date('Y-m-d');
$datetime_local = date('Y-m-d h:i:s');
$timestamp = strtotime($datetime_local) + 20 * 60;
$datetime_expire = date('Y-m-d h:i:s', $timestamp);

//INITIALIZE DEFAULT URL
define("WF_AUTH_URL", './app/auth.php');

