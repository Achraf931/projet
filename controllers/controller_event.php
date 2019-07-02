<?php
require_once ('./tools/userVerif.php');

if(isset($_GET['event_id']) AND ctype_digit($_GET['event_id'])) {
    require_once ('./models/model_index.php');
    $event = getOneEvent($_GET['event_id']);
    if (!$event){
        header('Location:index.php');
        exit;
    }
    $pageTitle = getOneEvent($_GET['event_id'], true);
    $images = getImages($_GET['event_id']);
    $view = './views/event.php';
    require_once('./views/layout.php');
} else{
    header('location:index.php');
    exit;
}