<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php wp_head(); ?>    
</head>
<body <?php body_class();?>>
    <?php wp_body_open(); ?>
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'finance-magazine' ); ?></a>
     <div class="preloader">
        <span class="preloader-gif">
            <svg width="200px"  height="200px"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" class="lds-eclipse" style="background: none;"><path ng-attr-d="{{config.pathCmd}}" ng-attr-fill="{{config.color}}" stroke="none" d="M40 50A10 10 0 0 0 60 50A10 11 0 0 1 40 50" fill="#444f84" transform="rotate(102 50 50.5)"><animateTransform attributeName="transform" type="rotate" calcMode="linear" values="0 50 50.5;360 50 50.5" keyTimes="0;1" dur="1s" begin="0s" repeatCount="indefinite"></animateTransform></path></svg>
        </span>
     </div>
    <header>
        <div class="header-top">
            <div class="container">
                <!-- Menu -->
                <div class="row">
                    <div class="col-xs-12 col-sm-12">
                        <div class="logoSite">
                            <?php if(has_custom_logo()): the_custom_logo();  endif; 
                            if(display_header_text()): ?>
                                <div class="logo-light "><a href="<?php echo esc_url(home_url('/')); ?>" rel="home" class="site-title"><h4 class="custom-logo "><?php echo esc_html( get_bloginfo( 'name' ) ); ?></h4><h6 class="custom-logo site-description"><?php echo esc_html( get_bloginfo( 'description' ) ); ?></h6></a></div>
                            <?php endif; ?>
                        </div>
                        <div class="main-menu">
                            <!-- Responsive Menu -->
                            <nav id='cssmenu'>
                                <div id="box-top-mobile"></div>
                                <button class="button"></button>
                                <?php wp_nav_menu( array(
                                    'theme_location' => 'primary',
                                    'menu_id'        => 'main-menu-nav',
                                    'menu_class'        => 'offside',
                                    'container'=> false,
                                 ) );
                                ?>                               
                            </nav>
                            <!-- Responsive Menu End -->
                        </div>
                    </div>
                </div>
                <!-- Menu End -->
            </div>
        </div>
    </header>
    <div id="content">
    <?php if(!is_front_page()):?>
    <section class="breadcrumb w-100">
        <div class="breadcrumb-area w-100">
            <div class="container">
                <div class="breadcrumb-list" >                   
                   <?php finance_magazine_custom_breadcrumbs();?>
                </div>
            </div>
        </div>
    </section>
    <?php endif;