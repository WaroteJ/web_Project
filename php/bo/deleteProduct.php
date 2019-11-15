<?php

$id_article = $_POST['id_article'];

require ('../bdd.php');



$req = $bdd->prepare('UPDATE `article` SET `deleted`=1 WHERE `id` = :id_article');    
    $req->execute(array(
		':id_article' => $id_article,
    ));

    echo '<meta http-equiv="refresh" content="1;URL=../../boutique.php">';


?>