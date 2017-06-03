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
				<li><a href="../index.php">Лучшее</a></li>
				<li><a href="new.php">Новое</a></li>
				<li><a href="about.html">О сайте</a></li>
			</ul>
		</nav>
		<a href="addAnim.html"><img src="../Images/plus.png" class="add"></a>
	</header>

	<main>
		<h2 id="animName">Название</h2>
		<div id="previewContainer">
			<iframe src="../Pages/preview.php" id="preview"></iframe>
		</div>
		<div id="pre">
			<pre><code class="language-css" id="styleCode">
			</code></pre>
		</div>

	</main>

	<footer>

		<p>
			<span id="author"></span>
			<span style="float:right;">
			<input type="image" src="../favicon.ico" alt="Плюс">
			<input type="image" src="../favicon.ico" alt="Минус">
			<span id="rate"></span>
			</span>
		</p>

	</footer>


	<?php
		require_once dirname(__FILE__).'/../Scripts/PHP/connection.php';
		if (!$dbcnx) die('<p style="color:red">'.mysqli_connect_errno().' - '.mysqli_connect_error().'</p>');
	
		$ID = $_GET['ID'];
		$query = "SELECT *  FROM `animations` WHERE `ID` =$ID";
		$result = mysqli_query($dbcnx, $query) or die('not:' .mysqli_error($dbcnx));
		$values = mysqli_fetch_array($result);
	
		$rate = $values['rate'];
		$name = $values['name'];
		$author = $values['author'];
		$animCount = $values['animationsCount'];
		$styleFile = file(dirname(__FILE__).'/'.$values['styleFile']);
		
		$styleCode = "";
		for ($i = 0; $i < count($styleFile); $i++) {
			$PCREpattern  =  '/\r\n|\r|\n/u';
			$styleFile[$i] = preg_replace($PCREpattern, '', $styleFile[$i]);
 			$string = $styleFile[$i];
			$styleCode = $styleCode.$string."<br>";
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
			document.getElementById("preview").src = "preview.php?ID=" + ID;
			document.getElementById("animName").innerText = name;
			document.title = name;
			document.getElementById("author").innerText = author;
			document.getElementById("rate").innerText = rate;

			styleCode = styleCode.replace(new RegExp("<br>", 'g'), "\n");
			document.getElementById("styleCode").innerHTML = styleCode;

		</script>
</body>

</html>
