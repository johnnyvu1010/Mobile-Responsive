<?php

//The template used for displaying page content in page.php


?>


<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<div class="clear"></div><!-- .clear all the floats -->

   <?php if ( has_post_thumbnail() ) { /* loades the post's featured thumbnail, requires Wordpress 3.0+ */ echo '<div class="featured-thumb clearfix">'; the_post_thumbnail(); echo '</div>'; } ?>
   
   <div class="clear"></div><!-- .clear all the floats -->

	<div class="page-entry-content clearfix">

		<?php the_content(); ?>
        
        <div class="clear"></div><!-- .clear all the floats -->

		<?php wp_link_pages( array( 'before' => '<div class="page-link" clearfix><span>' . __( 'Pages:', 'azurebasic' ) . '</span>', 'after' => '</div>' ) ); ?>
        
	</div><!-- .entry-content -->
    
<div class="clear"></div><!-- .clear all the floats -->
  

</article><!-- #post-<?php the_ID(); ?> -->

<div class="clear"></div><!-- .clear all the floats -->