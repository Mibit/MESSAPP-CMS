<?php echo form_open("{$my_url}save", array("name" => "form", "id" => "form", "enctype" => "multipart/form-data")); ?>
<?php echo form_hidden("number") ?>
<div class="template">

	<fieldset>
		<?php echo listBoxElements(); ?>
		<?php echo form_hidden("phsID"); ?>
		<table>
			<tr>
				<td><label for="phsLand">Land:</label></td>
				<td><?php echo form_dropdown("phsLand", $landArray); ?></td>
			</tr>
			<tr>
				<td class="editorLabel"><label for="phsPartnerhochschulen">Partnerhochschulen:</label></td>
				<td class="editorField"><!--<?php echo form_textarea(array("name" => "phsPartnerhochschulen", "value" => "", "onKeyUp" => "javascript:charCounter(this)")); charCounter(2000) ?>--></td>
			</tr>
		</table>
	</fieldset>
</div>

<div class="stgForm">
<?php if(!count($internationalepartner)) : ?>
		
	<fieldset>
		<?php echo listBoxElements(); ?>
		<?php echo form_hidden("phsID"); ?>
		<table>
			<tr>
				<td><label for="phsLand">Land:</label></td>
				<td><?php echo form_dropdown("phsLand", $landArray); ?></td>
			</tr>
			<tr>
				<td class="editorLabel"><label for=phsPartnerhochschulen>Partnerhochschulen:</label></td>
				<td><?php echo form_textarea(array("name" => "phsPartnerhochschulen", "value" => "", "onKeyUp" => "javascript:charCounter(this)")); charCounter(2000) ?></td>
			</tr>
		</table>
	</fieldset>

<?php 
	else : 
		foreach($internationalepartner as $phs) : ?>


	<fieldset>
		<?php echo listBoxElements(); ?>
		<?php echo form_hidden("phsID", $phs->phsID); ?>
		<table>
			<tr>
				<td><label for="phsLand">Land:</label></td>
				<td><?php echo form_dropdown("phsLand", $landArray, $phs->phsLand); ?></td>
			</tr>
			<tr>
				<td class="editorLabel"><label for="phsPartnerhochschulen">Partnerhochschulen:</label></td>
				<td><?php echo form_textarea(array("name" => "phsPartnerhochschulen", "value" => $phs->phsPartnerhochschulen, "onKeyUp" => "javascript:charCounter(this)")); charCounter(2000) ?></td>
			</tr>
		</table>
	</fieldset>
<?php endforeach;
endif; ?>
	
</div>
<div style="text-align:right;"><a class="new" onClick="javascript: addEntry();">
		<img alt="Neu" src="<?php echo $template_url ?>images/new.png" title="Neuer Eintrag" class="tooltip" />
	</a></div>
<?php echo form_submit(array("style" => "display:none;")); ?>
<div id="status"><?php echo $systemMessages; ?><?php echo form_button(array("name" => "submit", "content" => "Speichern", "class" => "button", "onClick" => "javascript: addIndizes(); save();"))?></div>

<div class="clr" style="margin-bottom: <?php echo ((count($info) + count($success) + count($alert) + count($error))* 47  + (validation_errors() ? 47 + ((substr_count(validation_errors(), "<p>")-1) * 21) : 0) + 50); ?>px"></div>
<?php echo form_close(); ?>
