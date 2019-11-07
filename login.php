<?php
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="assets/vendors/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/vendors/fontawesome-free-5.11.1-web/css/all.min.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <title>Site BDE Connexion</title>
    </head>

    <body>

    <!-- L'en-tête -->    
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
            <div class="row justify-content-md-center">
                    <form method="post" action="php/scriptLogin.php">  
                        <h2>Connexion</h2>
                        <?php
                            if(isset($_SESSION["connected"])){
                                if($_SESSION["connected"]==0){
                                    echo "<h3>Adresse mail ou mot de passe incorrect</h3>";
                                    $_SESSION["connected"]=NULL;
                                }
                            }
                        ?>
                        <p>
                            <label for="mail">Adresse mail</label>
                            <input type="email" name="mail" id="mail" required placeholder="adresse@mail.fr">
                        </p>
                        <p>
                            <label for="password">Mot de passe</label>
                            <input type="password" name="password" id="password" required placeholder="password">
                        </p>        
                        <input type="submit" value="Se connecter">
                        <div class="bottom-form">
                                <a href="register.php">S'enregistrer</a>
                                <a href="#">Mot de passe oublié ?</a>
                        </div>
                    </form>
            </div>
        </div>
    </main>
</body>

</html>