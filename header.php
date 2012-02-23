<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="utf-8" />
     <meta http-equiv="refresh" content="<?php $options = get_option('digital_signage_theme_options'); echo $options['page_auto_refresh_frequency']; ?>">
     <meta http-equiv="pragma" content="nocache">
     <title><?php bloginfo('name'); ?></title>
     <meta name="description" content="<?php bloginfo('description'); ?>" />
     <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/style.css" />
     <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript"></script>
     <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/scripts/jquery.cycle.all.js"></script>
     <script src="<?php bloginfo('stylesheet_directory'); ?>/scripts/jcarousellite_1.0.1.js" type="text/javascript"></script>
     <script src="<?php bloginfo('stylesheet_directory'); ?>/scripts/digsign_datetime.js" type="text/javascript"></script>
     <script type="text/javascript">
        $(document).ready(function(){
		   $('#myslides').cycle({
				fx: 'fade',
				speed: 1000,
				timeout: <?php $options = get_option('digital_signage_theme_options'); echo $options['seconds_between_posts'].'000'; ?>
		   });
		   $(".scroll").jCarouselLite({
				vertical: true,
				hoverPause:false,
				visible: 1,
				auto:9000,
				speed:500
		   });
		   $(".scroll2").jCarouselLite({
				vertical: true,
				hoverPause:false,
				visible: 2,
				auto:11000,
				speed:500
		   });
		   $(".scroll3").jCarouselLite({
				vertical: true,
				hoverPause:false,
				visible: 2,
				auto:7000,
				speed:500
		   });
		   // Update the date and time every second since client side; this loops indefinitely
		   updateDateTime('<?php $options = get_option('digital_signage_theme_options'); echo $options['show_seconds_in_time']; ?>');
		   var timerID = setInterval("updateDateTime('<?php $options = get_option('digital_signage_theme_options'); echo $options['show_seconds_in_time']; ?>')",1000);
        });
     </script>
     <?php wp_head() ?>
</head>
<body>