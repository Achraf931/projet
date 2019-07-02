<?php
require_once ('./tools/userVerif.php');

require_once('./models/model_faq.php');
$pageTitle = 'FAQ';
$cat = getCat();
$questions = getFaq();
$view = './views/faq.php';
require_once('./views/layout.php');