<?php
session_start();
// Effacer les variables de session et redirection vers la page d'accueil
unset($_SESSION['id']);
header("Location: index.php");
exit;
?>