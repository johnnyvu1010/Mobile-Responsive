<?php //The template for displaying all pages.  

get_header(); ?>
	 
		<div id="primary" class="clearfix">

			<div id="content" role="main" class="clearfix">


				<?php while ( have_posts() ) : the_post(); ?>
 
 <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php 
            //Get Assigned Clinic 
            $clinicid = get_custom_field('assignclinic'); // This is the ID of the clinic I am retrieving from ClinicPromos 

            //  Variables
            $clinictitle = get_the_title($clinicpost->ID);   
            $cliniccity = get_post_meta($clinicid,'cliniccity', true);  
            $clinicstate = get_post_meta($clinicid,'clinicstate', true);   
            $caddress = get_post_meta($clinicid,'clinicaddress', true);
            $csuiteapt = get_post_meta($clinicid,'clinicsuiteapt', true);
            $ccity = get_post_meta($clinicid,'cliniccity', true);
            $cstate = get_post_meta($clinicid,'clinicstate', true);
            $czipcode = get_post_meta($clinicid,'cliniczipcode', true);
            $cemail = get_post_meta($clinicid,'clinicemail', true);
            $cwebsite = get_post_meta($clinicid,'clinicwebsite', true);
 $theid = get_the_ID(); 
 $category = get_the_category( $theid );
            $gmapaddress = $ctitle . ' '. $caddress . ' ' . $csuiteapt . ' ' . $ccity . ', ' . $cstate . ' ' . $czipcode;
	
            $cproductprice = get_custom_field('promoprice');
            $cproductsaleprice = get_custom_field('promosaleprice');
  
if (empty($cproductprice) && empty($cproductsaleprice)) {
  $productstatus = 0;
} else {
  $productstatus = 1;
}

/* Check if Sale Price is in Effect */
if (!empty($cproductsaleprice)) { 
  if (empty($cproductprice) && !empty($cproductsaleprice)) { 
  $limitedtime = 0;
  $savings = 0;
  $finalprice = number_format($cproductsaleprice);
  $originalprice = number_format($cproductsaleprice);
  } else {
  $limitedtime = 1;
  $savings = $cproductprice - $cproductsaleprice;
  $finalprice = $cproductprice - $savings;
  $gravformprice = $savings;
  $savings =  number_format($savings);
  $finalprice =  number_format($finalprice);
  $originalprice =  number_format($cproductprice);
  }
} else {
  $limitedtime = 0;
  $savings = 0;
  $finalprice = number_format($cproductprice);
  $originalprice = number_format($cproductprice);
}

 
?>
   <h1><?php the_title(); ?></h1>
   <div id="leftsingle">
	     <?php if ( has_post_thumbnail() ) { /* loades the post's featured thumbnail, requires Wordpress 3.0+ */ echo '<div class="leftsinglethumb"><div class="featured-thumb clearfix">'; the_post_thumbnail(); echo '</div></div>'; } ?>
	
	     <div class="leftsinglecontent"><?php the_content(); ?>
	  <div class="righttreatmentbox">
	   <h3>Treatment Package Includes:</h3>
	   <div class="rtreatcont"> <?php $treatmentstatus = get_custom_field('promopackageincludes'); 
if (empty($treatmentstatus)) {
  echo '<p>No Treatment Package Listed</p>';
} else {
   echo '<ul>';
  $promopack = get_custom_field('promopackageincludes');
    
foreach ($promopack as $promoitem) {
  echo '<li>' . $promoitem . '</li>';
}
  echo '</ul>';
}
	 ?>
	     </div><!--END rtreatcont-->
	 </div><!--END righttreatmentbox-->
	 </div><!--END leftsinglecontent-->
	 <div class="locationinfo">      <span class="fertloc"><?php echo $caddress;  ?>, <?php echo $ccity;  ?>, <?php echo $cstate;  ?> <?php echo $czipcode;  ?></span> 
			  <span class="fertdesc"><?php echo $cphone;  ?></span><br />
			  <span class="fertdesc"><a href="<?php echo $cwebsite; ?>" target="_blank">Visit Website</a></span> <br />
	 <h5>Map & Location</h5></div>
	     <div class="singlegmap"><?php echo do_shortcode('[su_gmap width="640" height="500" address="' . $gmapaddress . '" class="singlemap"]'); ?></div><!--END singlegmap-->
   </div><!--LeftSingle-->		 
 
   <div id="rightsingle">
	    <div id="LAStyle">
	   <?php 
                 $cproductprice = get_custom_field('promoprice');
                 $cproductsaleprice = get_custom_field('promosaleprice');
                 $theid = get_the_ID();
				  	
			 	 $category = get_the_category( $theid );
											
                if (empty($cproductprice) && empty($cproductsaleprice)) {
                 $productstatus = 0;
               } else {
                 $productstatus = 1;
               }
               ?>
			 <?php if (!empty($cproductprice) && !empty($cproductsaleprice)) { ?>
			 <div class="fertpricediv">
                    <ul>
                       <li>$<?php echo number_format($cproductsaleprice); ?></li> 
					  <li><?php //the_title(); ?><?php echo $category[0]->cat_name; ?></li>
                    </ul>
                </div>
			 <?php } ?>
				 <?php if (empty($cproductprice) && !empty($cproductsaleprice)) { ?>
			 <div class="fertpricediv">
                    <ul>
                       <li>$<?php echo number_format($cproductsaleprice); ?></li> 
					  <li><?php //the_title(); ?><?php echo $category[0]->cat_name; ?></li>
                    </ul>
                </div>
			 <?php } ?>
				 			 <?php if (!empty($cproductprice) && empty($cproductsaleprice)) { ?>
			 <div class="fertpricediv">
                    <ul>
                       <li>$<?php echo number_format($cproductprice); ?></li> 
					  <li><?php //the_title(); ?><?php echo $category[0]->cat_name; ?></li>
                    </ul>
                </div>
			 <?php } ?>
	 </div><!--LAStyle-->
	 <div id="nameadd">
	   <div class="locationinfo"> <span class="fertlocbreak"><?php echo $clinictitle; ?></span>
		 <span class="fertlocbreak lightxt"><?php echo $caddress;  ?></span>
		 <span class="fertlocbreak lightxt"><?php echo $ccity;  ?> <?php echo $cstate;  ?> <?php echo $czipcode;  ?></span> 
		  <span class="fertdesc"><?php echo $cphone;  ?></span><br />
			  <span class="fertdesc"><a href="<?php echo $cwebsite; ?>" target="_blank">Visit Website</a></span> <br />
		 <div class="schedbut"><div class="schedbutinner"><?php if ( ! dynamic_sidebar( 'Appointment Schedule' ) ) : ?><!--Wigitized Appointment Schedule--><?php endif ?>
		   
		    
		   <div id="setapform" class="setappoint"><div class="setappointinner"><h1>Set An Appointment</h1>
			<?php echo do_shortcode('[gravityform id="10" title="false" description="false" ajax="true" tabindex="888" field_values="clinicemail=' . $cemail . '"]'); ?></div></div>

		   
		   <div class="babystep"><span><?php if ( ! dynamic_sidebar( 'Widgets to Shortcode' ) ) : ?><!--Wigitized Widgets to Shortcode--><?php endif ?></span></div></div></div>
	 </div>
	      
	 </div><!--NameAdd-->
   </div><!--#RightSingle-->

	</article><!-- #post-<?php the_ID(); ?> -->

				<?php endwhile; // end of the loop. ?>

 

			</div><!-- #content -->

		</div><!-- #primary -->


<?php get_sidebar(); ?>

<div class="clear"></div><!-- .clear the floats -->

<?php get_footer(); ?>