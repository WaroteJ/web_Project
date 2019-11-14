<?php
    require ("bdd.php");
      
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
            echo '<img class="w-75" src="'.$resultat[0].'">';
        //}
    }

    function show_comment(){
        require ("bdd.php");
        // if(isset($_GET["photo"])){
        //     $id_photo = $_GET["photo"];
            $requete = $bdd->prepare("SELECT user.nom, user.prenom, commentaire.commentaire, commentaire.id, commentaire.id_Photo 
            FROM commentaire INNER JOIN user ON commentaire.id_User = user.id  
            WHERE commentaire.id_Photo = 2 AND commentaire.signale=0 AND commentaire.deleted=0 
            ORDER BY commentaire.id");
            // $requete->bindValue(':id_Photo', $id_photo, PDO::PARAM_INT);
            $requete->execute();
            while($resultat = $requete->fetch()):          
                echo '  <div class="row m-0">
                            <div class="col-md-2 name"><span class="name_Comment">'.$resultat[0].''.$resultat[1].'</span></div>
                                <div class="col-md-8 commentaire">'.$resultat[2].'</div>'; 
                                                                
                if(isset($_SESSION["admin"])){ 
                    if($_SESSION["admin"]>0){
                            echo '  <div class="col-md-2 form_comment">
                                        <div class="container">
                                            <div class="row">   
                                                <div class="col-md-6">
                                                    <form action="php/scriptPhoto.php" method="post">
                                                        <input type="hidden" name="id_commentaire" value="'.$resultat[3].'">
                                                        <input type="hidden" name="id_photo" value="'.$resultat[4].'">
                                                        <input type="submit" alt="signaler" class="text-center btn btn-warning " value="!">
                                                    </form> 
                                                </div>';
                    }
    
                    if($_SESSION["admin"]>1){

                                echo '
                                                <div class="col-md-6">
                                                    <form action="php/scriptPhoto.php" method="post">
                                                        <input type="hidden" name="id_commentaire" value="'.$resultat[3].'">
                                                        <input type="hidden" name="id_photo" value="'.$resultat[4].'">
                                                        <input type="submit" alt="delete" class="col-md-6 text-center btn btn-danger" value="x">
                                                    </form> 
                                                </div>';
                    }
                            echo '       
                                            </div>';
                    if($_SESSION["admin"]>0){echo '</div></div></div>';}
                    
                }
            endwhile;
                echo '  </div>';         
        // }
    }

    if(isset($_POST["commentaire"])){
        session_start();
        if(isset($_SESSION["user"])){
            $id_User = $_SESSION["user"];
            if(isset($_POST["id_photo"])){
                $id_photo = $_POST["id_photo"];
                $requete = $bdd->prepare("INSERT INTO commentaire (commentaire, id_Photo, id_User) VALUES (:commentaire, :id_Photo, :id_User)");
                $requete->bindValue(':commentaire', htmlspecialchars($_POST['commentaire']), PDO::PARAM_STR);
                $requete->bindValue(':id_Photo', $id_photo, PDO::PARAM_INT);
                $requete->bindValue(':id_User', $id_User, PDO::PARAM_INT);
                $requete->execute();
                header("Location:../photo.php?photo=".$id_photo);
            }
        }
    }

    if(isset($_POST["id_commentaire"],$_POST["id_photo"])){
        $requete2 = $bdd->prepare("UPDATE `commentaire` SET `signale`=1 WHERE `id`=:id_Comment");
        $requete2->bindValue(':id_Comment', $_POST["id_commentaire"], PDO::PARAM_INT);
        $requete2->execute();
        header("Location: ../photo.php?photo=".$_POST["id_photo"]);
    }

    if(isset($_POST["id_commentaire"],$_POST["id_photo"])){
        $requete3 = $bdd->prepare("UPDATE `commentaire` SET `deleted`=1 WHERE `id`=:id_Comment");
        $requete3->bindValue(':id_Comment', $_POST["id_commentaire"], PDO::PARAM_INT);
        $requete3->execute();
        header("Location: ../photo.php?photo=".$_POST["id_photo"]);
    }
?>