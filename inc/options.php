<?php

add_action( 'admin_init', 'theme_options_init' );
add_action( 'admin_menu', 'theme_options_add_page' );

/**
 * Init plugin options to white list our options
 */
function theme_options_init(){
	register_setting( 'kishandchips_options', 'kishandchips_theme_options', 'theme_options_validate' );
}

/**
 * Load up the menu page
 */
function theme_options_add_page() {
	add_theme_page( __( 'Theme Options', 'kishandchips' ), __( 'Theme Options', 'kishandchips' ), 'edit_theme_options', 'theme_options', 'theme_options_do_page' );
}



/**
 * Create the options page
 */
function theme_options_do_page() {
	global $select_options, $radio_options;

	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false;

	?>
	<div class="wrap">
		<?php screen_icon(); echo "<h2>" . wp_get_theme() . __( ' Theme Options', 'kishandchips' ) . "</h2>"; ?>

		<?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
		<div class="updated fade"><p><strong><?php _e( 'Options saved', 'kishandchips' ); ?></strong></p></div>
		<?php endif; ?>

		<form method="post" action="options.php">
			<?php settings_fields( 'kishandchips_options' ); ?>
			<?php $options = get_option( 'kishandchips_theme_options' ); ?>

			<table class="form-table">

				<tr valign="top"><th scope="row"><?php _e( 'Facebook URL', 'kishandchips' ); ?></th>
					<td>
						 <input id="kishandchips_theme_options[facebook_url]" class="regular-text" type="text" name="kishandchips_theme_options[facebook_url]" value="<?php esc_attr_e( $options['facebook_url'] ); ?>" />
					</td>
				</tr>

				<tr valign="top"><th scope="row"><?php _e( 'Twitter URL', 'kishandchips' ); ?></th>
					<td>
						 <input id="kishandchips_theme_options[twitter_url]" class="regular-text" type="text" name="kishandchips_theme_options[twitter_url]" value="<?php esc_attr_e( $options['twitter_url'] ); ?>" />
					</td>
				</tr>

				<tr valign="top"><th scope="row"><?php _e( 'Pinterest URL', 'kishandchips' ); ?></th>
					<td>
						 <input id="kishandchips_theme_options[pinterest_url]" class="regular-text" type="text" name="kishandchips_theme_options[pinterest_url]" value="<?php esc_attr_e( $options['pinterest_url'] ); ?>" />
					</td>
				</tr>

				
			</table>
			<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e( 'Save Options', 'kishandchips' ); ?>" />
			</p>
		</form>
	</div>
	<?php
}

/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
function theme_options_validate( $input ) {
	$input['facebook_url'] = wp_filter_nohtml_kses( $input['facebook_url'] );
	$input['twitter_url'] = wp_filter_nohtml_kses( $input['twitter_url'] );
	$input['pinterest_url'] = wp_filter_nohtml_kses( $input['pinterest_url'] );
	return $input;
}