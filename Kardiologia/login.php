<?php 
	session_start();

	if ((!isset($_POST['login'])) || (!isset($_POST['password']))) 
	{
    	header('Location: index.php');
    	exit();
	}

	require_once "connect.php";

	$mysqli = @new mysqli($host, $db_login, $db_password, $dbname);

	if($mysqli->connect_errno) 
	{
		echo "Error";
		exit;
	}

	$login = $_POST['login'];
	$password = $_POST['password'];

	$login = htmlentities($login, ENT_QUOTES, "UTF-8");
	$password = htmlentities($password, ENT_QUOTES, "UTF-8");

	if($result = @$mysqli->query(
		sprintf("SELECT * FROM users WHERE login='%s' AND password='%s'", 
		mysqli_real_escape_string($mysqli,$login),
		mysqli_real_escape_string($mysqli,$password))))
	{
		$how_many_users = $result->num_rows;
		if($how_many_users > 0)
		{
			$_SESSION['zalogowany'] = true;

			$row = $result->fetch_assoc();
			$_SESSION['name'] = $row['name'];
			$_SESSION['surname'] = $row['surname'];
			$_SESSION['pesel'] = $row['pesel'];
			$_SESSION['nrprawa'] = $row['nrprawa'];
			$_SESSION['place_name'] = $row['place_name'];
			$_SESSION['email'] = $row['email'];
			$_SESSION['ranga'] = $row['ranga'];
			$_SESSION['first_time'] = $row['first_time'];
			$_SESSION['login'] = $row['login'];
			$_SESSION['password'] = $row['password'];
			$_SESSION['code'] = $row['code'];

			$result->free_result();
			unset($_SESSION['error']);

			if($_SESSION['ranga'] == 1)
			{
				header('Location: administrator_main.php');
			}
			else if ($_SESSION['first_time'] == 0)
			{
				header('Location: kardio_main.php');
			}
			else
			{
				header('Location: kardio_main_first.php');
			}
		}
		else
		{	
			$_SESSION['error'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';

			header('Location: index.php');
		}
	}

	$mysqli->close();
 ?>
