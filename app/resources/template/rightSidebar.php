<div class="navbar-right">
    <ul class="navbar-nav">
        <?php
        $obj_user = new Users();
        $user = $obj_user->getByIdObject($_SESSION['uid']);
        if ($user->status == "admin") {
            ?>
            <li><a href="/?page=system_settings" class="js-right-sidebar" title="Налаштування системи"><i
                            class="zmdi zmdi-settings zmdi-hc-spin"></i></a></li>
        <? } ?>
        <li><a href="/?page=logout" class="mega-menu" title="Завершити сеанс"><i class="zmdi zmdi-power"></i></a></li>
    </ul>
</div>
