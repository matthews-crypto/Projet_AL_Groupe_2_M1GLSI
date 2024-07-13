<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documentation de l'API REST</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            padding: 20px;
            background-color: #f9f9f9;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1, h2 {
            color: #333;
        }
        pre {
            background: #f4f4f4;
            padding: 10px;
            border-radius: 5px;
            overflow-x: auto;
        }
        code {
            font-family: "Courier New", Courier, monospace;
            color: #c7254e;
            background-color: #f9f2f4;
            padding: 2px 4px;
            border-radius: 4px;
        }
        .endpoint {
            margin-bottom: 20px;
        }
        .method {
            font-weight: bold;
            color: #007BFF;
        }
        .back-button {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .back-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
    <a href="index.php" class="back-button">Retour</a>
        <h1>Documentation de l'API REST</h1>
        <p>Bienvenue dans la documentation de l'API REST. Cette API vous permet de gérer les articles et de récupérer des informations en format JSON ou XML.</p>
        
        <h2>Endpoints JSON</h2>
        
        <div class="endpoint">
            <h3><span class="method">GET</span> /articles</h3>
            <p>Récupère tous les articles en format JSON.</p>
            <pre><code>curl -X GET http://localhost:8080/articles</code></pre>
            <p><strong>Exemple de réponse :</strong></p>
            <pre><code>
[
    {
    "id": 1,
    "titre": "Première victoire du Sénégal",
    "contenu": "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
    "dateCreation": "2024-05-23T08:11:00Z",
    "dateModification": "2024-05-23T08:11:00Z",
    "categorie": 1
  },
  {
    "id": 2,
    "titre": "Election en Mauritanie",
    "contenu": "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
    "dateCreation": "2024-05-23T08:11:00Z",
    "dateModification": "2024-05-23T08:11:00Z",
    "categorie": 4
  },
]
            </code></pre>
        </div>

        <div class="endpoint">
            <h3><span class="method">GET</span> /articles/categorized</h3>
            <p>Récupère tous les articles catégorisés en format JSON.</p>
            <pre><code>curl -X GET http://localhost:8080/articles/categorized</code></pre>
            <p><strong>Exemple de réponse :</strong></p>
            <pre><code>
{
    "Education"[
    {
      "id": 5,
      "titre": "Inauguration d'un ENO à l'UVS",
      "contenu": "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
      "dateCreation": "2024-05-23T08:11:00Z",
      "dateModification": "2024-05-23T08:11:00Z",
      "categorie": 3
    },
    {
      "id": 10,
      "titre": "Inauguration d'un ENO à l'UVS",
      "contenu": "L'Université Virtuelle du Sénégal inaugure un nouvel Espace Numérique Ouvert, offrant aux étudiants un accès amélioré aux ressources éducatives en ligne.",
      "dateCreation": "2024-05-23T08:11:00Z",
      "dateModification": "2024-05-23T08:11:00Z",
      "categorie": 3
    },
]}
            </code></pre>
        </div>

        <div class="endpoint">
            <h3><span class="method">GET</span> /articles/category/:categoryID</h3>
            <p>Récupère les articles par catégorie en format JSON.</p>
            <pre><code>curl -X GET http://localhost:8080/articles/category/1</code></pre>
            <p><strong>Exemple de réponse :</strong></p>
            <pre><code>
[
    {
    "id": 1,
    "titre": "Première victoire du Sénégal",
    "contenu": "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
    "dateCreation": "2024-05-23T08:11:00Z",
    "dateModification": "2024-05-23T08:11:00Z",
    "categorie": 1
  },
  {
    "id": 3,
    "titre": "Début de la CAN",
    "contenu": "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
    "dateCreation": "2024-05-23T08:11:00Z",
    "dateModification": "2024-05-23T08:11:00Z",
    "categorie": 1
  },
]
            </code></pre>
        </div>

        <h2>Endpoints XML</h2>
        
        <div class="endpoint">
            <h3><span class="method">GET</span> /xml/articles</h3>
            <p>Récupère tous les articles en format XML.</p>
            <pre><code>curl -X GET http://localhost:8080/xml/articles</code></pre>
            <p><strong>Exemple de réponse :</strong></p>
            <pre><code>
&lt;articles&gt;
    &lt;article&gt;
        &lt;id&gt;1&lt;/id&gt;
        &lt;title&gt;Titre de l'article&lt;/title&gt;
        &lt;content&gt;Contenu de l'article&lt;/content&gt;
    &lt;/article&gt;
&lt;/articles&gt;
            </code></pre>
        </div>

        <div class="endpoint">
            <h3><span class="method">GET</span> /xml/articles/categorized</h3>
            <p>Récupère tous les articles catégorisés en format XML.</p>
            <pre><code>curl -X GET http://localhost:8080/xml/articles/categorized</code></pre>
            <p><strong>Exemple de réponse :</strong></p>
            <pre><code>
&lt;categories&gt;
    &lt;category name="Actualités"&gt;
        &lt;article&gt;
            &lt;id&gt;1&lt;/id&gt;
            &lt;title&gt;Titre de l'article&lt;/title&gt;
            &lt;content&gt;Contenu de l'article&lt;/content&gt;
        &lt;/article&gt;
    &lt;/category&gt;
&lt;/categories&gt;
            </code></pre>
        </div>

        <div class="endpoint">
            <h3><span class="method">GET</span> /xml/articles/category/:categoryID</h3>
            <p>Récupère les articles par catégorie en format XML.</p>
            <pre><code>curl -X GET http://localhost:8080/xml/articles/category/1</code></pre>
            <p><strong>Exemple de réponse :</strong></p>
            <pre><code>
&lt;articles&gt;
    &lt;article&gt;
        &lt;id&gt;1&lt;/id&gt;
        &lt;title&gt;Titre de l'article&lt;/title&gt;
        &lt;content&gt;Contenu de l'article&lt;/content&gt;
    &lt;/article&gt;
&lt;/articles&gt;
            </code></pre>
        </div>
    </div>
</body>
</html>
