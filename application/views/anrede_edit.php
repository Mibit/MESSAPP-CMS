<?php echo form_open("{$my_url}save",  array("name" => "editForm", "id" => "editForm")); ?>
<?php echo form_hidden("anredeID", $anrede->anredeID); ?>
		<div class="col width-100">
			<fieldset>
			     <legend>Stammdaten</legend>
					<table>
                        <tr>
                            <td class="key"><label for="anrede">Anrede</label></td>
                            <td colspan="2"><?php echo form_input(array("name" => "anrede", "value" => $anrede->anredeID)); ?></td>
                        </tr>
					</table>
			</fieldset>
		</div>

		<div class="clr"></div>
<?php echo form_close(); ?>