<?php
if (isset($_SESSION['user']) AND $_SESSION['user']['verif'] == 0){
    header('Location:index.php?page=verification');
    exit;
}
if (isset($_SESSION['user'])) {
    require_once('./models/model_bills.php');
    $pageTitle = 'Liste des factures';
    $bills = getBills($_SESSION['user']['id']);
    $view = './views/bills.php';
    require_once('./views/layout.php');
} else {
    header('Location:index.php');
    exit;
}