<?php

require_once ("app/resources/system/init.php");
require_once ("app/resources/classes/Users.php");
if (isset($_SESSION['auth_hash'])) {
    RQ_ONCE(WF_ROUTES);
    RQ_ONCE(WF_HEADER);
    RQ_ONCE(WF_RIGHT_SIDEBAR);
    RQ_ONCE(WF_LEFT_SIDEBAR);
    Route::start();
    RQ_ONCE(WF_FOOTER);
}else{
    if(isset($_POST['username'])) {
        $username = POST_SAFE("username");
        $password = POST_SAFE("password");
        $auth = new Auth($username, $password);
        if($auth->isExist() == 1){
            $auth = new Auth($username, $password);
            $auth->authorize();
            header("Location: /");
            exit;
        }else{
            die("NO");
        }
    }
        RQ_ONCE(WF_AUTH_URL);
}
