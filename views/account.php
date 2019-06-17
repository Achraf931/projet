<main class="marginTop">
    <section class="container">
        <div class="background widthContainer myProfile">
            <div class="containAccount">
                <div class="profileImgName">
                    <div>
                        <img src="./assets/img/profile/man.png" alt="Profile">
                    </div>
                    <div>
                        <h2 class="blue" style="font-family: GilroyBold"><?= htmlentities($userInfos['firstname']); ?> <?= htmlentities($userInfos['name']); ?></h2>
                        <p><?= htmlentities($userInfos['email']); ?></p>
                    </div>
                </div>
                <div>
                    <p>Factures</p>
                    <a href="index.php?page=bills"><p class="blue">Gestion</p></a>
                </div>
                <div>
                    <a href="index.php?page=profile"><p style="font-family: GilroySemiBold">Informations personnelles</p></a>
                </div>
            </div>
            <div>
                <?php if (isset($_SESSION['user']) AND $_SESSION['user']['admin'] == 1): ?>
                    <a href="./admin/index.php">
                        <div class="btn">Administration</div>
                    </a>
                <?php endif; ?>
                <a href="index.php?logout">
                    <div class="btn btnDeco">Déconnexion</div>
                </a>
            </div>
        </div>
        <div class="background widthContainer bgWhite">
            <h3 class="blue marginBottom">Dernière facture</h3>
            <table style="text-align: center">
                <tr class="dFlexBetween">
                    <?php if ($lastBill): ?>
                        <td>N°<?= htmlentities($lastBill['number']); ?></td>
                        <td><?= htmlentities($lastBill['services']); ?></td>
                        <td class="blue"><b><?= htmlentities($lastBill['amount']); ?>€</b></td>
                        <td class="displayNoneMobile"><?= htmlentities($lastBill['date']); ?></td>
                        <td class="displayNoneMobile"><?= $lastBill['status'] == 1 ? 'Payé' : 'À payer' ?></td>
                        <td><a href="./assets/bills/<?= $lastBill['bill']; ?>" target="_blank"><i class="fas fa-download blue"></i></a></td>
                    <?php else: ?>
                        <td>Vous n'avez aucune facture.</td>
                    <?php endif; ?>
                </tr>
            </table>
        </div>
        <div class="background widthContainer bgWhite">
            <h3 class="blue marginBottom">Contactez-nous</h3>
            <div class="divMiddle">
                <div>
                    <p><span class="blue">Adresse :</span> Place Jean-Jaurès 93105 Montreuil Cedex
                    <p><span class="blue">Téléphone :</span> 01 48 70 60 00</p>
                    <p><span class="blue">E-mail :</span> standard@montreuil.fr</p>
                    <p><span class="blue">Site Web :</span> http://www.montreuil.fr</p>
                </div>
                <div style="text-align: end">
                    <p><span class="blue">Horaires :</span>
                    <p>Du lundi au vendredi : de 09h00 à 17h00</p>
                    <p>Le samedi : de 08h30 à 12h00</p>
                    <p>Le dimanche : Fermé</p>
                </div>
            </div>
        </div>
    </section>
</main>