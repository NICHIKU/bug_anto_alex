<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");

    if (!$stmt) {
        die("Erreur de préparation SQL : " . $conn->error);
    }

    // Associer les variables aux placeholders
    $stmt->bind_param("ss", $username, $password);

    // Exécuter la requête
    $stmt->execute();

    // Récupérer le résultat
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['user'] = $username;
        header("Location: home.php");
        exit;
    } else {
        echo "Identifiants incorrects.";
    }

    // Fermer la requête préparée
    $stmt->close();
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Connexion</title>
    <link rel="stylesheet" href="css/login.css">
</head>

<body class="login-body">
    <div class="login-container">
        <h1 class="login-title">Connexion</h1>
        <form method="POST" class="login-form">
            <input type="text" name="username" placeholder="Nom d'utilisateur" required class="login-input">
            <input type="password" name="password" placeholder="Mot de passe" required class="login-input">
            <button type="submit" class="login-button">Se connecter</button>
        </form>
        <br>
        <a href="index.php" class="login-link">Retour à l'accueil</a>
        <br>
        <a href="register.php" class="login-link">Pas encore inscrit ? Inscrivez-vous</a>
    </div>
</body>

</html>