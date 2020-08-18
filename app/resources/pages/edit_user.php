<?php
$obj_user = new Users();
$user = $obj_user->getByIdObject($_SESSION['uid']);
if ($user->status == "admin") {
    ?>
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Редагувати користувача</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="?page=main"><i class="zmdi zmdi-home"></i><?= APP_NAME; ?>
                            </a></li>
                        <li class="breadcrumb-item active">Налаштування</li>
                        <li class="breadcrumb-item active">Управління користувачами</li>
                        <li class="breadcrumb-item active">Редагувати користувача</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i
                                class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i
                                class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h5><strong>Редагувати</strong> користувача</h5>
                        </div>
                        <?php
                        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                        if (empty($id) || !isset($id)) {
                            echo "<div class='body'>
                                <h2 class='card-inside-title'>Редагувати користувача</h2>
                                <div class='alert alert-danger'>Помилка! Не обрано користувача для редагування.</div>
                            </div>
                            </div></div></div></div></div></section>";
                        }else{
                        $obj_user = new Users();
                        $user = $obj_user->getById($id);
                        $count = count($user);
                        for ($i = 0;
                        $i < $count;
                        $i++) {
                        ?>
                        <div class="container-fluid">
                            <div class="row clearfix">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="header">
                                            <h5><strong>Редагувати</strong> користувача</h5>
                                        </div>
                                        <div class="body">
                                            <h2 class="card-inside-title">Редагувати користувача</h2>
                                            <div class="row clearfix">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <input type="text" name="full_name" class="form-control"
                                                               placeholder="Ім'я користувача"
                                                               value="<?= $user[$i]['full_name'] ?>"/>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <input type="text" name="username" class="form-control"
                                                               placeholder="Логін"
                                                               value="<?= $user[$i]['username'] ?>"/>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <input type="password" name="password" class="form-control"
                                                               placeholder="Пароль" autocomplete="off"/>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <select class="form-control show-tick ms select2" name="status"
                                                            data-placeholder="Виберіть">
                                                        <option value="user" <?php if ($user[$i]['status'] == "user") {
                                                            echo 'selected="selected"';
                                                        } ?>>Користувач
                                                        </option>
                                                        <option value="admin" <?php if ($user[$i]['status'] == "admin") {
                                                            echo 'selected="selected"';
                                                        } ?>>Адміністратор
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <button class="btn btn-block btn-success" id="submit_form">
                                                            Зберегти
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
</section>
<script type="text/javascript">
    $("#submit_form").click(function () {
        let id = <?=$id?>;
        let full_name = $("input[name=full_name]").val();
        let username = $("input[name=username]").val();
        let password = $("input[name=password]").val();
        let status = $('select[name=status]').val();

        let async = "edit_user";
        $.ajax({
            url: "/app/resources/system/async.php",
            type: "POST",
            data:
                {
                    async:
                        JSON.stringify({
                            function: async,
                            async_data: {
                                id: id,
                                full_name: full_name,
                                username: username,
                                password: password,
                                status: status
                            }
                        })
                },
            success: function (data) {
                if (data === "error") {
                    swal({
                        title: "Помилка",
                        text: "Не вдалося оновити інформацію",
                        icon: "error",
                    });
                } else if (data === "success") {
                    swal({
                        title: "Успіх",
                        text: "Інформацію оновлено успішно",
                        icon: "success",
                    });
                } else {
                    swal({
                        title: "Помилка",
                        text: "Спроба взлому",
                        icon: "warning",
                    });
                }
            }
        });
    });

    $(document).ready(function () {
        $('.ms').select2();
    });
</script>
<?php }
} ?>
<?php } else { ?>
    <section class="content">
        <div class="body_scroll">
            <div class="container-fluid">
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card">

                            <div class="body">
                                <div class="alert alert-danger">
                                    У вас немає доступу до цього розділу, якщо вам потрібен доступ зверніться до адмніністратора!
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>