Du måste logga in!<br />
<form method="post" action="?do=login">
	<input type="text" name="username" />
	<input type="password" name="passwd" />
	<input type="submit" name="submit" value="Logga in" />
</form>

<?php echo $_SESSION['message']; ?>
