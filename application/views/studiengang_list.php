
<table class="adminlist" cellpadding="0" cellspacing="2">
	<thead>
		<tr>
			<th>&nbsp;#&nbsp;</th>
			<th><a href="<?php echo $my_url."edit" ?>" class="new tooltip" title="Neuer Studiengang"><img alt="Neuer Studiengang" src="<?php echo $template_url ?>images/new.png" /></a></th>
			<th><?php echo sort_header("stgKBez", "Kbz", $sortCol, $sortDir); ?>
			</th>
			<th><?php echo sort_header("stgBez", "Studiengang", $sortCol, $sortDir); ?>
			</th>
			<th><?php echo sort_header("stgArt", "Art", $sortCol, $sortDir); ?>
			</th>
			<th><?php echo sort_header("stgFOrganisationsform", "Organisationsform", $sortCol, $sortDir); ?>
			</th>
			<th><?php echo sort_header("freigabe", "Freigabe", $sortCol, $sortDir); ?>
			</th>
			<th><?php echo sort_header("timestamp", "letzte &Auml;nderung", $sortCol, $sortDir); ?>
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
				href="<?php echo $my_url . "delete/" . $item->stgID; ?>" class="delete tooltip" title="L&ouml;schen" >
					<img alt="L&ouml;schen" src="<?php echo $template_url ?>images/delete.png" />
			</a>
			</td>
			<td><?php echo anchor($my_url . "edit/" . $item->stgID, $item->stgKBez); ?>
			</td>
			<td><?php if($item->stgBez) echo anchor($my_url . "edit/" . $item->stgID, $item->stgBez); ?>
			</td>
			<td><?php if($item->stgArtLong) echo anchor($my_url . "edit/" . $item->stgID, $item->stgArtLong); ?>
			</td>
			<td><?php if($item->stgFOrganisationsformLong) echo anchor($my_url . "edit/" . $item->stgID, $item->stgFOrganisationsformLong); ?>
			</td>
			<td style="text-align: center;">
				<a href="<?php echo $my_url . "freigabe/" . $item->stgID . "/" . ($item->freigabe ? 0 : 1); ?>" title="Freigabe" class="tooltip" >
					<?php echo $item->freigabe ? "<img alt=\"freigegeben\" src=\"{$template_url}images/okay.png\" class=\"freigabe\" />" : "<img alt=\"freigegeben\" src=\"{$template_url}images/x.png\" class=\"freigabe\" />"; ?>
				</a>
			</td>
			<td><?php echo $item->getTimestampFormatted(); ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
