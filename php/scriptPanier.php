<?php
    
    function recup_infos(){
        require("bdd.php");
        if(isset($_SESSION["user"])){
            $id_User = $_SESSION["user"];
            if(isset($_POST["supp"],$_POST["id"])){
                $req = $bdd->prepare('DELETE FROM `user_article` WHERE `id_User`=:id_User AND `id`=:id_art');
                $req->execute(array(
                    ':id_User'=>$id_User,
                    ':id_art'=>$_POST["id"]
                ));
            }
            $requete = $bdd->prepare("SELECT article.nom_article, article.prix, user_article.qte, article.id FROM user_article INNER JOIN article ON article.id = user_article.id WHERE id_User = :id_User");
            // Liaison des variables de la requête préparée aux variables PHP
            $requete->bindValue(':id_User', $id_User, PDO::PARAM_INT);
            //execution de la requête
            $requete->execute();
            while($result = $requete->fetch()):          
                echo'<tr class="row border">
                        <td class="col-md-5">'.$result[0].'</td>
                        <td class="col-md-3">'.$result[1].'</td>
                        <td class="col-md-3">'.$result[2].'</td>
                        <td class="col-md-1"> 
                        <form method="post" class="cross">
                            <input type="hidden" name="id" id="id" value="'.$result[3].'">
                            <input class="supp_input" type="submit" value="X" name="supp">
                        </form>
                        </td>
                    </tr>';
            endwhile;
        }
    }
        global $prix_ttc;
        function calcul_prix(){
            require("bdd.php");
            $prix_ttc = 0;
            if(isset($_SESSION["user"])){
                $first=true;
                $id_User = $_SESSION["user"];
                $requete = $bdd->prepare("SELECT article.prix, user_article.qte FROM user_article INNER JOIN article ON article.id = user_article.id WHERE id_User = :id_User");
                // Liaison des variables de la requête préparée aux variables PHP
                $requete->bindValue(':id_User', $id_User, PDO::PARAM_INT);
                //execution de la requête
                $requete->execute();
            while($result = $requete->fetch()):
                 //calcul du prix total en fonction du prix unitaire et de la quantité          
                 $prix_ttc += $result[0]*$result[1];
            endwhile;
            //affichage du prix de la commande
            return $prix_ttc." euros";
            }
        }
?>