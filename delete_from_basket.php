<?php
	// подключение библиотек
	require "inc/lib.inc.php";
	require "inc/db.inc.php";


$id=abs((int)$_GET['del']);
	deleteItemFromBasket($id);	
	header("Location: basket.php");
	exit;	
?>