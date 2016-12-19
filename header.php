<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9 ]>   <html class="ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>

<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />

<title>
    <?php
	
	//Print the <title> tag based on what is being viewed.

	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );


	// Add the blog description for the home/front page.

	$site_description = get_bloginfo( 'description', 'display' );

	if ( $site_description && ( is_home() || is_front_page() ) )

		echo " | $site_description";


	// Add a page number if necessary:

	if ( $paged >= 2 || $page >= 2 )

		echo ' | ' . sprintf( __( 'Page %s', 'azurebasic' ), max( $paged, $page ) );

	?>
</title>


<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php /* IE7 specific styles */ ?>
<!--[if IE 7]>
      <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/ie7.css" type="text/css" media="screen" />
<![endif]-->

<?php wp_enqueue_script("jquery"); /* Loads jQuery if it hasn't been loaded already */ ?>

<?php /* The HTML5 Shim is required for older browsers, mainly older versions IE */ ?>
<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<?php

	// Add some JavaScript to pages with the comment form to support sites with threaded comments (when in use).

	if ( is_singular() && get_option( 'thread_comments' ) )

		wp_enqueue_script( 'comment-reply' );

?>

<?php wp_head(); ?> <?php /* this is used by many Wordpress features and for plugins to work proporly */ ?>
  <link rel="stylesheet" type="text/css" media="all" href="<?php echo get_site_url(); ?>/wp-content/themes/azure-basic/style-responsive.css" />
  <?php if (!is_front_page()) { ?>
    <link rel="stylesheet" type="text/css" media="all" href="<?php echo get_site_url(); ?>/wp-content/themes/azure-basic/style-page-responsive.css" />
  <?php } ?>
</head>

<body <?php body_class(); ?>>

<div id="wrap" class="clearfix"><!-- this encompasses the entire Web site except the footer and copyright -->

 

  <header class="clearfix" id="top-header">
   <div class="headerinner">
	 <div class="logo"><a href="<?php echo get_site_url(); ?>"><img src="<?php echo get_site_url(); ?>/wp-content/uploads/2016/05/logo.png" alt="" /></a></div>
     <div class="headernav">
	<nav id="access" role="navigation" class="clearfix">
			 
		<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>

	</nav><!-- #access -->
    
    <div id="phoneaccount-header-section" class="clearfix">
     
     <div id="phoneaccount-sidebar-section" class="clearfix">
       <?php if ( ! dynamic_sidebar( 'Header' ) ) : ?><!-- Wigitized Header --><?php endif ?>
    </div><!-- #phoneaccount-sidebar-section -->
    
    </div><!--phoneaccount-header-section-->
	 </div>
	</div>
    <div class="clear"></div><!-- .clear the floats -->
     
    <div id="header-image" class="clearfix">
		    <?php if ( ! dynamic_sidebar( 'Header Slider' ) ) : ?><!-- Wigitized Header Slider --><?php endif ?>
	</div><!--#header-image-->
     
  </header>
  
  
  <div class="clear"></div><!-- .clear the floats -->
  
  <div class="container" id="container-full">
  <div id="main" class="clearfix">