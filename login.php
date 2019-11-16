<?php
session_start();
if(isset($_SESSION["centre"])){
    if($_SESSION["centre"]!=0){
        header("Location: ./index.php"); 
    }
 } 
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
        <title>BDE CESI Connexion</title>
    </head>

    <body> 
    <header>
        <div class="container-fluid">
            <div class="row">
                <img src="assets/img/site/cesi_logo.png" alt="Logo du cesi" height=100px >
                <h1 class="col-md-8 ml-auto">BDE CESI Connexion</h1>
            </div>
        </div>
    </header>

    
    <?php include('php/menu.php');?>
    <main>
    <div class="container-fluid">
            <div class="row justify-content-md-center">
                    <form class="whole_form col-lg-6 col-md-8 col-11" method="post" action="php/scriptLogin.php">  
                        <h2 class="text-white">Connexion</h2>
                        <?php
                            if(isset($_SESSION["centre"])){
                                if($_SESSION["centre"]==0){
                                    echo "<h3>Adresse mail ou mot de passe incorrect</h3>";
                                    unset($_SESSION["centre"]);
                                }
                            }
                        ?>
                        <p>
                            <label class="text-white" for="mail">Adresse mail</label>
                            <input class="form-control" type="email" name="mail" id="mail" required placeholder="adresse@mail.fr">
                        </p>
                        <p>
                            <label class="text-white" for="password">Mot de passe</label>
                            <input class="form-control" type="password" name="password" id="password" required placeholder="password">
                        </p>        
                        <input class="btn btn-primary" type="submit" value="Se connecter">
                        <div class="bottom-form">
                                <a class="text-white" href="register.php">S'enregistrer</a>
                                <a class="text-white" href="#">Mot de passe oublié ?</a>
                        </div>
                    </form>
            </div>
        </div>
    </main>
    <?php include ('php/footer.php');?>
</body>

</html>