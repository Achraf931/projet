<div id="bgDark" class="containerImgGallery">
    <img src="" class="imgOn" alt="">
</div>
<main class="marginTop">
    <section class="container">
        <div class="background widthContainer">
            <h2 class="blue"><?= $event['title']; ?></h2>
            <p><?= strftime("%A %e %B %Y", strtotime($event['published_at'])); ?></p>
            <img class="img objectFit" src="assets/img/events/<?= $event['image']; ?>" alt="">
            <span style="margin-bottom: 20px"><?= $event['content']; ?></span>
            <?php if ($images): ?>
                <h2>Images :</h2>
                <div class="row">
                    <?php foreach ($images as $image): ?>
                        <div class="tile">
                            <div class="tileMedia">
                                <img class="tileImg" src="./assets/img/events/<?= $image['name']; ?>" alt="">
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <?php if ($event['video']): ?>
                <h2 class="marginBottom">Vidéos :</h2>
                <?= $event['video']; ?>
            <?php endif; ?>
            <a href="index.php?page=events-list">
                <p class="blue" style="font-family: GilroySemiBold; margin-top: 20px;"><i class="fal fa-chevron-left"></i> Retour</p>
            </a>
        </div>
    </section>
</main>