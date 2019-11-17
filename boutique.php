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

  <title>Boutique du BDE <?php echo $_SESSION['nomCentre']?></title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</head>
<body>
    <header class="">
        <div class="container-fluid">
            <div class="row">
            <img src="assets/img/site/cesi_logo.png" alt="Logo du cesi" height=100px >
                <h1 class="col-md-8 ml-auto">Boutique du BDE <?php echo $_SESSION['nomCentre']?></h1>
            </div>
        </div>
    </header>
    <?php include('php/menu.php') ?>
    <main>
        <div class="container">
            <div class="event row">
                <h3 class="col-12 text-center font-weight-bold underline">Meilleures ventes</h3>
                <div id="carouselExampleFade" class="carousel slide carousel-fade col-12 w-100 mx-auto" data-ride="carousel">
                    <div class="carousel-inner row">
                    
                    </div>
                    <a class="carousel-control-prev carousel-button-left" href="#carouselExampleFade" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next carousel-button-right" href="#carouselExampleFade" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <div class="basket">               
                    <i id="panier" name="panier" class="fas fa-shopping-basket fa-5x"></i>
                </div>
            </div>        
        
        </div>
        
    </div>
    
    <div class="container-fluid articles">
        <div class="row filtre">
            <div class="col-md-4">
                <form class="whole_form">
                    <h2 class="text-white">Filtres</h2>
                    <p>
                        <label class="text-white" for="priceUp">Prix croissant</label>
                        <input type="checkbox" id="up" name="filtre">
                    </p>
                    <p>
                        <label class="text-white" for="priceDown">Prix décroissant</label>
                        <input type="checkbox" id="down" name="filtre">
                    </p>
                </form>
            </div>
            <div class="col-md-8 container-fluid bigvitrine">
                <div class="row">
                    <div class="col-12 container vitrine">
                        <div class="row results" >

                    
                
                </div>
            </div>
        </div>
    </main>

<?php include('php/footer.php');
  
?>
</body>
<?php 
if(isset($_SESSION['admin'])){
    echo "<input type='hidden' id='admin' name='centre' value= ".$_SESSION['admin'] .">";     
}
?>
<script src="assets/js/boutique.js"></script>
</html>