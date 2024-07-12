<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title><?= htmlspecialchars($article['titre']) ?></title>
</head>
<body>
    <div class="conteneur">
        <h1><?= htmlspecialchars($article['titre']) ?></h1>
        <p><?= nl2br(htmlspecialchars($article['contenu'])) ?></p>
        <p>Date de création : <?= htmlspecialchars($article['dateCreation']) ?></p>
        <p>Catégorie : <?= htmlspecialchars($article['categorieLibelle']) ?></p>
        <a href="index.php" class="bouton-categorie">Retour à l'accueil</a>
    </div>
</body>
</html>
