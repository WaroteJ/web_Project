<?php session_start(); ?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="assets/vendors/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/vendors/fontawesome-free-5.11.1-web/css/all.min.css">
  <link rel="stylesheet" href="assets/css/boutique.css">
  <link rel="stylesheet" href="assets/css/style.css">

  <title>Boutique</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</head>
<body>
    <header class="">
        <div class="container-fluid">
            <div class="row">
            <img src="assets/img/site/cesi_logo.png" alt="Logo du cesi" height=100px >
                <h1 class="col-md-8 ml-auto">Boutique du BDE</h1>
            </div>
        </div>
    </header>
    <?php include('php/menu.php') ?>
    <main>
        <div class="event">
            <h3>Meilleures ventes :</h3>
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active ">
                        <img src="https://www.comptoir-irlandais.com/12804-large_default/pull-lambswool-rond-orange-celtic-alliance.jpg" class="d-block w-30 mx-auto" alt="top1">
                        </div>
                        <div class="carousel-item">
                        <img src="https://www.comptoir-irlandais.com/12804-large_default/pull-lambswool-rond-orange-celtic-alliance.jpg" class="d-block w-30 mx-auto" alt="top2">
                        </div>
                        <div class="carousel-item">
                        <img src="https://www.comptoir-irlandais.com/12804-large_default/pull-lambswool-rond-orange-celtic-alliance.jpg" class="d-block w-30 mx-auto" alt="top3">
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
        </div>
    </div>
    <div class="container-fluid articles">
        <div class="row filtre">
            <div class="col-4">
                <form>
                    <h2>Filtres</h2>
                    <p>
                        <label for="priceUp">Prix croissant</label>
                        <input type="checkbox" id="up" name="filtre">
                    </p>
                    <p>
                        <label for="priceDown">Prix décroissant</label>
                        <input type="checkbox" id="down" name="filtre">
                    </p>
                    <p>
                        <label for="type">Type</label>
                        <input type="checkbox" id="type" name="filtre">
                    </p>
                </form>
            </div>
            <div class="col-8 container-fluid bigvitrine">
                <div class="row">
                    <div class="col-12 container vitrine">
                        <div class="row results" >

                    
                
                </div>
            </div>
        </div>
    </main>

<?php include('php/footer.php') ?>
</body>
<script src="assets/js/boutique.js"></script>
</html>