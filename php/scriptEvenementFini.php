<?php
if(isset($_POST["getEntrants"])){
    require ("entrants.php");
    getEntrants($_GET['event']);
}
if(isset($_POST["getPhotos"])){
    require ("zip.php");
    getPhotos($_GET['event']);
}
$error=NULL;
if(isset($_POST["newPhoto"])){
    if($_FILES["img"]["error"] == 0){
        //File uploaded
        include ("php/image.php");
        $photoArray=imageUpload("assets/img/events/");
        if($photoArray[0]==1){
            $req = $bdd->prepare('INSERT INTO `photo`(`url`, `id_Event`) VALUES (:url,:id)');
            $req->execute(array(
                'url'=>$photoArray[1],
                'id' => $_GET['event']
            ));
        }
        else{
            $error=1;
        }
    }else{
        $error=2;
    }
}
if(isset($_POST["signalPhoto"])){
    $req = $bdd->prepare('UPDATE `photo` SET `signale`= 1 WHERE id = :id');
    $req->execute(array(
    'id' => $_POST['id']
    ));
}

if(isset($_POST["deletPhoto"])){
    $req = $bdd->prepare('UPDATE `photo` SET `deleted`= 1 WHERE id = :id');
    $req->execute(array(
    'id' => $_POST['id']
    ));
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
    switch ($error) {
        case 1:
            echo '<h3>Image incorrecte ou déjà existante</h3>';
            $error=NULL;
            break;
        
        case 2:
            echo '<h3>Image trop grosse</h3>';
            $error=NULL;
            break;
        default:
            # code...
            break;
    }
    echo <<<HTML
    <form action="" method="post" enctype="multipart/form-data">
        <label for="img">Ajouter une photo à l'événement</label>
        <div class="input-group mb-3">
            <div class="custom-file">
                <input required type="file" class="custom-file-input" name ="img" id="img" aria-describedby="inputGroupFileAddon04" accept="image/*">
                <label class="custom-file-label" for="img">Choose file</label>
            </div>
        </div>
        <input class="btn btn-success" type="submit" value="Ajouter une photo" name="newPhoto">
    </form>
HTML;
    if ( $_SESSION['admin'] > 0) {
        echo <<<HTML
            <div class="row" >
                <form class="bottom-article button col-md-5 col-sm-12" action="" method="post">
                    <input class="btn btn-warning" type="submit" value="Télécharger toutes les photos" name="getPhotos">
                </form>
HTML;
    if($_SESSION['admin'] > 1){
            echo <<<HTML
                <form class="bottom-article button col-md-5 col-sm-12" action="" method="post">
                    <input class="btn btn-danger" type="submit" value="Récupérer liste participants" name="getEntrants">
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
            echo <<<HTML
              <form class="bottom-article button col-md-5 col-sm-12" action="" method="post">
                    <input type="hidden" name="id" value="{$response[1]}">
                    <input class="btn btn-danger" type="submit" value="Supprimer cette photo" name="deletPhoto">
                    </form>
HTML;
        }

        if ( $_SESSION['admin'] > 0) {
            echo <<<HTML
              <form class="bottom-article button col-md-5 col-sm-12" action="" method="post">
                    <input type="hidden" name="id" value="{$response[1]}">
                    <input class="btn btn-warning" type="submit" value="Signaler cette photo" name="signalPhoto">
                    </form>
HTML;
        }
    echo '  </div>
            </article>';
    }
?>