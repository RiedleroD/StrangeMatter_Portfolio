<?php
function escape($text){
	return str_replace("\n","<br/>",htmlentities($text));
}
function get_data(){
	return json_decode(file_get_contents("https://raw.githubusercontent.com/RiedleroD/StrangeMatter_Portfolio/data/data.json"),true,512,JSON_THROW_ON_ERROR);
}
function parse_desc_text($desc){
	$desc=escape($desc);
	//links
	$desc=preg_replace("/\\[([^<>\\]]*)\\]\\(([^<>\\)]*)\\)/","<a href=\"\\2\">\\1</a>",$desc);
	//bold
	$desc=preg_replace("/\\*([^<>]*)\\*/","<b>\\1</b>",$desc);
	//italic
	$desc=preg_replace("/_([^<>]*)_/","<i>\\1</i>",$desc);
	return $desc;
}
function assemble_ul($p){
	$out="<ul>";
	foreach($p as $item){
		$out.="<li>".parse_desc_text($item)."</li>";
	}
	return $out."</ul>";
}
function assemble_aside($p){
	$out="<aside>";
	foreach($p as $key=>$val){
		if(is_array($val)){
			$val=assemble_ul($val);
		}else{
			$val=parse_desc_text($val);
		}
		$out.="<div>".parse_desc_text($key)."</div><div>$val</div>";
	}
	return $out."</aside>";
}
function parse_desc($desc){
	if(is_array($desc)){
		$out="";
		foreach($desc as $p){//paragraphs
			if(is_array($p)){
				if(is_int(array_keys($p)[0])){
					$out.=assemble_ul($p);
				}else{
					$out.=assemble_aside($p);
				}
			}else{
				$out.="<p>".parse_desc_text($p)."</p>";
			}
		}
		return $out;
	}else{
		return "<p>".parse_desc_text($desc)."</p>";
	}
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