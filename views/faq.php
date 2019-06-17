<main class="marginTop">
    <section class="container">
        <div class="background widthContainer">
            <h2>FAQ</h2>
            <?php if ($questions): ?>
                <?php foreach ($cat as $category): ?>
                    <h2 class="nameCat"><?= $category['catName']; ?> :</h2>
                    <?php foreach ($questions as $question): ?>
                        <?php if ($category['id'] == $question['category_id']): ?>
                            <button class="collapsible"><?= $question['question']; ?></button>
                            <div class="content">
                                <p><?= $question['response']; ?></p>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="textCenter">Aucune question disponible !</p>
            <?php endif; ?>
        </div>
    </section>
</main>