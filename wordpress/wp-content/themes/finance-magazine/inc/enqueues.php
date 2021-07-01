<?php function finance_magazine_enqueues(){

	wp_enqueue_style( 'finance-magazine-google-fonts-api', '//fonts.googleapis.com/css?family=Muli', array(), '1.0.0' );
	wp_enqueue_style('bootstrap',get_template_directory_uri().'/assets/css/bootstrap.css', array(), null, 'all' );
	wp_enqueue_style('owl-carousel',get_template_directory_uri().'/assets/css/owl.carousel.css', array(), null, 'all' );
	wp_enqueue_style('font-awesome',get_template_directory_uri().'/assets/css/font-awesome.css', array(), null, 'all' );
	wp_enqueue_style('finance-magazine-menu-style',get_template_directory_uri().'/assets/css/menu-style.css', array(), null, 'all' );
	wp_enqueue_style('finance-magazine-default',get_template_directory_uri().'/assets/css/default.css', array(), null, 'all' );	
	wp_enqueue_style('finance-magazine-style', get_stylesheet_uri(), array());

	if ( is_singular() ) wp_enqueue_script( "comment-reply" );	
	wp_enqueue_script('jquery-masonry');
	wp_enqueue_script('bootstrap',get_template_directory_uri().'/assets/js/bootstrap.js', array('jquery'), null, true);
	wp_enqueue_script('owl-carousel',get_template_directory_uri().'/assets/js/owl.carousel.js', array('jquery'), null, true);
	wp_enqueue_script('finance-magazine-custom-js',get_template_directory_uri().'/assets/js/custom.js', array('jquery'), null, true);
	
	finance_magazine_custom_css();
}
add_action('wp_enqueue_scripts','finance_magazine_enqueues');
