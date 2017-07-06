<?php 
	session_start();

	require_once "connect.php";

	$mysqli = @new mysqli($host, $db_login, $db_password, $dbname);

	if($mysqli->connect_errno)
	{
		echo "Error";
		exit();
	}

	$regname = $_POST['name'];
	$regsurname = $_POST['surname'];
	$regemail = $_POST['email'];
	$regpesel = $_POST['pesel'];
	$regnrp = $_POST['nrp'];
	$reginstitution = $_POST['institution'];

	if((strlen($regpesel) != 11) || (strlen($regnrp) != 5) || (strlen($regname) == 0) || (strlen($regsurname) == 0) || (strlen($reginstitution) == 0))
	{
		$_SESSION['errorreg'] = '<span style="color:red">Wprowadzone dane są nieprawidłowe!</span><br>';
		header('Location: registration.php');
		exit();
	}

	$regname = htmlentities($regname, ENT_QUOTES, "UTF-8");
	$regsurname = htmlentities($regsurname, ENT_QUOTES, "UTF-8");
	$regemail = htmlentities($regemail, ENT_QUOTES, "UTF-8");
	$regpesel = htmlentities($regpesel, ENT_QUOTES, "UTF-8");
	$regnrp = htmlentities($regnrp, ENT_QUOTES, "UTF-8");
	$reginstitution = htmlentities($reginstitution, ENT_QUOTES, "UTF-8");
	$reglogin = random_str(6);
	$regpass = random_str(10);
	$regcode = random_str(4);
	$regrang = 2;
	$regfirst = 1;

	if($result = @$mysqli->query(
		sprintf("SELECT * FROM users WHERE email='%s' OR  pesel='%s' OR nrprawa='%s'", 
		mysqli_real_escape_string($mysqli,$regemail),
		mysqli_real_escape_string($mysqli,$regpesel),
		mysqli_real_escape_string($mysqli,$regnrp))))
	{
		$how_many_users = $result->num_rows;
		if($how_many_users > 0)
		{
			$_SESSION['errorreg'] = '<span style="color:red">Wprowadzone dane już figurują w naszej bazie!</span><br>';
			header('Location: registration.php');
			exit();
		}
	}

	$newrec = sprintf("INSERT INTO `users` (`name`, `surname`, `pesel`, `nrprawa`, `place_name`, `email`, `ranga`, `first_time`, `login`, `password`, `code`) VALUE ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')",
		mysqli_real_escape_string($mysqli, $regname),
		mysqli_real_escape_string($mysqli, $regsurname),
		mysqli_real_escape_string($mysqli, $regpesel),
		mysqli_real_escape_string($mysqli, $regnrp),
		mysqli_real_escape_string($mysqli, $reginstitution),
		mysqli_real_escape_string($mysqli, $regemail),
		$regrang,
		$regfirst,
		$reglogin,
		$regpass,
		$regcode);

	$to = (string)$regemail;
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
		<h1>Potwierdzenie rejsestracji</h1> <br>
		<p>Witamy na portalu kardiologiczym!</p> <br><br>

		Login : ' . $reglogin . ' <br>
		Hasło: ' . $regpass . ' <br><br>
		Kod aktywacyjny: ' . $regcode . ' <br><br><br>		
		Prosimy teraz zalogować się na swoje konto i podążać za informacjami tam podanymi. Link <a href="localhost/kardiologia">www.portalkardiologiczny.pl</a><br> <br>

		<p>Ekipa portalu kardio</p> 
		 
	</body>
	</html>';
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .= 'From: portal.kardiologiczny@gmail.com' . "\r\n" .
	    'Reply-To: portal.kardiologiczny@gmail.com' . "\r\n" .
	    'X-Mailer: PHP/' . phpversion();

	if((@$mysqli->query($newrec)) && (mail($to, $subject, $message, $headers) == TRUE))
	{
		$_SESSION['succes'] = '<span style="color:green">Wstępne przetwarzanie zostało zakończone pomyślnie! Teraz prosze sprawdzić swoją skrzynkę pocztową.</span><br>';
		unset($_SESSION['errorreg']);
		header('Location: registration.php');
		exit();
	}
	else
	{
		$_SESSION['errorreg'] = '<span style="color:red">Wystąpił błąd podczas przetwarzania zgoszenia. Prosze skontaktować się z administratorem.</span><br>';
		header('Location: registration.php');
		exit();
	}
	
	function random_str($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
	{
	    $str = '';
	    $max = mb_strlen($keyspace, '8bit') - 1;
	    for ($i = 0; $i < $length; ++$i) {
	        $str .= $keyspace[random_int(0, $max)];
    	}
    	return $str;
	}

	$mysqli->close();
?>
