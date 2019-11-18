<?php
session_start();
if(isset($_SESSION["centre"])){
    header("Location: ./centre.php"); 
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
    <title>BDE CESI : Choix du centre</title>
</head>
<body>
    <?php include('php/menu.php');?>
    <main>
    <div class="container-fluid">
        <div class="row">
            <?php include('php/displayCentre.php');?>
        </div>
    </div>
    </main>
    <?php include('php/footer.php');?>
</body>
</html>