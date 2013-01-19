<!DOCTYPE html>
<html lang="de-de">
	<head>
		<meta charset="utf-8" />
		<title>Mess-App Verwaltung</title>
		<link href="<?php echo $template_url; ?>favicon.ico" rel="shortcut icon" type="image/x-icon" />
		<link rel="stylesheet" href="<?php echo $template_url; ?>css/ui-lightness/jquery-ui-1.10.0.custom.min.css" />
		<link rel="stylesheet" href="<?php echo $template_url; ?>css/layout.css" />
		<script src="<?php echo $template_url; ?>js/jquery.js"></script>
		<script src="<?php echo $template_url; ?>js/jquery-ui-1.10.0.custom.min.js"></script>
		<script src="<?php echo $template_url; ?>js/list.js"></script>
		<script src="<?php echo $template_url; ?>js/listBox.js"></script>
		<?php if(isset($header)) { echo $header; } ?>

		<script>
			function save() {
				$('form#form input[type=\'submit\']').trigger('click');
				$("div.laodingOverlay").show();
			}
			
			var offset = "left+3 top+7";
			// Implementierung der Tooltips
			$(document).ready(function() {
				$( ".tooltip" ).each(function() {
					$(this).tooltip({
						position: {
					        my: offset,
						}
					});
				});
			});

			//Entfernen des Overlay, wenn Seite fertig geladen wurde
			$(document).ready(function() {
				$("div.laodingOverlay").hide();
			});
		</script>
		<style>
			/* Custom Style für Tooltips */
			.ui-tooltip {
	    		padding: 4px;
	    		font-size: 10pt;
	  		}
		</style>
		
	</head>
	<body>
		<!--  Beginn Overlay -->
		<div class="laodingOverlay" style="
			position:fixed; 
			top:0; 
			left:0; 
			width:100%; 
			height:100%; 
			z-index: 1000; 
			
			background-color:#FFFFFF; 
			opacity: .7;
			-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=70)";
			filter: alpha(opacity=70);	
		">
			
		</div>
		<div class="laodingOverlay" style="
			position:fixed; 
			top:50%; 
			left:50%; 
			z-index: 1001;
		">
			<div style="position:relative; left:-50px; top:-50px;">
				<img src="<?php echo $template_url; ?>images/loading.gif" height="100px" width="auto" />
			</div>
		</div>
		<!-- Ende Ovelray -->
		
		<div id="headerbar">
			<div id="home" class="separator-right">
				<div>
					<a href="<?php echo base_url().index_page()."/" . $this->router->routes["default_controller"]; ?>" title="Startseite" class="tooltip" >
						<img alt="home" src="<?php echo $template_url; ?>images/home.png" />
					</a>
				</div>
				<img alt="Home" src="<?php echo $template_url; ?>images/home.png" />
			</div>
			<?php if($studiengangDetail) { ?>
			<div id="new" class="separator-right">
				<div>
					<a onClick="javascript:redirectWithSave('<?php echo $studiengangDetail; ?>', 0)">
						<img alt="home" src="<?php echo $template_url; ?>images/new.png" />
					</a>
				</div>
				<img alt="Neuer Studiengang" src="<?php echo $template_url; ?>images/new.png" title="Neuer Studiengang" class="tooltip"  />
			</div>
			<?php } ?>
			<div id="pageTitle"><h1><?php echo $page_title; ?></h1></div>
			<div id="logout" class="separator-left">
				<a href="<?php echo base_url().index_page()."/login/logout"; ?>">
					<img src="<?php echo $template_url; ?>images/logout.png" alt="Logout" />
				</a>
			</div>
		</div>
		<div class="clear"></div>
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
	    <input type="hidden" name="templateURL" value="<?php echo $template_url; ?>" />
</html>
