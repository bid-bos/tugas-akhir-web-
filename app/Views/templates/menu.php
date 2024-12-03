<?= $this->extend('templates/main') ?>
<?= $this->section('menu') ?>
<li class="nav-item">
    <a class="nav-link" href="<?= base_url('/') ?>">
        <i class="mdi mdi-home menu-icon"></i>
        <span class="menu-title">Dashboard</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="<?= base_url('user') ?>">
        <i class="mdi mdi-folder-account menu-icon"></i>
        <span class="menu-title">User Manage</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="<?= base_url('transaction') ?>">
        <i class="mdi mdi-credit-card menu-icon"></i>
        <span class="menu-title">Transaction Manage</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="<?= base_url('categories') ?>">
        <i class="mdi mdi-folder menu-icon"></i>
        <span class="menu-title">Categories Manage</span>
    </a>
</li>
<li class="nav-item dropdown user-dropdown logout-visible">
    <a class="nav-link" id="Logout" href="<?= site_url('/logout') ?>" onclick="confirmLogout(event)">
        <button type="button" class="btn btn-danger btn-rounded btn-fw">
            <i class="fa fa-sign-out"></i>
        </button>
    </a>
</li>

<style>
    .logout-visible {
        display: none;
    }

    @media (max-width: 992px) {
        .logout-visible {
            display: block;
        }
    }
</style>
<?= $this->endSection() ?>