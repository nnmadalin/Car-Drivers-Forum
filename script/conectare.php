<?php  
    $conectare = mysqli_connect('localhost', 'root', '', 'platforma_car');
    if (!$conectare)
    {
        die('Nu s-a reusit conectearea la baza de date');
    }
?>