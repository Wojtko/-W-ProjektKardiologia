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
			<li><a href="administrator_kardio.php" class="active">Kardiolodzy</a></li>
			<li><a href="administrator_patients.php">Pacjenci</a></li>
			<li style="float:right">
			<?php 
				echo '<a href="logout.php">Wyloguj ('.$_SESSION['name']." ".$_SESSION['surname'].")</a>";
			?>
			</li>
		</ul>
	</div>

	<div class="main">

		<div>
			<h3>Kardiolodzy oczekujący na przyjęcie</h3>

			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="find">
				<input type="text" name="value">
				<input type="submit" value="Szukaj">
			</form>
			<br>
				<?php 
					if(isset($_SESSION['errorreg']))	echo $_SESSION['errorreg'];
					if(isset($_SESSION['succes']))	echo $_SESSION['succes'];
					unset($_SESSION['succes']);
					unset($_SESSION['errorreg']);
				?>
		</div>
		

	<table>
		<thead>
<?php 

	require_once "connect.php";

	$search = '';
	if(isset($_POST['value']))$search = $_POST['value'];

	$mysqli = @new mysqli($host, $db_login, $db_password, $dbname);

	$ask = "SELECT * FROM `users` WHERE ranga=3";

	if(strlen($search) > 0)
	{
		$ask = "SELECT * FROM `users` WHERE ranga=3 AND `name` LIKE '". $search ."'";
	}

	if($result = @$mysqli->query($ask))
	{
		$how_many_results = $result->num_rows;

		if($how_many_results > 0)
		{
			$temp = 1;

			while($row = $result->fetch_assoc())
			{
					echo '
					<tr>
						<th>
							<div class="btn" data-panelid="' . $temp . '">
								<table>
									<tr>
										<th><b>Imię: </b>' . $row['name'] . '</th>
										<th><b>Nazwisko: </b>' . $row['surname'] . '</th>
									</tr>
								</table>
							</div>

							<div class="data" id="data' . $temp . '">
								<table>
									<thead>
										<tr>
											<th>
												<b>Email:</b>
											</th>
											<th>
												' . $row['email'] . '
											</th>
										</tr>
										<tr>
											<th>
												<b>Pesel:</b>
											</th>
											<th>
												' . $row['pesel'] . '
											</th>
										</tr>
										<tr>
											<th>
												<b>Nr.P. W. Z.:</b>
											</th>
											<th>
												' . $row['nrprawa'] . '
											</th>
										</tr>
										<tr>
											<th>
												<b>Nazwa placówki:</b>
											</th>
											<th>
												' . $row['place_name'] . '
											</th>
										</tr>
									</thead>
								</table>
									
								<form action="accept_kardio.php" method="post">
									<input type="radio" name="dec" value="accept">Zaakceptuj
									<input type="radio" name="dec" value="decline">Odrzuć<br>
									<input hidden type="text" name="email"  value="' . $row['email'] . '">
									<input type="submit" value="Potwierdź">
								</form>

							</div>
						</th>
					</tr>
				';

				$temp++;
			}
		}
	}

?>
			</thead>
		</table>

	</div>
	
</body>
</html>
