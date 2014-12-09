<?php
/**
 * @package WordPress
 * @subpackage GotCore
 */
?>
<?php get_header(); ?>
	    <div class="top-home cf">
		  <div class="left">
		    <!-- slider-box -->
		    <div class="slider-box cf">
		      <div class="nav-slider">
			  </div>
			  <div class="images-slider">
			    <ul>
			      <?php global $home_slider; 
			         foreach( $home_slider->images as $img ) { echo "<li><img src=\"$img\" /></li> \n\n"; }
			      ?>
				</ul>
			  </div>
		    </div>
		    <!-- end slider-box -->
		  </div>
		  <script type="application/javascript">
		      jQuery(function($){
		          $('div.images-slider ul').cycle({
		              fx: 'fade',
		              pager: '.nav-slider'
		          });
		          //$('div.nav-slider').wrapInner('<ul />').find('a').wrap('<li />');
		      });
		  </script>
		  <div class="right">
		    <!-- news-box -->
		    <div class="news-widget-home cf">
		      <h3>recent posts +<span>&nbsp;</span></h3>
			  <ul class="cf">
                 <?php show_ajax_news_page(); ?>
			  </ul>
			  <div class="nav-news">
			    <a href="#prev" class="left">&laquo;</a>
				<a href="#next" class="right active">&raquo;</a>
				<span></span>
				<img src="<?php bloginfo('template_url'); ?>/images/loading-white.gif" alt="LOADING" height="15" id="news-load-img" style="display: none;" />
			  </div>
			  
			  <a href="/our-blog/" class="viewall">VIEW ALL</a>
		    </div>
		    <?php show_ajax_news_script(); ?>
		    <!-- end news-box -->
		  </div>
		</div>
		
		<div class="middle-home cf">
		    
          <?php
              $tab_header = '';
              $tab_content = '';
              $dir = get_bloginfo('template_url');
              foreach( get_posts( array( 'post_type' => 'page', 'meta_key' => 'tab_show', 'meta_value' => 'yes', 'orderby' => 'menu_order', 'order' => 'ASC', 'showposts' => 9 ) ) as $tabpage ) {
                  $tab_header .= "<li><a href=\"#tab-$tabpage->post_name\">$tabpage->post_title</a></li> \r\n";
                  $img = get_the_post_thumbnail( $tabpage->ID, 'full' );
                  $cont = wpautop(get_post_meta( $tabpage->ID, 'tab_content', true ), false );
				  $link = get_post_meta( $tabpage->ID, 'override_link', true )
				  or
                  $link = get_permalink( $tabpage->ID );
                  $tab_content .= 
<<<TABDATA
              <div class="content-tabs cf" id="tab-$tabpage->post_name">
                <div class="img-tabs">$img</div>
                
                <div class="text-tabs">
                  $cont  
                </div>
                
                <div class="logo-tabs">
                  <img src="$dir/images/logo-$tabpage->post_name.png" alt="$tabpage->post_name" />
                  <a href="$link" class="more">Read more</a>
                </div>
              </div>
TABDATA;
              } 
          ?>
  
		    
    		  <div class="tabs-home cf">
    		    <ul class="tab-menulist">
    		      <?php  echo $tab_header;  ?>  
    			</ul>
    			<a href="#" class="plus">+</a>
                <?php  echo $tab_content;  ?>
        	</div>
		</div>
		
		<script type="text/javascript">
		    jQuery(function($){
		       jQuery('div.tabs-home').tabs(); 
		    });
		</script>
		
		<div class="bottom-home cf">
		  <div class="left">
		    <!-- promise-box -->
			<div class="promise-box">
			  <h3>OUR PROMISE</h3>
			  <h4>Core Fitness: an environment dedicated to your health &amp; fitness.</h4>
			  <p>There&rsquo;s no shame in it:  sometimes you need a little encouragement.  Core Fitness strives to create close connections with our members, providing a community environment where people can come to get excited about a healthy lifestyle.  At Core fitness of Myrtle Beach, you&rsquo;ll find something different from what you&rsquo;d expect in an ordinary gym.  Our expert staff combines with state-of-the-art gym equipment and an outstanding menu of programs to give you the ultimate fitness experience.  We know that seeing familiar faces goes a long way towards giving you the incentive to get and stay fit!</p>
			  
			  <div class="blue-promise-box cf">
			    <div class="form-subscribe">
		<?php
			        
    function show_mail_shimp_form() {			        
        $mv = get_option('mc_merge_vars');
        $igs = get_option('mc_interest_groups');
        if (!is_array($mv)) return;
        
        // Get some options
        $uid = get_option('mc_user_id');
        $list_name = get_option('mc_list_name');
    ?>
    
    <form method="post" action="#mc_signup" id="mc_signup_form">
        <input type="hidden" id="mc_submit_type" name="mc_submit_type" value="html" />
        <input type="hidden" name="mcsf_action" value="mc_submit_signup_form" />
        <?php wp_nonce_field('mc_submit_signup_form', '_mc_submit_signup_form_nonce', false); ?>
    
        <div class="mc_form_inside">
            
            <div class="updated" id="mc_message"><?php echo mailchimpSF_global_msg(); ?></div><!-- /mc_message -->

        <?php
        //don't show the "required" stuff if there's only 1 field to display.
        $num_fields = 0;
        foreach((array)$mv as $var) {
            $opt = 'mc_mv_'.$var['tag'];
            if ($var['req'] || get_option($opt) == 'on') {
                $num_fields++;
            }
        }

        if (is_array($mv)) {
            // head on back to the beginning of the array
            reset($mv);
        }
        
        // Loop over our vars, and output the ones that are set to display
        foreach($mv as $var) {
            if (!$var['public']) {
                echo '<div style="display:none;">'.mailchimp_form_field($var, $num_fields).'</div>';
            }
            else {
                echo mailchimp_form_field($var, $num_fields);
            }
        }
        ?>

        <div class="mc_signup_submit">
            <input type="submit" name="mc_signup_submit" id="mc_signup_submit" value="<?php echo esc_attr(get_option('mc_submit_text')); ?>" class="button" />
        </div><!-- /mc_signup_submit -->
    
        <?php  if ($sub_heading = trim(get_option('mc_subheader_content'))) { ?>
            <div id="mc_subheader">
                <?php echo $sub_heading; ?>
            </div><!-- /mc_subheader -->
        <?php } ?>
        
            </div><!-- /mc_form_inside -->
            </form><!-- /mc_signup_form -->
    	<?php }
    show_mail_shimp_form(); ?>
				</div>
				
				<div class="checkus-text">
				  <h3>COME IN &amp; CHECK US OUT!</h3>
				  <p>SEE MORE DETAILS ON ALL WE HAVE TO OFFER</p>
				</div>
			  </div>
			</div>
			<!-- end promise-box -->
		  </div>
		  
		  <div class="right">
		    <!-- calendar-box -->
			<div class="calendar-box">
			  <?php dynamic_sidebar( 'homepage' ); ?>
			</div>
		  			
			<!-- end calendar-box -->
		  </div>
		</div>
<?php get_footer(); ?>
