<?php
function dbConnect(){
    setlocale(LC_ALL, "fr_FR");
    try {
        return $db = new PDO('mysql:host=hamrounivcdb.mysql.db;dbname=hamrounivcdb;charset=utf8', 'hamrounivcdb', 'Achraf93', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (Exception $exception) {
        die('Erreur : ' . $exception->getMessage());
    }
}

$db = dbConnect();
session_start();

if (isset($_GET['logout']) && isset($_SESSION['user'])) {
    unset($_SESSION['user']);
    header('Location:index.php');
}

if (isset($_GET['page'])) {
    switch ($_GET['page']) {
        case 'events-list':
            require('./controllers/controller_events-list.php');
            break;

        case 'events':
            require('./controllers/controller_event.php');
            break;

        case 'contact':
            require('./controllers/controller_contact.php');
            break;

        case 'legal-notice':
            require('./controllers/controller_legal-notice.php');
            break;

        case 'faq':
            require('./controllers/controller_faq.php');
            break;

        case 'bills':
            require('./controllers/controller_bills.php');
            break;

        case 'account':
            require('./controllers/controller_account.php');
            break;

        case 'profile':
            require('./controllers/controller_profile.php');
            break;

        case 'services':
            require('./controllers/controller_services.php');
            break;

        case 'payments':
            require('./controllers/controller_payments.php');
            break;

        case 'verification':
            require('./controllers/controller_verification.php');
            break;

        default:
            header('Location:index.php');
            exit;
            break;
    }
} else {
    require('./controllers/controller_index.php');
}