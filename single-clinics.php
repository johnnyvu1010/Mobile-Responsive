<?php //The template for displaying all pages.  

get_header(); ?>

<?php 
  $ctitle = get_the_title();
  $caddress = get_custom_field('clinicaddress');
  $csuiteapt = get_custom_field('clinicsuiteapt');
  $ccity = get_custom_field('cliniccity');
  $cstate = get_custom_field('clinicstate');
  $czipcode = get_custom_field('cliniczipcode');
  $cemail = get_custom_field('clinicemail');

  $gmapaddress = $ctitle . ' '. $caddress . ' ' . $csuiteapt . ' ' . $ccity . ', ' . $cstate . ' ' . $czipcode;
	
  $cproductprice = get_custom_field('productprice');
  $cproductsaleprice = get_custom_field('productsaleprice');
  
if (empty($cproductprice) && empty($cproductsaleprice)) {
  $productstatus = 0;
} else {
  $productstatus = 1;
}

/* Check if Sale Price is in Effect */
if (!empty($cproductsaleprice)) { 
  $limitedtime = 1;
  $savings = $cproductprice - $cproductsaleprice;
  $finalprice = $cproductprice - $savings;
  $gravformprice = $savings;
  $savings =  number_format($savings);
  $finalprice =  number_format($finalprice);
  //$originalprice =  number_format($cproductprice);
} else {
  $limitedtime = 0;
  $savings = 0;
  $finalprice = number_format($cproductprice);
  $originalprice = number_format($cproductprice);
}

 
?>
		<div id="primary" class="clearfix">

			<div id="content" role="main" class="clearfix">


				<?php while ( have_posts() ) : the_post(); ?>
 
 <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

   <h1><?php the_title(); ?></h1>
   <div id="leftsingle">
	     <?php if ( has_post_thumbnail() ) { /* loades the post's featured thumbnail, requires Wordpress 3.0+ */ echo '<div class="leftsinglethumb"><div class="featured-thumb clearfix">'; the_post_thumbnail(); echo '</div></div>'; } ?>
	
	     <div class="leftsinglecontent"><?php the_content(); ?></div><!--END leftsinglecontent-->
	 <div class="locationinfo">      <span class="fertloc"><?php print_custom_field('clinicaddress'); ?>, <?php print_custom_field('cliniccity'); ?>, <?php print_custom_field('clinicstate'); ?> <?php print_custom_field('cliniczipcode'); ?></span> 
			  <span class="fertdesc"><?php print_custom_field('clinicphone'); ?></span><br />
			  <span class="fertdesc"><a href="<?php print_custom_field('clinicwebsite'); ?>" target="_blank">Visit Website</a></span> <br />
	 <h5>Map & Location</h5></div>
	     <div class="singlegmap"><?php echo do_shortcode('[su_gmap width="640" height="500" address="' . $gmapaddress . '" class="singlemap"]'); ?></div><!--END singlegmap-->
   </div><!--LeftSingle-->		 
 
   

	</article><!-- #post-<?php the_ID(); ?> -->

				<?php endwhile; // end of the loop. ?>

 

			</div><!-- #content -->

		</div><!-- #primary -->


<?php get_sidebar(); ?>

<div class="clear"></div><!-- .clear the floats -->

<?php get_footer(); ?>