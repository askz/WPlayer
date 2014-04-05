<?php
include('JSON.php');

/////
///
// retoune un table $music 
// $music[$i][0] = URL depuit la racine du serveur
// 			 [1] = URL d'accer pour le client
//			 [2] = array ID3 non fonctionnel
///
/////
function msearch(){
	$json = new Services_JSON();
	$root_url = $_SERVER['DOCUMENT_ROOT'] . "/wp-content/uploads/music";

	if ($folder = opendir($root_url)){
		for ($i = 0;($file = readdir($folder)) ==! false; $i){
			if ($file != "." && $file != ".."){
				$file = explode(".", $file);
				if ($file[1] == "mp3" || $file[1] == "wav" || $file[1] == "ogg"){
					$root_url = $root_url . "/" . $file[0] . "." . $file[1];
					$host_url = $_SERVER["HTTP_HOST"] . "/wp-content/uploads/music/" . $file[0] . "." . $file[1];
					
					$music[$i][0] = $root_url;
					$music[$i][1] = $host_url;
					$music[$i][2] = "tag";

					$i++;
				}
			}
		}
		$return = $json->encode($music);
		return $music;
	}else mkdir($root_url);
	return 0
}

/////
///
// 	mplaylist($tab, string) pour cree des playlist json
// 	$tab 	: simple dimension contien les url_host des music  (http://trashtube.it/wp-content/uploads/music/music1.mp3)
//  string 	: nom de la playlist
///
/////
function mplaylist($music, $name_pl){
	$json = new Services_JSON();
	$j_pl = $json->encode($music);

	if ($pl = fopen($_SERVER['DOCUMENT_ROOT'] . "wp-content/uploads/playlist/" . $name_pl .".json" ,"wb"))
		if (fwrite($pl, $j_pl))
			return 0;
	return 1;
}