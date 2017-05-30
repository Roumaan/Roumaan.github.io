<!DOCTYPE html>

<html lang="ru">

<head>

	<meta charset="UTF-8">
	<title>Название</title>
	<link href="../Styles/style.css" rel="stylesheet" />
	<link href="../Styles/animPage.css" rel="stylesheet" />
	<link href="../Styles/prism.css" rel="stylesheet" />
	<script src="../Scripts/JS/prism.js"></script>
</head>

<body>
	<header>
		<nav>
			<ul>
				<li><a href="best.php">Лучшее</a></li>
				<li><a href="#">Новое</a></li>
				<li><a href="#">О сайте</a></li>
			</ul>
		</nav>
		<div><svg></svg></div>
	</header>

	<main>
		<h2 id="animName">Название</h2>
		<div id="previewContainer">
			<iframe src="../Pages/preview.php" scrolling="yes" id="preview"></iframe>
		</div>
		<div id="pre">
			<pre><code class="language-css" id="styleCode">
			</code></pre>
		</div>

	</main>

	<footer>

		<p>
			<span id="author">Автор</span>
			<span style="float:right;">
			<input type="image" src="../favicon.ico" alt="Плюс">
			<input type="image" src="../favicon.ico" alt="Минус">
			<span id="rate">Рейтинг</span>
			</span>
		</p>

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
	
		$rate = $values['rate'];
		$name = $values['name'];
		$author = $values['author'];
		$animCount = $values['animationsCount'];
		$styleFile = file($values['styleFile']);
	
		for ($i = 0; $i < count($styleFile); $i++) {
			$PCREpattern  =  '/\r\n|\r|\n/u';
			$styleFile[$i] = preg_replace($PCREpattern, '', $styleFile[$i]);
 
			$styleCode = $styleCode.$styleFile[$i]."<br>";
		}
		
		echo "<script>
			var ID=\"$ID\";
			var rate = \"$rate\";
			var name = \"$name\";
			var author = \"$author\"
			var animCount = $animCount; 
			var styleCode = \"$styleCode\"; 	
		</script>";
	?>

		<script>
			document.getElementById("preview").src = "preview.php?animCount=" + animCount + "&ID=" + ID;
			document.getElementById("animName").innerText = name;
			document.title = name;
			document.getElementById("author").innerText = author;
			document.getElementById("rate").innerText = rate;

			styleCode = styleCode.replace(new RegExp("<br>", 'g'), "\n");
			document.getElementById("styleCode").innerHTML = styleCode;

		</script>
</body>

</html>
