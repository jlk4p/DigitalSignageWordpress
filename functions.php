<?php
// Load up  theme options
require_once( get_template_directory() . '/theme-options.php' );
// Define sidebars
if ( function_exists('register_sidebar') )
register_sidebar(array('name'=> __('Sidebar', 'natejones-digital-signage'),
		  'id' => 'Sidebar',
		  'description' => __( 'The contents of this sidebar are never displayed. DockLeft is not modifiable since it contains the clock.','natejones-digital-signage'),
          'before_widget' => '<div>',
          'after_widget' => '</div>',
          'before_title' => '',
          'after_title' => '',
));
register_sidebar(array('name' => __('DockRight', 'natejones-digital-signage'),
		  'id' => 'DockRight',
		  'description' => __( 'Recommended use: displaying U.Va. alerts.','natejones-digital-signage'),
          'before_widget' => '<div>',
          'after_widget' => '</div>',
          'before_title' => '',
          'after_title' => '',
));
remove_filter('the_content', 'wpautop');
/**
 * wp_feed_cache_transient_lifetime defaults to 12 hours for default installed RSS feed widget; 
 * this will override and set to 5 minutes (300 represents seconds)
 */
add_filter( 'wp_feed_cache_transient_lifetime', create_function('$a', 'return 300;') );
function get_custom_field_value($szKey, $bPrint = false) {
     global $post;
     $szValue = get_post_meta($post->ID, $szKey, true);
     if ( $bPrint == false ) return $szValue; else echo $szValue;
}
?>