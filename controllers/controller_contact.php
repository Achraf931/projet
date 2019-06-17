<?php
require_once('./models/model_contact.php');
require_once('./models/model_profile.php');
if (isset($_SESSION['user'])){
    $infoUser = getInfosUser($_SESSION['user']['id']);
}
$firstChoices = getFirstChoices();
$secondChoices = getSecondChoices();
$pageTitle = 'Contact';
$view = './views/contact.php';
require_once('./views/layout.php');