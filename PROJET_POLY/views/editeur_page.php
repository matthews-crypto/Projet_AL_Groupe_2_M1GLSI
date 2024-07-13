<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mglsi_news";

// Créer la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ajouter un article
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_article'])) {
    $titre = $_POST['titre'];
    $contenu = $_POST['contenu'];
    $categorie = $_POST['categorie'];
    $sql = "INSERT INTO Article (titre, contenu, categorie) VALUES ('$titre', '$contenu', '$categorie')";
    $conn->query($sql);
}

// Supprimer un article
if (isset($_GET['delete_article'])) {
    $id = $_GET['delete_article'];
    $sql = "DELETE FROM Article WHERE id=$id";
    $conn->query($sql);
}

// Modifier un article
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_article'])) {
    $id = $_POST['id'];
    $titre = $_POST['titre'];
    $contenu = $_POST['contenu'];
    $categorie = $_POST['categorie'];
    $sql = "UPDATE Article SET titre='$titre', contenu='$contenu', categorie='$categorie', dateModification=NOW() WHERE id=$id";
    $conn->query($sql);
}

// Ajouter une catégorie
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_categorie'])) {
    $libelle = $_POST['libelle'];
    $sql = "INSERT INTO Categorie (libelle) VALUES ('$libelle')";
    $conn->query($sql);
}

// Supprimer une catégorie
if (isset($_GET['delete_categorie'])) {
    $id = $_GET['delete_categorie'];
    $sql = "DELETE FROM Categorie WHERE id=$id";
    $conn->query($sql);
}

// Modifier une catégorie
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_categorie'])) {
    $id = $_POST['id'];
    $libelle = $_POST['libelle'];
    $sql = "UPDATE Categorie SET libelle='$libelle' WHERE id=$id";
    $conn->query($sql);
}

// Récupérer les articles
$selectedCategorie = isset($_GET['categorie']) ? $_GET['categorie'] : '';
$sql = "SELECT * FROM Article" . ($selectedCategorie ? " WHERE categorie=$selectedCategorie" : '');
$articles = $conn->query($sql);

// Récupérer les catégories
$sql = "SELECT * FROM Categorie";
$categories = $conn->query($sql);

// Récupérer l'article à modifier
$editArticle = null;
if (isset($_GET['edit_article'])) {
    $id = $_GET['edit_article'];
    $sql = "SELECT * FROM Article WHERE id=$id";
    $result = $conn->query($sql);
    $editArticle = $result->fetch_assoc();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gestion des Articles et Catégories</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        nav ul {
            list-style-type: none;
            padding: 0;
        }
        nav ul li {
            display: inline;
            margin-right: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        form {
            margin-top: 20px;
        }
        input, textarea, select {
            margin: 5px 0;
            padding: 10px;
            width: 100%;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: auto;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <nav>
        <ul>
            <li><a href="index.php">Tous les articles</a></li>
            <?php while($row = $categories->fetch_assoc()): ?>
                <li><a href="?categorie=<?php echo $row['id']; ?>"><?php echo $row['libelle']; ?></a></li>
            <?php endwhile; ?>
        </ul>
    </nav>

    <h1>Gestion des Articles et Catégories</h1>
    <table>
        <tr>
            <th>Titre</th>
            <th>Contenu</th>
            <th>Catégorie</th>
            <th>Date de Création</th>
            <th>Date de Modification</th>
            <th>Actions</th>
        </tr>
        <?php while($row = $articles->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['titre']; ?></td>
                <td><?php echo $row['contenu']; ?></td>
                <td><?php echo $row['categorie']; ?></td>
                <td><?php echo $row['dateCreation']; ?></td>
                <td><?php echo $row['dateModification']; ?></td>
                <td>
                    <a href="?edit_article=<?php echo $row['id']; ?>">Modifier</a>
                    <a href="?delete_article=<?php echo $row['id']; ?>">Supprimer</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

    <?php if ($editArticle): ?>
        <h2>Modifier l'Article</h2>
        <form method="POST">
            <input type="hidden" name="id" value="<?php echo $editArticle['id']; ?>">
            <input type="text" name="titre" placeholder="Titre" value="<?php echo $editArticle['titre']; ?>" required>
            <textarea name="contenu" placeholder="Contenu" required><?php echo $editArticle['contenu']; ?></textarea>
            <select name="categorie" required>
                <?php 
                $categories->data_seek(0); // Reset the pointer to the beginning
                while($row = $categories->fetch_assoc()): ?>
                    <option value="<?php echo $row['id']; ?>" <?php echo $row['id'] == $editArticle['categorie'] ? 'selected' : ''; ?>><?php echo $row['libelle']; ?></option>
                <?php endwhile; ?>
            </select>
            <input type="submit" name="edit_article" value="Modifier">
        </form>
    <?php else: ?>
        <h2>Ajouter un Article</h2>
        <form method="POST">
            <input type="text" name="titre" placeholder="Titre" required>
            <textarea name="contenu" placeholder="Contenu" required></textarea>
            <select name="categorie" required>
                <?php 
                $categories->data_seek(0); // Reset the pointer to the beginning
                while($row = $categories->fetch_assoc()): ?>
                    <option value="<?php echo $row['id']; ?>"><?php echo $row['libelle']; ?></option>
                <?php endwhile; ?>
            </select>
            <input type="submit" name="add_article" value="Ajouter">
        </form>
    <?php endif; ?>

    <h2>Ajouter une Catégorie</h2>
    <form method="POST">
        <input type="text" name="libelle" placeholder="Libellé" required>
        <input type="submit" name="add_categorie" value="Ajouter">
    </form>
</body>
</html>
