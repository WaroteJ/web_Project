<?php
    require_once("bdd.php");
    $list=array();
    //Sélectionne les participants à un évènement
    $req = $bdd->prepare("SELECT user.nom,user.prenom 
    FROM user LEFT JOIN event_user ON user.id = event_user.id_User
    WHERE event_user.id=:id");
    $req->execute(array(
        ':id'=>3
    ));

    while($result = $req->fetch(PDO::FETCH_BOTH)){
        $list[]=array($result[0],$result[1]);
        }  
    $req->closeCursor();

    $fp = fopen('../entrants/participants.csv','w'); // ouverture fichier
    fprintf($fp, chr(0xEF).chr(0xBB).chr(0xBF)); // Format utf-8
    foreach ($list as $personne) {              //Ecriture fichier
        fputcsv($fp,$personne);
    }
    fclose($fp);
?>