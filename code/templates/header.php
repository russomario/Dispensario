<!DOCTYPE html>
<html lang="it">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<?php
	if ($_SERVER['REQUEST_URI'] == '/pilly/index.php' || $_SERVER['REQUEST_URI'] == '/pilly/' || $_SERVER['REQUEST_URI'] == '/pilly/storico.php')
		echo "
		<meta http-equiv=\"refresh\" content=\"50000\">
		" 
	?>
	<!--non riesco a fare il refresh solo dell'icona mentre ci sono riuscito con ambient-->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	<!--<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>-->
	<!--per mobile-->
	<style>
		.myform {
			margin-top: 100px;
			margin-left: 300px;
			margin-right: -300px;
		}

		.mylabel {
			font-size: 30px;
		}

		.myinput {
			margin-left: 15px !important;
		}

		.nomargin {
			margin-top: 0px !important;
			margin-right: 0px !important;
			margin-bottom: 0px !important;
		}

		.mystatusicon {
			padding-left: 10%;
		}

		.mycontainer {
			width: 100%;
			margin-left: auto !important;
			margin-right: auto !important;
		}

		.humtempcol {
			padding-top: 5% !important;
		}

		.storico {
			margin-left: 20px !important;
		}
	</style>
	<title>Pilly</title>

	<script>
		function startTime() {
			var today = new Date();
			var h = today.getHours();
			var m = today.getMinutes();
			var s = today.getSeconds();
			m = checkTime(m);
			s = checkTime(s);
			document.getElementById('txt').innerHTML =
				h + ":" + m + ":" + s;
			var t = setTimeout(startTime, 10000000);
		}

		function checkTime(i) {
			if (i < 10) {
				i = "0" + i
			};
			return i;
		}
	</script>

	<script>
		$("#select_input").on('change', function() {
			$("input[value='select_name']").val($(this).val());
		})
	</script>


</head>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script>
<script type="text/javascript">
	var auto_refresh = setInterval(
		function() {
			$('#ambient').load('index.php #ambient');
		}, 1000); // refresh every 1000 milliseconds
</script>

<body onload="startTime()">

	<nav role="navigation">
		<div class="nav-wrapper container">
			<a href="/pilly/index.php" class="brand-logo" style="margin-left: -60px;"><i class="material-icons" style="font-size: 40px;">local_pharmacy</i></a>
			<a id="logo-container" href="/pilly/index.php" class="brand-logo">Pilly</a>
			
			<?php
				if ($_SERVER['REQUEST_URI'] == '/pilly/index.php' || $_SERVER['REQUEST_URI'] == '/pilly/')
				echo "<ul class=\"right hide-on-med-and-down\">
				<li><a class=\"waves-effect waves-light btn\" href=\"storico.php\">Storico <i class=\"material-icons right\">history</i></a></li>
				<li><a class=\"waves-effect waves-light btn\" href=\"addMedicine.php\">Aggiungi <i class=\"material-icons right\">add</i></a></li>
			</ul>"?>
		</div>
	</nav>