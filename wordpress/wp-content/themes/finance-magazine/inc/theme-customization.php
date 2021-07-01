<?php
/**
* Customization options
**/
function finance_magazine_all_posts(){
  $args = array( 'numberposts' => -1);
  $posts = get_posts($args);
  $post_arr = array();
  $post_arr[0] = esc_html__('All Post','finance-magazine');
  foreach( $posts as $post ) : setup_postdata($post);
    $post_arr[$post->ID] = esc_html($post->post_title); 
  endforeach; 
  return $post_arr;
}

function finance_magazine_posts_category(){
  $args = array('parent' => 0);
  $categories = get_categories($args);
  $category = array();
  $category[0] = esc_html__('All Category','finance-magazine');
  $i = 0;
  foreach($categories as $categorys){
      if($i==0){
          $default = $categorys->slug;
          $i++;
      }
      $category[$categorys->term_id] = $categorys->name;
  }
  return $category;
}
function finance_magazine_field_sanitize_select( $input, $setting ) {
  
  $input = sanitize_key( $input );
 
  $choices = $setting->manager->get_control( $setting->id )->choices;
 
  return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}
function finance_magazine_field_sanitize_checkbox( $checked ) {
    return ( ( isset( $checked ) && true === $checked ) ? true : false );
}

function finance_magazine_customize_register( $wp_customize ) {
  $wp_customize->add_setting(
    'finance_magazine_theme_color',
    array(
      'default'           => '#f17d44',
      'capability'        => 'edit_theme_options',
      'sanitize_callback' => 'sanitize_hex_color',
  ) );
  $wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize,
      'finance_magazine_theme_color',
      array(
        'label'   => esc_html__( 'Theme Color', 'finance-magazine' ),
        'section' => 'colors',
      )
  ) ); 
  $wp_customize->add_setting(
    'finance_magazine_secondary_color',
    array(
      'default'           => '#101f41',
      'capability'        => 'edit_theme_options',
      'sanitize_callback' => 'sanitize_hex_color',
  ) );
  $wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize,
      'finance_magazine_secondary_color',
      array(
        'label'   => esc_html__( 'Secondary Theme Color', 'finance-magazine' ),
        'section' => 'colors',
      )
  ) ); 
 /*-------------------- Home Page Option Setting --------------------------*/
$wp_customize->add_panel(
    'frontpage_section',
    array(
        'title' => esc_html__( 'Front Page Options', 'finance-magazine' ),
        'description' => esc_html__('Front Page options','finance-magazine'),
        'priority' => 20, 
    )
  );

$wp_customize->add_section( 'frontpage_slider_section' ,
   array(
      'title'       => esc_html__( 'Front Page : Banner Slider ', 'finance-magazine' ),
      'priority'    => 32,
      'capability'     => 'edit_theme_options', 
      'panel' => 'frontpage_section'   
  )
);
$wp_customize->add_setting('frontpage_slider_sectionswitch',
    array(
        'default' => false,
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'finance_magazine_field_sanitize_checkbox',
    )
);
$wp_customize->add_control('frontpage_slider_sectionswitch',
    array(
        'section' => 'frontpage_slider_section',     
        'label' => esc_html__('Click Check box for show Slider Section.','finance-magazine'),
        'type'       => 'checkbox',        
    )
);

$wp_customize->add_setting(
  'homepage_sliderimage_category',
  array(
    'default' => 0,
    'sanitize_callback' => 'finance_magazine_field_sanitize_select',
    'capability'  => 'edit_theme_options',
  )
);
$wp_customize->add_control(
  'homepage_sliderimage_category',
  array(
    'label' => esc_html__('Select Category For Slider','finance-magazine'),
    'section' => 'frontpage_slider_section',
    'type'    => 'select',
    'choices' => finance_magazine_posts_category(),
  )
);
$wp_customize->add_setting( 'homepage_sliderimage_per_section',
        array(
          'default' => 2,
            'capability'     => 'edit_theme_options',
            'sanitize_callback' => 'absint',
            'priority' => 20, 
        )
    );
$wp_customize->add_control( 'homepage_sliderimage_per_section',
    array(            
        'section' => 'frontpage_slider_section',                
        'label'   => esc_html__('How much sliderimage you want? ','finance-magazine'),
        'type'    => 'number',
        'input_attrs' => array( 'placeholder' => esc_html__('Enter number ','finance-magazine')),
    )
);
$per_section = get_theme_mod('homepage_sliderimage_per_section',2);
for($i=1;$i <= $per_section;$i++): 
    $wp_customize->add_setting( 'homepage_sliderimage'.$i.'_link_title',
        array(
          'default' => esc_html__('Buy now','finance-magazine'),
            'capability'     => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',
            'priority' => 20, 
        )
    );
    $wp_customize->add_control( 'homepage_sliderimage'.$i.'_link_title',
        array(            
            'section' => 'frontpage_slider_section',                
            'label'   => esc_html__('Enter Slider Link Title ','finance-magazine').$i,
            'type'    => 'text',
            'input_attrs' => array( 'placeholder' => esc_html__('Enter Slider Link Title','finance-magazine')),
        )
    ); 
endfor;

/* Front page Key Feature section */
$wp_customize->add_section( 'service_section' ,
   array(
      'title'       => esc_html__( 'Front Page : Service Section', 'finance-magazine' ),  
      'description'       => esc_html__( 'All post categories list here with name, description and their image.', 'finance-magazine' ),          
      'capability'     => 'edit_theme_options', 
      'panel' => 'frontpage_section'   
  )
);

/*homepage_service_switch*/
$wp_customize->add_setting(
    'homepage_service_switch',
    array(
        'default' => false,
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'finance_magazine_field_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'homepage_service_switch',
    array(
        'section' => 'service_section',
        'label'      => esc_html__('Click Check box for show Service Section.', 'finance-magazine'),
        'type'       => 'checkbox',
    )
);

$wp_customize->add_setting( 'homepage_service_title',
      array(
          'default' => '',
          'capability'     => 'edit_theme_options',
          'sanitize_callback' => 'sanitize_text_field',
          'priority' => 20, 
      )
  );
  $wp_customize->add_control( 'homepage_service_title',
      array(
          'section' => 'service_section',                
          'label'   => __('Enter Service Section Title ','finance-magazine'),
          'type'    => 'text',
          'input_attrs' => array( 'placeholder' => esc_html__('Enter Title','finance-magazine')),
      )
  );

  $wp_customize->add_setting( 'homepage_service_subtitle',
      array( 
          'default' => '',     
          'capability'     => 'edit_theme_options',
          'sanitize_callback' => 'sanitize_text_field',
          'priority' => 20, 
      )
  );
  $wp_customize->add_control( 'homepage_service_subtitle',
      array(
          'section' => 'service_section',                
          'label'   => __('Enter Subtitle','finance-magazine'),
          'type'    => 'text',
          'input_attrs' => array( 'placeholder' => esc_html__('Enter Subtitle','finance-magazine')),
      )
  );
  $i                = 1;
  $args             = array('orderby'    => 'id','hide_empty' => 0,);
  $categories       = get_categories( $args );$wp_category_list = array();
  foreach ( $categories as $category_list ) {
    $wp_category_list[ $category_list->cat_ID ] = $category_list->cat_name; 
    $wp_customize->add_setting(
      'category_switch_'. get_cat_id( $wp_category_list[ $category_list->cat_ID ] ),
      array(
          'default' => false,
          'capability'     => 'edit_theme_options',
          'sanitize_callback' => 'finance_magazine_field_sanitize_checkbox',
      )
    );
    $wp_customize->add_control(
        'category_switch_'. get_cat_id( $wp_category_list[ $category_list->cat_ID ] ),
        array(
            'section' => 'service_section',
            'label'           => $wp_category_list[ $category_list->cat_ID ] . esc_html__( ': Display on front page area,check this box. ', 'finance-magazine') ,
            'type'       => 'checkbox',
        )
    );
    $i++;
  }


 /*Contact us section*/
 $wp_customize->add_section( 'frontpage_contactus_section' ,
   array(
      'title'       => esc_html__( 'Front Page : Contact Us Section', 'finance-magazine' ),      
      'capability'     => 'edit_theme_options', 
      'panel' => 'frontpage_section'   
  )
);
$wp_customize->add_setting('frontpage_contactus_section_switch',
    array(
        'default' => false,
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'finance_magazine_field_sanitize_checkbox',
    )
);
$wp_customize->add_control('frontpage_contactus_section_switch',
    array(
        'section' => 'frontpage_contactus_section',     
        'label' => esc_html__('Click Check box for show Contact us Section.','finance-magazine'),
        'type'       => 'checkbox',        
    )
);

$wp_customize->add_setting(  'homepage_contactus_post',
  array(
    'default' => 0,
    'sanitize_callback' => 'finance_magazine_field_sanitize_select',
    'capability'  => 'edit_theme_options',
  )
);
$wp_customize->add_control(  'homepage_contactus_post',
  array(
    'label' => esc_html__('Select Post For Contact us','finance-magazine'),
    'section' => 'frontpage_contactus_section',
    'type'    => 'select',
    'choices' => finance_magazine_all_posts(),
  )
);

$wp_customize->add_setting( 'frontpage_contactus_link_title',
    array(
      'default' => esc_html__('Contact us','finance-magazine'),
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
        'priority' => 20, 
    )
);
$wp_customize->add_control( 'frontpage_contactus_link_title',
    array(            
        'section' => 'frontpage_contactus_section',                
        'label'   => esc_html__('Enter Contact us Link Title ','finance-magazine'),
        'type'    => 'text',
        'input_attrs' => array( 'placeholder' => esc_html__('Enter Contact us Link Title','finance-magazine')),
    )
); 
 
/*About us section*/
$wp_customize->add_section( 'frontpage_aboutus_section' ,
   array(
      'title'       => esc_html__( 'Front Page : About Us Section', 'finance-magazine' ),      
      'capability'     => 'edit_theme_options', 
      'panel' => 'frontpage_section'   
  )
);
$wp_customize->add_setting('frontpage_aboutus_section_switch',
    array(
        'default' => false,
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'finance_magazine_field_sanitize_checkbox',
    )
);
$wp_customize->add_control('frontpage_aboutus_section_switch',
    array(
        'section' => 'frontpage_aboutus_section',     
        'label' => esc_html__('Click Check box for show About Us Section.','finance-magazine'),
        'type'       => 'checkbox',        
    )
);
$wp_customize->add_setting( 'homepage_aboutus_per_section',
        array(
          'default' => 1,
            'capability'     => 'edit_theme_options',
            'sanitize_callback' => 'absint',
            'priority' => 20, 
        )
    );
$wp_customize->add_control( 'homepage_aboutus_per_section',
    array(            
        'section' => 'frontpage_aboutus_section',                
        'label'   => esc_html__('How much about us section you want? ','finance-magazine'),
        'type'    => 'number',
        'input_attrs' => array( 'placeholder' => esc_html__('Enter number ','finance-magazine')),
    )
); 
$wp_customize->add_setting(
  'homepage_about_us_category',
  array(
    'default' => 0,
    'sanitize_callback' => 'finance_magazine_field_sanitize_select',
    'capability'  => 'edit_theme_options',
  )
);
$wp_customize->add_control(
  'homepage_about_us_category',
  array(
    'label' => esc_html__('Select Category For About us','finance-magazine'),
    'section' => 'frontpage_aboutus_section',
    'type'    => 'select',
    'choices' => finance_magazine_posts_category(),
  )
);
$per_section = get_theme_mod('homepage_aboutus_per_section',1);
 for($i=1;$i<=$per_section;$i++):  
    
    $wp_customize->add_setting( 'homepage_aboutus'.$i.'_link_title',
        array(
          'default' => esc_html__('About us','finance-magazine'),
            'capability'     => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',
            'priority' => 20, 
        )
    );
    $wp_customize->add_control( 'homepage_aboutus'.$i.'_link_title',
        array(            
            'section' => 'frontpage_aboutus_section',                
            'label'   => esc_html__('Enter Aboutus Link Title ','finance-magazine').$i,
            'type'    => 'text',
            'input_attrs' => array( 'placeholder' => esc_html__('Enter About Us Link Title','finance-magazine')),
        )
    ); 
 endfor;

/* Front page Testimonial section */
$wp_customize->add_section( 'testimonial_section' ,
   array(
      'title'       => esc_html__( 'Front Page : Testimonial Section', 'finance-magazine' ),      
      'capability'     => 'edit_theme_options', 
      'panel' => 'frontpage_section'   
  )
);

/*homepage_testimonial_switch*/
$wp_customize->add_setting(
    'homepage_testimonial_switch',
    array(
        'default' => false,
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'finance_magazine_field_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'homepage_testimonial_switch',
    array(
        'section' => 'testimonial_section',
        'label'      => esc_html__('Click Check box for show Testimonial Section.', 'finance-magazine'),
        'type'       => 'checkbox',        
    )
);
$wp_customize->add_setting( 'homepage_testimonial_section_title',
      array(
          'default' => '',
          'capability'     => 'edit_theme_options',
          'sanitize_callback' => 'sanitize_text_field',
          'priority' => 20, 
      )
  );
  $wp_customize->add_control( 'homepage_testimonial_section_title',
      array(
          'section' => 'testimonial_section',                
          'label'   => __('Enter Testimonial Title ','finance-magazine'),
          'type'    => 'text',
          'input_attrs' => array( 'placeholder' => esc_html__('Enter Title','finance-magazine')),
      )
  );

$wp_customize->add_setting(
  'homepage_testimonial_category',
  array(
    'default' => 0,
    'sanitize_callback' => 'finance_magazine_field_sanitize_select',
    'capability'  => 'edit_theme_options',
  )
);
$wp_customize->add_control(
  'homepage_testimonial_category',
  array(
    'label' => esc_html__('Select Category For Testimonial','finance-magazine'),
    'section' => 'testimonial_section',
    'type'    => 'select',
    'choices' => finance_magazine_posts_category(),
  )
);

$wp_customize->add_setting(
  'homepage_testimonial_count',
  array(
    'default'    => 3,
    'capability'     => 'edit_theme_options',
    'sanitize_callback' => 'absint',
    )
  );
$wp_customize->add_control(
  'homepage_testimonial_count',
  array(
    'section' => 'testimonial_section',
    'label'      => esc_html__('Post Count', 'finance-magazine'),
    'input_attrs' => array( 'placeholder' => esc_attr__('Enter number. default 3','finance-magazine') ),
    'type'       => 'text',    
    )
  );

/* Front page latest blog section */
$wp_customize->add_section( 'latest_blog_section' ,
   array(
      'title'       => __( 'Front Page : Latest Blog Section', 'finance-magazine' ),      
      'capability'     => 'edit_theme_options', 
      'panel' => 'frontpage_section'   
  )
);

/*homepage_sectionswitch*/
$wp_customize->add_setting(
    'homepage_latest_blog_sectionswitch',
    array(
        'default' => false,
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'finance_magazine_field_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'homepage_latest_blog_sectionswitch',
    array(
        'section' => 'latest_blog_section',
        'label'      => __('Click Check box for hide Latest Blog Section', 'finance-magazine'),       
        'type'       => 'checkbox',        
    )
);

$wp_customize->add_setting( 'homepage_latest_blog_section_title',
      array(
          'default' => '',
          'capability'     => 'edit_theme_options',
          'sanitize_callback' => 'sanitize_text_field',
          'priority' => 20, 
      )
  );
  $wp_customize->add_control( 'homepage_latest_blog_section_title',
      array(
          'section' => 'latest_blog_section',                
          'label'   => __('Enter Latest Blog Title ','finance-magazine'),
          'type'    => 'text',
          'input_attrs' => array( 'placeholder' => esc_html__('Enter Title','finance-magazine')),
      )
  );

  $wp_customize->add_setting( 'homepage_latest_blog_section_desc',
      array( 
          'default' => '',     
          'capability'     => 'edit_theme_options',
          'sanitize_callback' => 'esc_html',
          'priority' => 20, 
      )
  );
  $wp_customize->add_control( 'homepage_latest_blog_section_desc',
      array(
          'section' => 'latest_blog_section',                
          'label'   => __('Enter Short Description','finance-magazine'),
          'type'    => 'textarea',
          'input_attrs' => array( 'placeholder' => esc_html__('Enter Description','finance-magazine')),
      )
  );
  $wp_customize->add_setting(
  'homepage_latest_blog_section_category',
  array(
    'default' => 0,
    'sanitize_callback' => 'finance_magazine_field_sanitize_select',
    'capability'  => 'edit_theme_options',
  )
);
$wp_customize->add_control(
  'homepage_latest_blog_section_category',
  array(
    'label' => esc_html__('Select Category For Latest Blog','finance-magazine'),
    'section' => 'latest_blog_section',
    'type'    => 'select',
    'choices' => finance_magazine_posts_category(),
  )
);
  $wp_customize->add_setting(
    'homepage_latest_blog_section_perpage',
    array(
        'default' => '1',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);
$wp_customize->add_control(
    'homepage_latest_blog_section_perpage',
    array(
        'section' => 'latest_blog_section',
        'label'      => __('Entet Latest Blog Per Page', 'finance-magazine'),
        'description' => __('Entet Latest Blog Per Page , you would like to display in the Front Page.','finance-magazine'),
        'type'       => 'number',        
    )
);
  /*General Settings section*/
   $wp_customize->add_panel(
  'general',
    array(
      'title'       => esc_html__( 'General Settings', 'finance-magazine' ),
      'description' => esc_html__('General Settings','finance-magazine'),
      'priority'    => 20, 
  ));
  $wp_customize->get_section('title_tagline')->panel = 'general';
  $wp_customize->get_section('header_image')->panel = 'general';
  $wp_customize->get_section('static_front_page')->panel = 'general';   
  $wp_customize->get_section('title_tagline')->title = esc_html__( 'Header & Logo', 'finance-magazine');
  // Start Blog Listing Section 
  $wp_customize->add_section( 'blog_page_section', array(
    'capability'          => 'edit_theme_options',
    'title'               => esc_html__('Blog(Archive) Page', 'finance-magazine'),
    'panel'               => 'general'
  ) );
  // Meta Tag Checkbox
  $wp_customize->add_setting( 'hide_post_meta_tag', array(
    'capability'          => 'edit_theme_options',
    'sanitize_callback'   => 'finance_magazine_field_sanitize_checkbox',
  ) );
  $wp_customize->add_control( 'hide_post_meta_tag', array(
    'type'                => 'checkbox',
    'section'             => 'blog_page_section', // Add a default or your own section
    'label'               => esc_html__( 'Please check this box, if you want to hide post meta tag', 'finance-magazine' ),
  ) );
  // Blog Image Checkbox
  $wp_customize->add_setting( 'hide_post_image', array(
    'capability'          => 'edit_theme_options',
    'sanitize_callback'   => 'finance_magazine_field_sanitize_checkbox',
  ) );
  $wp_customize->add_control( 'hide_post_image', array(
    'type'                => 'checkbox',
    'section'             => 'blog_page_section', // Add a default or your own section
    'label'               => esc_html__( 'Please check this box, if you want to hide post image', 'finance-magazine' ),
  ) );
  // Read More Link
  $wp_customize->add_setting( 'hide_post_readmore_button', array(
    'capability'          => 'edit_theme_options',
    'sanitize_callback'   => 'finance_magazine_field_sanitize_checkbox',
  ) );
  $wp_customize->add_control( 'hide_post_readmore_button', array(
    'type'                => 'checkbox',
    'section'             => 'blog_page_section', // Add a default or your own section
    'label'               => esc_html__( 'Please check this box, if you want to hide read more link', 'finance-magazine' ),
  ) );
  // Post Content Limit
  $wp_customize->add_setting( 'post_content_limit', array(
    'default'             => '16',
    'type'                => 'theme_mod',
    'capability'          => 'edit_theme_options',
    'sanitize_callback'   => 'sanitize_text_field',
  ) );
  $wp_customize->add_control( 'post_content_limit', array(
    'type'                => 'text',
    'priority'            => 10,
    'section'             => 'blog_page_section',
    'label'               => esc_html__( 'Post Content Limit', 'finance-magazine' ),
  ) );
  // Post Button text
  $wp_customize->add_setting( 'post_button_text', array(
    'default'             => esc_html__( 'Read More', 'finance-magazine' ),
    'type'                => 'theme_mod',
    'capability'          => 'edit_theme_options',
    'sanitize_callback'   => 'sanitize_text_field',
  ) );
  $wp_customize->add_control( 'post_button_text', array(
    'type'                => 'text',
    'priority'            => 10,
    'section'             => 'blog_page_section',
    'label'               => esc_html__( 'Post Read Me Text', 'finance-magazine' ),
  ) );
  // Blog sidebar setting 
  $wp_customize->add_setting( 'post_sidebar_layout', array(
    'default'             => 'right',
    'sanitize_callback'   => 'finance_magazine_field_sanitize_select',
  ) );
  $wp_customize->add_control( 'post_sidebar_layout', array(
    'type'                => 'select',
    'section'             => 'blog_page_section',
    'label'               => esc_html__( 'Display Sidebar', 'finance-magazine' ),
    'choices'             => array(
      'right'             => esc_html__( 'Right', 'finance-magazine' ),
      'left'              => esc_html__( 'Left', 'finance-magazine' ),
      'full'              => esc_html__( 'Full', 'finance-magazine' ),
      )
  ) );
  // End Blog Listing Section
  // Start Single Post Page Section
  $wp_customize->add_section( 'single_post_page_section', array(
    'capability'          => 'edit_theme_options',
    'title'               => esc_html__('Single Post Page', 'finance-magazine'),
    'panel'               => 'general'
  ) );
  // Single Post Meta Tag Checkbox 
  $wp_customize->add_setting( 'hide_single_post_meta_tag', array(
    'capability'          => 'edit_theme_options',
    'sanitize_callback'   => 'finance_magazine_field_sanitize_checkbox',
  ) );
  $wp_customize->add_control( 'hide_single_post_meta_tag', array(
    'type'                => 'checkbox',
    'section'             => 'single_post_page_section', // Add a default or your own section
    'label'               => esc_html__( 'Please check this box, if you want to hide post meta tag', 'finance-magazine' ),      
  ) ); 
  
  // Single Post Page Sidebar
  $wp_customize->add_setting( 'single_post_sidebar_layout', array(
    'default'             => 'right',
    'sanitize_callback'   => 'finance_magazine_field_sanitize_select',
  ) );
  $wp_customize->add_control( 'single_post_sidebar_layout', array(
    'type'                => 'select',
    'section'             => 'single_post_page_section',
    'label'               => esc_html__( 'Display Sidebar', 'finance-magazine' ),
    'choices'             => array(
      'right'             => esc_html__( 'Right', 'finance-magazine' ),
      'left'              => esc_html__( 'Left', 'finance-magazine' ),
      'full'              => esc_html__( 'Full', 'finance-magazine' ),
    )
  ) );
  // End Blog Page Section
  /* --------------------------- Start Footer Settings Panel ------------- */
  $wp_customize->add_section( 'footer_setting', array(
    'capability'          => 'edit_theme_options',
    'title'               => esc_html__('Footer Settings', 'finance-magazine'),
  ) );
  $wp_customize->add_setting( 'footerCopyright', array(
    'type'                => 'theme_mod',
    'capability'          => 'edit_theme_options',
    'sanitize_callback'   => 'esc_html',
  ) );
  $wp_customize->add_control( 'footerCopyright', array(
    'type'                => 'textarea',
    'section'             => 'footer_setting',
    'label'               => esc_html__('Copyright Text','finance-magazine'),
    'description'         => esc_html__('Some text regarding copyright of your site, you would like to display in the footer.', 'finance-magazine'),
  ) ); 

}
add_action( 'customize_register', 'finance_magazine_customize_register' );
function finance_magazine_custom_css(){ 
  $custom_css ='';
  $custom_css .= '*::selection, .slider-content-area a.slide-btn, #main-slider .owl-dots button.owl-dot.active, .search-section button.btn.btn-default, .story-wrap .story-content a.story-btn-more:hover, .sidebar aside.widget .tagcloud a.tag-cloud-link, .comment-respond form#commentform input[type="submit"], #cssmenu .button:before, #cssmenu .button.menu-opened:before, #cssmenu .button.menu-opened:after, form.wpcf7-form input.wpcf7-submit {background: '.esc_attr(get_theme_mod('finance_magazine_theme_color','#f17d44')).';}

    #cssmenu > ul > li.current_page_item > a, #cssmenu > ul > li > a:hover, .heading-area h1.title, .heading-area-white h1.title, .key-feature-box .feature-content h1.title, .key-feature-box .feature-content h1.title a, .talk-wrap .talk-btn a, .story-wrap .story-content a.story-btn-more, .story-wrap .story-area:nth-child(even) .story-content h3.title, .story-wrap .story-area:nth-child(even) .story-content a.story-btn-more:hover, .testimonial-area .testimonial-box .client-name h4, .box-content h2, .box-content h2 a, .footer .footer-widget ul li a:hover, .footer .copywrite-section a, .breadcrumb-list a:hover, .sidebar aside.widget ul li a:hover, .box-content h2, ul.post-meta-list li a:hover, #cssmenu ul ul li a:hover, #cssmenu ul ul li:hover > a, .footer .footer-widget table tbody tr td#today, .footer .footer-widget table tfoot tr td a:hover, .sidebar aside.widget table tbody tr td#today, .sidebar aside.widget table tfoot tr td a:hover, #cssmenu > ul > li:hover > a, #cssmenu > ul > li.current_page_item > a, .footer .footer-widget p a:hover {color: '.esc_attr(get_theme_mod('finance_magazine_theme_color','#f17d44')).';}

    #main-slider .owl-dots button.owl-dot, .search-section button.btn.btn-default, .story-wrap .story-content a.story-btn-more, #cssmenu > ul > li.has-sub:hover > a:before, #cssmenu > ul > li:hover > a, #cssmenu > ul > li.current_page_item > a,  #cssmenu .button:after{border-color: '.esc_attr(get_theme_mod('finance_magazine_theme_color','#f17d44')).';}
  ';

  $custom_css .='#cssmenu ul ul, .story-wrap .story-area:nth-child(even), .testimonials-wrap, .box-content a.read-btn, .footer, nav.post-navigation .nav-links .nav-previous a, nav.post-navigation .nav-links .nav-next a, #cssmenu ul ul li, .breadcrumb-area {background: '.esc_attr(get_theme_mod('finance_magazine_secondary_color','#101f41')).';}

    .box-content small{color: '.esc_attr(get_theme_mod('finance_magazine_secondary_color','#101f41')).';}

    {border-color: '.esc_attr(get_theme_mod('finance_magazine_secondary_color','#101f41')).';}

    #cssmenu ul ul:after{border-bottom-color: '.esc_attr(get_theme_mod('finance_magazine_secondary_color','#101f41')).';}

    @media (max-width:1024px){
      #cssmenu ul.offside{background: '.esc_attr(get_theme_mod('finance_magazine_secondary_color','#101f41')).';}
    }
  ';
  

  wp_add_inline_style('finance-magazine-style',$custom_css);

}