<?php
require_once('tools/common.php');

$messages = [];
$title = null;
$content = null;

if (isset($_POST['save'])) {
    if (empty($_POST['title'])) {
        $messages['title'] = 'Le titre est obligatoire !';
    }
    if (empty($_POST['content'])) {
        $messages['content'] = 'Le contenu est obligatoire !';
    }
    if (empty($messages)) {
        $queryInsert = $db->prepare('INSERT INTO notices (title, content) VALUES (?, ?)');
        $newNotice = $queryInsert->execute([
            $_POST['title'],
            $_POST['content']
        ]);

        //redirection après enregistrement
        //si $newArticle alors l'enregistrement a fonctionné
        if ($newNotice) {
            //redirection après enregistrement
            $_SESSION['message'] = 'Mention légale ajouté !';
            header('location:legal-notice-list.php');
            exit;
        } else { //si pas $newArticle => enregistrement échoué => générer un message pour l'administrateur à afficher plus bas
            $_SESSION['message'] = "Impossible d'enregistrer la nouvelle mention légale...";
        }
    } else{
        $title = $_POST['title'];
        $content = $_POST['content'];
    }
}


if (isset($_POST['update'])) {
    if (empty($_POST['title'])) {
        $messages['title'] = 'Le titre est obligatoire !';
    }
    if (empty($_POST['content'])) {
        $messages['content'] = 'Le contenu est obligatoire !';
    }
    if (empty($messages)) {
        $query = $db->prepare('UPDATE notices SET
		title = :title,
		content = :content
		WHERE id = :id');

        //mise à jour avec les données du formulaire
        $resultNotice = $query->execute([
            'title' => $_POST['title'],
            'content' => $_POST['content'],
            'id' => $_POST['id']
        ]);

        //si enregistrement ok
        if ($resultNotice) {
            $_SESSION['message'] = 'Mention légale mise à jour !';
            header('location:legal-notice-list.php');
        } else {
            $_SESSION['message'] = 'Erreur.';
        }
    }
}

//si on modifie un article, on doit séléctionner l'article en question (id envoyé dans URL) pour pré-remplir le formulaire plus bas
if (isset($_GET['notice_id']) && isset($_GET['action']) && $_GET['action'] == 'edit') {

    $query = $db->prepare('SELECT * FROM notices WHERE id = ?');
    $query->execute(array($_GET['notice_id']));
    //$article contiendra les informations de l'article dont l'id a été envoyé en paramètre d'URL
    $notice = $query->fetch();
}

if(isset($_GET['notice_id']) AND $_GET['notice_id'] !== $notice['id']) {
    header('Location:legal-notice-list.php');
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
            <h4><?php if (isset($notice)): ?>Modifier<?php else: ?>Ajouter<?php endif; ?> une mention légale</h4>
            <?php if (isset($_GET['notice_id'])): ?>
            <form action="legal-notice-form.php?notice_id=<?= $notice['id']; ?>&action=edit" method="post"
                  enctype="multipart/form-data">
                <?php else: ?>
                <form action="legal-notice-form.php" method="post" enctype="multipart/form-data">
                    <?php endif; ?>
                    <div class="form-group">
                        <label for="title">Titre :<span class="text-danger">*</span></label>
                        <input class="form-control" value="<?= isset($notice) ? htmlentities($notice['title']) : $title; ?>" type="text" placeholder="Titre" name="title" id="title">
                        <span style="color: red;"><?= isset($messages['title']) ? $messages['title'] : ''; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="content">Contenu :<span class="text-danger">*</span></label>
                        <textarea class="form-control" type="text" placeholder="Contenu" name="content" id="content"><?= isset($notice) ? htmlentities($notice['content']) : $content; ?></textarea>
                        <span style="color: red;"><?= isset($messages['content']) ? $messages['content'] : ''; ?></span>
                    </div>

                    <div class="text-right">
                        <!-- Si $article existe, on affiche un lien de mise à jour -->
                        <?php if (isset($notice)): ?>
                            <input class="btn btn-success" type="submit" name="update" value="Mettre à jour">
                            <!-- Sinon on afficher un lien d'enregistrement d'un nouvel article -->
                        <?php else: ?>
                            <input class="btn btn-success" type="submit" name="save" value="Enregistrer">
                        <?php endif; ?>
                    </div>

                    <!-- Si $article existe, on ajoute un champ caché contenant l'id de l'article à modifier pour la requête UPDATE -->
                    <?php if (isset($notice)): ?>
                        <input type="hidden" name="id" value="<?= $notice['id']; ?>">
                    <?php endif; ?>


                </form>
        </div>
    </div>
</div>
<script src="../assets/js/jquery-3.3.1.min.js"></script>
<script src="../vendor/bootstrap-4.3.1/js/bootstrap.min.js"></script>
</body>
</html>