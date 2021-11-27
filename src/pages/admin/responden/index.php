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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
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
                            <h3><strong>Responden</strong> Anti-Korupsi</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-xxl-12">
                            <div class="card flex-fill w-100">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Detail Responden</h5>
                                </div>
                                <div class="card-body py-3">
                                    <div class="table-responsive">
                                        <table class="table table-hover my-0 mx-0">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama</th>
                                                    <th>Jabatan</th>
                                                    <th>Telpon</th>
                                                    <th>Email</th>
                                                    <th>Perusahaan</th>
                                                    <th>Aksi</th>
                                                    <th>Tanggal Isi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!$datas->isEmpty()) { ?>
                                                    <?php foreach ($datas->items as $key => $data) { ?>
                                                        <tr>
                                                            <th><?= $key += 1 ?></th>
                                                            <td><?= $data['namaResponden'] ?></td>
                                                            <td><?= $data['profesiResponden'] ?></td>
                                                            <td><?= $data['phoneResponden'] ?></td>
                                                            <td><?= $data['emailResponden'] ?></td>
                                                            <td><?= $data['perusahaanResponden'] ?></td>
                                                            <td><button type="button" data-id="<?= $data['idResponden'] ?>" class="ubah-responden btn btn-warning" data-toggle="modal" data-target="#editModalResponden"><i class="edit align-self-center"></i> Edit</button>
                                                                <button type="button" data-id="<?= $data['idResponden'] ?>" class="hapus-responden btn btn-danger" data-toggle="modal" data-target="#hapusModalResponden"><i class="delete align-self-center"></i> Hapus</button>
                                                            </td>
                                                            <td><?= $data['dateCreate'] ?></td>
                                                        </tr>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <h2 class='text-center'> Belum ada data</h2>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <?= $datas->links() ?>
                        </div>
                    </div>

                    <!-- Edit Data -->
                    <div class="modal fade" id="editModalResponden" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="row">
                                    <div class="col-12 col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-title mb-0">Edit Data</h5>
                                            </div>
                                            <form action="" method="post" class="formEdit">
                                                <div class="card-body">
                                                    <input type="text" class="form-control mb-3 namaResponden" placeholder="Nama Responden" name="namaResponden">
                                                    <input type="text" class="form-control mb-3 profesiResponden" placeholder="Jabatan Responden" name="profesiResponden">
                                                    <input type="text" class="form-control mb-3 phoneResponden" placeholder="Nomor Telepon Responden" name="phoneResponden">
                                                    <input type="text" class="form-control mb-3 emailResponden" placeholder="Email Responden" name="emailResponden">
                                                    <input type="text" class="form-control mb-3 perusahaanResponden" placeholder="Perusahaan Responden" name="perusahaanResponden">
                                                </div>
                                                <div class="card-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Edit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Data -->

                    <!-- Hapus Data -->
                    <div class="modal fade" id="hapusModalResponden" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="row">
                                    <div class="col-12 col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-title mb-0">Hapus Data</h5>
                                            </div>
                                            <div class="card-body">
                                                <p>Yakin untuk menghapus data ini?</p>
                                            </div>
                                            <div class="card-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="button" class="btn btn-primary btnHapus">Hapus</button>
                                                <form action="" method="post" class="formHapus"></form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Hapus Data -->

                </div>
            </main>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-start">
                            <p class="mb-0">
                                <a href="index.html" class="text-muted"><strong>Balai Besar Keramik</strong></a> &copy; <?php print_r(date('Y')); ?>
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
    <script src="/assets/js/dashboard.js"></script>

</body>

</html>