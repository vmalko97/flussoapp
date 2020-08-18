<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Управління ключами приватного API</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/?page=main"><i class="zmdi zmdi-home"></i><?= APP_NAME; ?>
                            </a></li>
                        <li class="breadcrumb-item active">Управління ключами приватного API</li>
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
                            <div class="row">
                                <div class="col-9"><h2><strong>Управління ключами приватного API</strong></h2></div>
                                <div class="col-3">
                                    <button onclick="generate()" class="btn btn-primary float-right"><i
                                                class="zmdi zmdi-plus-circle-o"></i>&nbsp;Додати новий
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                            <h5>Управління ключами приватного API</h5>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Ключ</th>
                                        <th>Статус</th>
                                        <th>Дії</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $obj_api = new Service();
                                    $api = $obj_api->getAPIKeys();
                                    $count = count($api);
                                    for ($api_counter = 0; $api_counter < $count; $api_counter++) {
                                        ?>
                                        <tr id="key_id_<?php echo $api[$api_counter]['id']; ?>">
                                            <td><?php echo $api[$api_counter]["id"] ?></td>
                                            <td><?php echo $api[$api_counter]["api_key"] ?></td>
                                            <td><?php if ($api[$api_counter]["active"] == 1) {
                                                    echo "<span class='badge badge-success'>Активний</i></span>";
                                                } else {
                                                    echo "<span class='badge badge-danger'>Неактивний</i></span>";
                                                } ?></td>
                                            <td>
                                                <div class="btn-group btn-group-justified">
                                                    <?php if ($api[$api_counter]["active"] == 0) { ?>
                                                        <button onclick='activate(<?php echo $api[$api_counter]["id"] ?>)'
                                                                class="btn btn-primary">Активувати
                                                        </button>
                                                    <? } else { ?>
                                                        <button onclick='deactivate(<?php echo $api[$api_counter]["id"] ?>)'
                                                                class="btn btn-warning">Деактивувати
                                                        </button>
                                                    <? } ?>
                                                    <button class="btn btn-danger"
                                                            onclick='delete_key(<?php echo $api[$api_counter]["id"] ?>)'>
                                                        Видалити
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    function reload() {
        location.reload()
    }

    function generate() {
        let async = "generate_key";
        $.ajax({
            url: "/app/resources/system/async.php",
            type: "POST",
            data:
                {
                    async:
                        JSON.stringify({
                            function: async
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
                setTimeout(reload, 2000);
            }
        });
    }

    function activate(id) {
        let async = "activate_key";
        $.ajax({
            url: "/app/resources/system/async.php",
            type: "POST",
            data:
                {
                    async:
                        JSON.stringify({
                            function: async,
                            async_data: {
                                id: id
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
                setTimeout(reload, 2000);
            }
        });
    }

    function deactivate(id) {
        let async = "deactivate_key";
        $.ajax({
            url: "/app/resources/system/async.php",
            type: "POST",
            data:
                {
                    async:
                        JSON.stringify({
                            function: async,
                            async_data: {
                                id: id
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
                setTimeout(reload, 2000);
            }
        });
    }

    function delete_key(id) {
        swal({
            title: "Ви впевнені?",
            text: "Після видалення інформаціїї, її неможливо буде відновити!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {

                    let async = "delete_key";
                    $.ajax({
                        url: "/app/resources/system/async.php",
                        type: "POST",
                        data:
                            {
                                async:
                                    JSON.stringify({
                                        function: async,
                                        async_data: {
                                            id: id
                                        }
                                    })
                            },
                        success: function (data) {
                            if (data === "error") {
                                swal({
                                    title: "Помилка",
                                    text: "Не вдалося видалити ключ",
                                    icon: "error",
                                });
                            } else if (data === "success") {
                                swal({
                                    title: "Успіх",
                                    text: "Ключ видалено успішно",
                                    icon: "success",
                                });
                                $("#key_id_" + id).hide();
                            } else {
                                swal({
                                    title: "Помилка",
                                    text: "Спроба взлому",
                                    icon: "warning",
                                });
                            }
                        }
                    });

                } else {
                    swal("Операцію відмінено!");
                }
            });
    }
</script>