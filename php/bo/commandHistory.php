<?php
  if(!isset($_SESSION["centre"])){
    header("Location: ../../index.php");
  }
  $groupID=NULL; // Sert à déterminer si l'article fait partie de la même commande
  $id=NULL;

  // Sélectionne les items et leur prix d'une commande ainsi que l'utilisateur et la date 
  $requete = $bdd->prepare("SELECT  user.nom, user.prenom, commande.id, commande.date ,article.nom_article,article_commande.qte
  FROM ((commande INNER JOIN user ON commande.id_User = user.id) 
  INNER JOIN article_commande ON commande.id = article_commande.id_Commande) 
  INNER JOIN article on article_commande.id = article.id
  WHERE commande.etat=1
  ORDER BY commande.id");
  $requete->execute();
  $once=false;
  echo'<div class="container-fluid">
  <div class="row">';
  while($result = $requete->fetch(PDO::FETCH_BOTH)){ // Affiche toutes les commandes qui ont été validées
    if($result[2]!=$id){
        if($groupID!=NULL){
            echo'Commande validée
                </div>';
        }
        $groupID=false;
    }

    if(!$groupID){
        echo'<div class="col-12 command">
        <h3>Commande n°'.$result[2].' du '.$result[3].' : '.$result[0].' '.$result[1].'</h3>';
        $groupID=true;
        $once=true;
        $id=$result[2];
    }
        echo '<div class="suivi">'.$result[5].' x '.$result[4].'</div>';
  }
  if($once){
    echo'Commande validée
    </div>';
  }
  $requete->closeCursor();
?>
</table>