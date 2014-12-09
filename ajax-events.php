<?php
if ( isset( $_GET['ajax'] ) and 'calendar' == $_GET['ajax'] and isset( $_GET['time'] ) ) {
    add_action( 'template_redirect', 'capture_ajax_events' );
    function capture_ajax_events() {
        show_ajax_events_table( (int) $_GET['time'] );
        exit;
    }
}

function show_ajax_calendar_script( $selector  = 'div.calendar-table' ) {
    ?>
    <script type="text/javascript" >
        var calendar_loaded_data = [];
        function reload_calendar( time ) {
            if ( calendar_loaded_data[time] ) {
                replace_calendar_data(calendar_loaded_data[time]);
                return;
            }
            jQuery('#cal-load-img').show();
            jQuery.ajax({
                url: '/?ajax=calendar&time=' + time,
                dataType: 'html',
                success: function( data ) {
                    calendar_loaded_data[ time ] = data;
                    replace_calendar_data( data );
                } 
            }); 
        }
        
        function replace_calendar_data( data ) {
            jQuery( '<?php echo $selector; ?>' ).html( data );
        }
        
        jQuery('a.calendar-switch').live( 'click', function() {
            reload_calendar( jQuery(this).attr('time') );
            return false;
        });
        
    </script>
    <?php
}

/**
add_action( 'save_post', 'clear_persistent_cache' ); 

function clear_persistent_cache( $pid ) {
    if ( isset( $_POST['post_type'] ) && TribeEvents::POSTTYPE == $_POST['post_type'] ) {
        delete_transient( 'calendar-all-events' );
        delete_transient( 'calendar-events-'. date( 'Y-m', strtotime($_POST['EventEndDate']) ) );
        delete_transient( 'calendar-events-'. date( 'Y-m', strtotime($_POST['EventStartDate']) ) );
        delete_transient( 'calendar-events-html-'. date( 'Y-m', strtotime($_POST['EventStartDate']) ) );
        delete_transient( 'calendar-events-html-'. date( 'Y-m', strtotime($_POST['EventEndDate']) ) );
    }
}
**/

function get_all_calendar_events() {
    if ( $list = get_transient( 'calendar-all-events' ) ) return $list;
    $list = get_posts(array(
        'showposts' => 999,
        'posts_per_page' => 999,
        'post_type' => TribeEvents::POSTTYPE,
    ));
    set_transient( 'calendar-all-events', $list, 86400 );
    return $list;
}

function get_events_for_month( $time ) {
    $ym    = date( 'Y-m', $time );
    $start = $ym . '-00 00:00:00';
    $end   = $ym . '-32 00:00:00';
    if ( $events = get_transient( 'calendar-events-'.$ym ) ) return $events;
    $events = array();
    $all   = get_all_calendar_events();
    foreach ( $all as $event ) {
        if ( $event->EventStartDate > $end or $event->EventEndDate < $start ) continue;
        $terms = get_the_terms( $event->ID, TribeEvents::TAXONOMY );
        $slug  = count( $terms ) ? array_shift( $terms ) : '';
        if ( $slug ) $slug = $slug->slug; 
        $time_start = strtotime( $event->EventStartDate );
        $time_end   = strtotime( $event->EventEndDate );
        $nevent = (object) array( 'ID' => $event->ID, 'title' => $event->post_title, 'category_slug' => $slug, 'start' => $time_start, 'end' => $time_end );
        for ( $i = date( 'd', $time_start ); $i <= date( 'd', $time_end ); $i++ ) {
            if ( empty($events[$i]) ) $events[$i] = array();
            $events[$i][] = $nevent;            
        }
    } 
    set_transient( 'calendar-events-'.$ym, $events, 86400 );
    return $events;
}

function show_ajax_events_table( $time ) {

    $ym    = date( 'Y-m', $time );
    if ( $result = get_transient( 'calendar-events-html-'.$ym ) ) { echo  $result; return; }
    ob_start();
    $events = get_events_for_month($time);
    $daysInMonth = date( "t", $time );
    $startOfWeek = get_option( 'start_of_week', 0 );
    $rawOffset   = date("w", mktime(12,0,0, date('m',$time), 1, date('Y', $time))) - $startOfWeek;
    $offset      = ( $rawOffset < 0 ) ? $rawOffset + 7 : $rawOffset;
    $rows        = 1;
    
    $tribe_ecp = TribeEvents::instance(); 
    
?>
<div class="calendar-table">
    <div class="calendar-mini">
        <div class="calendar-header cf">
           <a href="#previous" class="left calendar-switch" time="<?php echo strtotime( '-1 month', $time ); ?>" >Prev</a>
                <span><?php echo date('F Y', $time); ?> &nbsp; <img src="<?php bloginfo('template_url'); ?>/images/loading.gif" alt="LOADING" height="15" id="cal-load-img" style="display: none;" /> </span>
           <a href="#next" class="right calendar-switch" time="<?php echo strtotime( '+1 month', $time ); ?>" >Next</a>
        </div>
        
<table class="tribe-events-calendar events-calendar-widget-ajax" cellpadding="0" cellspacing="0" border="0">
    <thead>
        <tr>
            <?php
            for( $n = $startOfWeek; $n < 7 + $startOfWeek; $n++ ) {
                $dayOfWeek = ( $n >= 7 ) ? $n - 7 : $n;
                echo '<th id="tribe-events-' . strtolower($tribe_ecp->daysOfWeekShort[$dayOfWeek]) . '" title="' . $tribe_ecp->daysOfWeek[$dayOfWeek] . '">' . $tribe_ecp->daysOfWeekShort[$dayOfWeek] . '</th>';
            }
            ?>
        </tr>
    </thead>

    <tbody>
        <tr>
        <?php
            $prev_month_days = date( "t", strtotime( '-1 month', $time ) ) - $offset + 1;
            $postd = 0;
            for( $i = 1; $i <= $offset; $i++ ){
                $postd++; 
                ?><td class='tribe-events-othermonth'><?php echo $prev_month_days + $i; ?></td><?php
            }

            $current_day = date_i18n( 'd' );
            $current_month = date_i18n( 'm' );
            $current_year = date_i18n( 'Y' );
            
            for( $day = 1; $day <= $daysInMonth; $day++ ) {
                if( ($day + $offset - 1) % 7 == 0 && $day != 1) {
                    echo "</tr>\n\t<tr>";
                    $rows++;
                }

                if ( $current_month == $month && $current_year == $year) {
                    // Past, Present, Future class
                    if ($current_day == $day ) {
                        $ppf = ' tribe-events-present';
                    } elseif ($current_day > $day) {
                        $ppf = ' tribe-events-past';
                    } elseif ($current_day < $day) {
                        $ppf = ' tribe-events-future';
                    }
                } elseif ( $current_month > $month && $current_year == $year || $current_year > $year ) {
                    $ppf = ' tribe-events-past';
                } elseif ( $current_month < $month && $current_year == $year || $current_year < $year ) {
                    $ppf = ' tribe-events-future';
                } else { $ppf = ''; }
                
                $slug=''; 
                $day_count = empty( $events[$day] ) ? 0 : count($events[$day]);
                ob_start();
                ?>
                <div id="tooltip_day_<?php echo $day; ?>" class="tribe-events-tooltip">
                <?php
                if ($day_count) foreach( $events[$day] as $event ) {
                    $slug .= ' event-category-' . $event->category_slug; 
                    $link = get_permalink($event->ID);
                    ?><h5 class="tribe-events-event-title-mini"><a href="<?php echo $link ?>"><?php echo $event->title; ?></a></h5><?php
                }
                ?>
                <span class="tribe-events-arrow"></span>
                </div>
                <?php $html = ob_get_clean(); ?> 
                
                <td class="tribe-events-thismonth <?php echo $ppf, $slug ?>" >
                    <?php
                        echo $day_count ? "<a class='tribe-events-mini-has-event' href=\"$link\">$day</a>" : $day; 
                        if ($slug) echo $html; 
                    ?>
                </td>
                
                <?php
                $postd++;
            }
            // skip next month
            $next_day = 1;
            while( ($day + $offset) <= $rows * 7)
            {
                echo "<td class='tribe-events-othermonth'>$next_day</td>";
                $day++;
                $next_day++;
            }
        ?>
        </tr>
    </tbody>
</table>
</div>
</div>
<?php
$result = ob_get_clean();
set_transient( 'calendar-events-html-'.$ym, $result, 86400 );
echo $result;
}

class HV_Ajax_Events_Calendar extends WP_Widget {
            
    function HV_Ajax_Events_Calendar() {
        $widget_ops = array( 
            'classname'  => 'ajax-events-calendar',
            'description' => __( 'A widget that displays events calendar with ajax reloading' ) 
        );
        $control_ops = array( 'id_base' => 'ajax-events-calendar-widget' );
        
        $this->WP_Widget( 'ajax-events-calendar-widget', 'Hivista Ajax Events Calendar', $widget_ops, $control_ops );
    }

    function widget( $args, $instance ) {
        extract( $args, EXTR_SKIP );
        extract( $instance, EXTR_SKIP );
        $title = apply_filters('widget_title', $title );

        echo $before_widget;
        
        if ( $title ) echo $before_title . $title . $after_title;
        $selector = 'calendar-'.$this->id;
        echo '<div id="',$selector,'">';                    
        show_ajax_events_table( $_SERVER['REQUEST_TIME'] );
        echo '</div>';
        show_ajax_calendar_script( "#$selector" );
        echo $after_widget;
    }

    function update( $new_instance, $old_instance ) {
            $instance = $old_instance;
            $instance['title'] = strip_tags( $new_instance['title'] );
            return $instance;
    }

    function form( $instance ) {                
        /* Set up default widget settings. */
        $defaults = array( 'title' => 'Events Calendar' );
        $instance = wp_parse_args( (array) $instance, $defaults );
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:');?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
        </p>
        <?php
    }
}

/* Add function to the widgets_ hook. */
//add_action( 'widgets_init', 'HV_Ajax_Events_Calendar_load' );

/* Function that registers widget. */
function HV_Ajax_Events_Calendar_load() {
    register_widget( 'HV_Ajax_Events_Calendar' );
} 