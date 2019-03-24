<?
$title = 'Авторизация';
$user  = '';
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>Авторизация</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
</head>
<body>
	<h1><?= $title?></h1>
	<form action="<?= $_SERVER['REQUEST_URI']?>" method="post">
		<div>
			<label for="txtUser">Логин</label>
			<input id="txtUser" type="text" name="user" value="<?= $user?>" />
		</div>
		<div>
			<label for="txtString">Пароль</label>
			<input id="txtString" type="text" name="pw" />
		</div>
		<div>
			<button type="submit">Войти</button>
		</div>	
	</form>
</body>
</html>