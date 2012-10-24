<!DOCTYPE html>
<html lang="de-de">
	<head>
		<meta charset="utf-8" />
		<title>Mess-App Verwaltung</title>
		<link href="favicon.ico" rel="shortcut icon" type="image/x-icon" />
		<link rel="stylesheet" href="<?php echo $template_url; ?>css/sample.css" />
		<script src="<?php echo $template_url; ?>js/jquery.js"></script>
		<script src="<?php echo $template_url; ?>js/login.js"></script>
	</head>
	<body>
	
		<?php echo $systemMessages; ?>
	
		<?php echo form_open("{$my_url}/authentification", array("name" => "loginForm", "id" => "loginForm")); ?>
			<p>
		    	<label for="username">Username</label>
		        <?php echo form_input(array("name" => "username", "id" => "username"), $username); ?>
		    </p>
		    <p>
		    	<label for="password">Passwort</label>
		        <input name="password" id="password" type="password" />
		    </p>
		    <input type="submit" value="Login" />
		<?php echo form_close(); ?>    
		   
		<noscript>
			Warning! JavaScript must be enabled for proper operation of the Administrator back-end.
		</noscript>
		
	</body>
</html>