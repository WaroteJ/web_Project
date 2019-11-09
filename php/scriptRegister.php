<?php
include('input_secure.php');

if (isset($_POST['lastname'],$_POST['firstname'],$_POST['mail'],$_POST['centre'],$_POST['password'],$_POST['passwordC'])){
    
    $lastname = inputSecure($_POST['lastname']);
    $firstname = inputSecure($_POST['firstname']);
    $mail = inputSecure($_POST['mail']);
    $centre = inputSecure($_POST['centre']);
    $password = inputSecure($_POST['password']);
    $passwordC = inputSecure($_POST['passwordC']);

    if (preg_match("/^(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{2,}$/",$password)){   
        if ($password==$passwordC) {
                require("bdd.php");      

                $found=false;

                $req= $bdd->prepare("SELECT `email` FROM `user` WHERE `email`=:mail");
                $req->bindValue(':mail', $mail, PDO::PARAM_STR);
                $req->execute();
                $res=$req->fetch();
                    if ($res==$mail) {
                        $found=true;
                    }

                if (!$found){
                   $password = password_hash($password,PASSWORD_BCRYPT);

                    $requete = $bdd->prepare("INSERT INTO `user`(`nom`, `prenom`, `email`, `password`, `id_Centre`) 
                    VALUES (:lastname,:firstname,:mail,:psword,:centre)");
                    // Liaison des variables de la requête préparée aux variables PHP
                    $requete->execute(array(
                        "lastname"=>$lastname,  
                        "firstname"=>$firstname, 
                        "mail"=>$mail, 
                        "psword"=>$password, 
                        "centre"=>$centre,                       
                    ));
                    $requete->closeCursor();
                    header("Location: ../login.php"); 
                    exit();
                }else echo "This email is already used";
            }else echo "Passwords ain't the same";
        }    
    }
?>