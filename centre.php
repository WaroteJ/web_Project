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
  <meta name="description" content="Site du BDE CESI, accès aux évènements et aux boutiques des différents BDE">
  <link rel="stylesheet" href="assets/vendors/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/vendors/fontawesome-free-5.11.1-web/css/all.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <title>BDE CESI <?php echo $_SESSION['nomCentre']?> Accueil</title>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
    <?php include('php/menu.php') ?>
    <main>
        <div class="container-fluid">
            <div class="row">
                <h2 class="col-12 text-center font-weight-bold underline">Dernier Evénement </h2>
                <div style="padding-right:0px !important;" id="carouselExampleFade" class="carousel slide carousel-fade col-10 w-100 mx-auto" data-ride="carousel">
                    <div class="carousel-inner row">
                        <?php include('php/scriptCentre.php');?>
                    </div>
                    <a class="carousel-control-prev carousel-left" href="#carouselExampleFade" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next carousel-right" href="#carouselExampleFade" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
                
            <div class="row">
                <h2 class="col-12 text-center font-weight-bold underline" >Membres du BDE</h2>
                
                    <?php
                        $req= $bdd->prepare("SELECT `nom`,`prenom` FROM `user` WHERE `id_Centre`=:id AND `droit`=2");
                        $req->bindValue(':id', $_SESSION["centre"], PDO::PARAM_STR);
                        $req->execute();

                        while($result = $req->fetch(PDO::FETCH_BOTH)){
                            echo '<div class="col-12 col-md-6">
                                    <div class="row">
                                        <img class="col-8" src="assets/img/membre_bde/avatar.png" alt="Photo utilisateur">
                                        <p class="col-4 text-center font-weight-bold align-self-center">'.$result[0].' '.$result[1].'</p>
                                    </div>
                                </div>';
                        }       
                    ?>
                
            </div>
        </div>
    </div>
</main>

<?php include('php/footer.php') ?>

</body>
</html>