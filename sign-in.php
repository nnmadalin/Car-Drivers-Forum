<!DOCTYPE html>
<html>
	<head>
		<title>All for the cars!</title>
		<link rel="icon" href="Image/icon.png" type="icon/png">
		<link rel="stylesheet" href="css/style-sign-in.css">
		<meta charset="UTF-8">
	</head>
	<body>
		<img class="background" src="Image\bkc.jpg">
			<div class="div_title">		
					<img class="ico"  onclick="window.location.href='index.html'" src="Image/outline_home_white_48dp.png">
					<p class="title">All for the cars!</p>
			</div>

			<div class="div_name">
				<h1 class="name-h1">Inregistrează-te!</h1>
			</div>

				<form class="form" method="POST" action="script/signup.php">
					<div class="e-mail">
						<p class="text-in">E-mail:<p>
						<input type="emaisl" class="email" id="email" placeholder="Indrodu adresa de e-mail" name="email">
					</div>

					<div class="div_user">
						<p class="text-in">Nume de utilizator:<p>
						<input type="text" class="user" id="user" placeholder="Indrodu numele de utilizator" name="user">
					</div>

					<div class="parola">
						<p class="text-in">Parola:<p>
						<input type="password" class="pass" id="pass" placeholder="Indrodu parola" name="pass">
					</div>

					<div class="reparola">
						<p class="text-in">Confirmă parola:<p>
						<input type="password" class="repass"id="repass" placeholder="Reconfirmă parola" name="repass">
					</div>

					<div class="info-web"></div>

					<div class="div_button">
					<label class="container">Nu esti robot!
						<input name="radio" type="checkbox" value = 1>
						<span class="checkmark"></span>
					</label>
						<button type="submit" class="text-subb" value="Submit">Inregistrează-te</button>
						<p class="gand">Ai deja cont? <a class="link" href="login.php">Autentifica-te</a></p>
						<?php
							if (isset($_GET['info']) && $_GET['info'] == 'ok'){
								echo '<p class="text" style="text-align: center; font-weight: bold;">Contul a fost creat cu succes!</p>';
							}else if (isset($_GET['info']) && $_GET['info'] == 'erroare_pass'){
								echo '<p class="text" style="text-align: center; font-weight: bold;">Parolele nu corespund!</p>';
							}else if (isset($_GET['info']) && $_GET['info'] == 'erroare_comp'){
								echo '<p class="text" style="text-align: center; font-weight: bold;">Spatiile nu au fost completate!</p>';
							}
							else if (isset($_GET['info']) && $_GET['info'] == 'err-email'){
								echo '<p class="text" style="text-align: center; font-weight: bold;">Acest email este deja adaugat!</p>';
							}
							else if (isset($_GET['info']) && $_GET['info'] == 'err-user'){
								echo '<p class="text" style="text-align: center; font-weight: bold;">Numele de utilizator este deja adaugat!</p>';
							}
							else if (isset($_GET['info']) && $_GET['info'] == 'err_ver'){
								echo '<p class="text" style="text-align: center; font-weight: bold;">Bifeaza ca NU esti robot!</p>';
							}
						?>
					</div>
				</form>
	</body>
</html>