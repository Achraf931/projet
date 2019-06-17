<?php
session_start();
try {
    $db = new PDO('mysql:host=hamrounivcdb.mysql.db;dbname=hamrounivcdb;charset=utf8', 'hamrounivcdb', 'Achraf93', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $exception) {
    die('Erreur : ' . $exception->getMessage());
}

if (!isset($_SESSION['user']) OR (isset($_SESSION['user']) AND $_SESSION['user']['admin'] == 0)){
    header('Location:../index.php');
    exit;
}