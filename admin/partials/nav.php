<?php
//nombre d'enregistrements de la table user
$nbUsers = $db->query("SELECT COUNT(*) FROM users")->fetchColumn();
//nombre d'enregistrements de la table category
$nbCategories = $db->query("SELECT COUNT(*) FROM categories")->fetchColumn();
$nbEvents = $db->query("SELECT COUNT(*) FROM events")->fetchColumn();
//nombre d'enregistrements de la table article
$nbBills = $db->query("SELECT COUNT(*) FROM bills")->fetchColumn();
$nbNotices = $db->query("SELECT COUNT(*) FROM notices")->fetchColumn();
$nbFaq = $db->query("SELECT COUNT(*) FROM faq")->fetchColumn();
$nbInfos = $db->query("SELECT COUNT(*) FROM infos")->fetchColumn();
$nbServices = $db->query("SELECT COUNT(*) FROM services")->fetchColumn();
?>
<ul class="col-3 py-2 categories-nav bg-dark mb-0">
    <li class="nav-item list-group list-group-flush">
        <a href="../index.php" class="d-block btn btn-warning mb-4 mt-2">Site</a>
        <a class="nav-link text-white" href="users-list.php"><i class="fas fa-fw fa-user"></i><span> Gestion des utilisateurs [<?php echo $nbUsers; ?>]</span></a>
        <a class="nav-link text-white" href="bills-list.php"><i class="fas fa-fw fa-file-invoice-dollar"></i><span> Gestion des factures [<?php echo $nbBills; ?>]</span></a>
        <a class="nav-link text-white" href="events-list.php"><i class="fas fa-fw fa-newspaper"></i><span> Gestion des événements [<?php echo $nbEvents; ?>]</span></a>
        <a class="nav-link text-white" href="services-list.php"><i class="fas fa-server"></i><span> Gestion des services [<?php echo $nbServices; ?>]</span></a>
        <a class="nav-link text-white" href="categories-list.php"><i class="fas fa-fw fa-table"></i><span> Gestion des catégories de la FAQ [<?php echo $nbCategories; ?>]</span></a>
        <a class="nav-link text-white" href="faq-list.php"><i class="fas fa-question-circle"></i><span> Gestion de la FAQ [<?php echo $nbFaq; ?>]</span></a>
        <a class="nav-link text-white" href="infos.php"><i class="fas fa-info-circle"></i><span> Gestion des infos de la ville [<?php echo $nbInfos; ?>]</span></a>
        <a class="nav-link text-white" href="legal-notice-list.php"><i class="fas fa-flag"></i><span> Gestion des mentions légales [<?php echo $nbNotices; ?>]</span></a>
    </li>
</ul>