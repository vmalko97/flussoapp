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
                        <li class="breadcrumb-item active">Редагувати товар</li>
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
                            <h5><strong>Редагувати</strong> товар</h5>
                        </div>
                        <?php
                        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                        if (empty($id) || !isset($id)) {
                            echo "<div class='body'>
                                <h2 class='card-inside-title'>Редагувати Постачальника</h2>
                                <div class='alert alert-danger'>Помилка! Не обрано постачальника для редагування.</div>
                            </div>
                            </div></div></div></div></div></section>";
                        }else{
                        $obj_product = new Products();
                        $product = $obj_product->getById($id);
                        $count_p = count($product);
                        for ($p = 0;
                        $p < $count_p;
                        $p++) {
                        ?>
                        <div class="body">
                            <h2 class="card-inside-title">Редагувати товар</h2>
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($product[$p]['name']); ?>"
                                               placeholder="Найменування"/>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <select name="unit_id" class="form-control">
                                            <option disabled="disabled">Одиниці виміру</option>
                                            <?php
                                            $obj_unit = new Service();
                                            $unit = $obj_unit->getAllUnits();
                                            $count = count($unit);
                                            for ($i = 0; $i < $count; $i++) {
                                                ?>
                                                <option value="<?php echo $unit[$i]['id'] ?>" <?php if($unit[$i]['id'] == $product[$p]['unit_id']){ echo "selected"; } ?>><?php echo $unit[$i]['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="number" name="price" class="form-control"
                                               placeholder="Ціна" min="0" step="0.01" value="<?php echo htmlspecialchars($product[$p]['price']); ?>"/>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="number" name="count" class="form-control"
                                               placeholder="Кількість" step="1" value="<?php echo htmlspecialchars($product[$p]['count']); ?>"/>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <input type="checkbox" id="infinity1" name="infinity" <?php if($product[$p]['infinity'] == 1 ){ echo "checked"; } ?>/>
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
                                                <option value="<?php echo $vat[$j]['id'] ?>" <?php if($vat[$j]['id'] == $product[$p]['vat_type_id']){ echo "selected"; } ?>><?php echo $vat[$j]['name'] ?></option>
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
                                                <option value="<?php echo $category[$k]['id'] ?>" <?php if($category[$k]['id'] == $product[$p]['category_id']){ echo "selected"; } ?>><?php echo $category[$k]['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <button class="btn btn-block btn-success" id="submit_form">Зберегти</button>
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
        let id = "<?php echo $id;?>";
        let name = $("input[name=name]").val();
        let unit_id = $("select[name=unit_id]").val();
        let price = $("input[name=price]").val();
        let count = $("input[name=count]").val();
        let infinity = null;
        if ($("input[name=infinity]").is(":checked")) {
            infinity = 1;
        } else {
            infinity = 0;
        }
        let vat_type_id = $("select[name=vat_type_id]").val();
        let category_id = $("select[name=category_id]").val();

        let async = "update_product";
        $.ajax({
            url: "/app/resources/system/async.php",
            type: "POST",
            data:
                {
                    async:
                        JSON.stringify({
                            function: async,
                            async_data: {
                                id:id,
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
</script>
<?php }
} ?>