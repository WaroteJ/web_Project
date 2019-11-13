<?php
    $error=NULL;

    if(isset($_POST['newArticle'])){
        include ("php/image.php");
        $photoArray=imageUpload("assets/img/products/");

        if($photoArray[0]==1){
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

            $requete = $bdd->prepare("INSERT INTO `article`(`nom_article`, `description`, `prix`, `id_Categorie`, `url`, `id_centre`) 
            VALUES (:nom,:description,:prix,:cat,:photo,:id)");
            $requete->execute(array(
                ':id'=>$_SESSION['centre'],
                ':prix'=>$prix,
                ':nom'=>inputSecure($_POST['nom']),
                ':description'=>$descri,
                ':photo'=>$photoArray[1],
                ':cat'=>inputSecure($_POST['cat'])
            ));
            $requete->closeCursor();
        }
        else{
            $error=1;
        }
    }
?>
<form action="" method="post" class="whole_form" enctype="multipart/form-data">
    <h2>Ajouter un article</h2>
    <?php if ($error!=NULL) {
        echo '<h3>Image incorrecte ou déjà existante</h3>';
        $error=NULL;
    }?>
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
    <label for="img">Photo de l'article</label>
    <input type="file" name="img" id="img" accept="image/*">
    <input type="submit" value="Créer" name="newArticle">
</form>