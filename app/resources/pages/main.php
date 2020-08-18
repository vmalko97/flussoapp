<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Головна</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/"><i class="zmdi zmdi-home"></i><?= APP_NAME; ?></a></li>
                        <li class="breadcrumb-item active">Головна</li>
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
                                <h2><strong>Головна</strong> сторінка</h2>
                            </div>

                            <div class="body">
                                <h5>Головна</h5>
                                <div class="alert alert-info">Вітаємо в системі <?= APP_NAME; ?></div>

                                <ul class="nav nav-tabs p-0 mb-3">
                                    <li class="nav-item"><a class="nav-link active" data-toggle="tab"
                                                            href="#home">Головна</a></li>
                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#sysinfo">Системна
                                            інформація</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane in active" id="home">

                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="sysinfo">
                                        <b>Системна інформація</b>
                                        <table class="table table-bordered">
                                            <tbody>
                                            <tr>
                                                <td>Назва додатку</td>
                                                <td><?= APP_NAME; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Версія додатку</td>
                                                <td><?= APP_VERSION; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Версія PHP</td>
                                                <td><?= phpversion(); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Операційна система</td>
                                                <td><?= php_uname(); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Кеш системи</td>
                                                <td><?php
                                                    $dirname = $_SERVER['DOCUMENT_ROOT'] . '/temp/';
                                                    $size = dir_size($dirname);
                                                    $formSize = format_size($size);
                                                    echo $formSize;
                                                    function dir_size($dirname)
                                                    {
                                                        $totalsize = 0;
                                                        if ($dirstream = @opendir($dirname)) {
                                                            while (false !== ($filename = readdir($dirstream))) {
                                                                if ($filename != "." && $filename != "..") {
                                                                    if (is_file($dirname . "/" . $filename))
                                                                        $totalsize += filesize($dirname . "/" . $filename);

                                                                    if (is_dir($dirname . "/" . $filename))
                                                                        $totalsize += dir_size($dirname . "/" . $filename);
                                                                }
                                                            }
                                                        }
                                                        closedir($dirstream);
                                                        return $totalsize;
                                                    }

                                                    function format_size($size)
                                                    {
                                                        $metrics[0] = 'байт';
                                                        $metrics[1] = 'Кб';
                                                        $metrics[2] = 'Мб';
                                                        $metrics[3] = 'Гб';
                                                        $metrics[4] = 'Тб';
                                                        $metric = 0;
                                                        while (floor($size / 1024) > 0) {
                                                            ++$metric;
                                                            $size /= 1024;
                                                        }
                                                        $ret = round($size, 1) . " " . (isset($metrics[$metric]) ? $metrics[$metric] : '??');
                                                        return $ret;
                                                    }

                                                    ?>&nbsp;<a href="?page=clear_cache"
                                                               class="btn btn-warning">Очистити</a></td>
                                            </tr>
                                            <tr>
                                                <td>Об'єм локальної бази даних</td>
                                                <td><?php
                                                    echo format_size(dir_size($_SERVER['DOCUMENT_ROOT'] . '/app/resources/finalized/'));
                                                    ?></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</section>