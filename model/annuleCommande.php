<?php
session_start();
include 'connexion.php';

if (
    !empty($_GET['idCommande']) &&
    !empty($_GET['idArticle']) &&
    !empty($_GET['quantite'])
) {
    $connexion->beginTransaction();

    $sql = "UPDATE Commande SET etat = ? WHERE id = ?";
    $req = $connexion->prepare($sql);
    $req->execute(array(0, $_GET['idCommande']));

    if ($req->rowCount() != 0) {
        $sql = "UPDATE article SET quantite = quantite + ? WHERE id = ?";
        $req = $connexion->prepare($sql);
        $req->execute(array($_GET['quantite'], $_GET['idArticle']));

        if ($req->rowCount() != 0) {
            $connexion->commit();
            $_SESSION['message']['text'] = "Commande annulée avec succès";
            $_SESSION['message']['type'] = "success";
        } else {
            $connexion->rollBack();
            $_SESSION['message']['text'] = "Impossible de mettre à jour la quantité de l'article";
            $_SESSION['message']['type'] = "danger";
        }
    } else {
        $connexion->rollBack();
        $_SESSION['message']['text'] = "Impossible d'annuler la commande";
        $_SESSION['message']['type'] = "danger";
    }
} else {
    $_SESSION['message']['text'] = "Une information obligatoire non renseignée";
    $_SESSION['message']['type'] = "danger";
}

header('Location: ../vue/Commande.php');
exit();

