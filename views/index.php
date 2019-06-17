<main>
    <section class="sectionOne container">
        <h1>Ville de montreuil</h1>
    </section>
    <section class="sectionTwo">
        <div class="background info">
            <h2 class="blue marginBottom"><?= htmlentities($infos['title']); ?></h2>
            <p><?= htmlentities($infos['content']); ?></p>
        </div>

        <div class="background containerCarousel">
            <h2 class="blue">Découvrez les derniers événements</h2>
            <br>
            <div id="carousel" class="slideshowContainer" style="position:relative;">
                <div>
                    <?php for ($i = 0; $i < sizeof($events); $i++): ?>
                        <span class="dot" onclick="currentSlide(-1)"></span>
                    <?php endfor; ?>
                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>
                <?php foreach ($events as $key => $event): ?>
                    <div class="mySlides fade">
                        <img class="img" src="assets/img/events/<?= $event['image']; ?>" alt="" id="image">
                        <div id="infoEventCar">
                        <h3 class="blue"><?= $event['title']; ?></h3>
                        <p><?= $event['summary']; ?></p>
                        <a href="index.php?page=events&event_id=<?= $event['id']; ?>" class="blue">Lire l'événement</a></div>
                    </div>
                <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
</main>