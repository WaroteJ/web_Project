<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="description" content="Site du BDE CESI, accès aux évènements et aux boutiques des différents BDE">
        <link rel="stylesheet" href="assets/vendors/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/vendors/fontawesome-free-5.11.1-web/css/all.min.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <title>BDE CESI Connexion</title>
    </head>

    <body> 
    <?php 
    include('php/menu.php');
    require("php/scriptForgottenPass.php");
    require("php/input_secure.php");
    ?>
    <main>
    <?php 
    if (!isset($_POST["mail"])&& !isset($_POST["pass"])){
    echo <<<HTML
    <div class="container-fluid">
        <div class="row justify-content-md-center">
                <form class="whole_form col-lg-6 col-md-8 col-11" method="post" action="">  
                    <h2 class="text-white">Mot de passe oublié</h2>
                    <label class="text-white" for="mail">Adresse mail</label>
                    <input class="form-control" type="mail" name="mail">
                    <input class="btn btn-primary"type="submit" value="Récupérer mot de passe">
                </form>
        </div>
    </div>
HTML;
    }
    else if(isset($_POST["mail"])){
        mailPass();
        echo <<<HTML
        <div class="container-fluid">
            <div class="row justify-content-md-center">
                    <form class="whole_form col-lg-6 col-md-8 col-11" method="post" action="">  
                        <h2 class="text-white">Mot de passe oublié</h2>
                        <input type="hidden" name="mailS" value="{$_POST['mail']}">
                        <label class="text-white" for="mdp">Mot de passe temporaire</label>
                        <input class="form-control" type="password" name="pass">
                        <input class="btn btn-primary"type="submit" value="Réinitialiser">
                    </form>
            </div>
        </div>
HTML;
    }
    if(isset($_POST["pass"])){
        echo <<<HTML
        <div class="container-fluid">
            <div class="row justify-content-md-center">
                    <form class="whole_form col-lg-6 col-md-8 col-11" method="post" action="">  
                        <h2 class="text-white">Mot de passe oublié</h2>
                        <input type="hidden" name="mailS" value="{$_POST['mailS']}">
                        <label class="text-white" for="passR">Nouveau mot de passe</label>
                        <input class="form-control" type="password" name="passR">
                        <label class="text-white" for="passC">Confirmation mot de passe</label>
                        <input class="form-control" type="password" name="passC">
                        <input class="btn btn-primary"type="submit" value="Confirmer">
                    </form>
            </div>
        </div>
HTML;
    }
    if(isset($_POST["passR"],$_POST["passC"])){
        resetPass();
    }
    ?>
    </main>
    <?php include ('php/footer.php');?>
</body>
</html>
