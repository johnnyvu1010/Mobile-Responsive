<?php /*
Template Name: Best IVF Deals 
*/

get_header(); ?>
 
<?php  
 $treatmentvar=trim($_REQUEST['treatment']);
 $zipcode=trim($_REQUEST['zipcode']);
 $formsub=trim($_REQUEST['formsub']);
 $newsearch=trim($_REQUEST['newsearch']);


 
if (empty($formsub)) { 
/* STATIC CONTENT */
  $distance = 50;
  $zipcode = "90001"; 
} else {
   $distance = 50;
}
?>

		<div id="primary" class="clearfix">

			<div id="content" role="main" class="clearfix">
			  
	 
<?php
       // Define database connection constants
     $db_host = "g5213474106776.db.3474106.hostedresource.com";
     $db_username = "g5213474106776";
     $db_pass = "xrsmIdN{vLv7"; 
     $dbc = mysqli_connect("$db_host", "$db_username", "$db_pass", "g5213474106776", "3311") or die ("could not connect to mysql"); 
 
 
       //Find Out The Longitude & Latitude of Zipcode in existing database
       $zcquery = "SELECT * FROM wp_nava5jxxyp_zipcodes WHERE zipcode = $zipcode";
        $result = mysqli_query($dbc, $zcquery);
        $row = mysqli_fetch_array($result);
 
         $lat = $row['latitude'];
	     $long = $row['longitude'];   
 
	     

	     /* NEW QUERY - FIND ZIP CODES OF ALL SURROUNDING AREAS */

	     /* MILES = 69 miles per 1 degree ( 1 / 69 equals distance per mile ) */
	     if ($distance == 50) {
	     $miles = 0.7246376811594203; //50 miles
	     }
	     if ($distance == 45) {
	     $miles  = 0.6521739130434783; //45 miles
	       }
	     if ($distance == 40) {
	     $miles  = 0.5797101449275362; //40 miles
	       }
	     if ($distance == 35) {
	     $miles  = 0.5072463768115942; //35 miles
	       }
	     if ($distance == 30) {
	     $miles  = 0.4347826086956522; //30 miles
  	     }
	     if ($distance == 25) {
	     $miles  = 0.3623188405797101; //25 miles
	       }
	     if ($distance == 20) {
	     $miles  = 0.2898550724637681; //20 miles
  	     }
	     if ($distance == 15) {
	     $miles  = 0.2173913043478261; //15 miles
  	     }
	     if ($distance == 10) {
	     $miles  = 0.1449275362318841; //10 miles
	     }
 
	   /* Query To Search for all of the Zip Codes within the range */
       $query = 'SELECT zipcode from wp_nava5jxxyp_zipcodes
       WHERE latitude between ' . $lat . ' - ' . $miles . ' and ' . $lat . ' + ' . $miles . '
       and longitude between ' . $long . ' - ' . $miles . ' and ' . $long . ' + ' . $miles;
       $result = mysqli_query($dbc, $query);  
  
   
       $variabele = array();
       while($row = mysqli_fetch_array($result))
       {
       if($row['zipcode'] != '')
        $variabele[] = $row['zipcode'];
       }
       $zipcodelist =  implode(', ', $variabele); 
      
	   mysqli_close($dbc); 
   
     /* Query to Get Clinics by Zip Code */
    $args = array(   
	'posts_per_page' => 999,
	'orderby'          => 'post_title',
	'order'            => 'DESC', 
	'post_type' => 'clinics',
	   'meta_query' => array (
		    array (
			  'key' => 'cliniczipcode',
			  'value' => $zipcodelist,
              'compare' => 'IN'
		    )
		  ) );
 
     $postlist = get_posts( $args );
 
    /* Get ID List of all Clinics */
    $posts = array(); 
     foreach ( $postlist as $post ) {
     $posts[] = $post->ID;     
		    }
  
     $idlist =  implode(', ', $posts);
        
    /* Query ALL Clinic Promos by ID's of clinics */
    $argstwo = array(  
	 'posts_per_page' => 10,
	'orderby'          => 'post_title',
	'order'            => 'DESC', 
	'post_type' => 'clinicpromos',
	   'meta_query' => array (
		    array (
			  'key' => 'assignclinic',
			  'value' => $idlist,
              'compare' => 'IN'
		    )
	 ) );
  
 
// the query
$the_query = new WP_Query( $argstwo ); 
   ?>
 <div class="page-entry-content clearfix">
   <div id="clinicresults">
	  
 <div id="LAStyle" class="clinic-row"> 
 <h1>This week's Best Deals</h1> 
   <ul class="cliniclist">
	 <?php if ( $the_query->have_posts() ) { ?>
 
	<!-- the loop -->
	<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
	 
	 
	<?php 
         $clinicid = get_custom_field('assignclinic'); // This is the ID of the clinic I am retrieving from ClinicPromos 

            //  Variables
            $clinictitle = get_the_title($clinicid);   
            $cliniccity = get_post_meta($clinicid,'cliniccity', true);  
            $clinicstate = get_post_meta($clinicid,'clinicstate', true);   
  

?>
 <li>
   <div class="clinic-column">
	  <div class="clinic-column-inner">
		   
		     <div class="fertblk"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a><p></p>
			   <div class="innerferttxt">
			     <h3><a href="<?php the_permalink(); ?>"><?php echo $clinictitle; ?></a></h3>
			    <span class="fertdesc"><?php the_excerpt(); ?></span><br />
				 <span class="fertloc"><?php echo $cliniccity; ?>, <?php echo $clinicstate; ?></span> 
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
           </div>
		    </div>
	    
   </div> 
   </div>
   </li>

     <?php endwhile; // end of the loop. ?>
	 <?php } else {  ?>
	 <p>Sorry, We can't find any deals in your area</p>
	 <?php } ?>
	 </ul> 
	</div>
	  <?php if ( ! dynamic_sidebar( 'Best IVF Widget' ) ) : ?><!--Wigitized Best IVF Widget--><?php endif ?>
    <?php if (is_front_page()) { ?>
   <?php wp_reset_postdata(); ?>
   	<?php while ( have_posts() ) : the_post(); ?>
   <?php the_content(); ?>
          <?php endwhile; // end of the loop. ?>
   <?php } ?>
 
	 </div><!-- page-entry-content-->
				 
			  </div><!--#ListView-->
		 
				
			</div><!-- #content -->

		</div><!-- #primary -->


<?php get_sidebar(); ?>

<div class="clear"></div><!-- .clear the floats -->

<?php get_footer(); ?>