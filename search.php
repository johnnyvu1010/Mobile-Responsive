<?php

//The template for displaying Search Results pages.


get_header(); ?>


		<section id="primary">

			<div id="content" role="main">



			<?php if ( have_posts() ) : ?>



				<header class="page-header">

					<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'azurebasic' ), '<span>' . get_search_query() . '</span>' ); ?></h1>

				</header>


				<?php /* Start the Loop */ ?>

				<?php while ( have_posts() ) : the_post(); ?>



					<?php

						// Include the Post-Format-specific template for the content.


						get_template_part( 'content', get_post_format() );

					?>



				<?php endwhile; ?>



				<?php azurebasic_content_nav( 'nav-below' ); ?>



			<?php else : ?>



				<article id="post-0" class="post no-results not-found">

					<header class="entry-header">

						<h1 class="entry-title"><?php _e( 'Nothing Found', 'azurebasic' ); ?></h1>

					</header><!-- .entry-header -->



					<div class="entry-content">

						<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'azurebasic' ); ?></p>

						<?php get_search_form(); ?>

					</div><!-- .entry-content -->

				</article><!-- #post-0 -->



			<?php endif; ?>



			</div><!-- #content -->

		</section><!-- #primary -->



<?php get_sidebar(); ?>

<div class="clear"></div><!-- .clear the floats -->

<?php get_footer(); ?>