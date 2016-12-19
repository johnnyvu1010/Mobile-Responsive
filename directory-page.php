<?php /*
Template Name: Directory

*/

get_header(); ?>
<?php
  $distance=trim($_REQUEST['distance']);
  $treatment=trim($_REQUEST['treatment']);
  $zipcode=trim($_REQUEST['zipcode']); 
 
  $distance = 50;  
?>

		<div id="primary" class="clearfix">

			<div id="content" role="main" class="clearfix">
			  
			  <?php if (!is_front_page()) { ?>
			  <div id="ListView" class="clearfix">
			  <?php } ?>
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

 if (is_front_page()) {    
    $args = array(
	'posts_per_page'   => 10,   
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
 } else {
     $args = array(
	'posts_per_page'   => 100,   
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
 }
// the query
$the_query = new WP_Query( $args ); 
   ?>
 <div class="page-entry-content clearfix">
   <div id="clinicresults">
	  
 <div id="LAStyle" class="clinic-row">
   <?php if (is_front_page()) { ?>
<h1 style="padding-left: 15px;">Los Angeles Fertility Clinics</h1>
   <?php } else { ?>   
 <h1>Fertility Clinics in Your Area</h1>
      <?php }  ?>   
   <ul class="cliniclist">
<?php if ( $the_query->have_posts() ) : ?>
 
	<!-- the loop -->
	<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
 <li>
   <div class="clinic-column">
	  <div class="clinic-column-inner">
		  
       <?php if (is_front_page()) { ?>
		 <div class="fertblk"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a><p></p>
			   <div class="innerferttxt">
			     <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			    <span class="fertdesc"><?php the_excerpt(); ?></span><br />
                <span class="fertloc"><?php print_custom_field('cliniccity'); ?>, <?php print_custom_field('clinicstate'); ?></span> 
             <?php 
								   /*$cproductprice = get_custom_field('productprice');
                 $cproductsaleprice = get_custom_field('productsaleprice');
  
                if (empty($cproductprice) && empty($cproductsaleprice)) {
                 $productstatus = 0;
               } else {
                 $productstatus = 1;
				 }*/
               ?>
			 <?php if ($productstatus == 1) { ?>
			 <div class="fertpricediv">
                    <ul>
                       <li>$<?php echo number_format($cproductprice); ?></li>
                       <li><?php print_custom_field('producttitle'); ?></li>
                    </ul>
                </div>
			 <?php } ?>
           </div>
		    </div>
			<?php } // if is front page 
else { ?>
			 <div class="fertblk">
			<div class="innerferttxt">
			     <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3> 
                <span class="fertloc"><?php print_custom_field('clinicaddress'); ?>, <?php print_custom_field('cliniccity'); ?>, <?php print_custom_field('clinicstate'); ?> <?php print_custom_field('cliniczipcode'); ?></span> 
			  <span class="fertdesc"><?php print_custom_field('clinicphone'); ?></span><br />
			  <span class="fertdesc"><a href="<?php print_custom_field('clinicwebsite'); ?>" target="_blank">Visit Website</a></span>  
           </div>
		 </div>
			<?php } ?>
     
   </div> 
   </div>
   </li>

     <?php endwhile; // end of the loop. ?>
 
<?php endif; ?>
	 </ul>
	</div>
	</div>
    <?php if (is_front_page()) { ?>
   <?php wp_reset_postdata(); ?>
   	<?php while ( have_posts() ) : the_post(); ?>
   <?php the_content(); ?>
          <?php endwhile; // end of the loop. ?>
   <?php } ?>
 
	 </div><!-- page-entry-content-->
				
				  <?php if (!is_front_page()) { ?>
			  </div><!--#ListView-->
			  <?php } ?>
				
			</div><!-- #content -->

		</div><!-- #primary -->


<?php get_sidebar(); ?>

<div class="clear"></div><!-- .clear the floats -->

<?php get_footer(); ?>