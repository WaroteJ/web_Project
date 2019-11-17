<?php
    require('bdd.php');

    if (isset($_POST["val"],$_POST["id"])){
        $_SESSION["centre"]=$_POST["id"];
        header("Location: centre.php");
    }
    $req=$bdd->prepare('SELECT * FROM `centre` ');
    $req->execute();

    while ($response = $req->fetch()) {
        echo <<<HTML
            <div class="col-md-3 col-12">
                <h2>{$response[1]}</h2>
                <form action="" method="post">
                    <input type="hidden" name="id" value="{$response[0]}">
                    <input class="btn btn-success" type="submit" name="val" value="Aller vers ce centre">
                </form>
            </div>

HTML;
    }
?>