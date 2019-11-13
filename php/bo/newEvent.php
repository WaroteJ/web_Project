<?php
    $error=NULL;

    if(isset($_POST['newEvent'])){
        include ("php/image.php");
        $photoArray=imageUpload("assets/img/events/");

        if($photoArray[0]==1){
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
    }
?>
<form class="add_event whole_form" action="" method="post" enctype="multipart/form-data">
    <h2>Création d'un évènement</h2>
    <?php if ($error!=NULL) {
        echo '<h3>Image incorrecte ou déjà existante</h3>';
        $error=NULL;
    }?>
    <label for="nom">Nom de l'évènement</label>
    <input type="text" name="nom" id="nom" placeholder="Nom de l'évènement" required maxlength="50">
    <label for="payant">Payant </label>
    <input type="checkbox" name="payant" id="payant"> 
    <input type="number" name="prix" id="prix" placeholder="Prix" min="0">
    <label for="descri">Description de l'évènement</label>
    <textarea name="descri" id="descri" placeholder="Description de l'évènement" row=5></textarea>
    <label for="date">Date de l'évènement</label>
    <input type="date" name="date" id="date" min="<?php echo date('Y-m-d');?>" required>
    <label for="img">Affiche de l'évènement</label>
    <input type="file" name="img" id="img" accept="image/*">
    <input type="submit" value="Créer" name="newEvent">
</form>