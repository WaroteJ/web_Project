<?php
   /*     if(!empty($_SERVER['REMOTE_AADR'])){
                header("HTTP/1.1 403 Forbidden");
                die("Access denied.");
        }*/
        $bdd = new PDO('mysql:host=localhost;dbname=bde;charset=utf8', 'root','');
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>