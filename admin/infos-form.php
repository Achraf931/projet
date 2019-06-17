<?php
require_once('tools/common.php');

$messages = [];
$title = null;
$content = null;

if (isset($_POST['save'])) {
    if (empty($_POST['title'])) {
        $messages['title'] = 'Le titre est obligatoire !';
    }    if (empty($_POST['content'])) {
        $messages['content'] = 'Le contenu est obligatoire !';
    }
    if (empty($messages)) {
        $queryInsert = $db->prepare('INSERT INTO infos (title, content) VALUES (?, ?)');
        $newInfos = $queryInsert->execute([
            $_POST['name'],
            $_POST['content']
        ]);

        //redirection après enregistrement
        //si $newArticle alors l'enregistrement a fonctionné
        if ($newInfos) {
            //redirection après enregistrement
            $_SESSION['message'] = 'Infos ajouté !';
            header('location:infos.php');
            exit;
        } else { //si pas $newArticle => enregistrement échoué => générer un message pour l'administrateur à afficher plus bas
            $_SESSION['message'] = "Impossible d'enregistrer les nouvelles infos...";
        }
    } else{
        $title = $_POST['title'];
        $content = $_POST['content'];
    }
}


if (isset($_POST['update'])) {
    if (empty($_POST['title'])) {
        $messages['title'] = 'Le titre est obligatoire !';
    }    if (empty($_POST['content'])) {
        $messages['content'] = 'Le contenu est obligatoire !';
    }
    if (empty($messages)) {
        $query = $db->prepare('UPDATE infos SET
		title = :title,
		content = :content
		WHERE id = :id');

        //mise à jour avec les données du formulaire
        $resultInfos = $query->execute([
            'title' => $_POST['title'],
            'content' => $_POST['content'],
            'id' => $_POST['id']
        ]);

        //si enregistrement ok
        if ($resultInfos) {
            $_SESSION['message'] = 'Infos mise à jour !';
            header('location:infos.php');
        } else {
            $_SESSION['message'] = 'Erreur.';
        }
    }
}

//si on modifie un article, on doit séléctionner l'article en question (id envoyé dans URL) pour pré-remplir le formulaire plus bas
if (isset($_GET['info_id']) && isset($_GET['action']) && $_GET['action'] == 'edit') {

    $query = $db->prepare('SELECT * FROM infos WHERE id = ?');
    $query->execute(array($_GET['info_id']));
    //$article contiendra les informations de l'article dont l'id a été envoyé en paramètre d'URL
    $infos = $query->fetch();
}

if(isset($_GET['info_id']) AND $_GET['info_id'] !== $infos['id']) {
    header('Location:infos.php');
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
            <h4><?php if (isset($infos)): ?>Modifier<?php else: ?>Ajouter<?php endif; ?> les infos</h4>
            <?php if (isset($_GET['info_id'])): ?>
            <form action="infos-form.php?info_id=<?= $infos['id']; ?>&action=edit" method="post"
                  enctype="multipart/form-data">
                <?php else: ?>
                <form action="infos-form.php" method="post" enctype="multipart/form-data">
                    <?php endif; ?>
                    <div class="form-group">
                        <label for="title">Titre :<span class="text-danger">*</span></label>
                        <input class="form-control" value="<?= isset($infos) ? htmlentities($infos['title']) : $title; ?>" type="text" placeholder="Titre" name="title" id="title">
                        <span style="color: red;"><?= isset($messages['title']) ? $messages['title'] : ''; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="content">Contenu :<span class="text-danger">*</span></label>
                        <input class="form-control" value="<?= isset($infos) ? htmlentities($infos['content']) : $title; ?>" type="text" placeholder="Contenu" name="content" id="content">
                        <span style="color: red;"><?= isset($messages['content']) ? $messages['content'] : ''; ?></span>
                    </div>
                    <div class="text-right">
                        <!-- Si $article existe, on affiche un lien de mise à jour -->
                        <?php if (isset($infos)): ?>
                            <input class="btn btn-success" type="submit" name="update" value="Mettre à jour">
                            <!-- Sinon on afficher un lien d'enregistrement d'un nouvel article -->
                        <?php else: ?>
                            <input class="btn btn-success" type="submit" name="save" value="Enregistrer">
                        <?php endif; ?>
                    </div>

                    <!-- Si $article existe, on ajoute un champ caché contenant l'id de l'article à modifier pour la requête UPDATE -->
                    <?php if (isset($infos)): ?>
                        <input type="hidden" name="id" value="<?= $infos['id']; ?>">
                    <?php endif; ?>
                </form>
        </div>
    </div>
</div>
<script src="../assets/js/jquery-3.3.1.min.js"></script>
<script src="../vendor/bootstrap-4.3.1/js/bootstrap.min.js"></script>
</body>
</html>