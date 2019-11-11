<?php
    if(isset($_POST['newCat'])){
        $requete = $bdd->prepare("INSERT INTO `categorie`(`nom`) VALUES (:nom)");
        $requete->execute(array(
            ':nom'=>inputSecure($_POST['nom']),
        ));
        $requete->closeCursor();
    }
?>
<form action="" method="post">
    <h2>Ajouter une catégorie</h2>
    <label for="nom">Nom de la catégorie</label>
    <input type="text" name="nom" id="nom" placeholder="Nom de la catégorie" required>
    <input type="submit" value="Créer" name="newCat">
</form>