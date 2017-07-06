<?php 
	session_start();

	if (!isset($_SESSION['zalogowany']) || $_SESSION['ranga'] == 0)
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
			<li><a href="administrator_main.php">Główna</a></li>
			<li><a href="administrator_kardio.php">Kardiolodzy</a></li>
			<li><a href="administrator_patients.php" class="active">Pacjenci</a></li>
			<li style="float:right">
			<?php 
				echo '<a href="logout.php">Wyloguj ('.$_SESSION['name']." ".$_SESSION['surname'].")</a>";
			?>
			</li>
		</ul>
	</div>

	<div class="main">
		
		<div>
			<h3>Pacjenci oczekujący na zaakcpetowanie</h3>

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
									<th><b>Imię: </b>Jan</th> 
									<th><b>Nazwisko: </b>Kowalski</th>
								</tr>
							</table>
						</div>

						<div class="data" id="data1">
							<table>
								<thead>
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
									<tr>
										<th colspan="2">
											<b>Status:</b>

											<form action="accept_patient.php" method="post">
												<input type="submit" value="Zatwierdź">
											</form>
										</th>
									</tr>
								</thead>
							</table>
						</div>
					</th>
				</tr>
			</thead>
		</table>
	</div>
	
</body>
</html>
