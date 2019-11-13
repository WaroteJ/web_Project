<?php
session_start();

if (!isset($_SESSION['centre'])){
    header("Location: login.php");
    exit();
}
if ($_SESSION['admin']!=2){
    header("Location: centre.php");
    exit();  
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/vendors/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/vendors/fontawesome-free-5.11.1-web/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>BDE du CESI</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/admin.js"></script>  
</head>
<body>
    <header>
        <div class="container-fluid">
            <div class="row">
                <img src="assets/img/site/cesi_logo.png" alt="Logo du cesi" height=100px >
                <h1 class="col-md-8 ml-auto">Site du BDE</h1>
            </div>
        </div>
    </header>

    <?php include('php/menu.php');?>

    <main>
    <div class="container-fluid">
            <div id="admin_buttons" class="row">
                <a class="col-lg-2 col-md-3 col-6" href="admin.php?page=newEvent"> <!-- Fonctionnalités du BO -->
                    <div class="bouton_admin">
                        <i class="fas fa-calendar fa-3x"></i> 
                        <p>Créer un évènement</p>
                    </div>
                </a>
                <a class="col-lg-2 col-md-3 col-6" href="admin.php?page=newArticle">
                    <div class="bouton_admin">
                        <i class="fas fa-tshirt fa-3x"></i> 
                        <p>Ajouter un article</p>
                    </div>
                </a>
                <a class="col-lg-2 col-md-3 col-6" href="admin.php?page=newCat">
                    <div class="bouton_admin">
                        <i class="fas fa-random fa-3x"></i> 
                        <p>Ajouter une catégorie</p>
                    </div>
                </a>
                <a class="col-lg-2 col-md-3 col-6" href="admin.php?page=users">
                    <div class="bouton_admin">
                        <i class="fas fa-users fa-3x"></i> 
                        <p>Modifier droits utilisateur</p>
                    </div>
                </a>
                <a class="col-lg-2 col-md-3 col-6" href="admin.php?page=command">
                    <div class="bouton_admin">
                        <i class="fas fa-shopping-basket fa-3x"></i> 
                        <p>Suivi des commandes</p>
                    </div>
                </a>
                <a class="col-lg-2 col-md-3 col-6" href="admin.php?page=commandHistory">
                    <div class="bouton_admin">
                        <i class="fas fa-book-open fa-3x"></i> 
                        <p>Historique des commandes</p>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <?php
    require("php/bdd.php");
    require("php/input_secure.php");
        if(isset($_GET['page'])){
            switch ($_GET['page']) {
                case 'newEvent':
                    require("php/bo/newEvent.php");
                    break;

                case 'newArticle':
                    require("php/bo/newArticle.php");
                    break;
                    
                case 'newCat':
                    require("php/bo/newCat.php");
                    break;      

                case 'users':
                    require("php/bo/users.php");
                    break;        

                case 'command':
                    require("php/bo/command.php");
                    break; 

                case 'commandHistory':
                    require("php/bo/commandHistory.php");
                    break;
                    
                default:
                    # code...
                    break;
            }
        }
    ?>
    </main>
    <?php include('php/footer.php');?>
</body>
</html>
 