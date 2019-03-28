<?php
	// подключение библиотек
	require "inc/lib.inc.php";
	require "inc/db.inc.php";
	$id=abs((int)$_GET['put']);
		add2Basket($id);
		header("Location: catalog.php");
	exit;
	
?>