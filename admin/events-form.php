<?php
require_once('tools/common.php');

$messages = [];
$title = null;
$content = null;
$summary = null;
$is_published = null;
$published_at = null;
$image = null;
$video = null;

if (isset($_POST['save'])) {
    $allowed_extensions = array('jpg', 'jpeg', 'png');
    $my_file_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

    if (empty($_POST['title'])) {
        $messages['title'] = 'Le titre est obligatoire !';
    }
    if (empty($_POST['published_at'])) {
        $messages['published_at'] = 'La date est obligatoire !';
    }
    if (empty($_POST['content'])) {
        $messages['content'] = 'Le contenu est obligatoire !';
    }
    if ($_FILES['image']['error'] !== 0) {
        $messages['image'] = 'L\'image est obligatoire !';
    }
    if ($_FILES['image']['error'] == 0 AND !in_array($my_file_extension, $allowed_extensions)) {
        $messages['imageExt'] = 'L\'extension est invalide !';
    }
    if (empty($messages)) {
        do {
            $new_file_name = md5(rand());
            $destination = '../assets/img/events/' . $new_file_name . '.' . $my_file_extension;
        } while (file_exists($destination));

        $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);

        $query = $db->prepare('INSERT INTO events (title, content, summary, is_published, published_at, image, video) VALUES (?, ?, ?, ?, ?, ?, ?)');
        $newEvent = $query->execute([
            htmlspecialchars($_POST['title']),
            htmlspecialchars($_POST['content']),
            htmlspecialchars($_POST['summary']),
            $_POST['is_published'],
            htmlspecialchars($_POST['published_at']),
            htmlspecialchars($new_file_name . '.' . $my_file_extension),
            htmlspecialchars($_POST['video'])
        ]);

        if ($newEvent) {
            $_SESSION['message'] = 'Evénement ajouté !';
            header('location:events-list.php');
            exit;
        } else {
            $message = "Impossible d'enregistrer le nouvel événement...";
        }

    } else{
        $title = $_POST['title'];
        $content = $_POST['content'];
        $summary = $_POST['summary'];
        $is_published = $_POST['is_published'];
        $published_at = $_POST['published_at'];
        $video = $_POST['video'];
    }
}


if (isset($_POST['update'])) {
    $selectImage = $db->prepare('SELECT image FROM events WHERE id = ?');
    $selectImage->execute([
        $_GET['event_id']
    ]);
    $recupImage = $selectImage->fetch();

    $allowed_extensions = array('jpg', 'jpeg', 'png');
    $my_file_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

    if (empty($_POST['title'])) {
        $messages['title'] = 'Le titre est obligatoire !';
    }
    if (empty($_POST['published_at'])) {
        $messages['published_at'] = 'La date est obligatoire !';
    }    if (empty($_POST['content'])) {
        $messages['content'] = 'Le contenu est obligatoire !';
    }
    if (!isset($_FILES['image']) OR empty($_FILES['image'])) {
        $messages['image'] = 'L\'image est obligatoire !';
    }
    if ($_FILES['image']['error'] == 0 AND !in_array($my_file_extension, $allowed_extensions)) {
        $messages['imageExt'] = 'L\'extension est invalide !';
    }
    if (empty($messages)) {
        if ($_FILES['image']['error'] == 0){
            do {
                $new_file_name = md5(rand());
                $destination = '../assets/img/events/' . $new_file_name . '.' . $my_file_extension;
                $image = $new_file_name . '.' . $my_file_extension;
            } while (file_exists($destination));
        } else{
            $image = $_POST['imgExist'];
        }

        $queryUpdt = $db->prepare('UPDATE events SET
		title = :title,
		content = :content,
		summary = :summary,
		is_published = :is_published,
		published_at = :published_at,
		image = :image,
		video = :video
		WHERE id = :id');

        $resultEvent = $queryUpdt->execute([
            'title' => htmlspecialchars($_POST['title']),
            'content' => htmlspecialchars($_POST['content']),
            'summary' => htmlspecialchars($_POST['summary']),
            'is_published' => $_POST['is_published'],
            'published_at' => htmlspecialchars($_POST['published_at']),
            'image' => htmlspecialchars($image),
            'video' => htmlspecialchars($_POST['video']),
            'id' => $_POST['id']
        ]);

        if ($image != $_POST['imgExist']){
            $pathImg = '../assets/img/events/';
            unlink($pathImg . $recupImage['image']);
            move_uploaded_file($_FILES['image']['tmp_name'], $destination);
        }


        if ($resultEvent) {
            $_SESSION['message'] = 'Evénement mis à jour !';
            header('location:events-list.php');
            exit;
        } else {
            $_SESSION['message'] = 'Erreur.';
        }
    }
}


if (isset($_POST['add_image'])) {
    $allowed_extensions = array('jpg', 'jpeg', 'png');
    $my_file_extension = pathinfo($_FILES['imageMulti']['name'], PATHINFO_EXTENSION);

    if (!in_array($my_file_extension, $allowed_extensions)) {
        $messages['extension'] = 'L\'extention est invalide !';
    } else {
        do {
            $new_file_name = rand();
            $destination = '../assets/img/events/' . $new_file_name . '.' . $my_file_extension;
        } while (file_exists($destination));

        $result = move_uploaded_file($_FILES['imageMulti']['tmp_name'], $destination);

        $query = $db->prepare('INSERT INTO images (caption, name, event_id) VALUES (?, ?, ?)');
        $newImage = $query->execute([
            htmlspecialchars($_POST['caption']),
            $new_file_name . '.' . $my_file_extension,
            $_POST['event_id']
        ]);
        if ($newImage){
            $_SESSION['message'] = '<div class="bg-success text-white p-2 mb-4">Image ajouté avec succès !</div>';
        }
    }
}

if (isset($_POST['delete_image'])) {
    $querySlc = $db->prepare('SELECT name FROM images WHERE id = ?');
    $querySlc->execute(array($_POST['img_id']));
    $imgToUnlink = $querySlc->fetch();

    if ($imgToUnlink) {
        unlink('../assets/img/events/' . $imgToUnlink['name']);
        $queryDelete = $db->prepare('DELETE FROM images WHERE id = ?');
        $queryDelete->execute(array($_POST['img_id']));
        $_SESSION['message'] = '<div class="bg-success text-white p-2 mb-4">Image supprimée avec succès !</div>';
    }
}


if (isset($_GET['event_id']) && isset($_GET['action']) && $_GET['action'] == 'edit') {
    $queryEvent = $db->prepare('SELECT * FROM events WHERE id = ?');
    $queryEvent->execute(array($_GET['event_id']));
    $event = $queryEvent->fetch();

    $queryImgs = $db->prepare('SELECT * FROM images WHERE event_id = ?');
    $queryImgs->execute(array($_GET['event_id']));
    $eventImages = $queryImgs->fetchAll();
}

if(isset($_GET['event_id']) AND $_GET['event_id'] !== $event['id']) {
    header('Location:events-list.php');
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
    <?php require_once('partials/nav.php'); ?>

    <div class="container-fluid col-xl-9 mt-3">
        <div class="card-body">
            <h4><?php if (isset($event)): ?>Modifier<?php else: ?>Ajouter<?php endif; ?> un événement</h4>
            <?php if (isset($message)): ?>
                <div class="bg-danger text-white">
                    <?= $message; ?>
                </div>
            <?php endif; ?>
            <ul class="nav nav-tabs justify-content-center nav-fill" role="tablist">
                <li class="nav-item">
                    <a class="nav-link <?php if (isset($_POST['save']) || isset($_POST['update']) || (!isset($_POST['add_image']) && !isset($_POST['delete_image']))): ?>active<?php endif; ?>"
                       data-toggle="tab" href="#infos" role="tab">Infos</a>
                </li>
                <?php if (isset($event)): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if (isset($_POST['add_image']) || isset($_POST['delete_image'])): ?>active<?php endif; ?>"
                           data-toggle="tab" href="#images" role="tab">Images</a>
                    </li>
                <?php endif; ?>
            </ul>
            <?php if (isset($_GET['event_id'])): ?>
            <div class="tab-content">
                <div class="tab-pane container-fluid <?php if (isset($_POST['save']) || isset($_POST['update']) || (!isset($_POST['add_image']) && !isset($_POST['delete_image']))): ?>active<?php endif; ?>"
                     id="infos" role="tabpanel">
                    <form action="events-form.php?event_id=<?= $event['id']; ?>&action=edit" method="post"
                          enctype="multipart/form-data">
                        <?php else: ?>
                        <form action="events-form.php" method="post" enctype="multipart/form-data">
                            <?php endif; ?>
                            <div class="form-group">
                                <label for="title">Titre :<span class="text-danger">*</span></label>
                                <input class="form-control"
                                       value="<?= isset($event) ? htmlentities($event['title']) : $title; ?>" type="text"
                                       placeholder="Titre" name="title" id="title"/>
                                <span class="text-danger"><?= isset($messages['title']) ? $messages['title'] : ''; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="summary">Résumé :</label>
                                <input class="form-control" value="<?= isset($event) ? htmlentities($event['summary']) : $summary; ?>" type="text" placeholder="Résumé" name="summary" id="summary"/>
                            </div>
                            <div class="form-group">
                                <label for="content">Contenu :<span class="text-danger">*</span></label>
                                <textarea class="form-control" name="content" id="content" placeholder="Contenu"><?= isset($event) ? htmlentities($event['content']) : $content; ?></textarea>
                                <span class="text-danger"><?= isset($messages['content']) ? $messages['content'] : ''; ?></span>
                            </div>

                            <div class="form-group">
                                <label for="image">Image :<span class="text-danger">*</span></label>
                                <input class="form-control" type="file" name="image" id="image" value="<?= $event['nameImg']; ?>"/>
                                <?php if (isset($event['image']) AND !empty($event['image'])): ?>
                                    <img style="width: 50%;" class="img-fluid py-4"
                                         src="../assets/img/events/<?= isset($event) ? $event['image'] : $image; ?>" alt="">
                                <?php endif; ?>
                                <span class="text-danger"><?= isset($messages['image']) ? $messages['image'] : ''; ?></span>
                                <span class="text-danger"><?= isset($messages['imageExt']) ? $messages['imageExt'] : ''; ?></span>
                            </div>

                            <div class="form-group">
                                <label for="video">Vidéo :</label>
                                <input class="form-control" value="<?= isset($event) ? htmlentities($event['video']) : $video; ?>" type="text" placeholder="Code vidéo YouTube" name="video" id="video"/>
                            </div>

                            <div class="form-group">
                                <label for="published_at">Date de publication :<span class="text-danger">*</span></label>
                                <input class="form-control"
                                       value="<?= isset($event) ? htmlentities($event['published_at']) : $published_at; ?>"
                                       type="date" placeholder="Résumé" name="published_at" id="published_at"/>
                                <span class="text-danger"><?= isset($messages['published_at']) ? $messages['published_at'] : ''; ?></span>
                            </div>

                            <div class="form-group">
                                <label for="is_published">Publié ?</label>
                                <select class="form-control" name="is_published" id="is_published">
                                    <option value="0" <?= isset($event) && $event['is_published'] == 0 ? 'selected' : ''; ?>>
                                        Non
                                    </option>
                                    <option value="1" <?= isset($event) && $event['is_published'] == 1 ? 'selected' : ''; ?>>
                                        Oui
                                    </option>
                                </select>
                            </div>

                            <div class="text-right">
                                <?php if (isset($event)): ?>
                                    <input class="btn btn-success" type="submit" name="update" value="Mettre à jour"/>
                                <?php else: ?>
                                    <input class="btn btn-success" type="submit" name="save" value="Enregistrer"/>
                                <?php endif; ?>
                            </div>

                            <?php if (isset($event)): ?>
                                <input type="hidden" name="id" value="<?= $event['id']; ?>"/>
                                <input type="hidden" name="imgExist" value="<?= $event['image']; ?>"/>
                            <?php endif; ?>
                        </form>
                </div>
                <?php if (isset($event)): ?>
                    <div class="tab-pane container-fluid <?php if (isset($_POST['add_image']) || isset($_POST['delete_image'])): ?>active<?php endif; ?>"
                         id="images" role="tabpanel">

                        <?= isset($_SESSION['message']) ? $_SESSION['message'] : ''; ?>
                        <h5 class="mt-4"><?php if (isset($image)): ?>Modifier<?php else: ?>Ajouter<?php endif; ?> une image :</h5>
                        <form action="events-form.php?event_id=<?= $event['id']; ?>&action=edit" method="post"
                              enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="caption">Légende :</label>
                                <input class="form-control" type="text" placeholder="Légende" name="caption"
                                       id="caption"/>
                            </div>
                            <div class="form-group">
                                <label for="imageMulti">Fichier :</label>
                                <input class="form-control" type="file" name="imageMulti" id="imageMulti"/>
                            </div>

                            <input type="hidden" name="event_id" value="<?= $event['id']; ?>"/>

                            <div class="text-right">
                                <input class="btn btn-success" type="submit" name="add_image" value="Enregistrer"/>
                            </div>
                        </form>

                        <div class="row">
                            <h5 class="col-12 pb-4">Liste des images :</h5>
                            <?php foreach ($eventImages as $image): ?>
                                <form action="events-form.php?event_id=<?= $event['id']; ?>&action=edit" method="post"
                                      class="col-4 my-3">
                                    <img src="../assets/img/events/<?= $image['name']; ?>" alt="" class="img-fluid"/>
                                    <p class="my-2"><?= $image['caption']; ?></p>
                                    <input type="hidden" name="img_id" value="<?= $image['id']; ?>"/>
                                    <div class="text-right"><input class="btn btn-danger" type="submit" name="delete_image" value="Supprimer"/></div>
                                </form>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<script src="../assets/js/jquery-3.3.1.min.js"></script>
<script src="../vendor/bootstrap-4.3.1/js/bootstrap.min.js"></script>
</body>
</html>