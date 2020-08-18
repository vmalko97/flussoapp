<?php

if (isset($_GET['private_key'])) {
    $obj_locker = new Service();
    $locker = $obj_locker->IsActiveAPIKey($_GET['private_key']);
    if ($locker == 0) {
        die("<img src=\"../assets/images/logo.png\" width=\"200px\"/>
<br/>
<h2>Flusso API</h2>
<h3>У вас не має доступу до Приватного API!</h3>");
    }
} else {
    die("<img src=\"../assets/images/logo.png\" width=\"200px\"/>
<br/>
<h2>Flusso API</h2>
<h3>У вас не має доступу до Приватного API!</h3>");
}