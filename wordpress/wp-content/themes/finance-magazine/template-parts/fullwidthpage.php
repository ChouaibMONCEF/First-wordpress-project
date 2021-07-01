<?php
/**
* Template Name: Full Width
*/
get_header(); ?>
<!-- End banner -->
 <div class="main-body-wrap">
    <div class="container">
		 <?php if ( have_posts() ) :
	        while ( have_posts() ) : the_post(); 
	           the_content(); wp_link_pages();
		      endwhile;
		   endif; ?>
	</div>
</div>
<?php get_footer();