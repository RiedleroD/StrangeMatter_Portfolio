<?php
function escape($text){
	return str_replace("\n","<br/>",htmlentities($text));
}
function get_data(){
	return json_decode(file_get_contents("https://raw.githubusercontent.com/RiedleroD/StrangeMatter_Portfolio/data/data.json"),true,512,JSON_THROW_ON_ERROR);
}
function parse_source($src){
	if($src[0] == '$'){
		return "https://raw.githubusercontent.com/RiedleroD/StrangeMatter_Portfolio/data/imgs/".urlencode(ltrim($src,'$'));
	}else{
		return $src;
	}
}
?>