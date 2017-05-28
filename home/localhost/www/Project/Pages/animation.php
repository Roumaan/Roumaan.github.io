<!DOCTYPE html>

<html lang="ru">

<head>

	<meta charset="UTF-8">
	<title>Название</title>
	<link href="../Styles/style.css" rel="stylesheet" />
	<link href="../Styles/prism.css" rel="stylesheet" />
	<script src="../Scripts/JS/prism.js"></script>
</head>

<body>
	<header>
		<nav>
			<ul>
				<li><a href="#">Популярное</a></li>
				<li><a href="#">Лучшее</a></li>
				<li><a href="#">Новое</a></li>
				<li><a href="#">О сайте</a></li>
			</ul>
		</nav>
		<div><svg></svg></div>
	</header>

	<main>
		<h2 id="animName">Название</h2>
		<div id="iframe">
			<iframe src="../Pages/preview.php" scrolling="yes" id="preview"></iframe>
		</div>
		<div id="pre">
			<pre><code class="language-css" id="styleCode">
			</code></pre>
		</div>
		
	</main>

	<footer>
		<div><span>Автор:</span><span id="rating">Рейтинг:</span></div>
		<br><br>
		<label><input type="image" src="../favicon.ico" alt="Плюс">плюс</label>
		<label><input type="image" src="../favicon.ico" alt="минус">минус</label>
	</footer>


	<?
		$dblocation = "localhost"; // Имя сервера
		$dbuser = "root";          // Имя пользователя
		$dbpasswd = "";            // Пароль
		$dbcnx = @mysql_connect($dblocation,$dbuser,$dbpasswd);
		$ID = $_GET['ID'];

		mysql_select_db('projectbd') or die('bd');
		$query = "SELECT *  FROM `animations` WHERE `ID` =$ID";
		$result = mysql_query($query) or die('not:' .mysql_error());
		$values = mysql_fetch_array($result);
	
		$animCount = $values['animationsCount'];
		$name = $values['name'];
		
		$styleFile = file($values['styleFile']);
	
		for ($i = 0; $i < count($styleFile); $i++) {
			$PCREpattern  =  '/\r\n|\r|\n/u';
			$styleFile[$i] = preg_replace($PCREpattern, '', $styleFile[$i]);
 
			$styleCode = $styleCode.$styleFile[$i]."<br>";
		}
		
		echo "<script>
		var animCount = $animCount; var name = \"$name\";\n var styleCode = \"$styleCode\";
		</script>";
	?>

		<script>
			document.getElementById("preview").src = "preview.php?animCount=" + animCount;
			document.getElementById("animName").innerText = name;

			styleCode = styleCode.replace(new RegExp("<br>", 'g'), "\n");
			alert();

			document.getElementById("styleCode").innerHTML = styleCode;

		</script>
</body>

</html>
