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
                            <img src="'.$response[5].'" alt="">
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
                    </p>';

                    $req = $bdd->prepare('  SELECT COUNT(event_user.id_user) as participation
                                            FROM event_user
                                            WHERE `id`=:id AND `id_User`= :idUser');
                    $req->execute(array(
                    'idUser' => $_SESSION["user"],
                    'id' => $_GET['event']
                    ));

                    $participe = $req->fetch();

                    if ( $participe[0] > 0  ) {
                        echo '<form action="" method="post">
                        <input type="submit" value="Désabonner" name="desabo">
                        </form>
                        </article>';
                    }
                    else{
                        echo
                        '<form action="" method="post">
                        <input type="submit" value="Je Participe!" name="participe">
                        </form>
                        </article>';
                    }
?>