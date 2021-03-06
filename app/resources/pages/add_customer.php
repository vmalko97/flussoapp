<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Додати клієнта</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="?page=main"><i class="zmdi zmdi-home"></i><?= APP_NAME; ?>
                            </a></li>
                        <li class="breadcrumb-item active">Клієнти</li>
                        <li class="breadcrumb-item active">Додати клієнта</li>
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
                            <h5><strong>Додати</strong> клієнта</h5>
                        </div>
                        <div class="body">
                            <h2 class="card-inside-title">Додати клієнта</h2>
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control"
                                               placeholder="Найменування / ПІБ"/>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="text" name="legal_address" class="form-control"
                                               placeholder="Юридична адреса"/>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="text" name="actual_address" class="form-control"
                                               placeholder="Фактична адреса"/>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="text" name="telephones" class="form-control"
                                               placeholder="Телефони"/>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <input type="text" name="code" class="form-control" placeholder="ЄДРПОУ"/>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <input type="text" name="tax_number" class="form-control"
                                               placeholder="РНОКПП (ІПН)"/>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="text" name="certificate_number" class="form-control"
                                               placeholder="№ свідоцтва"/>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <input type="text" name="director" class="form-control" placeholder="Директор"/>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <input type="text" name="chief_accountant" class="form-control"
                                               placeholder="Головний бухалтер"/>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <input type="text" name="current_account" class="form-control"
                                               placeholder="Поточний рахунок (IBAN)"/>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <input type="text" name="bank_code" class="form-control"
                                               placeholder="МФО Банку"/>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <input type="text" name="bank_name" class="form-control"
                                               placeholder="Найменування банку"/>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <input type="text" name="civil_contract_type" class="form-control"
                                               placeholder="Вид цивільно-правового договору"/>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <input type="text" name="vat" class="form-control" placeholder="ПДВ"/>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <input type="text" name="email" class="form-control" placeholder="E-Mail"/>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <input type="text" name="website" class="form-control" placeholder="Web-сайт"/>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="text" name="additional_field_0" class="form-control"
                                               placeholder="Додаткове поле 1"/>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="text" name="additional_field_1" class="form-control"
                                               placeholder="Додаткове поле 2"/>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="text" name="additional_field_2" class="form-control"
                                               placeholder="Додаткове поле 3"/>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="text" name="additional_field_3" class="form-control"
                                               placeholder="Додаткове поле 4"/>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="text" name="additional_field_4" class="form-control"
                                               placeholder="Додаткове поле 5"/>
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

        let async = "add_customer";
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
                        text: "Не вдалося додати клієнта",
                        icon: "error",
                    });
                } else if (data === "success") {
                    swal({
                        title: "Успіх",
                        text: "Клієнта додано успішно",
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