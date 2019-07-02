<?php
require_once('tools/common.php');

if(isset($_GET['second_choice_id']) && isset($_GET['action']) && $_GET['action'] == 'delete'){

    $query = $db->prepare('DELETE FROM second_choices WHERE id = ?');
    $result = $query->execute([
        $_GET['second_choice_id']
    ]);

    if($result){
        $_SESSION['message'] = 'Suppression efféctuée !';
    }
    else{
        $_SESSION['message'] = "Impossible de supprimer la séléction !";
    }
}
$query = $db->query('SELECT * FROM second_choices ORDER BY id DESC');
$secondChoices = $query->fetchall();
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
            <div class="card-header"><i class="fal fa-th-list"></i> Liste des seconds choix de contact
                <a class="btn btn-primary float-right" href="second-choices-form.php">Ajouter un deuxième choix de contact</a>
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
                            <th>Liaison</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if ($secondChoices): ?>
                            <?php foreach ($secondChoices as $secondChoice): ?>
                                <tr>
                                    <td><?= htmlentities($secondChoice['id']); ?></td>
                                    <td><?= htmlentities($secondChoice['choice']); ?></td>
                                    <td><?= htmlentities($secondChoice['choices_id']); ?></td>
                                    <td class="d-flex justify-content-center">
                                        <a href="second-choices-form.php?second_choice_id=<?= $secondChoice['id']; ?>&action=edit" class="btn btn-warning mr-2">Modifier</a>
                                        <a href="second-choices-list.php?second_choice_id=<?= $secondChoice['id']; ?>&action=delete" class="btn btn-danger">Supprimer</a>
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