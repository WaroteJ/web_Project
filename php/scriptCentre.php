<?php
    require("bdd.php"); 

    if(isset($_SESSION["centre"])){
        $first=true;
        $id_center = $_SESSION["centre"];
        $requete = $bdd->prepare("SELECT photo.url FROM photo 
                                    INNER JOIN event ON photo.id_Event=event.id 
                                    WHERE id_centre = 1 AND event.id=(SELECT event.id 
                                                                    FROM event
                                                                    WHERE event.date<='".date('Y-m-d')."'
                                                                    ORDER BY event.date DESC
                                                                    LIMIT 1)
                                    ORDER BY `event`.`date`");
        // Liaison des variables de la requête préparée aux variables PHP
        $requete->bindValue(':id_centre', $id_center, PDO::PARAM_INT);
        // Exécution de la requête
        $requete->execute();
        
        while($result = $requete->fetch()):          
        ?><div class="carousel-item col-12 w-100 <?php if($first){echo 'active';$first=false;}?>">
        <?php
        echo '<img style="max-height:800px;" src="'.$result[0].'" class="d-block mx-auto w-100" alt="logo_bad">
            </div>';
        endwhile;    
        }
?>