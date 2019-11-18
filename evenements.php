<?php
session_start();
if(!isset($_SESSION["centre"])){
    header("Location: index.php"); 
 } 

require_once('php/bdd.php');
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
        <link rel="stylesheet" href="assets/css/events.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <title>BDE CESI <?php echo $_SESSION['nomCentre']?> Evénements</title>
    </head>

    <body>
    <?php include('php/menu.php');?>
    <main>
    <div class="container-fluid">
            <div class="row events border"> 
                <?php include('php/scriptListEvent.php') ?>
                
        </div>
    </main>
    <?php include ('php/footer.php');?>
</body>

</html>