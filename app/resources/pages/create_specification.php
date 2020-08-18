<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/resources/system/date_to_string.php';
?>
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2></h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/"><i class="zmdi zmdi-home"></i><?= APP_NAME; ?></a></li>
                        <li class="breadcrumb-item active">Специфікації</li>
                        <li class="breadcrumb-item active">Створити специфікацію</li>
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
                            <h2><strong>Створити специфікацію</strong></h2>
                        </div>
                        <div class="body">
                            <h5>Створити специфікацію</h5>
                            <div class="row clearfix">
                                <div class="col-md-12">
                                    <p><b>Договір</b></p>
                                    <select class="form-control show-tick ms select2" name="contract_id"
                                            data-placeholder="Виберіть">
                                        <?php
                                        $obj_contract = new Contracts();
                                        $contract = $obj_contract->getComplexAll();
                                        $count = count($contract);
                                        for ($i = 0; $i < $count; $i++) {
                                            ?>
                                            <option value="<?php echo $contract[$i]['id']; ?>"><?php echo "№ ".$contract[$i]['contract_number']." (".$contract[$i]['customer'].") від ".dateToString($contract[$i]['date']); ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <p class="text-center"><b>Специфікація № </b> <input type="text" class="form-control"
                                                                                  name="specification"/></p>
                                </div>
                                <div class="col-md-12">
                                    <p class="text-center"><b>від </b> <input type="date" class="form-control"
                                                                              value="<?php global $date_local;
                                                                              echo $date_local; ?>" name="date"/></p>
                                </div>
                                <div class="col-md-12">
                                    <table class="table table-bordered text-center" id="product_list">
                                        <thead>
                                        <tr class="bg-dark text-white">
                                            <th hidden>№</th>
                                            <th>Повна назва товару</th>
                                            <th>Од. вим.</th>
                                            <th>К-ть</th>
                                            <th>Ціна без ПДВ</th>
                                            <th>Сума без ПДВ</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody id="product_list_b">
                                        </tbody>
                                        <tfoot>
                                        <tr style="border: none;">
                                            <td colspan="5"></td>
                                            <td>
                                                <button type="button" class="btn btn-success" data-toggle="modal"
                                                        data-target="#defaultModal"><i
                                                        class="zmdi zmdi-plus-circle-o"></i> Додати
                                                </button>
                                            </td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <div class="col-md-12 text-right">
                                    <b>Разом без ПДВ:</b> <span id="sum_without_vat">0,00</span> <br/>
                                    <b>ПДВ:</b> <span id="sum_vat">0,00</span><br/>
                                    <b>Всього з ПДВ:</b> <span id="sum_with_vat">0,00</span><br/>
                                    <br/>
                                </div>
                                <?php
                                $obj_companies = new Companies();
                                $def_company = $obj_companies->getById('1');
                                $written_by = $def_company[0]['chief_accountant'];
                                ?>
                                <div class="col-md-12">
                                    <hr/>
                                    <div class="checkbox">
                                        <input type="checkbox" id="finalize" name="finalize"/>
                                        <label for="finalize">Фіналізувати специфікацію</label>
                                    </div>
                                    <hr/>
                                </div>
                                <div class="col-md-12">
                                    <button class="btn btn-block btn-primary" onclick="create_specification()">Створити
                                        специфікацію
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    $obj_service = new Service();
    $vat_type = $obj_service->getVatTypeById($def_company[0]['vat']);
    $vat = $vat_type[0]['percent'];
    ?>
</section>
<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="defaultModalLabel">Додати товар</h4>
            </div>
            <div class="modal-body">
                <select class="form-control show-tick ms select2" name="product"
                        data-placeholder="Виберіть">
                    <?php
                    $obj_product = new Products();
                    $product = $obj_product->getAll();
                    $count_prod = count($product);
                    for ($l = 0; $l < $count_prod; $l++) {
                        ?>
                        <option value="<?php echo $product[$l]['id']; ?>"><?php echo $product[$l]['name']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-round waves-effect" onclick="add();">Додати</button>
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Закрити</button>
            </div>
        </div>
    </div>
</div>
<script>
    function total() {
        var rowSum = 0;
        let totalSum = 0;
        let table = document.getElementById('product_list_b');
        for (let i = 0, row; row = table.rows[i]; i++) {
            rowSum = parseFloat(row.cells[5].innerHTML);
            totalSum += rowSum;
        }
        $('#sum_without_vat').text(totalSum.toFixed(2));
        let vat = <?php echo $vat;?>;
        let sumVat = (totalSum / 100) * vat;
        $('#sum_vat').text(sumVat.toFixed(2));
        $('#sum_with_vat').text((totalSum + sumVat).toFixed(2));
    }

    function update_sum(col) {
        let sum = parseFloat($('#num_col_' + col).val()) * parseFloat($('#price_col_' + col).text());
        $('#sum_col_' + col).text(sum.toFixed(2));
        total();
    }

    function delete_col(col) {
        $("tr").eq(col).remove();
        total();
    }

    function add() {
        let product_id = $("select[name=product]").val();

        let async = "get_product";
        $.ajax({
            url: "/app/resources/system/async.php",
            type: "POST",
            data:
                {
                    async:
                        JSON.stringify({
                            function: async,
                            async_data: {
                                product_id: product_id,
                            }
                        })
                },
            success: function (data) {
                let product = JSON.parse(data);
                let last_num = $('#product_list > tbody > tr:last > td#id').text();
                let num;
                if (last_num === "") {
                    num = 1;
                } else {
                    num = parseInt(last_num) + 1;
                }
                $('#product_list > tbody').append('<tr>' +
                    '<td id="id" hidden>' + num + '</td>' +
                    '<td>' + product[0].name + '</td>' +
                    '<td>' + product[0].units + '</td>' +
                    '<td><input class="form-control" type="number" step="0.01" value="1" id="num_col_' + num + '" onchange="update_sum(' + num + ')"/></td>' +
                    '<td id="price_col_' + num + '">' + product[0].price + '</td>' +
                    '<td id="sum_col_' + num + '">' + product[0].price + '</td>' +
                    '<td><button class="btn btn-danger" onclick="delete_col(' + num + ')"><i class="zmdi zmdi-close-circle"></i> Видалити</button></td>' +
                    '</tr>');
                total();
            }
        });
    }

    function create_specification() {
        let contract_id = $('select[name=contract_id]').val();
        let specification = $('input[name=specification]').val();
        let date = $('input[name=date]').val();
        let dataTable = [];// Ответ
        const nameTd = ['name', 'units', 'quantity', 'price', 'sum'];
        const Table = $('#product_list_b');
        const numberTr = Table.find('tr').length; //Количество ячеек по вертикали

        for (let i = 1; i <= numberTr; i++) {
            const objectTd = {};

            for (let k = 0; k < nameTd.length; k++) {
                if (k === 2) {
                    objectTd[nameTd[k]] = Table.find(`tr:nth-child(${i})>td:nth-child(${k + 2})>input`).val();
                } else {
                    objectTd[nameTd[k]] = Table.find(`tr:nth-child(${i})>td:nth-child(${k + 2})`).text();
                }
            }

            dataTable.push(objectTd);
        }
        let total_without_vat = $('#sum_without_vat').text();
        let vat = <?php echo $vat;?>;
        let total_vat = $('#sum_vat').text();
        let total_with_vat = $('#sum_with_vat').text();
        let finalize = null;
        if ($("input[name=finalize]").is(":checked")) {
            finalize = 1;
        } else {
            finalize = 0;
        }

        let async = "generate_specification";
        $.ajax({
            url: "/app/resources/services/doc/specification_generate.php",
            type: "POST",
            data:
                {
                    async:
                        JSON.stringify({
                            function: async,
                            async_data: {
                               contract_id:contract_id,
                                specification:specification,
                                date: date,
                                dataTable: dataTable,
                                total_without_vat: total_without_vat,
                                vat: vat,
                                total_vat: total_vat,
                                total_with_vat: total_with_vat,
                                finalize: finalize
                            }
                        })
                },
            success: function (data) {
                let dataObj = JSON.parse(data);

                if (dataObj.response === "error") {
                    swal({
                        title: "Помилка",
                        text: "Не вдалося створити специфікацію",
                        icon: "error",
                    });
                } else if (dataObj.response === "success") {
                    swal({
                        title: "Успіх",
                        text: "Специфікацію створено успішно",
                        icon: "success",
                    });
                    location.assign(dataObj.download);
                    $.post('/temp/clear.php',{temp: dataObj.tempFile});
                    setTimeout(() => location.replace('/?page=specifications'), 3000);
                } else {
                    swal({
                        title: "Помилка",
                        text: "Спроба взлому",
                        icon: "warning",
                    });
                }
            }
        });
    }


    $(document).ready(function () {
        $('.ms').select2();
    });
</script>