<main class="marginTop">
    <section class="container">
        <div class="background widthContainer">
            <h2 class="marginBottom">Vérification de vos informations</h2>
            <form action="index.php?page=verification" method="post" enctype="multipart/form-data">
                <div class="input-container">
                    <div class="styled-input">
                        <label class="blue">Nom :</label>
                        <p><?= htmlentities($userInfos['name']); ?></p>
                    </div>
                    <div class="styledInput">
                        <label class="blue">Prénom :</label>
                        <p><?= htmlentities($userInfos['firstname']); ?></p>
                    </div>
                    <div class="styledInput">
                        <label class="blue">Date de naissance :</label>
                        <p><?= htmlentities($userInfos['birthdate']); ?></p>
                    </div>
                    <div class="styledInput">
                        <label class="blue">Adresse :</label>
                        <p><?= htmlentities($userInfos['address']); ?></p>
                    </div>
                    <div class="styledInput">
                        <label class="blue">Ville :</label>
                        <p><?= htmlentities($userInfos['city']); ?></p>
                    </div>
                    <div class="styleInput">
                        <label class="blue">Code postal :</label>
                        <p><?= htmlentities($userInfos['zipcode']); ?></p>
                    </div>
                    <div class="styledInput">
                        <label class="blue">Email :</label>
                        <p><?= htmlentities($userInfos['email']); ?></p>
                    </div>
                    <div class="styledInput">
                        <label class="blue">Mobile :</label>
                        <p><?= htmlentities($userInfos['mobile']); ?></p>
                    </div>
                    <div class="containerBtn">
                        <button class="btn btnDeco" name="sendVerifContact" value="1" type="submit">Signalez une erreur</button>
                        <button class="btn" name="sendVerif" type="submit" value="1">Envoyez</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</main>