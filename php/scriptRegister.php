<?php
session_start();
include('input_secure.php');

if (isset($_POST['lastname'],$_POST['firstname'],$_POST['mail'],$_POST['centre'],$_POST['password'],$_POST['passwordC'])){
//inputSecure is a function to block js script, ...  
    $lastname = inputSecure($_POST['lastname']);
    $firstname = inputSecure($_POST['firstname']);
    $mail = inputSecure($_POST['mail']);
    $centre = inputSecure($_POST['centre']);
    $password = inputSecure($_POST['password']);
    $passwordC = inputSecure($_POST['passwordC']);

    if (preg_match("/^(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{2,}$/",$password)){   //Vérifie qu'il y ait 1 lettre maj et un chiffre
        if ($password==$passwordC) { // Vérifie que les 2 mdp sont identiques
                require("bdd.php");      

                $found=false;

                $req= $bdd->prepare("SELECT `email` FROM `user` WHERE `email`=:mail");
                $req->bindValue(':mail', $mail, PDO::PARAM_STR);
                $req->execute();
                $res=$req->fetch();
                    if ($res[0]==$mail) {
                        $found=true;
                    }

                if (!$found){ // si l'adresse mail n'est pas dans la bdd
                   $password = password_hash($password,PASSWORD_BCRYPT); 

                    //on insère le nouvel utilisateur
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
                }else{                    
                    $_SESSION['error']=1;
                    header("Location: ../register.php"); 
                    exit();
                };
            }else{
                $_SESSION['error']=2;
                header("Location: ../register.php"); 
                exit();
            }
        }    
    }
?>