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
                    <h2>Управління одиницями виміру</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="?page=main"><i class="zmdi zmdi-home"></i><?= APP_NAME; ?>
                            </a></li>
                        <li class="breadcrumb-item active">Налаштування</li>
                        <li class="breadcrumb-item active">Управління одиницями виміру</li>
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
                                <div class="col-9"><h5><strong>Управління</strong> одиницями виміру</h5></div>
                                <div class="col-3"><a href="?page=add_unit" class="btn btn-primary float-right"><i class="zmdi zmdi-plus-circle-o"></i>&nbsp;Додати</a></div>
                            </div>
                        </div>
                        <div class="body">
                            <h5>Управління одиницями виміру</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered text-center">
                                    <thead>
                                    <tr class="text-center">
                                        <th>ID</th>
                                        <th>Назва</th>
                                        <th>Дії</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $obj_unit = new Service();
                                    $unit = $obj_unit->getAllUnits();
                                    $count = count($unit);
                                    for ($i = 0; $i < $count; $i++) {
                                        ?>
                                        <tr id="unit_id_<?php echo $unit[$i]['id']; ?>">
                                            <th scope="row"><?php echo $unit[$i]['id']; ?></th>
                                            <td><?php echo $unit[$i]['name']; ?></td>
                                            <td>
                                                <div class="btn-group btn-group-justified">
                                                    <a href="/?page=edit_unit&id=<?php echo $unit[$i]['id']; ?>"
                                                       class="btn btn-primary">Редагувати</a>
                                                    <button class="btn btn-danger"
                                                            onclick='delete_unit("<?php echo $unit[$i]['id']; ?>")'>
                                                        Видалити
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php }
                                    ?>
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
    function delete_unit(id) {
        swal({
            title: "Ви впевнені?",
            text: "Після видалення інформаціїї, її неможливо буде відновити!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {

                    let async = "delete_unit";
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
                                    text: "Не вдалося видалити одиницю виміру",
                                    icon: "error",
                                });
                            } else if (data === "success") {
                                swal({
                                    title: "Успіх",
                                    text: "Одиницю виміру видалено успішно",
                                    icon: "success",
                                });
                                $("#unit_id_"+id).hide();
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