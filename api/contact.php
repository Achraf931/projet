<?php

require_once('../tools/common.php');

header("Access-Control-Allow-Origin: *");

$res = new stdClass();
$id = $_POST['value'];

$queryContact = $db->prepare('SELECT * FROM second_choices WHERE choices_id = ?');
$queryContact->execute(array($id));
$contact = $queryContact->fetchAll();

$res->type = 1;
$res->secondChoice = $contact;

echo json_encode($res);