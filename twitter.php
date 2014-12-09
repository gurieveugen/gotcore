<?php
function prettyDate($time){
   $diff = time() - $time;
   $day_diff = intval($diff / 86400);

   if ($day_diff == 0) {
      if ($diff < 60) return "just now";
      if ($diff < 120) return "1 minute ago";
      if ($diff < 3600) return floor( $diff / 60 )." minutes ago";
      if ($diff < 7200) return "1 hour ago";
      if ($diff < 86400) return floor( $diff / 3600 )." hours ago";
   }
   if ($day_diff == 1) return "Yesterday";
   if ($day_diff < 7) return $day_diff ." days ago";
   if ($day_diff < 31) return intval( $day_diff / 7 ) . " weeks ago";
   if ($day_diff < 61) return "1 month ago";
   if ($day_diff > 60) return intval( $day_diff / 30 ) . " months ago";

   return false;
}


class HV_Twitter_Widget extends WP_Widget {

   private $bearer_token = false;
   private $consumer_key = false;
   private $consumer_secret = false;

   function HV_Twitter_Widget() {
      $widget_ops = array('classname' => 'hv_widget_twitter',
                          'description' => __( "Show twitter feeds from multiple sources") );
      $this->WP_Widget('hv-twitter', __('Twitter Widget'), $widget_ops);
   }

   function _cache_name($name) {
      return $this->get_field_id($name);
   }

   function get_bearer_token() {
      if($this->bearer_token) return $this->bearer_token;
      $rq = base64_encode(urlencode($this->consumer_key) . ":" . urlencode($this->consumer_secret));
      $curl = curl_init();
      curl_setopt_array($curl, array(
         CURLOPT_RETURNTRANSFER  => 1,
         CURLOPT_URL             => "https://api.twitter.com/oauth/request_token",
         CURLOPT_USERAGENT       => 'ARPN Widget',
         CURLOPT_POST            => 1,
         CURLOPT_POSTFIELDS      => 'grant_type=client_credentials',
      ));
      curl_setopt($curl, CURLOPT_HTTPHEADER, array(
         "Authorization: Basic $rq",
         "Content-Type: application/x-www-form-urlencoded;charset=UTF-8"
      ));
      $resp = curl_exec($curl);
      curl_close($curl);
      return $this->bearer_token = json_decode($resp)->access_token;
   }

   function get_cached($name) {
      if(defined('HV_CACHE_GLOBAL') and !HV_CACHE_GLOBAL) return false;
      if($cached = get_transient($this->_cache_name($name))) return $cached;
      return false;
   }

   function set_cache($name, $data) {
      set_transient($this->_cache_name($name), $data, defined('HV_CACHE_FREQUENT_TIME')?HV_CACHE_FREQUENT_TIME:600);
      update_option($this->_cache_name($name), $data);
   }

   function fallback($name) {
      return get_option($this->_cache_name($name));
   }

   function widget($args, $instance) {
//      if($cache = $this->get_cached("whole")){
//         echo $cache;
//         return;
//      }
      ob_start();

      $this->hv_widget($args, $instance);

      $cache = ob_get_flush();
      $this->set_cache("whole", $cache);
   }

   function flush_widget_cache() {
      $this->set_cache('whole', NULL);
   }

   function get_tweets($user, $num) {
      return $this->get_api_data("statuses/user_timeline.json?count=$num&screen_name=$user");
   }

   function search_tweets($query, $num) {
      return $this->get_api_data("search/tweets.json?q=".urlencode($query)."&count=$num");
   }

   function get_api_data($query){
      $curl = curl_init();
      curl_setopt_array($curl, array(
         CURLOPT_RETURNTRANSFER  => 1,
         CURLOPT_URL             => "https://api.twitter.com/1/$query",
         CURLOPT_USERAGENT       => 'ARPN Widget',
         CURLOPT_POST            => 0,
         CURLOPT_HTTPHEADER      => array(
            'Authorization: Bearer ' . $this->get_bearer_token(),
         )));
      $resp = curl_exec($curl);
      curl_close($curl);
      return json_decode($resp);
   }


   function hv_widget($args, $instance) {
      extract($args);
      $title = $instance['title'];
      if ( !$number = (int) $instance['number'] )
         $number = 10;
      else if ( $number < 1 )
         $number = 1;
      else if ( $number > 30 )
         $number = 30;

      echo $before_widget;
      if ( $title ) echo $before_title . $title . $after_title;

      $this->consumer_secret  = $instance['csecret'];
      $this->consumer_key     = $instance['ckey'];

      $rsslist = explode("\n",$instance['sources']);
      $rss = array();
      $counter = array();
      $times = array();
      $userlist = array();
      foreach ($rsslist as $k=>$req) {
         $req = trim($req);
         if (strpos($req,'@') === 0) {
            $userlist[$k] = $uname = substr($req,1);
            $ch = "twitter-timeline-$uname";
            if(!$rss[$k] = $this->get_cached($ch)) {
               if(!$rss[$k] = $this->get_tweets($uname, $number)) {
                  $rss[$k] = $this->fallback($ch);
               } else {
                  $this->set_cache($ch, $rss[$k]);
               }
            }
         } else {
            $userlist[$k] = false;
            $ch = "twitter-search-$req";
            if(!$rss[$k] = $this->get_cached($ch)) {
               if(!$rss[$k] = $this->search_tweets($req, $number)) {
                  $rss[$k] = $this->fallback($ch);
               } else {
                  $this->set_cache($ch, $rss[$k]);
               }
            }
         }
         $counter[$k] = 0;
         $times[$k] = 0;
      }
      $cnt = 0;
            echo "<pre style='display: none'>";
            print_r($rss);
            echo "</pre>";
      echo "<ul>";
      while ($cnt<$number) {
         $timemax = 0;
         $indmax = 0;
         foreach ($times as $k=>$time) {
            if (is_array($rss[$k]) and isset($rss[$k][$counter[$k]])) {
               $times[$k] = strtotime($rss[$k][$counter[$k]]->created_at);
            } else { $times[$k]=0; }
            if ($times[$k] > $timemax) {
               $timemax = $times[$k];
               $indmax = $k;
            }
         }
         if	(array_sum($times) == 0) break;
         $item = $rss[$indmax][$counter[$indmax]++];
         $status = $item->text;
         $match = array();
         preg_match_all('/(http\:\/\/[^("|\'|<| )]+)/',$status,$match);
         if (!empty($match[0])) {
            foreach($match[0] as $mt) {
               $status = str_replace($mt,'<a href="'.$mt.'" rel="nofollow" target="_blank">'.$mt.'</a>',$status);
            }
         }

         if(!empty($userlist[$indmax])) {
            $status = "@".$userlist[$indmax].": $status";
         }

         foreach ($userlist as $uname) {
            if(!$uname) continue;
            $status = str_replace("@$uname",'<a href="http://twitter.com/'.$uname.'" rel="nofollow" target="_blank">@'.$uname.'</a>',$status);
            $status = str_replace("$uname:",'<a href="http://twitter.com/'.$uname.'" rel="nofollow" target="_blank">'.$uname.'</a>:',$status);
         }
         //$time = date('g:i A M jS',$timeM);
         $time = prettyDate($timemax);
         /*if (isset($user_profile[$indmax]->profile_image_url)) {
            $author_uri = "http://twitter.com/".$userlist[$indmax];
            $imgsrc = $user_profile[$indmax]->profile_image_url;
         } else {
            $author_uri = $item['author_uri'];
            $imgsrc = $item['link_image'];
         }
         $img = '<a href="'.$author_uri.'" rel="nofollow" target="_blank"><img alt="casino" width="48" height="48" src="'.$imgsrc.'"></a>';
         */

         echo "<li><p>$status</p><span>$time</span></li>";
         $cnt++;
      }
      echo "</ul>";
      echo $after_widget;
   }

   function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
      $instance['title'] = strip_tags($new_instance['title']);
      $instance['number'] = (int) $new_instance['number'];
      $instance['sources'] = $new_instance['sources'];
      $instance['ckey'] = $new_instance['ckey'];
      $instance['csecret'] = $new_instance['csecret'];
      $this->flush_widget_cache();
      return $instance;
   }

   function form( $instance ) {
      $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
      if ( !isset($instance['number']) || !$number = (int) $instance['number'] )
         $number = 5;
      ?>
      <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
         <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

      <a href="#apiinfo" onClick="jQuery(this).next().toggle(); return false;">API Info</a>
      <div style="display: none;">
         <p><label for="<?php echo $this->get_field_id('Consumer Key'); ?>"><?php _e('Consumer Key:'); ?></label>
            <input class="widefat"
                   id="<?php echo $this->get_field_id('ckey'); ?>"
                   name="<?php echo $this->get_field_name('ckey'); ?>"
                   type="text" value="<?php echo $instance['ckey']; ?>" />
         </p>
         <p><label for="<?php echo $this->get_field_id('Consumer Secret'); ?>"><?php _e('Consumer Secret:'); ?></label>
            <input class="widefat"
                   id="<?php echo $this->get_field_id('csecret'); ?>"
                   name="<?php echo $this->get_field_name('csecret'); ?>"
                   type="text" value="<?php echo $instance['csecret']; ?>" />
         </p>
      </div>

      <p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of entries to display:'); ?></label>
         <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
      <p><label for="<?php echo $this->get_field_id('sources'); ?>"><?php _e('Sources (one per line) :'); ?></label>
         <textarea id="<?php echo $this->get_field_id('sources'); ?>" name="<?php echo $this->get_field_name('sources'); ?>" rows="10"><?php echo @$instance['sources']; ?></textarea></p>
   <?php
   }

   function registerSelf() {
      register_widget( __CLASS__ );
   }
}

add_action( 'init', array( 'HV_Twitter_Widget', 'registerSelf' ), 0 );