<?php
require_once 'models/Database.php';
require_once 'models/Article.php';
require_once 'models/Category.php';

class ArticleController {
    public function displayHomePage() {
        $categories = Category::getAllCategories();
        $category = isset($_GET['categorie']) ? $_GET['categorie'] : 'accueil';
        $articles = Article::getArticlesByCategory($category);
        include 'views/categories.php';
        include 'views/articles.php';
    }

    public function displayArticleDetail() {
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $article = Article::getArticleById($_GET['id']);
            if ($article) {
                include 'views/detail.php';
            } else {
                echo "<p>Article non trouvé.</p>";
            }
        } else {
            echo "<p>ID d'article invalide.</p>";
        }
    }
}
?>
