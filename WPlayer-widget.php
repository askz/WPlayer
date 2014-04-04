<?php
/*
Plugin Name: WPlayer
Plugin URI: http://wplayer.askz.eu/
Description: Audio/(Video soon) Player to integrate in post + widget. Cool features are incoming in near future :)
Author: ApKA TEAM
Version: 0.1
Author URI: http://askz.eu/
*/


class WPlayer extends WP_Widget
{
  function WPlayer()
  {
    $widget_ops = array('classname' => 'WPlayer', 'description' => 'Audio/(Video soon) Player widget' );
    $this->WP_Widget('WPlayer', 'Audio/(Video soon) Player', $widget_ops);
  }
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
    $title = $instance['title'];
?>
  <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
  <select name="select">
	  <option value="value1">Valeur 1</option> 
	  <option value="value2">Valeur 2</option>
	  <option value="value3">Valeur 3</option>
  </select>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    return $instance;
  }
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
 
    echo $before_widget;
    $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
 
    if (!empty($title))
      echo $before_title . $title . $after_title;;
 
    // WIDGET CODE GOES HERE
    echo "<h1>This is my new widget!</h1>";
 
    echo $after_widget;
  }
 
}
add_action( 'widgets_init', create_function('', 'return register_widget("WPlayer");') );?>