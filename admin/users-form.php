<?php
require_once('tools/common.php');

$messages = [];
$name = null;
$firstname = null;
$birthdate = null;
$address = null;
$city = null;
$zipcode = null;
$email = null;
$number = null;

$verifEmail = $db->prepare('SELECT email FROM users WHERE email = ?');
$verifEmail->execute(array($_POST['email']));
$resultMail = $verifEmail->fetch();

if (isset($_POST['save'])) {
    if (empty($_POST['name'])) {
        $messages['name'] = 'Le nom est obligatoire !';
    }
    if (empty($_POST['firstname'])) {
        $messages['firstname'] = 'Le prénom est obligatoire !';
    }
    if (empty($_POST['birthdate'])) {
        $messages['birthdate'] = 'La date de naissance est obligatoire !';
    }
    if (empty($_POST['address'])) {
        $messages['address'] = 'L\'adresse postale est obligatoire !';
    }
    if (empty($_POST['city'])) {
        $messages['city'] = 'La ville est obligatoire !';
    }
    if (empty($_POST['zipcode'])) {
        $messages['zipcode'] = 'Le code postal est obligatoire !';
    }
    if ( !preg_match ( " /^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/ " , $_POST['email'] ) ) {
        $messages['validEmail'] = "L'adresse email est invalide !";
    }
    if (empty($_POST['email'])) {
        $messages['email'] = 'L\'adresse email est obligatoire !';
    }
    if ($resultMail['email'] == true){
        $messages['emailExist'] = 'l\'adresse email est déjà existante !';
    }
    if (empty($messages)) {
        $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $password = '';
        for($i=0; $i < 10; $i++){
            $password .= $chars[rand(0, strlen($chars)-1)];
        }

        $queryInsert = $db->prepare('INSERT INTO users (name, firstname, birthdate, address, city, zipcode, mobile, email, admin, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $newUser = $queryInsert->execute([
            $_POST['name'],
            $_POST['firstname'],
            $_POST['birthdate'],
            $_POST['address'],
            $_POST['city'],
            $_POST['zipcode'],
            $_POST['mobile'],
            $_POST['email'],
            $_POST['admin'],
            hash('md5', $password)
        ]);
        //redirection après enregistrement
        //si $newArticle alors l'enregistrement a fonctionné
        if ($newUser) {
            $to = $_POST['email'];
            $subject = "Votre mot de passe";
            $txt = 'Votre mot de passe est : ' . $password;
            $headers = "From: Mairie de Montreuil" . "\r\n" .
                "CC: hamrouni.pro@outlook.fr";

            mail($to,$subject,$txt,$headers);


            $_SESSION['message'] = 'Utilisateur ajouté !';
            header('location:users-list.php');
            exit;
        } else { //si pas $newArticle => enregistrement échoué => générer un message pour l'administrateur à afficher plus bas
            $message = "Impossible d'enregistrer le nouvel utilisateur...";
        }
    } else{
        $name = $_POST['name'];
        $firstname = $_POST['firstname'];
        $birthdate = $_POST['birthdate'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $zipcode = $_POST['zipcode'];
        $email = $_POST['email'];
        $number = $_POST['mobile'];
    }
}


if (isset($_POST['update'])) {
    if (empty($_POST['name'])) {
        $messages['name'] = 'Le nom est obligatoire !';
    }
    if (empty($_POST['firstname'])) {
        $messages['firstname'] = 'Le prénom est obligatoire !';
    }
    if (empty($_POST['address'])) {
        $messages['address'] = 'L\'adresse postale est obligatoire !';
    }
    if (empty($_POST['city'])) {
        $messages['city'] = 'La ville est obligatoire !';
    }
    if (empty($_POST['zipcode'])) {
        $messages['zipcode'] = 'Le code postal est obligatoire !';
    }
    if ( !preg_match ( " /^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/ " , $_POST['email'] ) )
    {
        $messages['validEmail'] = "L'adresse email est invalide !";
    }
    if (empty($_POST['email'])) {
        $messages['email'] = 'L\'adresse email est obligatoire !';
    }
    if ($resultMail['email'] == true){
        $messages['emailExist'] = 'l\'adresse email est déjà existante !';
    }
    if (empty($messages)) {
        $query = $db->prepare('UPDATE users SET
		name = :name,
		firstname = :firstname,
		birthdate = :birthdate,
		address = :address,
		email = :email,
		mobile = :mobile,
		admin = :admin
		WHERE id = :id');

        //mise à jour avec les données du formulaire
        $resultUser = $query->execute([
            'name' => $_POST['name'],
            'firstname' => $_POST['firstname'],
            'birthdate' => $_POST['birthdate'],
            'address' => $_POST['address'],
            'email' => $_POST['email'],
            'mobile' => $_POST['mobile'],
            'admin' => $_POST['admin'],
            'id' => $_POST['id']
        ]);

        //si enregistrement ok
        if ($resultUser) {
            $_SESSION['message'] = 'Utilisateur mis à jour !';
            header('location:users-list.php');
            exit;
        } else {
            $_SESSION['message'] = 'Erreur.';
        }
    }
}

//si on modifie un article, on doit séléctionner l'article en question (id envoyé dans URL) pour pré-remplir le formulaire plus bas
if (isset($_GET['user_id']) && isset($_GET['action']) && $_GET['action'] == 'edit') {

    $query = $db->prepare('SELECT * FROM users WHERE id = ?');
    $query->execute(array($_GET['user_id']));
    //$article contiendra les informations de l'article dont l'id a été envoyé en paramètre d'URL
    $user = $query->fetch();
}

if(isset($_GET['user_id']) AND $_GET['user_id'] !== $user['id']) {
    header('Location:users-list.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Back-Office</title>
    <link href="../assets/css/fa-5.5.0-web/css/all.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../vendor/bootstrap-4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
<div class="row m-0 justify-content-between sizeMax">
    <!-- Sidebar -->
    <?php require_once('partials/nav.php'); ?>

    <div class="container-fluid col-xl-9 mt-3">
        <div class="card-body">
            <h4><?php if (isset($user)): ?>Modifier<?php else: ?>Ajouter<?php endif; ?> un utilisateur</h4>
            <?php if (isset($_GET['user_id'])): ?>
            <form action="users-form.php?user_id=<?= $user['id']; ?>&action=edit" method="post"
                  enctype="multipart/form-data">
                <?php else: ?>
                <form action="users-form.php" method="post" enctype="multipart/form-data">
                    <?php endif; ?>
                    <div class="form-group">
                        <label for="name">Nom :<span class="text-danger">*</span></label>
                        <input class="form-control" value="<?= isset($user) ? htmlentities($user['name']) : $name; ?>" type="text" placeholder="Nom" name="name" id="name"/>
                        <span style="color: red;"><?= isset($messages['name']) ? $messages['name'] : ''; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="firstname">Prénom :<span class="text-danger">*</span></label>
                        <input class="form-control" value="<?= isset($user) ? htmlentities($user['firstname']) : $firstname; ?>" type="text" placeholder="Prénom" name="firstname" id="firstname"/>
                        <span style="color: red;"><?= isset($messages['firstname']) ? $messages['firstname'] : ''; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="birthdate">Date de naissance :<span class="text-danger">*</span></label>
                        <input class="form-control" value="<?= isset($user) ? htmlentities($user['birthdate']) : $birthdate; ?>" type="date" placeholder="Date de naissance" name="birthdate" id="birthdate"/>
                        <span style="color: red;"><?= isset($messages['birthdate']) ? $messages['birthdate'] : ''; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="address">Adresse :<span class="text-danger">*</span></label>
                        <input class="form-control" value="<?= isset($user) ? htmlentities($user['address']) : $address; ?>" type="text" placeholder="Adresse postale" name="address" id="address"/>
                        <span style="color: red;"><?= isset($messages['address']) ? $messages['address'] : ''; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="city">Ville :<span class="text-danger">*</span></label>
                        <input class="form-control" value="<?= isset($user) ? htmlentities($user['city']) : $city; ?>" type="text" placeholder="Ville" name="city" id="city"/>
                        <span style="color: red;"><?= isset($messages['city']) ? $messages['city'] : ''; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="zipcode">Code postal :<span class="text-danger">*</span></label>
                        <input class="form-control" value="<?= isset($user) ? htmlentities($user['zipcode']) : $zipcode; ?>" type="number" placeholder="Code postal" name="zipcode" id="zipcode"/>
                        <span style="color: red;"><?= isset($messages['zipcode']) ? $messages['zipcode'] : ''; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="email">Email :<span class="text-danger">*</span></label>
                        <input class="form-control" value="<?= isset($user) ? htmlentities($user['email']) : $email; ?>" type="email" placeholder="Adresse email" name="email" id="email"/>
                        <span style="color: red;"><?= isset($messages['email']) ? $messages['email'] : ''; ?></span>
                        <span style="color: red;"><?= isset($messages['validEmail']) ? $messages['validEmail'] : ''; ?></span>
                        <span style="color: red;"><?= isset($messages['emailExist']) ? $messages['emailExist'] : ''; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="mobile">Numéro de téléphone :</label>
                        <input class="form-control" value="<?= isset($user) ? htmlentities($user['mobile']) : $number; ?>" type="number" placeholder="Numéro de téléphone" name="mobile" id="mobile"/>
                    </div>
                        <input type="hidden" name="password"/>
                    <div class="form-group">
                        <label for="admin">Admin ?</label>
                        <select class="form-control" name="admin" id="admin">
                            <option value="0" <?= isset($user) && $user['admin'] == 0 ? 'selected' : ''; ?>>Non</option>
                            <option value="1" <?= isset($user) && $user['admin'] == 1 ? 'selected' : ''; ?>>Oui</option>
                        </select>
                    </div>

                    <div class="text-right">
                        <!-- Si $article existe, on affiche un lien de mise à jour -->
                        <?php if (isset($user)): ?>
                            <input class="btn btn-success" type="submit" name="update" value="Mettre à jour"/>
                            <!-- Sinon on afficher un lien d'enregistrement d'un nouvel article -->
                        <?php else: ?>
                            <input class="btn btn-success" type="submit" name="save" value="Enregistrer"/>
                        <?php endif; ?>
                    </div>

                    <!-- Si $article existe, on ajoute un champ caché contenant l'id de l'article à modifier pour la requête UPDATE -->
                    <?php if (isset($user)): ?>
                        <input type="hidden" name="id" value="<?= $user['id']; ?>"/>
                    <?php endif; ?>


                </form>
        </div>
    </div>
</div>
<script src="../assets/js/jquery-3.3.1.min.js"></script>
<script src="../vendor/bootstrap-4.3.1/js/bootstrap.min.js"></script>
</body>
</html>