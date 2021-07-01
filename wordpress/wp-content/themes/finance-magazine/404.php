<?php
/**
 * The template for displaying 404 pages (not found)
 * @package Finance Magazine
 */
get_header(); ?>
<div class="title-left-sec">
	<div class="container">
		<h1 class="my-2"><?php esc_html_e( "Error 404", 'finance-magazine' ); ?></h1>
	<?php esc_html_e( "Oops! That page can't be found.", 'finance-magazine' ); ?>
	<?php esc_html_e('It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'finance-magazine'); ?>
	<?php get_search_form(); ?>
	</div>
</div>
<?php get_footer();