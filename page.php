<?php //The template for displaying all pages.  

get_header(); ?>


		<div id="primary" class="clearfix">

			<div id="content" role="main" class="clearfix">


				<?php while ( have_posts() ) : the_post(); ?>



					<?php get_template_part( 'content', 'page' ); ?>



					<?php comments_template( '', true ); ?>



				<?php endwhile; // end of the loop. ?>



			</div><!-- #content -->

		</div><!-- #primary -->


<?php get_sidebar(); ?>

<div class="clear"></div><!-- .clear the floats -->

<?php get_footer(); ?>