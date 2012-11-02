<?php
	/*
	 * @page index.php
	 * Hämtar en speciell bild från databasen baserat på ID
	 */
	function showOriginalImage($id) {
		global $currentCatID;
		if ($id == 0) {
			// Visa galleri.
			createGallery($currentCatID);
			return;
		}
		global $dbConn;
		$id = mysqli_real_escape_string($dbConn, $id);
		$sql = sprintf("SELECT * FROM images WHERE imageID = %d", $id); 
		if ($result = mysqli_query($dbConn, $sql)) {
			if (mysqli_num_rows($result) == 1) {
				$row = mysqli_fetch_assoc($result);
				echo "<div>".$row['description']."</div>";
				echo "uppladdad ".$row['uploaded'];
				echo "<div><img src=\"/images/uploads/originals/".$row['imageName']."\" style=\"max-width: 1000px;\" alt=\"".$row['description']."\" /></div>";
			}
		}
	}
	
	/*
	 * @page index.php
	 * Skriver ut tillgängliga kategorier som länkar
	 */
	function displayCategorys($currentCatID)
	{
		global $dbConn;
		
		// Hämta catID och catname för att visa fram dem i menyn
		$sql = "SELECT catID, catname, description FROM category";
		
		$res = mysqli_query($dbConn, $sql);
		
		while ($row = mysqli_fetch_assoc($res) )
		{
			$catID = $row['catID'];
			$catname = $row['catname'];
									
				echo "<li><a href='index.php?catID=$catID'>$catname</a></li>";
				
		}
		
	}
	
	/*
	 * @page index.php
	 * Skapar ett thumbnail-galleri och ger möjligheten att välja kategori genom GET[catID]
	 */
	function createGallery($catId)
	{
		global $dbConn;
		if(is_int($catId))
		{
			$catId = mysqli_real_escape_string($dbConn, $catId);
			$sql = "SELECT imageName, imageID from images where category_id = $catId ORDER BY imageID DESC";
		}
		else
		{
			$sql = "SELECT imageName, imageID FROM images order by imageID DESC Limit 0, 20";
		}
		
		if ($res = mysqli_query($dbConn, $sql)) {
			if (mysqli_num_rows($res) > 0) {
				echo "<table>\n";
				echo "<tr>\n";
				$i=0;
				while ($row = mysqli_fetch_assoc($res)) {
					if ($i == 4) {
						echo "</tr><tr>\n";	
						$i=0;
					}
					echo "<td style=\"border: solid 0px #000;\">";
					echo "<a href=\"?catID=".$_GET['catID']."&amp;id=".$row['imageID']."\"><img src=\"/images/uploads/thumbs/".$row['imageName']."\" alt=\"Beskrivning\" /></a>";
					echo "</td>\n";
					$i++;
				}
				echo "</tr>\n";
				echo "</table>";
			} else {
				echo "Inga bilder i den här kategorin!";
			}
		} else {
			echo "Problems!: ".mysqli_error($dbConn);
		}
		
		
	}//end function
	
	
	/*
	 * @page backend.php
	 * Skapar en thumbnil från den uppladdade filen.
	 */
	 function make_thumb($src,$dest,$desired_width, $mime=null)
	{
		/* read the source image */ 
		if ($mime == 'image/jpeg') {
			$source_image = imagecreatefromjpeg($src);
		} elseif ($mime == 'image/png') {
			$source_image = imagecreatefrompng($src);
		} elseif ($mime == 'image/gif') {
			$source_image = imagecreatefromgif($src);
		} else {
			// echo "Only jpeg, png and gif are allowed";
			return false;
		}
		$width = imagesx($source_image);
		$height = imagesy($source_image);
	 
		/* find the "desired height" of this thumbnail, relative to the desired width  */
		$desired_height = floor($height*($desired_width/$width));
	 
		/* create a new, "virtual" image */
		$virtual_image = imagecreatetruecolor($desired_width,$desired_height);
	 
		/* copy source image at a resized size */
		imagecopyresized($virtual_image,$source_image,0,0,0,0,$desired_width,$desired_height,$width,$height);
	 
		/* create the physical thumbnail image to its destination */
		imagejpeg($virtual_image,$dest, 83);
		
		return true;
	}
	
	/*
	 * @page backend.php
	 * Sparar image-data till databasen efter en lyckad uppladdning.
	 */
	function saveImgNameToDB($imgName)
	{
	
		global $dbConn;
		
		$description = $_POST['description'];
		$description = htmlentities($description);
		$description = mysqli_real_escape_string($dbConn, $description);
		
		$cat_id = (int)$_POST['category'];
		$cat_id = mysqli_real_escape_string($dbConn, $cat_id);
		
		
		$imgName= htmlentities($imgName);
		$imgName = mysqli_real_escape_string($dbConn, $imgName);
		
		$sql = "INSERT INTO images (description, imageName, uploaded, category_id) VALUES ('$description', '$imgName', NOW() , $cat_id)";
		mysqli_query($dbConn, $sql);
		
		//echo "Du sparade $imgName. ";
	
	}
	
	/*
	 * @page backend.php
	 * Validerar fil-typen.
	 */
	function validateImage($img=null)
	{
		$ext = pathinfo($img, PATHINFO_EXTENSION); // Extraherar filändelsen (jpg)
		$allowedFormats = array ("jpeg", "jpg", "png", "gif");
		if (in_array($ext, $allowedFormats)) {
			return true;
		}
		return false;
	}
	
	
	/*
	 * @page backend.php
	 * Laddar upp bilden
	 */
	function saveUploadedImage($arr=Array()) {
		$dest_orig = substr(md5(rand(0,1000).$dest_orig), 5, 6)."_".$arr['name'];
		$dest_orig = $_SERVER['DOCUMENT_ROOT']."/images/uploads/originals/".$dest_orig;
		$dest_thumb = $_SERVER['DOCUMENT_ROOT']."/images/uploads/thumbs/".basename($dest_orig);

				if (move_uploaded_file($arr['tmp_name'],  $dest_orig))
				{
					$mime = $arr['type']; // eg. image/jpeg
					
					if (make_thumb($dest_orig, $dest_thumb,200, $mime)) {
						// Nu returnerade "make_thumb" true, då vet vi att allt gick bra.
						saveImgNameToDB (basename($dest_orig));
						echo "Filen laddades upp";
					} else {
						// False, någonting gick fel, t.ex. mime-typen.
						echo "Kunde inte skapa thumbnail, filuppladdningen misslyckades.";
					}
					
				}
	}
	
	/*
	 * @page backend.php / login
	 * Om uppgifterna stämmer så loggas användaren in.
	 */
	 function do_login() {
	 	
		
	 	if (isset($_POST['username']) && isset($_POST['passwd'])) {
	 		global $dbConn;
			$username = mysqli_real_escape_string($dbConn, $_POST['username']);
			$passwd = mysqli_real_escape_string($dbConn, $_POST['passwd']);
			$sql = sprintf("SELECT id FROM login WHERE username='%s' AND pass=MD5('%s')", $username, $passwd);
			if ($result = mysqli_query($dbConn, $sql)) {
				if (mysqli_num_rows($result)) {
					$_SESSION['admin'] = True;
				} else {
					$_SESSION['message'] = 'Fel uppgifter, försök igen';
				}
			}
	 	}
	 }
	 
	 /*
	  * @page backend.php / logout
	  * Japp, användaren loggas ut. :)
	  */
		function do_logout() {
			$_SESSION['admin'] = false;
			$_SESSION['message'] = "Nu är du utloggad!";
			header('Location: index.php');
		}
