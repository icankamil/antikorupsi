<nav id="sidebar" class="sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="index.html">
            <span class="align-middle">AdminKit</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Utama
            </li>

            <li class="sidebar-item <?= strpos($GLOBALS['url'], '/akumulasi') !== false ? 'active' : '' ?>">
                <a class="sidebar-link" href="/admin/akumulasi">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Akumulasi</span>
                </a>
            </li>

            <li class="sidebar-item <?= strpos($GLOBALS['url'], '/pertanyaan') !== false ? 'active' : '' ?>">
                <a class="sidebar-link" href="/admin/pertanyaan">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Master Pertanyaan</span>
                </a>
            </li>

            <li class="sidebar-item <?= strpos($GLOBALS['url'], '/detail-akumulasi') !== false ? 'active' : '' ?>">
                <a class="sidebar-link" href="/admin/detail-akumulasi">
                    <i class="align-middle" data-feather="clipboard"></i> <span class="align-middle">Detail Akumulasi</span>
                </a>
            </li>

            <li class="sidebar-item <?= strpos($GLOBALS['url'], '/responden') !== false ? 'active' : '' ?>">
                <a class="sidebar-link" href="/admin/responden">
                    <i class="align-middle" data-feather="users"></i> <span class="align-middle">Responden</span>
                </a>
            </li>
        </ul>

    </div>
</nav>