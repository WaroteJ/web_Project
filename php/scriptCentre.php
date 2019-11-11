<?php
    require("bdd.php"); 

    if(isset($_SESSION["centre"])){
        $first=true;
        $id_center = $_SESSION["centre"];
        $requete = $bdd->prepare("SELECT photo.url FROM photo INNER JOIN event ON id_Event = photo.id_Event WHERE id_centre = :id_centre ORDER BY event.date LIMIT 3");
        // Liaison des variables de la requête préparée aux variables PHP
        $requete->bindValue(':id_centre', $id_center, PDO::PARAM_INT);
        // Exécution de la requête
        $requete->execute();
        
        while($result = $requete->fetch()):          
        ?><div class="carousel-item <?php if($first){echo 'active';$first=false;}?>">
        <?php
        echo '<img class="carousel-event-image" src="'.$result[0].'" class="d-block w-70" alt="logo_bad">
            </div>';
        endwhile;    
        }
?>