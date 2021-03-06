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
			<li><a href="kardio_main.php" class="active">Główna</a></li>
			<li><a href="kardio_submit.php">Zgłoś</a></li>
			<li style="float:right">
			<?php 
				echo '<a href="logout.php">Wyloguj ('.$_SESSION['name']." ".$_SESSION['surname'].")</a>";
			?>
			</li>
		</ul>
	</div>

	<div class="main">

		<div>
			<h3>Status Pacjentów</h3>

			<form action="find_patient.php" method="post" class="find">
				<input type="text" name="value">
				<input type="submit" value="Szukaj">
			</form>
		</div>
		

		<table id="patient">
			<thead>
				<tr>
					<th>
						<div class="btn" data-panelid="1">
							<table>
								<tr>
									<th><b>Imię: </b>Maria</th>
									<th><b>Nazwisko: </b>Same</th>
									<th><b>Status: </b><b style="orange">Oczekiwanie</b></th>
								</tr>
							</table>
						</div>

						<div class="data" id="data1">
							<table>
								<tr>
									<th><b>Data urodzenia:</b></th>
									<th>12.06.1978</th>
								</tr>
								<tr>
									<th><b>Adres:</b></th>
									<th>ul.Wiejska 13 83-000 Gdańsk</th>
								</tr>
								<tr>
									<th><b>Ropoznanie:</b></th>
									<th>Chory ma niesprawne serce.</th>
								</tr>
								<tr>
									<th colspan="2">TU BĘDZIE MOŻNA POBRAĆ PLIK</th>
								</tr>
							</table>
						</div>
					</th>
				</tr>
			</thead>
		</table>
	</div>

</body>
</html>
