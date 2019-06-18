<?php

try {
    $db = new PDO('mysql:host=localhost;dbname=town_hall;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $exception) {
    die('Erreur : ' . $exception->getMessage());
}

header("Access-Control-Allow-Origin: *");

$res = new stdClass();
$id = $_POST['value'];

$queryContact = $db->prepare('SELECT * FROM second_choices WHERE choices_id = ?');
$queryContact->execute(array($id));
$contact = $queryContact->fetchAll();

$res->type = 1;
$res->secondChoice = $contact;

echo json_encode($res);