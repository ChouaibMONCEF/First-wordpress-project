<?php
/**
 * The template for displaying single page
 * @package Finance Magazine
 */
get_header(); ?>
 <section>
    <div class="container">
        <?php if ( have_posts() ) :
        	while ( have_posts() ) : the_post(); ?>
                <?php if(has_post_thumbnail()):
                    the_post_thumbnail( 'full', array('class' => '') );
                endif; ?>
                <?php the_content();               
               wp_link_pages();
            endwhile;
        endif; ?>
    </div>    
</section>
<?php get_footer();