<!DOCTYPE html>
<html>
<head>
	<title>Servertest</title>
</head>
<body>
	<p>
		IP: <?php echo $_SERVER['SERVER_ADDR']; ?><br />
		<a href="info.php">PHP Info</a>
	</p>
	
	<?php		
		$images = glob('images/*');
		foreach($images as $image){
			echo '<img src="img.php?i=' . $image . '" alt="" />';
			flush();
		}
	?>
</body>
</html>