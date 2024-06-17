<?php
include 'connexion.php';

function getArticle($id = null, $searchDATA = array(), $limit = null, $offset = null)
{
    $pagination = "";
    if (!empty($limit) && (!empty($offset) || $offset == 0)) {
        $pagination = " LIMIT $limit OFFSET $offset";
    }
    if (!empty($id)) {
        $sql = "SELECT a.id AS id, id_categorie, nom_article, libelle_categorie, quantite, prix_unitaire, images
        FROM article AS a, categorie_article AS c WHERE a.id=? AND c.id=a.id_categorie";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute(array($id));

        return $req->fetch();
    } elseif (!empty($searchDATA)) {
        $search = "";
        extract($searchDATA);
        if (!empty($nom_article)) $search .= " AND a.nom_article LIKE '%$nom_article%' ";
        if (!empty($id_categorie)) $search .= " AND a.id_categorie = $id_categorie ";
        if (!empty($quantite)) $search .= " AND a.quantite = $quantite ";
        if (!empty($prix_unitaire)) $search .= " AND a.prix_unitaire = $prix_unitaire ";

        $sql = "SELECT a.id AS id, id_categorie, nom_article, libelle_categorie, quantite, prix_unitaire, images
        FROM article AS a, categorie_article AS c WHERE c.id=a.id_categorie $search $pagination";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute();

        return $req->fetchAll();
    } else {
        $sql = "SELECT a.id AS id, id_categorie, nom_article, libelle_categorie, quantite, prix_unitaire, images
        FROM article AS a, categorie_article AS c WHERE c.id=a.id_categorie $pagination";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute();
        return $req->fetchAll();
    }
}

function countArticle($searchDATA = array())
{

   if (!empty($searchDATA)) {
        $search = "";
        extract($searchDATA);
        if (!empty($nom_article)) $search .= " AND a.nom_article LIKE '%$nom_article%' ";
        if (!empty($id_categorie)) $search .= " AND a.id_categorie = $id_categorie ";
        if (!empty($quantite)) $search .= " AND a.quantite = $quantite ";
        if (!empty($prix_unitaire)) $search .= " AND a.prix_unitaire = $prix_unitaire ";

        $sql = "SELECT COUNT(*) AS total FROM article AS a, categorie_article AS c WHERE c.id=a.id_categorie $search";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute();

        return $req->fetch();
    } else {
        $sql = "SELECT COUNT(*) AS total 
        FROM article AS a, categorie_article AS c WHERE c.id=a.id_categorie";
        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute();
        return $req->fetch();
    }
}

function getClient($id = null)
{
    if (!empty($id)) {
        $sql = "SELECT * FROM client WHERE id=?";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute(array($id));

        return $req->fetch();
    } else {
        $sql = "SELECT * FROM client";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute();

        return $req->fetchAll();
    }
}

function getVente($id = null)
{
    if (!empty($id)) {
        $sql = "SELECT nom_article, nom, prenom, v.quantite, prix, date_vente, v.id, prix_unitaire, adresse, telephone
        FROM client AS c, vente AS v, article AS a WHERE v.id_article=a.id AND v.id_client=c.id AND v.id=? AND etat=?";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute(array($id, 1));

        return $req->fetch();
    } else {
        $sql = "SELECT nom_article, nom, prenom, v.quantite, prix, date_vente, v.id, a.id AS idArticle
        FROM client AS c, vente AS v, article AS a WHERE v.id_article=a.id AND v.id_client=c.id AND etat=?";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute(array(1));

        return $req->fetchAll();
    }
}


function getFournisseur($id = null)
{
    if (!empty($id)) {
        $sql = "SELECT * FROM fournisseur WHERE id=?";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute(array($id));

        return $req->fetch();
    } else {
        $sql = "SELECT * FROM fournisseur";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute();

        return $req->fetchAll();
    }
}

function getCommande($id = null) {
    global $connexion;
    if ($id === null) {
        $sql = "SELECT c.*, a.nom_article, f.nom, f.prenom
                FROM Commande c
                JOIN article a ON c.id_article = a.id
                JOIN fournisseur f ON c.id_fournisseur = f.id";
        $req = $connexion->prepare($sql);
    } else {
        $sql = "SELECT c.*, a.nom_article, f.nom, f.prenom
                FROM Commande c
                JOIN article a ON c.id_article = a.id
                JOIN fournisseur f ON c.id_fournisseur = f.id
                WHERE c.id = ?";
        $req = $connexion->prepare($sql);
        $req->execute(array($id));
        return $req->fetch(PDO::FETCH_ASSOC);
    }
    $req->execute();
    return $req->fetchAll(PDO::FETCH_ASSOC);
}


function getAllCommande($etat = null)
{
    if ($etat !== null) {
        $sql = "SELECT COUNT(*) AS nbre FROM commande WHERE etat = ?";
        $req = $GLOBALS['connexion']->prepare($sql);
        $req->execute([$etat]);
    } else {
        $sql = "SELECT COUNT(*) AS nbre FROM commande";
        $req = $GLOBALS['connexion']->prepare($sql);
        $req->execute();
    }

    return $req->fetch();
}


function getAllVente()
{
    $sql = "SELECT COUNT(*) AS nbre FROM vente WHERE etat=?";

    $req = $GLOBALS['connexion']->prepare($sql);

    $req->execute(array(1));

    return $req->fetch();
}

function getAllArticle()
{
    $sql = "SELECT COUNT(*) AS nbre FROM article";

    $req = $GLOBALS['connexion']->prepare($sql);

    $req->execute();

    return $req->fetch();
}

function getCA()
{
    $sql = "SELECT SUM(prix) AS prix FROM vente";

    $req = $GLOBALS['connexion']->prepare($sql);

    $req->execute();

    return $req->fetch();
}

function getLastVente()
{

    $sql = "SELECT nom_article, nom, prenom, v.quantite, prix, date_vente, v.id, a.id AS idArticle
        FROM client AS c, vente AS v, article AS a WHERE v.id_article=a.id AND v.id_client=c.id AND etat=? 
        ORDER BY date_vente DESC LIMIT 10";

    $req = $GLOBALS['connexion']->prepare($sql);

    $req->execute(array(1));

    return $req->fetchAll();
}

function getMostVente()
{

    $sql = "SELECT nom_article, SUM(prix) AS prix
        FROM client AS c, vente AS v, article AS a WHERE v.id_article=a.id AND v.id_client=c.id AND etat=? 
        GROUP BY a.id
        ORDER BY SUM(prix) DESC LIMIT 10";

    $req = $GLOBALS['connexion']->prepare($sql);

    $req->execute(array(1));

    return $req->fetchAll();
}

function getCategorie($id = null)
{
    if (!empty($id)) {
        $sql = "SELECT * FROM categorie_article WHERE id=?";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute(array($id));

        return $req->fetch();
    } else {
        $sql = "SELECT * FROM categorie_article";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute();

        return $req->fetchAll();
    }
}
