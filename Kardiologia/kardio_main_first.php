<?php 
	session_start();

	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}
?>

<!DOCTYPE html>
<html lang="pl">
<head>

	<meta charset="UTF-8">
	<title>Protal kardiologiczny</title>

	<meta name="descricption" content="Portal ułatwiający kontakt pomiędzy lekarzami, a chirurgami."/>
	<meta name="keywords" content="lekarze, kariochirurg, kardiolog, pacjent, choroba, serce, medycyna">
	<meta http-equiv = "X-UA-Compatible" content = "IE=edge,chrome=1" type = "text/css"/>

	<link rel="stylesheet" href="style_admi.css">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="admin_patient_data.js"></script>

</head> 
<body>
	<div>
		<ul id="test">
			<li><a href="#" class="active">Główna</a></li>
			<li><a href="#">Zgłoś</a></li>
			<li style="float:right">
			<?php 
				echo '<a href="logout.php">Wyloguj ('.$_SESSION['name']." ".$_SESSION['surname'].")</a>";
			?>
			</li>
		</ul>
	</div>

	<div class="main">
		
		<div class="warning">
			
			<h2>Przed skorzystaniem z portalu prosimy o zmianę hasła</h2>

			<form action="do_regist2.php" method="post">
				<p>Kod z rejestracji</p>
				<input type="text" name="code">

				<p>Stare hasło: </p>
				<input type="password" name="old">

				<p>Nowe hasło: </p>
				<input type="password" name="new1">

				<p>Powtórz hasło: </p>
				<input type="password" name="new2">
					
				<br>
				
				<?php
						if(isset($_SESSION['errorreg']))	echo $_SESSION['errorreg'];
						if(isset($_SESSION['succes']))	echo $_SESSION['succes'];
						unset($_SESSION['succes']);
						unset($_SESSION['errorreg']);
				?>

				<br>

				<input type="submit" value="Wyślij">
			</form>

		</div>
		
	</div>

</body>
</html>
