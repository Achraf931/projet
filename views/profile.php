
<main class="marginTop">
    <section class="container">
        <div class="background widthContainer">
            <h3>Votre état civil :</h3>
            <br>
            <p><span class="blue">Nom : </span><?= htmlentities($userInfos['name']); ?></p>
            <p><span class="blue">Prénom : </span><?= htmlentities($userInfos['firstname']); ?></p>
        </div>
        <div class="background widthContainer">
            <h3>Votre adresse :</h3>
            <br>
            <p><span class="blue">Adresse : </span><?= htmlentities($userInfos['address']); ?></p>
            <p><span class="blue">Code postal : </span><?= htmlentities($userInfos['zipcode']); ?></p>
            <p><span class="blue">Ville : </span><?= htmlentities($userInfos['city']); ?></p>
        </div>
        <div class="background widthContainer">
            <h3>Contact :</h3>
            <br>
            <p><span class="blue">Adresse électronique : </span><?= htmlentities($userInfos['email']); ?></p>
            <p><span class="blue">Téléphone portable : </span><?= htmlentities($userInfos['mobile']); ?></p>
        </div>
        <div class="widthContainer">
            <a href="index.php?page=account">
                <p class="blue" style="font-family: GilroySemiBold"><i class="fal fa-chevron-left"></i> Retour</p>
            </a>
        </div>
    </section>
</main>