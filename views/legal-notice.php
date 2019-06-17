<main class="marginTop">
    <section class="container">
        <div class="background widthContainer">
            <h2 class="marginBottom">Mentions légales</h2>
            <?php foreach ($notices as $notice): ?>
                <div style="margin-top: 15px; margin-bottom: 15px;">
                    <h3 class="blue"><?= htmlentities($notice['title']); ?></h3>
                    <p><?= htmlentities($notice['content']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</main>