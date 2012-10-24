<!DOCTYPE html>
<html lang="de-de">
	<head>
		<meta charset="utf-8" />
		<title>Mess-App Verwaltung</title>
		<link href="<?php echo $template_url; ?>favicon.ico" rel="shortcut icon" type="image/x-icon" />
		<link rel="stylesheet" href="<?php echo $template_url; ?>css/sample.css" />
		<script src="<?php echo $template_url; ?>js/jquery.js"></script>
		<script src="<?php echo $template_url; ?>js/list.js"></script>
		
		<?php if(isset($header)) { echo $header; } ?>
	
	</head>
	<body>
	
		<?php echo $systemMessages; ?>
	
		<?php echo $mainContent; ?>
	    
	    
	    <noscript>
	    	Warning! JavaScript must be enabled for proper operation of the Administrator back-end.
	    </noscript>
	    
</html>
