<?php
session_start();
include 'connexion.php';

if (!empty($_POST['username']) && !empty($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $connexion->prepare($sql);
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            error_log($username);
            
            header('Location: /I-stock/vue/dashboard.php'); // Redirection vers le répertoire principal
            exit();
        } else {
            // Mot de passe incorrect
            header('Location: /I-stock/vue/Log/connect.php?error=Invalid username or password');
            exit();
        }
    } else {
        // Utilisateur non trouvé
        header('Location: /I-stock/vue/Log/connect.php?error=Invalid username or password');
        exit();
    }
} else {
    // Champs de formulaire vides
    header('Location: /I-stock/vue/Log/connect.php?error=Please fill in both fields');
    exit();
}

