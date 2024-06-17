<?php
session_start();
include 'connexion.php';
include 'function.php';
try {

    // Vérifier si le formulaire est soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hachage du mot de passe

        // Préparer et exécuter la requête d'insertion
        $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        header("Location: ../vue/Log/connect.php");
    }
} catch(PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}
header("../vue/Log/connect.php");