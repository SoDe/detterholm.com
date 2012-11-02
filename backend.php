<?php
	session_start();
require_once("lib/conn.php");
require_once('lib/functions.php');

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
	   	<link href="css/style.css" rel="stylesheet" type="text/css">
	 	<title>Backend</title>
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
		require_once('lib/backend/login.php');
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