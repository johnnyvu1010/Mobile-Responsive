</div><!-- #main -->

<div class="clear"></div><!-- .clear  to clear the floats loacted in the main section -->

<footer class="clearfix" id="footer-bottom">
        
			<div id="footer-content" class="clearfix">
            
                <div class="column">         
				     <?php if ( ! dynamic_sidebar( 'Footer One' ) ) : ?><!--Wigitized Footer One--><?php endif ?>
                </div>
        
			</div><!--#footer-content-->
              
</footer>

<div class="clear"></div><!-- .clear the floats -->

</div><!--.container -->

</div><!--#wrap-->

<?php wp_footer(); /* this is used by many Wordpress features and plugins to work proporly */ ?>


</body>

</html>