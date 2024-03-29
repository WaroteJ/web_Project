<?php
session_start();

require ("bdd.php");

if (isset($_POST['qte'],$_POST['id_art']) && $_POST['qte'] > 0 ){

    $qte_newArticle = $_POST['qte'];
    $id_newArticle = $_POST['id_art'];
    $diff = 0;
    // Select the article to check if it's not already required
    $prep = $bdd->prepare('SELECT  id, qte FROM user_article WHERE id_User = :id_User');   
    $prep->execute(array(
        ':id_User' => $_SESSION['user'],
    ));
    // check if it's not already required
    while($response = $prep->fetch()){
        if($id_newArticle == $response['id']){
            $qte_final= $response['qte'] + $qte_newArticle;
            $prepa = $bdd->prepare('UPDATE user_article SET qte = :qte_final WHERE id_User = :id_User AND id = :id_Article');   
            $prepa->execute(array(
                ':id_User' => $_SESSION['user'],
                'id_Article'=> $id_newArticle,
                'qte_final'=>$qte_final, 
            ));
            $diff = 1;
        } 
    }
    // If the article is not required
    if($diff == 0){
        $prep = $bdd->prepare('INSERT INTO `user_article` (id,id_User,qte) 
        VALUES(:id,:id_User,:qte)');     
        $prep->execute(array(
            'id' => $id_newArticle,
            'id_User' => $_SESSION['user'],
            'qte' => $qte_newArticle,
        ));
    }
}

echo '<meta http-equiv="refresh" content="0.1;URL=../boutique.php">';

?>