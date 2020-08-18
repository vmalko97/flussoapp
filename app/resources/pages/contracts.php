<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Договори</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/"><i class="zmdi zmdi-home"></i><?= APP_NAME; ?></a></li>
                        <li class="breadcrumb-item active">Договори</li>
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
                                <div class="col-9"><h2><strong>Договори</strong></h2></div>
                                <div class="col-3"><a href="?page=create_contract"
                                                      class="btn btn-primary float-right"><i
                                                class="zmdi zmdi-plus-circle-o"></i>&nbsp;Створити</a></div>
                            </div>
                        </div>
                        <div class="body">
                            <h5>Договори</h5>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="table-primary">
                                    <tr class="text-center">
                                        <th nowrap>ID</th>
                                        <th nowrap>Статус</th>
                                        <th nowrap>Договір №</th>
                                        <th nowrap>Клієнт</th>
                                        <th nowrap>Дата</th>
                                        <th nowrap>Сума</th>
                                        <th nowrap>Дії</th>
                                        <th nowrap>Хеш-суми</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $obj_contract = new Contracts();
                                    $obj_customer = new Customers();
                                    $contract = $obj_contract->getAll();
                                    $count = count($contract);
                                    for ($i = 0; $i < $count; $i++) {
                                        ?>
                                        <tr id="contract_id_<?php echo $contract[$i]['id']; ?>" class="text-center">
                                            <td scope="row" nowrap><?php echo $contract[$i]['id']; ?></td>
                                            <td nowrap><?php
                                                if ($contract[$i]['finalize'] == 1) {
                                                    echo "<span class='badge badge-success' title='Фіналізований'><i class='zmdi zmdi-shield-check'></i></span>";
                                                } else {
                                                    echo "<span class='badge badge-warning' title='Не фіналізований'><i class='zmdi zmdi-calendar-close'></i></span>
                                                          <br/>
                                                           <a class='badge badge-success text-white' onclick='finalize(" . $contract[$i]['id'] . ")'>Фіналізувати</a>";
                                                }
                                                ?></td>
                                            <td nowrap><?php echo $contract[$i]['contract_number']; ?></td>
                                            <td nowrap><?php
                                                $customer = $obj_customer->getById($contract[$i]['customer_id']);
                                                echo $customer[0]['name'];
                                                ?></td>
                                            <td nowrap><?php echo $contract[$i]['date']; ?></td>
                                            <td nowrap><?php echo $contract[$i]['contract_sum']; ?></td>
                                            <td nowrap>
                                                <div class="btn-group btn-group-justified">
                                                    <?php if ($contract[$i]['finalize'] == 0) { ?>
                                                        <a href="/?page=edit_contract&id=<?php echo $contract[$i]['id']; ?>"
                                                           class="btn btn-primary">Редагувати</a>
                                                        <button class="btn btn-info"
                                                                onclick='download_contract("<?php echo $contract[$i]['id']; ?>")'>
                                                            Завантажити
                                                        </button>
                                                    <?php } elseif ($contract[$i]['finalize'] == 1) { ?>
                                                        <a href=".<?php echo $contract[$i]['finalized_path']; ?>"
                                                           class="btn btn-info">Завантажити</a>
                                                    <?
                                                    } ?>
                                                    <button class="btn btn-danger"
                                                            onclick='delete_contract("<?php echo $contract[$i]['id']; ?>")'>
                                                        Видалити
                                                    </button>
                                                </div>
                                            </td>
                                            <td nowrap>
                                                <?php
                                                echo "<span class='badge badge-default' title='Хеш захисту даних'>SH: " . $contract[$i]['security_hash'] . "</span><br/>";
                                                echo "<span class='badge badge-primary' title='Хеш захисту файлу'>FH: " . $contract[$i]['file_hash'] . "</span>";
                                                ?>
                                            </td>
                                        </tr>
                                    <?php }
                                    ?>
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
    function download_contract(id) {
        let async = "download_contract";
        $.post('/app/resources/services/doc/contract_generate_tpl.php', {
            async: JSON.stringify({
                function: async,
                async_request: {id: id}
            })
        }, function (data) {
            let dataObj = JSON.parse(data);
            //console.log(data);
            location.assign(dataObj.download);
        });
    }


    function delete_contract(id) {
        swal({
            title: "Ви впевнені?",
            text: "Після видалення інформаціїї, її неможливо буде відновити!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {

                    let async = "delete_contract";
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
                                    text: "Не вдалося видалити рахунок",
                                    icon: "error",
                                });
                            } else if (data === "success") {
                                swal({
                                    title: "Успіх",
                                    text: "Рахунок видалено успішно",
                                    icon: "success",
                                });
                                $("#contract_id_" + id).hide();
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

    function finalize(id) {
        swal({
            title: "Ви впевнені?",
            text: "Після фіналізації документу його редагування буде неможливим!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willFinal) => {
                if (willFinal) {

                    let async = "finalize_contract";

                    $.ajax({
                        url: "/app/resources/services/doc/contract_generate_tpl.php",
                        type: "POST",
                        data:
                            {
                                async: JSON.stringify({
                                    function: async,
                                    async_request: {id: id}
                                })
                            },
                        success: function (data) {
                            if (data === "error") {
                                swal({
                                    title: "Помилка",
                                    text: "Не вдалося фіналізувати документ",
                                    icon: "error",
                                });
                            } else if (data === "success") {
                                swal({
                                    title: "Успіх",
                                    text: "Документ фіналізовано успішно",
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

                } else {
                    swal("Операцію відмінено!");
                }
            });
    }
</script>