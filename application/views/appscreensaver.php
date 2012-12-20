<?php echo form_open("{$my_url}save", array("name" => "form", "id" => "form", "enctype" => "multipart/form-data")); ?>

<div class="template">
	<fieldset>
		<table>
			<tr>
				<td><label for="scrText1">Text 1: </label><?php echo form_input(array("name" => "scrText1", "value" => "")); ?></td>
			</tr>
			<tr>
				<td><label for="scrText2">Text 2: </label><?php echo form_input(array("name" => "scrText2", "value" => "")); ?></td>
			</tr>
			<tr>
				<td>
					<label for="scrImage">Bild: </label>
					
						<a href="" class="thickbox"></a>
						<?php echo form_upload(array("name" => "scrImage", "value" => "")); ?>
					</td>
			</tr>
		</table>
	</fieldset>
</div>

<div class="stgForm">
<?php if(!count($screensaver)) : ?>
	
	<fieldset>
		<table>
			<tr>
				<td><label for="scrText1">Text 1: </label><?php echo form_input(array("name" => "scrText1", "value" => "")); ?></td>
			</tr>
			<tr>
				<td><label for="scrText2">Text 2: </label><?php echo form_input(array("name" => "scrText2", "value" => "")); ?></td>
			</tr>
			<tr>
				<td>
					<label for="scrImage">Bild: </label>
					
						<a href="" class="thickbox"></a>
						<?php echo form_upload(array("name" => "scrImage", "value" => "")); ?>
					</td>
			</tr>
		</table>
	</fieldset>

<?php 
	else : 
		foreach($screensaver as $scr) : ?>


<?php echo form_hidden("scrID", $scr->scrID); ?>

	<fieldset>
		<table>
			<tr>
				<td><label for="scrText1">Text 1: </label><?php echo form_input(array("name" => "scrText1", "value" => $scr->scrText1)); ?></td>
			</tr>
			<tr>
				<td><label for="scrText2">Text 2: </label><?php echo form_input(array("name" => "scrText2", "value" => $scr->scrText2)); ?></td>
			</tr>
			<tr>
				<td>
					<label for="scrImage">Bild: </label>
					
						<a href="<?php echo "data:image/jpeg;base64," . base64_encode($scr->scrImage) ?>" class="thickbox"><?php if($scr->scrImage) { echo "<img src=\"data:image/jpeg;base64," . base64_encode($stg->scrImage). "\" />"; } ?></a>
						<?php echo form_upload(array("name" => "scrImage", "value" => $scr->scrImage)); ?>
				</td>
			</tr>
		</table>
	</fieldset>
<?php endforeach;
endif; ?>
	
</div>
<div style="text-align:right;"><a class="new" onClick="javascript: $('div.stgForm').append($('div.template').html());">
		<img id="newScr" alt="Neu" src="<?php echo $template_url ?>images/new.png" />
	</a></div>
<?php echo form_submit(array("style" => "display:none;")); ?>
<div id="status"><?php echo $systemMessages; ?><?php echo form_button(array("name" => "submit", "content" => "Speichern", "class" => "button", "onClick" => "javascript:$('form#form input[type=\'submit\']').trigger('click');"))?></div>

<div class="clr" style="margin-bottom: <?php echo ((count($info) + count($success) + count($alert) + count($error))* 47  + (validation_errors() ? 47 + ((substr_count(validation_errors(), "<p>")-1) * 21) : 0) + 50); ?>px"></div>
<?php echo form_close(); ?>