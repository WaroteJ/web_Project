<?php
        
    function recup_photo(){
        require("bdd.php");
        // if(isset($_GET["photo"])){
        //     $id_photo = $_GET["photo"];
            $requete = $bdd->prepare("SELECT photo.url FROM photo  WHERE photo.id = 2");
            // Liaison des variables de la requête préparée aux variables PHP
            //$requete->bindValue(':id_photo', $id_photo, PDO::PARAM_INT);
            // Exécution de la requête
            $requete->execute();
            $resultat=$requete->fetch();
            echo '<img src="'.$resultat[0].'">';
        //}
    }
?>