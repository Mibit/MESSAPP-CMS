<?php 
	function getJSPageLink($pageno) {
		return "javascript: $('#page').val($pageno); $('#listForm').submit();";
	}
?>

<del class="container">
<?php if($lastpage > 1) : ?>

	<div class="pagination">
	
		<?php
			//previous button
			if ($page > 1) :
		?>
			<div class="button2-right">
				<div class="prev">
					<a href="<?php echo getJSPageLink($prev); ?>">Prev</a>
				</div>
			</div>
		<?php else : ?>
			<div class="button2-right off">
				<div class="prev">
					<span>Prev</span>
				</div>
			</div>
		<?php endif; ?>
		
		<div class="button2-left">
			<div class="page">
				
			<?php 
				//pages	
				if ($lastpage < 7 + ($adjacents * 2)) :	//not enough pages to bother breaking it up
					for ($counter = 1; $counter <= $lastpage; $counter++) :
						if ($counter == $page) :
			?>
							<span class="current"><?php echo $counter; ?></span>
			<?php 
						else :
			?>
							<a href="<?php echo getJSPageLink($counter); ?>"><?php echo $counter; ?></a>					
			<?php 
						endif;
					endfor;
				elseif($lastpage >= 7 + ($adjacents * 2)) :	//enough pages to hide some
					
					//close to beginning; only hide later pages
					if($page < 1 + ($adjacents * 3)) :
						for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) :
							if ($counter == $page) :
			?>
								<span class="current"><?php echo $counter; ?></span>
			<?php 
							else :
			?>
								<a href="<?php echo getJSPageLink($counter); ?>"><?php echo $counter; ?></a>
			<?php
							endif;
						endfor;
			?>
						<a href="#">...</a>
						<a href="<?php echo getJSPageLink($nextToLastPage); ?>"><?php echo $lpm1; ?></a>
						<a href="<?php echo getJSPageLink($lastpage); ?>"><?php echo $lastpage; ?></a>		
			<?php 
					endif;
			
				//in middle; hide some front and some back
				elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) :
			?>
					<a href="<?php echo getJSPageLink(1); ?>">1</a>
					<a href="<?php echo getJSPageLink(2); ?>">2</a>
					<a href="#">...</a>
			<?php 
					for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) :
						if ($counter == $page) :
			?>
							<span class="current"><?php echo $counter; ?></span>
			<?php 
						else :
			?>
						<a href="<?php echo getJSPageLink($counter); ?>"><?php echo $counter; ?></a>
			<?php 
						endif;
					endfor;
			?>				
					<a href="#">...</a>";
					<a href="<?php echo getJSPageLink($nextToLastPage); ?>"><?php echo $nextToLastPage; ?></a>
					<a href="<?php echo getJSPageLink($lastpage); ?>"><?php echo $lastpage; ?></a>
			<?php 
				//close to end; only hide early pages
				else :
			?>
					<a href="<?php echo getJSPageLink(1); ?>">1</a>
					<a href="<?php echo getJSPageLink(2); ?>">2</a>
					<a href="#">...</a>
			<?php 
					for ($counter = $lastpage - (1 + ($adjacents * 3)); $counter <= $lastpage; $counter++) :
						if ($counter == $page) :
			?>
							<span class="current"><?php echo $counter; ?></span>
			<?php 
						else :
			?>
						<a href="<?php echo getJSPageLink($counter); ?>"><?php echo $counter; ?></a>
			<?php 
						endif;
					endfor;
				endif;
			?>					
			</div>
		</div>
		<?php 
			//next button
			if ($page < $lastpage) :
		?>
				<div class="button2-left">
					<div class="next">
						<a href="<?php echo getJSPageLink($next); ?>">Next</a>
					</div>
				</div>
		<?php 
			else :
		?>
			<div class="button2-left off">
				<div class="next">
					<span>Next</span>
				</div>
			</div>
		<?php 
			endif;
		?>
			<div class="limit">Page <?php echo $page; ?> of <?php echo $lastpage; ?></div>
			
		</div>
	<?php 
		endif;
	?>
</del>
		