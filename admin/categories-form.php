<?php
require_once('tools/common.php');

$messages = [];
$name = null;

if (isset($_POST['save'])) {
    if (empty($_POST['name'])) {
        $messages['name'] = 'Le nom est obligatoire !';
    }
    if (empty($messages)) {
        $queryInsert = $db->prepare('INSERT INTO categories (name) VALUES (?)');
        $newCategory = $queryInsert->execute([
            $_POST['name']
        ]);

        //redirection après enregistrement
        //si $newArticle alors l'enregistrement a fonctionné
        if ($newCategory) {
            //redirection après enregistrement
            $_SESSION['message'] = 'Catégorie ajouté !';
            header('location:categories-list.php');
            exit;
        } else { //si pas $newArticle => enregistrement échoué => générer un message pour l'administrateur à afficher plus bas
            $_SESSION['message'] = "Impossible d'enregistrer la nouvelle catégorie...";
        }
    } else{
        $name = $_POST['name'];
    }
}


if (isset($_POST['update'])) {
    if (empty($_POST['name'])) {
        $messages['name'] = 'Le nom est obligatoire !';
    }
    if (empty($messages)) {
        $query = $db->prepare('UPDATE categories SET
		name = :name
		WHERE id = :id');

        //mise à jour avec les données du formulaire
        $resultCategory = $query->execute([
            'name' => $_POST['name'],
            'id' => $_POST['id']
        ]);

        //si enregistrement ok
        if ($resultCategory) {
            $_SESSION['message'] = 'Catégorie mise à jour !';
            header('location:categories-list.php');
        } else {
            $_SESSION['message'] = 'Erreur.';
        }
    }
}

//si on modifie un article, on doit séléctionner l'article en question (id envoyé dans URL) pour pré-remplir le formulaire plus bas
if (isset($_GET['category_id']) && isset($_GET['action']) && $_GET['action'] == 'edit') {

    $query = $db->prepare('SELECT * FROM categories WHERE id = ?');
    $query->execute(array($_GET['category_id']));
    //$article contiendra les informations de l'article dont l'id a été envoyé en paramètre d'URL
    $category = $query->fetch();
}

if(isset($_GET['category_id']) AND $_GET['category_id'] !== $category['id']) {
    header('Location:categories-list.php');
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
            <h4><?php if (isset($category)): ?>Modifier<?php else: ?>Ajouter<?php endif; ?> une catégorie</h4>
            <?php if (isset($_GET['category_id'])): ?>
            <form action="categories-form.php?category_id=<?= $category['id']; ?>&action=edit" method="post"
                  enctype="multipart/form-data">
                <?php else: ?>
                <form action="categories-form.php" method="post" enctype="multipart/form-data">
                    <?php endif; ?>
                    <div class="form-group">
                        <label for="name">Nom :<span class="text-danger">*</span></label>
                        <input class="form-control" value="<?= isset($category) ? htmlentities($category['name']) : $name; ?>" type="text" placeholder="Nom" name="name" id="name">
                        <span style="color: red;"><?= isset($messages['name']) ? $messages['name'] : ''; ?></span>
                    </div>
                    <div class="text-right">
                        <!-- Si $article existe, on affiche un lien de mise à jour -->
                        <?php if (isset($category)): ?>
                            <input class="btn btn-success" type="submit" name="update" value="Mettre à jour">
                            <!-- Sinon on afficher un lien d'enregistrement d'un nouvel article -->
                        <?php else: ?>
                            <input class="btn btn-success" type="submit" name="save" value="Enregistrer">
                        <?php endif; ?>
                    </div>

                    <!-- Si $article existe, on ajoute un champ caché contenant l'id de l'article à modifier pour la requête UPDATE -->
                    <?php if (isset($category)): ?>
                        <input type="hidden" name="id" value="<?= $category['id']; ?>">
                    <?php endif; ?>
                </form>
        </div>
    </div>
</div>
<script src="../assets/js/jquery-3.3.1.min.js"></script>
<script src="../vendor/bootstrap-4.3.1/js/bootstrap.min.js"></script>
</body>
</html>