<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package kishandchips
 * @since kishandchips 1.0
 */
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if IE 9]>         <html class="no-js lt-ie10"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js"> <!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link href="<?php echo get_template_directory_uri(); ?>/images/misc/favicon.png" rel="shortcut icon" type="image/x-icon">
    
    <script type="text/javascript">
		var themeUrl = '<?php bloginfo( 'template_url' ); ?>';
		var baseUrl = '<?php bloginfo( 'url' ); ?>';
	</script>
    <?php

	if ( ! is_admin() ) {
        wp_deregister_script('jquery');
        wp_register_script('jquery', get_template_directory_uri().'/js/libs/jquery.min.js', false, '1.9.1');
        wp_enqueue_script('jquery');
    }
	
	function load_assets() {
		wp_enqueue_style('font-styles', 'http://fast.fonts.com/cssapi/a57cd7a1-40f8-420b-9db8-bb7c7b70c15f.css');		
		wp_enqueue_style('style', get_template_directory_uri().'/css/style.css');

		wp_enqueue_script('modernizr', get_template_directory_uri().'/js/libs/modernizr.min.js');
		wp_enqueue_script('jquery', get_template_directory_uri().'/js/libs/jquery.min.js');
		wp_enqueue_script('easing', get_template_directory_uri().'/js/plugins/jquery.easing.js');
		wp_enqueue_script('imagesloaded', get_template_directory_uri().'/js/plugins/jquery.imagesloaded.js');
		wp_enqueue_script('main', get_template_directory_uri().'/js/main.js');
	}
	add_action('wp_enqueue_scripts', 'load_assets');
	wp_head();
?>

</head>
<body <?php body_class(); ?>>
<div id="wrap" class="hfeed site">
	<header id="header" role="banner">
		<div class="inner container">
			<h1 class="logo-container">
				<a class="logo" href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
			</h1>
			<div class="navigation-container">
				<button class="mobile-navigation-btn uppercase">menu <i aria-hidden="true" class="icon-arrow-down tiny"></i></button>
				<nav role="navigation" class="site-navigation main-navigation">
					<?php wp_nav_menu( array( 'theme_location' => 'primary_header', 'menu_class' => 'clearfix menu', 'container' => false ) ); ?>
				</nav><!-- .site-navigation .main-navigation -->
			</div>
		</div>
	</header><!-- #header -->
	<div id="main" class="site-main" role="main">