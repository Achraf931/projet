<?php
function getInfos(){
    $db = dbConnect();

    $queryInfos = $db->query('SELECT * FROM infos');
    return $queryInfos->fetch();
}
function getEvents($limit = false){
    $db = dbConnect();

    $queryString = 'SELECT title, published_at, summary, id, image FROM events WHERE published_at AND is_published = 1 ';

    if ($limit){
        $queryString .= ' ORDER BY published_at DESC LIMIT ' . $limit;
    }

    else{
        $queryString .= ' ORDER BY published_at DESC ';
    }

    $query = $db->query($queryString);
    return  $homeArticles=$query->fetchAll();
}

function getOneEvent($eventId, $title = false){
    $db = dbConnect();

    if ($title){
        $event = $db->prepare('SELECT title FROM events WHERE id = ? AND published_at AND is_published = 1');
        $event->execute(array($eventId));

        return $event->fetchColumn();
    } else{
        $event = $db->prepare('SELECT title, published_at, content, id, image, video FROM events WHERE id = ? AND published_at AND is_published = 1');
        $event->execute(array($eventId));
        return $event->fetch();
    }
}

function getImages($eventId){
    $db = dbConnect();

    $queryImages = $db->prepare('SELECT name FROM images WHERE event_id = ?');
    $queryImages->execute(array($eventId));
    return $queryImages->fetchAll();
}