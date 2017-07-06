<?php 
 
	session_start();

	if (isset($_SESSION['zalogowany']) && ($_SESSION['zalogowany'] == true)) 
	{
    	if($_SESSION['ranga'] == 1)
			{
				header('Location: administrator_main.php');
				exit();
			}
			else if ($_SESSION['first_time'] == 0)
			{
				header('Location: kardio_main.php');
				exit();
			}
			else
			{
				header('Location: kardio_main_first.php');
				exit();
			}
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

	<link rel="stylesheet" href="style.css">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

</head> 
<body>
	
	<h1>Portal Kardiologiczny SercMed</h1>

	<div class="main">
		<div class="login">
			<form action="login.php" method="post">
				Podaj login <br/>
				<input type="text" name="login"> <br/> <br/>
				Podaj hasło<br/>
				<input type="password" name="password"> <br/> <br/>
				<input type="submit" value="Zaloguj się"> <br/>
			</form>

			<?php
				if(isset($_SESSION['error']))	echo $_SESSION['error'];
			?>
			
			<br/> <a href="registration.php">Nie masz jeszcze konta? Zarejestruj się już dziś!</a>

		</div>
	</div>

</body>
</html>
