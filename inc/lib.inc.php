<?php
function clearString($link,$data){
	return mysqli_real_escape_string($link, trim(strip_tags($data)));
}
function clearInt($data) {
    return abs((int)$data);
}
function AddItemToCatalog ($link, $title, $author, $pubyear, $price){
	$sql = 'INSERT INTO catalog (title, author, pubyear, price) VALUES (?,?,?,?)';
	if (!$stmt = mysqli_prepare($link, $sql)) {
		return false;
	}
	else{
	mysqli_stmt_bind_param ($stmt, 'ssii', $title, $author, $pubyear, $price);
	mysqli_stmt_execute ($stmt);
	mysqli_stmt_close ($stmt);
	return true;
}
}
function selectAllItems ($link){//список книг(товара) в базе
	$sql = 'SELECT id,title,author,pubyear,price FROM catalog';
	if(!$result= mysqli_query($link, $sql)){
		return false;
	}
	else 
	$items = mysqli_fetch_all ($result, MYSQLI_ASSOC);
	mysqli_free_result ($result);
	return $items;
}

function saveBasket () {// сохраняем содержимое корзины в куки
	global $basket;
	$basket = base64_encode(serialize($basket));
	setcookie('basket', $basket, 0x7FFFFFFF);
}
function basketInit(){  // загружает в переменную $basket корзину с товарами
	global $basket,$count;
	if(!isset($_COOKIE['basket'])){
		$basket=array('orderid'=>uniqid());
		saveBasket();
	}else{
		$basket=unserialize(base64_decode($_COOKIE['basket']));
		$count=count($basket)-1;
	}
	}
function add2Basket($id){// добавляет товар в корзину
	global $basket;
	$basket[$id] = 1;
	saveBasket();
}
function myBasket(){ //возврат корзины ассоциативным массивом
	global $link,$basket;
	$goods=array_keys($basket);
	array_shift($goods);
	$ids=implode(",",$goods);
	$sql="SELECT id,title,author,title,pubyear,price FROM catalog WHERE id IN ($ids)";
	if(!$result=mysqli_query($link,$sql))
		return false;
	$items=result2Array($result);
	mysqli_free_result($result);
	return $items;
    }
function result2Array($data){ //принимает результат выполнения функции myBasket и возвращает ассоциативный массив товаров, дополненный их количеством
	global $basket;
	$arr=array();
	while($row=mysqli_fetch_assoc($data)){
		$row['quantity']=$basket[$row['id']];
		$arr[]=$row;
	}
	return $arr;
    }

function deleteItemFromBasket($id){// удаление товара из корзины
 	global $basket;
    unset($basket[$id]);
    saveBasket();
    }
function saveOrder($datetime,$orderid){// сохранение заказа
	global $link,$basket;
	$goods=myBasket();
	$stmt=mysqli_stmt_init($link);
	$sql="INSERT INTO orders (title,author,pubyear,price,quantity,orderid,datetime) VALUES (?,?,?,?,?,?,?)";
	if(!mysqli_stmt_prepare($stmt,$sql))
		return false;
	foreach ($goods as $item){
		mysqli_stmt_bind_param($stmt,"ssiiisi", $item['title'],$item['author'],$item['pubyear'],$item['price'],$item['quantity'],$orderid,$datetime);
		mysqli_stmt_execute($stmt);
		}
	mysqli_stmt_close($stmt);
	$basket=base64_encode(serialize($basket));
	setcookie('basket',$basket,time()-3600);
	return true;
    }
function getOrders(){//просмотр заказа
	global $link;
	if(!is_file("orders.log")){
		return false;}
		else{
	$orders=file("orders.log");
	$allorders=array();
	foreach ($orders as $order) {
		list($name,$email,$phone,$address,$orderid,$date)=explode("|",$order);
		$orderinfo=array();
		$orderinfo['name']=$name;
		$orderinfo['email']=$email;
		$orderinfo['phone']=$phone;
		$orderinfo['address']=$address;
		$orderinfo['orderid']=$orderid;
		$orderinfo['date']=$date;
		$sql="SELECT `title`, `author`, `pubyear`, `price`, `quantity`, `orderid`, `datetime` FROM `orders` WHERE orderid='$orderid' AND datetime='$date'";
		if(!$result=mysqli_query($link,$sql)){
			return false;}
		$items=mysqli_fetch_all($result,MYSQLI_ASSOC);
		mysqli_free_result($result);
		$orderinfo["goods"]=$items;
		$allorders[]=$orderinfo;}
	    }
	return $allorders;
    }




?>
