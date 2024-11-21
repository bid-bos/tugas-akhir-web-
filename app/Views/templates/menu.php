<?= $this->extend('templates/main') ?>
<?= $this->section('menu') ?>
<li class="nav-item">
    <a class="nav-link" href="<?= base_url('/')?>">
        <i class="mdi mdi-home menu-icon"></i>
        <span class="menu-title">Dashboard</span>
    </a>
    <a class="nav-link" href="<?= base_url('User')?>">
        <i class="mdi mdi-folder-account menu-icon"></i>
        <span class="menu-title">User Manage</span>
    </a>
    <a class="nav-link" href="<?= base_url('transaction')?>">
        <i class="mdi mdi-credit-card menu-icon"></i>
        <span class="menu-title">Transaction Manage</span>
    </a>
    <a class="nav-link" href="<?= base_url('categories')?>">
        <i class="mdi mdi-folder menu-icon"></i>
        <span class="menu-title">Categories Manage</span>
    </a>
<?= $this->endSection() ?>