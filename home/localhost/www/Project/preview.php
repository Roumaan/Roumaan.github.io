<html>

<head>
	<!--Анимации-->
	<link rel="stylesheet" href="style.css">

	<!--Скрипт preview-->
	<script type="text/javascript" src="animationPreview.js"></script>


	<style>
		/*Стили для ввода*/
		
		.inline {
			padding-right: 50px;
			display: inline-block;
			vertical-align: top;
		}
		
		.mult {
			width: 50px;
		}
		/*Стили для анимации*/
		
		.rel {
			position: relative;
		}
		
		.anim {
			background-color: #ff9300;
			width: 100px;
			height: 100px;
			border-radius: 50%;
		}
		
		/*Стили для костылей*/
		.block {
			position: absolute;
			left: 800px;
			width: 10px;
			height: 10px;
		}
	</style>
</head>

<body>

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

	<!--Анимируемый объект-->
	<div class="rel">
		<div class="anim" id="anim"></div>
	</div>
	
	<div class="block"></div>
	<script>
		//Обновить анимацию при загрузке
		change();

	</script>

	<?
		$dblocation = "localhost"; // Имя сервера
		$dbuser = "root";          // Имя пользователя
		$dbpasswd = "";            // Пароль
		$dbcnx = @mysql_connect($dblocation,$dbuser,$dbpasswd);
		$animationID = 0;

		mysql_select_db('projectbd') or die('bd');
		$query = 'SELECT * FROM `animations`';
		$result = mysql_query($query) or die('not:' .mysql_error());

		$values = mysql_fetch_array($result);
		$animCount = $values['animationsCount'];
		echo "<script>var animCount = $animCount;</script>";
	?>
	<script type="text/javascript" src="preparePreview.js"></script>
</body>

</html>
