<?php
    if(!isset($_SESSION["centre"])){
        header("Location: ../index.php");
    }   
    require ("bdd.php");
      
    function recup_photo($id_photo){
        require("bdd.php");
            $requete = $bdd->prepare("SELECT photo.url FROM photo  WHERE photo.id = $id_photo");
            // Liaison des variables de la requête préparée aux variables PHP
            $requete->bindValue(':id_photo', $id_photo, PDO::PARAM_INT);
            // Exécution de la requête
            $requete->execute();
            $resultat=$requete->fetch();
            echo '<img class="img_comment" src="'.$resultat[0].'">';
        //}
    }

    function show_comment($id_photo){
        require ("bdd.php");
            $requete = $bdd->prepare("SELECT user.nom, user.prenom, commentaire.commentaire, commentaire.id, commentaire.id_Photo 
            FROM commentaire INNER JOIN user ON commentaire.id_User = user.id  
            WHERE commentaire.id_Photo = $id_photo AND commentaire.signale=0 AND commentaire.deleted=0 
            ORDER BY commentaire.id");
             $requete->bindValue(':id_Photo', $id_photo, PDO::PARAM_INT);
            $requete->execute();
            while($resultat = $requete->fetch()):          
                echo '  <div class="row m-0 comment">
                            <div class="col-md-2 name"><span class="name_Comment">'.$resultat[0].' '.$resultat[1].'</span></div>
                                <div class="col-md-8 commentaire">'.$resultat[2].'</div>'; 
                                                                
                if(isset($_SESSION["admin"])){ 
                    if($_SESSION["admin"]>0){
                            echo <<<HTML
                             <div class="col-md-2 form_comment">
                                        <div class="container">
                                            <div class="row">   
                                                <div class="col-md-6">
                                                    <form action="php/scriptPhoto.php" method="post">
                                                        <input type="hidden" name="id_commentaire" value="{$resultat[3]}">
                                                        <input type="hidden" name="id_photo" value="{$resultat[4]}">
                                                        <input type="submit" name="report" alt="signaler" class="text-center btn btn-warning " value="!">
                                                    </form> 
                                                </div>
HTML;
                    }
    
                    if($_SESSION["admin"]>1){

                                echo <<<HTML
                                                <div class="col-md-6">
                                                    <form action="php/scriptPhoto.php" method="post">
                                                        <input type="hidden" name="id_commentaire" value="{$resultat[3]}">
                                                        <input type="hidden" name="id_photo" value="{$resultat[4]}">
                                                        <input type="submit" name="del" alt="delete" class="text-center btn btn-danger" value="x">
                                                    </form> 
                                                </div>
HTML;
                    }
                            echo '</div>';
                    if($_SESSION["admin"]>0){echo '</div></div></div>';}
                    
                }
                else{
                    echo '</div>';
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

    if(isset($_POST["id_commentaire"],$_POST["id_photo"],$_POST["report"])){
        $requete2 = $bdd->prepare("UPDATE `commentaire` SET `signale`=1 WHERE `id`=:id_Comment");
        $requete2->bindValue(':id_Comment', $_POST["id_commentaire"], PDO::PARAM_INT);
        $requete2->execute();
        header("Location: ../photo.php?photo=".$_POST["id_photo"]);
    }

    if(isset($_POST["id_commentaire"],$_POST["id_photo"],$_POST["del"])){
        $requete3 = $bdd->prepare("UPDATE `commentaire` SET `deleted`=1 WHERE `id`=:id_Comment");
        $requete3->bindValue(':id_Comment', $_POST["id_commentaire"], PDO::PARAM_INT);
        $requete3->execute();
        header("Location: ../photo.php?photo=".$_POST["id_photo"]);
    }
      
    function aime($id){
        require('bdd.php');
        if(isset($_POST["aime"])){
            $req = $bdd->prepare('INSERT INTO user_photo (id, id_User) VALUES (:id_photo, :idUser)');
            $req->execute(array(
                'idUser' => $_SESSION["user"],
                'id_photo' => $id
            ));
        }
        if(isset($_POST["aime_pas"])){
            $req = $bdd->prepare('DELETE FROM user_photo WHERE id=:id_photo AND id_User= :id_User');
            $req->execute(array(
                'id_User' => $_SESSION["user"],
                'id_photo' => $id
            ));
        }
        if(isset($_SESSION["user"])){
            if(isset($id)){
                $req = $bdd->prepare('  SELECT COUNT(user_photo.id_User) as aime
                                        FROM user_photo
                                        WHERE id=:id_photo AND id_User= :id_User');
                $req->execute(array(
                    'id_User' => $_SESSION["user"],
                    'id_photo' => $id
                ));
                $aime = $req->fetch();

                if ( $aime[0] > 0  ) {
                    echo'   <input class="btn btn-primary" type="submit" value="Unlike" name="aime_pas">';               
                }else{
                    echo'   <input class="btn btn-primary" type="submit" value="Like" name="aime">';                   
                }
            }
        }
    } 
?>