<?php
try {
    $db = new PDO('mysql:host=localhost;dbname=hamrounivcdb;charset=utf8', 'roott', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $exception) {
    die('Erreur : ' . $exception->getMessage());
}