<?php

function getBills($userId){
    $db = dbConnect();

    $queryBills = $db->prepare('SELECT * FROM bills WHERE user_id = ?');
    $queryBills->execute(array($userId));
    return $queryBills->fetchAll();
}