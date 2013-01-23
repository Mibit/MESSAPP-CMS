<?php echo form_open("{$my_url}save", array("name" => "form", "id" => "form", "enctype" => "multipart/form-data")); ?>
<?php echo form_hidden("number") ?>
<div class="template">

	<fieldset>
		<?php echo form_hidden("likID"); ?>
		<table>
			<tr>
				<td><label for="likTitel">Titel:</label></td>
				<td><?php echo form_input(array("name" => "likTitel", "value" => "")); ?></td>
			</tr>
			<tr>
				<td><label for="likText">Text:</label></td>
				<td><?php echo form_textarea(array("name" => "likText", "value" => "")); ?>
				</td>
			</tr>
			<tr>
				<td>
					<label for="likImage">Bild:</label>
					</td><td>
						<a href="" class="thickbox"></a>
						<?php echo form_upload(array("name" => "likImage", "value" => "")); ?>
					</td>
			</tr>
		</table>
	</fieldset>
</div>

<div class="stgForm">
<div>Es m&uuml;ssen aufgrund des App-Designs genau 4 solcher Boxen gespeichert werden!</div><br />
<?php if(!count($lebeninkufstein)) : ?>
		
	<fieldset>
		<?php echo form_hidden("likID"); ?>
		<table>
			<tr>
				<td><label for="likTitel">Titel:</label></td>
				<td><?php echo form_input(array("name" => "likTitel", "value" => "", "onKeyUp" => "javascript:charCounter(this)")); charCounter(50)?></td>
			</tr>
			<tr>
				<td><label for="likText">Text:</label></td>
				<td><?php echo form_textarea(array("name" => "likText", "value" => "", "onKeyUp" => "javascript:charCounter(this)")); charCounter(750) ?>
				</td>
			</tr>
			<tr>
				<td>
					<label for="likImage">Bild:</label>
					</td><td>
						<a href="" class="thickbox"></a>
						<?php echo form_upload(array("name" => "likImage", "value" => "")); ?>
					</td>
			</tr>
		</table>
	</fieldset>

<?php 
	else : 
		foreach($lebeninkufstein as $lik) : ?>


	<fieldset>
		<?php echo form_hidden("likID", $lik->likID); ?>
		<table>
			<tr>
				<td><label for="likTitel">Titel:</label></td>
				<td><?php echo form_input(array("name" => "likTitel", "value" => $lik->likTitel, "onKeyUp" => "javascript:charCounter(this)")); charCounter(50)?></td>
			</tr>
			<tr>
				<td><label for="likText">Text:</label></td>
				<td><?php echo form_textarea(array("name" => "likText", "value" => $lik->likText, "onKeyUp" => "javascript:charCounter(this)")); charCounter(750) ?>
				</td>
			</tr>
			<tr>
				<td>
					<label for="likImage">Bild:</label>
					</td><td>
						<a href="<?php echo "data:image/jpeg;base64," . base64_encode($lik->likImage) ?>" class="thickbox"><?php if($lik->likImage) { echo "<img src=\"data:image/jpeg;base64," . base64_encode($lik->likImage). "\" />"; } ?></a>
						<?php echo form_upload(array("name" => "likImage")); ?>
						<?php echo form_hidden("likImage_hidden", base64_encode($lik->likImage)); ?>
				</td>
			</tr>
		</table>
	</fieldset>
<?php endforeach;
endif; ?>
	
</div>
<?php echo form_submit(array("style" => "display:none;")); ?>
<div id="status"><?php echo $systemMessages; ?><?php echo form_button(array("name" => "submit", "content" => "Speichern", "class" => "button", "onClick" => "javascript: addIndizes();  save();"))?></div>

<div class="clr" style="margin-bottom: <?php echo ((count($info) + count($success) + count($alert) + count($error))* 47  + (validation_errors() ? 47 + ((substr_count(validation_errors(), "<p>")-1) * 21) : 0) + 50); ?>px"></div>
<?php echo form_close(); ?>
