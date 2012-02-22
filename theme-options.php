<?php

add_action( 'admin_init', 'theme_options_init' );
add_action( 'admin_menu', 'theme_options_add_page' );
add_action( 'after_setup_theme', 'natejones_digital_signage_options_init', 9 );

/**
 * Init plugin options to white list our options
 */
function theme_options_init(){
	register_setting( 'digital_signage_options', 'digital_signage_theme_options', 'theme_options_validate' );
}

/**
 * Load up the menu page
 */
function theme_options_add_page() {
	add_theme_page( __( 'Theme Options', 'natejones-digital-signage' ), __( 'Theme Options', 'natejones-digital-signage' ), 'edit_theme_options', 'theme_options', 'theme_options_do_page' );
}

/**
 * Create arrays for our select and radio options
 */
$default_background_color_options = array(
	'brown' => array(
		'value' =>	'brown',
		'label' => __( 'brown', 'natejones-digital-signage' )
	),
	'darkblue' => array(
		'value' =>	'darkblue',
		'label' => __( 'darkblue', 'natejones-digital-signage' )
	),
	'green' => array(
		'value' => 'green',
		'label' => __( 'green', 'natejones-digital-signage' )
	),
	'lightblue' => array(
		'value' => 'lightblue',
		'label' => __( 'lightblue', 'natejones-digital-signage' )
	),
	'orange' => array(
		'value' => 'orange',
		'label' => __( 'orange', 'natejones-digital-signage' )
	),
	'purple' => array(
		'value' => 'purple',
		'label' => __( 'purple', 'natejones-digital-signage' )
	),
	'red' => array(
		'value' => 'red',
		'label' => __( 'red', 'natejones-digital-signage' )
	)
);

// Page refresh will be a display of radio options in 15 minute intervals.
// Radio labels will be minutes; but values represent seconds, i.e. 30 min = 60x30 or 1800;
$page_auto_refresh_frequency_options = array(
	'900' => array(
		'value' => '900',
		'label' => __( '15', 'natejones-digital-signage' )
	),
	'1800' => array(
		'value' => '1800',
		'label' => __( '30', 'natejones-digital-signage' )
	),
	'2700' => array(
		'value' => '2700',
		'label' => __( '45', 'natejones-digital-signage' )
	),
	'3600' => array(
		'value' => '3600',
		'label' => __( '60', 'natejones-digital-signage' )
	)
);

/**
 * Create the options page
 */
function theme_options_do_page() {
	global $default_background_color_options, $page_auto_refresh_frequency_options;

	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false;

	?>
	<div class="wrap">
		<?php screen_icon(); echo "<h2>" . get_current_theme() . __( ' Theme Options', 'natejones-digital-signage' ) . "</h2>"; ?>

		<?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
		<div class="updated fade"><p><strong><?php _e( 'Options saved', 'natejones-digital-signage' ); ?></strong></p></div>
		<?php endif; ?>

		<form method="post" action="options.php">
			<?php settings_fields( 'digital_signage_options' ); ?>
			<?php $options = get_option( 'digital_signage_theme_options' ); ?>

			<table class="form-table">

				<?php
				/**
				 * Default background color select input option
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Default background color', 'natejones-digital-signage' ); ?></th>
					<td>
						<select name="digital_signage_theme_options[default_background_color]">
							<?php
								$selected = $options['default_background_color'];
								$p = '';
								$r = '';

								foreach ( $default_background_color_options as $option ) {
									$label = $option['label'];
									if ( $selected == $option['value'] ) // Make default first in list
										$p = "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
									else
										$r .= "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
								}
								echo $p . $r;
							?>
						</select>
						<label class="description" for="digital_signage_theme_options[default_background_color]"><?php _e( 'When no background color is specified for a post, this one will be used.', 'natejones-digital-signage' ); ?></label>
					</td>
				</tr>

				<?php
				/**
				 * Page auto-refresh frequency (in minutes) radio buttons
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Page auto-refresh frequency (minutes)', 'natejones-digital-signage' ); ?></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e( 'Page auto-refresh frequency (minutes)', 'natejones-digital-signage' ); ?></span></legend>
						<?php
							if ( ! isset( $checked ) )
								$checked = '';
							foreach ( $page_auto_refresh_frequency_options as $option ) {
								$radio_setting = $options['page_auto_refresh_frequency'];

								if ( '' != $radio_setting ) {
									if ( $options['page_auto_refresh_frequency'] == $option['value'] ) {
										$checked = "checked=\"checked\"";
									} else {
										$checked = '';
									}
								}
								?>
								<label class="description"><input type="radio" name="digital_signage_theme_options[page_auto_refresh_frequency]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php echo $checked; ?> /> <?php echo $option['label']; ?></label><br />
								<?php
							}
						?>
						</fieldset>
					</td>
				</tr>

				<?php
				/**
				 * Seconds between posts input option
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Seconds between posts', 'natejones-digital-signage' ); ?></th>
					<td>
						<input id="digital_signage_theme_options[seconds_between_posts]" class="small-text" type="text" name="digital_signage_theme_options[seconds_between_posts]" value="<?php esc_attr_e( $options['seconds_between_posts'] ); ?>" />
						<label class="description" for="digital_signage_theme_options[seconds_between_posts]"><?php _e( 'Specify how many seconds a post should display before switching to the next one; allowable values are between 10 and 90 seconds.', 'natejones-digital-signage' ); ?></label>
					</td>
				</tr>
			</table>

			<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e( 'Save Options', 'natejones-digital-signage' ); ?>" />
			</p>
		</form>
		<hr />
		<h3>Required WordPress Plugins</h3>
		<p>This theme relies on the follow minimum plugins which need to be installed and active:</p>
		<ul>
			<li><a href="http://wordpress.org/extend/plugins/more-fields/" target="_blank">More Fields</a> - used to define additional signage fields for Posts. (See configuration below.)</li>
			<li><a href="http://wordpress.org/extend/plugins/post-expirator/" target="_blank">Post Expirator</a> - allows you to have posts automatically expire and stop displaying on the digital sign.</li>
			<li><a href="http://wordpress.org/extend/plugins/qr-code-tag/" target="_blank">QR Code Tag</a> - used to generate QR codes from URLs that may provide more details for a Post.</li>
			<li><a href="http://wordpress.org/extend/plugins/wordpress-mobile-edition/" target="_blank">WordPress Mobile Edition</a> - used to provide a reasonable display for anyone getting to your digital sign URL from a mobile device.</li>
		</ul>
		<hr />
		<h3>More Fields Plugin Settings</h3>
		<p>The following boxes/fields need to be defined in order to use this theme successfully.</p>
		<p><strong>1. Create an input box labeled "Digital Signage Theme Inputs" that is used with Posts.</strong><br />
		<img alt="Title of the box is Digital Signage Theme Inputs." src="<?php echo get_stylesheet_directory_uri(); ?>/images/digital_signage_box.png" />
		</p>
		<p><strong>2. Edit the box to add a new field. The custom key field must be background. After choosing select as the field type, the Values text box should contain brown, darkblue, green, lightblue, orange, purple, red .</strong><br />
		<img alt="Edit the box to add a new field. Field title is Background. Custom field key is background. Field type is select. Values contains brown, darkblue, green, lightblue, orange, purple, red." src="<?php echo get_stylesheet_directory_uri(); ?>/images/digital_signage_background.png" />
		</p>
		<p><strong>3. Edit the box to add a new field. The custom key field must be subhead. Add caption text to explain its purpose and indicate it is optional. Field type is text.</strong><br />
		<img alt="Edit the box to add a new field. Field title is Subhead. Custom field key is subhead. Field type is text. Caption should indicate optional." src="<?php echo get_stylesheet_directory_uri(); ?>/images/digital_signage_subhead.png" />
		</p>
		<p><strong>4. Edit the box to add a new field. The custom key field must be webaddress. Add caption text to explain that it is used to generate QR codes and indicate it is optional. Field type is text.</strong><br />
		<img alt="Edit the box to add a new field. Field title is Web Address (include http://). Custom field key is webaddress. Caption should indicate optional." src="<?php echo get_stylesheet_directory_uri(); ?>/images/digital_signage_web_address.png" />
		</p>
		<p><strong>5. Edit the box to add a new field. The custom key field must be image. Add caption text to explain that this will display an image along side the post and indicate it is optional. Field type is text.</strong><br />
		<img alt="Edit the box to add a new field. Field title is Image. Custom field key is image. Caption should indicate optional." src="<?php echo get_stylesheet_directory_uri(); ?>/images/digital_signage_image.png" />
		</p>
		<p><strong>6. Edit the box to add a new field. The custom key field must be imagealign. After choosing select as the field type, the Values text box should contain left, right . You can prefix either value with * (asterix) to have that value be the default.</strong><br />
		<img alt="Edit the box to add a new field. Field title is Image Alignment. Custom field key is imagealign. Field type is select. Values contains *left, right" src="<?php echo get_stylesheet_directory_uri(); ?>/images/digital_signage_image_align.png" />
		</p>
	</div>
	<?php
}

/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
function theme_options_validate( $input ) {
	global $default_background_color_options, $page_auto_refresh_frequency_options;
	$default_options = natejones_digital_signage_get_default_options();
	
	// Seconds between posts option must be safe text with no HTML tags
	$input['seconds_between_posts'] = wp_filter_nohtml_kses( $input['seconds_between_posts'] );
	// The text value must be a number representing between 10 and 90 seconds.
	if ( is_numeric( $input['seconds_between_posts'] ) ) {
		$seconds = intval( $input['seconds_between_posts'] );
		if (( $seconds < 10 ) or ( $seconds > 90 ))
			$input['seconds_between_posts'] = $default_options['seconds_between_posts'];
	} else {
		$input['seconds_between_posts'] = $default_options['seconds_between_posts'];
	}
	
	// Our select option must actually be in our array of select options
	if ( ! array_key_exists( $input['default_background_color'], $default_background_color_options ) )
		$input['default_background_color'] = $default_options['default_background_color'];

	// Our radio option must actually be in our array of radio options
	if ( ! isset( $input['page_auto_refresh_frequency'] ) )
		$input['page_auto_refresh_frequency'] = $default_options['page_auto_refresh_frequency'];
	if ( ! array_key_exists( $input['page_auto_refresh_frequency'], $page_auto_refresh_frequency_options ) )
		$input['page_auto_refresh_frequency'] = $default_options['page_auto_refresh_frequency'];

	return $input;
}

// based on http://ottopress.com/2009/wordpress-settings-api-tutorial/  which was 
// adapted from http://planetozh.com/blog/2009/05/handling-plugins-options-in-wordpress-28-with-register_setting/

// Default values function based on http://www.chipbennett.net/2011/02/17/incorporating-the-settings-api-in-wordpress-themes/?all=1
function natejones_digital_signage_get_default_options() {
	$options = array(
		'default_background_color' => 'darkblue',
		'page_auto_refresh_frequency' => '3600',
		'seconds_between_posts' => '20'
	);
	return $options;
}

function natejones_digital_signage_options_init() {
	// set options equal to defaults
	//global $digital_signage_options;
	$digital_signage_options = get_option( 'digital_signage_theme_options' );
	if (false === $digital_signage_options) {
		$digital_signage_options = natejones_digital_signage_get_default_options();
	}
	update_option( 'digital_signage_theme_options', $digital_signage_options );
}