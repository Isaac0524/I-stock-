<?php
session_start();
include 'connexion.php';

if (
    !empty($_GET['idVente']) &&
    !empty($_GET['idArticle']) &&
    !empty($_GET['quantite'])
) {

    $sql = "UPDATE vente SET etat = ? WHERE id = ?";
    $req = $connexion->prepare($sql);
    $req->execute(array(0, $_GET['idVente']));

    if ($req->rowCount() != 0) {
        $sql = "UPDATE article SET quantite = quantite + ? WHERE id = ?";
        $req = $connexion->prepare($sql);
        $req->execute(array($_GET['quantite'], $_GET['idArticle']));

        if ($req->rowCount() != 0) {
            $_SESSION['message']['text'] = "Vente annulée avec succès";
            $_SESSION['message']['type'] = "success";
        } else {
            $_SESSION['message']['text'] = "Impossible de mettre à jour la quantité de l'article";
            $_SESSION['message']['type'] = "danger";
        }
    } else {
        $_SESSION['message']['text'] = "Impossible d'annuler la vente";
        $_SESSION['message']['type'] = "danger";
    }

} else {
    $_SESSION['message']['text'] = "Une information obligatoire non renseignée";
    $_SESSION['message']['type'] = "danger";
}

header('Location: ../vue/vente.php');
exit();

