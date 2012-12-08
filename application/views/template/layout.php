<!DOCTYPE html>
<html lang="de-de">
	<head>
		<meta charset="utf-8" />
		<title>Mess-App Verwaltung</title>
		<link href="<?php echo $template_url; ?>favicon.ico" rel="shortcut icon" type="image/x-icon" />
		<link rel="stylesheet" href="<?php echo $template_url; ?>css/layout.css" />
		<script src="<?php echo $template_url; ?>js/jquery.js"></script>
		<script src="<?php echo $template_url; ?>js/list.js"></script>
		
		<?php if(isset($header)) { echo $header; } ?>
	
	</head>
	<body>
	
		<div id="headerbar">
			<div id="home">
				<div>
					<a href="<?php echo base_url().index_page()."/" . $this->router->routes["default_controller"]; ?>">
						<img alt="home" src="<?php echo $template_url; ?>images/home.png" />
					</a>
				</div>
				<img alt="home" src="<?php echo $template_url; ?>images/home.png" />
			</div>
			<div id="logout">
				<a href="<?php echo base_url().index_page()."/login/logout"; ?>">
					<img src="<?php echo $template_url; ?>images/logout.png" alt="logout" />
				</a>
			</div>
		</div>
		<div class="clear"></div>
		<?php echo $systemMessages; ?>
		<div id="sidebar">
			<?php echo $sidebar; ?>
		</div>
		<div style="clear: right"></div>
		
		<div id="content">
			<?php echo $mainContent; ?>
	    </div>
	    <noscript>
	    	Warning! JavaScript must be enabled for proper operation of the Administrator back-end.
	    </noscript>
	    
</html>
