<?php

add_shortcode( 'base_url', 'base_url_handler' );
function base_url_handler( $atts ) {
	return get_bloginfo('url');
}

add_shortcode( 'uploads_url', 'uploads_url_handler' );
function uploads_url_handler( $atts ) {
	$uploads_dir = wp_upload_dir();
	return $uploads_dir['baseurl'];
}