<?php
	header('Content-Type: text/html; charset=utf-8');
	require "inc/lib.inc.php";
	require "inc/db.inc.php";

reset($basket);

$orderid = current($basket);
if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = trim(strip_tags($_POST['name']));
        $email = trim(strip_tags($_POST['email']));
        $phone = trim(strip_tags($_POST['phone']));
        $address = trim(strip_tags($_POST['address']));
        $order=$name.'|'.$email.'|'.$phone.'|'.$address.'|'.$orderid.'|'.$datetime=time();
    }
$fp = fopen("orders.log", "a");
fwrite($fp, $order . PHP_EOL);
fclose($fp);
saveOrder($datetime,$orderid);
?>
<html>
<head>
	<title>Сохранение данных заказа</title>
</head>
<body>
	<p>Ваш заказ принят.</p>
	<p><a href="catalog.php">Вернуться в каталог товаров</a></p>
</body>
</html>