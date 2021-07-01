<?php
/**
 * The template for displaying single posts
 * @package Finance Magazine
 */
get_header(); ?>    
   
    <section class="title-left-sec">
        <div class="container">            
            <div class="row">
                <?php 
                $custom_class = (get_theme_mod('single_post_sidebar_layout', 'right') == 'left') ? "8" : ((get_theme_mod('single_post_sidebar_layout', 'right') == 'right') ? "8" : "12");  
                if ( get_theme_mod( 'single_post_sidebar_layout','right'  ) == "left" ) { ?>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">                
                    <?php get_sidebar(); ?>
                </div><?php } ?>
                <div class="col-lg-<?php echo esc_attr($custom_class); ?> col-md-<?php echo esc_attr($custom_class); ?> col-sm-12 col-xs-12">
                   <?php if(have_posts()) :
                        while(have_posts()) : the_post(); ?>
                        <div id="post-<?php the_ID(); ?>" <?php post_class('title-box'); ?>>
                        <div class="heading-box">
                            <div class="box-content">
                                <small><?php the_date(); ?></small> 
                                <h2><?php the_title(); ?></h2>
                            </div>
                        </div>
                    <div class="box-img-area"> 
                        <?php the_post_thumbnail('full'); ?>
                    </div>
                    <div class="heading-box">
                        
                          
                  <?php if ( get_theme_mod( 'hide_single_post_meta_tag' ) == "" ): ?>
                    <ul class="post-meta-list">
                        <?php  finance_magazine_entry_meta(); ?>
                    </ul>
                  <?php endif; ?>                    
                  <?php the_content(); wp_link_pages();
                        endwhile; 
                    endif; 

                     /* Pagignation Start */
                    the_post_navigation( array(
                    'type'  => 'list','prev_text' => '<i class="fa fa-angle-double-left" aria-hidden="true"></i>'.esc_html__( ' Previous', 'finance-magazine' ),
                    'next_text' => esc_html__( 'Next ', 'finance-magazine' ).'<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
                    'screen_reader_text' => ' ',                         
                    ) ); 
                    
                    /* Pagignation End*/ 
                    if (comments_open() || get_comments_number()) :  ?>
                        <div class="comments">
                            <?php if(get_comments_number() > 0){ ?>
                                <div class="comment_title">
                                    <h3 class="title_line"><i class="fa fa-comments"></i> <?php esc_html_e('Comments','finance-magazine'); ?></h3>
                                </div>
                            <?php } 
                            comments_template(); ?>
                        </div>
                    <?php endif;?>
                    </div>
                    </div>    
                </div>
                <?php if ( get_theme_mod( 'single_post_sidebar_layout','right' ) == "right" ) { ?>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="sidebar">
                       <?php get_sidebar(); ?>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>
<?php get_footer();