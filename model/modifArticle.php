<?php
session_start();

include 'connexion.php';
include 'function.php';

if (
    !empty($_POST['id'])
    && !empty($_POST['nom_article'])
    && !empty($_POST['id_categorie'])
    && !empty($_POST['quantite'])
    && !empty($_POST['prix_unitaire'])
) {
    // Récupérer l'article actuel pour obtenir l'image actuelle si aucune nouvelle image n'est téléchargée
    $article = getArticle($_POST['id']);
    $destination = $article['images'];

    if (!empty($_FILES['images']['name'])) {
        $name = $_FILES['images']['name'];
        $tmp_name = $_FILES['images']['tmp_name'];
        $destination = "../public/images/$name";

        if (!is_dir('../public/images/')) {
            mkdir('../public/images/', 0777, true);
        }

        if (!move_uploaded_file($tmp_name, $destination)) {
            $_SESSION['message']['text'] = "Une erreur s'est produite lors de l'importation de l'image de l'article";
            $_SESSION['message']['type'] = "danger";
            header('Location: ../vue/article.php');
            exit();
        }
    }

    $sql = "UPDATE article 
            SET nom_article = ?, id_categorie = ?, quantite = ?, prix_unitaire = ?, images = ?
            WHERE id = ?";
    $req = $connexion->prepare($sql);

    $req->execute([
        $_POST['nom_article'],
        $_POST['id_categorie'],
        $_POST['quantite'],
        $_POST['prix_unitaire'],
        $destination,
        $_POST['id']
    ]);

    if ($req->rowCount() != 0) {
        $_SESSION['message']['text'] = "Article modifié avec succès";
        $_SESSION['message']['type'] = "success";
    } else {
        $_SESSION['message']['text'] = "Une erreur s'est produite lors de la modification de l'article";
        $_SESSION['message']['type'] = "danger";
    }
} else {
    $_SESSION['message']['text'] = "Une information obligatoire non renseignée";
    $_SESSION['message']['type'] = "danger";
}

header('Location: ../vue/article.php');
exit();
