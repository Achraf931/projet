<?php
require_once('tools/common.php');

if (isset($_GET['service_id']) && isset($_GET['action']) && $_GET['action'] == 'delete') {
    $selectImage = $db->prepare('SELECT image FROM services WHERE id = ?');
    $selectImage->execute([
        $_GET['service_id']
    ]);
    $recupImage = $selectImage->fetch();

    $query = $db->prepare('DELETE FROM services WHERE id = ?');
    $result = $query->execute([
        $_GET['service_id']
    ]);

    $pathDelete = '../assets/img/services/';

    unlink($pathDelete . $recupImage['image']);

    if ($result) {
        $_SESSION['message'] = 'Suppression efféctuée !';
    } else {
        $_SESSION['message'] = "Impossible de supprimer la séléction !";
    }
}
$query = $db->query('SELECT * FROM services ORDER BY id DESC');
$services = $query->fetchall();
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
    <?php require_once('partials/nav.php'); ?>

    <div class="container-fluid col-xl-9 mt-3">
        <div class="card mb-3 justify-content-center">
            <div class="card-header"><i class="fas fa-server"></i> Liste des services
                <a class="btn btn-primary float-right" href="services-form.php">Ajouter un service</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <?php if(isset($_SESSION['message'])): ?>
                        <div class="bg-success text-white p-2 mb-4">
                            <?= $_SESSION['message']; ?>
                            <?php unset($_SESSION['message']); ?>
                        </div>
                    <?php endif; ?>
                    <table class="table table-bordered text-center" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom</th>
                            <th>Horaires</th>
                            <th>Adresse</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if ($services): ?>
                            <?php foreach ($services as $service): ?>
                                <tr>
                                    <td><?= htmlentities($service['id']); ?></td>
                                    <td><?= htmlentities($service['name']); ?></td>
                                    <td><?= htmlentities($service['schedule']); ?></td>
                                    <td><?= htmlentities($service['address']); ?></td>
                                    <td><?= htmlentities($service['lat']); ?></td>
                                    <td><?= htmlentities($service['long']); ?></td>
                                    <td class="d-flex justify-content-center">
                                        <a href="services-form.php?service_id=<?= $service['id']; ?>&action=edit"
                                           class="btn btn-warning mr-2">Modifier</a>
                                        <a href="services-list.php?service_id=<?= $service['id']; ?>&action=delete"
                                           class="btn btn-danger">Supprimer</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            Aucun élément enregistré.
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="../assets/js/jquery-3.3.1.min.js"></script>
<script src="../vendor/bootstrap-4.3.1/js/bootstrap.min.js"></script>
</body>
</html>