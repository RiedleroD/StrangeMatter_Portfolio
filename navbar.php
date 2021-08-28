<nav>
	<a href="./">Home</a>
	<a href="./gallery.php">Gallery</a>
	<a href="./collections.php">Collections</a>
	<?php
		include("helper.php");
		$data = get_data();
		$rand = rand(0,count($data)-1);
		echo "<a href=\"./view.php?id=$rand\">Random Image</a>"
	?>
</nav>