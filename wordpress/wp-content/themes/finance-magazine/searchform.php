<?php
/**
 * The template for displaying search form
 * @package Best Classifieds
 */
?>
<form method="get" class="search-section" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="text" name="s" placeholder="<?php esc_attr_e('Search...','finance-magazine'); ?>">
	<button class="btn btn-default" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
</form>