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
    
    $widget = array('classname' => 'WPlayer',
    				'description' => 'Audio/(Video soon) Player widget' );

    $this->WP_Widget('WPlayer', 'Audio/(Video soon) Player', $widget);

    $this->WPlayer = new WPlayer_Plugin();

  }
 
  function form($instance)
  {
    $instance 	= wp_parse_args(   (array) $instance, 
    								array( 	'title' 	=> '',
    										'volume' 	=> '50',		
											'i_song'    => array(	'title' => '',
		    														'artist'=> '',
		    														'path'	=> ''),

										 	'playlist' 	=> array(	'title' => '',
										 					 	    'id' 	=> ''),
				 							'autoplay' 	=> false
				 							)
    			);

	$title 		= $instance['title'];
	$i_song		= $instance['song'];
    $playlist 	= $instance['playlist'];
    $ap 		= $instance['autoplay'];
    $volume 	= $instance['volume'];
    $upload_dir = wp_upload_dir();
    $upload_dir['baseurl'] = $upload_baseurl;
  	$songs 		= $this->WPlayer->tools->search_music_in($upload_baseurl);


	?>

	<p><?php print_r($songs); ?></p>
	<p><label for="<?php echo $this->get_field_id('title'); ?>">
		Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" 
					name="<?php echo $this->get_field_name('title'); ?>" 
					type="text" 
					value="<?php echo attribute_escape($title); ?>" >
	</label></p>

	<label for="<?php echo $this->get_field_id('select'); ?>">
		Song :	
	</label>

	<select name="<?php echo $this->get_field_name('song'); ?>" 
			id="<?php echo $this->get_field_id('song'); ?>" 
			class="widefat">
		<?php
		
		foreach ($songs as $song =>	$path) {
			echo 	'<option 	value=" '.$song.' "
								id=" '.$song.' " ',
								$i_song['title'] == $song ? ' selected="selected"' : '', '>', 
								$song, 
				 	'</option>';
		}
		?>
	</select>
	<p>
	<label 	for="wpl_autoplay">Auto-play : </label>
	<input 	id="wpl_autoplay" 
			name="wpl_autoplay" 
			type="checkbox" 
			value="1">
	<label 	for="wpl_volume" >Volume : </label>
	<input 	id="wpl_volume" 
			type="text" 
			placeholder="Vol." 
			maxlenght="3" 
			size="3"
			value="<?php echo attribute_escape($volume); ?>">
	
	</p>
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
 	
 	//WIDGET CODE :)
    include plugin_dir_path( __FILE__ ) . "/WPlayer/player.html";
 
    echo $after_widget;

  }
 
}