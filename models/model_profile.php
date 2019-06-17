<?php
function getInfosUser($user){
    $db = dbConnect();

    $queryUser = $db->prepare('SELECT * FROM users WHERE id = ?');
    $queryUser->execute(array($user));
    return $userInfos = $queryUser->fetch();
}