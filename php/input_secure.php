<?php

    function inputSecure($data) {
    $data = trim($data); // Retire les charactères d'espacement
    $data = stripslashes($data); // Retire les backslashes
    $data = htmlspecialchars($data); // Converti les charactères "<>" pour éviter l'ajout de balise html
    return $data;
    }

?>