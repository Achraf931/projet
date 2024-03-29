<?php

require_once('../tools/common.php');

header("Access-Control-Allow-Origin: *");

//$res = new stdClass();
$choiceOne = $_POST['choiceOne'];
$choiceTwo = $_POST['choiceTwo'];
$name = $_POST['name'];
$firstname = $_POST['firstname'];
$email = $_POST['emailMess'];
$mobile = $_POST['mobile'];
$message = $_POST['message'];
$messages = [];

if (empty($name)) {
    $messages['name'] = 'Le nom est obligatoire !';
}
if (empty($firstname)) {
    $messages['firstname'] = 'Le prénom est obligatoire !';
}
if (empty($email)) {
    $messages['emailMess'] = 'L\'email est obligatoire !';
}
if (empty($message)) {
    $messages['message'] = 'Le message est obligatoire !';
}
if (isset($choiceOne) AND $choiceOne == 'Choisissez...') {
    $messages['choiceOne'] = 'Le premier choix est obligatoire !';
}
if (!empty($choiceOne) AND $choiceOne != 'Choisissez...') {
    if (isset($choiceTwo) AND $choiceTwo == 'Choisissez...') {
        $messages['choiceTwo'] = 'Le deuxième choix est obligatoire !';
    }
}
if (!empty($email) AND !preg_match(" /^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/ ", $email)) {
        $messages['validEmail'] = "L'adresse email est invalide !";
}
if (empty($messages)) {
    $queryInsert = $db->prepare('INSERT INTO messages (name, firstname, email, mobile, message, first_choice_id, second_choice_id, send_at) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())');
    $sendValues = $queryInsert->execute([
        htmlspecialchars($name),
        htmlspecialchars($firstname),
        htmlspecialchars($email),
        htmlspecialchars($mobile),
        htmlspecialchars($message),
        $choiceOne,
        $choiceTwo
    ]);

    if ($sendValues){
        $to = 'hamrouni.pro@outlook.fr';
        $subject = "Message de " . $name . ' ' . $firstname;
        $txt = "Nom : " . $name . "\r\n";
        $txt .= "Prénom : " . $firstname . "\r\n";
        $txt .= "Adresse mail : " . $email . "\r\n";
        $txt .= "Numéro : " . $mobile . "\r\n";
        $txt .= "Message : " . $message;
        $headers = "From: " . $email . "\r\n" .
            "Cc: " . $email . "\r\n";
        $headers .='Content-Type: text/plain; charset="utf-8"'." ";
        $headers .='Content-Transfer-Encoding: 8bit';

        mail($to,$subject,$txt,$headers);

        $messages['type'] = 1;
    } else {
        $messages['type'] = 0;
    }
}
echo json_encode($messages);