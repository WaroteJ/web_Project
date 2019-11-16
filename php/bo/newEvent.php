<?php
    $error=NULL;

    if(isset($_POST['newEvent'])){
        if($_FILES["img"]["error"] == 0){
        include ("php/image.php");
        $photoArray=imageUpload("assets/img/events/"); // Renvoie la validation de l'image et son chemin d'accès

        if($photoArray[0]==1){ // Si l'image est valide(format, pas déjà présente,...)
            $pay=1;
            $prix=0;
            $descri='';
            if(isset($_POST['prix'])){
                if($_POST['prix']>=0)
                    $prix=inputSecure($_POST['prix']); //Si le prix est >0 
            }
            if(!isset($_POST['payant'])){ // Si la case payant n'est pas coché, on set payant et prix à 0
                $pay=0;             
                $prix=0;
            }
            if(isset($_POST['descri'])){
                $descri=inputSecure($_POST['descri']);
            }

            $requete = $bdd->prepare("INSERT INTO `event`(`payant`, `prix`, `nom`, `description`, `date`, `logo`, `id_centre`) 
            VALUES (:payant,:prix,:nom,:description,:date,:logo,:id)");
            $requete->execute(array(
                ':id'=>$_SESSION['centre'],
                ':payant'=>$pay,
                ':prix'=>$prix,
                ':nom'=>inputSecure($_POST['nom']),
                ':date'=>inputSecure($_POST['date']),
                ':description'=>$descri,
                ':logo'=>$photoArray[1],
            ));
            $requete->closeCursor();
        }
        else{
            $error=1;
        }
    }else{
        $error=2;
    }
    }
?>
<form class="add_event whole_form col-lg-6 col-md-8 col-11" action="" method="post" enctype="multipart/form-data">
    <h2>Création d'un évènement</h2>
    <?php
        switch ($error) {
            case 1:
                echo '<h3>Image incorrecte ou déjà existante</h3>';
                $error=NULL;
                break;
            
            case 2:
                echo '<h3>Image trop grosse</h3>';
                $error=NULL;
                break;
            default:
                # code...
                break;
        }
    ?>
    <label for="nom">Nom de l'évènement</label>
    <input type="text" class="form-control" name="nom" id="nom" placeholder="Nom de l'évènement" required maxlength="50">
    <label for="payant">Payant </label>
    <input type="checkbox" name="payant" id="payant"> 
    <input type="number" class="form-control" name="prix" id="prix" placeholder="Prix" min="0">
    <label for="descri">Description de l'évènement</label>
    <textarea class="form-control" name="descri" id="descri" placeholder="Description de l'évènement" row=5></textarea>
    <label for="date">Date de l'évènement</label>
    <input type="date" class="form-control" name="date" id="date" min="<?php echo date('Y-m-d');?>" required>
    <label for="img">Affiche de l'évènement</label>
    <div class="input-group mb-3">
        <div class="custom-file">
            <input required type="file" class="custom-file-input" name ="img" id="img" aria-describedby="inputGroupFileAddon04" accept="image/*">
            <label class="custom-file-label" for="img">Choose file</label>
        </div>
    </div>
    <input class="btn btn-primary" type="submit" value="Créer" name="newEvent">
</form>