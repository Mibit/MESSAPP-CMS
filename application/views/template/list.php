
<form action="<?php echo $my_url; ?>" method="post" name="listForm" id="listForm">
	<input type="hidden" name="page" id="page" value="<?php echo $page; ?>" />
	<input type="hidden" name="sortCol" id="sortCol" value="<?php echo $sortCol; ?>" />
	<input type="hidden" name="sortDir" id="sortDir" value="<?php echo $sortDir; ?>" />

	<table>
		<tr>
			<td>
			Filter:
			<input type="text" name="search" id="search" value="<?php echo $search; ?>" title="Datens&auml;tze filtern"/>
			<input type="submit" value="Go" />
			<button onclick="$('#search').val(''); $('#listForm').submit();">Reset</button>
			</td>
		</tr>
	</table>
	
	<?php echo $mainContent; ?>
 	
</form>