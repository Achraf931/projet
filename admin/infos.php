<?php
require_once('tools/common.php');

if(isset($_GET['info_id']) && isset($_GET['action']) && $_GET['action'] == 'delete'){
    $query = $db->prepare('DELETE FROM infos WHERE id = ?');
    $result = $query->execute([
        $_GET['info_id']
    ]);

    if($result){
        $_SESSION['message'] = 'Suppression efféctuée !';
    }
    else{
        $_SESSION['message'] = "Impossible de supprimer la séléction !";
    }
}
//séléctionner tous les articles pour affichage de la liste
$query = $db->query('SELECT * FROM infos ORDER BY id DESC');
$infos = $query->fetchall();
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
            <div class="card-header"><i class="fas fa-info-circle"></i> Liste des infos
                <a class="btn btn-primary float-right" href="infos-form.php">Ajouter des infos</a>
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
                            <th>Contenu</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if ($infos): ?>
                            <?php foreach ($infos as $info): ?>
                                <tr>
                                    <td><?= htmlentities($info['id']); ?></td>
                                    <td><?= htmlentities($info['title']); ?></td>
                                    <td><?= htmlentities($info['content']); ?></td>
                                    <td class="d-flex justify-content-center">
                                        <a href="infos-form.php?info_id=<?= $info['id']; ?>&action=edit"
                                           class="btn btn-warning mr-2">Modifier</a>
                                        <a href="infos.php?info_id=<?= $info['id']; ?>&action=delete"
                                           class="btn btn-danger">Supprimer</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            Aucune infos enregistré.
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