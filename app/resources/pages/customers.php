<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Клієнти</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="?page=main"><i class="zmdi zmdi-home"></i><?= APP_NAME; ?>
                            </a></li>
                        <li class="breadcrumb-item active">Клієнти</li>
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
                                <div class="col-9"><h5><strong>Клієнти</strong></h5></div>
                                <div class="col-3"><a href="?page=add_customer" class="btn btn-primary float-right"><i class="zmdi zmdi-plus-circle-o"></i>&nbsp;Додати</a></div>
                            </div>
                        </div>
                        <div class="body">
                            <h5>Клієнти</h5>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr class="text-center">
                                        <th>ID</th>
                                        <th>Найменування / ПІБ</th>
                                        <th>Юридична адреса</th>
                                        <th>Фактична адреса</th>
                                        <th>Телефони</th>
                                        <th>ЄДРПОУ</th>
                                        <th>РНОКПП (ІПН)</th>
                                        <th>№ Свідоцтва</th>
                                        <th>Директор</th>
                                        <th>Головний бухгалтер</th>
                                        <th>Поточний рахунок</th>
                                        <th>МФО банку</th>
                                        <th>Банк</th>
                                        <th>Вид ЦПД</th>
                                        <th>ПДВ</th>
                                        <th>E-Mail</th>
                                        <th>Web-сайт</th>
                                        <th>Додаткові поля</th>
                                        <th>Дії</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $obj_customer = new Customers();
                                    $customer = $obj_customer->getAll();
                                    $count = count($customer);
                                    for ($i = 0; $i < $count; $i++) {
                                        ?>
                                        <tr id="customer_id_<?php echo $customer[$i]['id']; ?>">
                                            <th scope="row"><?php echo $customer[$i]['id']; ?></th>
                                            <td><?php echo $customer[$i]['name']; ?></td>
                                            <td><?php echo $customer[$i]['legal_address']; ?></td>
                                            <td><?php echo $customer[$i]['actual_address']; ?></td>
                                            <td><?php echo $customer[$i]['telephones']; ?></td>
                                            <td><?php echo $customer[$i]['code']; ?></td>
                                            <td><?php echo $customer[$i]['tax_number']; ?></td>
                                            <td><?php echo $customer[$i]['certificate_number']; ?></td>
                                            <td><?php echo $customer[$i]['director']; ?></td>
                                            <td><?php echo $customer[$i]['chief_accountant']; ?></td>
                                            <td><?php echo $customer[$i]['current_account']; ?></td>
                                            <td><?php echo $customer[$i]['bank_code']; ?></td>
                                            <td><?php echo $customer[$i]['bank_name']; ?></td>
                                            <td><?php echo $customer[$i]['civil_contract_type']; ?></td>
                                            <td><?php echo $customer[$i]['vat']; ?></td>
                                            <td><?php echo $customer[$i]['email']; ?></td>
                                            <td><?php echo $customer[$i]['website']; ?></td>
                                            <td><?php
                                                if (!empty($customer[$i]['additional_field_0'])) {
                                                    echo $customer[$i]['additional_field_0'] . ',';
                                                }
                                                if (!empty($customer[$i]['additional_field_1'])) {
                                                    echo $customer[$i]['additional_field_1'] . ',';
                                                }
                                                if (!empty($customer[$i]['additional_field_2'])) {
                                                    echo $customer[$i]['additional_field_2'] . ',';
                                                }
                                                if (!empty($customer[$i]['additional_field_3'])) {
                                                    echo $customer[$i]['additional_field_3'] . ',';
                                                }
                                                if (!empty($customer[$i]['additional_field_4'])) {
                                                    echo $customer[$i]['additional_field_4'];
                                                }
                                                if (empty($customer[$i]['additional_field_0']) &&
                                                    empty($customer[$i]['additional_field_1']) &&
                                                    empty($customer[$i]['additional_field_2']) &&
                                                    empty($customer[$i]['additional_field_3']) &&
                                                    empty($customer[$i]['additional_field_4'])) {
                                                    echo '-';
                                                }
                                                ?></td>
                                            <td>
                                                <div class="btn-group btn-group-justified">
                                                    <a href="/?page=customer_info&id=<?php echo $customer[$i]['id']; ?>"
                                                       class="btn btn-info">Переглянути</a>
                                                    <a href="/?page=edit_customer&id=<?php echo $customer[$i]['id']; ?>"
                                                       class="btn btn-primary">Редагувати</a>
                                                    <button class="btn btn-danger"
                                                            onclick='delete_customer("<?php echo $customer[$i]['id']; ?>")'>
                                                        Видалити
                                                    </button>
                                                </div>
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
    function delete_customer(id) {
        swal({
            title: "Ви впевнені?",
            text: "Після видалення інформаціїї, її неможливо буде відновити!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {

                    let async = "delete_customer";
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
                                    text: "Не вдалося видалити клієнта",
                                    icon: "error",
                                });
                            } else if (data === "success") {
                                swal({
                                    title: "Успіх",
                                    text: "Клієнта видалено успішно",
                                    icon: "success",
                                });
                                $("#customer_id_"+id).hide();
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