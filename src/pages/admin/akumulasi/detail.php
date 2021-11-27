<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Aplikasi Persepsi Antikorupsi">
    <meta name="author" content="TMK Group">
    <meta name="keywords" content="Antikorupsi, BBK, Balai, Besar, Keramik, KEMENPERIN">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="/assets/img/icons/icon-48x48.png" />

    <title>Dashboard Anti Korupsi</title>

    <link href="/assets/css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>

<body>
    <div class="wrapper">
        <?php require __DIR__ . '/../../admin-layout/sidebar.php'; ?>

        <div class="main">
            <?php require __DIR__ . '/../../admin-layout/navbar.php'; ?>

            <main class="content">
                <div class="container-fluid p-0">

                    <div class="row mb-2 mb-xl-3">
                        <div class="col-auto d-none d-sm-block">
                            <h3><strong>Akumulasi</strong> Anti-Korupsi</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-xxl-12">
                            <div class="card flex-fill w-100">
                                <div class="card-header">

                                    <h5 class="card-title mb-0">Detail Akumulasi</h5>
                                    <span>Periode <?= isset($tgl_mulai) && $tgl_mulai != '' ?
                                                        (date('d M Y', strtotime($tgl_mulai)) . " s/d " . (isset($tgl_berakhir) && $tgl_berakhir != '' ? date('d M Y', strtotime($tgl_berakhir)) : date('d M Y')))
                                                        : (date('d M Y', strtotime($hasil->items[0]['dateCreate'])) . " s/d " . date('d M Y', strtotime($hasil->items[26]['dateCreate'])));
                                                    ?></span>
                                </div>
                                <div class="card-body py-3">
                                    <div class="table-responsive">
                                        <table class="table table-hover my-0 mx-0">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2">No</th>
                                                    <th rowspan="2">Pertanyaan</th>
                                                    <th colspan="<?= count($responden->items) ?>">Responden</th>
                                                </tr>
                                                <tr>
                                                    <?php for ($i = 1; $i <= count($responden->items); $i++) { ?>
                                                        <th><?= "R" . $i; ?></th>
                                                    <?php } ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($pertanyaan->items as $key => $data) { ?>
                                                    <tr>
                                                        <td><?= $key += 1; ?></td>
                                                        <td><?= $data['namaPertanyaan']; ?></td>
                                                        <?php foreach ($respondenHasil->items as $ke2 => $data2) { ?>
                                                            <?php if ($data2['idPertanyaan'] == $data['idPertanyaan']) { ?>
                                                                <td><?= $data2['nilaiPertanyaan']; ?></td>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </tr>
                                                <?php } ?>
                                                <tr>
                                                    <td colspan="2">Total</td>
                                                    <?php foreach ($responden->items as $key => $data3) { ?>
                                                        <td><?= $getTotalNilai($respondenHasil->items, $data3['idResponden']); ?></td>
                                                    <?php } ?>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">#</td>
                                                    <?php foreach ($responden->items as $key => $data3) { ?>
                                                        <td><?= number_format($getTotalNilai($respondenHasil->items, $data3['idResponden']) / count($pertanyaan->items), 2, ',', ','); ?></td>
                                                    <?php } ?>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </main>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-start">
                            <p class="mb-0">
                                <a href="index.html" class="text-muted"><strong>Balai Besar Keramik</strong></a> &copy; <?= date('Y'); ?>
                            </p>
                        </div>
                        <div class="col-6 text-end">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a class="text-muted" href="#">Support</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="#">Help Center</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="/assets/js/app.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script>
    <script>
        $(function() {
            $(".datepicker").datepicker();
        });
    </script>

</body>

</html>