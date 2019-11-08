<?php
session_start();

if (isset($_POST['mail'],$_POST['password'])){
    
    $mail = $_POST['mail'];
    $password = $_POST['password'];
        require("bdd.php");      

        $requete = $bdd->prepare("SELECT `id`,`droit`,`password`,`id_Centre` FROM `user` WHERE `email`=:mail");
        // Liaison des variables de la requête préparée aux variables PHP
        $requete->bindValue(':mail', $mail, PDO::PARAM_STR);
        // Exécution de la requête
        $requete->execute();

        $result = $requete->fetch(PDO::FETCH_BOTH);
        echo $result[1];
        if (password_verify($password,$result[2])){
           switch ($result[1]) {
               case 0:
                    $_SESSION['admin'] = 0;
                    $_SESSION['connected']=$result[3];
                    header("Location: ../index.php"); 
                    exit();

                break;
               
                case 1:
                    $_SESSION['admin'] = 1;
                    $_SESSION['connected']=$result[3];
                    header("Location: ../index.php"); 
                    exit();

                break;

                case 2:
                    $_SESSION['admin'] = 2;
                    $_SESSION['connected']=$result[3];
                    header("Location: ../index.php"); 
                    exit();

                break; 

                default:
                   # code...
                break;
           }
        }else{
            $_SESSION['connected']=0;
            header("Location: ../login.php"); 
            exit();
        };
        // Fermeture de la connexion
        $requete->closeCursor();
    }
?>