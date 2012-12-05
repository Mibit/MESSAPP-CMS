<!DOCTYPE html>
<html lang="de-de">
<head>
<meta charset="utf-8" />
<title>Mess-App Verwaltung</title>
<link href="favicon.ico" rel="shortcut icon" type="image/x-icon" />
<link rel="stylesheet" href="<?php echo $template_url; ?>css/login.css" />
<script src="<?php echo $template_url; ?>js/jquery.js"></script>
<script src="<?php echo $template_url; ?>js/login.js"></script>
</head>
<body>

	<img class="fhLogo"
		src="<?php echo $template_url; ?>images/fh_logo.png"
		style="width: 25%; height: 25%" />
	<?php echo $systemMessages; ?>
	<div class="loginBg">
	<br />
			<?php echo form_open("{$my_url}/authentification", array("name" => "loginForm", "id" => "loginForm")); ?>
			<label for="username">Username</label>
			<?php echo form_input(array("name" => "username", "id" => "username"), $username); ?>
			<br /> <label for="password">Passwort</label>&nbsp;&nbsp;&nbsp;<input name="password"
				id="password" type="password" /> <br /> <input type="submit"
				value="Login" />

			<?php echo form_close(); ?>
	</div>
	<noscript>Warning! JavaScript must be enabled for proper operation of
		the Administrator back-end.</noscript>

</body>
</html>
