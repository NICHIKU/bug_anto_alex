<?php
session_start();

// Redirection vers la page de connexion si l'utilisateur n'est pas connecté
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Accueil Connecté</title>
    <link rel="stylesheet" href="css/home.css">
</head>
<body class="home-body">
    <div class="home-container">
        <!-- Affichage d'un message de bienvenue avec le nom de l'utilisateur -->
        <h1 class="home-title">Bienvenue, <?php echo $_SESSION['user']; ?> !</h1>
        <a href="logout.php" class="home-link">Déconnexion</a>
    </div>
</body>
</html>