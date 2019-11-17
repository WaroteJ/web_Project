<?php 
    session_start();
    if(!isset($_SESSION["centre"])){
        header("Location: ./index.php"); 
     }
    if(!isset($_GET["photo"])){
        header("Location: ./evenements.php");
    }
    require("php/bdd.php");
    $requete = $bdd->prepare("SELECT photo.`id` 
    FROM `photo` 
    INNER JOIN event ON photo.id_Event=event.id
    WHERE event.`id_centre`=:id_centre AND photo.`deleted`=0 AND photo.`id`=:id");
    $requete->execute(array(
        ':id_centre'=>$_SESSION['centre'],
        ':id'=>$_GET["photo"]
    ));
    $result = $requete->fetch(PDO::FETCH_BOTH);
    if($result[0]==NULL){
        header("Location: ./evenements.php");
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
  <title>BDE CESI <?php echo $_SESSION['nomCentre']?> Photo</title>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
    <?php include('php/menu.php') ?>
    <main>
        <?php include 'php/scriptPhoto.php' ?>
        <div class="text-center">

                <?php recup_photo($_GET['photo']) ?>
        </div>
        <div class="text-center">
            <form class="bottom-article button" action="" method="post">
                <?php aime($_GET['photo']) ?>
            </form>

        </div>
        <h2 class="com">Commentaires</h2>  
        <div class="blog container-fluid">
                <?php show_comment($_GET['photo']); ?>
        </div>
        <?php if(isset($_SESSION["user"])){
        echo <<<HTML
            <div class="container-fluid">
                    <form class="row" action="php/scriptPhoto.php" method="post">
                        <input type="text" class="col-md-10 text-center" name="commentaire" placeholder="Ecrire votre commentaire ici..." size="150">
                        <input type="hidden" name="id_photo" value="echo {$_GET['photo']}">
                        <input type="submit" class="col-md-2 text-center btn btn-success" value="Poster">
                    </form>
            </div>
HTML;
        }?>
    </main>

<?php include('php/footer.php') ?>

</body>
</html>