<?php

define ( 'AJAX_POSTS_PER_PAGE', 3 );

if ( isset( $_GET['ajax'] ) and 'news' == $_GET['ajax'] and isset( $_GET['pagenum'] ) ) {
    add_action( 'template_redirect', 'capture_ajax_news' );
    function capture_ajax_news() {
        show_ajax_news_page( (int) $_GET['pagenum'] );
        exit;
    }
}

function show_ajax_news_script() {
    $total_count = wp_count_posts();
    ?>
    <script type="text/javascript" >
        var news_loaded_data = [];
        var current_news_page = 1;
        var max_news_pages   = <?php echo ceil($total_count->publish / AJAX_POSTS_PER_PAGE ); ?>;
        
        jQuery(function($){
            update_news_page_info(); 
        });
        
        function reload_news( page ) {
            if ( news_loaded_data[page] ) {
                replace_news_list(news_loaded_data[page]);
                return;
            }
            jQuery('#news-load-img').show(100);
            jQuery.ajax({
                url: '/?ajax=news&pagenum=' + page,
                dataType: 'html',
                success: function( data ) {
                    news_loaded_data[ page ] = data;
                    replace_news_list( data );
                    jQuery('#news-load-img').hide(100);
                } 
            }); 
        }
        
        function replace_news_list( data ) {
            jQuery( 'div.news-widget-home ul' ).html( data );
        }
        
        function update_news_page_info() {
            jQuery( '.nav-news span' ).html( '' + current_news_page + ' of ' + max_news_pages );
            if ( 1 == current_news_page ) {
                jQuery( '.nav-news a.left' ).removeClass('active');
            } else {
                jQuery( '.nav-news a.left' ).addClass('active');
            }
            if ( max_news_pages == current_news_page ) {
                jQuery( '.nav-news a.right' ).removeClass('active');
            } else {
                jQuery( '.nav-news a.right' ).addClass('active');
            }
        }
        
        jQuery('.nav-news a').live( 'click', function() {
            var $this = jQuery(this);
            current_news_page += ( $this.is('.right') ) ? 1 : -1;
            
            if ( current_news_page < 1 ) { current_news_page = 1; return false; }  
            if ( current_news_page > max_news_pages ) { current_news_page = max_news_pages; return false; }  
            reload_news( current_news_page );
            update_news_page_info();
            return false;
        });
        
        
        
    </script>
    <?php
}

function show_ajax_news_page( $page = 1 ) {
    if ( ! $page ) $page = 1;
    foreach ( get_posts( array( 'paged' => $page, 'showposts' => AJAX_POSTS_PER_PAGE ) ) as $entry ) : ?>
        <li class="cf">
          <div class="date"><?php echo strftime( '%d<small>%b</small>', strtotime($entry->post_date) ); ?></div>
          <div class="text">
            <p><?php echo $entry->post_title; //short_content( $entry->post_content, 60 ); ?></p>
            <a href="<?php echo get_permalink( $entry->ID ); ?>" class="more">Read more</a>
          </div>
        </li>
    <?php endforeach;
}
/*
add_action( 'save_post', 'clear_ajax_news_cache' );
function clear_ajax_news_cache( $nPostID ) {
    
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $nPostID;
    if ( 'testimonial' != $_POST['post_type'] ) return $nPostID;
}
*/
