<?php
header("Access-Control-Allow-Origin: *");

try {
    $db = new PDO('mysql:host=localhost;dbname=town_hall;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $exception) {
    die('Erreur : ' . $exception->getMessage());
}

# Get JSON as a string
$data = file_get_contents('php://input');
# Get as an object
$data = json_decode($data);
$res = new stdClass();

$lat = $data->lat;
$long = $data->long;

$query = $db->query('SELECT * FROM services');
$service = $query->fetch();
$res->type = 1;
echo json_encode($res);