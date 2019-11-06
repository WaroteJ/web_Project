<?php
if (isset($_POST['lastname'],$_POST['firstname'],$_POST['mail'],$_POST['centre'],$_POST['password'],$_POST['passwordC'])){
    
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $mail = $_POST['mail'];
    $centre = $_POST['centre'];
    $password = $_POST['password'];
    $passwordC = $_POST['passwordC'];

    if (preg_match("^(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{2,}$",$password)){   
        if ($password==$passwordC) {
                require("bdd.php");      

                $found=false;
/* check if the email ain't already used

                $req= $bdd->prepare("");
                $req->bindValue(':', $, PDO::PARAM_STR);
                $req->execute();
                $res=$req->fetch();
                    if ($res[0]==$mail) {
                        $found=true;
                    }
*/
                if (!$found){
                    $password = password_hash($password,PASSWORD_BCRYPT);
/*
                    $requete = $bdd->prepare("");
                    // Liaison des variables de la requête préparée aux variables PHP
                    $requete->execute(array(
                        
                    ));
                    $requete->execute();
                    $requete->closeCursor();

                    //Redirect
*/
                }else echo "This email is already used";
            }else echo "Passwords ain't the same";
        }    
    }
?>