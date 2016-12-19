<?php

//The Template for displaying all single posts.


get_header(); ?>



		<div id="primary" class="clearfix">

			<div id="content" role="main" class="clearfix">


				<?php while ( have_posts() ) : the_post(); ?>



					<?php get_template_part( 'content', 'single' ); ?>



					<?php comments_template( '', true ); ?>
                    
                    
                    <nav id="nav-single" class="clearfix">

						<h4 class="assistive-text"><?php _e( 'Post Navigation', 'azurebasic' ); ?></h4>
                        
                        <span class="nav-next"><?php next_post_link( '%link', __( '<span class="meta-nav">&larr;</span> Next', 'azurebasic' ) ); ?></span>

						<span class="nav-previous"><?php previous_post_link( '%link', __( 'Previous <span class="meta-nav">&rarr;</span>', 'azurebasic' ) ); ?></span>

					</nav><!-- #nav-single -->



				<?php endwhile; // end of the loop. ?>



			</div><!-- #content -->

		</div><!-- #primary -->


<?php get_sidebar(); ?>

<div class="clear"></div><!-- .clear the floats -->

<?php get_footer(); ?>