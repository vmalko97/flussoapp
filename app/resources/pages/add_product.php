<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Додати товар</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="?page=main"><i class="zmdi zmdi-home"></i><?= APP_NAME; ?>
                            </a></li>
                        <li class="breadcrumb-item active">Склад</li>
                        <li class="breadcrumb-item active">Додати товар</li>
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
                            <h5><strong>Додати</strong> товар</h5>
                        </div>
                        <div class="body">
                            <h2 class="card-inside-title">Додати товар</h2>
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control"
                                               placeholder="Найменування"/>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <select name="unit_id" class="form-control">
                                            <option disabled="disabled" selected>Одиниці виміру</option>
                                            <?php
                                            $obj_unit = new Service();
                                            $unit = $obj_unit->getAllUnits();
                                            $count = count($unit);
                                            for ($i = 0; $i < $count; $i++) {
                                                ?>
                                                <option value="<?php echo $unit[$i]['id'] ?>"><?php echo $unit[$i]['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="number" name="price" class="form-control"
                                               placeholder="Ціна" min="0" step="0.01"/>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="number" name="count" class="form-control"
                                               placeholder="Кількість" step="1"/>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <input type="checkbox" id="infinity1" name="infinity"/>
                                            <label for="infinity1">Без обмеженя по кількості</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <select name="vat_type_id" class="form-control">
                                            <option disabled="disabled" selected>Тип ПДВ</option>
                                            <?php
                                            $obj_vat = new Service();
                                            $vat = $obj_vat->getAllVatTypes();
                                            $count_v = count($vat);
                                            for ($j = 0; $j < $count_v; $j++) {
                                                ?>
                                                <option value="<?php echo $vat[$j]['id'] ?>"><?php echo $vat[$j]['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <select name="category_id" class="form-control">
                                            <option disabled="disabled" selected>Категорія</option>
                                            <?php
                                            $obj_category = new Service();
                                            $category = $obj_category->getAllProductCategories();
                                            $count_c = count($category);
                                            for ($k = 0; $k < $count_c; $k++) {
                                                ?>
                                                <option value="<?php echo $category[$k]['id'] ?>"><?php echo $category[$k]['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <button class="btn btn-block btn-success" id="submit_form">Додати</button>
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
        let name = $("input[name=name]").val();
        let unit_id = $("select[name=unit_id]").val();
        let price = $("input[name=price]").val();
        let count = $("input[name=count]").val();
        let infinity = null;
        if($("input[name=infinity]").is(":checked")){
            infinity = 1;
        }else {
            infinity = 0;
        }
        let vat_type_id = $("select[name=vat_type_id]").val();
        let category_id = $("select[name=category_id]").val();

        let async = "add_product";
        $.ajax({
            url: "/app/resources/system/async.php",
            type: "POST",
            data:
                {
                    async:
                        JSON.stringify({
                            function: async,
                            async_data: {
                                name: name,
                                unit_id: unit_id,
                                price: price,
                                count: count,
                                infinity: infinity,
                                vat_type_id: vat_type_id,
                                category_id: category_id
                            }
                        })
                },
            success: function (data) {
                if (data === "error") {
                    swal({
                        title: "Помилка",
                        text: "Не вдалося додати постачальника",
                        icon: "error",
                    });
                } else if (data === "success") {
                    swal({
                        title: "Успіх",
                        text: "Товар додано успішно",
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
</script>