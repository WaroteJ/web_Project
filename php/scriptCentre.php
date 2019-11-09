<?php
    require("bdd.php"); 

    if(isset($_SESSION["centre"])){
        $id_center = $_SESSION["centre"];
        $requete = $bdd->prepare("SELECT photo.url FROM photo INNER JOIN event ON id_Event = photo.id_Event WHERE id_centre = :id_centre ORDER BY event.date LIMIT 3");
        // Liaison des variables de la requête préparée aux variables PHP
        $requete->bindValue(':id_centre', $id_center, PDO::PARAM_INT);
        // Exécution de la requête
        $requete->execute();
        
        while($result = $requete->fetch()):          
        echo'<div class="carousel-item active">
            <img src="'.$result[0].'" class="d-block w-100" alt="logo_bad">
            </div>
            <div class="carousel-item active">
            <img src="'.$result[1].'" class="d-block w-100" alt="logo_bad">
            </div>
            <div class="carousel-item active">
            <img src="'.$result[2].'" class="d-block w-100" alt="logo_bad">
            </div>';


        endwhile;    
        }
?>