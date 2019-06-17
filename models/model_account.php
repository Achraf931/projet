<?php
function getLastBill($userId)
{
    $db = dbConnect();

    $queryLastBill = $db->prepare('SELECT b.* 
    FROM bills b 
    JOIN users u 
    ON b.user_id = u.id
    WHERE b.user_id = ? ORDER BY id DESC LIMIT 1');
    $queryLastBill->execute(array($userId));
    return $lastBill = $queryLastBill->fetch();
}