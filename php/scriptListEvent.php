<?php
    // Cette requête préparée renvoie l'id, le nom, la description, la date et le logo de tout les evenements qui correspondent au centre de la session en cours
    $req = $bdd->prepare('SELECT `id`,`nom`,`description`,`date`,`logo` FROM `event` WHERE `id_centre`=:id AND `deleted`= 0');
    $req->execute(array(
    'id' => $_SESSION["centre"]
    ));

    // Ce while boucle tant que le "fetch" renvoie des données
    while ($response = $req->fetch()) {
       // echo $response['logo'];
       // Cet echo génère le code HTML de chaque événement dans la base de données
        echo '<article class= "col-md-5 col-sm-12">
                        <h2> '.$response[1].'</h2>
                        <p>
                            <label for="description">'.substr($response[2], 0, 50).'...</label>
                        </p>
                        <p>
                            <label for="dateheure">'.$response[3].'</label>
                        </p>
                        <div class="bottom-article">
                                <a href="evenement.php?event='.$response[0].'">Plus d informations</a>
                        </div>
                </article>';
    }
?>