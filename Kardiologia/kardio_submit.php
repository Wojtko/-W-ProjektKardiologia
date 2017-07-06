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

	<link rel="stylesheet" href="style_pat.css">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="admin_patient_data.js"></script>

</head> 
<body>
	<div>
		<ul id="test">
			<li><a href="kardio_main.php">Główna</a></li>
			<li><a href="kardio_submit.php" class="active">Zgłoś</a></li>
			<li style="float:right">
			<?php 
				echo '<a href="logout.php">Wyloguj ('.$_SESSION['name']." ".$_SESSION['surname'].")</a>";
			?>
			</li>
		</ul>
	</div>

	<div class="table">
		<h3>Zgłoś pacjenta</h3>

		<form action="register_patient.php" method="post">
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
						<th colspan="2"><b>Data urodzenia(DD.MM.RRRR):</b></th>
					</tr>
					<tr>
						<th colspan="2">
							<input type="text" name="birth">
						</th>
					</tr>
					<tr>
						<th colspan="1"><b>Ulica i nr.: </b></th>
						<th colspan="1"><b>Kod pocz. i miejscowość:</b></th>
					</tr>
					<tr>
						<th colspan="1">
							<input type="text" name="adress1">
						</th>
						<th colspan="1">
							<input type="text" name="adress2">
						</th>
					</tr>
					<tr>
						<th colspan="2"><b>Rozpoznanie:</b></th>
					</tr>
					<tr>
						<th colspan="2">
							<input type="text" name="desc">
						</th>
					</tr>
					<tr>
						<th colspan="2"><b>PLIK</b></th>
					</tr>
					<tr>
						<th colspan="2">
							<input type="text">
						</th>
					</tr>
				</thead>
			</table>

			<input type="submit" value="Wyślij zgłoszenie">

		</form>
	</div> 
</body>
</html>
