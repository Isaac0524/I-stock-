<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once '../model/function.php';

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $username = $_SESSION['username'];
} else {
    // Si l'utilisateur n'est pas connecté, vous pouvez rediriger vers la page de connexion ou prendre une autre action
    header('Location: /I-stock/vue/Log/connect.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta charset="UTF-8" />
    <link rel="icon" href="../public/images/stock.png" type="image/x-icon" />
    <title>
        <?php
        echo ucfirst(str_replace(".php", "", basename($_SERVER['PHP_SELF'])));
        ?>
    </title>
    <link rel="stylesheet" href="../public/css/style.css" />
    <!-- Boxicons CDN Link -->
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
    <div class="sidebar hidden-print">
        <div class="logo-details">
            <i class="bx bxl-c-plus-plus"></i>
            <span class="logo_name">I STOCK</span>
        </div>
        <ul class="nav-links">
            <li>
                <a href="dashboard.php" class="<?php echo basename($_SERVER['PHP_SELF']) == "dashboard.php" ? "active" : "" ?>">
                    <i class="bx bx-grid-alt"></i>
                    <span class="links_name">Accueil</span>
                </a>
            </li>
            <li>
                <a href="vente.php" class="<?php echo basename($_SERVER['PHP_SELF']) == "vente.php" ? "active" : "" ?>">
                    <i class='bx bx-shopping-bag'></i>
                    <span class="links_name">Vente</span>
                </a>
            </li>
            <li>
                <a href="client.php" class="<?php echo basename($_SERVER['PHP_SELF']) == "client.php" ? "active" : "" ?>">
                    <i class="bx bx-user"></i>
                    <span class="links_name">Client</span>
                </a>
            </li>
            <li>
                <a href="article.php" class="<?php echo basename($_SERVER['PHP_SELF']) == "article.php" ? "active" : "" ?>">
                    <i class="bx bx-box"></i>
                    <span class="links_name">Stock</span>
                </a>
            </li>
            <li>
                <a href="fournisseur.php" class="<?php echo basename($_SERVER['PHP_SELF']) == "fournisseur.php" ? "active" : "" ?>">
                    <i class="bx bx-user"></i>
                    <span class="links_name">Fournisseur</span>
                </a>
            </li>
            <li>
                <a href="commande.php" class="<?php echo basename($_SERVER['PHP_SELF']) == "commande.php" ? "active" : "" ?>">
                    <i class="bx bx-list-ul"></i>
                    <span class="links_name">Commandes</span>
                </a>
            </li>
            <li>
                <a href="categorie.php" class="<?php echo basename($_SERVER['PHP_SELF']) == "categorie.php" ? "active" : "" ?>">
                    <i class="bx bx-list-ul"></i>
                    <span class="links_name">Catégorie</span>
                </a>
            </li>
        </ul>
    </div>
    <section class="home-section">
        <nav class="hidden-print">
            <div class="sidebar-button">
                <i class="bx bx-menu sidebarBtn"></i>
                <span class="dashboard">
                    <?php
                    echo ucfirst(str_replace(".php", "", basename($_SERVER['PHP_SELF'])));
                    ?>
                </span>
            </div>
            <div class="profile-details">
                <a href="#" class="user-icon">
                    <i class='bx bx-user'></i>
                </a>
                <span class="user-name m-3">
                    <?php echo $username; 
                         echo "--"// Affiche le nom d'utilisateur ?>
                </span> 
                <a href="../model/logout.php" class="logout-icon">
                    <i class='bx bx-log-out'></i>
                </a>
            </div>
        </nav>
