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
  <link rel="stylesheet" href="assets/css/panier.css">
  <title>BDE CESI <?php echo $_SESSION['nomCentre']?> Panier</title>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
    <?php include('php/menu.php') ?>
    <main>
        <?php include('php/scriptPanier.php') ?>
        <h2>Mon Panier :</h2>
        <div class="panier">
            <table>
                    <thead class="container-fluid">
                        <tr class="row border">
                            <th class="col-md-5">Article</th>
                            <th class="col-md-3">Prix Unitaire</th>
                            <th class="col-md-3">Quantité</th>
                            <th class="col-md-1"></th>
                        </tr>
                    </thead>
                    <tbody class="container-fluid">
                        <?php recup_infos(); ?>
                    </tbody>
            </table>
        </div>
        <div class="container px-0">
            <div class="conteneur-prix container col-12">
                <div class="prix col-4">    
                    <p class="text-white"><strong>Prix Commande TTC:</strong></p>
                    <p class="text-center text-white pan"><?php echo calcul_prix(); ?></p>
                </div>
            </div>
        </div>
        <?php 
        if(((int)calcul_prix())>0){
            echo <<<HTML
            <div class="valider_button container">
                <a href="confirm_basket.php">
                    <div class="btn btn-success">
                        <p>Valider</p>
                    </div>
            </div>
HTML;
        }
        ?>
    </main>

<?php include('php/footer.php') ?>

</body>
<!-- <script type="text/javascript" src="assets/js/check_basket.js"></script> -->
</html>