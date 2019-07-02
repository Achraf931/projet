<?php

require_once('../tools/common.php');

header("Access-Control-Allow-Origin: *");

$res = new stdClass();
$email = $_POST['email'];
$messages = [];

$recupEmail = $db->prepare('SELECT email FROM users WHERE email = ?');
$recupEmail->execute(array($email));
$emailRecup = $recupEmail->fetch();

if (empty($email)) {
    $messages['emailEmpty'] = 'L\'adresse mail est obligatoire !';
}
elseif (!empty($email) AND $emailRecup == false) {
    $messages['emailExist'] = 'L\'adresse mail n\'existe pas !';
}
if (!empty($email) AND !preg_match(" /^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/ ", $email)) {
    $messages['validEmail'] = "L'adresse email est invalide !";
}
if (empty($messages)){
    $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $password = '';
    for($i=0; $i < 10; $i++){
        $password .= $chars[rand(0, strlen($chars)-1)];
    }
    $queryPassword = $db->prepare('UPDATE users SET password = ? WHERE email = ?');
    $queryPassword->execute(array(htmlspecialchars(hash('md5', $password)), htmlspecialchars($email)));

    if ($queryPassword){
        $to = $email;
        $subject = "Votre mot de passe";
        $txt = 'Votre nouveau mot de passe est : ' . $password;
        $headers = "From: Mairie de Montreuil";
        mail($to,$subject,$txt,$headers);

        $messages['type'] = 1;
    }
}

echo json_encode($messages);