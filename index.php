<?php get_header() ?>
 
<div id="myslides">
	<?php query_posts("orderby=rand"); $i = 1;  ?>
	<?php while (have_posts()) : the_post(); ?>
	   <div class="<?php $options = get_option('digital_signage_theme_options'); $key="background"; $background_color=trim(get_post_meta($post->ID, $key, true)); echo ($background_color != '') ? $background_color : $options['default_background_color']; ?>">
			<div class="container">
				 <h1><?php the_title() ?></h1>
				 <?php $key="subhead"; if (trim(get_post_meta($post->ID, $key, true)) != '') : ?>
				 <h2><?php echo get_post_meta($post->ID, $key, true); ?></h2>
				 <?php endif; ?>
				 <p>
					<?php $key="image"; if (trim(get_post_meta($post->ID, $key, true)) != '') : ?>
					<img src="<?php echo get_post_meta($post->ID, $key, true); ?>" class="<?php $key="imagealign"; echo get_post_meta($post->ID, $key, true); ?>" />
					<?php endif; ?>
					<?php the_content(); ?>
				 </p>
				 <?php global $qrcodetag; $key="webaddress"; if (trim(get_post_meta($post->ID, $key, true)) != '') : ?>
				 <p class="url">
					<img src="<?php echo $qrcodetag->getQrCodeUrl(get_post_meta($post->ID, $key, true),248,'UTF-8','L',4,0); ?>" />
				 </p>
				 <?php endif; ?>
			</div><!--.container-->
	   </div><!--color-->
	<?php endwhile; ?>
</div><!--#myslides-->

<?php get_sidebar(); ?>
<?php get_footer(); ?>