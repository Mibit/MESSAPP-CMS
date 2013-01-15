<!DOCTYPE html>
<html lang="de-de">
<head>
<meta charset="utf-8" />
<title>Mess-App Verwaltung</title>
<link href="favicon.ico" rel="shortcut icon" type="image/x-icon" />
<link rel="stylesheet" href="<?php echo $template_url; ?>css/layout.css" />
<link rel="stylesheet" href="<?php echo $template_url; ?>css/login.css" />
<script src="<?php echo $template_url; ?>js/jquery.js"></script>
<script src="<?php echo $template_url; ?>js/login.js"></script>
</head>
<body>
	
	<img class="fhLogo"
		src="<?php echo $template_url; ?>images/fh_logo.png"
		style="width: 25%; height: 25%" />
	
	<div class="loginBg">
		<h1>MessApp CMS</h1>
		<div>
			<?php echo form_open("{$my_url}/authentification", array("name" => "loginForm", "id" => "loginForm")); ?>
			<table id="loginTable">
			<tr>
			<td><label for="username">Username</label></td>
			<td><?php echo form_input(array("name" => "username", "id" => "username"), $username); ?></td>
			</tr>
			<tr>
			<td><label for="password">Passwort</label>
			</td>
			<td><input name="password"
				id="password" type="password"/>
				</td>
				</tr> 
				</table>
				<div style="text-align: right; padding-right: 28px;">
				<button type="submit" name="login">Login</button>
				</div>
			<?php echo form_close(); ?>
			</div>
	</div>
	<div id="status"><?php echo $systemMessages; ?></div>
	<noscript>Warning! JavaScript must be enabled for proper operation of
		the Administrator back-end.</noscript>

</body>
</html>
