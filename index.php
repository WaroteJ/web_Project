<?php
session_start();
if(isset($_SESSION["centre"])){
    header("Location: ./centre.php"); 
} 
?>

<!DOCTYPE html>
<html lang="en">
<html lang="fr">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Site du BDE CESI, accès aux évènements et aux boutiques des différents BDE">
    <link rel="stylesheet" href="assets/vendors/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/vendors/fontawesome-free-5.11.1-web/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/vitrine.css">
    <title>BDE du CESI</title>
</head>
<body>
    <?php include('php/menu.php');?>
    <main>
        <h2 class="col title_intro font-weight-bold">Bienvenue sur le site du BDE</h2>
    </main>
    <?php include('php/footer.php');?>
</body>
</html>