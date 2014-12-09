        <div class="widget-container-blog cf">
          <h3>Subscribe to our blog</h3>
          <div class="widget-subscribe cf">
            <?php              
                $mv = get_option('mc_merge_vars');
                $igs = get_option('mc_interest_groups');
                if (!is_array($mv)) return;
                
                // Get some options
                $uid = get_option('mc_user_id');
                $list_name = get_option('mc_list_name');
            ?>
                
             <form method="post" action="#mc_signup" id="mc_signup_form" class="cf">
                <input type="hidden" id="mc_submit_type" name="mc_submit_type" value="html" />
                <input type="hidden" name="mcsf_action" value="mc_submit_signup_form" />
                <?php wp_nonce_field('mc_submit_signup_form', '_mc_submit_signup_form_nonce', false); ?>
                
                <div class="updated" id="mc_message"><?php echo mailchimpSF_global_msg(); ?></div><!-- /mc_message -->
                
                <?php
                foreach($mv as $var) {
                    if (!$var['public']) {
                        echo '<div style="display:none;">'.mailchimp_form_field($var, $num_fields).'</div>';
                    }
                }
                ?>
                
                <span class="text"><input type="text" size="18" value="Enter Email Address" name="mc_mv_EMAIL" id="mc_mv_EMAIL" class="mc_input"
                    onfocus="if ( this.value == 'Enter Email Address' ) this.value = ''; "
                    onblur="if ( this.value == '' ) this.value = 'Enter Email Address'; "
                    ></span>
                <span class="submit"><input type="submit" name="mc_signup_submit" id="mc_signup_submit" value="Submit" /></span>
                
             </form>
              
            <p><span>Or subscribe using our free rss feed</span><a href="<?php echo home_url('rss'); ?>" class="more">Click here to subscribe</a></p>
          </div>
        </div>

<?php dynamic_sidebar( 'Blog Sidebar' ); ?>
