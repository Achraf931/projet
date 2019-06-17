<?php
require_once('tools/common.php');

if(isset($_GET['user_id']) && isset($_GET['action']) && $_GET['action'] == 'delete'){

    $selectBills = $db->prepare('SELECT * FROM bills WHERE user_id = ?');
    $selectBills->execute([
        $_GET['user_id']
    ]);
    $recupBills = $selectBills->fetchAll();


    if ($recupBills){
        foreach ($recupBills as $bill) {
            $pathDelete = '../assets/bills/';
            unlink($pathDelete . $bill['bill']);
        }
    }

    $query = $db->prepare('DELETE FROM bills WHERE user_id = ?');
    $result = $query->execute([
        $_GET['user_id']
    ]);

    $query = $db->prepare('DELETE FROM users WHERE id = ?');
    $result = $query->execute([
        $_GET['user_id']
    ]);

    if($result){
        $_SESSION['message'] = 'Suppression efféctuée !';
    }
    else{
        $_SESSION['message'] = "Impossible de supprimer la séléction !";
    }
}
//séléctionner tous les articles pour affichage de la liste
$query = $db->query('SELECT * FROM users ORDER BY id DESC');
$users = $query->fetchall();
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
            <div class="card-header"><i class="fas fa-fw fa-user"></i> Liste des utilisateurs
                <a class="btn btn-primary float-right" href="users-form.php">Ajouter un utilisateur</a>
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
                            <th>Prénom</th>
                            <th>Date de naissance</th>
                            <th>Adresse</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Admin</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if ($users): ?>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td><?= htmlentities($user['id']); ?></td>
                                    <td><?= htmlentities($user['name']); ?></td>
                                    <td><?= htmlentities($user['firstname']); ?></td>
                                    <td><?= htmlentities($user['birthdate']); ?></td>
                                    <td><?= htmlentities($user['address']); ?></td>
                                    <td><?= htmlentities($user['email']); ?></td>
                                    <td><?= htmlentities($user['mobile']); ?></td>
                                    <td><?= htmlentities($user['admin']); ?></td>
                                    <td class="d-flex justify-content-center">
                                        <a href="users-form.php?user_id=<?= $user['id']; ?>&action=edit"
                                           class="btn btn-warning mr-2">Modifier</a>
                                        <a href="users-list.php?user_id=<?= $user['id']; ?>&action=delete"
                                           class="btn btn-danger">Supprimer</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            Aucun utilisateur enregistré.
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
