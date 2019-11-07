<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="assets/vendors/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/vendors/fontawesome-free-5.11.1-web/css/all.min.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <title>Site BDE Inscription</title>
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
                    <form method="post" action="php/scriptRegister.php">
                        <h2>Inscription</h2>
                        <p>
                            <label for="lastname">Nom</label>
                            <input type="text" id="lastname" name="lastname" required placeholder="Nom" pattern="[A-Za-zÀ-ÖØ-öø-ÿ ]{2,25}">
                        </p>    
                        <p>
                            <label for="firstname">Prénom</label>
                            <input type="text" id="firstname" name="firstname" required placeholder="Prénom" pattern="[A-Za-zÀ-ÖØ-öø-ÿ ]{2,25}">
                        </p>    
                        <p>
                            <label for="mail">Adresse mail</label>
                            <input type="email" name="mail" id="mail" required placeholder="adresse@mail.fr">
                        </p>
                        <p>
                        <!-- Select centers from the database -->
                            <label for="centre">Centre</label> 
                            <select name="centre" id="centre" required>
                            <?php include('php/bdd.php');
                             $req= $bdd->prepare("SELECT * FROM `centre`");
                             $req->execute();

                             while($result = $req->fetch(PDO::FETCH_BOTH)){
                                echo "<option value='".$result[0]."'>".$result[1]."</option>";
                            }
                            ?>
                            </select>
                        </p>   
                        <p>
                            <label for="password">Mot de passe</label>
                            <input type="password" name="password" id="password" required placeholder="password" pattern="^(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{2,}">
                        </p>       
                        <p>
                            <label for="passwordC">Confirmation de mot de passe</label>
                            <input type="password" name="passwordC" id="passwordC" required placeholder="password confirmation" pattern="^(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{2,}">
                        </p>   
                        <input type="submit" value="S'enregistrer">
                        <div class="bottom-form">
                                <a href="login.php">Se connecter</a>
                        </div>
                    </form>
            </div>
        </div>
    </main>
</body>

</html>