<?php 
    session_start();
    if(!isset($_SESSION["centre"])){
        header("Location: ./index.php"); 
     }
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="assets/vendors/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/vendors/fontawesome-free-5.11.1-web/css/all.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <title>Accueil centre</title>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
    <header class="">
        <div class="container-fluid">
            <div class="row">
            <img src="assets/img/site/cesi_logo.png" alt="Logo du cesi" height=100px >
                <h1 class="col-md-8 ml-auto">Site du BDE</h1>
            </div>
        </div>
    </header>
    <?php include('php/menu.php') ?>
    <main>
        <div class="event container-fluid">
            <div class="col">
                <h3>Dernier Evénement :</h3>
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                        <img src="assets/img/evenement/logo_bad.png" class="d-block w-100" alt="logo_bad">
                        </div>
                        <div class="carousel-item">
                        <img src="assets/img/evenement/raquette.png" class="d-block w-100" alt="raquette">
                        </div>
                        <div class="carousel-item">
                        <img src="assets/img/evenement/joueur.png" class="d-block w-100" alt="joueur">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <div>
                    <h2>Membres du BDE:</h2>
                    <div class="row">
                        <p class="col-6"><img src="assets/img/membre_bde/avatar.png">Jérôme Pihet</p>
                        <p class="col-6"><img src="assets/img/membre_bde/avatar.png">Sofiane Benazouzi</p>
                        <p class="col-6"><img src="assets/img/membre_bde/avatar.png">Adrien Basset</p>
                        <p class="col-6"><img src="assets/img/membre_bde/avatar.png">Florian Etchart</p>
                    </div>
                </div>
            </div>
        </div>
</main>

<?php include('php/footer.php') ?>

</body>
</html>