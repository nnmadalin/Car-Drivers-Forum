<?php  
    $conectare = mysqli_connect('localhost', 'root', '', 'forum');
    if (!$conectare)
    {
        die('Nu s-a reusit conectearea la baza de date');
    }
?>