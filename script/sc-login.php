<?php
session_start();
	require 'conectare.php';

	$user = $_POST['user'];
	$pass = $_POST['pass'];

	$sql = "SELECT * FROM users WHERE user='$user'";
	$result = mysqli_query($conectare, $sql);
	$row = $result->fetch_assoc();
	$hash  = $row['pass'];

	$check = password_verify($pass, $hash);

		if (!empty($_POST['user']) && !empty($_POST['pass']) && isset($_POST['user'] )&& isset($_POST['pass'])){       
			if ($check == 0){
				header("Location: ../login.php?info=gresit");
				die();
			}else{
				$sql = "SELECT ver FROM users WHERE user='$user' AND pass='$hash'";
				$result = mysqli_query($conectare, $sql);

				if ($row == '-1'){
					header("Location: ../login.php?info=gresit");
				}
				else{
					$_SESSION['login'] = $_POST['user'];
					header("Location: ../main.php");
				}
			}
		}
		else {
			header ("Location: ../login.php?info=space");
		}
?>