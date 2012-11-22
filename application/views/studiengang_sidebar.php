<div>
	<div id="sidebarDiskriminatorBox">
			<a onClick="javascript:redirectWithSave('<?php echo $my_url."index"; ?>');" id="sidebarDiskriminator">
				Studieng&auml;nge
			</a>
	</div>
	<?php foreach($items as $item) : ?>
		<div class="sidebarItemBox">
			<a onClick="javascript:redirectWithSave('<?php echo $my_url."edit/".$item->stgID; ?>');" class="sidebarItem <?php if($activeElementID==$item->stgID) echo " active "; ?>">
				<?php echo $item->stgKBez; ?>
			</a>
		</div>
	<?php endforeach; ?>
	
</div>
<div class="clr"></div>
