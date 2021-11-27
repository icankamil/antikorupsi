<nav class="navbar navbar-expand navbar-light navbar-bg">
    <a class="sidebar-toggle d-flex">
        <i class="hamburger align-self-center"></i>
    </a>

    <?php

    use Core\Classes\SessionData;

    if ($GLOBALS['url'] == '/admin/akumulasi' || $GLOBALS['url'] == '/admin/detail-akumulasi') { ?>
        <form class="d-none d-sm-inline-block" method="GET" action="">
            <div class="input-group input-group-navbar">
                <input type="text" class="form-control datepicker" placeholder="Dari Tanggal" aria-label="Search" name="tgl_mulai" autocomplete="off" value="<?= isset($tgl_mulai) ? date('Y-m-d', strtotime($tgl_mulai)) : '' ?>">
                <input type="text" class="form-control datepicker" placeholder="Sampai Tanggal" aria-label="Search" name="tgl_berakhir" autocomplete="off" value="<?= isset($tgl_berakhir) ? date('Y-m-d', strtotime($tgl_berakhir)) : '' ?>">
                <button class="btn" type="submit">
                    <i class="align-middle" data-feather="search"></i>
                </button>
            </div>
        </form>
    <?php } ?>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">
            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                    <i class="align-middle" data-feather="settings"></i>
                </a>

                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                    <img src="/assets/img/avatars/avatar.jpg" class="avatar img-fluid rounded me-1" alt="Charles Hall" /> <span class="text-dark"><?= SessionData::get('namaUser') ?></span>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="/logout">Log out</a>
                </div>
            </li>
        </ul>
    </div>
</nav>