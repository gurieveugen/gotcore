<?php 

// ENQUEUE THEME SCRIPTS
function le_scripts() {
if ( is_user_logged_in() ) return;
  //wp_deregister_script( 'jquery' );
  //wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js' );
  wp_enqueue_script( 'jquery' );
	wp_register_script('le_script_googlewebfonts', 'https://ajax.googleapis.com/ajax/libs/webfont/1.0.22/webfont.js', array('jquery'), '1.0' );
	wp_enqueue_script('le_script_googlewebfonts');
	wp_register_script('le_script_supersize', get_template_directory_uri() . '/js/supersized.3.1.3.core.min.js', array('jquery'), '1.0' );
	wp_enqueue_script('le_script_supersize');
	wp_register_script('le_script_jqmodal', get_template_directory_uri() . '/js/jqModal.js', array('jquery'), '1.0' );
	wp_enqueue_script('le_script_jqmodal');
	wp_register_script('le_script_init', get_template_directory_uri() . '/js/init.js', array('jquery'), '1.0' );
	wp_enqueue_script('le_script_init');
}
add_action('wp_enqueue_scripts', 'le_scripts');


// ENQUEUE ADMIN STYLES
function lefx_css(){
    wp_register_style( 'lefx_css_base', get_bloginfo('stylesheet_directory') . '/functions/style.css', false, '1.0.0' );
    wp_enqueue_style( 'lefx_css_base' );
   
    wp_register_style( 'lefx_css_designer', get_bloginfo('stylesheet_directory') . '/functions/designer.css', false, '1.0.0' );
    wp_enqueue_style( 'lefx_css_designer' );
    
    wp_register_style( 'lefx_css_jpicker', get_bloginfo('stylesheet_directory') . '/js/jpicker/css/jPicker-1.1.6.min.css', false, '1.0.0' );
    wp_enqueue_style( 'lefx_css_jpicker' );
    
    wp_register_style( 'lefx_css_jqueryui', get_bloginfo('stylesheet_directory') . '/js/jqueryui/css/overcast/jquery-ui-1.8.16.custom.css', false, '1.0.0' );
    wp_enqueue_style( 'lefx_css_jqueryui' );
    
}
add_action('admin_enqueue_scripts', 'lefx_css');


// ENQUEUE ADMIN SCRIPTS
function lefx_scripts() {
//	wp_deregister_script( 'jquery' );
//	wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js' );
//	wp_enqueue_script( 'jquery' );

	wp_register_script('lefx_script_googlewebfonts', 'https://ajax.googleapis.com/ajax/libs/webfont/1.0.22/webfont.js', array('jquery'), '1.0' );
	wp_enqueue_script('lefx_script_googlewebfonts');

	wp_register_script('lefx_script_jqmodal', get_template_directory_uri() . '/js/jqModal.js', array('jquery'), '1.0' );
	wp_enqueue_script('lefx_script_jqmodal');
	
	wp_register_script('lefx_script_jpicker', get_template_directory_uri() . '/js/jpicker/jpicker-1.1.6.js', array('jquery'), '1.0' );
	wp_enqueue_script('lefx_script_jpicker');
	
	wp_register_script('lefx_script_cookie', get_template_directory_uri() . '/js/jquery.cookie.js', array('jquery'), '1.0' );
	wp_enqueue_script('lefx_script_cookie');
	
//	wp_register_script('lefx_script_jqueryui', get_template_directory_uri() . '/js/jqueryui/js/jquery-ui-1.8.16.custom.min.js', array('jquery'), '1.0' );
//	wp_enqueue_script('lefx_script_jqueryui');

	wp_register_script('lefx_script_init', get_template_directory_uri() . '/functions/js/init.js', array('jquery'), '1.0' );
	wp_enqueue_script('lefx_script_init');
	
}
add_action('admin_enqueue_scripts', 'lefx_scripts');


// INCLUDE TABLE CREATION FUNCTIONS
require_once(TEMPLATEPATH . '/functions/tables.php');

// INCLUDE QUERY FUNCTIONS
require_once(TEMPLATEPATH . '/functions/theme-functions.php');

// INCLUDE OPTIONS PANEL FUNCTIONS
//require_once(TEMPLATEPATH . '/inc/MCAPI.class.php');
require_once(TEMPLATEPATH . '/functions/optionspanel.php');

// INCLUDE DESIGNER
require_once(TEMPLATEPATH . '/functions/designer.php');

// INCLUDE DESIGNER FUNCTIONS
require_once(TEMPLATEPATH . '/functions/designer-functions.php');

// INCLUDE INTEGRATIONS PAGE
require_once(TEMPLATEPATH . '/functions/integrations.php');

// INCLUDE STATS PAGE
require_once(TEMPLATEPATH . '/functions/stats.php');


// BUILD THEME MENU

add_action('admin_menu', 'build_le_theme_menu');
function build_le_theme_menu() {
    add_menu_page(__('Launch Effect','le_theme_menu'), __('Launch Effect','le_theme_menu'), 'manage_options', 'lefx_designer');
    add_submenu_page('lefx_designer', __('Designer','le_theme_menu'), __('Designer','le_theme_menu'), 'manage_options', 'lefx_designer', 'build_le_designer_page');
    add_submenu_page('lefx_designer', __('Stats','le_theme_menu'), __('Stats','le_theme_menu'), 'manage_options', 'lefx_stats', 'build_le_stats_page');
    add_submenu_page('lefx_designer', __('Export CSV','le_theme_menu'), __('Export CSV','le_theme_menu'), 'manage_options', 'lefx_export', 'build_le_export_page');
	add_submenu_page('lefx_designer', __('Integrations','le_theme_menu'), __('Integrations','le_theme_menu'), 'manage_options', 'lefx_integrations', 'build_le_integrations_page');
}


// BUILD THEME SUBMENU TABS


function lefx_tabs($currtab) { ?>

	<div class="le-icons icon32"><br /></div>
	<h2 class="nav-tab-wrapper">
		<a class="nav-tab <?php if($currtab == 'plugin_options') { echo ' nav-tab-active'; } ?>" href="?page=lefx_designer">Designer</a>
		<a class="nav-tab <?php if($currtab == 'integrations_options') { echo ' nav-tab-active'; } ?>" href="?page=lefx_integrations">Integrations</a>
		<a class="nav-tab <?php if($currtab == 'stats') { echo ' nav-tab-active'; } ?>" href="?page=lefx_stats">Stats</a>
		<a class="nav-tab <?php if($currtab == 'export') { echo ' nav-tab-active'; } ?>" href="?page=lefx_export">Export CSV</a>
	</h2>
	
<?php }

?>