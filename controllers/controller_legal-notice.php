<?php
if (isset($_SESSION['user']) AND $_SESSION['user']['verif'] == 0){
    header('Location:index.php?page=verification');
    exit;
}
require_once('./models/model_legal-notice.php');
$pageTitle = 'Mention légale';
$notices = getNotices();
$view = './views/legal-notice.php';
require_once('./views/layout.php');