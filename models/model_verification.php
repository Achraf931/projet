<?php
function sendVerif($verif){
    $db = dbConnect();

    if (isset($verif)) {
        $queryVerif = $db->prepare('UPDATE users SET verif = ? WHERE id = ?');
        $queryVerif->execute(array($verif, $_SESSION['user']['id']));

        if ($queryVerif){
            $_SESSION['user']['verif'] = 1;
            header('location:index.php');
            exit;
        }
    }
}

function sendVerifAndContact($verif){
    $db = dbConnect();

    if (isset($verif)) {
        $queryVerif = $db->prepare('UPDATE users SET verif = ? WHERE id = ?');
        $queryVerif->execute(array($verif, $_SESSION['user']['id']));

        if ($queryVerif){
            $_SESSION['user']['verif'] = 1;
            header('location:index.php?page=contact');
            exit;
        }
    }
}