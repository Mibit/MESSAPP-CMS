<?php 
	$subCategories = Array(
				"Studiengang",
				"Studiengangsleitung",
				"Zitate",
				"Highlights",
				"Fakten",
				"Berufsfelder",
				"Curriculum",
				"&Uuml;bersichtsbild"
			);

?>
	<div class="sidebarDiskriminatorBox" onClick="javascript:redirectWithSave('<?php echo $my_url."index"; ?>');">
			<a>
				Studieng&auml;nge
			</a>
	</div>
	
	<?php foreach($items as $item) : ?>
	
		<?php $active = ($item->stgID == $activeElementID ? true : false); ?>
		
		<div class="sidebarItemBox">
			<div class="open"><a onClick="javascript:changeSubcategoryState(this, $(this).parent().siblings('.itemCategory'));" opened="<?php echo $active ? 1 : 0;?>" ><?php echo $active ? "-" : "+";?></a></div>
			<a class="caption" onClick="javascript:redirectWithSave('<?php echo $my_url."edit/".$item->stgID; ?>', 0);" class="sidebarItem <?php if($activeElementID==$item->stgID) echo " active "; ?>">
				<?php echo $item->stgKBez."&nbsp;-&nbsp;".$item->getArtKurz()."/".$item->getOrganisationformKurz(); ?>
			</a>
			<ul class="itemCategory" style="display: <?php echo $active ? "show" : "none"; ?>">
				<?php foreach($subCategories as $category) : ?>
				<li>
					<a onClick="javascript:redirectWithSave('<?php echo $my_url."edit/".$item->stgID . "#" . str_replace(" ", "", $category); ?>', <?php echo $active ? 1 : 0; ?>);" class="sidebarItem <?php if($activeElementID==$item->stgID) echo " active "; ?>">
						<?php echo $category; ?>
					</a>
				</li>
				<?php endforeach; ?>
			</ul>
		</div>
		
	<?php endforeach; ?>
	
	
