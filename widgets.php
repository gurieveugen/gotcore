<?php
class GC_Download extends WP_Widget {

    function GC_Download() {
        $this->WP_Widget( 'downloads', 'Downloads' );
    }

    function widget( $args, $instance ) {
        
        extract( $args );
        
        echo $before_widget,
             $before_title, $instance['title'], $after_title,
            '<div class="textwidget">
              <p>',$instance['text'],'</p>
             <span class="more"><a href="',$instance['text'],'">Download</a></span>
            </div>',
            $after_widget;
        
    }
    
    function form( $instance ) {
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e("Title"); ?>:</label>
            <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
            <br />
            <label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e("Text"); ?>:</label><br />
            <textarea style="width: 100%; height: 100px;" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>" ><?php echo $instance['text']; ?></textarea>
            <br />
            <label for="<?php echo $this->get_field_id( 'link' ); ?>"><?php _e("Link"); ?>:</label><br />
            <textarea style="width: 100%; height: 100px;" id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" ><?php echo $instance['link']; ?></textarea>
        </p>
        <?php 
    }

    function register_self() {
        register_widget( __CLASS__ );
    }
}

add_action( 'widgets_init', array( 'GC_Download', 'register_self' ) );
