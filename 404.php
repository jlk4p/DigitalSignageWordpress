<?php get_header(); ?>
<div id="myslides">
	<div class="<?php $key="background"; echo get_post_meta($post->ID, $key, true); ?>">
		<div id="container">
			<h1><?php _e( 'Not Found', 'natejones-digital-signage' ); ?></h1>
			<p><?php _e( 'There is a problem with the digital signage system.', 'natejones-digital-signage' ); ?></p>
		</div><!-- #container -->
	</div>
</div><!-- #myslides -->
<?php get_footer(); ?>