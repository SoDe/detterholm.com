<?php
//För att ansluta till databasen via conn-file. Den ska egentligen ligga utanför www-mappen för att skydda informationen om databasen
require_once($_SERVER['DOCUMENT_ROOT']."/lib/conn.php"); 
require_once($_SERVER['DOCUMENT_ROOT'].'/lib/functions.php');


	// Om /index.php?catID=id, sätt $currentCatID till värdet av ID från GET. Annars blir $currentCatID null.
	if (isset($_GET['catID'])) {
		$currentCatID = (int)$_GET['catID'];
	} else {
		$currentCatID = null;
	}
	
	if (isset($_GET['id'])) { // detterholm.com/index.php?id=hej
		$get_id = (int)$_GET['id'];
	} else {
		$get_id = null;
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
	
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Sofia's galleri</title>

        <meta name="viewport" content="width=device-width; initial-scale=1.0; user-scalable=no" />
        <meta name="apple-mobile-web-app-capable" content="yes" />

        <!-- BlackBerry, Palm and others use the Handheld Friendly tag -->
        <meta name="HandheldFriendly" content="true" />

        <!-- Windows Mobile (and WP7?) use the MobileOptimized and cleartype values -->
        <meta name="MobileOptimized" content="width" />
        <meta http-equiv="cleartype" content="on" />

        <!-- Traditional browsers pick up the favicon.ico file -->
        <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />

        <!-- iOS devices plus many other browsers nowadays use these apple touch icon files 
        <link rel="apple-touch-icon" href="touch-icon-iphone.png" />
        <link rel="apple-touch-icon" sizes="72x72" href="touch-icon-ipad.png" />
        <link rel="apple-touch-icon" sizes="114x114" href="touch-icon-iphone4.png" />
        -->

        <!-- Tell Google that we're already on the mobile version -->
        <link rel="alternate" media="handheld" href="" />
        
		<link href="/lib/css/generic-mobile.css" rel="stylesheet" type="text/css">
	
	</head>
	<body>
		<div id="header"><a href="index.php"><h1>Sofia's Galleri</h1></a></div> 
		<div id="menycontainer">
			<ul id="meny">
					
					<?php displayCategorys ($currentCatID); ?>
					<li><a href='backend.php'>Admin</a></li>
			</ul>
					
		</div>
		
		<div id="content">
			<?php
				if (is_int($get_id)) {
					showOriginalImage($get_id);
				} else {
					createGallery($currentCatID);
				}
			?>
		</div> <!--End content-->
	</body>
</html>