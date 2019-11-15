<?php
    if(isset($_POST["Val"])){
        $requete = $bdd->prepare("UPDATE `commentaire` SET `signale`=0 WHERE `id`=:id");
        $requete->execute(array(
            ':id'=>$_POST["id"]
        ));
    }
    else if(isset($_POST["Del"])){
        $requete = $bdd->prepare("UPDATE `commentaire` SET `deleted`=1 WHERE `id`=:id");
        $requete->execute(array(
            ':id'=>$_POST["id"]
        ));
    }
    $groupID=NULL; // Sert à déterminer si l'article fait partie de la même commande
    $id=NULL;

    // Sélectionne les photos signalées
    $requete = $bdd->prepare("SELECT `id`,`commentaire` FROM `commentaire` WHERE `signale`=1 AND `deleted`=0");
    $requete->execute();
    echo '<div class="container-fluid">
            <div class="row">';
    while($result = $requete->fetch(PDO::FETCH_BOTH)){ // Affiche toutes les photos signalées
        echo <<<HTML
        <div class="signal col-12 container">
            <div class="row">
                <div class="col-12 col-md-10">
                    <p class="w-100">{$result[1]}</p>
                </div>
                <div class="col-4 col-md-2">
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