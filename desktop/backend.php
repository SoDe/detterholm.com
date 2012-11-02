<?php
	session_start();
require_once($_SERVER['DOCUMENT_ROOT']."/lib/conn.php");
require_once($_SERVER['DOCUMENT_ROOT']."/lib/functions.php");

	if (isset($_GET['do']) && $_GET['do'] == 'login') {
		do_login();
	} elseif (isset($_GET['do']) && $_GET['do'] == 'logout') {
		do_logout();
	}
?>
 
<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Sofia's galleri: Backend</title>

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
        
		<link href="/lib/css/desktop.css" rel="stylesheet" type="text/css">
</head>
		<body>
				<div id="header"><a href="index.php"><h1>Sofia's Galleri</h1></a></div>
				
					
				<div id="menycontainer">
  						<ul id="meny">
							<li><a href='index.php'>Hem</a></li>
							<li><a href='contact.php'>Kontakt</a></li>
							<li><a href="?do=logout">Logga ut</a></li>
						</ul>
							
				</div>
				<div id="content">
<?php
	if ($_SESSION['admin'] == True) {
		// Inloggad
?>
<div id="imgcontent">
					<form method="post" action="backend.php"  enctype="multipart/form-data">
					<input type="file" name="filen"><br>
					<textarea name="description" style="width:200px; height:100px;">Beskrivning</textarea><br>
						<select name="category">
							<?php
									$sql= "SELECT catID, catname FROM category";
									$res = mysqli_query($dbConn, $sql);
			
									while ($row = mysqli_fetch_assoc($res) )
									{
										$catID = $row['catID'];
										$catname = $row['catname'];
										
										echo '<option value=" ' . $catID . ' ">' . $catname . ' </option>';
									}
						

							?>
						</select><br>
					<input type="submit" value="spara bild">
					</form>
					</div>
<?php
	} else {
		require_once($_SERVER['DOCUMENT_ROOT'].'/lib/backend/login.php');
	}
?>
				</div>
		</body>

</html>	
<?php
		
	if (isset($_FILES['filen']) ) {
			if (validateImage($_FILES['filen']['name'])) {
				saveUploadedImage($_FILES['filen']);
			} else {
				echo "Filen inte godkänd";
			}
	}
?>