<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"/>
		<title>StrangeMatter: Collections</title>
		<style>
			@import "./global.css";
			@import "./gallery.css";
		</style>
	</head>
	<body>
		<?php
			include("navbar.php");
		?>
		<main>
			<h2>Collections</h2>
			<?php
				$firstimg=$data["imgs"][0][1];
				$firstimg_parsed=parse_source($firstimg);
				echo "<a href=\"./gallery.php\"><img src=\"$firstimg_parsed\"/><span>All drawings</span></a>";
				$seen_collections=array();
				foreach($data["imgs"] as list($title,$preview,$postview,$collections,$desc)){
					foreach($collections as $collection){
						if(array_key_exists($collection,$seen_collections)){
							array_push($seen_collections[$collection],$preview);
						}else{
							$seen_collections[$collection]=array($preview);
						}
					}
				}
				$seen_previews=array($firstimg);
				foreach($seen_collections as $collection => $previews){
					do{
						$preview=array_shift($previews);
					}while(count($previews)>0 and in_array($preview,$seen_previews));
					array_push($seen_previews,$preview);
					$preview=parse_source($preview);
					echo "<a href=\"./gallery.php?c=$collection\"><img src=\"$preview\"/><span>$collection</span></a>";
				}
			?>
		</main>
	</body>
</html>