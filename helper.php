<?php
$data=json_decode(file_get_contents("https://raw.githubusercontent.com/RiedleroD/StrangeMatter_Portfolio/data/data.json"),true,512,JSON_THROW_ON_ERROR);

function escape($text){
	return str_replace("\n","<br/>",htmlentities($text));
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
function generate_favicon($img){
	if(is_array($img)){
		$out="";
		foreach($img as $src){
			$out.=generate_favicon($src);
		}
		return $out;
	}else{
		$mime=get_mime_from_ext($img);
		$src=parse_source($img);
		return "<link rel=\"icon\" type=\"$mime\" href=\"$src\"/>";
	}
}
function picture_sources_from_array($arr){
	$out = "";
	foreach($arr as $src){
		$out.="<source srcset=\"".parse_source($src);
		$mime=get_mime_from_ext($src);
		if($mime!=null){
			$out.="\" type=\"$mime\"/>";
		}else{
			$out.="\"/>";
		};
	}
	return $out;
}
function get_mime_from_ext($src){
	$ext = end(explode('.',$src));
	switch($ext){
		case "jpg":
		case "jpeg":
			return "image/jpeg";
		case "png":
			return "image/png";
		case "webp":
			return "image/webp";
		case "avif":
			return "image/avif";
		default:
			return null;
	}
}
function build_navbar(){
	GLOBAL $data;
	$rand = rand(0,count($data["imgs"])-1);
	return "<nav><a href=\"./\">Home</a><a href=\"./gallery.php\">Gallery</a><a href=\"./collections.php\">Collections</a><a href=\"./view.php?id=$rand\">Random Image</a></nav>";
}
?>
