<?php
require_once('tools/common.php');

//supprimer l'article dont l'ID est envoyé en paramètre URL
if (isset($_GET['event_id']) && isset($_GET['action']) && $_GET['action'] == 'delete') {
    $selectImage = $db->prepare('SELECT image FROM events WHERE id = ?');
    $selectImage->execute([
        $_GET['event_id']
    ]);
    $recupImage = $selectImage->fetch();

    $query = $db->prepare('DELETE FROM events WHERE id = ?');
    $result = $query->execute([
        $_GET['event_id']
    ]);

    $pathDelete = '../assets/img/events/';

    unlink($pathDelete . $recupImage['image']);

    //générer un message à afficher pour l'administrateur
    if ($result) {
        $_SESSION['message'] = 'Suppression efféctuée !';
    } else {
        $_SESSION['message'] = "Impossible de supprimer la séléction !";
    }
}
//séléctionner tous les articles pour affichage de la liste
$query = $db->query('SELECT * FROM events ORDER BY id DESC');
$events = $query->fetchall();
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
        <div class="card mb-3 justify-content-center">
            <div class="card-header"><i class="fas fa-fw fa-newspaper"></i> Liste des événements
                <a class="btn btn-primary float-right" href="events-form.php">Ajouter un événement</a>
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
                            <th>Titre</th>
                            <th>Résumé</th>
                            <th>Date de publication</th>
                            <th>Publié</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if ($events): ?>
                            <?php foreach ($events as $event): ?>
                                <tr>
                                    <td><?= htmlentities($event['id']); ?></td>
                                    <td><?= htmlentities($event['title']); ?></td>
                                    <td><?= htmlentities($event['summary']); ?></td>
                                    <td><?= htmlentities($event['published_at']); ?></td>
                                    <td><?= htmlentities($event['is_published']); ?></td>
                                    <td class="d-flex justify-content-center">
                                        <a href="events-form.php?event_id=<?= $event['id']; ?>&action=edit"
                                           class="btn btn-warning mr-2">Modifier</a>
                                        <a href="events-list.php?event_id=<?= $event['id']; ?>&action=delete"
                                           class="btn btn-danger">Supprimer</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            Aucun événement enregistré.
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
