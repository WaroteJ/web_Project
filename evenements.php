<?php
session_start();
if(isset($_SESSION["centre"])){
    header("Location: ./index.php"); 
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
        <link rel="stylesheet" href="assets/css/events.css">
        <title>Site BDE Events</title>
    </head>

    <body>

    <!-- L'en-tête -->    
    <header>
        <div class="container-fluid">
            <div class="row">
                <img src="assets/img/site/cesi_logo.png" alt="Logo du cesi" height=100px >
                <h1 class="col-md-8 ml-auto">Site du BDE Evenements</h1>
            </div>
        </div>
    </header>

    
    <?php include('php/menu.php');?>
    <main>
    <div class="container-fluid">
            <div id=events class="row justify-content-md-center"> 
                  <article>
                        <h2> 2nd Tournoi de Badminton</h2>
                    
                        <p>
                            <label for="lieu">Collège Paul Fort</label>
                        </p>
                        <p>
                            <label for="dateheure">15/11/2019 18h30</label>
                        </p>
                        <p>
                            <label for="dateheure">15/11/2019 18h30</label>
                        </p>
                        <div class="bottom-article">
                                <a href="#">Plus d'informations</a>
                        </div>
                </article>
                <article>
                        <h2>Soirée jeux vidéos</h2>
                    
                        <p>
                            <label for="lieu">Locaux du CESI</label>
                        </p>
                        <p>
                            <label for="dateheure">08/11/2019 19h00</label>
                        </p>
                        <div class="bottom-article">
                                <a href="#">Plus d'informations</a>
                        </div>
                </article>
                <article>
                        <h2>Tournoi de Badminton</h2>
                    
                        <p>
                            <label for="lieu">Collège Paul Fort</label>
                        </p>
                        <p>
                            <label for="dateheure">11/10/2019 18h30</label>
                        </p>
                        <div class="bottom-article">
                                <a href="#">Plus d'informations</a>
                        </div>
                </article>
        </div>
    </main>
    <?php include ('php/footer.php');?>
</body>

</html>