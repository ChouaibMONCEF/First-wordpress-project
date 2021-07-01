<?php
/**
 * The template for displaying search result
 * @package Finance Magazine
 */
get_header(); ?>

    <!-- section-wrap-area section start-->
    <section class="section-wrap-area">
        <div class="container"> 
        <div class="row">     
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>                            
                <div class="ms-item col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="title-box">
                        <div class="heading-box">
                            <div class="box-content">
                                <small><?php get_the_category(', '); ?></small>
                                <h2><?php the_title(); ?></h2>
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
             ?>

            <?php else : ?>
            <div class="col-sm-12 search-no-result">
                <?php   get_search_form();  ?> 
                <p>
                    <?php esc_html_e("Result can't be found.", 'finance-magazine'); ?>
                </p>
            </div>           
            <?php endif;?>
        </div>
    </section>       
    <!-- section-wrap-area section end-->    
<?php get_footer();