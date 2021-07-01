<?php
function finance_magazine_setup() {
	load_theme_textdomain( 'finance-magazine',get_template_directory() . '/languages' );
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	
	register_nav_menus( array(
		'primary'    => esc_html__( 'Top Menu', 'finance-magazine' ),
	) );
	add_theme_support( 'html5', array('comment-form','comment-list','gallery','caption',));
	add_theme_support('custom-header');
	// Add theme support for Custom Logo.	
	add_theme_support( 'custom-logo', array(
		'width'       => 250,
		'height'      => 250,
		'flex-width'  => true,
		'flex-height' => true,
		'header-text' => array( 'site-title', 'site-description' ),
	) );

}
add_action( 'after_setup_theme', 'finance_magazine_setup' );
function finance_magazine_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'finance_magazine_content_width', 640 );
}
add_action( 'after_setup_theme', 'finance_magazine_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function finance_magazine_widgets_init() {
	register_sidebar( array(
		'name'          		=> esc_html__( 'Sidebar', 'finance-magazine' ),
		'id'            		=> 'sidebar-1',
		'romana_description'   	=> esc_html__( 'Add widgets here to appear in your sidebar.', 'finance-magazine' ),
		'before_widget' 		=> '<aside id="%1$s" class="widget %2$s" data-aos="fade-up">',
		'after_widget'  		=> '</aside>',
		'before_title'  		=> '<h3 class="widget-title">',
		'after_title'   		=> '</h3>',
	) );
	register_sidebar( array(
		'name'          		=> __( 'Footer 1', 'finance-magazine' ),
		'id'            		=> 'footer-1',
		'romana_description'	=> esc_html__( 'Add widgets here to appear in your footer.', 'finance-magazine' ),
		'before_widget' 		=> '<div id="%1$s" class="footer-widget %2$s footer-1">',
		'after_widget'  		=> '</div>',
		'before_title'  		=> '<div class="footer-header"><h4>',
		'after_title'   		=> '</h4></div>',
	) );
	register_sidebar( array(
		'name'          		=> esc_html__( 'Footer 2', 'finance-magazine' ),
		'id'            		=> 'footer-2',
		'romana_description'   	=> esc_html__( 'Add widgets here to appear in your footer.', 'finance-magazine' ),
		'before_widget' 		=> '<div id="%1$s" class="footer-widget %2$s footer-2">',
		'after_widget'  		=> '</div>',
		'before_title'  		=> '<div class="footer-header"><h4>',
		'after_title'   		=> '</h4></div>',
	) );		
	register_sidebar( array(
		'name'          		=> esc_html__( 'Footer 3', 'finance-magazine' ),
		'id'            		=> 'footer-3',
		'romana_description'   	=> esc_html__( 'Add widgets here to appear in your footer.', 'finance-magazine' ),
		'before_widget' 		=> '<div id="%1$s" class="footer-widget %2$s footer-3">',
		'after_widget'  		=> '</div>',
		'before_title'  		=> '<div class="footer-header"><h4>',
		'after_title'   		=> '</h4></div>',
	) );
	register_sidebar( array(
		'name'          		=> esc_html__( 'Footer 4', 'finance-magazine' ),
		'id'            		=> 'footer-4',
		'romana_description'   	=> esc_html__( 'Add widgets here to appear in your footer.', 'finance-magazine' ),
		'before_widget' 		=> '<div id="%1$s" class="footer-widget %2$s footer-4">',
		'after_widget'  		=> '</div>',
		'before_title'  		=> '<div class="footer-header"><h4>',
		'after_title'   		=> '</h4></div>',
	) );
}
add_action( 'widgets_init', 'finance_magazine_widgets_init' );

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 */
function finance_magazine_excerpt_more( $link ) {
	global $post;
	if ( is_admin() ) : 	return $link;	endif;

	if ( is_front_page()) :	return '';	endif;

	if ( get_theme_mod( 'hide_post_readmore_button' ) == "" ) :
		return '<p><a href="'.esc_url(get_permalink($post->ID)). '" class="read-btn">'.esc_html(get_theme_mod('post_button_text',esc_html__('Read More','finance-magazine') )).'</a></p>';
	endif;
}
add_filter( 'excerpt_more', 'finance_magazine_excerpt_more' );
// Post Excerpt length
function finance_magazine_excerpt_length( $length ) {

	if ( is_admin() ) :	return $length;		endif;		
	return absint(get_theme_mod('post_content_limit', 16));

}
add_filter( 'excerpt_length', 'finance_magazine_excerpt_length', 999 );
/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function finance_magazine_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", esc_url(get_bloginfo( 'pingback_url' )) );
	}
}
add_action( 'wp_head', 'finance_magazine_pingback_header' );

add_filter( 'wp_nav_menu_items','finance_magazine_add_search_box', 10, 2 );
function finance_magazine_add_search_box( $items, $args ) {
	if ($args->theme_location == 'primary') {
	$items .= '<li>' . get_search_form( false ) . '</li>';
	}
	return $items;
}
// Header background image
 if ( ! function_exists( 'finance_magazine_header_image' ) ) :
 function finance_magazine_header_image()
{ if( has_header_image()):?>
	<img src="<?php header_image(); ?>" width="<?php echo esc_attr(get_custom_header()->width); ?>" height="<?php echo esc_attr(get_custom_header()->height); ?>">
<?php endif;
}
endif;
/**
 * Set up post entry meta.    
 * Meta information for current post: categories, tags, permalink, author, and date.    
 * */
function finance_magazine_entry_meta() {     
    
    $finance_magazine_category_list = get_the_category_list() ?  '<li><i class="fa fa-folder-open"></i>'.get_the_category_list(', ').'</li>' : '';
    
    $finance_magazine_tag_list = get_the_tag_list() ? '<li><i class="fa fa-tags"></i> '.get_the_tag_list('',', ').'</li>' : '';    
    
    $finance_magazine_author = sprintf( '<li><i class="fa fa-user"></i><a href="%1$s" title="%2$s" >%3$s</a></li>',
        esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
        /* translators: 1: author name */
        esc_attr( sprintf( __( 'View all posts by %s', 'finance-magazine' ), get_the_author() ) ),
        get_the_author()
    );
    if(comments_open()) { 
        if(get_comments_number()>=1)
            $finance_magazine_comments = '<li><i class="fa fa-comment"></i>'.esc_html(get_comments_number()).'</li>';
        else
            $finance_magazine_comments = '';
    } else {
        $finance_magazine_comments = '';
    }
    $arr = array('li' => array(), 'a' => array('href' => true,'title' => true,), 'i' => array('class'=>true));
    if(is_singular()){
        printf('%1$s %2$s %3$s %4$s',      	
        wp_kses($finance_magazine_category_list,$arr),
        wp_kses($finance_magazine_author,$arr),     
        wp_kses($finance_magazine_comments,$arr),
        wp_kses($finance_magazine_tag_list,$arr)
        );    
    }

}

if( ! function_exists( 'wp_body_open' ) ) {
    function wp_body_open() {
        do_action( 'wp_body_open' );
    }
}

/* Theme Default function and extra function*/
add_action('tgmpa_register', 'finance_magazine_required_plugins');

function finance_magazine_required_plugins() {
    if (class_exists('TGM_Plugin_Activation')) {
        $plugins = array(            
            array(
                'name' => __('Contact Form 7', 'finance-magazine'),
                'slug' => 'contact-form-7',
                'required' => false,
            ),
            array(
                'name' => __('Category and Taxonomy Image', 'finance-magazine'),
                'slug' => 'wp-custom-taxonomy-image',
                'required' => false,
            ),
            
        );
        $config = array(
            'default_path' => '',
            'menu' => 'finance-magazine-install-plugins',
            'has_notices' => true,
            'dismissable' => true,
            'dismiss_msg' => '',
            'is_automatic' => false,
            'message' => '',
            'strings' => array(
                'page_title' => __('Install Recommended Plugins', 'finance-magazine'),
                'menu_title' => __('Install Plugins', 'finance-magazine'),
                'nag_type' => 'updated'
            )
        );
        tgmpa($plugins, $config);
    }
}

add_action( 'admin_menu', 'finance_magazine_admin_menu');
function finance_magazine_admin_menu( ) { 

    add_theme_page( esc_html__('Pro Feature','finance-magazine'), esc_html__('Finance Magazine Pro','finance-magazine'), 'manage_options', 'finance-magazine-pro-buynow', 'finance_magazine_pro_buy_now', 300 );   
}
function finance_magazine_pro_buy_now(){ ?>
<div class="finance_magazine_pro_version">
  <a href="<?php echo esc_url('https://investorzone.in/wordpress-themes/item/finance-magazine-pro/'); ?>" target="_blank">
    <img src ="<?php echo esc_url(get_template_directory_uri().'/assets/images/finance-magazine-pro-feature.png') ?>" width="70%" height="auto" />
  </a>
</div>
<?php
}

include get_template_directory().'/inc/enqueues.php';
include get_template_directory().'/inc/theme-customization.php';
include get_template_directory().'/inc/custom-breadcumb.php';
include get_template_directory().'/inc/class-tgm-plugin-activation.php';