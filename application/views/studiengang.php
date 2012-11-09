<?php echo form_open("{$my_url}save",  array("name" => "form", "id" => "form", "enctype" => "multipart/form-data")); ?>
<?php echo form_hidden("stgID", $stg->stgID); ?>
		<div class="col width-100">
			<fieldset>
			     <legend>Studieng&auml;nge</legend>
					<table>
                        <tr>
                            <td><label for="stgName">Studiengangsname: </label><?php echo form_input(array("name" => "stgName", "value" => $stg->stgName)); ?></td>
                        </tr><tr>
                            <td><label for="stgArt">Bachelor </label><?php echo form_radio(array("name" => "stgArt", "value" => "B", $stg->stgArt=="B"?true:false)); ?>
                            	<label for="stgArt"> Master </label><?php echo form_radio(array("name" => "stgArt", "value" => "M", $stg->stgArt=="M"?true:false)); ?>
                            </td>
                        </tr><tr>
                            <td><label for="highlights">Highlights: </label><?php echo form_textarea(array("name" => "highlights", "value" => $stg->highlights)); ?></td>
                        </tr><tr>
                            <td><label for="titelbild">Titelbild: </label>
                            	<div>
                            		<?php if($stg->titelbild) { echo "<img height=\"150\" src=\"data:image/jpeg;base64," . base64_encode($stg->titelbild). "\" />"; } ?>
                            		<?php echo form_upload(array("name" => "titelbild", "value" => $stg->titelbild)); ?>
                            	</div>
                            </td>
                        </tr><tr>
                            <td><label for="freigabe">Freigeben: </label><?php echo form_checkbox(array("name" => "freigabe", "value" => $stg->freigabe)); ?></td>
                        </tr><tr>
                        	<td><?php echo form_submit(array("name" => "submit", "value" => "Speichern"))?>&nbsp;&nbsp;<?php echo form_button(array("name" => "back", "value" => true, "content" => "Zur&uuml;ck", "onClick" => "window.location.replace('$my_url')"))?>
                        </tr>
					</table>
			</fieldset>
		</div>

		<div class="clr"></div>
<?php echo form_close(); ?>