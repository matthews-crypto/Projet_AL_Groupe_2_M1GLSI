<?php
// Connexion à la base de données (à adapter avec vos paramètres)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mglsi_news";

// Création de la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialisation des variables
$login = $password = "";
$loginError = "";

// Traitement du formulaire de connexion
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST["login"];
    $password = $_POST["password"];

    // Requête SQL pour vérifier les identifiants
    $sql = "SELECT * FROM users WHERE login = '$login' AND mdp = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Récupérer le rôle de l'utilisateur
        $row = $result->fetch_assoc();
        $role = $row["role"];

        // Redirection en fonction du rôle
        if ($role == "admin") {
            header("Location: admin_page.php");
            exit;
        } elseif ($role == "editeur") {
            header("Location: views/editeur_page.php");
            exit;
        }
    } else {
        $loginError = "Identifiants incorrects. Veuillez réessayer.";
    }
}

// Fermer la connexion à la base de données
$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <title>Catégories</title>
    <style>
        /* Styles pour le pop-up */
        .modal {
            display: none; 
            position: fixed; 
            z-index: 1; 
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto; 
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4); 
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 400px;
            border-radius: 10px;
            text-align: center;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .modal-header,
        .modal-footer {
            padding: 10px;
        }

        .modal-body input {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
        }

        .modal-footer a {
            display: block;
            margin: 10px 0;
            color: blue;
            text-decoration: underline;
            cursor: pointer;
        }

        .error-message {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="conteneur">
        <a class="bouton-categorie" href="serviceWeb/index.php">Service WEB</a>
        <a class="bouton-categorie" id="loginBtn" href="#">Se connecter</a>
        <h1>ACTUALITES POLYTECHNICIENNES</h1>
        <a class="bouton-categorie" href="?categorie=accueil">Accueil</a>
        <?php foreach ($categories as $cat): ?>
            <a class="bouton-categorie" href="?categorie=<?= htmlspecialchars($cat['libelle']) ?>">
                <?= htmlspecialchars($cat['libelle']) ?>
            </a>
        <?php endforeach; ?>
        <h2>Dernières Actualités</h2>
    </div>

    <!-- Pop-up de connexion -->
    <div id="loginModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div class="modal-header">
                <h2>Connexion</h2>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <input type="text" id="login" name="login" placeholder="Login" required>
                    <input type="password" id="password" name="password" placeholder="Mot de passe" required>
                    <p class="error-message"><?php echo $loginError; ?></p>
                    <div class="modal-footer">
                        <button type="submit">Se connecter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Get the modal
        var loginModal = document.getElementById("loginModal");

        // Get the button that opens the modal
        var loginBtn = document.getElementById("loginBtn");

        // Get the <span> element that closes the modal
        var spans = document.getElementsByClassName("close");

        // When the user clicks the button, open the modal 
        loginBtn.onclick = function() {
            loginModal.style.display = "flex";
        }

        // When the user clicks on <span> (x), close the modal
        for (let span of spans) {
            span.onclick = function() {
                loginModal.style.display = "none";
            }
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == loginModal) {
                loginModal.style.display = "none";
            }
        }
    </script>
</body>
</html>
