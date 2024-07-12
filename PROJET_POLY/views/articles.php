<div id="articles">
    <?php foreach ($articles as $article): ?>
        <div class='article'>
            <h2><a href='index.php?action=detail&id=<?= htmlspecialchars($article['id']) ?>'>
                <?= htmlspecialchars($article['titre']) ?>
            </a></h2>
            <p><?= nl2br(htmlspecialchars($article['contenu'])) ?></p>
            <p>Date de création : <?= htmlspecialchars($article['dateCreation']) ?></p>
            <p>Catégorie : <?= htmlspecialchars($article['categorieLibelle']) ?></p>
        </div>
    <?php endforeach; ?>
</div>
