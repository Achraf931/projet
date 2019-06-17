<?php

function getBills($userId){
    $db = dbConnect();

    $queryBills = $db->prepare('SELECT b.* 
    FROM bills b 
    JOIN users u 
    ON b.user_id = u.id
    WHERE b.user_id = ?');
    $queryBills->execute(array($userId));
    return $queryBills->fetchAll();
}