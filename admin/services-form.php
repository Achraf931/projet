<?php
require_once('tools/common.php');

$messages = [];
$name = null;
$schedule = null;
$address = null;
$lat = null;
$long = null;

if (isset($_POST['save'])) {
    $allowed_extensions = array('jpg', 'jpeg', 'png');
    $my_file_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

    if (empty($_POST['name'])) {
        $messages['name'] = 'Le nom est obligatoire !';
    }
    if (!isset($_FILES['image']) OR empty($_FILES['image'])) {
        $messages['image'] = 'L\'image est obligatoire !';
    }
    if (!empty($_FILES['image']) AND !in_array($my_file_extension, $allowed_extensions)) {
        $messages['imageExt'] = 'L\'extension est invalide !';
    }
    if (empty($_POST['schedule'])) {
        $messages['schedule'] = 'Le nom est obligatoire !';
    }
    if (empty($_POST['address'])) {
        $messages['address'] = 'Le nom est obligatoire !';
    }
    if (empty($_POST['lat'])) {
        $messages['lat'] = 'Le nom est obligatoire !';
    }
    if (empty($_POST['long'])) {
        $messages['long'] = 'Le nom est obligatoire !';
    }
    if (empty($messages)) {
        do {
            $new_file_name = rand();
            $destination = '../assets/img/services/' . $new_file_name . '.' . $my_file_extension;
        } while (file_exists($destination));

        $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);


        $queryInsert = $db->prepare('INSERT INTO services (name, image, schedule, address, lat, long) VALUES (?, ?, ?, ?, ?, ?)');
        $newService = $queryInsert->execute([
            $_POST['name'],
            $new_file_name . '.' . $my_file_extension,
            $_POST['schedule'],
            $_POST['address'],
            $_POST['lat'],
            $_POST['long']
        ]);

        //redirection après enregistrement
        //si $newArticle alors l'enregistrement a fonctionné
        if ($newService) {
            //redirection après enregistrement
            $_SESSION['message'] = 'Service ajouté !';
            header('location:services-list.php');
            exit;
        } else { //si pas $newArticle => enregistrement échoué => générer un message pour l'administrateur à afficher plus bas
            $_SESSION['message'] = "Impossible d'enregistrer le nouveau service...";
        }
    } else{
        $name = $_POST['name'];
        $schedule = $_POST['schedule'];
        $address = $_POST['address'];
        $lat = $_POST['lat'];
        $long = $_POST['long'];
    }
}


if (isset($_POST['update'])) {
    $selectImage = $db->prepare('SELECT image FROM services WHERE id = ?');
    $selectImage->execute([
        $_GET['service_id']
    ]);
    $recupImage = $selectImage->fetch();

    $allowed_extensions = array('jpg', 'jpeg', 'png');
    $my_file_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

    if (empty($_POST['name'])) {
        $messages['name'] = 'Le nom est obligatoire !';
    }
    if (!isset($_FILES['image']) OR empty($_FILES['image'])) {
        $messages['image'] = 'L\'image est obligatoire !';
    }
    if (isset($_POST['image']) AND !in_array($my_file_extension, $allowed_extensions)) {
        $messages['imageExt'] = 'L\'extension est invalide !';
    }
    if (empty($_POST['schedule'])) {
        $messages['schedule'] = 'Le nom est obligatoire !';
    }
    if (empty($_POST['address'])) {
        $messages['address'] = 'Le nom est obligatoire !';
    }
    if (empty($_POST['lat'])) {
        $messages['lat'] = 'Le nom est obligatoire !';
    }
    if (empty($_POST['long'])) {
        $messages['long'] = 'Le nom est obligatoire !';
    }
    if (empty($messages)) {
        $destination = '../assets/img/services/';
        unlink($destination . $recupImage['image']);
        do {
            $new_file_name = rand();
            $destination = '../assets/img/services/' . $new_file_name . '.' . $my_file_extension;
        } while (file_exists($destination));

        $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);

        $query = $db->prepare('UPDATE services SET
		name = :name,
		image = :image,
		schedule = :schedule,
		address = :address,
		lat = :lat,
		long = :long,
		WHERE id = :id');

        //mise à jour avec les données du formulaire
        $resultService = $query->execute([
            'name' => $_POST['name'],
            'image' => $new_file_name . '.' . $my_file_extension,
            'schedule' => $_POST['schedule'],
            'address' => $_POST['address'],
            'lat' => $_POST['lat'],
            'long' => $_POST['long'],
            'id' => $_POST['id']
        ]);

        //si enregistrement ok
        if ($resultService) {
            $_SESSION['message'] = 'Service mis à jour !';
            header('location:services-list.php');
        } else {
            $_SESSION['message'] = 'Erreur.';
        }
    }
}

//si on modifie un article, on doit séléctionner l'article en question (id envoyé dans URL) pour pré-remplir le formulaire plus bas
if (isset($_GET['service_id']) && isset($_GET['action']) && $_GET['action'] == 'edit') {

    $query = $db->prepare('SELECT * FROM services WHERE id = ?');
    $query->execute(array($_GET['service_id']));
    //$article contiendra les informations de l'article dont l'id a été envoyé en paramètre d'URL
    $service = $query->fetch();
}

if(isset($_GET['service_id']) AND $_GET['service_id'] !== $service['id']) {
    header('Location:services-list.php');
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
            <h4><?php if (isset($service)): ?>Modifier<?php else: ?>Ajouter<?php endif; ?> un service</h4>
            <?php if (isset($_GET['service_id'])): ?>
            <form action="services-form.php?service_id=<?= $service['id']; ?>&action=edit" method="post"
                  enctype="multipart/form-data">
                <?php else: ?>
                <form action="services-form.php" method="post" enctype="multipart/form-data">
                    <?php endif; ?>
                    <div class="form-group">
                        <label for="name">Nom :<span class="text-danger">*</span></label>
                        <input class="form-control" value="<?= isset($service) ? htmlentities($service['name']) : $name; ?>" type="text" placeholder="Nom" name="name" id="name">
                        <span style="color: red;"><?= isset($messages['name']) ? $messages['name'] : ''; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="image">Image :<span class="text-danger">*</span></label>
                        <input class="form-control" value="<?= isset($service) ? htmlentities($service['image']) : ''; ?>" type="file" name="image" id="image">
                        <?php if (isset($service['image']) AND !empty($service['image'])): ?>
                            <img style="width: 50%;" class="img-fluid py-4"
                                 src="../assets/img/services/<?= isset($service) ? $service['image'] : ''; ?>" alt="">
                        <?php endif; ?>
                        <span style="color: red;"><?= isset($messages['image']) ? $messages['image'] : ''; ?></span>
                        <span style="color: red;"><?= isset($messages['imageExt']) ? $messages['imageExt'] : ''; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="schedule">Horaires :<span class="text-danger">*</span></label>
                        <input class="form-control" value="<?= isset($service) ? htmlentities($service['schedule']) : $schedule; ?>" type="text" placeholder="Horaires" name="schedule" id="schedule">
                        <span style="color: red;"><?= isset($messages['schedule']) ? $messages['schedule'] : ''; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="address">Adresse :<span class="text-danger">*</span></label>
                        <input class="form-control" value="<?= isset($service) ? htmlentities($service['address']) : $address; ?>" type="text" placeholder="Adresse" name="address" id="address">
                        <span style="color: red;"><?= isset($messages['address']) ? $messages['address'] : ''; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="lat">Latitude :<span class="text-danger">*</span></label>
                        <input class="form-control" value="<?= isset($service) ? htmlentities($service['lat']) : $lat; ?>" type="text" placeholder="Latitude" name="lat" id="lat">
                        <span style="color: red;"><?= isset($messages['lat']) ? $messages['lat'] : ''; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="long">Longitude :<span class="text-danger">*</span></label>
                        <input class="form-control" value="<?= isset($service) ? htmlentities($service['long']) : $long; ?>" type="text" placeholder="Longitude" name="long" id="long">
                        <span style="color: red;"><?= isset($messages['long']) ? $messages['long'] : ''; ?></span>
                    </div>
                    <div class="text-right">
                        <!-- Si $article existe, on affiche un lien de mise à jour -->
                        <?php if (isset($service)): ?>
                            <input class="btn btn-success" type="submit" name="update" value="Mettre à jour">
                            <!-- Sinon on afficher un lien d'enregistrement d'un nouvel article -->
                        <?php else: ?>
                            <input class="btn btn-success" type="submit" name="save" value="Enregistrer">
                        <?php endif; ?>
                    </div>

                    <!-- Si $article existe, on ajoute un champ caché contenant l'id de l'article à modifier pour la requête UPDATE -->
                    <?php if (isset($service)): ?>
                        <input type="hidden" name="id" value="<?= $service['id']; ?>">
                    <?php endif; ?>


                </form>
        </div>
    </div>
</div>
<script src="../assets/js/jquery-3.3.1.min.js"></script>
<script src="../vendor/bootstrap-4.3.1/js/bootstrap.min.js"></script>
</body>
</html>