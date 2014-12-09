<?php
function register_testimonial_type() {
    
    $labels = array(
        'name'              => _x('Testimonials',   'post type general name'),
        'singular_name'     => _x('Testimonial',        'post type singular name'),
        'add_new'           => __('Add New'),
        'add_new_item'      => __('Add New Testimonial'),
        'edit_item'         => __('Edit Testimonial'),
        'new_item'          => __('New Testimonial'),
        'view_item'         => __('View Testimonial'),
        'search_items'      => __('Search Testimonials'),
        'not_found'         => __('No Testimonials found'),
        'not_found_in_trash'=> __('No deleted Testimonials found'),
        'parent_item_colon' => ''
      );
      
    $args = array(
    
        'labels'        => $labels,
        'public'        => false,
        'show_ui'       => true,
        'show_in_menu'  => true,
        'query_var'     => true,
        'rewrite'       => true,
        'capability_type' => 'post',
        'hierarchical'  => false,
        'supports'      => array( 'title', 'editor', 'thumbnail' )
      );
    
    register_post_type( 'testimonial', $args );
}

class GC_Testimonials extends WP_Widget {

    function GC_Testimonials() {
        $this->WP_Widget( 'testimonials', 'Testimonials' );
    }

    function widget( $args, $instance ) {
        
        extract( $args );
        
        echo $before_widget;
        echo $before_title, $instance['title'], $after_title;

        foreach( get_posts(array(
            'post_type' => 'testimonial',
            'numberposts'=> 1,
            'orderby'    => 'rand'
        )) as $tmt ) {
            echo '<div class="textwidget">
              <h4>',get_the_post_thumbnail($tmt->ID, 'thumbnail'),' ',$tmt->post_title.'</h4>
              <p>',$tmt->post_content,'</p>
            </div>';
        }
        
        echo $after_widget;
        
    }
    
    function form( $instance ) {
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e("Title"); ?>:</label>
            <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
        </p>
        <?php 
    }

    function register_self() {
        register_widget( __CLASS__ );
    }
}

add_action( 'widgets_init', array( 'GC_Testimonials', 'register_self' ) );
add_action( 'init' , 'register_testimonial_type' );
