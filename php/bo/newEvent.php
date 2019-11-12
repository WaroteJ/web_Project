<?php

    if(isset($_POST['newEvent'])){ 
        $pay=1;
        $prix=0;
        $descri='';
        $logo='';
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
        if(isset($_POST['logo'])){
            $logo=inputSecure($_POST['logo']);
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
            ':logo'=>$logo,
        ));
        $requete->closeCursor();
    }
?>
<form class="add_event" action="" method="post">
    <h2>Création d'un évènement</h2>
    <label for="nom">Nom de l'évènement</label>
    <input type="text" name="nom" id="nom" placeholder="Nom de l'évènement" required maxlength="50">
    <label for="payant">Payant </label>
    <input type="checkbox" name="payant" id="payant"> 
    <input type="number" name="prix" id="prix" placeholder="Prix" min="0">
    <label for="descri">Description de l'évènement</label>
    <textarea name="descri" id="descri" placeholder="Description de l'évènement" row=5></textarea>
    <label for="date">Date de l'évènement</label>
    <input type="date" name="date" id="date" min="<?php echo date('Y-m-d');?>" required>
    <label for="logo">Lien de l'affiche de l'évènement</label>
    <input type="text" name="logo" id="logo" placeholder="Url du logo de l'évènement">
    <input type="submit" value="Créer" name="newEvent">
</form>