<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js gt-ie8" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title>Anpha</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url')?>">
	<link type="text/css" href="<?php bloginfo('template_directory')?>/css/pikachoo-styles/bottom.css" rel="stylesheet" />
	<link type="text/css" href="<?php bloginfo('template_directory')?>/js/fancybox/jquery.fancybox-1.3.4.css" rel="stylesheet" />
		
	<script src="<?php bloginfo('template_directory')?>/js/libs/modernizr-2.5.3.min.js"></script>
	<?php wp_head(); ?>
</head>
<body>
    <?php
        if(is_home()) $theme = 'home';
        else $theme = 'sub-page'
    ?>
    <div id="container" class="<?php echo $theme; ?>">
		
		<header>
            <span class="left">
				<!-- TODO: render background left of header -->
            </span>
            <section class="wraper">
                <!-- TODO: render content of header -->
                
                <div id="site-logo"><a href="<?php bloginfo('home'); ?>"><img src="<?php bloginfo('template_directory')?>/images/site-logo.png" alt="logo"/></a></div>
                <div id="site-description">
                	<?php $content = get_field('header_gioi_thieu', 181);
                        if($content != "") echo $content;
                        else the_default_value('header_gioi_thieu');
                     ?>

                    
                </div>
                
                <div class="hot-line">
                    <?php $content = get_field('header_lienhemuahang', 181);
                        if($content != "") echo $content;
                        else the_default_value('header_lienhemuahang');
                     ?>
                </div>
                
                <div class="hot-line last">
                	<?php $content = get_field('header_hotrotructuyen', 181);
                        if($content != "") echo $content;
                        else the_default_value('header_hotrotructuyen');
                     ?>
                </div>
                
                <div class="clear"></div>
               			
				<nav id="site-navigation">
					<?php wp_nav_menu(array('theme_location' => 'alpha-menu',
											'menu' => 'Alpha Menu',
											'container'=> '',
											)); ?>
				</nav>
				 
                <div class="clear"></div>
                		
            </section>
            <span class="right"><!-- TODO: render background right of header --></span>
            
            <span class="clear"></span>
        </header><!-- end header -->
        
        <div id="main" role="main">
            <span class="left"><!-- TODO: render background right of #main --></span>
            <section class="wraper">
                <!-- TODO: render content of #main -->