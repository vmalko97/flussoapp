<?php
$obj_user = new Users();
$user = $obj_user->getByIdObject($_SESSION['uid']);
if ($user->status == "admin") {
    ?>
<section class="content" xmlns="http://www.w3.org/1999/html">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Налаштування системи</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i><?= APP_NAME; ?>
                            </a></li>
                        <li class="breadcrumb-item active">Налаштування</li>
                        <li class="breadcrumb-item active">Налаштування системи</li>
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
                            <h2><strong>Налаштування</strong> системи</h2>
                        </div>
                        <div class="body">
                            <h5>Налаштування системи</h5>

                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <label>Назва застосунку</label>
                                    <div class="form-group">
                                        <input type="text" name="app_name" class="form-control" placeholder="Назва застосунку"
                                               value="<?= APP_NAME; ?>">
                                    </div>
                                    <label>Опис застосунку</label>
                                    <div class="form-group">
                                        <textarea name="app_description" class="form-control" placeholder="Опис застосунку"><?= APP_DESCRIPTION; ?></textarea>
                                    </div>
                                    <label>URL верифікатора документів</label>
                                    <div class="form-group">
                                        <input type="text" name="verifier_url" class="form-control" placeholder="URL верифікатора документів (https://flusso.app/)"
                                               value="<?= VERIFIER_URL; ?>">
                                    </div>
                                    <label>Компанія за замовчуванням</label>
                                    <div class="form-group">
                                        <select class="form-control show-tick ms select2" name="company_id"
                                                data-placeholder="Виберіть">
                                            <?php
                                            $obj_company = new Companies();
                                            $company = $obj_company->getAll();
                                            $count = count($company);
                                            for ($i = 0; $i < $count; $i++) {
                                                ?>
                                                <option value="<?php echo $company[$i]['id']; ?>" <? if(DEFAULT_COMPANY == $company[$i]['id']) { echo "selected"; } ?>><?php echo $company[$i]['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <label>Ліцензійний ключ</label>
                                    <div class="input-group masked-input mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="zmdi zmdi-key"></i></span>
                                        </div>
                                        <?php $obj_config = new Service();
                                        $config = $obj_config->getConfig();
                                        ?>
                                        <input type="text" class="form-control key"
                                               placeholder="XXXXX-XXXXX-XXXXX-XXXXX" name="license_key" id="key" value="<?=$config->license_key;?>">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><button class="btn btn-primary" type="button"
                                                                                   id="activate">Активувати</button></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-block btn-primary" id="submit_form">
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
<script>
    $("#submit_form").click(function () {
        let app_name = $("input[name=app_name]").val();
        let app_description = $("textarea[name=app_description]").val();
        let verifier_url = $("input[name=verifier_url]").val();
        let license_key = $("input[name=license_key]").val();
        let company_id = $("select[name=company_id]").val();
        let async = "update_configuration";
        $.ajax({
            url: "/app/resources/system/async.php",
            type: "POST",
            data:
                {
                    async:
                        JSON.stringify({
                            function: async,
                            async_data: {
                                app_name:app_name,
                                app_description:app_description,
                                verifier_url:verifier_url,
                                license_key:license_key,
                                company_id:company_id
                            }
                        })
                },
            success: function (data) {
                if (data === "error") {
                    swal({
                        title: "Помилка",
                        text: "Не вдалося зберегти інформацію",
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
    $("#activate").click(function () {
        var async = "activate_license";
        var key = $("input[name=license_key]").val();
        $.ajax({
            url: "/app/resources/system/async.php",
            type: "POST",
            data: {
                async: async,
                key: key
            },
            success: function (data) {
                if (data == "unactivated") {
                    swal({
                        title: "Помилка",
                        text: "Ліцензійний ключ не знайдено",
                        icon: "error",
                    });
                } else if (data == "activated") {
                    swal({
                        title: "Успіх",
                        text: "Систему активовано успішно",
                        icon: "success",
                    });
                    $("input[id=key]").attr("disabled","disabled");
                } else {
                    swal({
                        title: "Помилка",
                        text: "Спроба взлому",
                        icon: "warning",
                    });
                    console.log(data);
                }
            }
        });
    });

    $(document).ready(function () {
        $('.ms').select2();
    });

</script>
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
