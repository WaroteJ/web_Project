<?php
  if(!isset($_SESSION["centre"])){
    header("Location: ../../index.php");
  }
  
    if(isset($_POST["Val"],$_POST["id"])){
        $requete = $bdd->prepare("UPDATE `event` SET `signale`=0 WHERE `id`=:id");
        $requete->execute(array(
            ':id'=>$_POST["id"]
        ));
    }
    else if(isset($_POST["Del"],$_POST["id"])){
        $requete = $bdd->prepare("UPDATE `event` SET `deleted`=1 WHERE `id`=:id");
        $requete->execute(array(
            ':id'=>$_POST["id"]
        ));
    }
    $groupID=NULL; // Sert à déterminer si l'article fait partie de la même commande
    $id=NULL;

    // Sélectionne les photos signalées
    $requete = $bdd->prepare("SELECT `id`,`nom`,`description`,`date`,`logo`,`prix` FROM `event` WHERE `signale`=1 AND `deleted`=0 AND `id_centre`=:id");
    $requete->execute(array(
        ':id'=>$_SESSION['centre']
    ));
    echo '<div class="container-fluid">
            <div class="row">';
    while($result = $requete->fetch(PDO::FETCH_BOTH)){ // Affiche toutes les photos signalées
        echo <<<HTML
        <div class="signal col-12 container">
            <div class="row">
                <div class="col-12 col-md-9">
                    <h2>{$result[1]}</h2>
                    <div>
                            <img class="w-50" src="{$result[4]}" alt="">
                    </div>
                    <p>
                        <label for="description"><strong>Description:</strong>{$result[2]}</label>
                    </p>
                    <p>
                        <label for="dateheure"><strong>Date et Heure:</strong>{$result[3]}</label>
                    </p>
                    <p>
                        <label for="prix"><strong>Prix:</strong>{$result[5]} €</label>
                    </p>
                </div>
                <div class="col-6 col-md-3">
                    <form action="" method="post">
                        <input type="hidden" name="id" value="{$result[0]}">
                        <input class="btn btn-success" type="submit" name="Val" value="Valider">
                    </form>
                    <form action="" method="post">
                        <input type="hidden" name="id" value="{$result[0]}">
                        <input class="btn btn-danger" type="submit" name="Del" value="Supprimer">
                    </form>
                </div>
            </div>
        </div>
HTML;
    }
    echo '</div>
        </div>';
  $requete->closeCursor();
?>