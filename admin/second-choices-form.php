<?php
require_once('tools/common.php');

$messages = [];
$choice = null;

if (isset($_POST['save'])) {
    if (empty($_POST['secondChoice'])) {
        $messages['secondChoice'] = 'Le titre est obligatoire !';
    }
    if (empty($messages)) {
        $queryInsert = $db->prepare('INSERT INTO second_choices (choice, choices_id) VALUES (?, ?)');
        $newSecondChoice = $queryInsert->execute([
            htmlspecialchars($_POST['secondChoice']),
            htmlspecialchars($_POST['firstChoice'])
        ]);

        if ($newSecondChoice) {
            $_SESSION['message'] = 'Second choix ajouté !';
            header('location:second-choices-list.php');
            exit;
        } else {
            $_SESSION['message'] = "Impossible d'enregistrer le nouveau choix...";
        }
    } else{
        $choice = $_POST['secondChoice'];
    }
}


if (isset($_POST['update'])) {
    if (empty($_POST['secondChoice'])) {
        $messages['secondChoice'] = 'Le titre est obligatoire !';
    }
    if (empty($messages)) {
        $queryUpdt = $db->prepare('UPDATE second_choices SET
		choice = :choice,
		choices_id = :choices_id
		WHERE id = :id');

        $resultSecondChoice = $queryUpdt->execute([
            'choice' => htmlspecialchars($_POST['secondChoice']),
            'choices_id' => htmlspecialchars($_POST['firstChoice']),
            'id' => $_POST['id']
        ]);

        if ($resultSecondChoice) {
            $_SESSION['message'] = 'Second choix mis à jour !';
            header('location:second-choices-list.php');
        } else {
            $_SESSION['message'] = 'Erreur.';
        }
    }
}

if (isset($_GET['second_choice_id']) && isset($_GET['action']) && $_GET['action'] == 'edit') {

    $querySlc = $db->prepare('SELECT * FROM second_choices WHERE id = ?');
    $querySlc->execute(array($_GET['second_choice_id']));
    $secondChoice = $querySlc->fetch();
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
            <h4><?php if (isset($secondChoice)): ?>Modifier<?php else: ?>Ajouter<?php endif; ?> un second choix</h4>
            <?php if (isset($_GET['first_choice_id'])): ?>
            <form action="second-choices-form.php?second_choice_id=<?= $secondChoice['id']; ?>&action=edit" method="post"
                  enctype="multipart/form-data">
                <?php else: ?>
                <form action="second-choices-form.php" method="post" enctype="multipart/form-data">
                    <?php endif; ?>
                    <div class="form-group">
                        <label for="firstChoice">Premier choix :</label>
                        <select class="form-control" name="firstChoice" id="firstChoice">
                            <?php $queryCat = $db->query('SELECT * FROM choices');
                            $firstChoice = $queryCat->fetchAll(); ?>

                            <?php foreach ($firstChoice as $choiceFirst): ?>
                                <option value="<?= $choiceFirst['id']; ?>" <?= isset($secondChoice) && $secondChoice['choices_id'] == $choiceFirst['id'] ? 'selected' : '';?>> <?= $choiceFirst['content'] ?> </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="secondChoice">Titre du second choix :<span class="text-danger">*</span></label>
                        <input class="form-control" value="<?= isset($secondChoice) ? htmlentities($secondChoice['secondChoice']) : $choice; ?>" type="text" placeholder="Titre" name="secondChoice" id="secondChoice">
                        <span class="text-danger"><?= isset($messages['secondChoice']) ? $messages['secondChoice'] : ''; ?></span>
                    </div>
                    <div class="text-right">
                        <?php if (isset($secondChoice)): ?>
                            <input class="btn btn-success" type="submit" name="update" value="Mettre à jour">
                        <?php else: ?>
                            <input class="btn btn-success" type="submit" name="save" value="Enregistrer">
                        <?php endif; ?>
                    </div>

                    <?php if (isset($secondChoice)): ?>
                        <input type="hidden" name="id" value="<?= $secondChoice['id']; ?>">
                    <?php endif; ?>
                </form>
        </div>
    </div>
</div>
<script src="../assets/js/jquery-3.3.1.min.js"></script>
<script src="../vendor/bootstrap-4.3.1/js/bootstrap.min.js"></script>
</body>
</html>