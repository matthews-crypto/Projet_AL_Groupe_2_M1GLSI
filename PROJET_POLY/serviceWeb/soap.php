<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documentation de l'API SOAP</title>
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
        <h1>Documentation de l'API SOAP</h1>
        <p>Bienvenue dans la documentation de l'API SOAP. Cette API vous permet de gérer les utilisateurs et de récupérer des informations en format JSON.</p>
        
        <h2>Endpoints Publics</h2>
        
        <div class="endpoint">
            <h3><span class="method">GET</span> /</h3>
            <p>Affiche un message de bienvenue.</p>
            <pre><code>curl -X GET http://localhost:1323/</code></pre>
            <p><strong>Exemple de réponse :</strong></p>
            <pre><code>Hello, World!</code></pre>
        </div>

        <div class="endpoint">
            <h3><span class="method">GET</span> /login</h3>
            <p>Authentifie un utilisateur et génère un token JWT.</p>
            <pre><code>curl -X GET "http://localhost:1323/login?username=admin&password=admin"</code></pre>
            <p><strong>Exemple de réponse :</strong></p>
            <pre><code>
{
    "token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
}
            </code></pre>
        </div>

        <h2>Endpoints Restreints</h2>
        
        <div class="endpoint">
            <h3><span class="method">GET</span> /restricted/users</h3>
            <p>Récupère la liste des utilisateurs. Nécessite un token JWT.</p>
            <pre><code>curl -X GET -H "Authorization: Bearer [token]" http://localhost:1323/restricted/users</code></pre>
            <p><strong>Exemple de réponse :</strong></p>
            <pre><code>
[
    {
        "id": 1,
        "username": "admin",
        "password": "admin"
    }
]
            </code></pre>
        </div>

        <div class="endpoint">
            <h3><span class="method">POST</span> /restricted/users</h3>
            <p>Ajoute un nouvel utilisateur. Nécessite un token JWT.</p>
            <pre><code>curl -X POST -H "Authorization: Bearer [token]" -d '{"username": "newuser", "password": "newpassword"}' http://localhost:1323/restricted/users</code></pre>
            <p><strong>Exemple de réponse :</strong></p>
            <pre><code>
{
    "id": 2,
    "username": "newuser",
    "password": "newpassword"
}
            </code></pre>
        </div>

        <div class="endpoint">
            <h3><span class="method">PUT</span> /restricted/users/:id</h3>
            <p>Met à jour un utilisateur existant. Nécessite un token JWT.</p>
            <pre><code>curl -X PUT -H "Authorization: Bearer [token]" -d '{"username": "updateduser", "password": "updatedpassword"}' http://localhost:1323/restricted/users/1</code></pre>
            <p><strong>Exemple de réponse :</strong></p>
            <pre><code>
{
    "id": 1,
    "username": "updateduser",
    "password": "updatedpassword"
}
            </code></pre>
        </div>

        <div class="endpoint">
            <h3><span class="method">DELETE</span> /restricted/users/:id</h3>
            <p>Supprime un utilisateur existant. Nécessite un token JWT.</p>
            <pre><code>curl -X DELETE -H "Authorization: Bearer [token]" http://localhost:1323/restricted/users/1</code></pre>
        </div>

        <div class="endpoint">
            <h3><span class="method">GET</span> /restricted/authenticate</h3>
            <p>Authentifie un utilisateur en utilisant un token JWT.</p>
            <pre><code>curl -X GET -H "Authorization: Bearer [token]" "http://localhost:1323/restricted/authenticate?username=admin&password=admin"</code></pre>
            <p><strong>Exemple de réponse :</strong></p>
            <pre><code>
"Authentication successful"
            </code></pre>
        </div>
    </div>
</body>
</html>
