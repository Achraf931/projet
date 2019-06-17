<?php
/*try {
    $db = new PDO('mysql:host=localhost;dbname=town_hall;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $exception) {
    die('Erreur : ' . $exception->getMessage());
}

echo 'zeb';
$queryTest = $db->query('SELECT * FROM events WHERE is_published = 1 AND published_at = \'2019-04-22\'');
$fetch = $queryTest->fetchAll();

var_dump($fetch);
var_dump($queryTest);
die();
*/

header("Access-Control-Allow-Origin: *");
# Get JSON as a string
$data = file_get_contents('php://input');
# Get as an object
$data = json_decode($data);
if ($data->type == 'eventDate') {
    $dataTime = substr($data->date, 0, -14);
    getEvents($dataTime);
} elseif ($data->type == 'allEvents') {
    getEvents();
}

function getEvents($published = false, $limit = false)
{
    $res = new stdClass();
    $array = [];

    try {
        $db = new PDO('mysql:host=hamrounivcdb.mysql.db;dbname=hamrounivcdb;charset=utf8', 'hamrounivcdb', 'Achraf93', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (Exception $exception) {
        die('Erreur : ' . $exception->getMessage());
    }

    $queryString = 'SELECT * FROM events WHERE is_published = 1';

    if ($published) {
        $queryString .= ' AND published_at = \'' . $published . '\'';
    }
    if ($limit) {
        $queryString .= ' ORDER BY published_at DESC LIMIT ' . $limit;
    } else {
        $queryString .= ' ORDER BY published_at DESC';
    }
    $query = $db->query($queryString);
    $events = $query->fetchAll();

    for ($i = 0; $i < sizeof($events); $i++) {
        $array[$i] = [
            "title" => $events[$i]['title'],
            "published_at" => $events[$i]['published_at'],
            "summary" => $events[$i]['summary'],
            "id" => $events[$i]['id'],
            "image" => $events[$i]['image'],
        ];
    }
    $res->arrayDate = $array;
    if (empty($events)) {
        $res->msg = "Aucun événement a cette date !";
    }
    echo json_encode($res);
}

