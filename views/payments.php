<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./assets/scss/main.css">
    <link rel="stylesheet" href="./assets/css/fa-5.5.0-web/css/all.css">
    <title>Paiements</title>
</head>
<body>
<?php require_once './partials/header.php'; ?>
<main class="marginTop">
    <section class="container">
        <div class="background widthContainer">
            <h2>Facture N°1234 à payer : 129€</h2>
            <form class="formPayments" action="index.php?page=payments" method="post" enctype="multipart/form-data">
                <div class="input-container">
                    <div class="styled-input">
                        <label>Nom figurant sur la carte :</label>
                        <input type="text">
                    </div>
                    <div class="styled-input">
                        <label>Numéro de carte :</label>
                        <input type="number">
                    </div>
                    <div class="styled-input">
                        <label>Date d'expiration :</label>
                        <input type="date">
                    </div>
                    <div class="styled-input">
                        <label>Cryptogramme :</label>
                        <input type="number">
                    </div>
                    <div class="btn">Envoyez</div>
                </div>
            </form>
        </div>
    </section>
</main>
<?php require_once './partials/footer.php'; ?>
</body>
</html>