<main class="marginTop">
    <section class="container">
        <div class="background widthContainer">
            <h2 class="marginBottom">Factures</h2>
            <table class="tableBody">
                <?php if ($bills): ?>
                <thead>
                <tr>
                    <th>N°</th>
                    <th>Services</th>
                    <th class="displayNoneMobile">Montant</th>
                    <th>Statut</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach ($bills as $bill): ?>
                        <tr>
                            <td>N°<?= htmlentities($bill['number']); ?></td>
                            <td><?= htmlentities($bill['services']); ?></td>
                            <td class="blue displayNoneMobile"><b><?= htmlentities($bill['amount']); ?>€</b></td>
                            <td><?= $bill['status'] == 1 ? 'Payé' : 'À payer' ?></td>
                            <td><a href="./assets/bills/<?= $bill['bill']; ?>" target="_blank"><i class="fas fa-download blue"></i></a></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    Vous n'avez aucune facture.
                <?php endif; ?>
                <tr>
                    <td>
                        <a href="index.php?page=account">
                            <p class="blue" style="font-family: GilroySemiBold"><i class="fal fa-chevron-left"></i> Retour</p>
                        </a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </section>
</main>