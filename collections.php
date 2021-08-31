<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"/>
		<?php
			include("helper.php");
			echo generate_favicon($img["pfp"]);
		?>
		<title>StrangeMatter: Collections</title>
		<style>
			@import "./global.css";
			@import "./gallery.css";
		</style>
	</head>
	<body>
		<?php
			echo build_navbar();
		?>
		<main>
			<h2>Collections</h2>
			<?php
				$firstimg=generate_picture($data["imgs"][0][1]);
				echo "<a href=\"./gallery.php\">$firstimg<span>All drawings</span></a>";
				$i=0;
				$showcase=array();
				$usedcase=array(0 => 1);
				foreach($data["imgs"] as list($title,$preview,$postview,$tags,$desc)){
					foreach($tags as $tag){
						if(array_key_exists($tag,$showcase)){
							$j=$showcase[$tag];
							if(array_key_exists($i,$usedcase)){
								if($usedcase[$j]>$usedcase[$i]){
									$showcase[$tag]=$i;
									$usedcase[$i]++;
									$usedcase[$j]--;
								}
							}else{
								if($usedcase[$j]>1){
									$showcase[$tag]=$i;
									$usedcase[$i]=1;
									$usedcase[$j]--;
								}
							}
						}else{
							$showcase[$tag]=$i;
							if(array_key_exists($i,$usedcase)){
								$usedcase[$i]++;
							}else{
								$usedcase[$i]=1;
							}
						}
					}
					$i++;
				}
				unset($usedcase);
				foreach($showcase as $tag => $i){
					list($title,$preview,$postview,$tags,$desc)=$data["imgs"][$i];
					echo "<a href=\"./gallery.php?c=$tag\">".generate_picture($preview)."<span>$tag</span></a>";
				}
			?>
		</main>
	</body>
</html>