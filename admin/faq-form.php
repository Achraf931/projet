<?php
require_once('tools/common.php');

$messages = [];
$question = null;
$response = null;

if (isset($_POST['save'])) {
    if (empty($_POST['question'])) {
        $messages['question'] = 'La question est obligatoire !';
    }
    if (empty($_POST['response'])) {
        $messages['response'] = 'La réponse est obligatoire !';
    }
    if (empty($messages)) {
        $queryInsert = $db->prepare('INSERT INTO faq (question, response, category_id) VALUES (?, ?, ?)');
        $newFaq = $queryInsert->execute([
            $_POST['question'],
            $_POST['response'],
            $_POST['categories']
        ]);

        //redirection après enregistrement
        //si $newArticle alors l'enregistrement a fonctionné
        if ($newFaq) {
            //redirection après enregistrement
            $_SESSION['message'] = 'Faq ajouté !';
            header('location:faq-list.php');
            exit;
        } else { //si pas $newArticle => enregistrement échoué => générer un message pour l'administrateur à afficher plus bas
            $_SESSION['message'] = "Impossible d'enregistrer la nouvelle faq...";
        }
    } else{
        $question = $_POST['question'];
        $response = $_POST['response'];
    }
}


if (isset($_POST['update'])) {
    if (empty($_POST['question'])) {
        $messages['question'] = 'La question est obligatoire !';
    }
    if (empty($_POST['response'])) {
        $messages['response'] = 'La réponse est obligatoire !';
    }
    if (empty($messages)) {
        $query = $db->prepare('UPDATE faq SET
		question = :question,
		response = :response,
		category_id = :categories
		WHERE id = :id');

        //mise à jour avec les données du formulaire
        $resultFaq = $query->execute([
            'question' => $_POST['question'],
            'response' => $_POST['response'],
            'categories' => $_POST['categories'],
            'id' => $_POST['id']
        ]);

        //si enregistrement ok
        if ($resultFaq) {
            $_SESSION['message'] = 'Faq mise à jour !';
            header('location:faq-list.php');
        } else {
            $_SESSION['message'] = 'Erreur.';
        }
    }
}

//si on modifie un article, on doit séléctionner l'article en question (id envoyé dans URL) pour pré-remplir le formulaire plus bas
if (isset($_GET['faq_id']) && isset($_GET['action']) && $_GET['action'] == 'edit') {

    $query = $db->prepare('SELECT * FROM faq WHERE id = ?');
    $query->execute(array($_GET['faq_id']));
    //$article contiendra les informations de l'article dont l'id a été envoyé en paramètre d'URL
    $faq = $query->fetch();
}

if(isset($_GET['faq_id']) AND $_GET['faq_id'] !== $faq['id']) {
    header('Location:faq-list.php');
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
    <script src="https://cloud.tinymce.com/5/tinymce.min.js?apiKey=aurm6hyuh28jihz3rr0alf6vphzbd5xo471xz1nzal5iyptm"></script>
    <script>tinymce.init({ selector:'textarea' });</script>
</head>
<body>
<div class="row m-0 justify-content-between sizeMax">
    <!-- Sidebar -->
    <?php require_once('partials/nav.php'); ?>

    <div class="container-fluid col-xl-9 mt-3">
        <div class="card-body">
            <h4><?php if (isset($faq)): ?>Modifier<?php else: ?>Ajouter<?php endif; ?> une faq</h4>
            <?php if (isset($_GET['faq_id'])): ?>
            <form action="faq-form.php?faq_id=<?= $faq['id']; ?>&action=edit" method="post"
                  enctype="multipart/form-data">
                <?php else: ?>
                <form action="faq-form.php" method="post" enctype="multipart/form-data">
                    <?php endif; ?>
                    <div class="form-group">
                        <label for="categories">Catégorie :</label>
                        <select class="form-control" name="categories" id="categories">
                            <?php $queryCat = $db->query('SELECT * FROM categories');
                            $categories = $queryCat->fetchAll(); ?>

                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['id']; ?>" <?= isset($faq) && $faq['category_id'] == $category['id'] ? 'selected' : '';?>> <?= $category['name'] ?> </option>
                            <?php endforeach; ?>
                        </select>
                        <span style="color: red;"><?= isset($messages['question']) ? $messages['question'] : ''; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="question">Question :<span class="text-danger">*</span></label>
                        <input class="form-control" value="<?= isset($faq) ? htmlentities($faq['question']) : $question; ?>" type="text" placeholder="Question" name="question" id="question">
                        <span style="color: red;"><?= isset($messages['question']) ? $messages['question'] : ''; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="response">Réponse :<span class="text-danger">*</span></label>
                        <textarea class="form-control" type="text" placeholder="Réponse" name="response" id="response"><?= isset($faq) ? htmlentities($faq['response']) : $response; ?></textarea>
                        <span style="color: red;"><?= isset($messages['response']) ? $messages['response'] : ''; ?></span>
                    </div>
                    <div class="text-right">
                        <!-- Si $article existe, on affiche un lien de mise à jour -->
                        <?php if (isset($faq)): ?>
                            <input class="btn btn-success" type="submit" name="update" value="Mettre à jour">
                            <!-- Sinon on afficher un lien d'enregistrement d'un nouvel article -->
                        <?php else: ?>
                            <input class="btn btn-success" type="submit" name="save" value="Enregistrer">
                        <?php endif; ?>
                    </div>

                    <!-- Si $article existe, on ajoute un champ caché contenant l'id de l'article à modifier pour la requête UPDATE -->
                    <?php if (isset($faq)): ?>
                        <input type="hidden" name="id" value="<?= $faq['id']; ?>">
                    <?php endif; ?>


                </form>
        </div>
    </div>
</div>
<script src="../assets/js/jquery-3.3.1.min.js"></script>
<script src="../vendor/bootstrap-4.3.1/js/bootstrap.min.js"></script>
</body>
</html>