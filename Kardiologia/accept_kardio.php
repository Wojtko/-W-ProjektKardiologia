<?php 
	session_start();

	if (!isset($_SESSION['zalogowany']) || $_SESSION['ranga'] == 0)
	{
		header('Location: index.php');
		exit();
	}

	require_once "connect.php";

	$mysqli = @new mysqli($host, $db_login, $db_password, $dbname);

	$email = $_POST['email'];
	$dec = $_POST['dec'];


	if($dec == "accept")
	{
		if(@$mysqli->query(
			sprintf("UPDATE `users` SET  ranga='0', first_time='0' WHERE email='%s'",
			mysqli_real_escape_string($mysqli, $email))))
		{

			$to = $email;
			$subject = 'Potwierdzenie rejestracji';
			$message = '
			<!DOCTYPE html>
			<html lang="pl">
			<head>
				<meta charset="UTF-8">
				<title>Potwierdzenie rejestracji</title>

				<meta name="descricption" content="Portal ułatwiający kontakt pomiędzy lekarzami, a chirurgami."/>
				<meta name="keywords" content="lekarze, kariochirurg, kardiolog, pacjent, choroba, serce, medycyna">
				<meta http-equiv = "X-UA-Compatible" content = "IE=edge,chrome=1" type = "text/css"/>

			</head>
			<body>
				<h1>Witamy!</h1> <br><br>

				Chcieliśmy ciebie poinformować o poztywnym rozpoatrzeniu twojej prośby o przyjęcie do portalu kardiologicznego! <br>
				<a href="localhost/kardiologia">BEZPOREDNI LINK</a> <br><br>

				Pozdrawiamy, <br>
				Ekipa Portalu Kardiologicznego 
		
			</body>
			</html>';
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			$headers .= 'From: portal.kardiologicznyno-reply@gmail.com' . "\r\n" .
			    'Reply-To: portal.kardiologicznyno-reply@gmail.com' . "\r\n" .
			    'X-Mailer: PHP/' . phpversion();

			if(mail($to, $subject, $message, $headers) == TRUE)
			{
					$_SESSION['succes'] = '<span style="color:green">Dodano nowego użytkownika!</span><br>';
					unset($_SESSION['errorreg']);
					header('Location: administrator_kardio.php');
					exit();
			}
			else
			{
				$_SESSION['error'] = '<span style="color:red">Nie udało się wysłać maila!</span><br>';
				header('Location: administrator_kardio.php');
				exit();
			}
		}
		else
		{
			$_SESSION['error'] = '<span style="color:red">Nie udało się wprowadzić danych do bazy!</span><br>';
			header('Location: administrator_kardio.php');
			exit();
		}
	}
	else
	{
		if(@$mysqli->query(
			sprintf("DELETE FROM `users` WHERE email='%s'",
			mysqli_real_escape_string($mysqli, $email))))
		{
			$to = $email;
			$subject = 'Potwierdzenie rejestracji';
			$message = '
			<!DOCTYPE html>
			<html lang="pl">
			<head>
				<meta charset="UTF-8">
				<title>Potwierdzenie rejestracji</title>

				<meta name="descricption" content="Portal ułatwiający kontakt pomiędzy lekarzami, a chirurgami."/>
				<meta name="keywords" content="lekarze, kariochirurg, kardiolog, pacjent, choroba, serce, medycyna">
				<meta http-equiv = "X-UA-Compatible" content = "IE=edge,chrome=1" type = "text/css"/>

			</head>
			<body>
				<h1>Witamy!</h1> <br><br>

				Chcieliśmy ciebie poinformować o negatywnym rozpoatrzeniu twojej prośby o przyjęcie do portalu kardiologicznego! <br>
				<br><br>

				Pozdrawiamy, <br>
				Ekipa Portalu Kardiologicznego 
		
			</body>
			</html>';
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			$headers .= 'From: portal.kardiologicznyno-reply@gmail.com' . "\r\n" .
			    'Reply-To: portal.kardiologicznyno-reply@gmail.com' . "\r\n" .
			    'X-Mailer: PHP/' . phpversion();

			if(mail($to, $subject, $message, $headers) == TRUE)
			{
					$_SESSION['succes'] = '<span style="color:green">Usunięto petenta z listy!</span><br>';
					unset($_SESSION['errorreg']);
					header('Location: administrator_kardio.php');
					exit();
			}
			else
			{
				$_SESSION['error'] = '<span style="color:red">Nie udało się wysłać maila!</span><br>';
				header('Location: administrator_kardio.php');
				exit();
			}
		}
		else
		{
			$_SESSION['error'] = '<span style="color:red">Nie udało się wprowadzić danych do bazy!</span><br>';
			header('Location: administrator_kardio.php');
			exit();
		}
	}


 ?>
