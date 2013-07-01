<?php
/**
 * kishandchips functions and definitions
 *
 * @package kishandchips
 * @since kishandchips 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since kishandchips 1.0
 */

if ( ! function_exists( 'kishandchips_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since kishandchips 1.0
 */
function kishandchips_setup() {

	require( get_template_directory() . '/inc/custom_post_type.php' );

	require( get_template_directory() . '/inc/shortcodes.php' );

	require( get_template_directory() . '/inc/options.php' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary_header' => __( 'Primary Menu', 'kishandchips' )
	) );

	add_image_size( 'custom_large', 530, 650, true);
	add_image_size( 'custom_medium', 380, 250, true);
	add_image_size( 'custom_thumbnail', 210, 9999);
	
	add_filter('jpeg_quality', function($arg){return 100;});

	add_filter('next_posts_link_attributes', 'posts_link_next_class');
	function posts_link_next_class() {
		return 'class="next-btn"';
	} 
	
	add_filter('previous_posts_link_attributes', 'posts_link_prev_class');
	function posts_link_prev_class() {
		return 'class="prev-btn"';
	}

	// Create custom post types

	// $celebrity_bear = new Custom_Post_Type( 'Celebrity Bear', 
 // 		array(
 // 			'rewrite' => array( 'with_front' => false, 'slug' => get_page_uri(get_kishandchips_option('celebrity_bear_page_id')) ),
 // 			'capability_type' => 'post',
 // 		 	'publicly_queryable' => true,
 //   			'has_archive' => true, 
 //    		'hierarchical' => false,
 //    		'exclude_from_search' => true,
 //    		'menu_position' => null,
 //    		'supports' => array('title', 'thumbnail', 'page-attributes'),
 //    		'plural' => 'Celebrity Bears'
 //   		)
 //   	);

	
 	//global $wp_rewrite;
	//$wp_rewrite->flush_rules();
	//add_rewrite_rule('case-studies/([^/]+)?', 'index.php?post_type=true&work=$matches[1]', 'top');
   	//$shop->add_taxonomy('Shop Category', array('hierarchical' => true), array('plural' => 'Shop Categories'));

	add_editor_style('css/editor-styles.css');

	add_filter("gform_tabindex", create_function("", "return false;"));
}
endif; // kishandchips_setup

add_action( 'after_setup_theme', 'kishandchips_setup' );


/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since kishandchips 1.0
 */

function get_the_adjacent_fukn_post($adjacent, $post_type = 'post', $category = array(), $post_parent = 0){
	global $post;
	$args = array( 
		'post_type' => $post_type,
		'order' => 'ASC', 
		'posts_per_page' => -1,
		'category__in' => $category,
		'post_parent' => $post_parent
	);
	
	$curr_post = $post;
	$new_post = NULL;
	$custom_query = new WP_Query($args);
	$posts = $custom_query->get_posts();
	$total_posts = count($posts);
	$i = 0;
	foreach($posts as $a_post) {
		if($a_post->ID == $curr_post->ID){
			if($adjacent == 'next'){
				$new_i = ($i + 1 >= $total_posts) ? 0 : $i + 1; 
				$new_post = $posts[$new_i];	
			} else {
				$new_i = ($i - 1 <= 0) ? $total_posts - 1 : $i - 1; 
				$new_post = $posts[$new_i];	
			}
			break;	
		}
		$i++;
	}
	
	return $new_post;
}

function get_kishandchips_option($option){
	$options = get_option('kishandchips_theme_options');
	return $options[$option];
}


add_action('nav_menu_css_class', 'nav_add_classes', 10, 2);

function nav_add_classes($classes, $item){
	$slug = str_replace(array(get_option('home')), '', $item->url);
	$current_slug = str_replace(array(get_option('home')), '', get_current_url());
	if (strpos($current_slug, $slug) !== false && $slug != '/') {
		$classes[] = 'current';
	}

	return $classes;
}

if ( ! function_exists( 'get_current_url' )) {
	function get_current_url() {
		$url = 'http';
		if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') $url .= 's';
			$url .= '://';

		if ($_SERVER['SERVER_PORT'] != '80') {
			$url .= $_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].$_SERVER['REQUEST_URI'];
		} else {
			$url .= $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
		}
		return $url;
	}
}


add_action('tiny_mce_before_init', 'custom_tinymce_options'); 

if ( ! function_exists( 'custom_tinymce_options' )) { 
	function custom_tinymce_options($init){ 
		$init['apply_source_formatting'] = true; 
		return $init; 
	} 
}

function get_queried_page(){
	$curr_url = get_current_url();
	$curr_uri = str_replace(site_url(), '', $curr_url);
	$page = get_page_by_path($curr_uri);
	if($page) return $page;
	return null;
}
