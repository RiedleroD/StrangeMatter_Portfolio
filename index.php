<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"/>
		<?php
			include("helper.php");
			echo generate_favicon($img["pfp"]);
		?>
		<title>StrangeMatter</title>
		<style>
@import "./global.css";
/*site-specific style*/
#main{
	display:flex;
	flex-direction:column;
}
#main>p{
	align-self:center;
	text-align:justify;
	width:50rem;
	text-align-last:center;
	-webkit-text-align-last:center;
}
img{
	margin-top:5em;
	width:16em;
	height:16em;
	border-radius:8em;
	filter:drop-shadow(0 0 0.3rem #000);
	align-self:center;
	background-color:#000;
}
img+span{
	font-size:3em;
	align-self:center;
	margin-bottom:3rem;
	text-shadow:0 0 0.3rem #000;
}
		</style>
	</head>
	<body>
		<?php
			echo build_navbar();
		?>
		<div id="main">
			<?php echo generate_picture($data["pfp"]) ?>
			<span>StrangeMatter</span>
			<p style="font-size:1.5em">
				<?php echo parse_desc($data["bio"]) ?>
			</p>
		</div>
	</body>
</html>
