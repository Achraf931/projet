<?php
if (isset($_SESSION['user']['verif']) AND $_SESSION['user']['verif'] == 0) {
    require_once('./models/model_profile.php');
    require_once('./models/model_verification.php');
    $pageTitle = 'Vérification';
    if (isset($_POST['sendVerif']) OR isset($_POST['sendVerifContact'])) {
        sendVerif($_POST['sendVerif']);
        sendVerifAndContact($_POST['sendVerifContact']);
    }
    $userInfos = getInfosUser($_SESSION['user']['id']);
    $view = './views/verification.php';
    require_once('./views/layout.php');
} else {
    header('Location:index.php');
    exit;
}