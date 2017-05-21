<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link href="style.css" rel="stylesheet" />
	<link href="prism.css" rel="stylesheet" />

	<style>
		pre {
			font-size: 0.9em;
			width: 46vw;
			height: 85vh;
			display: inline-block;
		}
		
		iframe {
			display: inline-block;
			width: 46vw;
			height: 90vh;
		}

	</style>
</head>

<body>
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
	<iframe align="right" src="preview.php" scrolling="yes" frameborder="0"></iframe>
	<script src="prism.js"></script>
</body>

</html>
