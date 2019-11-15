<?php
if(isset($_POST["getEntrants"])){
    require ("entrants.php");
    getEntrants($_GET['event']);
}
if(isset($_POST["getPhotos"])){
    require ("zip.php");
    getPhotos($_GET['event']);
}
if(isset($_POST["signalPhoto"])){
    $req = $bdd->prepare('UPDATE `photo` SET `signale`= 1 WHERE id = :id');
    $req->execute(array(
    'id' => $_POST['id']
    ));
    header("Location: ./evenements.php"); 
}

if(isset($_POST["deletPhoto"])){
    $req = $bdd->prepare('UPDATE `photo` SET `deleted`= 1 WHERE id = :id');
    $req->execute(array(
    'id' => $_POST['id']
    ));
    header("Location: ./evenements.php"); 
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
            <div class="row" >
                <form class="bottom-article button col-md-5 col-sm-12" action="" method="post">
                    <input class="btn btn-primary" type="submit" value="Télécharger toutes les photos" name="getPhotos">
                </form>
HTML;
    if($_SESSION['admin'] > 1){
            echo <<<HTML
                <form class="bottom-article button col-md-5 col-sm-12" action="" method="post">
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
    echo '
    <article>
        <div>
            <a href="photo.php?photo='.$response[1].'"><img class="w-100" src="'.$response[0].'" alt="Une photo de l événement"/></a>
        </div>
        <div class="row" >';
        if ( $_SESSION['admin'] > 1) {
            echo '  <form class="bottom-article button col-md-5 col-sm-12" action="" method="post">
                    <input type="hidden" name="id" value="'.$response[1].'">
                    <input class="btn btn-danger" type="submit" value="Supprimer cette photo" name="deletPhoto">
                    </form>';
        }

        if ( $_SESSION['admin'] > 0) {
            echo '  <form class="bottom-article button col-md-5 col-sm-12" action="" method="post">
                    <input type="hidden" name="id" value="'.$response[1].'">
                    <input class="btn btn-warning" type="submit" value="Signaler cette photo" name="signalPhoto">
                    </form>';
        }
    echo '  </div>
            </article>';
    }
?>