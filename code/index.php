<?php
require("connect.php");
require("medListQuery.php");
require("sensorsQuery.php");
require("drawerStateQuery.php");
include "./templates/header.php";
include("medTimingGET.php");

?>

<br><br>
<!--TODO: se non c'è nulla incitare il vecchio ad aggiungere la roba-->
<div class="container" style="border:1px solid black;">
	<div class="row">
		<div class="col s6">
			<h2 id="txt"></h2>
		</div>
		<div id="ambient"> <?php $ambient = $resultSensori->fetch_assoc(); ?>
			<div class="col s3 humtempcol">
				<i><img class="humtempicon" src="src/humidity.png" width="40" height="40">
					<h5><?php echo $ambient["HUMIDITY"]. "%" ?></h5>
				</i>
			</div>
			<div class="col s3 humtempcol">
				<i><img class="humtempicon" src="src/thermometer.png" width="40" height="40">
					<h5><?php echo $ambient["TEMPERATURE"]. "°" ?></h5>
				</i>
			</div>
			<?php 
				$resultSensori-> free_result();
				#$conn -> close();
			?>
		</div>

	</div>
</div>
<?php 
	$rows = $result->fetch_all(MYSQLI_ASSOC);
	$meds = explode(';', medTimingGET()); 
?>
<div class="container mycontainer centered">
	<div class="row">

		<?php
		$i = 0;
		foreach ($rows as &$row) { ?>
			<?php echo '<div class="col s6">';
			$state = drawerStateQuery($i);
			require("templates/modelloMed.php");
			echo '</div>';
			$i++;
		} 	?>

	</div>
</div>
<?php
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
		$assunzioni = [];

		// Dati per la tabella medicine
		$nome = $_POST['nome'];
		$tipo = $_POST['tipo'];
		$quant = $_POST['quant'];
		$cassetto = $_POST['cassetto'];
		$durata = $_POST['durata'];
		if (isset($_POST['nomefoto'])){
			if ($_POST['nomefoto'] != NULL){
				$foto_data = file_get_contents($_FILES['foto']['tmp_name']);
			}
		}

		// Dati per la tabella assunzioni 
		$today = date('l');
		foreach ($days as $day){
			if (isset($_POST[$day])){
				if ($day == $today){
					$data = date('Y-m-d ') . $_POST['ora_'. $day] . ':00';
				} else {
					$data = date('Y-m-d ', strtotime('Next ' . $day)) . $_POST['ora_'. $day] . ':00';
				}
				$assunzioni[] = $data;
			}
		}

		// Controllo se è una modifica
		if (isset($_POST['nomeOld'])) {
			$sql_edit = "UPDATE medicine SET ID_MEDICINA='$nome', TYPE='$tipo', QUANTITY='$quant', NUM_CASSETTO='$cassetto', DURATA='$durata' WHERE ID_MEDICINA='{$_POST['nomeOld']}'";
			mysqli_query($conn, $sql_edit);

			$today = date('Y-m-d H:i:s');
			$sql_drop = "DELETE FROM assunzioni WHERE ID_MEDICINA='{$_POST['nomeOld']}' AND DATE_TIME > '$today'";
			mysqli_query($conn, $sql_drop);
		} else {
			// Salvataggio dati
			if ($_POST['nomefoto'] != NULL) {
				$sql_med = "INSERT INTO medicine (ID_MEDICINA, QUANTITY, FOTO, TYPE, DURATA, NUM_CASSETTO) VALUES (\"$nome\", $quant, '" . mysqli_escape_string($conn, $foto_data) . "', \"$tipo\", $durata, $cassetto);";
			} else {
				$sql_med = "INSERT INTO medicine (ID_MEDICINA, QUANTITY, FOTO, TYPE, DURATA, NUM_CASSETTO) VALUES (\"$nome\", $quant, NULL, \"$tipo\", $durata, $cassetto);";
			}
			mysqli_query($conn, $sql_med);
			
		}

		foreach ($assunzioni as $sass) {
			$sql_ass = "INSERT INTO assunzioni (DATE_TIME, STATO, ID_MEDICINA) VALUES ('$sass', '0', '$nome');";
			mysqli_query($conn, $sql_ass);
		}
		
		echo "<meta http-equiv='refresh' content='0'>";
	}
	include "./templates/footer.php";
?>