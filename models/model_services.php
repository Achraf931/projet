<?php

function getServices(){
    $db = dbConnect();

    $queryServices = $db->query('SELECT * FROM services');
    return $queryServices->fetchAll();
}