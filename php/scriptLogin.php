<?php
session_start();
include('input_secure.php');

if (isset($_POST['mail'],$_POST['password'])){
    
    $mail = inputSecure($_POST['mail']);
    $password = inputSecure($_POST['password']);
        require("bdd.php");      

        $requete = $bdd->prepare("SELECT user.`id`,user.`droit`,user.`password`,user.`id_Centre`,centre.nom 
        FROM `user` LEFT JOIN centre ON user.id_Centre=centre.id WHERE `email`=:mail");
        // Liaison des variables de la requête préparée aux variables PHP
        $requete->bindValue(':mail', $mail, PDO::PARAM_STR);
        // Exécution de la requête
        $requete->execute();

        $result = $requete->fetch(PDO::FETCH_BOTH);
        echo $result[1];
        if (password_verify($password,$result[2])){ // Si le mot de passe est bon, on connecte l'utilisateur à son centre en lui donnant des droits appropriés 
            $_SESSION['user']=$result[0];
            switch ($result[1]) {
               case 0:
                    $_SESSION['admin'] = 0;
                    $_SESSION['centre']=$result[3];
                    $_SESSION['nomCentre']=$result[4];
                    header("Location: ../index.php"); 
                    exit();
                    break;
               
                case 1:
                    $_SESSION['admin'] = 1;
                    $_SESSION['centre']=$result[3];
                    $_SESSION['nomCentre']=$result[4];
                    header("Location: ../index.php"); 
                    exit();
                    break;

                case 2:
                    $_SESSION['admin'] = 2;
                    $_SESSION['centre']=$result[3];
                    $_SESSION['nomCentre']=$result[4];
                    header("Location: ../index.php"); 
                    exit();
                    break; 

                default:
                   # code...
                    break;
            }
        }else{ //Sinon on le renvoie sur la page de login
            $_SESSION['centre']=0;
            header("Location: ../login.php"); 
            exit();
        };
        // Fermeture de la connexion
        $requete->closeCursor();
    }
?>