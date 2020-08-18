<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Склад</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/?page=main"><i class="zmdi zmdi-home"></i><?= APP_NAME; ?>
                            </a></li>
                        <li class="breadcrumb-item active">Склад</li>
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
                                <div class="col-9"><h2><strong>Склад</strong></h2></div>
                                <div class="col-3">
                                    <a href="?page=add_product" class="btn btn-primary float-right"><i
                                                class="zmdi zmdi-plus-circle-o"></i>&nbsp;Додати</a>
                                </div>
                            </div>
                        </div>
                        <div class="body">
                            <h5></h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                            <h5>Склад</h5>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Код</th>
                                        <th>Повне найменування товару</th>
                                        <th>Одиниці виміру</th>
                                        <th>Ціна</th>
                                        <th>Залишок</th>
                                        <th>Тип ПДВ</th>
                                        <th>Категорія</th>
                                        <th>Дії</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    $obj_products = new Products();
                                    $product = $obj_products->getAll();
                                    $count = count($product);
                                    for ($i = 0; $i < $count; $i++) {
                                        ?>
                                        <tr id="product_id_<?php echo $product[$i]['id']; ?>">
                                            <td><?php echo $product[$i]["id"] ?></td>
                                            <td><?php echo $product[$i]["name"] ?></td>
                                            <td><?php echo $product[$i]["units"] ?></td>
                                            <td><?php echo $product[$i]["price"] ?></td>
                                            <td><?php
                                                if ($product[$i]["infinity"] == 1) {
                                                    echo "<i class='ti ti-infinite'></i>";
                                                } else {
                                                    echo $product[$i]["count"];
                                                }
                                                ?></td>
                                            <td><?php echo $product[$i]["vat"] ?></td>
                                            <td><?php echo $product[$i]["category"] ?></td>
                                            <td>
                                                <div class="btn-group btn-group-justified">
                                                    <a href="/?page=edit_product&id=<?php echo $product[$i]["id"] ?>"
                                                       class="btn btn-primary">Редагувати</a>
                                                    <button class="btn btn-danger"
                                                            onclick='delete_product(<?php echo $product[$i]["id"] ?>)'>
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
    function delete_product(id) {
        swal({
            title: "Ви впевнені?",
            text: "Після видалення інформаціїї, її неможливо буде відновити!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {

                    let async = "delete_product";
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
                                    text: "Не вдалося видалити товар",
                                    icon: "error",
                                });
                            } else if (data === "success") {
                                swal({
                                    title: "Успіх",
                                    text: "Товар видалено успішно",
                                    icon: "success",
                                });
                                $("#product_id_" + id).hide();
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