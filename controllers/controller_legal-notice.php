<?php
require_once ('./tools/userVerif.php');

require_once('./models/model_legal-notice.php');
$pageTitle = 'Mention légale';
$notices = getNotices();
$view = './views/legal-notice.php';
require_once('./views/layout.php');