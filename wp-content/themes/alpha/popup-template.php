<?php
/*
Template Name: Popup Template
*/
?>

<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
    
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">

        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="<?php bloginfo('stylesheet_url')?>">
        
        <script src="<?php bloginfo('template_directory')?>/js/libs/modernizr-2.5.3.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 7]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->
        <div id="popup-container">
            
			<div role="main" id="popup-main">
                <!-- Display the main content -->
				<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
					<p>
						<?php the_content('');?>
					</p>
				<?php endwhile; ?>
				<?php else : ?>
					<p>Sorry There are no posts to display!</p>
				<?php endif; ?>
            </div><!--end role main-->
            
            
        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?php bloginfo('template_directory')?>/js/libs/jquery-1.7.1.min.js"><\/script>')</script>

        <script src="<?php bloginfo('template_directory')?>/js/plugins.js"></script>
        <script src="<?php bloginfo('template_directory')?>/js/script.js"></script>

        <script>
        var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
        (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
        g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
        s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>
    </body>
</html>

