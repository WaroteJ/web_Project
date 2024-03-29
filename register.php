<?php
session_start();
if(isset($_SESSION["centre"])){
    header("Location: ./index.php"); 
 } 
?>
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
        <title>BDE CESI Inscription</title>
        <script></script>
    </head>

    <body>
    <?php include('php/menu.php');?>
    <main>
        

        <div class="container-fluid">
            <div class="row justify-content-md-center">
                    <form class="whole_form col-lg-6 col-md-8 col-11" method="post" action="php/scriptRegister.php">
                        <h2 class="text-white" >Inscription</h2>
                        <?php
                        if(isset($_SESSION['error'])){ // Variable d'erreur en cas de problème lors de l'enregistrement
                            if($_SESSION['error']==1){
                                echo "<h3>Adresse mail déjà utilisée</h3>";
                                unset($_SESSION['error']);
                            }
                            else if($_SESSION['error']==2){
                                echo "<h3>Mots de passe non identiques</h3>";
                                unset($_SESSION['error']);
                            }
                        }
                        ?>
                        <p>
                            <label class="text-white" for="lastname">Nom</label>
                            <input class="form-control" type="text" id="lastname" name="lastname" required placeholder="Nom" pattern="[A-Za-zÀ-ÖØ-öø-ÿ \-]{2,25}" maxlength="25">
                        </p>    
                        <p>
                            <label class="text-white" for="firstname">Prénom</label>
                            <input class="form-control" type="text" id="firstname" name="firstname" required placeholder="Prénom" pattern="[A-Za-zÀ-ÖØ-öø-ÿ \-]{2,25}" maxlength="25">
                        </p>    
                        <p>
                            <label class="text-white" for="mail">Adresse mail</label>
                            <input class="form-control" type="email" name="mail" id="mail" required placeholder="adresse@mail.fr" maxlength="50">
                        </p>
                        <p>
                        <!-- Select centers from the database -->
                            <label class="text-white" for="centre">Centre</label> 
                            <select class="form-control" name="centre" id="centre" required>
                            <?php include('php/bdd.php');
                             $req= $bdd->prepare("SELECT * FROM `centre` ORDER BY `nom`");
                             $req->execute();

                             while($result = $req->fetch(PDO::FETCH_BOTH)){
                                echo "<option value='".$result[0]."'>".$result[1]."</option>";
                            }
                            ?>
                            </select>
                        </p>   
                        <p>
                            <label class="text-white" for="password">Mot de passe</label>
                            <input class="form-control" type="password" name="password" id="password" required placeholder="password" pattern="^(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{2,50}" maxlength="50">
                        </p>       
                        <p>
                            <label class="text-white" for="passwordC">Confirmation de mot de passe</label>
                            <input class="form-control" type="password" name="passwordC" id="passwordC" required placeholder="password confirmation" pattern="^(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{2,50}" maxlength="50">
                        </p>
                        <input class="form-control" type="checkbox" name="CGU" id="CGU" required><label class="text-white" for="CGU">J'accepte les <a href="mentions_legales.php" target="_blank">CGU</a></label>
                        <input class="form-control" type="checkbox" name="CGV" id="CGV" required><label class="text-white" for="CGV">J'accepte les <a href="conditions_ventes.php" target="_blank">CGV</a></label> 
                        <input class="btn btn-primary" type="submit" value="S'enregistrer">
                        <div class="bottom-form">
                                <a class="text-white" href="login.php">Se connecter</a>
                        </div>
                    </form>
            </div>
        </div>
    </main>
    <?php include ('php/footer.php');?>
</body>

</html>