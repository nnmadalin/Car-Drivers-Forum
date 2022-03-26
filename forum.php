<?php
    session_start();
	$forumid = $_COOKIE["forumid"];
    if (session_id() == '' || !isset($_SESSION['login'])){
        header("Location: ../login.php");
    }
	if ($forumid == '' || !isset($forumid)){
		header("Location: ../main.php");
	}
?>


<!DOCTYPE html>
<html>
	<head>
		<title>All for the cars!</title>
		<link rel="icon" href="Image/icon.png" type="icon/png">
		<link rel="stylesheet" href="../../css/style-forum.css">
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1"/>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

		
	</head>
	<body>
		<div class="div_show">
			<div class="show_text" id="show_text">
            <?php
				$forumid = $_COOKIE["forumid"];
                $conectare = mysqli_connect('localhost', 'root', '', 'forum');
                $sql = "SELECT * FROM $forumid";
                $result = mysqli_query($conectare, $sql);
                $resultCheck = mysqli_num_rows($result);
                if ($resultCheck > 0){
                    while ($row = mysqli_fetch_assoc($result)){
                        echo "<b style = 'font-size:15px; font-weight: bold;'>" . $row['user'] . "</b>";
                        echo "<b style='font-size:13pt; padding: 5px; margin-top:5px; margin-bottom:5px;'>" . ": " . '&nbsp &nbsp' .  $row['txt'] . "</b>" . "<br> <br> <br>";

                    }
                }
            ?>
            </div>
		</div>

		<div class="div_text">
			<form class="form" method="POST" action="../../script/sc-frm.php">
					<input type="text" class="text-add" id="txt" name='text' style="font-size:13pt;">
					<button type="submit" class="bt-send"value="send">Trimite</button>
					
					<script>
						var input = document.getElementById('txt');
						input.focus();
						input.select();
					</script>
			</form>
		</div>
		
	</body>
</html>

