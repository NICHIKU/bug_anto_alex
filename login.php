<?php
session_start();
include 'db.php';

// Vérification si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Préparation de la requête SQL avec des placeholders (?)
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
    // Exécution de la requête
    $stmt->execute(['username' => $username, 'password' => $password]);
    // Récupération du résultat pour compter le nombre de lignes
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // S’il y a au moins une ligne, l’utilisateur existe avec ce couple (username, password)
        $_SESSION['user'] = $username;
        header("Location: home.php");
        exit;
    } else {
        echo "Identifiants incorrects.";
    }

    // Fermeture de la requête préparée
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
        <!-- Formulaire de connexion -->
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