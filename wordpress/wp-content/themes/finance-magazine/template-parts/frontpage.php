<?php
/**
 Template Name: Front Page
 */
get_header();
if(is_home()){ ?>
    
<?php 
}else{ 
$theme_i = 0;
if(get_theme_mod('frontpage_slider_sectionswitch',false)): ?> 
<div id="main-slider" class="owl-carousel">
	<?php 
	$category_list = get_theme_mod('homepage_sliderimage_category','');
    $perpage = get_theme_mod('homepage_sliderimage_per_section',2);    
    if($category_list>0):
    $sliderimage_post = new WP_Query( apply_filters( 'front_page_sliderimage_posts_args', array( 'posts_per_page' => $perpage,'category__in' => $category_list, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) ) ); 
    else:
    $sliderimage_post = new WP_Query( apply_filters( 'front_page_sliderimage_posts_args', array( 'posts_per_page' => $perpage, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) ) ); 
    endif;	    

    $theme_i=1;			
	if ($sliderimage_post->have_posts()) :	
	 while ( $sliderimage_post->have_posts() ) : $sliderimage_post->the_post();
	 	$sliderimage_image = get_the_post_thumbnail_url(get_the_ID(),'full');	    
	    $sliderimage_link_title  = get_theme_mod ( 'homepage_sliderimage'.$theme_i.'_link_title',esc_html__('Read More','finance-magazine'));

	    if($sliderimage_image!=''){  $sliderclass = ($theme_i == 1)?'active':'';?>	    
		    <div class="main-slider-wrap item <?php echo esc_attr($sliderclass); ?> slider-<?php echo esc_attr($theme_i); ?>" style="background-image: url(<?php echo esc_url($sliderimage_image);?>);">
				<div class="container">
					<div class="slider-content-area">
						<h1 class="title"><?php the_title(); ?></h1>
						<p class="sub-title"><?php echo esc_html(get_the_excerpt()); ?> </p>
						<a href="<?php the_permalink();?>" class="slide-btn"><?php echo esc_html($sliderimage_link_title);?></a>
					</div>
				</div>
			</div>
		
	    <?php $theme_i++; } 
	endwhile; wp_reset_postdata();  endif; ?>
	</div>
<?php endif;?>

<?php if(get_theme_mod('homepage_service_switch',false)): 
    $category_list = get_theme_mod('homepage_service_category',''); ?>
    <div class="key-features-wrap">
		<div class="container">
			<div class="heading-area">
				<?php if(get_theme_mod('homepage_service_title','Services We Provide')!=''): ?>
		            <h1 class="title"><?php echo esc_html(get_theme_mod('homepage_service_title',esc_html__('Services We Provide','finance-magazine'))); ?></h1>
	            <?php endif;
	            if(get_theme_mod('homepage_service_title','Services We Provide')!=''): 
	            	 if(get_theme_mod('homepage_service_subtitle')!=''): ?>
	                     <p class="sub-title"><?php echo esc_html(get_theme_mod('homepage_service_subtitle')); ?></p>
	                <?php endif; ?>
	            <?php endif; ?>
			</div>
			<div class="row">
			<?php $i= 1;
                 $args             = array('orderby'    => 'id','hide_empty' => 0,);
                 $categories       = get_categories( $args );
                 foreach ( $categories as $category_list ) : 
                 if(get_theme_mod('category_switch_'.$category_list->cat_ID,false)): ?>
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
					<div class="key-feature-box">
						<?php if (function_exists('get_wp_term_image')): $meta_image = get_wp_term_image($category_list->cat_ID); ?>
							<div class="icon">
								<img src="<?php echo esc_url($meta_image); ?>">
							</div>
						<?php endif; ?>
						<div class="feature-content">
							<h1 class="title"><a href="<?php echo esc_url(get_category_link($category_list->cat_ID));?>"><?php echo esc_html($category_list->cat_name); ?></a></h1>
							<p class="sub-text"><?php echo esc_html($category_list->description); ?></p>
						</div>
					</div>
				</div>
				<?php endif; endforeach; ?>
			</div>
		</div>
	</div>
    <?php endif; 

	if(get_theme_mod('frontpage_contactus_section_switch',false)): 	
	$contactus_post = get_theme_mod('homepage_contactus_post',0);	        
    $contactus_post_arr = new WP_Query( apply_filters( 'front_page_contactus_posts_args', array( 'post__in' => array($contactus_post), 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) ) ); 
	if ($contactus_post_arr->have_posts()) :	
		while ( $contactus_post_arr->have_posts() ) : $contactus_post_arr->the_post();

		$contactus_image = get_the_post_thumbnail_url(get_the_ID(),'full');
		$contactus_link_title = get_theme_mod ( 'frontpage_contactus_link_title',esc_html__('Contact Us','finance-magazine') );?>

		<div class="talk-wrap" style="background-image: url(<?php echo esc_url($contactus_image);?>);">
			<div class="container">
				<div class="row">
					<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
						<div class="talk-content">
		            		<h2 class="title"><?php the_title(); ?></h2>						
			                <p class="sub-title"><?php echo esc_html(get_the_excerpt()); ?></p>		                
						</div>
					</div>
					<?php if(get_theme_mod('frontpage_contactus_link_title','Contact Us')!=''): ?>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<div class="talk-btn">						
							<a href="<?php the_permalink(); ?>" class="slide-btn"><?php echo esc_html($contactus_link_title);?></a>
						</div>
					</div>
				<?php endif; ?>
				</div>
			</div>
		</div>
	<?php endwhile; wp_reset_postdata();  endif; endif; ?>

	<?php if(get_theme_mod('frontpage_aboutus_section_switch',false)): ?>
	<div class="story-wrap">
		<div class="container">
			<?php 
			$category_list = get_theme_mod('homepage_about_us_category','');
		    $perpage = get_theme_mod('homepage_aboutus_per_section',3);    
		    if($category_list>0):
		    $about_post = new WP_Query( apply_filters( 'front_page_about_us_posts_args', array( 'posts_per_page' => $perpage,'category__in' => $category_list, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) ) ); 
		    else:
		    $about_post = new WP_Query( apply_filters( 'front_page_about_us_posts_args', array( 'posts_per_page' => $perpage, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) ) ); 
		    endif;	    

		    $i=1;			
			if ($about_post->have_posts()) :	
			 while ( $about_post->have_posts() ) : $about_post->the_post(); 			
				$aboutus_link_title = get_theme_mod ( 'homepage_aboutus'.$i.'_link_title',esc_html__('Read more','finance-magazine') );
				if($i % 2 != 0):  ?>
					<div class="story-area">
						<div class="row no-gutters">
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<div class="story-img">
									<?php if(has_post_thumbnail()): ?>
										<?php the_post_thumbnail('full'); ?>
									<?php endif; ?>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<div class="story-content">
									<h3 class="title"><?php the_title(); ?></h3>
									<p class="text"><?php echo esc_html(get_the_excerpt()); ?></p>
									<?php if(get_theme_mod('homepage_aboutus'.$i.'_link_title','Read more')!=''): ?>
									<a href="<?php the_permalink(); ?>" class="story-btn-more"><?php echo esc_html($aboutus_link_title);?></a>
								<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
					<?php else: ?>
					<div class="story-area">
						<div class="row no-gutters">
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<div class="story-content">
									<h3 class="title"><?php the_title(); ?></h3>
									<p class="text"><?php echo esc_html(get_the_excerpt()); ?></p>
									<?php if(get_theme_mod('homepage_aboutus'.$i.'_link_title','Read more')!=''): ?>
									<a href="<?php the_permalink(); ?>" class="story-btn-more"><?php echo esc_html($aboutus_link_title);?></a>
								<?php endif; ?>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<div class="story-img">
									<?php if(has_post_thumbnail()): ?>
										<?php the_post_thumbnail('full'); ?>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
				<?php endif;
			$i++; endwhile; wp_reset_postdata();  endif;?>
		</div>
	</div>
	<?php endif;

	if(get_theme_mod('homepage_testimonial_switch',false)):
    $category_list = get_theme_mod('homepage_testimonial_category','');
    $perpage = get_theme_mod('homepage_testimonial_count',3);    
    if($category_list>0):
    $testimonial_post = new WP_Query( apply_filters( 'front_page_testimonial_posts_args', array( 'posts_per_page' => $perpage,'category__in' => $category_list, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) ) ); 
    else:
    $testimonial_post = new WP_Query( apply_filters( 'front_page_testimonial_posts_args', array( 'posts_per_page' => $perpage, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) ) ); 
    endif;?>
	<div class="testimonials-wrap">
		<div class="container">
			<div class="heading-area-white">
			 <?php if(get_theme_mod('homepage_testimonial_section_title','Testimonials')!=''): ?>
                <h1 class="title"><?php echo esc_html(get_theme_mod('homepage_testimonial_section_title',esc_html__('Testimonials','finance-magazine'))); ?></h1>                    
            <?php endif;?>				
			</div>
			<?php if ($testimonial_post->have_posts()) : ?>
			<div class="testimonial-area">
				<div id="testimonials-carousel" class="owl-carousel">
					<?php while ( $testimonial_post->have_posts() ) : $testimonial_post->the_post(); ?>
					<div class="item">
						<div class="testimonial-box">
							<?php the_content(); wp_link_pages();?>
							<div class="client-name"><h4><?php the_title(); ?></h4></div>
						</div>
					</div>
					<?php endwhile; wp_reset_postdata(); ?>					
				</div>
			</div>
			<?php endif; ?>
		</div>
	</div>
	<?php endif;

	if(get_theme_mod('homepage_latest_blog_sectionswitch',false)):
    $category_list = get_theme_mod('homepage_latest_blog_section_category','');
    $perpage = get_theme_mod('homepage_latest_blog_section_perpage',3);
    
    if($category_list>0):
    $latest_blog_post = new WP_Query( apply_filters( 'front_page_latest_blog_posts_args', array( 'posts_per_page' => $perpage,'category__in' => $category_list, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) ) ); 
    else:
    $latest_blog_post = new WP_Query( apply_filters( 'front_page_latest_blog_posts_args', array( 'posts_per_page' => $perpage, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) ) ); 
    endif; ?>
	<div class="latest-post-wrap">
		<div class="container">
			<div class="heading-area">
				<?php if(get_theme_mod('homepage_latest_blog_section_title','Latest Blog')!=''): ?>
                	<h1 class="title"><?php echo esc_html(get_theme_mod('homepage_latest_blog_section_title',esc_html__('Latest Blog','finance-magazine'))); ?></h1>
                <?php endif; 
                if(get_theme_mod('homepage_latest_blog_section_desc')!=''): ?>
                   <p class="sub-title"><?php echo esc_html(get_theme_mod('homepage_latest_blog_section_desc')); ?></p>
                <?php endif; ?>
			</div>
			<?php if ($latest_blog_post->have_posts()) : ?>
			<div class="row">
				<?php while ( $latest_blog_post->have_posts() ) : $latest_blog_post->the_post(); ?>
				<div class="col-lg-4 col-md-4 col-xs-12">
					<div class="title-box">                            
						<div class="box-img-area">
							<a href="<?php the_permalink(); ?>" class="blog-post-img"><?php the_post_thumbnail('medium'); ?></a>
						</div>
						<div class="heading-box">
							<div class="box-content"> 
								<small><?php the_date(); ?></small>
								<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								<p><?php the_excerpt(); ?></p>								
							</div>
						</div>
					</div>
				</div>				
				<?php endwhile; wp_reset_postdata(); ?>
			</div>
			<?php endif; ?>
		</div>
	</div>
	<?php endif; ?>

<?php }
 get_footer();