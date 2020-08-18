<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Інформація про підприємство</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="?page=main"><i class="zmdi zmdi-home"></i><?= APP_NAME; ?>
                            </a></li>
                        <li class="breadcrumb-item active">Налаштування</li>
                        <li class="breadcrumb-item active">Управління підприємствами</li>
                        <li class="breadcrumb-item active">Інформація про підприємство</li>
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
                <?php
                $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                if (empty($id) || !isset($id)) {
                    echo " <div class='col-lg-12 col-md-12'>
                                    <div class='card mcard_3'>
                           <div class='body'>
                                <h2 class='card-inside-title'>Інформація про підприємство</h2>
                                <div class='alert alert-danger'>Помилка! Не обрано підприємсвто для перегляду.</div>
                            </div>
                            </div></div></div></div></div></section>";
                }else{
                $obj_company = new Companies();
                $company = $obj_company->getById($id);
                $count = count($company);
                for ($i = 0;
                $i < $count;
                $i++) {
                ?>
                <div class="col-lg-4 col-md-12">
                    <div class="card mcard_3">
                        <div class="body">
                            <h4 class="m-t-10"><?php echo htmlspecialchars($company[$i]['name']); ?></h4>
                            <div class="row">
                                <div class="col-12">
                                    <p class="text-black"><strong>Юридична адреса:</strong></p>
                                    <p class="text-muted"><?php echo htmlspecialchars($company[$i]['legal_address']); ?></p>
                                </div>
                                <div class="col-12">
                                    <p class="text-black"><strong>Фактична адреса:</strong></p>
                                    <p class="text-muted"><?php echo htmlspecialchars($company[$i]['actual_address']); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="body">
                            <small class="text-muted">Email адреса: </small>
                            <p><?php echo htmlspecialchars($company[$i]['email']); ?></p>
                            <hr>
                            <small class="text-muted">Телефони: </small>
                            <p><?php echo htmlspecialchars($company[$i]['telephones']); ?></p>
                            <hr>
                            <small class="text-muted">Web-сайт: </small>
                            <p><?php echo htmlspecialchars($company[$i]['website']); ?></p>
                            <hr>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-12">
                    <div class="card">
                        <div class="body">
                            <div class="row">
                                   <div class="col-12">
                                       <a href="#" class="btn btn-primary float-right"><i class="zmdi zmdi-download"></i>&nbsp;Завантажити</a>
                                       <a href="#" class="btn btn-primary float-right"><i class="zmdi zmdi-print"></i>&nbsp;Роздрукувати</a>
                                   </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="header">
                            <h2><strong>Юридична</strong> інформація</h2>
                        </div>
                        <div class="body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <small class="text-muted">ЄДРОПУ: </small>
                                    <p><?php echo htmlspecialchars($company[$i]['code']); ?></p>
                                    <hr>
                                </div>
                                <div class="col-sm-4">
                                    <small class="text-muted">РНОКПП (ІПН): </small>
                                    <p><?php echo htmlspecialchars($company[$i]['tax_number']); ?></p>
                                    <hr>
                                </div>
                                <div class="col-sm-4">
                                    <small class="text-muted">Номер свідоцтва: </small>
                                    <p><?php echo htmlspecialchars($company[$i]['certificate_number']); ?></p>
                                    <hr>
                                </div>
                                <div class="col-sm-6">
                                    <small class="text-muted">Директор: </small>
                                    <p><?php echo htmlspecialchars($company[$i]['director']); ?></p>
                                    <hr>
                                </div>
                                <div class="col-sm-6">
                                    <small class="text-muted">Головний бухгалтер: </small>
                                    <p><?php echo htmlspecialchars($company[$i]['chief_accountant']); ?></p>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="header">
                            <h2><strong>Фінансова</strong> інформація</h2>
                        </div>
                        <div class="body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <small class="text-muted">Поточний рахунок (IBAN): </small>
                                    <p><?php echo htmlspecialchars($company[$i]['current_account']); ?></p>
                                    <hr>
                                </div>
                                <div class="col-sm-4">
                                    <small class="text-muted">МФО банку: </small>
                                    <p><?php echo htmlspecialchars($company[$i]['bank_code']); ?></p>
                                    <hr>
                                </div>
                                <div class="col-sm-4">
                                    <small class="text-muted">Найменування банку: </small>
                                    <p><?php echo htmlspecialchars($company[$i]['bank_name']); ?></p>
                                    <hr>
                                </div>
                                <div class="col-sm-6">
                                    <small class="text-muted">Вид цивільно-правового договору: </small>
                                    <p><?php
                                        $civil_contract_type = htmlspecialchars($company[$i]['civil_contract_type']);
                                        if (empty($civil_contract_type)){
                                            echo "Не вказано";
                                        }else{
                                            echo $civil_contract_type;
                                        }
                                    ?></p>
                                    <hr>
                                </div>
                                <div class="col-sm-6">
                                    <small class="text-muted">ПДВ: </small>
                                    <p><?php
                                        $vat = htmlspecialchars($company[$i]['vat']);
                                        switch ($vat){
                                            case 0:
                                                echo "Неплатник ПДВ (0%)";
                                                break;
                                            case 1:
                                                echo "Платник ПДВ (7%)";
                                                break;
                                            case 2:
                                                echo "Платник ПДВ (20%)";
                                                break;
                                        }
                                    ?></p>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="header">
                            <h2><strong>Додаткова</strong> інформація</h2>
                        </div>
                        <div class="body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <small class="text-muted">Додаткове поле 1 </small>
                                    <p><?php
                                        $additional_field_0 = htmlspecialchars($company[$i]['additional_field_0']);
                                        if(empty($additional_field_0)){
                                            echo "Не вказано";
                                        }else{
                                            echo $additional_field_0;
                                        }
                                        ?></p>
                                    <hr>
                                </div>
                                <div class="col-sm-4">
                                    <small class="text-muted">Додаткове поле 2 </small>
                                    <p><?php
                                        $additional_field_1 = htmlspecialchars($company[$i]['additional_field_1']);
                                        if(empty($additional_field_1)){
                                            echo "Не вказано";
                                        }else{
                                            echo $additional_field_1;
                                        }
                                        ?></p>
                                    <hr>
                                </div>
                                <div class="col-sm-4">
                                    <small class="text-muted">Додаткове поле 3 </small>
                                    <p><?php
                                        $additional_field_2 = htmlspecialchars($company[$i]['additional_field_2']);
                                        if(empty($additional_field_2)){
                                            echo "Не вказано";
                                        }else{
                                            echo $additional_field_2;
                                        }
                                        ?></p>
                                    <hr>
                                </div>
                                <div class="col-sm-6">
                                    <small class="text-muted">Додаткове поле 4 </small>
                                    <p><?php
                                        $additional_field_3 = htmlspecialchars($company[$i]['additional_field_3']);
                                        if(empty($additional_field_3)){
                                            echo "Не вказано";
                                        }else{
                                            echo $additional_field_3;
                                        }
                                        ?></p>
                                    <hr>
                                </div>
                                <div class="col-sm-6">
                                    <small class="text-muted">Додаткове поле 5 </small>
                                    <p><?php
                                        $additional_field_4 = htmlspecialchars($company[$i]['additional_field_4']);
                                        if(empty($additional_field_4)){
                                            echo "Не вказано";
                                        }else{
                                            echo $additional_field_4;
                                        }
                                        ?></p>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php }
} ?>