<?php /*
Template Name: Full Width
*/

get_header(); ?>

<?php 
   $showform=trim($_REQUEST['showform']);
 
?>
<?php if (is_page('financing')) { ?>
<?php if (!empty($showform)) { } else { ?>
<div id="overlaytrans"></div>
<div id="showformdiv">
  <div class="showforminner"><div class="showformcontent"><?php echo do_shortcode('[gravityform id="4" title="false" description="false" tabindex="888"]'); ?></div></div> 
</div><!--ShowformDiv-->

<?php } ?>
<?php } ?>
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