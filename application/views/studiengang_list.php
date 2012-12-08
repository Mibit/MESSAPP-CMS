<table class="adminlist" cellpadding="0" cellspacing="2">
	<thead>
		<tr>
			<th>&nbsp;#&nbsp;</th>
			<th><a href="<?php echo $my_url."edit" ?>" class="new"><img alt="Neuer Studiengang" src="<?php echo $template_url ?>images/new.png" /></a></th>
			<th><?php echo sort_header("stgKBez", "Kurzbezeichnung", $sortCol, $sortDir); ?>
			</th>
			<th><?php echo sort_header("stgBez", "Studiengang", $sortCol, $sortDir); ?>
			</th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<td colspan="3"><?php echo $listPagination; ?></td>
		</tr>
	</tfoot>
	<tbody>
		<?php
		$counter = 0;
		foreach($listItems as $item) :
                    $counter++ ?>
		<tr class="row<?php echo ($counter % 2 == 0 ? "1" : "0"); ?>">
			<td><?php echo $counter; ?>
			</td>
			<td align="center"><a
				href="<?php echo $my_url . "delete/" . $item->stgID; ?>" class="delete">
					<img alt="L&ouml;schen" src="<?php echo $template_url ?>images/delete.png" />
			</a>
			</td>
			<td><?php echo anchor($my_url . "edit/" . $item->stgID, $item->stgKBez); ?>
			</td>
			<td><?php echo anchor($my_url . "edit/" . $item->stgID, $item->stgBez); ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
