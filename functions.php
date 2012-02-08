<?php
if ( function_exists('register_sidebar') )
register_sidebar(array('name'=> __('Sidebar', 'digital-signage-wordpress'),
		  'id' => 'Sidebar',
		  'description' => __( 'The contents of this sidebar are never displayed. DockLeft is not modifiable since it contains the date and time.','digital-signage-wordpress'),
          'before_widget' => '<div>',
          'after_widget' => '</div>',
          'before_title' => '',
          'after_title' => '',
));
register_sidebar(array('name'=> __('DockCenter', 'digital-signage-wordpress'),
		  'id' => 'DockCenter',
		  'description' => __( 'Recommended use: calendar events or RSS feed','digital-signage-wordpress'),
          'before_widget' => '<div>',
          'after_widget' => '</div>',
          'before_title' => '<h3>',
          'after_title' => '</h3>',
));
register_sidebar(array('name' => __('DockRight', 'digital-signage-wordpress'),
		  'id' => 'DockRight',
		  'description' => __( 'Recommended use: calendar events or RSS feed','digital-signage-wordpress'),
          'before_widget' => '<div>',
          'after_widget' => '</div>',
          'before_title' => '<h3>',
          'after_title' => '</h3>',
));
register_sidebar(array('name' => 'DockFarRight',
		  'description' => __( 'Recommended use: calendar events or RSS feed','digital-signage-wordpress'),
          'before_widget' => '<div>',
          'after_widget' => '</div>',
          'before_title' => '<h3>',
          'after_title' => '</h3>',
));
remove_filter ('the_content', 'wpautop');
/**
 * wp_feed_cache_transient_lifetime defaults to 12 hours for default installed RSS feed widget; 
 * this will override and set to 5 minutes (300 represents seconds) for those using the included
 * RSS widget rather than installing another 3rd party RSS plugin.
 */
add_filter( 'wp_feed_cache_transient_lifetime', create_function('$a', 'return 300;') );
function get_custom_field_value($szKey, $bPrint = false) {
     global $post;
     $szValue = get_post_meta($post->ID, $szKey, true);
     if ( $bPrint == false ) return $szValue; else echo $szValue;
}
?>