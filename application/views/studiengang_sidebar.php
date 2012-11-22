<div>
	<div id="sidebarDiskriminatorBox">
		<?php echo anchor($my_url."index", "Studieng&auml;nge","id=\"sidebarDiskriminator\""); ?>
	</div>
	<?php foreach($items as $item) : ?>
		<div class="sidebarItemBox">
			<?php echo anchor($my_url."edit/".$item->stgID ,$item->stgKBez, "class=\"sidebarItem ".($activeElementID==$item->stgID ? "active" : "")."\""); ?>
		</div>
	<?php endforeach; ?>
	
</div>
<div class="clr"></div>

