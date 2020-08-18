<?

include("app/resources/classes/FileInspector.php");
include($_SERVER['DOCUMENT_ROOT'] . "/app/resources/services/micro/dk_021_2015.php");

if ($_FILES && $_FILES['verify']['error'] == UPLOAD_ERR_OK) {
    $temp = $_SERVER['DOCUMENT_ROOT'] . '/temp/' . $_FILES['verify']['name'];
    move_uploaded_file($_FILES['verify']['tmp_name'], $temp);

    $inspector = new FileInspector();
    $hash = $inspector->inspect($temp);
    $obj = $inspector->verify($hash);
    $doctype = $inspector->getDocumentType($hash);

}
?>

<section class="content">
    <div class="body_scroll">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Перевірка дійсності <strong>електронного документу</strong></h2>
                        </div>
                        <div class="body">
                            <?php
                            if ($_FILES && $_FILES['verify']['error'] == UPLOAD_ERR_OK) {
                                $temp = $_SERVER['DOCUMENT_ROOT'] . '/temp/' . $_FILES['verify']['name'];
                                move_uploaded_file($_FILES['verify']['tmp_name'], $temp);

                                $inspector = new FileInspector();
                                $hash = $inspector->inspect($temp);
                                $obj = $inspector->verify($hash);
                                $doctype = $inspector->getDocumentType($hash);

                                if ($doctype == "invoice") {
                                    ?>
                                    <div class="alert alert-success">Дійсний документ (Рахунок-фактура
                                        № <?= $obj->invoice->invoice_number; ?>)
                                    </div>
                                    <table class="table table-bordered">
                                        <tr>
                                            <td><strong>Тип документу</strong></td>
                                            <td><strong>Рахунок-факутура</strong></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Постачальник</td>
                                            <td><?php
                                                $obj_provider = new Companies();
                                                $provider = $obj_provider->getById($obj->invoice->provider);
                                                echo $provider[0]['name'];
                                                ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Одержувач</td>
                                            <td><?php
                                                $obj_customer = new Customers();
                                                $customer = $obj_customer->getById($obj->invoice->customer);
                                                echo $customer[0]['name'];
                                                ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Платник</td>
                                            <td><?php
                                                if ($obj->invoice->same == 1) {
                                                    echo "Той самий";
                                                } else {
                                                    $obj_payer = new Customers();
                                                    $payer = $obj_payer->getById($obj->invoice->provider);
                                                    echo $payer[0]['name'];
                                                }
                                                ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Дата</strong></td>
                                            <td><?= $obj->invoice->date; ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Сума без ПДВ</strong></td>
                                            <td><?= $obj->invoice->total_without_vat; ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>ПДВ</strong></td>
                                            <td><?= $obj->invoice->total_vat; ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Сумма з ПДВ</strong></td>
                                            <td><?= $obj->invoice->total_with_vat; ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Виписав</strong></td>
                                            <td><?= $obj->invoice->written_by; ?></td>
                                        </tr>
                                        <tr class="bg-blush">
                                            <td><strong>Хеш захисту</strong></td>
                                            <td><?= $obj->invoice->security_hash; ?></td>
                                        </tr>
                                    </table>
                                    <a href="<?= $obj->invoice->finalized_path; ?>" class="btn btn-primary btn-block"><i
                                                class="zmdi zmdi-download"></i>&nbsp;Завантажити дублікат документу</a>
                                <?php } elseif ($doctype == "outcoming_waybill") {
                                    ?>
                                    <div class="alert alert-success">Дійсний документ (Видаткова накладна
                                        № <?= $obj->waybill->waybill_number; ?>)
                                    </div>
                                    <table class="table table-bordered">
                                        <tr>
                                            <td><strong>Тип документу</strong></td>
                                            <td><strong>Видаткова накладна</strong></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Постачальник</td>
                                            <td><?php
                                                $obj_provider = new Companies();
                                                $provider = $obj_provider->getById($obj->waybill->provider);
                                                echo $provider[0]['name'];
                                                ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Одержувач</td>
                                            <td><?php
                                                $obj_customer = new Customers();
                                                $customer = $obj_customer->getById($obj->waybill->customer);
                                                echo $customer[0]['name'];
                                                ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Платник</td>
                                            <td><?php
                                                if ($obj->waybill->same == 1) {
                                                    echo "Той самий";
                                                } else {
                                                    $obj_payer = new Customers();
                                                    $payer = $obj_payer->getById($obj->waybill->provider);
                                                    echo $payer[0]['name'];
                                                }
                                                ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Дата</strong></td>
                                            <td><?= $obj->waybill->date; ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Сума без ПДВ</strong></td>
                                            <td><?= $obj->waybill->total_without_vat; ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>ПДВ</strong></td>
                                            <td><?= $obj->waybill->total_vat; ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Сумма з ПДВ</strong></td>
                                            <td><?= $obj->waybill->total_with_vat; ?></td>
                                        </tr>
                                        <tr class="bg-blush">
                                            <td><strong>Хеш захисту</strong></td>
                                            <td><?= $obj->waybill->security_hash; ?></td>
                                        </tr>
                                    </table>
                                    <a href="<?= $obj->waybill->finalized_path; ?>" class="btn btn-primary btn-block"><i
                                            class="zmdi zmdi-download"></i>&nbsp;Завантажити дублікат документу</a>
                                    <? } elseif ($doctype == "incoming_waybill") {
                                    ?>
                            <div class="alert alert-success">Дійсний документ (Прибуткова накладна
                                № <?= $obj->incoming_waybill->waybill_number; ?>)
                            </div>
                            <table class="table table-bordered">
                                <tr>
                                    <td><strong>Тип документу</strong></td>
                                    <td><strong>Прибуткова накладна</strong></td>
                                </tr>
                                <tr>
                                    <td><strong>Постачальник</td>
                                    <td><?php
                                        $obj_provider = new Providers();
                                        $provider = $obj_provider->getById($obj->incoming_waybill->provider);
                                        echo $provider[0]['name'];
                                        ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Одержувач</td>
                                    <td><?php
                                        $obj_customer = new Companies();
                                        $customer = $obj_customer->getById($obj->incoming_waybill->customer);
                                        echo $customer[0]['name'];
                                        ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Платник</td>
                                    <td><?php
                                        if ($obj->waybill->same == 1) {
                                            echo "Той самий";
                                        } else {
                                            $obj_payer = new Companies();
                                            $payer = $obj_payer->getById($obj->incoming_waybill->provider);
                                            echo $payer[0]['name'];
                                        }
                                        ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Дата</strong></td>
                                    <td><?= $obj->incoming_waybill->date; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Сума без ПДВ</strong></td>
                                    <td><?= $obj->incoming_waybill->total_without_vat; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>ПДВ</strong></td>
                                    <td><?= $obj->incoming_waybill->total_vat; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Сумма з ПДВ</strong></td>
                                    <td><?= $obj->incoming_waybill->total_with_vat; ?></td>
                                </tr>
                                <tr class="bg-blush">
                                    <td><strong>Хеш захисту</strong></td>
                                    <td><?= $obj->incoming_waybill->security_hash; ?></td>
                                </tr>
                            </table>
                            <a href="<?= $obj->incoming_waybill->finalized_path; ?>" class="btn btn-primary btn-block"><i
                                    class="zmdi zmdi-download"></i>&nbsp;Завантажити дублікат документу</a>
                            <?
                            } elseif ($doctype == "specification") {
                                    ?>
                                    <div class="alert alert-success">Дійсний документ (Специфікація
                                        № <?= $obj->specification->specification_number; ?>)
                                    </div>
                                    <table class="table table-bordered">
                                        <tr>
                                            <td><strong>Тип документу</strong></td>
                                            <td><strong>Специфікація до договору</strong></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Договір №</td>
                                            <td><?php
                                                $obj_contract = new Contracts();
                                                $contract = $obj_contract->getById($obj->specification->contract_id);
                                                echo $contract[0]['contract_number'];
                                                ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Дата</strong></td>
                                            <td><?= $obj->specification->date; ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Сума без ПДВ</strong></td>
                                            <td><?= $obj->specification->total_without_vat; ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>ПДВ</strong></td>
                                            <td><?= $obj->specification->total_vat; ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Сумма з ПДВ</strong></td>
                                            <td><?= $obj->specification->total_with_vat; ?></td>
                                        </tr>
                                        <tr class="bg-blush">
                                            <td><strong>Хеш захисту</strong></td>
                                            <td><?= $obj->specification->security_hash; ?></td>
                                        </tr>
                                    </table>
                                    <a href="<?= $obj->specification->finalized_path; ?>"
                                       class="btn btn-primary btn-block"><i
                                                class="zmdi zmdi-download"></i>&nbsp;Завантажити дублікат документу</a>
                                    <?
                                } elseif ($doctype == "contract") {
                                    ?>
                                    <div class="alert alert-success">Дійсний документ (Договір
                                        № <?= $obj->contract->contract_number; ?>)
                                    </div>
                                    <table class="table table-bordered">
                                        <tr>
                                            <td><strong>Тип документу</strong></td>
                                            <td><strong>Договір</strong></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Місце складання</td>
                                            <td><?= $obj->contract->city; ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Постачальник/Виконавець</strong></td>
                                            <td><?
                                                $obj_provider = new Companies();
                                                $provider = $obj_provider->getById($obj->contract->provider_id);
                                                echo $provider[0]['name'];
                                                ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Особа постачальника</strong></td>
                                            <td><?= $obj->contract->provider_person; ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Покупець/Клієнт</strong></td>
                                            <td><?
                                                $obj_customer = new Customers();
                                                $customer = $obj_customer->getById($obj->contract->customer_id);
                                                echo $customer[0]['name'];
                                                ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Особа покупця</strong></td>
                                            <td><?= $obj->contract->customer_person; ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>ДК 021:2015</strong></td>
                                            <td><?
                                                $classificatory = getObjDK_021_2015ValueUA($obj->contract->classificatory_code);
                                                echo $classificatory;
                                                ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Сумма</strong></td>
                                            <td><?= $obj->contract->contract_sum; ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Дата складання</strong></td>
                                            <td><?= $obj->contract->date; ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Дійсний до</strong></td>
                                            <td><?= $obj->contract->expire_date; ?></td>
                                        </tr>
                                        <tr class="bg-blush">
                                            <td><strong>Хеш захисту</strong></td>
                                            <td><?= $obj->contract->security_hash; ?></td>
                                        </tr>
                                    </table>
                                    <a href="<?= $obj->contract->finalized_path; ?>"
                                       class="btn btn-primary btn-block"><i
                                                class="zmdi zmdi-download"></i>&nbsp;Завантажити дублікат документу</a>
                                    <?
                                } else {
                                    ?>
                                    <div class="alert alert-danger">
                                        Документ недійсний або не існує!
                                    </div>
                                    <?
                                } ?>
                            <? } else {
                                ?>
                                <form enctype="multipart/form-data" method="post">
                                    <input type="file" name="verify" class="dropify-fr">
                                    <button class="btn btn-block btn-success" type="submit">Перевірити</button>
                                </form>
                            <?php } ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
</section>

<script type="text/javascript">
    $(function () {
        "use strict";
        $('.dropify').dropify();

        var drEvent = $('#dropify-event').dropify();
        drEvent.on('dropify.beforeClear', function (event, element) {
            return confirm("Ви дійсно хчете видалити файл \"" + element.file.name + "\" ?");
        });

        drEvent.on('dropify.afterClear', function (event, element) {
            alert('Файл видалено');
        });

        $('.dropify-fr').dropify({
            messages: {
                default: 'Натисніть або перетягніть файл для перевірки',
                replace: 'Натисніть або перетягніть файл для заміни',
                remove: 'Видалити',
                error: 'Помилка'
            }
        });
    });
</script>