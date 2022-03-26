<?php
    session_start();
 
    if (session_id() == '' || !isset($_SESSION['login'])){
        header("Location: ../login.php");
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

		<script>
			$(document).ready(function()
			{
				setInterval(function(){
					$("#show_text").load("../../script/show-data-dt.php");
					refresh();
				},500);
			});
		</script>
	</head>
	<body>
		<div class="div_show">
			<div class="show_text" id="show_text"></div>
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

