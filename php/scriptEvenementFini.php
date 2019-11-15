<?php
if(isset($_POST["getEntrants"])){
    require ("entrants.php");
    getEntrants($_GET['event']);
}
if(isset($_POST["getPhotos"])){
    require ("zip.php");
    getPhotos($_GET['event']);
}
    $req = $bdd->prepare('  SELECT COUNT(event_user.id_user) as nombre_participant, event.nom, event.logo
                            FROM event LEFT JOIN event_user ON event.id = event_user.id
                            WHERE event.deleted = 0 AND event.id = :id
                            GROUP BY event.id');
    $req->execute(array(
    'id' => $_GET['event']
    ));

    $response = $req->fetch();

    echo <<<HTML
        <article class= "col-md-9 col-sm-12">
            <h2> {$response[1]} (/!\Evénement terminé/!\)</h2>
            <div>
                <img class="w-25" src="{$response[2]}" alt="">
            </div>
            <p>
                <label for="nb_participants"><strong>Nombre de Participants:</strong> {$response[0]}</label>
            </p>
HTML;

    if ( $_SESSION['admin'] > 0) {
        echo <<<HTML
            <div class="buttons" >
                <form class="bottom-article" action="" method="post">
                    <input class="btn btn-primary" type="submit" value="Télécharger toutes les photos" name="getPhotos">
                </form>
HTML;   if($_SESSION['admin'] > 1){
            echo <<<HTML
                <form class="bottom-article button" action="" method="post">
                    <input class="btn btn-primary" type="submit" value="Récupérer liste participants" name="getEntrants">
                </form>
HTML;
        }
        echo'
            </div>
        </article>';
    }
    else{
        echo '</article>';
        }

    $req = $bdd->prepare('SELECT `url`, `id` FROM `photo` WHERE `deleted`= 0 AND `signale` = 0 AND `id_Event`= :id');
    $req->execute(array(
    'id' => $_GET["event"]
    ));
    // Ce while boucle tant que le "fetch" renvoie des données
    while ($response = $req->fetch()) {
    // Cet echo génère le code HTML de chaque événement dans la base de données
    echo <<<HTML
    <article class= "col-md-10 col-sm-12">
        <div>
            <a href="photo.php?photo={$response[1]}"><img class="w-50" src="{$response[0]}" alt="Une photo de l événement"/></a>
        </div>
    </article>
HTML;  
    }
?>