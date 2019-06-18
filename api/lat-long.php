<?php
header("Access-Control-Allow-Origin: *");

require_once('../tools/common.php');

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