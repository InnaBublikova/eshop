<?
require_once "session.inc.php";
require_once "secure.inc.php";
?>
<!DOCTYPE HTML">

<html>
<head>
	<title>Хеширование SHA-1</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
</head>

<body>
<h1>Хеширование SHA-1</h1>
<?
$user = 'root';
$string = '1234';
$salt = '';
$iterationCount = 100;
$result = '';

if (!$salt)
	$salt = str_replace('=', '', base64_encode(md5(microtime() . '1FD37EAA5ED9425683326EA68DCD0E59')));

if ($_SERVER['REQUEST_METHOD']=='POST'){
	$user = $_POST['user'] ?: $user;
	if(!userExists($user)){
		$string = $_POST['string'] ?: $string;
		$salt = $_POST['salt'] ?: $salt;
		$iterationCount = (int) $_POST['n'] ?: $iterationCount;
		$result = getHash($string, $salt, $iterationCount);
		$result = 'Хеш '. $result. ' успешно добавлен в файл';
		if(saveHash($user, $result, $salt, $iterationCount))
			$result = 'Хеш '. $result. ' успешно добавлен в файл';
		else
			$result = 'При записи хеша '. $result. ' произошла ошибка';
	}else{
		$result = "Пользователь $user уже существует. Выберите другое имя.";
	}
}
?>
<h3><?= $result?></h3>
<form action="<?= $_SERVER['PHP_SELF']?>" method="post">
	<div>
		<label for="txtUser">Логин</label>
		<input id="txtUser" type="text" name="user" value="<?= $user?>" style="width:40em"/>
	</div>
	<div>
		<label for="txtString">Пароль</label>
		<input id="txtString" type="text" name="string" value="<?= $string?>" style="width:40em"/>
	</div>
	<div>
		<label for="txtSalt">Соль</label>
		<input id="txtSalt" type="text" name="salt" value="<?= $salt?>"  style="width:40em"/>
	</div>	
	<div>
		<label for="txtIterationCount">Число иттераций</label>
		<input id="txtIterationCount" type="text" name="n" value="<?= $iterationCount?>"  style="width:4em"/>
	</div>		
	<div>
		<button type="submit">Создать</button>
	</div>	
</form>
</body>
</html>