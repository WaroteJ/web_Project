<?php
    require("bdd.php");

    if(isset($_SESSION["user"])){
        $date = date('Y-m-d');
        $id_User = $_SESSION["user"];
        $requete = $bdd->prepare("INSERT INTO commande (date, id_User) VALUES (:date, :id_User)");
        // Liaison des variables de la requête préparée aux variables PHP
        $requete->bindValue(':date', $date, PDO::PARAM_STR);
        $requete->bindValue(':id_User', $id_User, PDO::PARAM_INT);
        //execution de la requête
        $requete->execute();

        $requete2 = $bdd->prepare("SELECT user_article.id as id_article, commande.id as id_commande, user_article.qte as qte 
        FROM user_article INNER JOIN commande ON user_article.id_User = commande.id_User 
        WHERE commande.id_User = :id_User 
        AND `commande`.`id`= (SELECT MAX(id) FROM `commande`)");
        // Liaison des variables de la requête préparée aux variables PHP
        $requete2->bindValue(':id_User', $id_User, PDO::PARAM_INT);
        //execution de la requête
        $requete2->execute();

        while($result = $requete2->fetch()):
            //echo $result['id_article'];
            $requete3 = $bdd->prepare("INSERT INTO article_commande (id, id_Commande, qte) VALUES (:id_art, :id_commande, :qte)");
            // Liaison des variables de la requête préparée aux variables PHP et excution de la requete
            $requete3->execute(array(
                ':id_art'=>$result['id_article'],
                ':id_commande'=>$result['id_commande'],
                ':qte'=>$result['qte']
            ));
        endwhile;

        $requete4 = $bdd->prepare("DELETE FROM user_article WHERE id_User = :id_User");
        // Liaison des variables de la requête préparée aux variables PHP
        $requete4->bindValue(':id_User', $id_User, PDO::PARAM_INT);
        //execution de la requête
        $requete4->execute();

     //   $requete5
        $to = "pihet.jerome@gmail.com";
        $subject = "Nouvelle commande";
        $txt = "Une nouvelle commande vient d'être effectué";
        $headers = 'From: noreply-bde@gmail.com';
        mail($to,$subject,$txt,$headers);

    }
?>