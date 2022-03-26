<?php
    session_start();
    $forumid = $_COOKIE["forumid"];
    
    $user = $_SESSION["login"];
    $text = $_POST['text'];

    $data = date('d.m.Y');
    if (!empty($_POST['text'])){    
        
        $sql = "INSERT INTO $forumid (user, txt, ora) VALUES ('$user', '$text', '$data')";
        $conectare = mysqli_connect('localhost', 'root', '', 'forum');
        $result = mysqli_query($conectare, $sql);
    }

    header("Location: ../forum.php");
?>
