<?php
    if(!isset($_SESSION['centre'])){
        header("Location: ../index.php");
    }
    // Cette requête préparée renvoie l'id, le nom, la description, la date et le logo de tout les evenements qui correspondent au centre de la session en cours
    $req = $bdd->prepare('SELECT `id`,`nom`,`description`,`date`,`logo` 
    FROM `event` WHERE `id_centre`=:id AND `deleted`= 0 AND `signale` = 0 
    ORDER BY `date` DESC');
    $req->execute(array(
    'id' => $_SESSION["centre"]
    ));
    $firstNew=true;
    $firstOld=true;
    // Ce while boucle tant que le "fetch" renvoie des données
    while ($response = $req->fetch()) {
        if($firstNew){
            echo '<h2 class="col-12 text-center font-weight-bold underline">Evénements à venir</h2>';
            $firstNew=false;
        }
        if($firstOld && ($response[3] < date('Y-m-d'))){
            echo '<h2 class="col-12 text-center font-weight-bold underline">Evénements passés</h2>';
            $firstOld=false;
        }
       // echo $response['logo'];
       // Cet echo génère le code HTML de chaque événement dans la base de données
        echo '<article class= "col-md-5 col-sm-12 p-3 mb-5">
                        <h2 class="font-weight-bold"> '.$response[1].'</h2>
                        <p>
                            <label for="description">'.substr($response[2], 0, 50).'...</label>
                        </p>
                        <p>
                            <label for="dateheure">'.$response[3].'</label>
                        </p>';
        


                if ( $response[3] >= date('Y-m-d')  ) {
                    echo '  <div class="bottom-article">
                            <a href="evenement.php?event='.$response[0].'">Plus d\'informations </a>
                            </div>
                            </article>';
                }
                else{
                            echo'   <div class="bottom-article">
                            <a href="evenementFini.php?event='.$response[0].'">Plus d\'informations</a>
                            </div>
                            </article>';
                }
    }
?>