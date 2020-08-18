<!-- Left Sidebar -->
<aside id="leftsidebar" class="sidebar">
    <div class="navbar-brand">
        <button class="btn-menu ls-toggle-btn" type="button"><i class="zmdi zmdi-menu"></i></button>
        <a href="/"><img src="<?= RESOURCES_URL . "/assets/images/logo.svg"; ?>" width="25" alt=""><span
                    class="m-l-10"><?= APP_NAME ?></span></a>
    </div>
    <div class="menu">
        <ul class="list">
            <li>
                <div class="user-info">
                    <a class="image" href="/"><img
                                src="<?= RESOURCES_URL . "/assets/images/profile_av.jpg"; ?>" alt="User"></a>
                    <div class="detail">
                        <h4><?php $obj_user = new Users();
                            $user = $obj_user->getByIdObject($_SESSION['uid']);
                            echo $user->full_name;
                            ?></h4>
                        <small><?php
                            switch ($user->status) {
                                case "admin":
                                    echo "Адміністратор";
                                    break;
                                case "user":
                                    echo "Користувач";
                                    break;
                                default:
                                    echo "Невизначений";
                                    break;
                            }
                            ?></small>
                    </div>
                </div>
            </li>
            <li><a href="/"><i class="zmdi zmdi-home"></i><span>Головна</span></a></li>
            <li><a href="/?page=customers"><i class="zmdi zmdi-account-circle"></i><span>Клієнти</span></a></li>
            <li><a href="/?page=providers"><i class="zmdi zmdi-case"></i><span>Постачальники</span></a></li>
            <li><a href="/?page=products"><i class="zmdi zmdi-storage"></i><span>Склад</span></a></li>
            <li><a href="/?page=contracts"><i class="zmdi zmdi-file"></i><span>Договори</span></a></li>
            <li><a href="/?page=specifications"><i class="zmdi zmdi-attachment-alt"></i><span>Специфікації</span></a>
            </li>
            <li><a href="/?page=invoices"><i class="zmdi zmdi-file-text"></i><span>Рахунки</span></a></li>

            <li class="open_top"><a href="javascript:void(0);" class="menu-toggle"><i
                            class="zmdi zmdi-assignment-o"></i><span>Накладні</span></a>
                <ul class="ml-menu">
                    <li><a href="/?page=outcoming_waybills">Видаткові накладні</a></li>
                    <li><a href="/?page=incoming_waybills">Прибуткові накладні</a></li>
                </ul>
            </li>
            <!--            <li class="open_top"><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-balance"></i><span>Банк</span></a>-->
            <!--                <ul class="ml-menu">-->
            <!--                    <li><a href="/?page=bank_statements">Виписка</a></li>-->
            <!--                </ul>-->
            <!--            </li>-->
            <?php
            if ($user->status == "admin") {
                ?>
                <li class="open_top"><a href="javascript:void(0);" class="menu-toggle"><i
                                class="zmdi zmdi-wrench"></i><span>Налаштування</span></a>
                    <ul class="ml-menu">
                        <li><a href="/?page=companies">Управління підприємствами</a></li>
                        <li><a href="/?page=categories">Управління категоріями товарів</a></li>
                        <li><a href="/?page=vat_types">Управління видами ПДВ</a></li>
                        <li><a href="/?page=units">Управління одиницями виміру</a></li>
                        <li><a href="/?page=users">Користувачі</a></li>
                        <li><a href="/?page=private_api_keys">Ключі приватного API</a></li>
                        <li><a href="/?page=system_settings">Налаштування системи</a></li>
                    </ul>
                </li>
            <?php } ?>
        </ul>
    </div>
</aside>