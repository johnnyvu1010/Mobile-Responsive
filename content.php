<?php //The default template for displaying content ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
       <?php if ( has_post_thumbnail() ) { /* loades the post's featured thumbnail, requires Wordpress 3.0+ */ echo '<div class="featured-thumb clearfix">'; the_post_thumbnail(); echo '</div>'; } ?>
       
       <div class="clear"></div><!-- .clear all the floats -->

		<header class="blog-entry-header clearfix">

			<?php if ( is_sticky() ) : ?>

				<hgroup>

					<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'azurebasic' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

					<h3 class="entry-format"><?php _e( 'Featured', 'azurebasic' ); ?></h3>

				</hgroup>

			<?php else : ?>

			<h1 class="blog-entry-title clearfix"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'azurebasic' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

			<?php endif; ?>



			<?php if ( 'post' == get_post_type() ) : ?>

			<div class="entry-meta clearfix">

				<?php azurebasic_posted_on(); ?>

			</div><!-- .entry-meta -->

			<?php endif; ?>


		</header><!-- .entry-header -->

<div class="clear"></div><!-- .clear all the floats -->

		<?php if ( is_search() ) : // Only display Excerpts for Search ?>

		<div class="entry-summary clearfix">

			<?php the_excerpt(); ?>

		</div><!-- .entry-summary -->

		<?php else : ?>

		<div class="entry-content clearfix">

			<?php the_content( __( 'Continue Reading <span class="meta-nav">&rarr;</span>', 'azurebasic' ) ); ?>
            
            <div class="clear"></div><!-- .clear all the floats -->

			<?php wp_link_pages( array( 'before' => '<div class="page-link clearfix"><span>' . __( 'Pages:', 'azurebasic' ) . '</span>', 'after' => '</div>' ) ); ?>

		</div><!-- .entry-content -->

		<?php endif; ?>
        
<div class="clear"></div><!-- .clear all the floats -->

		<footer class="entry-meta clearfix">

			<?php $show_sep = false; ?>

			<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>

			<?php

				/* translators: used between list items, there is a space after the comma */

				$categories_list = get_the_category_list( __( ', ', 'azurebasic' ) );

				if ( $categories_list ):

			?>

			<span class="cat-links">

				<?php printf( __( '<span class="%1$s">Posted in</span> %2$s', 'azurebasic' ), 'entry-utility-prep entry-utility-prep-cat-links', $categories_list );

				$show_sep = true; ?>

			</span>

			<?php endif; // End if categories ?>

			<?php

				/* translators: used between list items, there is a space after the comma */

				$tags_list = get_the_tag_list( '', __( ', ', 'azurebasic' ) );

				if ( $tags_list ):

				if ( $show_sep ) : ?>

			<span class="sep"> | </span>

				<?php endif; // End if $show_sep ?>

			<span class="tag-links">

				<?php printf( __( '<span class="%1$s">Tagged</span> %2$s', 'azurebasic' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list );

				$show_sep = true; ?>

			</span>

			<?php endif; // End if $tags_list ?>

			<?php endif; // End if 'post' == get_post_type() ?>



			<?php if ( comments_open() ) : ?>

			<?php if ( $show_sep ) : ?>

			<span class="sep"> | </span>

			<?php endif; // End if $show_sep ?>

			<span class="comments-link"><?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a reply', 'azurebasic' ) . '</span>', __( '<b>1</b> Reply', 'azurebasic' ), __( '<b>%</b> Replies', 'azurebasic' ) ); ?></span>

			<?php endif; // End if comments_open() ?>



			<?php edit_post_link( __( 'Edit', 'azurebasic' ), '<span class="edit-link">', '</span>' ); ?>

		</footer><!-- #entry-meta -->

	</article><!-- #post-<?php the_ID(); ?> -->

<div class="clear"></div><!-- .clear all the floats -->