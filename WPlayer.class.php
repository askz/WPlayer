<?php

require_once plugin_dir_path ( __FILE__ ) . "WPlayer_Plugin.class.php";

/**
* WPlayer
*/
class WPlayer_Tools extends Wplayer_Plugin
{
	function __construct()
	{
		
	}

	function search_music_in($url)
	{
		
		if ($folder = opendir($url))
		{
			while (($file = readdir($folder)) ==! false)
			{
				if ($file != "." && $file != "..")
				{

					$filec = explode(".", $file);

					if ($file_cutd[1] == "mp3" || $file_cutd[1] == "wav" || $file_cutd[1] == "ogg")
					{

						$song 	=  $file_cutd[0].'.'.$file_cutd[1];
						$songs[$song] = $url ."/". $file_cutd[0] . "." . $file_cutd[1];
					}
					if(is_folder($url . '/' . $file))
						search_music_in($url . '/' . $file);
						
				}
			}
		}
		return $songs;
	}
}