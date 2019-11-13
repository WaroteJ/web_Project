<?php
session_start();
if(!isset($_SESSION["centre"])){
    header("Location: index.php"); 
 } 

require_once('php/bdd.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="assets/vendors/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/vendors/fontawesome-free-5.11.1-web/css/all.min.css">
        <link rel="stylesheet" href="assets/css/events.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <title>Site BDE Events</title>
    </head>

    <body>

    <!-- L'en-tête -->    
    <header>
        <div class="container-fluid">
            <div class="row">
                <img src="assets/img/site/cesi_logo.png" alt="Logo du cesi" height=100px >
                <h1 class="col-md-8 ml-auto">Site du BDE Evenements</h1>
            </div>
        </div>
    </header>

    
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