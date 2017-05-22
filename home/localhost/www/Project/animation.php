<?php
echo header('Content-type: text/html; charset=utf-8');
?>
	<!DOCTYPE html>

	<html lang="ru">

	<head>

		<meta charset="UTF-8">
		<title>Название</title>
		<link href="style.css" rel="stylesheet" />
		<link href="prism.css" rel="stylesheet" />
		<script src="prism.js"></script>

		<style>
			header {
				background-color: bisque;
			}
			
			pre {
				font-size: 0.9em;
				height: 50vh;
			}
			
			iframe {
				width: 96vw;
				height: 50vh;
			}

		</style>
	</head>

	<body>
		<header>
			<svg></svg>
			<nav>
				<ul>
					<li><a href="#">Популярное</a></li>
					<li><a href="#">Лучшее</a></li>
					<li><a href="#">Новое</a></li>
					<li><a href="#">О сайте</a></li>
				</ul>
			</nav>
		</header>

		<main>
			<h1>Название</h1>
			<iframe src="preview.php" scrolling="yes"></iframe>
			<pre><code class="language-css" >/*Движение вперёд на 500 пикселей*/
@keyframes anim1 {
	from {
		transform: translate(0);
	}
	50% {
		transform: translate(500px)
	}
	to {
		transform: translate(0);
	}
}

/*Движение по квадрату со стороной 250px */
@keyframes anim2 {
	from {
		transform: translate(0, 0);
	}
	25% {
		transform: translate(250px, 0);
	}
	50% {
		transform: translate(250px, 250px);
	}
	75% {
		transform: translate(0, 250px);
	}
	to {
		transform: translate(0, 0);
	}
}

/*Движение по кругу*/
@keyframes anim3 {
	from {
		position: absolute;
		left: 150px;
		top: 150px;
		transform: rotate(180deg) translateX(150px) rotate(180deg);
	}
	to {
		position: absolute;
		left: 150px;
		top: 150px;
		transform: rotate(540deg) translateX(150px) rotate(540deg);
	}
}</code></pre>
		</main>

		<footer>
			<p>Автор</p>
			<p style="float:right">Рейтинг</p>
			<label><input type="image" src="../favicon.ico" alt="Плюс">плюс</label>
			<label><input type="image" src="../favicon.ico" alt="минус">минус</label>
		</footer>
	</body>

	</html>
	<?

?>
