<?php
class Category {
    public static function getAllCategories() {
        $pdo = Database::getInstance();
        $query = "SELECT * FROM Categorie";
        $stmt = $pdo->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
