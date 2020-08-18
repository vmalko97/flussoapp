<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Видаткові накладні</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/"><i class="zmdi zmdi-home"></i><?= APP_NAME; ?></a></li>
                        <li class="breadcrumb-item active">Видаткові накладні</li>
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
                                <div class="col-9"><h2><strong>Видаткові накладні</strong></h2></div>
                                <div class="col-3"><a href="?page=create_outcoming_waybill"
                                                      class="btn btn-primary float-right"><i
                                                class="zmdi zmdi-plus-circle-o"></i>&nbsp;Створити</a></div>
                            </div>
                        </div>
                        <div class="body">
                            <h5>Видаткові накладні</h5>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="table-primary">
                                    <tr class="text-center">
                                        <th nowrap>ID</th>
                                        <th nowrap>Статус</th>
                                        <th nowrap>Накладна №</th>
                                        <th nowrap>Одержувач</th>
                                        <th nowrap>Умова продажу</th>
                                        <th nowrap>Дата</th>
                                        <th nowrap>Сума без ПДВ</th>
                                        <th nowrap>Сума з ПДВ</th>
                                        <th nowrap>Дії</th>
                                        <th nowrap>Хеш-суми</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $obj_waybill = new Waybills();
                                    $waybill = $obj_waybill->getComplexAll();
                                    $count = count($waybill);
                                    for ($i = 0; $i < $count; $i++) {
                                        ?>
                                        <tr id="waybill_id_<?php echo $waybill[$i]['id']; ?>" class="text-center">
                                            <td scope="row" nowrap><?php echo $waybill[$i]['id']; ?></td>
                                            <td nowrap><?php
                                                if ($waybill[$i]['finalize'] == 1) {
                                                    echo "<span class='badge badge-success' title='Фіналізована'><i class='zmdi zmdi-shield-check'></i></span>";
                                                } else {
                                                    echo "<span class='badge badge-warning' title='Не фіналізована'><i class='zmdi zmdi-calendar-close'></i></span>
                                                          <br/>
                                                           <a class='badge badge-success text-white' onclick='finalize(" . $waybill[$i]['id'] . ")'>Фіналізувати</a>";
                                                }
                                                ?></td>
                                            <td nowrap><?php echo $waybill[$i]['waybill_number']; ?></td>
                                            <td nowrap><?php echo $waybill[$i]['receiver']; ?></td>
                                            <td nowrap><?php echo $waybill[$i]['condition_of_sale']; ?></td>
                                            <td nowrap><?php echo $waybill[$i]['date']; ?></td>
                                            <td nowrap><?php echo $waybill[$i]['total_without_vat']; ?></td>
                                            <td nowrap><?php echo $waybill[$i]['total']; ?></td>
                                            <td nowrap>
                                                <div class="btn-group btn-group-justified">
                                                    <?php if ($waybill[$i]['finalize'] == 0) { ?>
                                                        <a href="/?page=edit_waybill&id=<?php echo $waybill[$i]['id']; ?>"
                                                           class="btn btn-primary">Редагувати</a>
                                                        <button class="btn btn-info"
                                                                onclick='download_waybill("<?php echo $waybill[$i]['id']; ?>")'>
                                                            Завантажити
                                                        </button>
                                                    <?php } elseif ($waybill[$i]['finalize'] == 1) { ?>
                                                        <a href=".<?php echo $waybill[$i]['finalized_path']; ?>"
                                                           class="btn btn-info">Завантажити</a>
                                                    <?
                                                    } ?>
                                                    <button class="btn btn-danger"
                                                            onclick='delete_waybill("<?php echo $waybill[$i]['id']; ?>")'>
                                                        Видалити
                                                    </button>
                                                </div>
                                            </td>
                                            <td nowrap>
                                                <?php
                                                echo "<span class='badge badge-default' title='Хеш захисту даних'>SH: " . $waybill[$i]['security_hash'] . "</span><br/>";
                                                echo "<span class='badge badge-primary' title='Хеш захисту файлу'>FH: " . $waybill[$i]['file_hash'] . "</span>";
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
    function download_waybill(id) {
        let async = "download_waybill";
        $.post('/app/resources/services/doc/waybill_generate.php', {
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


    function delete_waybill(id) {
        swal({
            title: "Ви впевнені?",
            text: "Після видалення інформаціїї, її неможливо буде відновити!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {

                    let async = "delete_waybill";
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
                                $("#waybill_id_" + id).hide();
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

                    let async = "finalize_waybill";

                    $.ajax({
                        url: "/app/resources/services/doc/waybill_generate.php",
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