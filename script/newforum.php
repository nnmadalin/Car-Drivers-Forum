<?php
    session_start();
    $conectare = mysqli_connect('localhost', 'root', '', 'platforma_car');
    if (!$conectare)
    {
        die('Nu s-a reusit conectearea la baza de date');
    }


    $sql = "Select * from forum_stats";
	$result = mysqli_query($conectare, $sql);
	
    while($row = mysqli_fetch_array($result)){
        $id_last = $row[0];
    }


    $user = $_SESSION["login"];
    $color = '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
    $titlu = $_POST['titlu'];   
    $descriere = $_POST['descriere'];
    if ($_POST['radio'] == 1){
        $checkbox = 0;
    }else{
        $checkbox = 1;
    }
    $namee = 'forum' . strval($id_last+1);
    $data = date('d.m.Y');
    //echo $checkbox . " ---- ";

    $sql = "INSERT INTO forum_stats (name_user, title,  descriere, data_add, name_creator, privat, color) VALUES ('$namee', '$titlu', '$descriere', '$data', '$user', '$checkbox', '$color')";
    mysqli_query($conectare, $sql);

    $conectare = mysqli_connect('localhost', 'root', '', 'forum');

    $sql = "CREATE TABLE `".$namee."` (
        id BIGINT(255) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        user VARCHAR(300) NOT NULL,
        txt VARCHAR(3000) NOT NULL,
        ora VARCHAR(500)
        )";
    mysqli_query($conectare, $sql);
    
    header('location:../../main.php?');
?>  