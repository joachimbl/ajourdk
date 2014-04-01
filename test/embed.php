<!DOCTYPE html>
<html>
<head>
	<title>Servertest</title>
</head>
<body>
	<p>IP: <?php echo $_SERVER['SERVER_ADDR']; ?></p>
	
	<?php
		$start = microtime(true);
		
		$images = glob('images/*');
		foreach($images as $image){
			$image = file_get_contents($image);
			echo '<img src="data:image/jpeg;base64,' . base64_encode($image) . '" alt="" />';
		}

		$time = microtime(true) - $start;
		
		printf ('<p>Indl&aelig;st p&aring; %f sekunder.</p>', $time);
	?>
</body>
</html>