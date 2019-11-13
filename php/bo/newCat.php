<?php
    if(isset($_POST['newCat'],$_POST['nom'])){ // Crée une nouvelle catégorie
        $requete = $bdd->prepare("INSERT INTO `categorie`(`nom`) VALUES (:nom)");
        $requete->execute(array(
            ':nom'=>inputSecure($_POST['nom']),
        ));
        $requete->closeCursor();
    }
?>
<form action="" method="post" class="whole_form col-lg-6 col-md-8 col-11">
    <h2>Ajouter une catégorie</h2>
    <label for="nom">Nom de la catégorie</label>
    <input class="form-control" type="text" name="nom" id="nom" placeholder="Nom de la catégorie" required>
    <input class="btn btn-primary" type="submit" value="Créer" name="newCat">
</form>