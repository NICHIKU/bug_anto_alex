-- Création de la base de données et de la table des utilisateurs
CREATE DATABASE mini_site;
USE mini_site;

-- Création de la table des utilisateurs avec des champs pour l'identifiant, le nom d'utilisateur et le mot de passe
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL -- Mot de passe stocké en clair (non sécurisé)
);

-- Insertion d'un utilisateur de test
INSERT INTO users (username, password) VALUES ('testuser', 'password123');