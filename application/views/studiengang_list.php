<table class="adminList">
	<thead>
		<tr>
			<th>&nbsp;#&nbsp;</th>
			<th>&nbsp;</th>
			<th><?php echo sort_header("stgID", "Studiengang", $sortCol, $sortDir); ?>&nbsp;&nbsp;<a href="<?php echo $my_url."edit" ?>" >Neu</a>
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
				href="<?php echo $my_url . "delete/" . $item->stgID; ?>">L&ouml;schen
			</a>
			</td>
			<td><?php echo anchor($my_url . "edit/" . $item->stgID, $item->stgName); ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
