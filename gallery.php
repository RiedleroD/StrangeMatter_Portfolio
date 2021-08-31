<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"/>
		<?php
			include("helper.php");
			echo generate_favicon($img["pfp"]);
		?>
		<title>StrangeMatter: Gallery</title>
		<style>
			@import "./global.css";
			@import "./gallery.css";
			h2{display:inline-block;}
			i{margin-left:0.3em}
			i::before{content:"("}
			i::after{content:")"}
		</style>
	</head>
	<body>
		<?php
		echo build_navbar();
		$filter = $_GET["c"];
		if($filter==null){
			$filter="all";
		}
		?>
		<main>
			<?php
				echo "<h2>Gallery</h2><i>$filter</i><br/>";
				$i=count($data["imgs"]);
				foreach($data["imgs"] as list($title,$preview,$postview,$collections,$desc)){
					$i--;
					if($filter=="all" or in_array($filter,$collections,true)){
						echo "<a href=\"./view.php?id=$i\">".generate_picture($preview)."<span>$title</span></a>";
					}
				}
			?>
		</main>
	</body>
</html>