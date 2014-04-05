<?php
/*
Plugin Name: WPlayer
Plugin URI: http://wplayer.askz.eu/
Description: Audio/(Video soon) Player to integrate in post + widget. Cool features are incoming in near future :)
Version: 0.2
Author: ApKa Team
Author URI: http://URI_Of_The_Plugin_Author
License: A "Slug" license name e.g. GPL2
*/

require_once plugin_dir_path( __FILE__ ) . "class/WPlayer.class.php";

require_once plugin_dir_path( __FILE__ ) . "WPlayer-widget.php";

$tools = new WPlayer_Plugin();



// Hook into the 'admin_print_footer_scripts' action
add_action( 'admin_print_footer_scripts', 'embed_player_quicktag' );


?>