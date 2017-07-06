<?php 
	session_start();

	if (!isset($_SESSION['zalogowany']))
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

	$name = $_POST['name'];
	$surname = $_POST['surname'];
	$birth = $_POST['birth'];
	$street = $_POST['adress1'];
	$town = $_POST['adress2'];
	$description = $_POST['desc'];
	$code = random_str(4);
	$filepath = $code . ".jpg";

	$name = htmlentities($name, ENT_QUOTES, "UTF-8");
	$surname = htmlentities($surname, ENT_QUOTES, "UTF-8"); 
	$email = htmlentities($email, ENT_QUOTES, "UTF-8");
	$street = htmlentities($street, ENT_QUOTES, "UTF-8");
	$town = htmlentities($town, ENT_QUOTES, "UTF-8");
	$description = htmlentities($description, ENT_QUOTES, "UTF-8");

	$newrec = sprintf("INSERT INTO `patients`(`name`, `surname`, `birth`, `street`, `town`, `description`, `filename`, `status`, `code`) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '0', '%s')",
		mysqli_real_escape_string($mysqli, $name),
		mysqli_real_escape_string($mysqli, $surname),
		mysqli_real_escape_string($mysqli, $birth),
		mysqli_real_escape_string($mysqli, $street),
		mysqli_real_escape_string($mysqli, $town),
		mysqli_real_escape_string($mysqli, $description),
		$filepath,
		$code);

	if (@$mysqli->query($newrec))
	{
		$_SESSION['succes'] = '<span style="color:green">Zgłoszenie zostało przyjęte</span><br>';
		unset($_SESSION['errorreg']);
		header('Location: kardio_submit.php');
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
?>
