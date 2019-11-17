<?php
  require ('../bdd.php');

  if(isset($_POST['id_article'])){
    $id_article = $_POST['id_article'];



  // Set the selected article on deleted = 1
    $req = $bdd->prepare('UPDATE `article` SET `deleted`=1 WHERE `id` = :id_article');    
      $req->execute(array(
      ':id_article' => $id_article,
      ));
      // Redirecting the user to boutique.php
      echo '<meta http-equiv="refresh" content="1;URL=../../boutique.php">';


      $req = $bdd->prepare('UPDATE `article` SET `deleted`=1 WHERE `id` = :id_article');    
        $req->execute(array(
        ':id_article' => $id_article,
        ));
    }
  echo '<meta http-equiv="refresh" content="0.1;URL=../../boutique.php">';
?>