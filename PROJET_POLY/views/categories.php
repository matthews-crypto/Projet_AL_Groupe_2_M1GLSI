<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <title>Catégories</title>
</head>
<body>
    <div class="conteneur">
        <h1>ACTUALITES POLYTECHNICIENNES</h1>
        <a class="bouton-categorie" href="?categorie=accueil">Accueil</a>
        <?php foreach ($categories as $cat): ?>
            <a class="bouton-categorie" href="?categorie=<?= htmlspecialchars($cat['libelle']) ?>">
                <?= htmlspecialchars($cat['libelle']) ?>
            </a>
        <?php endforeach; ?>
        <h2>Dernières Actualités</h2>
    </div>
</body>
</html>
