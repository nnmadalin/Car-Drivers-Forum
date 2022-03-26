<?php
    session_start();
 
    if (session_id() == '' || !isset($_SESSION['login'])){
        header("Location: ../login.php");
    }
    else{
        header("Location: ../main.php");
    }
?>