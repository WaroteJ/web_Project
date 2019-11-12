<?php

 /* if(isset($_POST[])){ // Si un bouton modifier a été cliqué 
    $req = $bdd->prepare("UPDATE `user` SET `droit`=:droit WHERE `id`=:id"); // modifie le droit de l'utilisateur
    $req->execute(array(
        ':id'=>inputSecure($_POST["id"]),
        ':droit'=>inputSecure($_POST["droit"])
    )); 
    $req->closeCursor();
  }*/

  $requete = $bdd->prepare("");
  $requete->execute(array(
      
  ));
  while($result = $requete->fetch(PDO::FETCH_BOTH)){ //Affiche le nom, prénom, droit + un bouton modifier pour tous les utilisateurs
  
  }
  $requete->closeCursor();
?>
</table>