<?php
require_once('tools/common.php');

$messages = [];
$number = null;
$services = null;
$amount = null;
$date = null;

if (isset($_POST['save'])) {
    $allowed_extensions = array('pdf');
    $my_file_extension = pathinfo($_FILES['pdfBill']['name'], PATHINFO_EXTENSION);

    if (empty($_POST['number'])) {
        $messages['number'] = 'Le numéro de facture est obligatoire !';
    }
    if (empty($_POST['services'])) {
        $messages['services'] = 'Le service est obligatoire !';
    }
    if (empty($_POST['amount'])) {
        $messages['amount'] = 'Le montant est obligatoire !';
    }
    if (empty($_POST['date'])) {
        $messages['date'] = 'La date est obligatoire !';
    }
    if ($_FILES['pdfBill']['error'] !== 0) {
        $messages['pdfBill'] = 'L\'image est obligatoire !';
    }
    if ($_FILES['pdfBill']['error'] == 0 AND !in_array($my_file_extension, $allowed_extensions)) {
        $messages['pdfBillExt'] = 'L\'extension est invalide !';
    }
    if (empty($_POST['users'])) {
        $messages['users'] = 'Le choix de l\'utilisateur est obligatoire !';
    }
    if (empty($messages)) {
        do {
            $new_file_name = md5(rand());
            $destination = '../assets/bills/' . $new_file_name . '.' . $my_file_extension;
        } while (file_exists($destination));

        $result = move_uploaded_file($_FILES['pdfBill']['tmp_name'], $destination);

        $queryInsert = $db->prepare('INSERT INTO bills (number, services, amount, date, status, bill, user_id) VALUES (?, ?, ?, ?, ?, ?, ?)');
        $newBill = $queryInsert->execute([
            htmlspecialchars($_POST['number']),
            htmlspecialchars($_POST['services']),
            htmlspecialchars($_POST['amount']),
            htmlspecialchars($_POST['date']),
            htmlspecialchars($_POST['status']),
            htmlspecialchars($new_file_name . '.' . $my_file_extension),
            $_POST['users']
        ]);

        if ($newBill) {
            $_SESSION['message'] = 'Facture ajouté !';
            header('location:bills-list.php');
            exit;
        } else {
            $_SESSION['message'] = "Impossible d'enregistrer la nouvelle facture...";
        }
    } else {
        $number = $_POST['number'];
        $services = $_POST['services'];
        $amount = $_POST['amount'];
        $date = $_POST['date'];
    }
}


if (isset($_POST['update'])) {
    $selectBill = $db->prepare('SELECT bill FROM bills WHERE id = ?');
    $selectBill->execute([
        $_GET['bill_id']
    ]);
    $recupBill = $selectBill->fetch();

    $allowed_extensions = array('pdf');
    $my_file_extension = pathinfo($_FILES['pdfBill']['name'], PATHINFO_EXTENSION);

    if (empty($_POST['number'])) {
        $messages['number'] = 'Le numéro de facture est obligatoire !';
    }
    if (empty($_POST['services'])) {
        $messages['services'] = 'Le service est obligatoire !';
    }
    if (empty($_POST['amount'])) {
        $messages['amount'] = 'Le montant est obligatoire !';
    }
    if (empty($_POST['date'])) {
        $messages['date'] = 'La date est obligatoire !';
    }
    if (!isset($_FILES['pdfBill']) OR empty($_FILES['pdfBill'])) {
        $messages['pdfBill'] = 'L\'image est obligatoire !';
    }
    if ($_FILES['pdfBill']['error'] == 0 AND !in_array($my_file_extension, $allowed_extensions)) {
        $messages['pdfBillExt'] = 'L\'extension est invalide !';
    }
    if (empty($_POST['users'])) {
        $messages['users'] = 'Le choix de l\'utilisateur est obligatoire !';
    }
    if (empty($messages)) {
        if ($_FILES['pdfBill']['error'] == 0) {
            do {
                $new_file_name = md5(rand());
                $destination = '../assets/bills/' . $new_file_name . '.' . $my_file_extension;
                $pdfBill = $new_file_name . '.' . $my_file_extension;
            } while (file_exists($destination));
        } else {
            $pdfBill = $_POST['pdfExist'];
        }


        $queryUpdt = $db->prepare('UPDATE bills SET
		number = :number,
		services = :services,
		amount = :amount,
		date = :date,
		status = :status,
		bill = :bill,
		user_id = :user_id
		WHERE id = :id');

        $resultBill = $queryUpdt->execute([
            'number' => htmlspecialchars($_POST['number']),
            'services' => htmlspecialchars($_POST['services']),
            'amount' => htmlspecialchars($_POST['amount']),
            'date' => htmlspecialchars($_POST['date']),
            'status' => htmlspecialchars($_POST['status']),
            'bill' => htmlspecialchars($pdfBill),
            'user_id' => $_POST['users'],
            'id' => $_POST['id']
        ]);

        if ($pdfBill != $_POST['pdfExist']) {
            $pathPdf = '../assets/bills/';
            unlink($pathPdf . $recupBill['bill']);
            move_uploaded_file($_FILES['pdfBill']['tmp_name'], $destination);
        }
        if ($resultBill) {
            $_SESSION['message'] = 'Facture mise à jour !';
            header('location:bills-list.php');
            exit;
        } else {
            $_SESSION['message'] = 'Erreur.';
        }
    }
}

if (isset($_GET['bill_id']) && isset($_GET['action']) && $_GET['action'] == 'edit') {

    $queryBills = $db->prepare('SELECT * FROM bills WHERE id = ?');
    $queryBills->execute(array($_GET['bill_id']));
    $bill = $queryBills->fetch();

    $querySlc = $db->query('SELECT name, firstname, id FROM users');
    $listUsers = $querySlc->fetchAll();
}

if (isset($_GET['bill_id']) AND $_GET['bill_id'] !== $bill['id']) {
    header('Location:bills-list.php');
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
    <?php require_once('partials/nav.php'); ?>

    <div class="container-fluid col-xl-9 mt-3">
        <div class="card-body">
            <h4><?php if (isset($bill)): ?>Modifier<?php else: ?>Ajouter<?php endif; ?> une facture</h4>
            <?php if (isset($_GET['bill_id'])): ?>
            <form action="bills-form.php?bill_id=<?= $bill['id']; ?>&action=edit" method="post"
                  enctype="multipart/form-data">
                <?php else: ?>
                <form action="bills-form.php" method="post" enctype="multipart/form-data">
                    <?php endif; ?>
                    <div class="form-group">
                        <label for="number">Numéro de facture :<span class="text-danger">*</span></label>
                        <input class="form-control"
                               value="<?= isset($bill) ? htmlentities($bill['number']) : $number; ?>" type="number"
                               placeholder="Numéro" name="number" id="number"/>
                        <span class="text-danger"><?= isset($messages['number']) ? $messages['number'] : ''; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="services">Services :<span class="text-danger">*</span></label>
                        <input class="form-control"
                               value="<?= isset($bill) ? htmlentities($bill['services']) : $services; ?>" type="text"
                               placeholder="Services" name="services" id="services"/>
                        <span class="text-danger"><?= isset($messages['services']) ? $messages['services'] : ''; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="amount">Montant :<span class="text-danger">*</span></label>
                        <input class="form-control"
                               value="<?= isset($bill) ? htmlentities($bill['amount']) : $amount; ?>" type="number"
                               placeholder="Montant" name="amount" id="amount"/>
                        <span class="text-danger"><?= isset($messages['amount']) ? $messages['amount'] : ''; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="date">Date :<span class="text-danger">*</span></label>
                        <input class="form-control" value="<?= isset($bill) ? htmlentities($bill['date']) : $date; ?>"
                               type="date" placeholder="Date" name="date" id="date"/>
                        <span class="text-danger"><?= isset($messages['date']) ? $messages['date'] : ''; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="pdfBill">Facture :<span class="text-danger">*</span></label>
                        <input class="form-control" value="<?= isset($bill) ? htmlentities($bill['pdfBill']) : ''; ?>"
                               type="file" name="pdfBill" id="pdfBill">
                        <?php if (isset($bill['pdfBill']) AND !empty($bill['pdfBill'])): ?>
                            <img style="width: 50%;" class="img-fluid py-4"
                                 src="../assets/bills/<?= isset($bill) ? $bill['pdfBill'] : ''; ?>" alt="">
                        <?php endif; ?>
                        <span class="text-danger"><?= isset($messages['pdfBill']) ? $messages['pdfBill'] : ''; ?></span>
                        <span class="text-danger"><?= isset($messages['pdfBillExt']) ? $messages['pdfBillExt'] : ''; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="users">Utilisateurs : </label>
                        <select class="form-control" name="users" id="users">
                            <?php
                            $queryUsers = $db->query('SELECT * FROM users');
                            $users = $queryUsers->fetchAll();
                            ?>
                            <?php foreach ($users as $key => $user) : ?>
                                <option value="<?= $user['id']; ?>" <?= isset($bill) && $bill['user_id'] == $user['id'] ? 'selected' : ''; ?>> <?= $user['name'] . ' ' . $user['firstname']; ?> </option>
                            <?php endforeach; ?>
                        </select>
                        <span class="text-danger"><?= isset($messages['users']) ? $messages['users'] : ''; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="status">Statut ?</label>
                        <select class="form-control" name="status" id="status">
                            <option value="0" <?= isset($bill) && $bill['status'] == 0 ? 'selected' : ''; ?>>
                                Non
                            </option>
                            <option value="1" <?= isset($bill) && $bill['status'] == 1 ? 'selected' : ''; ?>>
                                Oui
                            </option>
                        </select>
                        <span class="text-danger"><?= isset($messages['status']) ? $messages['status'] : ''; ?></span>
                    </div>

                    <div class="text-right">
                        <?php if (isset($bill)): ?>
                            <input class="btn btn-success" type="submit" name="update" value="Mettre à jour"/>
                            <!-- Sinon on afficher un lien d'enregistrement d'un nouvel article -->
                        <?php else: ?>
                            <input class="btn btn-success" type="submit" name="save" value="Enregistrer"/>
                        <?php endif; ?>
                    </div>

                    <?php if (isset($bill)): ?>
                        <input type="hidden" name="id" value="<?= $bill['id']; ?>"/>
                        <input type="hidden" name="pdfExist" value="<?= $bill['bill']; ?>"/>
                    <?php endif; ?>


                </form>
        </div>
    </div>
</div>
<script src="../assets/js/jquery-3.3.1.min.js"></script>
<script src="../vendor/bootstrap-4.3.1/js/bootstrap.min.js"></script>
</body>
</html>