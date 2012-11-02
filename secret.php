<?php 

session_start();

if(isset($_SESSION['inloggad']))
{
		if (!$_SESSION['inloggad'] == "japp")
		{
			echo "Sidan kräver en inloggning";
			die(;)
		}
		else 
		{
			echo "Du måste logga in!";
			die();
		}		
		
}
 ?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title></title>
</head>
<body>
<h1>Du är nu på ett hemligt ställe.</h1>
</body>
</html>

