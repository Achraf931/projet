<?php
if (isset($_SESSION['user']) AND $_SESSION['user']['verif'] == 0){
    header('Location:index.php?page=verification');
    exit;
}
require_once('./models/model_faq.php');
$pageTitle = 'FAQ';
$cat = getCat();
$questions = getFaq();
$view = './views/faq.php';
require_once('./views/layout.php');