<main class="marginTop">
    <section class="container flexRow">
        <div class="background widthContainer">
            <h2>Services de la ville</h2>
            <div class="containEvents">
                <?php foreach ($services as $service): ?>
                    <a href="#map">
                        <div class="event" data-address="<?= $service['address']; ?>"
                             data-schedule="<?= $service['schedule']; ?>" data-name="<?= $service['name']; ?>"
                             data-lat="<?= $service['lat']; ?>" data-long="<?= $service['long']; ?>">
                            <img class="img" src="assets/img/services/<?= $service['image']; ?>" alt="">
                            <h3 id="title"><?= $service['name']; ?></h3>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
        <div id="map" class="background widthContainer"></div>
    </section>
</main>