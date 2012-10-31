<?php echo form_open("{$my_url}save",  array("name" => "form", "id" => "form", "enctype" => "multipart/form-data")); ?>
<?php echo form_hidden("stgID", $stg->stgID); ?>
		<div class="col width-100">
			<fieldset>
			     <legend>Studieng&auml;nge</legend>
					<table>
                        <tr>
                            <td><label for="stgName">Studiengangsname: </label><?php echo form_input(array("name" => "stgName", "value" => $stg->stgName)); ?></td>
                            <td><label for="stgArt">Bachelor </label><?php echo form_radio(array("name" => "stgArt", "value" => "B")); ?>
                            	<label for="stgArt"> Master </label><?php echo form_radio(array("name" => "stgArt", "value" => "M")); ?>
                            </td>
                            <td><label for="highlights">Highlights: </label><?php echo form_input(array("name" => "highlights", "value" => $stg->highlights)); ?></td>
                            <td><label for="titelbild">Titelbild: </label><?php echo form_upload(array("name" => "titelbild", "value" => $stg->titelbild)); ?></td>
                            <td><label for="freigabe">Freigeben: </label><?php echo form_checkbox(array("name" => "freigabe", "value" => $stg->freigabe)); ?></td>
                        </tr>
					</table>
			</fieldset>
		</div>

		<div class="clr"></div>
<?php echo form_close(); ?>