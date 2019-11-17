<?php
    session_start();
    if(!isset($_SESSION["centre"])){
        header("Location: ./index.php"); 
    }
    if(!isset($_GET["event"])){
        header("Location: ./evenements.php");
    }
    require("php/bdd.php");
    $requete = $bdd->prepare("SELECT `id` FROM `event` WHERE `id_centre`=:id_centre AND `deleted`=0 AND `id`=:id");
    $requete->execute(array(
        ':id_centre'=>$_SESSION['centre'],
        ':id'=>$_GET["event"]
    ));
    $result = $requete->fetch(PDO::FETCH_BOTH);
    if($result[0]==NULL){
        header("Location: ./evenements.php");
    }
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
    <?php include('php/menu.php');?>
    <main>
    <div class="container-fluid">
            <div class="row events border">                 
                <?php include('php/scriptEvent.php') ?>
        </div>
    </main>
    <?php include ('php/footer.php');?>
</body>

</html>