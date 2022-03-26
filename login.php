<!DOCTYPE html>
<html>
	<head>
		<title>All for the cars!</title>
		<link rel="icon" href="Image/icon.png" type="icon/png">
		<link rel="stylesheet" href="css/style-login.css">
		<meta charset="UTF-8">
	</head>
	<body>
		<img class="background" src="Image\bkc.jpg">
		<div id="firts">
			<div class="div_title">		
					<img class="ico"  onclick="window.location.href='index.html'" src="Image/outline_home_white_48dp.png">
					<p class="title">All for the cars!</p>
			</div>

			<div class="div_name">
				<h1 class="name-h1">Autentificare!</h1>
			</div>

			<div class="div_system">
				<form action="script/sc-login.php" method="POST">
					<div class="e-mail">
						<p class="text-in">Nume de utilizator:<p>
						<input type="Username" class="eminput" id="user" placeholder="Introdu numele de utilizator" name="user">
					</div>

					<div class="parola">
						<p class="text-in">Parola:<p>
						<input type="password" class="passinput" id="pass" placeholder="Indrodu parola" name="pass">
					</div>

					<div class="info-web"></div>

					<div class="div_button">
						<button type="submit" class="text-subb" value="Submit">Autentificare</button>
						<p class="gand">Nu ai cont? <a class="link" href="sign-in.php">Înregistrează-te</a></p>
						<?php
							if (isset($_GET['info']) && $_GET['info'] == 'gresit'){
								echo '<p class="text" style="text-align: center; font-weight: bold;">Numele de utilizator sau parola este gresita!</p>';
							}else if (isset($_GET['info']) && $_GET['info'] == 'space'){
								echo '<p class="text" style="text-align: center; font-weight: bold;">Spațiile nu au fost completate!</p>';
							}else if (isset($_GET['info']) && $_GET['info'] == 'fail'){
								echo '<p class="text" style="text-align: center; font-weight: bold;">Nu esti autentificat pe platforma :(</p>';
							}
						?>
					</div>

				</form>
			</div>
		</div>
	</body>
</html>