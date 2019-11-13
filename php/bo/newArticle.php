<?php
    $error=NULL;

    if(isset($_POST['newArticle'])){
        include ("php/image.php");
        $photoArray=imageUpload("assets/img/products/");// Renvoie la validation de l'image et son chemin d'accès

        if($photoArray[0]==1){// Si l'image est valide(format, pas déjà présente,...)
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
<form action="" method="post" class="whole_form col-lg-6 col-md-8 col-11" enctype="multipart/form-data">
    <h2>Ajouter un article</h2>
    <?php if ($error!=NULL) {
        echo '<h3>Image incorrecte ou déjà existante</h3>';
        $error=NULL;
    }?>
    <label for="nom">Nom de l'article</label>
    <input class="form-control" type="text" name="nom" id="nom" placeholder="Nom de l'article" required>
    <label for="cat">Catégorie</label> 
    <select class="form-control" name="cat" id="cat" required>
    <?php 
        $req= $bdd->prepare("SELECT * FROM `categorie` ORDER BY `nom`"); // Retourne les différentes catégories 
        $req->execute();

        while($result = $req->fetch(PDO::FETCH_BOTH)){  //On les affiche dans une balise select 
        echo "<option value='".$result[0]."'>".$result[1]."</option>";
        }   
    ?>
    </select>
    <label for="prix">Prix</label>
    <input class="form-control" type="number" name="prix" id="prix" placeholder="Prix" min="0">
    <label for="descri">Description de l'article</label>
    <textarea class="form-control" name="descri" id="descri" placeholder="Description de l'article" row=5></textarea>
    <label for="img">Photo de l'article</label>
    <div class="input-group mb-3">
        <div class="custom-file">
            <input type="file" class="custom-file-input" name ="img" id="img" aria-describedby="inputGroupFileAddon04" accept="image/*">
            <label class="custom-file-label" for="img">Choose file</label>
        </div>
    </div>
    <input class="btn btn-primary" type="submit" value="Créer" name="newArticle">
</form>