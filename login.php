<?php
session_start();
include 'db.php';

// Vérification si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Requête SQL pour vérifier les identifiants de l'utilisateur
    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['user'] = $username;
        header("Location: home.php");
    } else {
        echo "Identifiants incorrects.";
    }
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