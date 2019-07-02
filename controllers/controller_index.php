<?php
require_once ('./tools/userVerif.php');

require_once('./models/model_index.php');
$pageTitle = 'Accueil';
$infos = getInfos();
$events = getEvents(3);
$view = './views/index.php';
require_once('./views/layout.php');