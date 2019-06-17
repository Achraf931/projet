<?php
function getFirstChoices(){
    $db = dbConnect();

    $queryFirst = $db->query('SELECT * FROM choices');
    return $queryFirst->fetchAll();
}

function getSecondChoices(){
    $db = dbConnect();

    $querySecond = $db->query('SELECT * FROM second_choices');
    return $querySecond->fetchAll();
}