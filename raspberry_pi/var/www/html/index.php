<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Game Boy Camera Photos</title>
	<style>
		body {font-family: Helvetica, sans-serif;}
		div .dump 
		{
			margin:1em;
			padding:1em;
			border: 2px solid black;
			background-color: yellow;
		}
		img {width:45%;}
		
		@media (min-width: 576px) { img {width: 200px;} }
	</style>
</head>
<body>
	<h1>Game Boy Camera Photos</h1>

	<div id="photos">
<?php
	$files = glob('./photos/*/*.bmp', GLOB_BRACE);
	
	$albums = array();
	
	foreach($files as $photo)
	{
		$path = explode("/",$photo);
		$albums[$path[2]][explode(".",$path[3])[0]] = $photo;
	}
	
	krsort($albums); // sort albums in reverse order

	foreach($albums as $title=>$photos)
	{
		krsort($photos, SORT_NUMERIC);
		echo"<div class=\"dump\">";
		foreach($photos as $num=>$photo)
		{
			echo "<a download='".$num.".bmp' href='".$photo."'><img src='".$photo."'></a> \n";
		}
		
		echo "</div><hr>";
	}
?>
	</div>
	
	<p>if your photos arent visible below, or in the <a href="/photos">photos folder</a>, then run the extraction again</p>
	<p><a href="/extract.php">Extract</a></p>
</body>
</html>
