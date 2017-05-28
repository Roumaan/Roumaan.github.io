<html>

<head>
	<!--Анимации-->
	<link rel="stylesheet" href="../Styles/style.css">

	<!--Скрипт preview-->
	<script type="text/javascript" src="../Scripts/JS/animationPreview.js"></script>
	<script type="text/javascript">
		function parametrs(){
			document.getElementById("parametrs").style.display = "inline-block";
			document.getElementById("animation").style.display = "none";
		}
		function animation(){
			document.getElementById("animation").style.display = "inline-block";
			document.getElementById("parametrs").style.display = "none";
		}
		function all228(){
			document.getElementById("animation").style.display = "inline-block";
			document.getElementById("parametrs").style.display = "inline-block";
		}
	</script>


	<style>
		/*Стили для ввода*/
		
		.left {
			width: auto;
		}
		
		.inline {
			padding-right: 50px;
			display: inline-block;
			vertical-align: top;
			margin:10px;
		}
		
		.mult {
			width: 50px;
			vertical-align: top;
		}
		
		p {
			width: auto;
		}
		/*Стили для анимации*/
		
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

	</style>
</head>

<body>
	
	<div id="buttons">
		<button onclick="parametrs()">parametrs</button>
		<button onclick="animation()">animation</button>
		<button onclick="all228()">show all</button>
	</div>

	<div class="left inline" id="parametrs">
		<!--Форма ввода правила воспроизведения анимации-->
		<form onchange="change();" class="inline">
			<p>Animation timing function</p>
			<p><input name="animTimeFunc" type="radio" value="linear" checked> linear</p>
			<p><input name="animTimeFunc" type="radio" value="ease"> ease</p>
			<p><input name="animTimeFunc" type="radio" value="ease-in"> ease-in</p>
			<p><input name="animTimeFunc" type="radio" value="ease-out"> ease-out</p>
			<p><input name="animTimeFunc" type="radio" value="ease-in-out"> ease-in-out</p>
		</form>

		<form onchange="change();" class="inline" id="nameForm">
			<p>Animation name</p>
		</form>
		<!--Форма ввода времени воспроизведения анимации-->
		<form oninput="change();">
			<p><input type="number" id="time" class="mult" step="0.1" value="1" min="0" max="2"> Animation duration multiepler</p>
		</form>
	</div>
	<!--Анимируемый объект-->
	<div class="rel inline" id="animation">
		<div class="anim" id="anim"></div>
	</div>



	<script>
		//Обновить анимацию при загрузке
		change();

	</script>

	<?
	$animCount = $_GET['animCount'];
 	echo "<script>var animCount = $animCount;</script>";
	?>
		<script type="text/javascript" src="../Scripts/JS/preparePreview.js"></script>
</body>

</html>
