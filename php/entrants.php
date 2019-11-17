<?php
    if(!isset($_SESSION["centre"])){
        header("Location: ../index.php");
    }
    
    function getEntrants($id){
        require("bdd.php");
        $list=array();
        //Sélectionne les participants à un évènement
        $req = $bdd->prepare("SELECT user.nom,user.prenom,event.nom,event.date
        FROM (user LEFT JOIN event_user ON user.id = event_user.id_User) 
        INNER JOIN event ON event_user.id= event.id WHERE event_user.id=:id");
        $req->execute(array(
            ':id'=>$id
        ));
        $name='';
        while($result = $req->fetch(PDO::FETCH_BOTH)){
            $list[]=array($result[0],$result[1]);
            $name=$result[2].'_'.$result[3];
            }  
        $req->closeCursor();

        ob_end_clean(); // Clean the output
        header('Content-disposition: attachment; filename="'.$name.'"');
        header('Content-type: application/csv');
        $fp = fopen('php://output','w'); // Ouvre l'output dans la mémoire php
        
        fprintf($fp, chr(0xEF).chr(0xBB).chr(0xBF)); // Format utf-8
        foreach ($list as $personne) {              //Ecriture fichier
            fputcsv($fp,$personne);
        }
        exit();
    }
?>