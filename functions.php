<?php
/*
 * @package WordPress
 * @subpackage GotCore
 */
 
require_once "functions_launch.php";
include "twitter.php";
include "ajax-events.php";
include "ajax-news.php";
include "light-slider.php";
include "testimonials.inc.php";
include "inspirations.inc.php";
include dirname(__FILE__) . "/widgets.php";

/*
if ( ! is_user_logged_in() && ! in_array( $_SERVER['REMOTE_ADDR'], array( '92.113.12.157' ) ) ) {
    add_action( 'template_redirect', 'show_503' );
    function show_503() {
        include "503.php";
        exit;
    }
}
 */
 
$content_width = 600;				// Defines maximum width of images in posts
add_editor_style();					// Allows editor-style.css to configure editor visual style.

add_action( 'after_setup_theme', 'gotcore_setup' );
function gotcore_setup() {
	add_theme_support( 'post-thumbnails' );
}
add_custom_background();

register_sidebar( array(
	'description' => 'Main sidebar',
	'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
) );

register_sidebar( array(
	'name' => 'Homepage',
	'description' => 'Homepage small widget area',
	'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
) );

register_sidebar( array(
    'name' => 'Homepage Footer',
    'description' => 'Homepage footer widget area',
    'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
) );

register_sidebar( array(
    'name' => 'Page Sidebar',
    'before_widget' => '<div id="%1$s" class="widget-container cf %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h3><span>',
    'after_title' => '</span></h3>',
) );

register_sidebar( array(
    'name' => 'Blog Sidebar',
    'before_widget' => '<div id="%1$s" class="widget-container-blog cf %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>',
) );


register_nav_menus( array(
	'main' => 'Main Navigation Menu',
	//'homepage' => 'Secondary navigation Menu'
) );
wp_create_nav_menu('MainMenu');
wp_create_nav_menu('FooterMenu');

class walker_sub_menu_gotcore extends Walker_Nav_Menu {
        
    function start_lvl(&$output, $depth) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent".'
        <div class="sub-menu">
		  <div class="border-sub-menu">
            <div class="bg-sub-menu">
              <div class="bgtop-sub-menu">&nbsp;</div>
              <ul class="sub-menu">
        '."\n";
    }

    /**
     * @see Walker::end_lvl()
     * @since 3.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int $depth Depth of page. Used for padding.
     */
    function end_lvl(&$output, $depth) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul></div></div></div>\n";
    }
    
}

function get_top_menu(){
	$menu = wp_nav_menu(array(
  'container'       => 'div', 			// tag name '' - for no container.
  'container_id'    => 'nav-main',    // tag id
  'menu_class'      => '',				// ul class
  'menu_id'			=> 'main',			// ul id
  'echo'            => false,
  'walker'          => new walker_sub_menu_gotcore,  
  'theme_location'  => 'main'));		// menu location name ('main' or 'secondary' by default)
  
  //Filter to MINDBODY popup link
  $menu = preg_replace( '/(http:\/\/clients\.mindbodyonline\.com[^\"]*)/i', "#class-schedules\" onclick=\"return launchWS('\$1');", $menu);
  
  echo $menu;
}

function get_footer_menu(){
  wp_nav_menu(array(
  'container'       => 'div', 			// tag name '' - for no container.
  'container_id'    => 'nav-footer',    // tag id
  'menu_class'      => '',				// ul class
  'menu_id'			=> 'footer',			// ul id
  'echo'            => true,
  'theme_location'  => 'secondary'));		// menu location name ('main' or 'secondary' by default)
}

/*function remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'remove_recent_comments_style' );*/

function show_posted_in() {
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.';
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.';
	} else {
		$posted_in = 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.';
	}
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}

add_theme_support( 'automatic-feed-links' );

function short_content($content,$sz = 500,$more = '...') {
	if (strlen($content)<$sz) return $content;
	$p = strpos(trim($content), " ",$sz);
    if (!$p) return $content;
        $content = strip_tags($content);
        if (strlen($content)<$sz) return $content;
        $p = strpos($content, " ",$sz);
        if (!$p) return $content;
	return substr($content, 0, $p).$more;
}

function get_thumb($iurl, $iw = '', $ih = '', $zc = '') {
  $thumb = '';
  if (is_numeric($iurl)) { $iurl = get_attach_url($iurl); }
  if (strlen($iurl)) {
    $thumb = get_bloginfo('template_url').'/timthumb.php?src='.$iurl;
    if (strlen($iw)) { $thumb .= '&w='.$iw; }
    if (strlen($ih)) { $thumb .= '&h='.$ih; }
    if (strlen($zc)) { $thumb .= '&zc='.$zc; }
  }
  return $thumb;
}

function get_featured_image_id($pid) {
	return get_post_meta($pid, '_thumbnail_id', true);
}

function get_attach_url($aid) {
  global $wpdb;
  return $wpdb->get_var("select guid from ".$wpdb->prefix."posts where ID = '".$aid."'");
  
}

function mytheme_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
     <div id="comment-<?php comment_ID(); ?>">
      <div class="comment-author cf">

         <?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?>
		 <span class="comment-meta"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','') ?></span>
		 <span class="reply">
           <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
         </span>
      </div>
      <?php if ($comment->comment_approved == '0') : ?>
         <em><?php _e('Your comment is awaiting moderation.') ?></em>
         <br />
      <?php endif; ?>

      <?php comment_text() ?>

      
     </div>
<?php
}

add_action( 'add_meta_boxes', 'add_page_metabox' );

function add_page_metabox() {
    add_meta_box(
        'page_box_content',
        __( 'Subtitle' ), 
        'page_metabox_subtitle',
        'page','normal', 'high'
    );
    if ( ! empty($_GET['post']) and $pid = (int) $_GET['post'] and $tp = get_post( $pid ) and $tp->post_parent == 13 ) :
        add_meta_box(
            'page_box_tabcontent',
            __( 'Tabs content' ), 
            'page_metabox_tabcontent',
            'page','normal', 'high'
        );
		    
        add_meta_box(
            'page_box_additional',
            __( 'Settings' ), 
            'page_metabox_settings',
            'page','side', 'low'
        );

			
	endif;
}

function page_metabox_subtitle( $page ) {
	?>
	Custom Page Title: 
		<input name="title_override" value="<?php echo esc_attr( get_post_meta( $page->ID, 'title_override', TRUE ) ); ?>" size="100" />
	<br />
	<?php
    wp_editor(get_post_meta( $page->ID, 'subtitle_content', true ), 'subtitle_content');
}

add_action( 'save_post', 'save_page_custom_data' );
function save_page_custom_data( $page_ID ) {
    if ( isset($_POST['post_type']) and 'page' == $_POST['post_type'] ) {
    	foreach( array( 'subtitle_content', 'tab_content', 'tab_show', 'menu_show', 'title_override', 'override_link' ) as $field ) 
	      if ( ! empty( $_POST[$field]) ) update_post_meta($page_ID, $field, $_POST[$field] );
    } 
}

add_shortcode( 'table_columns', 'shortcode_table_data' );
function shortcode_table_data( $atts, $content ) {
    return '<table cellspacing="0" cellpadding="0"><tr><td>' . do_shortcode($content) . '</td></tr></table>';
}

add_shortcode( 'table_divider', 'shortcode_table_divider' );
function shortcode_table_divider( ) {
    return '</td><td>';
}

function page_metabox_settings( $page ) {
    $show_tab = get_post_meta( $page->ID, 'menu_show', true );	
	?>
		<label>Show in sidebar menu: </label>
	    <input name="menu_show" type="radio" value="yes" <?php checked( 'yes', $show_tab); ?> /> Yes 
	    <input name="menu_show" type="radio" value="no" <?php checked( 'no', $show_tab); ?> /> No
	<?php 
}

function page_metabox_tabcontent( $page ) {
    $show_tab = get_post_meta( $page->ID, 'tab_show', true ); 
    ?>
    <label>Show tab on homepage: </label>
    <input name="tab_show" type="radio" value="yes" <?php checked( 'yes', $show_tab); ?> /> Yes 
    <input name="tab_show" type="radio" value="no" <?php checked( 'no', $show_tab); ?> /> No 
    <br />
    <label>Read More link: </label>
    <input name="override_link" value="<?php echo esc_attr( get_post_meta( $page->ID, 'override_link', true ) ); ?>" size="100" />
    <br />
    <?php
    wp_editor(get_post_meta( $page->ID, 'tab_content', true ), 'tab_content');
}