<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href="../Styles/style.css">
	<?php
		require_once dirname(__FILE__).'/../Scripts/PHP/connection.php';
		if (!$dbcnx) die('<p style="color:red">'.mysqli_connect_errno().' - '.mysqli_connect_error().'</p>');
	
		$ID = $_GET['ID'];
		$query = "SELECT *  FROM `animations` WHERE `ID` =$ID";
		$result = mysqli_query($dbcnx, $query) or die('not:' .mysqli_error($dbcnx));
		$values = mysqli_fetch_array($result);
	
		$animAddres = $values['styleFile'];
		$animCount = $values['animationsCount'];
		echo "<link rel=\"stylesheet\" href=\"$animAddres\">"
	?>

		<script type="text/javascript" src="../Scripts/JS/animationPreview.js"></script>
		<script type="text/javascript">
			function parametrs() {
				document.getElementById("parametrs").style.display = "inline-block";
				document.getElementById("animation").style.display = "none";
			}

			function animation() {
				document.getElementById("animation").style.display = "inline-block";
				document.getElementById("parametrs").style.display = "none";
			}

			function showAll() {
				document.getElementById("animation").style.display = "inline-block";
				document.getElementById("parametrs").style.display = "inline-block";
			}

		</script>


		<style>
			#buttons {
				height: 20px;
				background-color:#6992A6;
				border-top-left-radius: 6px;
				border-top-right-radius: 6px;
				padding: 5px;
				margin-bottom: 10px;
			}
			
			#parametrs{
				display:none;
			}
			
			.left {
				width: auto;
			}
			
			.inline {
				padding-right: 50px;
				display: inline-block;
				vertical-align: top;
				margin: 10px;
			}
			
			.mult {
				width: 50px;
				vertical-align: top;
			}
			
			p {
				width: auto;
			}
			
			.rel {
				position: relative;
				width: 10%;
				display: inline-block;
			}
			
			.anim {
				display: inline-block;
				background-color: #ff9300;
				width: 100px;
				height: 100px;
				border-radius: 50%;
			}

			body {
				background-color: #F8F7F7;
				height:100vh;
			}
		</style>

</head>

<body>

	<div id="buttons">
		<button onclick="parametrs()">parametrs</button>
		<button onclick="animation()">animation</button>
		<button onclick="showAll()">show all</button>
	</div>

	<div class="left inline" id="parametrs">
		<form onchange="change();" class="inline">
			<p>Временная функция анимации</p>
			<p><input name="animTimeFunc" type="radio" value="linear" checked> linear</p>
			<p><input name="animTimeFunc" type="radio" value="ease"> ease</p>
			<p><input name="animTimeFunc" type="radio" value="ease-in"> ease-in</p>
			<p><input name="animTimeFunc" type="radio" value="ease-out"> ease-out</p>
			<p><input name="animTimeFunc" type="radio" value="ease-in-out"> ease-in-out</p>
		</form>

		<form onchange="change();" class="inline" id="nameForm">
			<p>Выбор анимации</p>
		</form>
		<form oninput="change();">
			<p><input type="number" id="time" class="mult" step="0.1" value="1" min="0" max="2"> Время воиспроизведения</p>
		</form>
	</div>
	<div class="rel inline" id="animation">
		<div class="anim" id="anim"></div>
	</div>



	<script>
		change();
		showAll();
	</script>

	<?php echo "<script>var animCount = $animCount;</script>"; ?>
	<script type="text/javascript" src="../Scripts/JS/preparePreview.js"></script>
</body>

</html>
