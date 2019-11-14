<?php session_start(); ?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="assets/vendors/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/vendors/fontawesome-free-5.11.1-web/css/all.min.css">
  <link rel="stylesheet" href="assets/css/article.css">
  <link rel="stylesheet" href="assets/css/style.css">

  <title>Article</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</head>
<body>
    <header>
        <div class="container-fluid">
            <div class="row">
            <img src="assets/img/site/cesi_logo.png" alt="Logo du cesi" height=100px >
                <h1 class="col-md-8 ml-auto">Boutique du BDE</h1>
            </div>
        </div>
    </header>
    <?php include('php/menu.php') ?>
    <main>
        <div class="container-fluid b">
            <div class="col article a">
            <div class ='filtre col-3'>
                <form action='php/addPanier.php' method="POST">
                    <label for='qte'>Quantité</label>
                    <input type='number' name='qte' id='qte' min='1' max='100'>
                    <input type='hidden' id='qte_art' name='id_art'>
                    <input type='submit' value='Ajouter'>
                </form>
        </div>     
            </div>
        </div>
        </div>
    </main>

<?php include('php/footer.php') ?>

</body>
<script src="assets/js/articles.js"></script>
</html>