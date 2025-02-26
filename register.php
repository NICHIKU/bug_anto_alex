<?php
session_start();
include 'db.php';

$message = '';

// Vérification si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Vérification si l'utilisateur existe déjà
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    // Insertion du nouvel utilisateur dans la base de données
    $query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    if (mysqli_query($conn, $query)) {
        $message = "Inscription réussie. Vous pouvez maintenant vous connecter.";
    } else {
        $message = "Erreur : " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Inscription</title>
    <link rel="stylesheet" href="css/register.css">
</head>

<body class="register-body">
    <div class="register-container">
        <h1 class="register-title">Inscription</h1>
        <!-- Formulaire d'inscription -->
        <form method="POST" class="register-form">
            <input type="text" name="username" placeholder="Nom d'utilisateur" required class="register-input">
            <input type="password" name="password" placeholder="Mot de passe" required class="register-input">
            <button type="submit" class="register-button">S'inscrire</button>
        </form>
        
        <?php if ($message): ?>
            <p class="register-message"><?php echo $message; ?></p>
        <?php endif; ?>
        
        <a href="login.php" class="register-link">Déjà inscrit ? Connectez-vous</a>
    </div>
</body>
</html>