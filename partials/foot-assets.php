<script rel="stylesheet" src="assets/js/burger.js"></script>
<?php if (!isset($_GET['page'])): ?>
    <script rel="stylesheet" src="assets/js/carousel.js"></script>
<?php endif; ?>
<?php if (isset($_GET['page']) AND $_GET['page'] == 'events-list'): ?>
    <script rel="stylesheet" src="assets/js/event-list.js"></script>
<?php endif; ?>
<?php if (isset($_GET['page']) AND $_GET['page'] == 'events'): ?>
    <script rel="stylesheet" src="assets/js/openImg.js"></script>
<?php endif; ?>
<?php if (isset($_GET['page']) AND $_GET['page'] == 'services'): ?>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDXc0ovTOaLOiIg85yCCB4zMENcwjKncmo&libraries=places&callback=initMap" async defer></script>
    <script rel="stylesheet" src="assets/js/map.js"></script>
<?php endif; ?>
<?php if (isset($_GET['page']) AND $_GET['page'] == 'faq'): ?>
    <script rel="stylesheet" src="assets/js/faq.js"></script>
<?php endif; ?>
<?php if (!isset($_SESSION['user'])): ?>
    <script rel="stylesheet" src="assets/js/connexion.js"></script>
<?php endif; ?>
<?php if (isset($_GET['page']) AND $_GET['page'] == 'contact'): ?>
    <script rel="stylesheet" src="assets/js/contact.js"></script>
<?php endif; ?>