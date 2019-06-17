<?php
if (isset($_SESSION['user']) AND $_SESSION['user']['verif'] == 0){
    header('Location:index.php?page=verification');
    exit;
}
$pageTitle = 'Liste des événements';
$view = './views/events-list.php';
require_once('./views/layout.php');