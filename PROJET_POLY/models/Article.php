<?php
class Article {
    public static function getArticlesByCategory($category) {
        $pdo = Database::getInstance();
        $query = "SELECT Article.*, Categorie.libelle as categorieLibelle FROM Article 
                  JOIN Categorie ON Article.categorie = Categorie.id";
        if ($category !== 'accueil') {
            $query .= " WHERE Categorie.libelle = :category";
        }
        $query .= " ORDER BY dateCreation DESC";

        $stmt = $pdo->prepare($query);
        if ($category !== 'accueil') {
            $stmt->bindParam(':category', $category);
        }
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getArticleById($id) {
        $pdo = Database::getInstance();
        $query = "SELECT Article.*, Categorie.libelle as categorieLibelle FROM Article 
                  JOIN Categorie ON Article.categorie = Categorie.id
                  WHERE Article.id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
