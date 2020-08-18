<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Редагувати клієнта</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="?page=main"><i class="zmdi zmdi-home"></i><?= APP_NAME; ?>
                            </a></li>
                        <li class="breadcrumb-item active">Клієнти</li>
                        <li class="breadcrumb-item active">Редагувати клієнта</li>
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
                            <h5><strong>Редагувати</strong> клієнта</h5>
                        </div>
                        <?php
                        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                        if (empty($id) || !isset($id)) {
                            echo "<div class='body'>
                                <h2 class='card-inside-title'>Редагувати клієнта</h2>
                                <div class='alert alert-danger'>Помилка! Не обрано клієнта для редагування.</div>
                            </div>
                            </div></div></div></div></div></section>";
                        }else{
                        $obj_customer = new Customers();
                        $customer = $obj_customer->getById($id);
                        $count = count($customer);
                        for ($i = 0;
                        $i < $count;
                        $i++) {
                        ?>
                        <div class="body">
                            <h2 class="card-inside-title">Редагувати клієнта</h2>
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control"
                                               placeholder="Найменування / ПІБ" value="<?php echo htmlspecialchars($customer[$i]['name']); ?>"/>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="text" name="legal_address" class="form-control"
                                               placeholder="Юридична адреса" value="<?php echo htmlspecialchars($customer[$i]['legal_address']); ?>"/>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="text" name="actual_address" class="form-control"
                                               placeholder="Фактична адреса" value="<?php echo htmlspecialchars($customer[$i]['actual_address']); ?>"/>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="text" name="telephones" class="form-control"
                                               placeholder="Телефони" value="<?php echo htmlspecialchars($customer[$i]['telephones']); ?>"/>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <input type="text" name="code" class="form-control" placeholder="ЄДРПОУ" value="<?php echo htmlspecialchars($customer[$i]['code']); ?>"/>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <input type="text" name="tax_number" class="form-control"
                                               placeholder="РНОКПП (ІПН)" value="<?php echo htmlspecialchars($customer[$i]['tax_number']); ?>"/>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="text" name="certificate_number" class="form-control"
                                               placeholder="№ свідоцтва" value="<?php echo htmlspecialchars($customer[$i]['certificate_number']); ?>"/>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <input type="text" name="director" class="form-control" placeholder="Директор" value="<?php echo htmlspecialchars($customer[$i]['director']); ?>"/>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <input type="text" name="chief_accountant" class="form-control"
                                               placeholder="Головний бухалтер" value="<?php echo htmlspecialchars($customer[$i]['chief_accountant']); ?>"/>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <input type="text" name="current_account" class="form-control"
                                               placeholder="Поточний рахунок (IBAN)" value="<?php echo htmlspecialchars($customer[$i]['current_account']); ?>"/>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <input type="text" name="bank_code" class="form-control"
                                               placeholder="МФО Банку" value="<?php echo htmlspecialchars($customer[$i]['bank_code']); ?>"/>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <input type="text" name="bank_name" class="form-control"
                                               placeholder="Найменування банку" value="<?php echo htmlspecialchars($customer[$i]['bank_name']); ?>"/>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <input type="text" name="civil_contract_type" class="form-control"
                                               placeholder="Вид цивільно-правового договору" value="<?php echo htmlspecialchars($customer[$i]['civil_contract_type']); ?>"/>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <input type="text" name="vat" class="form-control" placeholder="ПДВ" value="<?php echo htmlspecialchars($customer[$i]['vat']); ?>"/>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <input type="text" name="email" class="form-control" placeholder="E-Mail" value="<?php echo htmlspecialchars($customer[$i]['email']); ?>"/>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <input type="text" name="website" class="form-control" placeholder="Web-сайт" value="<?php echo htmlspecialchars($customer[$i]['website']); ?>"/>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="text" name="additional_field_0" class="form-control"
                                               placeholder="Додаткове поле 1" value="<?php echo htmlspecialchars($customer[$i]['additional_field_0']); ?>"/>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="text" name="additional_field_1" class="form-control"
                                               placeholder="Додаткове поле 2" value="<?php echo htmlspecialchars($customer[$i]['additional_field_1']); ?>"/>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="text" name="additional_field_2" class="form-control"
                                               placeholder="Додаткове поле 3" value="<?php echo htmlspecialchars($customer[$i]['additional_field_2']); ?>"/>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="text" name="additional_field_3" class="form-control"
                                               placeholder="Додаткове поле 4" value="<?php echo htmlspecialchars($customer[$i]['additional_field_3']); ?>"/>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="text" name="additional_field_4" class="form-control"
                                               placeholder="Додаткове поле 5" value="<?php echo htmlspecialchars($customer[$i]['additional_field_4']); ?>"/>
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
        let legal_address = $("input[name=legal_address]").val();
        let actual_address = $("input[name=actual_address]").val(); //can be null
        let telephones = $("input[name=telephones]").val();//can be null
        let code = $("input[name=code]").val();//can be null
        let tax_number = $("input[name=tax_number]").val();//can be null
        let certificate_number = $("input[name=certificate_number]").val();//can be null
        let director = $("input[name=director]").val();//can be null
        let chief_accountant = $("input[name=chief_accountant]").val();//can be null
        let current_account = $("input[name=current_account]").val();//can be null
        let bank_code = $("input[name=bank_code]").val();//can be null
        let bank_name = $("input[name=bank_name]").val();//can be null
        let civil_contract_type = $("input[name=civil_contract_type]").val();//can be null
        let vat = $("input[name=vat]").val();
        let email = $("input[name=email]").val();//can be null
        let website = $("input[name=website]").val();//can be null
        let additional_field_0 = $("input[name=additional_field_0]").val();//can be null
        let additional_field_1 = $("input[name=additional_field_1]").val();//can be null
        let additional_field_2 = $("input[name=additional_field_2]").val();//can be null
        let additional_field_3 = $("input[name=additional_field_3]").val();//can be null
        let additional_field_4 = $("input[name=additional_field_4]").val();//can be null

        let async = "update_customer";
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
                                legal_address: legal_address,
                                actual_address: actual_address,
                                telephones: telephones,
                                code: code,
                                tax_number: tax_number,
                                certificate_number: certificate_number,
                                director: director,
                                chief_accountant: chief_accountant,
                                current_account: current_account,
                                bank_code: bank_code,
                                bank_name: bank_name,
                                civil_contract_type: civil_contract_type,
                                vat: vat,
                                email: email,
                                website: website,
                                additional_field_0: additional_field_0,
                                additional_field_1: additional_field_1,
                                additional_field_2: additional_field_2,
                                additional_field_3: additional_field_3,
                                additional_field_4: additional_field_4
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