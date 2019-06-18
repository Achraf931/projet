<?php
header("Access-Control-Allow-Origin: *");

try {
    $db = new PDO('mysql:host=localhost;dbname=town_hall;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $exception) {
    die('Erreur : ' . $exception->getMessage());
}

# Get JSON as a string
$data = file_get_contents('php://input');
# Get as an object
$data = json_decode($data);
$res = new stdClass();

$email = $data->email;
$password = $data->password;
if (empty($email) AND empty($password)) {
    $res->loginError = "Merci de remplir tous les champs !";
} elseif (empty($email)){
    $res->loginError = "L'email doit être rempli !";
} elseif (empty($password)){
    $res->loginError = "Le mot de passe doit être rempli !";
} else {
    $query = $db->prepare('SELECT * FROM users WHERE email = ? AND password = ?');
    $query->execute(array($email, hash('md5', $password)));
    $user = $query->fetch();
    if ($user) {
        session_start();
        $_SESSION['user']['admin'] = $user['admin'];
        $_SESSION['user']['firstname'] = $user['firstname'];
        $_SESSION['user']['verif'] = $user['verif'];
        $_SESSION['user']['id'] = $user['id'];
        $res->session = $_SESSION['user'];
        $res->type = $_SESSION['user']['verif'];
    } else {
        $res->loginError = "Mauvais identifiants";
    }
}
echo json_encode($res);