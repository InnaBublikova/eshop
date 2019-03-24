<?php
	require "secure/session.inc.php";
	require "../inc/lib.inc.php";
	require "../inc/db.inc.php";
?>
<html>
<head>
	<title>Поступившие заказы</title>
</head>
<body>
<h1>Поступившие заказы:</h1>
<?php

?>
<hr>
<h2>Заказ номер: </h2>
<p><b>Заказчик</b>: </p>
<p><b>Email</b>: </p>
<p><b>Телефон</b>: </p>
<p><b>Адрес доставки</b>: </p>
<p><b>Дата размещения заказа</b>: </p>

<h3>Купленные товары:</h3>
<table border="1" cellpadding="5" cellspacing="0" width="90%">
<tr>
	<th>N п/п</th>
	<th>Название</th>
	<th>Автор</th>
	<th>Год издания</th>
	<th>Цена, грн.</th>
	<th>Количество</th>
</tr>


</table>
<p>Всего товаров в заказе на сумму: грн.</p>

</body>
</html>