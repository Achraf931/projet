<?php
require_once ('./tools/userVerif.php');

require_once('./models/model_services.php');
$pageTitle = 'Services de la ville';
$services = getServices();
$view = './views/services-list.php';
require_once('./views/layout.php');