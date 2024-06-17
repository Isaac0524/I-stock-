<?php
include 'entete.php';

if (!empty($_GET['id'])) {
    $article = getCommande($_GET['id']);
}

?>
<div class="home-content">
    <div class="overview-boxes">
        <div class="box">
            <form action=" <?= !empty($_GET['id']) ?  "../model/modifCommande.php" : "../model/ajoutCommande.php" ?>" method="post">
                <input value="<?= !empty($_GET['id']) ?  $article['id'] : "" ?>" type="hidden" name="id" id="id">

                <label for="id_article">Article</label>
                <select onchange="setPrix()" name="id_article" id="id_article">
                    <?php
                    $articles = getArticle();
                    if (!empty($articles) && is_array($articles)) {
                        foreach ($articles as $key => $value) {
                    ?>
                            <option data-prix="<?= $value['prix_unitaire'] ?>" value="<?= $value['id'] ?>" <?= (!empty($article) && $article['id_article'] == $value['id']) ? "selected" : "" ?>><?= $value['nom_article'] . " - " . $value['quantite'] . " disponible" ?></option>
                    <?php
                        }
                    }
                    ?>
                </select>

                <label for="id_fournisseur">Fournisseur</label>
                <select name="id_fournisseur" id="id_fournisseur">
                    <?php
                    $clients = getFournisseur();
                    if (!empty($clients) && is_array($clients)) {
                        foreach ($clients as $key => $value) {
                    ?>
                            <option value="<?= $value['id'] ?>" <?= (!empty($article) && $article['id_fournisseur'] == $value['id']) ? "selected" : "" ?>><?= $value['nom'] . " " . $value['prenom'] ?></option>
                    <?php
                        }
                    }
                    ?>
                </select>

                <label for="quantite">Quantité</label>
                <input onkeyup="setPrix()" value="<?= !empty($_GET['id']) ?  $article['quantite'] : "" ?>" type="number" name="quantite" id="quantite" placeholder="Veuillez saisir la quantité">

                <label for="prix">Prix</label>
                <input value="<?= !empty($_GET['id']) ?  $article['prix'] : "" ?>" type="number" name="prix" id="prix" placeholder="Veuillez saisir le prix">

                <button type="submit">Valider</button>

                <?php
                if (!empty($_SESSION['message']['text'])) {
                ?>
                    <div class="alert <?= $_SESSION['message']['type'] ?>">
                        <?= $_SESSION['message']['text'] ?>
                    </div>
                <?php
                }
                ?>
            </form>
        </div>
        <div class="box">
            <table class="mtable">
                <tr>
                    <th>Article</th>
                    <th>Fournisseur</th>
                    <th>Quantité</th>
                    <th>Prix</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
                <?php
                $vente = getCommande();
                if (!empty($vente) && is_array($vente)) {
                    foreach ($vente as $key => $value) {
                        if ($value['etat'] == 1) {
                ?>
                            <tr>
                                <td><?= $value['nom_article'] ?></td>
                                <td><?= $value['nom'] . " " . $value['prenom'] ?></td>
                                <td><?= $value['quantite'] ?></td>
                                <td><?= $value['prix'] ?></td>
                                <td><?= date('d/m/Y H:i:s', strtotime($value['date_commande'])) ?></td>
                                <td>
                                    <a onclick="annuleCommande(<?= $value['id'] ?>, <?= $value['id_article'] ?>, <?= $value['quantite'] ?>)" style="color: red;"><i class='bx bx-stop-circle'></i></a>
                                </td>
                            </tr>
                <?php
                        }
                    }
                }
                ?>
            </table>
        </div>
    </div>
</div>
<?php
include 'pied.php';
?>
<script>
    function annuleCommande(idCommande, idArticle, quantite) {
        if (confirm("Voulez-vous vraiment annuler cette Commande ?")) {
            window.location.href = "../model/annuleCommande.php?idCommande=" + idCommande + "&idArticle=" + idArticle + "&quantite=" + quantite;
        }
    }

    function setPrix() {
        var article = document.querySelector('#id_article');
        var quantite = document.querySelector('#quantite');
        var prix = document.querySelector('#prix');

        var prixUnitaire = article.options[article.selectedIndex].getAttribute('data-prix');
        prix.value = Number(quantite.value) * Number(prixUnitaire);
    }
</script>
