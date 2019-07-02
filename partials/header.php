<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./assets/scss/main.css">
    <link rel="stylesheet" href="./assets/css/fa-5.5.0-web/css/all.css">
    <link rel="icon" type="image/png" href="./assets/img/logo/logoIcon.png">
    <?php if (isset($_GET['page']) AND $_GET['page'] == 'events-list'): ?>
        <link href="./assets/css/cuppa-datepicker-styles.css" rel="stylesheet">
        <script type="text/javascript" src="./assets/js/moment.js"></script>
        <script type="text/javascript" src="./assets/js/cuppa-calendar.js"></script>
        <script type="text/javascript" src="./assets/js/head-event-list.js"></script>
    <?php endif; ?>
    <title><?= $pageTitle; ?></title>
</head>
<body id="body">
<div class="backdrop"></div>
<div class="modal">
    <div class="headConnexion">
        <h2 id="titleConnexion">Connexion</h2>
        <i class="fas fa-times-circle closeModal" style="cursor: pointer"></i>
    </div>
    <form method="post" class="connexion" enctype="multipart/form-data">
        <label for="email">Email</label>
        <input class="input" type="email" name="email" id="email" value="<?= isset($loginError) ? $_POST['email'] : '' ?>">
        <label for="password">Mot de passe</label>
        <input class="input" type="password" name="password" id="password">
        <p id="errors"></p>
        <button class="btn" type="submit" name="modalConnexion" id="modalConnexion">Connexion</button>
        <p class="mdpForgot">Mot de passe oublié ?</p>
    </form>
    <form method="post" class="formForgot" enctype="multipart/form-data">
        <label for="forgotPasswordEmail">Email</label>
        <input placeholder="Adresse mail" type="email" name="forgotPasswordEmail" id="forgotPasswordEmail" value="<?= isset($forgotPasswordError) ? $_POST['forgotPasswordEmail'] : '' ?>">
        <p id="errorsEmail" style="color: red;"></p>
        <p id="successNewPassword" style="color: #1D7E34;"></p>
        <button style="margin-top: 10px;" class="btn" type="submit" name="sendForgot" id="sendForgot">Envoyer</button>
        <p id="backForm">< Retour</p>
    </form>
</div>
<header class="header">
    <div class="menu-icon">
        <span></span>
    </div>
    <nav class="containerNav">
        <div id="logo">
            <a href="index.php"><img src="./assets/img/logo/logo2.png" style="max-width: 80px" alt=""></a>
        </div>
        <ul class="ul">
            <li><a href="index.php" <?= !isset($_GET['page']) ? 'style="color: #1786C8; font-family: GilroyBold"' : ''; ?>>Accueil</a></li>
            <li><a href="index.php?page=events-list" <?= (isset($_GET['page']) AND ($_GET['page'] == 'events-list' OR $_GET['page'] == 'events'))? 'style="color: #1786C8; font-family: GilroyBold"' : ''; ?>>Événements</a></li>
            <li><a href="index.php?page=services" <?= (isset($_GET['page']) AND $_GET['page'] == 'services') ? 'style="color: #1786C8; font-family: GilroyBold"' : ''; ?>>Services</a></li>
            <li><a href="index.php?page=contact" <?= (isset($_GET['page']) AND $_GET['page'] == 'contact') ? 'style="color: #1786C8; font-family: GilroyBold"' : ''; ?>>Contact</a></li>
            <?php if (isset($_SESSION['user'])): ?>
            <li class="textCenter"><h2><?= $_SESSION['user']['firstname']; ?></h2>
                <a href="index.php?page=account"><p class="blue">Mon compte</p></a>
                <?php else: ?>
            <li class="connexionBtn">
                <a class="btn">Mon compte</a>
                <?php endif; ?>
            </li>
        </ul>
    </nav>
    <ul id="navMobile">
        <li>
            <a href="index.php">
                <i class="far fa-home-lg-alt"></i>
                <p>Accueil</p>
            </a>
        </li>
        <li>
            <a href="index.php?page=events-list">
                <i class="fal fa-calendar-alt"></i>
                <p>Événements</p>
            </a>
        </li>
        <li>
            <a href="index.php?page=services">
                <i class="fal fa-building"></i>
                <p>Services</p>
            </a>
        </li>
        <li>
            <a href="index.php?page=contact">
                <i class="fal fa-phone-office"></i>
                <p>Contact</p>
            </a>
        </li>
        <?php if (isset($_SESSION['user'])): ?>
        <li class="textCenter"><h2><?= $_SESSION['user']['firstname']; ?></h2>
            <a href="index.php?page=account"><p class="blue">Mon compte</p></a>
            <?php else: ?>
        <li class="connexionBtn">
            <a>
                <i class="fas fa-user-circle"></i>
                <p>Mon compte</p>
            </a>
        </li>
        <?php endif; ?>
        <li id="closeNav"><i class="fas fa-times-circle"></i></li>
    </ul>
    <div class="backgroundDark"></div>
</header>