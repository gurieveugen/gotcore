<?php
function register_inspiration_type() {
    
    $labels = array(
        'name'              => _x('Inspirations',   'post type general name'),
        'singular_name'     => _x('Inspiration',        'post type singular name'),
        'add_new'           => __('Add New'),
        'add_new_item'      => __('Add New Inspiration'),
        'edit_item'         => __('Edit Inspiration'),
        'new_item'          => __('New Inspiration'),
        'view_item'         => __('View Inspiration'),
        'search_items'      => __('Search Inspirations'),
        'not_found'         => __('No Inspirations found'),
        'not_found_in_trash'=> __('No deleted Inspirations found'),
        'parent_item_colon' => ''
      );
      
    $args = array(
    
        'labels'        => $labels,
        'public'        => false,
        'show_ui'       => true,
        'show_in_menu'  => true,
        'query_var'     => false,
        'rewrite'       => false,
        'capability_type' => 'post',
        'hierarchical'  => false,
        'supports'      => array( 'title', 'editor' )
      );
    
    register_post_type( 'inspiration', $args );
}

class GC_NoteWidget extends WP_Widget {

    function GC_NoteWidget() {
        $this->WP_Widget( 'notes', 'Inspiration' );
    }

    function widget( $args, $instance ) {
        
        extract( $args );
        @list($ins) = get_posts( array( 'post_type' => 'inspiration', 'showposts' => '1', 'orderby' => 'rand' ) );
        if ( ! $ins ) return;
        echo 
            $before_widget,
            '<div class="bg-top-note">&nbsp;</div>
            <div class="bg-rep-note">
                <p>
                    <strong>',$ins->post_title,' : </strong> 
                    ',$ins->post_content,'
                </p>
            </div>
            <div class="bg-bot-note">&nbsp;</div>',
            $after_widget;
        
    }
    
    function form() { echo 'Random inspiration will be displayed'; }

    function register_self() {
        register_widget( __CLASS__ );
    }
}

add_action( 'widgets_init', array( 'GC_NoteWidget', 'register_self' ) );
add_action( 'init' , 'register_inspiration_type' );
