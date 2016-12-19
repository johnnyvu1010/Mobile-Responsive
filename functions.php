<?php

//Azure Basic functions and definitions

// Version 2.6
 
 

// Set the content width based on the theme's design and stylesheet.

if ( ! isset( $content_width ) )

	$content_width = 680;


//Tell WordPress to run azurebasic_setup() when the 'after_setup_theme' hook is run.

add_action( 'after_setup_theme', 'azurebasic_setup' );


if ( ! function_exists( 'azurebasic_setup' ) ):

//Sets up theme defaults and registers support for various WordPress features.


function azurebasic_setup() {

    // Make Azure Basic available for translation.


	load_theme_textdomain( 'azurebasic', get_template_directory() . '/languages' );


	$locale = get_locale();

	$locale_file = get_template_directory() . "/languages/$locale.php";

	if ( is_readable( $locale_file ) )

		require_once( $locale_file );


	// Add default posts and comments RSS feed links to <head>.
	add_theme_support( 'automatic-feed-links' );



	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Primary Menu', 'azurebasic' ) );



	// Add support for a variety of post formats
	add_theme_support( 'post-formats', array( 'aside', 'gallery','link','image','quote','status','video','audio','chat' ) );



	// Add support for custom backgrounds
	add_theme_support( 'custom-background' );
	
	
	// This theme styles the visual editor with an editor-style.css file to match the theme style.
	add_editor_style();



	// This theme uses Featured Images (also known as post thumbnails) for per-post/per-page Custom Header images
	add_theme_support( 'post-thumbnails' );


}

endif; // azurebasic_setup


    // custom header image support
	define('HEADER_TEXTCOLOR', '');
    define('NO_HEADER_TEXT', true );
	define('HEADER_IMAGE', '%s/images/undersea.png'); // %s is the template dir uri
	define('HEADER_IMAGE_WIDTH', 986); // use width and height appropriate for your theme
	define('HEADER_IMAGE_HEIGHT', 300);
	// gets included in the admin header
	function admin_header_style() {
	    ?><style type="text/css">
	        #headimg {
	            width: <?php echo HEADER_IMAGE_WIDTH; ?>px;
	            height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
	        }
	    </style><?php
	}
	add_theme_support( 'custom-header' );
	
	
//Sets the post excerpt length to 40 words.


function azurebasic_excerpt_length( $length ) {

	return 40;

}

add_filter( 'excerpt_length', 'azurebasic_excerpt_length' );




//Returns a "Read More" link for excerpts
function azurebasic_continue_reading_link() {

	return ' <a href="'. esc_url( get_permalink() ) . '">' . __( 'Read More <span class="meta-nav">&rarr;</span>', 'azurebasic' ) . '</a>';

}




//Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and azurebasic_continue_reading_link().


function azurebasic_auto_excerpt_more( $more ) {

	return ' &hellip;' . azurebasic_continue_reading_link();

}

add_filter( 'excerpt_more', 'azurebasic_auto_excerpt_more' );





//Adds a nice "Read More" link to custom post excerpts.


function azurebasic_custom_excerpt_more( $output ) {

	if ( has_excerpt() && ! is_attachment() ) {

		$output .= azurebasic_continue_reading_link();

	}

	return $output;

}

add_filter( 'get_the_excerpt', 'azurebasic_custom_excerpt_more' );


//Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.

function azurebasic_page_menu_args( $args ) {

	$args['show_home'] = true;

	return $args;

}

add_filter( 'wp_page_menu_args', 'azurebasic_page_menu_args' );

add_filter( 'gform_confirmation_8', 'prosper_custom_confirmation', 10, 4 );

function prosper_custom_confirmation( $confirmation, $form, $entry, $ajax ) {
	//Prosper Loan application.  The default gravityforms redirect does not handle the # and will not go to the correct link.  Had to move it here. -GA 8/23/16
	
  	$confirmation = array('redirect'=>'https://www.prosper.com/borrower/#/prospect/registration?loan_amount='.rgar($entry, '1').'&listing_category_id=15&credit_quality_id=1&ref_ac=onefertility&ref_mc=onefertility&ref_d='.$entry['id']);
    return $confirmation;
}

add_action( 'gform_pre_submission_5', 'form_process_loansource', 10, 2 );
function form_process_loansource( $form ) {
	
	$inLendingpointState = rgpost('input_46');
	$credit = rgpost('input_37');

   if($inLendingpointState == "1" && $credit == 'Fair'){
   //use lendingpoint	
  	$_POST['input_49'] = "lendingpoint.com";
  	} else if ($credit == 'Fair'){
  		//user personalloans
  		$_POST['input_49'] = "personalloans.com";
  	}
}

add_action( 'gform_pre_submission_7', 'assessment_form_process_loansource', 10, 2 );
function assessment_form_process_loansource( $form ) {
	
	$state = rgpost('input_6');
	$credit = rgpost('input_5');
	$lendingpoint_states = array(
		'Georgia',
		'Montana',
		'Michigan',
		'Ohio',
		'Missouri',
		'Washington',
		'Utah',
		'Alabama',
		'South Dakota',
		'California',
		'New Mexico',
		'Oregon',
	);
	$lendingpoint_credits = array(
		'Good',
		'Fair',
	);
	$prosper_credits = array(
		'Excellent',
		'Good',
	);
	
   if(in_array($state, $lendingpoint_states) && in_array($credit, $lendingpoint_credits)){
   //use lendingpoint	
  		$_POST['input_7'] = "lendingpoint.com";
  	} else if(in_array($credit, $prosper_credits)){
  		$_POST['input_7'] = "prosper";
  	} else {
  		//user personalloans
  		$_POST['input_7'] = "personalloans.com";
  	}
}

//Register our sidebars and widgetized areas. 

function azurebasic_widgets_init() {
	
	// Sidebar Widget
	// Location: the sidebar
	register_sidebar(array(
	    'name'=>__('Sidebar', 'azurebasic'),
		'before_widget' => '<aside class="widget-area widget-sidebar">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 id="sidebar-widget-title">',
		'after_title' => '</h3>',
	));
	// Header Widget
	// Location: right after the navigation
	register_sidebar(array(
	    'name'=>__('Header', 'azurebasic'),
		'before_widget' => '<div class="widget-area widget-header">',
		'after_widget' => '</div>',
		'before_title' => '<h4 id="header-widget-title">',
		'after_title' => '</h4>',
	));
  	// Header Slider Widget
	// Location: at the top of the footer, above the copyright
	register_sidebar(array(
	    'name'=>__('Header Slider', 'azurebasic'),
		'before_widget' => '<div class="widget-area widget-header-slider">',
		'after_widget' => '</div>',
		'before_title' => '<h4 id="header-slider-widget-title">',
		'after_title' => '</h4>',
	));
	// Footer One Widget
	// Location: at the top of the footer, above the copyright
	register_sidebar(array(
	    'name'=>__('Footer One', 'azurebasic'),
		'before_widget' => '<div class="widget-area widget-footer-one">',
		'after_widget' => '</div>',
		'before_title' => '<h4 id="footer-one-widget-title">',
		'after_title' => '</h4>',
	));
	// Footer Two Widget
	// Location: at the top of the footer, above the copyright
	register_sidebar(array(
	    'name'=>__('Footer Two', 'azurebasic'),
		'before_widget' => '<div class="widget-area widget-footer-two">',
		'after_widget' => '</div>',
		'before_title' => '<h4 id="footer-two-widget-title">',
		'after_title' => '</h4>',
	));
	// Footer Three Widget
	// Location: at the top of the footer, above the copyright
	register_sidebar(array(
	    'name'=>__('Footer Three', 'azurebasic'),
		'before_widget' => '<div class="widget-area widget-footer-three">',
		'after_widget' => '</div>',
		'before_title' => '<h4 id="footer-three-widget-title">',
		'after_title' => '</h4>',
	));
	// Footer Four Widget
	// Location: at the top of the footer, above the copyright
	register_sidebar(array(
	    'name'=>__('Footer Four', 'azurebasic'),
		'before_widget' => '<div class="widget-area widget-footer-four">',
		'after_widget' => '</div>',
		'before_title' => '<h4 id="footer-four-widget-title">',
		'after_title' => '</h4>',
	));
	// Widgets to Shortcode Widget
	// Location: at the top of the footer, above the copyright
	register_sidebar(array(
	    'name'=>__('Widgets to Shortcode', 'azurebasic'),
		'before_widget' => '<div class="widget-area widget-to-shortcode">',
		'after_widget' => '</div>',
		'before_title' => '<h4 id="widget-to-shortcode-widget-title">',
		'after_title' => '</h4>',
	));
  	// Disclaimer Widget
	// Location: at the top of the footer, above the copyright
	register_sidebar(array(
	    'name'=>__('Disclaimer', 'azurebasic'),
		'before_widget' => '<div class="widget-area disclaimer-widget">',
		'after_widget' => '</div>',
		'before_title' => '<h4 id="disclaimer-widget-title">',
		'after_title' => '</h4>',
	));
    // Best IVF Widget
	// Location: at the top of the footer, above the copyright
	register_sidebar(array(
	    'name'=>__('Best IVF Widget', 'azurebasic'),
		'before_widget' => '<div class="widget-area best-ivf-widget">',
		'after_widget' => '</div>',
		'before_title' => '<h4 id="best-ivf-widget-title">',
		'after_title' => '</h4>',
	));
     // Appointment Schedule
	// Location: at the top of the footer, above the copyright
	register_sidebar(array(
	    'name'=>__('Appointment Schedule', 'azurebasic'),
		'before_widget' => '<div class="widget-area appoint-schedule-widget">',
		'after_widget' => '</div>',
		'before_title' => '<h4 id="appoint-schedule-widget-title">',
		'after_title' => '</h4>',
	));
}

add_action( 'widgets_init', 'azurebasic_widgets_init' );



if ( ! function_exists( 'azurebasic_content_nav' ) ) :

//Display navigation to next/previous pages when applicable

function azurebasic_content_nav( $nav_id ) {

	global $wp_query;

	if ( $wp_query->max_num_pages > 1 ) : ?>

		<nav class="clearfix" id="<?php echo $nav_id; ?>">

			<h4 class="assistive-text"><?php _e( 'Post Navigation', 'azurebasic' ); ?></h4>
            
            <div class="nav-next"><?php previous_posts_link( __( '<span class="meta-nav">&larr;</span> Newer posts', 'azurebasic' ) ); ?></div>

			<div class="nav-previous"><?php next_posts_link( __( 'Older posts <span class="meta-nav">&rarr;</span>', 'azurebasic' ) ); ?></div>

		</nav><!-- #nav-below -->

	<?php endif;

}

endif; // azurebasic_content_nav



/// Return the URL for the first link found in the post content.

function azurebasic_url_grabber() {

	if ( ! preg_match( '/<a\s[^>]*?href=[\'"](.+?)[\'"]/is', get_the_content(), $matches ) )

		return false;

	return esc_url_raw( $matches[1] );

}


if ( ! function_exists( 'azurebasic_comment' ) ) :

///Template for comments and pingbacks.

//Used as a callback by wp_list_comments() for displaying the comments.


function azurebasic_comment( $comment, $args, $depth ) {

	$GLOBALS['comment'] = $comment;

	switch ( $comment->comment_type ) :

		case 'pingback' :

		case 'trackback' :

	?>

	<li class="post pingback clearfix">

		<p><?php _e( 'Pingback:', 'azurebasic' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'azurebasic' ), '<span class="edit-link">', '</span>' ); ?></p>

	<?php

			break;

		default :

	?>

	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">

		<article id="comment-<?php comment_ID(); ?>" class="comment">

			<footer class="comment-meta clearfix">

				<div class="comment-author vcard">

					<?php

						$avatar_size = 68;

						if ( '0' != $comment->comment_parent )

							$avatar_size = 39;



						echo get_avatar( $comment, $avatar_size );



						/* translators: 1: comment author, 2: date and time */

						printf( __( '%1$s on %2$s <span class="says">said:</span>', 'azurebasic' ),

							sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),

							sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',

								esc_url( get_comment_link( $comment->comment_ID ) ),

								get_comment_time( 'c' ),

								/* translators: 1: date, 2: time */

								sprintf( __( '%1$s at %2$s', 'azurebasic' ), get_comment_date(), get_comment_time() )

							)

						);

					?>



					<?php edit_comment_link( __( 'Edit', 'azurebasic' ), '<span class="edit-link">', '</span>' ); ?>

				</div><!-- .comment-author .vcard -->



				<?php if ( $comment->comment_approved == '0' ) : ?>

					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'azurebasic' ); ?></em>


					<br />

				<?php endif; ?>



			</footer>



			<div class="comment-content clearfix"><?php comment_text(); ?></div>



			<div class="reply">

				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', 'azurebasic' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>

			</div><!-- .reply -->

		</article><!-- #comment-## -->



	<?php

			break;

	endswitch;

}

endif; // ends check for azurebasic_comment()



if ( ! function_exists( 'azurebasic_posted_on' ) ) :

//Prints HTML with meta information for the current post-date/time and author.

function azurebasic_posted_on() {

	printf( __( '<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="by-author"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'azurebasic' ),

		esc_url( get_permalink() ),

		esc_attr( get_the_time() ),

		esc_attr( get_the_date( 'c' ) ),

		esc_html( get_the_date() ),

		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),

		esc_attr( sprintf( __( 'View all posts by %s', 'azurebasic' ), get_the_author() ) ),

		get_the_author()

	);

}

endif;

	