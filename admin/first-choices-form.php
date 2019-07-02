<?php
require_once('tools/common.php');

$messages = [];
$content = null;

if (isset($_POST['save'])) {
    if (empty($_POST['content'])) {
        $messages['content'] = 'Le titre est obligatoire !';
    }
    if (empty($messages)) {
        $queryInsert = $db->prepare('INSERT INTO choices (content) VALUES (?)');
        $newFirstChoice = $queryInsert->execute([
            htmlspecialchars($_POST['content'])
        ]);

        if ($newFirstChoice) {
            $_SESSION['message'] = 'Premier choix ajouté !';
            header('location:first-choices-list.php');
            exit;
        } else {
            $_SESSION['message'] = "Impossible d'enregistrer le nouveau choix...";
        }
    } else{
        $content = $_POST['content'];
    }
}


if (isset($_POST['update'])) {
    if (empty($_POST['content'])) {
        $messages['content'] = 'Le titre est obligatoire !';
    }
    if (empty($messages)) {
        $queryUpdt = $db->prepare('UPDATE choices SET
		content = :content
		WHERE id = :id');

        $resultFirstChoice = $queryUpdt->execute([
            'content' => htmlspecialchars($_POST['content']),
            'id' => $_POST['id']
        ]);

        if ($resultFirstChoice) {
            $_SESSION['message'] = 'Premier choix mis à jour !';
            header('location:first-choices-list.php');
        } else {
            $_SESSION['message'] = 'Erreur.';
        }
    }
}

if (isset($_GET['first_choice_id']) && isset($_GET['action']) && $_GET['action'] == 'edit') {

    $querySlc = $db->prepare('SELECT * FROM choices WHERE id = ?');
    $querySlc->execute(array($_GET['first_choice_id']));
    $firstChoice = $querySlc->fetch();
}

if(isset($_GET['first_choice_id']) AND $_GET['first_choice_id'] !== $firstChoice['id']) {
    header('Location:first-choices-list.php');
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
    <?php require_once('partials/nav.php'); ?>

    <div class="container-fluid col-xl-9 mt-3">
        <div class="card-body">
            <h4><?php if (isset($firstChoice)): ?>Modifier<?php else: ?>Ajouter<?php endif; ?> un premier choix</h4>
            <?php if (isset($_GET['first_choice_id'])): ?>
            <form action="first-choices-form.php?first_choice_id=<?= $firstChoice['id']; ?>&action=edit" method="post"
                  enctype="multipart/form-data">
                <?php else: ?>
                <form action="first-choices-form.php" method="post" enctype="multipart/form-data">
                    <?php endif; ?>
                    <div class="form-group">
                        <label for="content">Titre du premier choix :<span class="text-danger">*</span></label>
                        <input class="form-control" value="<?= isset($firstChoice) ? htmlentities($firstChoice['content']) : $content; ?>" type="text" placeholder="Titre" name="content" id="content">
                        <span class="text-danger"><?= isset($messages['content']) ? $messages['content'] : ''; ?></span>
                    </div>
                    <div class="text-right">
                        <?php if (isset($firstChoice)): ?>
                            <input class="btn btn-success" type="submit" name="update" value="Mettre à jour">
                        <?php else: ?>
                            <input class="btn btn-success" type="submit" name="save" value="Enregistrer">
                        <?php endif; ?>
                    </div>

                    <?php if (isset($firstChoice)): ?>
                        <input type="hidden" name="id" value="<?= $firstChoice['id']; ?>">
                    <?php endif; ?>
                </form>
        </div>
    </div>
</div>
<script src="../assets/js/jquery-3.3.1.min.js"></script>
<script src="../vendor/bootstrap-4.3.1/js/bootstrap.min.js"></script>
</body>
</html>