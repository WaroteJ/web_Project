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
  <link rel="stylesheet" href="assets/css/panier.css">
  <title>Page des événements</title>
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
        <h2>Mon Panier :</h2>
        <div class="panier">
            <table>
                    <thead class="container-fluid">
                        <tr class="row border">
                            <th class="col-6">Article</th>
                            <th class="col-3">Prix</th>
                            <th class="col-3">Quantité</th>
                        </tr>
                    </thead>
                    <tbody class="container-fluid">
                        <tr class="row border">
                            <td class="col-6">The table body</td>
                            <td class="col-3">with two columns</td>
                            <td class="col-3">6</td>
                        </tr>
                        <tr class="row border">
                            <td class="col-6">The table body</td>
                            <td class="col-3">with two columns</td>
                            <td class="col-3">6</td>
                        </tr>
                    </tbody>
            </table>
        </div>
        <div class="container px-0">
            <div class="conteneur-prix container col-12">
                <div class="prix col-4">    
                    <p class="text-white"><strong>Prix Commande TTC:</strong></p>
                    <p class="text-center text-white">...</p>
                </div>
            </div>
        </div>
        <div class="valider_button container">
            <a href="validation_commande.php">
            <div class="bouton_admin">
                <p>Valider</p>
            </div>
        </div>
    </main>

<?php include('php/footer.php') ?>

</body>
</html>