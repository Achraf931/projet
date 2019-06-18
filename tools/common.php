<?php
try {
    $db = new PDO('mysql:host=hamrounivcdb.mysql.db;dbname=hamrounivcdb;charset=utf8', 'hamrounivcdb', 'Achraf93', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $exception) {
    die('Erreur : ' . $exception->getMessage());
}