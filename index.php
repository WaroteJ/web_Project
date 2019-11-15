<?php
session_start();
if(isset($_SESSION["centre"])){
    header("Location: ./centre.php"); 
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/vendors/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/vendors/fontawesome-free-5.11.1-web/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/vitrine.css">
    <title>BDE du CESI</title>
</head>
<body>
    <header>
<<<<<<< HEAD
        
=======
        <div class="container-fluid">
            <div class="row">
                <img src="assets/img/site/cesi_logo.png" alt="Logo du cesi" height=100px >
                <h1 class="col-md-8 ml-auto">BDE du CESI</h1>
            </div>
        </div>
>>>>>>> b5ef2e029c1643fc01ee30d4f6a7f41909df3abb
    </header>
    <?php include('php/menu.php');?>
    <main>
        <?php     
        if(isset($_SESSION["centre"])){
            echo $_SESSION["centre"];
        } 
        ?>
        <h2 class="col title_intro font-weight-bold">Bienvenue sur le site du BDE</h2>
    </main>
    <?php include('php/footer.php');?>
</body>
</html>