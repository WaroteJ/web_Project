<?php 
    session_start();

    unset($_SESSION['centre']);
    unset($_SESSION['admin']);
    session_destroy();
    header("Location: ../index.php")
?>
