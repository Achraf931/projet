<?php
if (isset($_SESSION['user']) AND $_SESSION['user']['verif'] == 0){
    header('Location:index.php?page=verification');
    exit;
}
require_once('./models/model_services.php');
$pageTitle = 'Services de la ville';
$services = getServices();
$view = './views/services-list.php';
require_once('./views/layout.php');