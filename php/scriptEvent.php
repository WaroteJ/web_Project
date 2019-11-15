<?php
     if(isset($_POST["participe"])){
        $req = $bdd->prepare('INSERT INTO `event_user`(`id`, `id_User`) VALUES (:id,:idUser)');
        $req->execute(array(
        'idUser' => $_SESSION["user"],
        'id' => $_GET['event']
    ));
    }

    if(isset($_POST["desabo"])){
        $req = $bdd->prepare('DELETE FROM `event_user` WHERE `id`=:id AND `id_User`= :idUser');
        $req->execute(array(
        'idUser' => $_SESSION["user"],
        'id' => $_GET['event']
        ));
    }

    if(isset($_POST["signalEvent"])){
        $req = $bdd->prepare('UPDATE `event` SET `signale`= 1 WHERE id = :id');
        $req->execute(array(
        'id' => $_GET['event']
        ));
        header("Location: ./evenements.php"); 
    }

    if(isset($_POST["deletEvent"])){
        $req = $bdd->prepare('UPDATE `event` SET `deleted`= 1 WHERE id = :id');
        $req->execute(array(
        'id' => $_GET['event']
        ));
        header("Location: ./evenements.php"); 
    }

    $req = $bdd->prepare('  SELECT COUNT(event_user.id_user) as nombre_participant, event.prix, event.nom, event.date, event.description, event.logo
                            FROM event LEFT JOIN event_user ON event.id = event_user.id
                            WHERE event.deleted = 0 AND event.id = :id
                            GROUP BY event.id');
    $req->execute(array(
    'id' => $_GET['event']
    ));

    $response = $req->fetch();




       // echo $response['logo'];
        echo '<article class= "col-md-9 col-sm-12">
                    <h2> '.$response[2].'</h2>
                    <div>
                            <img class="w-25" src="'.$response[5].'" alt="">
                    </div>
                    <p>
                        <label for="description"><strong>Description:</strong> '.$response[4].'</label>
                    </p>
                    <p>
                        <label for="dateheure"><strong>Date et Heure:</strong> '.$response[3].'</label>
                    </p>
                    <p>
                        <label for="nb_participants"><strong>Nombre de Participants:</strong> '.$response[0].'</label>
                    </p>
                    <p>
                        <label for="prix"><strong>Prix:</strong> '.$response[1].'€</label>
                    </p>
                    <div class="row buttons" >';

                    $req = $bdd->prepare('  SELECT COUNT(event_user.id_user) as participation
                                            FROM event_user
                                            WHERE `id`=:id AND `id_User`= :idUser');
                    $req->execute(array(
                    'idUser' => $_SESSION["user"],
                    'id' => $_GET['event']
                    ));

                    $participe = $req->fetch();

                    if ( $_SESSION['admin'] > 0) {
                        echo '  <form class="bottom-article button col-md-4 col-sm-12" action="" method="post">
                                <input class="btn btn-danger" type="submit" value="Supprimer cet event" name="deletEvent">
                                </form>';
                    }

                    if ( $_SESSION['admin'] > 0) {
                        echo '  <form class="bottom-article button col-md-3 col-sm-12" action="" method="post">
                                <input class="btn btn-warning" type="submit" value="Signaler cet event" name="signalEvent">
                                </form>';
                    }

                    if ( $participe[0] > 0  ) {
                        echo '  <form class="bottom-article button col-md-3 col-sm-12" action="" method="post">
                                <input class="btn btn-primary" type="submit" value="Se Désinscrire" name="desabo">
                                </form>
                                </div>
                                </article>';
                    }
                    else{
                        echo'   <form class="bottom-article button col-md-3 col-sm-12" action="" method="post">
                                <input class="btn btn-primary" type="submit" value="Je Participe!" name="participe">
                                 </form>
                                 </div>
                                </article>';
                    }
?>