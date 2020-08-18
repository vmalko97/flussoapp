<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Рахунки-фактури</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/"><i class="zmdi zmdi-home"></i><?= APP_NAME; ?></a></li>
                        <li class="breadcrumb-item active">Рахунки-фактури</li>
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
                                <div class="col-9"><h2><strong>Рахунки-фактури</strong></h2></div>
                                <div class="col-3"><a href="?page=create_invoice" class="btn btn-primary float-right"><i
                                                class="zmdi zmdi-plus-circle-o"></i>&nbsp;Створити</a></div>
                            </div>
                        </div>
                        <div class="body">
                            <h5>Рахунки-фактури</h5>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="table-primary">
                                    <tr class="text-center">
                                        <th nowrap>ID</th>
                                        <th nowrap>Статус</th>
                                        <th nowrap>Рахункок №</th>
                                        <th nowrap>Одержувач</th>
                                        <th nowrap>Дата</th>
                                        <th nowrap>Сума без ПДВ</th>
                                        <th nowrap>Сума з ПДВ</th>
                                        <th nowrap>Дії</th>
                                        <th nowrap>Хеш-суми</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $obj_invoice = new Invoices();
                                    $invoice = $obj_invoice->getComplexAll();
                                    $count = count($invoice);
                                    for ($i = 0; $i < $count; $i++) {
                                        ?>
                                        <tr id="invoice_id_<?php echo $invoice[$i]['id']; ?>" class="text-center">
                                            <td scope="row" nowrap><?php echo $invoice[$i]['id']; ?></td>
                                            <td nowrap><?php
                                                if ($invoice[$i]['finalize'] == 1) {
                                                    echo "<span class='badge badge-success' title='Фіналізований'><i class='zmdi zmdi-shield-check'></i></span>";
                                                } else {
                                                    echo "<span class='badge badge-warning' title='Не фіналізований'><i class='zmdi zmdi-calendar-close'></i></span>
                                                          <br/>
                                                           <a class='badge badge-success text-white' onclick='finalize(" . $invoice[$i]['id'] . ")'>Фіналізувати</a>";
                                                }
                                                ?></td>
                                            <td nowrap><?php echo $invoice[$i]['invoce_number']; ?></td>
                                            <td nowrap><?php echo $invoice[$i]['receiver']; ?></td>
                                            <td nowrap><?php echo $invoice[$i]['date']; ?></td>
                                            <td nowrap><?php echo $invoice[$i]['total_without_vat']; ?></td>
                                            <td nowrap><?php echo $invoice[$i]['total']; ?></td>
                                            <td nowrap>
                                                <div class="btn-group btn-group-justified">
                                                    <?php if ($invoice[$i]['finalize'] == 0) { ?>
                                                        <a href="/?page=edit_invoice&id=<?php echo $invoice[$i]['id']; ?>"
                                                           class="btn btn-primary">Редагувати</a>
                                                        <button class="btn btn-info"
                                                                onclick='download_invoice("<?php echo $invoice[$i]['id']; ?>")'>
                                                            Завантажити
                                                        </button>
                                                    <?php } elseif ($invoice[$i]['finalize'] == 1) { ?>
                                                        <a href=".<?php echo $invoice[$i]['finalized_path']; ?>"
                                                           class="btn btn-info">Завантажити</a>
                                                    <?
                                                    } ?>
                                                    <button class="btn btn-danger"
                                                            onclick='delete_invoice("<?php echo $invoice[$i]['id']; ?>")'>
                                                        Видалити
                                                    </button>
                                                </div>
                                            </td>
                                            <td nowrap>
                                                <?php
                                                echo "<span class='badge badge-default' title='Хеш захисту даних'>SH: " . $invoice[$i]['security_hash'] . "</span><br/>";
                                                echo "<span class='badge badge-primary' title='Хеш захисту файлу'>FH: " . $invoice[$i]['file_hash'] . "</span>";
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
    function download_invoice(id) {
        let async = "download_invoice";
        $.post('/app/resources/services/doc/invoice_generate.php', {
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


    function delete_invoice(id) {
        swal({
            title: "Ви впевнені?",
            text: "Після видалення інформаціїї, її неможливо буде відновити!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {

                    let async = "delete_invoice";
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
                                $("#invoice_id_" + id).hide();
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

                    let async = "finalize_invoice";

                    $.ajax({
                        url: "/app/resources/services/doc/invoice_generate.php",
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