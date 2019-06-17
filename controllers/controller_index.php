<?php
if (isset($_SESSION['user']) AND $_SESSION['user']['verif'] == 0){
    header('Location:index.php?page=verification');
    exit;
}
require_once('./models/model_index.php');
$pageTitle = 'Accueil';
$infos = getInfos();
$events = getEvents(3);
$view = './views/index.php';
require_once('./views/layout.php');