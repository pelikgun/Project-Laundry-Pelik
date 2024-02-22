<?php
include_once 'template/header.php';
include_once 'template/navbar.php';

if (@$_GET['page'] == '') {
    header('Location: index.php?page=Dashboard');
} else {
    switch (@$_GET['page']) {
        case 'Dashboard':
            include_once 'view/dashboard.php';
            break;
        case 'Outlet':
            include_once 'view/outlet.php';
            break;
        case 'Paket':
            include_once 'view/paket.php';
            break;
        case 'Transaksi':
            include_once 'view/transaksi.php';
            break;
        case 'Pelanggan':
            include_once 'view/pelanggan.php';
            break;
        case 'Entri_Transaksi':
            include_once 'view/entri_transaksi.php';
            break;
        case 'User':
            include_once 'view/user.php';
            break;
        case 'Laporan':
            include_once 'view/laporan.php';
            break;
    }
}

include_once 'template/footer.php';