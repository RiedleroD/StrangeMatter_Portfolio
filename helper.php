<?php
function escape($text){
	return str_replace("\n","<br/>",htmlentities($text));
}
function get_data(){
	return json_decode(file_get_contents("https://raw.githubusercontent.com/RiedleroD/StrangeMatter_Portfolio/data/data.json"),true,512,JSON_THROW_ON_ERROR);
}
function parse_desc($desc){
	$desc=escape($desc);
	//lists
	$desc=preg_replace("/(<br\\/?>|^) - ([^<>]*)/","<li>\\2</li>",$desc);
	$desc=preg_replace("/((<li>[^<>]*<\\/li>)+)(<br\\/?>)?/","</p><ul>\\1</ul><p>",$desc);
	//links
	$desc=preg_replace("/\\[([^<>\\]]*)\\]\\(([^<>\\)]*)\\)/","<a href=\"\\2\">\\1</a>",$desc);
	//bold
	$desc=preg_replace("/\\*([^<>]*)\\*/","<b>\\1</b>",$desc);
	//italic
	$desc=preg_replace("/_([^<>]*)_/","<i>\\1</i>",$desc);
	return $desc;
}
function parse_source($src){
	if($src[0] == '$'){
		return "https://raw.githubusercontent.com/RiedleroD/StrangeMatter_Portfolio/data/imgs/".urlencode(ltrim($src,'$'));
	}else{
		return $src;
	}
}
function generate_picture($src){
	if(is_array($src)){
		return "<picture>".picture_sources_from_array($src)."<img/></picture>";
	}else{
		return "<img src=\"".parse_source($src)."\"/>";
	}
}
function picture_sources_from_array($arr){
	$out = "";
	foreach($arr as $src){
		$ext = explode('.',$src)[-1];
		$mime="\" type=\"image/";
		switch($ext){
			case "jpg":
			case "jpeg":
				$mime.="jpeg";
				break;
			case "png":
				$mime.="png";
				break;
			case "webp":
				$mime.="webp";
				break;
			case "avif":
				$mime.="avif";
				break;
			default:
				$mime="";
				break;
		}
		$out.="<source srcset=\"".parse_source($src).$mime."\"/>";
	}
	return $out;
}
?>