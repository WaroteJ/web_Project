<?php
    if(isset($_POST["Val"])){
        $requete = $bdd->prepare("UPDATE `photo` SET `signale`=0 WHERE `id`=:id");
        $requete->execute(array(
            ':id'=>$_POST["id"]
        ));
    }
    else if(isset($_POST["Del"])){
        $requete = $bdd->prepare("UPDATE `photo` SET `deleted`=1 WHERE `id`=:id");
        $requete->execute(array(
            ':id'=>$_POST["id"]
        ));
    }
    $groupID=NULL; // Sert à déterminer si l'article fait partie de la même commande
    $id=NULL;

    // Sélectionne les photos signalées
    $requete = $bdd->prepare("SELECT `id`,`url` FROM `photo` WHERE `signale`=1 AND `deleted`=0");
    $requete->execute();
    echo '<div class="container-fluid">
            <div class="row">';
    while($result = $requete->fetch(PDO::FETCH_BOTH)){ // Affiche toutes les photos signalées
        echo <<<HTML
          <div class="signal col-12 col-md-6 container">
                    <div class="row">
                        <div class="col-12 col-md-8">
                            <img class="w-100" src="{$result[1]}">
                        </div>
                        <div class="col-6 col-md-4">
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
    echo '</div></div>';
  $requete->closeCursor();
?>