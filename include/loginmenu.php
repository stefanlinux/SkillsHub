<link rel="stylesheet" href="css/login.css" type="text/css" media="screen" />
<div class="menu">
	<div class="menucontent">
		<img class="logo" src="img/logo.png" height="60px" />
		<div class="form">
			<form action="" method="post">
				<div class="field">
					<label  style="margin: 0px 0 0 22px; position: relative;" for="username">Gebruikersnaam</label>
					<input type="text" name="username" id="username" autocomplete="off">
				</div>

				<div class="field">
					<label  style="margin: 0px 0 0 22px; position: relative;" for="password">Wachtwoord</label>
					<input type="password" name="password" id="password" autocomplete="off">
				</div>

				<div class="field">
					<label for="remember">
						<input type="checkbox" name="remember" id="remember">Onthoud mij
				</div> 

				<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
				<input type="submit" value="Log in">
			</form>
		</div>
	</div>
</div>
<div class="nav schaduw"></div>
