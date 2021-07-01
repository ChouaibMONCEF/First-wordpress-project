<?php
/**
 * The template for displaying archive pages like categories, tags, authors, months
 * @package Finance Magazine
 */
 get_header(); ?>
	<!-- section-wrap-area section start-->
    <section class="section-wrap-area">
        <div class="container">
            <div class="row">
            <?php $custom_class = (get_theme_mod('post_sidebar_layout', 'right') == 'left') ? "8" : ((get_theme_mod('post_sidebar_layout', 'right') == 'right') ? "8" : "12");  
            if ( get_theme_mod( 'post_sidebar_layout','right'  ) == "left" ) : ?>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">                
                    <?php get_sidebar(); ?>
                </div>
            <?php endif; ?>
            <div class="col-lg-<?php echo esc_attr($custom_class); ?> col-md-<?php echo esc_attr($custom_class); ?> col-sm-12 col-xs-12">
                <div class="row" id="ms-container">     
                    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>                            
                        <div class="ms-item col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="title-box">
                                <?php if(has_post_thumbnail() && (get_theme_mod('hide_post_image') == '')) : ?>
                                   <div class="box-img-area"> <?php the_post_thumbnail('full'); ?> </div>  
                                <?php endif;?>
                                <div class="heading-box">
                                    <div class="box-content">                             
                                        <?php if ( get_theme_mod( 'hide_post_meta_tag' ) == "" ) : ?>    
                                        <small><?php echo get_the_date(); ?></small>
                                        <?php endif; ?>
                                        <h2><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h2>
                                        <?php the_excerpt(); ?>                                        
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>                
                        </div>                            
                        <?php endwhile;?>
                    </div>           
                    <?php
                        the_posts_pagination( array(
                            'type'  => 'list',
                            'screen_reader_text' => ' ',
                            'prev_text'          => esc_html__( 'Previous', 'finance-magazine' ),
                            'next_text'          => esc_html__('Next','finance-magazine'),
                            ) );
                     endif;?>
                </div>
                <?php if ( get_theme_mod( 'post_sidebar_layout','right' ) == "right" ) : ?>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <?php get_sidebar(); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>    
    <!-- section-wrap-area section end-->  
<?php get_footer();
