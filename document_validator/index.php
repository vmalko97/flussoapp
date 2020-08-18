<?php

require_once ("./app/resources/system/init.php");
    RQ_ONCE(WF_ROUTES);
    RQ_ONCE(WF_HEADER);
    RQ_ONCE(WF_RIGHT_SIDEBAR);
    RQ_ONCE(WF_LEFT_SIDEBAR);
    Route::start();
    RQ_ONCE(WF_FOOTER);
