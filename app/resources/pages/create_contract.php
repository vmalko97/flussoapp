<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/app/resources/services/micro/dk_021_2015.php");
?>
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Створити договір</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="?page=main"><i class="zmdi zmdi-home"></i><?= APP_NAME; ?>
                            </a></li>
                        <li class="breadcrumb-item active">Договори</li>
                        <li class="breadcrumb-item active">Створити договір</li>
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
                            <h5><strong>Створити</strong> договір</h5>
                        </div>
                        <div class="body">
                            <h2 class="card-inside-title">Створити договір</h2>
                            <div class="row clearfix">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">№ договору</span>
                                            </div>
                                            <input type="text" class="form-control" name="contract_number"
                                                   placeholder="Наприклад: 123">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Місце складання</span>
                                            </div>
                                            <input type="text" class="form-control" name="city"
                                                   placeholder="Наприклад: м.Харків">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Дата</span>
                                            </div>
                                            <input type="date" name="date" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <hr/>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Постачальник</span>
                                            </div>
                                            <select class="form-control show-tick ms select2" name="provider">
                                                <?php
                                                $obj_provider = new Companies();
                                                $provider = $obj_provider->getAll();
                                                $count = count($provider);
                                                for ($i = 0; $i < $count; $i++) {
                                                    ?>
                                                    <option value="<?php echo $provider[$i]['id']; ?>"><?php echo $provider[$i]['name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">в особі</span>
                                            </div>
                                            <input type="text" name="provider_position" class="form-control"
                                                   placeholder="Наприклад: директора">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">ПІБ особи постачальника</span>
                                            </div>
                                            <input type="text" name="provider_person" class="form-control"
                                                   placeholder="Наприклад: Іванов І.І.">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">діє на підставі </span>
                                            </div>
                                            <input type="text" name="provider_basis" class="form-control"
                                                   placeholder="Наприклад: Статуту">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <hr/>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Покупець</span>
                                            </div>
                                            <select class="form-control show-tick ms select2" name="customer">
                                                <?php
                                                $obj_customer = new Customers();
                                                $customer = $obj_customer->getAll();
                                                $count_c = count($customer);
                                                for ($j = 0; $j < $count_c; $j++) {
                                                    ?>
                                                    <option value="<?php echo $customer[$j]['id']; ?>"><?php echo $customer[$j]['name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">в особі</span>
                                            </div>
                                            <input type="text" name="customer_position" class="form-control"
                                                   placeholder="Наприклад: директора">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">ПІБ особи покупця</span>
                                            </div>
                                            <input type="text" name="customer_person" class="form-control"
                                                   placeholder="Наприклад: Іванов І.І.">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">діє на підставі </span>
                                            </div>
                                            <input type="text" name="customer_basis" class="form-control"
                                                   placeholder="Наприклад: Статуту">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <hr/>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Код за ДК 021:2015</span>
                                            </div>
                                            <select class="form-control show-tick ms select2"
                                                    name="classificatory_code">
                                                <?php
                                                $classificatory = getObjDK_021_2015();
                                                $count = count($classificatory);
                                                for ($k = 0; $k < $count; $k++) {
                                                    ?>
                                                    <option value="<?php echo $classificatory[$k]['id']; ?>"><?php echo $classificatory[$k]['cpv']."&nbsp;\"".$classificatory[$k]['description']."\""; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <hr/>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Сума договору</span>
                                            </div>
                                            <input type="number" name="contract_sum" class="form-control"
                                                   placeholder="Наприклад: 1020,00" step="0.01">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Форма розрахунку</span>
                                            </div>
                                            <input type="text" name="paying_form" class="form-control"
                                                   placeholder="Наприклад: безготівкова">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Умови розрахунку</span>
                                            </div>
                                            <input type="text" name="condition_of_calculation" class="form-control"
                                                   placeholder="Наприклад: після поставки товару">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <hr/>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Умови поставки</span>
                                            </div>
                                            <input type="text" name="terms_of_delivery" class="form-control"
                                                   placeholder="Наприклад: транспортом Постачальника">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Податковий статус постачальника</span>
                                            </div>
                                            <input type="text" name="provider_tax_status" class="form-control"
                                                   placeholder="Наприклад: є платником єдиного податку другої групи , не є платником ПДВ.">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <hr/>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Термін дії договору</span>
                                            </div>
                                            <input type="date" name="expire_date" class="form-control"
                                                   placeholder="Наприклад: 08.12.2035">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <hr/>
                                    <div class="checkbox">
                                        <input type="checkbox" id="finalize" name="finalize"/>
                                        <label for="finalize">Фіналізувати договір</label>
                                    </div>
                                    <hr/>
                                </div>
                                <div class="col-sm-12">
                                    <hr/>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <button class="btn btn-block btn-success" id="submit_form">Створити</button>
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
        let contract_number = $("input[name=contract_number]").val();
        let city = $("input[name=city]").val();
        let date = $("input[name=date]").val();
        let provider = $("select[name=provider]").val();
        let provider_position = $("input[name=provider_position]").val();
        let provider_person = $("input[name=provider_person]").val();
        let provider_basis = $("input[name=provider_basis]").val();
        let customer = $("select[name=customer]").val();
        let customer_position = $("input[name=customer_position]").val();
        let customer_person = $("input[name=customer_person]").val();
        let customer_basis = $("input[name=customer_basis]").val();
        let classificatory_code = $("select[name=classificatory_code]").val();
        let contract_sum = $("input[name=contract_sum]").val();
        let paying_form = $("input[name=paying_form]").val();
        let condition_of_calculation = $("input[name=condition_of_calculation]").val();
        let terms_of_delivery = $("input[name=terms_of_delivery]").val();
        let provider_tax_status = $("input[name=provider_tax_status]").val();
        let expire_date = $("input[name=expire_date]").val();
        let finalize = null;
        if ($("input[name=finalize]").is(":checked")) {
            finalize = 1;
        } else {
            finalize = 0;
        }

        let async = "create_contract";
        $.ajax({
            url: "/app/resources/services/doc/contract_generate_tpl.php",
            type: "POST",
            data:
                {
                    async:
                        JSON.stringify({
                            function: async,
                            async_data: {
                                contract_number: contract_number,
                                city: city,
                                date: date,
                                provider: provider,
                                provider_position: provider_position,
                                provider_person: provider_person,
                                provider_basis: provider_basis,
                                customer: customer,
                                customer_position: customer_position,
                                customer_person: customer_person,
                                customer_basis: customer_basis,
                                classificatory_code: classificatory_code,
                                contract_sum: contract_sum,
                                paying_form: paying_form,
                                condition_of_calculation: condition_of_calculation,
                                terms_of_delivery: terms_of_delivery,
                                provider_tax_status: provider_tax_status,
                                expire_date: expire_date,
                                finalize:finalize
                            }
                        })
                },
            success: function (data) {
                let dataObj = JSON.parse(data);

                if (dataObj.response === "error") {
                    swal({
                        title: "Помилка",
                        text: "Не вдалося створити договір",
                        icon: "error",
                    });
                } else if (dataObj.response === "success") {
                    swal({
                        title: "Успіх",
                        text: "Договір створено успішно",
                        icon: "success",
                    });
                    location.assign(dataObj.download);
                    $.post('/temp/clear.php',{temp: dataObj.tempFile});
                    setTimeout(() => location.replace('/?page=contracts'), 3000);
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


    $(document).ready(function () {
        $('.ms').select2();
    });
</script>