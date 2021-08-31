<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<?php
			include("helper.php");
			echo generate_favicon($data["favicon"]);
			$id=$_GET["id"];
			list($title,$preview,$postview,$collections,$desc)=$data["imgs"][(sizeof($data["imgs"])-$id)-1];
			$postview=parse_source($postview);
			//$preview=parse_source($preview); // not needed rn
			echo "<title>View: $title</title>";
		?>
		<style>
			@import "./global.css";
			/*site-specific style*/
			main{
				display:flex;
				flex-direction:column;
				align-items:center;
			}
			#topview{
				display:flex;
				flex-direction:row;
				justify-content:flex-start;
				align-items:flex-start;
				width:100%;
			}
			#imgview{
				background-color:#333;
				padding:0 1em 1em 1em;
				border-radius:0.3em;
				margin:0 0.5em 0.5em 0;
			}
			#imgview img{
				max-height:70vh;
				max-width:50vw;
				border-radius:0.3em;
			}
			#imgview>h2{
				text-align:center;
			}
			#tagntext{
				width:100%;
			}
			#tagntext>p{
				margin:0 0.5em 0 0;
				text-align:justify;
				text-align-last:left;
			}
			#tagntext ul{
				margin:0.2em 0.2em;
				padding-left:1em;
				text-align:left;
			}
			#tagntext>aside{
				display:inline-grid;
				grid-template-columns:auto auto;
				align-items:baseline;
				margin:1em 0 1em -1em;
				padding:0.3em 0.3em 0.3em 0.8em;
				border-radius:0.3em;
				background-color:#333;
			}
			#tagntext>aside>div{
				display:flex;
				padding:0 0.3em;
			}
			#tagntext>aside>div:nth-child(2n+1)::after{
				content:':';
			}
			#tagntext>aside>div:nth-child(2n+1){
				
			}
			#tagntext>aside>div:nth-child(2n){
				text-align:center;
				justify-content:center;
			}
			#tagbox{
				float:right;
				max-width:15em;
				background-color:#333;
				padding:0.3em;
				margin:0 0 0.5em 0.5em;
				border-radius:0.3em;
			}
			#tagbox>a,
			#tagbox>a:visited{
				display:inline-block;
				text-decoration:none;
				color:#CCC;
				border:solid 1px #379;
				background-color:#333;
				padding:0.1em 0.2em;
				margin:0.1em 0;
				border-radius:0.2em;
			}
			#tagbox>a:hover,
			#tagbox>a:visited:hover{
				color:#151515;
				border-color:#418BA5;
				background-color:#418BA5;
			}
		</style>
	</head>
	<body>
		<?php echo build_navbar() ?>
		<main>
			<div id="topview">
				<div id="imgview">
					<?php
						echo "<h2>$title</h2>".generate_picture($postview);
					?>
				</div>
				<div id="tagntext">
					<div id="tagbox">
						Image is in collections:<br/>
						<?php
							$nfirst=false;
							foreach($collections as $collection){
								if($nfirst){
									echo ', ';
								}
								echo "<a href=\"./gallery.php?c=$collection\">$collection</a>";
								$nfirst=true;
							}
						?>
					</div>
					<?php echo parse_desc($desc)?>
				</div>
			</div>
		</main>
	</body>
</html>
