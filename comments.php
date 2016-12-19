<?php //The template for displaying Comments. ?>


	<div id="comments" class="clearfix">

	<?php if ( post_password_required() ) : ?>

		<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'azurebasic' ); ?></p>

	</div><!-- #comments -->

	<?php

       // Stops the rest of comments.php from being processed, but dosen't kill the script entirely -- fullys load the template first.

			return;

		endif;

	?>



	<?php // You can start editing here -- including this comment! ?>



	<?php if ( have_comments() ) : ?>

		<h2 id="comments-title" class="clearfix">

			<?php

				printf( _n( 'One comment on &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;', get_comments_number(), 'azurebasic' ),

					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );

			?>

		</h2>



		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>

		<nav id="comment-nav-above" class="clearfix">

			<h4 class="assistive-text"><?php _e( 'Comment Navigation', 'azurebasic' ); ?></h4>
            
            <div class="nav-next"><?php next_comments_link( __( '&larr; Newer Comments' , 'azurebasic' ) ); ?></div>

			<div class="nav-previous"><?php previous_comments_link( __( 'Older Comments &rarr;', 'azurebasic' ) ); ?></div>			

		</nav>

		<?php endif; // check for comment navigation ?>



		<ol class="commentlist clearfix">

			<?php


				wp_list_comments( array( 'callback' => 'azurebasic_comment' ) );

			?>

		</ol>



		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>

		<nav id="comment-nav-below" class="clearfix">

			<h4 class="assistive-text"><?php _e( 'Comment Navigation', 'azurebasic' ); ?></h4>

			<div class="nav-previous"><?php previous_comments_link( __( 'Older Comments &rarr;', 'azurebasic' ) ); ?></div>

			<div class="nav-next"><?php next_comments_link( __( '&larr; Newer Comments', 'azurebasic' ) ); ?></div>

		</nav>

		<?php endif; // check for comment navigation ?>



	<?php


		elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) :

	?>

		<p class="nocomments"><?php _e( 'Comments are closed.', 'azurebasic' ); ?></p>

	<?php endif; ?>



	<?php comment_form(); ?>



</div><!-- #comments -->

