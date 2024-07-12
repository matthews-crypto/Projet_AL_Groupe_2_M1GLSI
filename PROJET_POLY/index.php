<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title><?= htmlspecialchars($article['titre']) ?></title>
</head>
<body>
<?php
require 'controllers/ArticleController.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'home';
$controller = new ArticleController();

if ($action == 'home') {
    $controller->displayHomePage();
} elseif ($action == 'detail') {
    $controller->displayArticleDetail();
} else {
    echo "<p>Action non reconnue.</p>";
}
?>
</body>
</html>