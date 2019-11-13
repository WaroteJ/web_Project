<?php

    if(isset($_POST["valid_command"],$_POST["id_command"])){ // Si un bouton modifier a été cliqué 
        $req = $bdd->prepare("UPDATE `commande` SET `etat`=1 WHERE `id`=:id"); //Valide la commande
        $req->execute(array(
            ':id'=>inputSecure($_POST["id_command"]),
        )); 
        $req->closeCursor();
    }


  $groupID=NULL;
  $id=NULL;
  $lastEtat=NULL;
  // Sélectionne les items et leur prix d'une commande ainsi que l'utilisateur et la date 
  $requete = $bdd->prepare("SELECT  user.nom, user.prenom, commande.id, commande.date ,commande.etat,article.nom_article,article_commande.qte
  FROM ((commande INNER JOIN user ON commande.id_User = user.id) 
  INNER JOIN article_commande ON commande.id = article_commande.id_Commande) 
  INNER JOIN article on article_commande.id = article.id
  ORDER BY commande.id");
  $requete->execute();
  echo'<div class="container-fluid">
  <div class="row">';
  while($result = $requete->fetch(PDO::FETCH_BOTH)){ 
    if($result[2]!=$id){
        if($groupID!=NULL){
            if($lastEtat==0){ // Si la commande n'est pas validé, on affiche un bouton valider
                echo'<form action="" method="post">
                        <input type="hidden" name="id_command" id="id_command" value="'.$id.'">
                        <input type="submit" value="Valider la commande" name="valid_command">
                    </form>';
            }
            else if($lastEtat==1){
                echo'Commande validée';
            }
        echo'</div>';
        }
        $groupID=false;
    }

    if(!$groupID){
        echo'<div class="col-12 command">
        <h3>Commande n°'.$result[2].' du '.$result[3].' : '.$result[0].' '.$result[1].'</h3>';
        $groupID=true;
        $id=$result[2];
        $lastEtat=$result[4];
    }
        echo '<div class="suivi">'.$result[6].' x '.$result[5].'</div>';

  }
    if($lastEtat==0){
        echo'<form action="" method="post">
            <input type="hidden" name="id_command" id="id_command" value="'.$id.'">
            <input type="submit" value="Valider la commande" name="valid_command">
        </form>';
    }
    else if($lastEtat==1){
        echo'Commande validée';
    }
    echo'</div>';
  $requete->closeCursor();
?>
</table>