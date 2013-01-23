<?php echo form_open("{$my_url}save", array("name" => "form", "id" => "form", "enctype" => "multipart/form-data")); ?>
<?php echo form_hidden("number") ?>

<div class="stgForm">
	<fieldset>
		<table>
			<tr>
				<td>
					<label for="fhLogo">FH Logo:</label></td>
					<td>
						<a href="<?php echo "data:image/jpeg;base64," . base64_encode($fh->fhLogo) ?>" class="thickbox"><?php if($fh->fhLogo) { echo "<img src=\"data:image/jpeg;base64," . base64_encode($fh->fhLogo). "\" />"; } ?></a>
						<?php echo form_upload(array("name" => "fhLogo")); ?>
						<?php echo form_hidden("fhLogo_hidden", base64_encode($fh->fhLogo)); ?>
				</td>
			</tr>
		</table>
	</fieldset>
	
</div>
<?php echo form_submit(array("style" => "display:none;")); ?>
<div id="status"><?php echo $systemMessages; ?><?php echo form_button(array("name" => "submit", "content" => "Speichern", "class" => "button", "onClick" => "javascript:  save();"))?></div>

<div class="clr" style="margin-bottom: <?php echo ((count($info) + count($success) + count($alert) + count($error))* 47  + (validation_errors() ? 47 + ((substr_count(validation_errors(), "<p>")-1) * 21) : 0) + 50); ?>px"></div>
<?php echo form_close(); ?>
