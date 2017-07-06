<?php 
	session_start();

	if (!isset($_SESSION['zalogowany']) || $_SESSION['ranga'] == 0)
	{
		header('Location: index.php');
		exit();
	}
	
	require_once "connect.php";

	$mysqli = @new mysqli($host, $db_login, $db_password, $dbname);

	if($mysqli->connect_errno)
	{
		echo "Error";
		exit();
	}

	$old = $_POST['old'];
	$new1 = $_POST['new1'];
	$new2 = $_POST['new2'];
	$code = $_POST['code'];

	if((strlen($old) == 0) || (strlen($new1) == 0) || (strlen($new2) == 0) || (strlen($code) == 0))
	{
		$_SESSION['errorreg'] = '<span style="color:red">Nie wprowadzono wszytkich potrzebnych danych!</span><br>';
		header('Location: kardio_main_first.php');
		exit();
	}

	$old = htmlentities($old, ENT_QUOTES, "UTF-8");
	$new1 = htmlentities($new1, ENT_QUOTES, "UTF-8");
	$new2 = htmlentities($new2, ENT_QUOTES, "UTF-8");
	$code = htmlentities($code, ENT_QUOTES, "UTF-8");

	if($result = @$mysqli->query(
		sprintf("SELECT * FROM `users` WHERE password='%s' AND code='%s'", 
		mysqli_real_escape_string($mysqli, $old),
		mysqli_real_escape_string($mysqli, $code))));
	{
		$how_many_users = $result->num_rows;
		if($how_many_users > 0 && $new1 == $new2)
		{
			if(@$mysqli->query(
				sprintf("UPDATE `users` SET password='%s', ranga = 3 WHERE code='%s'", 
				mysqli_real_escape_string($mysqli, $new1),
				mysqli_real_escape_string($mysqli, $code))))
			{
				$_SESSION['succes'] = '<span style="color:green">Pomyślnie potwierdzono rejestrację, proszę czekać na akceptacje zgłoszenia przez administratora.</span><br>';
				unset($_SESSION['errorreg']);
				header('Location: kardio_main_first.php');
				exit();
			}
			else
			{
				$_SESSION['errorreg'] = '<span style="color:red">Nie udało połączyć się serwerem</span><br>';
				header('Location: kardio_main_first.php');
				exit();
			}
		}
		else
			{
				$_SESSION['errorreg'] = '<span style="color:red">Wprowadzone dane są niepoprawne</span><br>';
				header('Location: kardio_main_first.php');
				exit();
			}
	}

	$result->free_result();
	$mysqli->close();
?>
