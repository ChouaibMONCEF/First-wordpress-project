<?php 
/**
 * The template for displaying sidebar
 * @package Finance Magazine
 */  
if (is_active_sidebar('sidebar-1')) { ?>
	<div class="sidebar">
	    <?php dynamic_sidebar('sidebar-1'); ?>
	</div>
<?php } ?>