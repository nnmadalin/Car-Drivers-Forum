<?php
    require 'conectare.php';
    $email = $_POST['email'];
    $user = $_POST['user'];
    $pass =  $_POST['pass'];
    $repass =  $_POST['repass'];

    $hash = password_hash($pass, PASSWORD_DEFAULT);

    $gasit = 0;

    if ($_POST['radio'] == NULL){
        header ("Location: ../sign-in.php?info=err_ver");
    }else{

        $sql = "SELECT email, user FROM users";
        $result = mysqli_query($conectare, $sql);
        while ($row = mysqli_fetch_array($result))
        {
            if ($row['email'] == $email){
                header ("Location: ../sign-in.php?info=err-email");
                $gasit = 1;
            }
            else if ($row['user'] == $user){
                header ("Location: ../sign-in.php?info=err-user");
                $gasit = 1;
            }
        }
        if($gasit == 0){
            if (!empty($_POST['email']) && !empty($_POST['user']) &&  !empty($_POST['pass']) &&  !empty($_POST['repass']) && isset($_POST['email'] )&& isset($_POST['user']) && isset($_POST['pass']) && isset($_POST['repass'])){   
                if ($pass == $repass){
                    $sql = "INSERT INTO users (email, user, pass) VALUES ('$email', '$user', '$hash')";
                    $result = mysqli_query($conectare, $sql);
                    header ("Location: ../sign-in.php?info=ok");
                }else{
                    header ("Location: ../sign-in.php?info=erroare_pass");
                }
            }
            else {
                header ("Location: ../sign-in.php?info=erroare_comp");
            }
        }
    }
?>
