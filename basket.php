<?php
header('Content-Type: text/html; charset=utf-8');
	// подключение библиотек
	require "inc/lib.inc.php";
	require "inc/db.inc.php";
	?>
<html>
<head>
	<title>Корзина пользователя</title>
</head>
<body>
	<h1>Ваша корзина</h1>
<?php
if (myBasket()==false){
echo "<h1>Корзина пуста<h1>";
?>
<div align="left">
	<input type="button" value="Вернутся в каталог"
                      onClick="location.href='catalog.php'" />
</div>
<?php exit;
}
?>
<?php
myBasket();
$i=0; //порядковый номер
$sum=0; //общая сумма заказа
?>
<table border="1" cellpadding="5" cellspacing="0" width="100%">
<tr>
	<th>N п/п</th>
	<th>Название</th>
	<th>Автор</th>
	<th>Год издания</th>
	<th>Цена, грн.</th>
	<th>Количество</th>
	<th>Удалить</th>
</tr>
<?php
$goods2=myBasket();
foreach($goods2 as $item){
	$i++;
	$sum+=$item['price'];
	?>
	<tr>
		<td><?php echo $i ?></td>
		<td><?=$item['title']?></td>
		<td><?=$item['author']?></td>
		<td><?=$item['pubyear']?></td>
		<td><?=$item['price']?></td>
		<td><?php echo 1?></td>
		<td><a href="http://eshop/delete_from_basket.php?id=eshop&del=<?php echo $item['id'] ?> ">Удалить с корзины</a></td>
		
<?}	
?>
</table>

<p>Всего товаров в корзине на сумму: грн. <?php echo $sum?></p>

<div align="center">
	<input type="button" value="Оформить заказ!"
                      onClick="location.href='orderform.php'" />
</div>

</body>
</html>






