<?php
/**
 * HiVista Image Slider for Wordpress.
 * no posts, no titles, no links - just images.
 * @author Oleg Dudkin
 */
class HV_Light_Slider {

    static $total = 0;
    public $name = '';
    public $images = array();

    function __construct( $name = false ) {
        wp_enqueue_script( 'jquery_cycle', get_bloginfo( 'template_url' ). '/js/jquery.cycle.js', array('jquery') );
        ++self::$total;
        $this->name = $name? $name : ( 'light-slider-' . self::$total );
        $this->load_image_list();
        add_action( 'wp_head' , array( $this, 'header_script' ), 99 );
        global $pagenow;
        if (WP_ADMIN) {
            add_action( 'admin_init', array( $this, 'admin_init' ) );
            add_action( 'admin_menu', array( $this, 'admin_menu' ) );
            add_action( 'admin_init', array( $this, 'fix_async_upload_image' ) );
            
            if (( 'media-upload.php' == $pagenow || 'async-upload.php' == $pagenow) && $_GET['hv_add_attachment'] == 'true') {								
                add_filter( 'image_send_to_editor', array( $this, 'image_send_to_editor'), 1, 8 );
                add_filter( 'media_send_to_editor', array( $this, 'media_send_to_editor'), 1, 3 );
                add_filter( 'gettext', array( $this, 'gettext_filter' ), 1, 3 );
                add_filter( 'media_upload_tabs',    array( $this, 'media_upload_tabs' ), 999 );
            }
            
        }        
        
    }

    function header_script() {
        ?>
            <script type="text/javascript">
                var theme_url = '<?php bloginfo('template_url'); ?>';
                jQuery('document').ready(function($){
                    $('#<?php echo $this->name; ?>').cycle();
                });
            </script>
        <?php
    }

    function admin_init() {
        add_action( 'admin_print_scripts', array( __CLASS__, 'admin_scripts'));
        add_action( 'admin_print_styles',  array( __CLASS__, 'admin_styles'));
    }
    
    function admin_menu() {
        $title = 'Image Slider';
        if ( self::$total > 1) $title .= " ($this->name)";
        add_options_page( $title, $title,
                'administrator',
                'hv-image-slider-' . $this->name,
                array( $this, 'admin_page')
                );
    }

    function admin_scripts() {
        wp_enqueue_script( 'jquery-ui-sortable' );
        wp_enqueue_script( 'media-upload' );
        wp_enqueue_script( 'thickbox' );
    }

    function admin_styles() {
        wp_enqueue_style('thickbox');
    }

    function update() {
        update_option( 'hv-image-slider-' . $this->name, $this->images );
    }

    function load_image_list( $list = false ) {
        if ( $list === false ) {
            $list = get_option( 'hv-image-slider-' . $this->name , array() );
        }
        $this->images = array_filter(array_values( (array) $list ));
    }

    function admin_page() {
        if ( isset( $_POST['save-slider-images-confirm'] ) ) {
            $this->load_image_list( array_map( 'stripslashes', $_POST['slide_url'] ) );
            $this->update();
        } 
        $html = '';
        foreach ( (array) $this->images as $image) {
            $image = esc_attr( stripslashes( $image ) );
            $html .= '
                <div class="hv-slider-slide">
                    <img src="' . $image . '" />
                    <input type="hidden" value="' . $image . '" name="slide_url[]" />
                    <a href="#" class="delete-slide-button">delete</a>
                </div>
            ';
        }
        ?>
        <style type="text/css">
         .wrap div.hv-slider-slide {
            -webkit-box-shadow: 0px 0px 10px rgba(50, 50, 50, 0.5);
            -moz-box-shadow:    0px 0px 10px rgba(50, 50, 50, 0.5);
            box-shadow:         0px 0px 10px rgba(50, 50, 50, 0.5);
            width: 200px;
            height: 120px;
            padding: 10px;
            border: 1px solid #cccccc;
            background-color: #fcfcfc;
            border-radius: 5px;
            -moz-border-radius: 5px;
            -webkit-border-radius: 5px;
            float: left;
            margin: 5px;
            cursor: move;
         }
         .wrap div.hv-slider-slide-disabled {
            opacity: 0.2;
         }
         .wrap div.hv-slider-slide-deleted {
            opacity: 0.5;
            background-color: #eecccc;
         }
         .wrap div.hidden-content {
             position: relative;
             cursor: auto !important;
         }
         .wrap div.hidden-content button {
             position: absolute;
             top: 40px;
             left: 60px;
         }

         .wrap div.hidden-content img,
         .wrap div.hidden-content a
         {
             display: none !important;
         }
         .wrap div.hv-slider-slide img {
            width: 200px;
            height: 100px;
         }
        </style>

        <div class="wrap">
            <h2>Manage slides</h2>
            <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
            <div id="hv-slider-image-list">
                <?php echo $html; ?>
            </div>
            <div>
                <div class="hv-slider-slide hidden-content">
                    <img src="" alt="" />
                    <input type="hidden" value="" name="slide_url[]" />
                    <a href="#" class="delete-slide-button">delete</a>
                    <button id="add-slide-button">Add Slide</button>
                </div> 
            </div>
            <br style="clear: both" />
            <input type="hidden" name="save-slider-images-confirm" value="true" />
            <input type="submit" class="button" value="Save" />
            </form>

        </div>
        <script type="text/javascript">
        jQuery('document').ready(function($){
            var global_send_to_editor_callback = window.send_to_editor;
            
            $('#add-slide-button').click(function() {
                formfield = 'new_slide_URL';
                global_send_to_editor_callback = window.send_to_editor;
                window.send_to_editor = function(html) {
                    tb_remove();
                    //url = window.HV_sent_url;
										url = jQuery('img',html).attr('src');
                    window.send_to_editor = global_send_to_editor_callback;
                    var $new = $('div.hidden-content').clone();
                    $new.find('button').remove();
                    $new.find('img').attr('src', url);
										$new.find('input').val(url);
                    $new.removeClass('hidden-content');
                    $new.appendTo($('#hv-slider-image-list'));
                }
                tb_show( 'Add Slide', 'media-upload.php?hv_add_attachment=true&amp;type=image&amp;TB_iframe=true', false);
                return false;
            });

            $('#hv-slider-image-list').sortable({ cursor: 'move',  cancel: '.hidden-content'  });
            $('#hv-slider-image-list').disableSelection();

            $('.delete-slide-button').live('click',function(){
                if ( confirm('Do you really want to delete this slide?') ) $(this).parent().remove();
                return false;
            });
            
        });
        </script>
        <?php
    }

    public function listHTML() {
        foreach ( $this->images as $image ) {
            echo '<li><a href="' . $image .'" class="footer-slider-lightbox" >
                    <img src="' . $image .'" alt="slide-image" width="115" height="86" />
                    </a>
                  </li>';
        }
    }


    function fix_async_upload_image() {
        if(isset($_REQUEST['attachment_id'])) {
            $GLOBALS['post'] = get_post($_REQUEST['attachment_id']);
        }
    }
    
    
    function is_context() {
        return 
        (
            isset( $_REQUEST['hv_add_attachment'] )
            ||
            (
                isset($_SERVER['HTTP_REFERER']) 
                && 
                (strpos($_SERVER['HTTP_REFERER'], 'hv_add_attachment') !== false)
            )
            ||
            (
                isset($_REQUEST['_wp_http_referer']) 
                && 
                (strpos($_REQUEST['_wp_http_referer'], 'hv_add_attachment') !== false)
            )
        );
    }
    
    function gettext_filter($translated_text, $source_text, $domain) {
        if ( $this->is_context() ) {
            if ('Insert into Post' == $source_text) {
                return 'Add Slide';
            }
        }
        return $translated_text;
    }
    
    function image_send_to_editor( $html, $id, $caption, $title, $align, $url, $size, $alt = '' ) {
        $att = array( 
            'url'           => $url,
            'post_title'    => ($_t = $title)?$_t:$alt
        );
        return media_send_to_editor($html, $id, $att);
    }
    
    function media_send_to_editor( $html, $id, $att ) {
        if ( $this->is_context() ) {
        	$url = $att['url']
			or
			list($url) = wp_get_attachment_image_src( $id , 'full');					
            ?>
            <script type="text/javascript">
                var win = window.dialogArguments || opener || parent || top;
                win.HV_sent_html = '<?php echo addslashes($html) ?>';
                win.HV_sent_id = '<?php echo $id ?>';
                win.HV_sent_title = '<?php echo addslashes($att['post_title']); ?>';
                win.HV_sent_url = '<?php echo addslashes($url); ?>';								
            </script>
            <?php
        }
        return $html;
    }   

    function media_upload_tabs($tabs) {
        if ( $this->is_context() ) {
            foreach ($tabs as $key => $value) {
                if ( ! in_array($key, array('type', 'library'))) {
                    unset( $tabs[$key]);
                }
            }
        }
        return $tabs;
    }

    

}

global $home_slider;
$home_slider = new HV_Light_Slider( 'Home' );