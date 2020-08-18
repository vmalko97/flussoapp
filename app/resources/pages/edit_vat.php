<?php
$obj_user = new Users();
$user = $obj_user->getByIdObject($_SESSION['uid']);
if ($user->status == "admin") {
    ?>
    <section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Редагувати вид ПДВ</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="?page=main"><i class="zmdi zmdi-home"></i><?= APP_NAME; ?>
                            </a></li>
                        <li class="breadcrumb-item active">Налаштування</li>
                        <li class="breadcrumb-item active">Управління видами ПДВ</li>
                        <li class="breadcrumb-item active">Редагувати вид ПДВ</li>
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
                            <h5><strong>Редагувати</strong> вид ПДВ</h5>
                        </div>
                        <?php
                        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                        if (empty($id) || !isset($id)) {
                            echo "<div class='body'>
                                <h2 class='card-inside-title'>Редагувати вид ПДВ</h2>
                                <div class='alert alert-danger'>Помилка! Не обрано вид ПДВ для редагування.</div>
                            </div>
                            </div></div></div></div></div></section>";
                        }else{
                        $obj_vat = new Service();
                        $vat = $obj_vat->getVatTypeById($id);
                        $count = count($vat);
                        for ($i = 0;
                        $i < $count;
                        $i++) {
                        ?>
                        <div class="body">
                            <h2 class="card-inside-title">Редагувати вид ПДВ</h2>
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control"
                                               placeholder="Назва"
                                               value="<?php echo htmlspecialchars($vat[$i]['name']); ?>"/>
                                    </div>
                                    <div class="form-group">
                                        <input type="number" name="percent" class="form-control"
                                               placeholder="Процент (0.00000)"
                                               value="<?php echo htmlspecialchars($vat[$i]['percent']); ?>"
                                               step="0.00001"/>
                                    </div>
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
        let percent = $("input[name=percent]").val();

        let async = "update_vat";
        $.ajax({
            url: "/app/resources/system/async.php",
            type: "POST",
            data:
                {
                    async:
                        JSON.stringify({
                            function: async,
                            async_data: {
                                id: id,
                                name: name,
                                percent: percent,
                            }
                        })
                },
            success: function (data) {
                console.log(data);
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
<?php } else { ?>
    <section class="content">
        <div class="body_scroll">
            <div class="container-fluid">
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card">

                            <div class="body">
                                <div class="alert alert-danger">
                                    У вас немає доступу до цього розділу, якщо вам потрібен доступ зверніться до адмніністратора!
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>
