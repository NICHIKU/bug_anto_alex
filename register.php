<?php
session_start();
include 'db.php'; // Assurez-vous que $conn est une connexion MySQLi

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($username === '' || $password === '') {
        $message = "Veuillez remplir tous les champs.";
    } else {
        // 1️⃣ Vérifier si l'utilisateur existe déjà
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
        if ($stmt) {
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $message = "Le nom d'utilisateur '$username' est déjà utilisé.";
            } else {
                // 2️⃣ Insérer le nouvel utilisateur
                $stmtInsert = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
                if ($stmtInsert) {
                    $stmtInsert->bind_param("ss", $username, $password);
                    if ($stmtInsert->execute()) {
                        $message = "Inscription réussie. Vous pouvez maintenant vous connecter.";
                    } else {
                        $message = "Erreur lors de l'insertion : " . $conn->error;
                    }
                    $stmtInsert->close();
                } else {
                    $message = "Erreur préparation requête INSERT : " . $conn->error;
                }
            }

            $stmt->close();
        } else {
            $message = "Erreur préparation requête SELECT : " . $conn->error;
        }
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

        <form method="POST" class="register-form">
            <input type="text" name="username" placeholder="Nom d'utilisateur" required class="register-input">
            <input type="password" name="password" placeholder="Mot de passe" required class="register-input">
            <button type="submit" class="register-button">S'inscrire</button>
        </form>

        <?php if ($message): ?>
            <p class="register-message"><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>

        <a href="login.php" class="register-link">Déjà inscrit ? Connectez-vous</a>
    </div>
</body>

</html>