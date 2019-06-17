<?php

function getNotices(){
    $db = dbConnect();

    $queryNotices = $db->query('SELECT title, content FROM notices');
    return $queryNotices->fetchAll();
}