<?php 
	session_start();
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

	<div class="main">
		
			
			<h1>Rejestracja</h1>

			<br/><br/>
			
			<div class="table">
				<form action="do_regist.php" method="post">
					<table>
						<thead>
							<tr>
								<th><b>Imię:</b></th>
								<th><b>Nazwisko:</b></th>
							</tr>
							<tr>
								<th>
									<input type="text" name="name">
								</th>
								<th>
									<input type="text" name="surname">
								</th>
							</tr>
							<tr>
								<th colspan="2"><b>Email:</b></th>
							</tr>
							<tr>
								<th colspan="2"> 
									<input type="email" name="email">
								</th>
							</tr>
							<tr>
								<th colspan="2"><b>Pesel:</b></th>
							</tr>
							<tr>
								<th colspan="2">
									<input type="text" name="pesel"><br>
								</th>
							</tr>
							<tr>
								<th colspan="2"><b>Numer prawa wykonywania zawodu</b></th>
							</tr>
							<tr>
								<th colspan="2">
									<input type="text" name="nrp">
								</th>
							</tr>
							<tr>
								<th colspan="2"><b>Nazwa placówki</b></th>
							</tr>
							<tr>
								<th colspan="2"> 
									<input type="text" name="institution">
								</th>
							</tr>
						</thead>
					</table>
					<?php
						if(isset($_SESSION['errorreg']))	echo $_SESSION['errorreg'];
						if(isset($_SESSION['succes']))	echo $_SESSION['succes'];
						unset($_SESSION['succes']);
						unset($_SESSION['errorreg']);
					?>

					<input type="submit" value="Wyślij zgłoszenie">
					<br><br><a href="index.php">Powrót do storny głównej</a>

				</form>
			</div>
		</form>
	</div>
	
</body>
</html>
