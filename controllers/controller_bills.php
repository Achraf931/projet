<?php
require_once ('./tools/userVerif.php');

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