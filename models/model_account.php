<?php
function getLastBill($userId)
{
    $db = dbConnect();

    $queryLastBill = $db->prepare('SELECT * FROM bills WHERE user_id = ? ORDER BY id DESC LIMIT 1');
    $queryLastBill->execute(array($userId));
    return $lastBill = $queryLastBill->fetch();
}