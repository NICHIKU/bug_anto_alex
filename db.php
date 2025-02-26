<?php
// Connexion à la base de données
$conn = mysqli_connect("localhost", "root", "root", "mini_site","8889");
if (!$conn) {
    // Affichage d'un message d'erreur si la connexion échoue
    die("Connexion échouée : " . mysqli_connect_error());
}
?>