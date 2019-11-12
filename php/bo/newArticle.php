<?php

    if(isset($_POST['newArticle'])){
        $prix=0;
        $descri='';
        $photo='';
        if(isset($_POST['prix'])){
            if($_POST['prix']>=0)
                $prix=inputSecure($_POST['prix']);
        }
        if(isset($_POST['descri'])){
            $descri=inputSecure($_POST['descri']);
        }
        if(isset($_POST['photo'])){
            $photo=inputSecure($_POST['photo']);
        }
        $requete = $bdd->prepare("INSERT INTO `article`(`nom_article`, `description`, `prix`, `id_Categorie`, `url`, `id_centre`) 
        VALUES (:nom,:description,:prix,:cat,:photo,:id)");
        $requete->execute(array(
            ':id'=>$_SESSION['centre'],
            ':prix'=>$prix,
            ':nom'=>inputSecure($_POST['nom']),
            ':description'=>$descri,
            ':photo'=>$photo,
            ':cat'=>inputSecure($_POST['cat'])
        ));
        $requete->closeCursor();
    }
?>
<form action="" method="post" class="whole_form">
    <h2>Ajouter un article</h2>
    <label for="nom">Nom de l'article</label>
    <input type="text" name="nom" id="nom" placeholder="Nom de l'article" required>
    <label for="cat">Catégorie</label> 
    <select name="cat" id="cat" required>
    <?php 
        $req= $bdd->prepare("SELECT * FROM `categorie` ORDER BY `nom`");
        $req->execute();

        while($result = $req->fetch(PDO::FETCH_BOTH)){
        echo "<option value='".$result[0]."'>".$result[1]."</option>";
        }   
    ?>
    </select>
    <label for="prix">Prix</label>
    <input type="number" name="prix" id="prix" placeholder="Prix" min="0">
    <label for="descri">Description de l'article</label>
    <textarea name="descri" id="descri" placeholder="Description de l'article" row=5></textarea>
    <label for="logo">Photo de l'article</label>
    <input type="text" name="photo" id="photo" placeholder="Url de la photo de l'article">
    <input type="submit" value="Créer" name="newArticle">
</form>