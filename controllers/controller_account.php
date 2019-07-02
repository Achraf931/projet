<?php
require_once ('./tools/userVerif.php');

if (isset($_SESSION['user'])) {
    require_once('./models/model_account.php');
    require_once('./models/model_profile.php');
    $pageTitle = 'Mon compte';
    $lastBill = getLastBill($_SESSION['user']['id']);
    $userInfos = getInfosUser($_SESSION['user']['id']);
    $view = './views/account.php';
    require_once('./views/layout.php');
} else {
    header('Location:index.php');
    exit;
}