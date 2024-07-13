<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choisir une API</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
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
        .container {
            display: flex;
            width: 80%;
            max-width: 800px;
            justify-content: space-between;
        }
        .column {
            flex: 1;
            margin: 10px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s, background-color 0.3s;
        }
        .column:hover {
            transform: translateY(-10px);
            background-color: #e0e0e0;
            cursor: pointer;
        }
        .column h2 {
            margin: 0;
            font-size: 24px;
        }
        .column p {
            margin: 10px 0 0;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <a href="../index.php" class="back-button">Retour</a>
    <div class="container">
        <div class="column" onclick="location.href='rest.php'">
            <h2>API REST</h2>
            <p>Elle permet d'avoir accès à nos articles</p>
        </div>
        <div class="column" onclick="location.href='soap.php'">
            <h2>API SOAP</h2>
            <p>Elle permet d'effectuer une gestion des utilisateurs efficace</p>
        </div>
    </div>
</body>
</html>
