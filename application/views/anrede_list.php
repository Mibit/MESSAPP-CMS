
	<table class="adminList">
		<thead>
			<tr>
				<th>&nbsp;#&nbsp;</th>
                  <th>&nbsp;</th>
                  <th><?php echo sort_header("anrede", "Anrede", $sortCol, $sortDir); ?></th>
            </tr>
            </thead>
            <tfoot>
                <tr>
                  <td colspan="3">
                    <?php echo $listPagination; ?>
                  </td>
                </tr>
              </tfoot>
              <tbody>
				<?php
				$counter = 0;
				foreach($listItems as $item) :
                    $counter++ ?>
                    <tr class="row<?php echo ($counter % 2 == 0 ? "1" : "0"); ?>">
                      <td><?php echo $counter; ?></td>
                      <td align="center"><a href="<?php if($item->canDelete == true) { echo $my_url . "delete/" . $item->anredeID; } ?>"><img height="16" border="0" width="16" alt="L&ouml;schen" src="<?php echo $template_url; ?>images/publish_x<?php if($item->canDelete == false) { echo "_disabled"; } ?>.png"></a></td>
                      <td><?php echo anchor($my_url . "edit/" . $item->anredeID, $item->anrede); ?></td>
                    </tr>
				<?php endforeach; ?>
              </tbody>
            </table>