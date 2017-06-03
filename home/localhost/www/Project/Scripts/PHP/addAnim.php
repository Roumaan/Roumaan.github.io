<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../../Styles/style.css">
	
	<style>
		.res {
			margin-left: calc(50% - 100px);
			width: 200px;
		}
		p {
			text-align: center;
			font-size: 1.5em;
		}
		
		main {
			
		}
	</style>
	
	<title>Новое</title>
</head>

<body>
	<header>
		<nav>
			<ul>
				<li><a href="../../index.php">Лучшее</a></li>
				<li><a href="../../Pages/new.php">Новое</a></li>
				<li><a href="../../Pages/about.html">О сайте</a></li>
			</ul>
		</nav>
		<a href="addAnim.html"><img src="../../Images/plus.png" class="add"></a>
	</header>
	
	<main>
<?php


	function findAnims($styleAddres) {
		$styleLines = file($styleAddres); 
		
		$animLines = array(); 
		
		$success = false;
		
		foreach ($styleLines as $line_num => $line) {
						
			if (strripos($line, "keyframes") != false)  {
				$success = true; 
				array_push ($animLines,$line_num); 
			}
		}
		
		return $animLines;
	}

	function renameAnims($styleAddres, $animLines) {
		$styleLines = file($styleAddres);

		for ($i = 0; $i < count($animLines); $i++) {
			$deleteFrom = stripos($styleLines[$animLines[$i]],"keyframes")+9;
			$deleteTo = 999; 
			
			
			if (strripos($styleLines[$animLines[$i]], "{") != false) {
				$deleteTo = strripos($styleLines[$animLines[$i]], "{");
			}
			
			
			for ($j = $deleteFrom; $j < $deleteTo; $j++) {
				$styleLines[$animLines[$i]][$j]='';
			}
			
			$animID = $i+1;
			$styleLines[$animLines[$i]] = substr_replace ($styleLines[$animLines[$i]], " anim$animID ", $deleteFrom, -3); 			
		}
		
		$f=fopen($styleAddres,'w'); 
		for ($i = 0; $i < count($styleLines); $i++) {
			fwrite($f,$styleLines[$i]);
		}
	}

	
	function writeToDB ($dbcnx, $name, $author, $styleAddres, $styleAddresDB) {
		
		$animLines = findAnims($styleAddres);
		renameAnims($styleAddres, $animLines);		
				
		$animationsCount = count($animLines);
		$rate = rand(0, 2500);
		$time = date("Y-m-d H:i:s",time()-3600);
		$write = "INSERT INTO `projectbd`.`animations` (`name`, `styleFile`, `author`, `rate`, `animationsCount`, `time`) VALUES ('$name', '$styleAddresDB', '$author', $rate , $animationsCount, '$time' );";
		mysqli_query($dbcnx, $write) 
			or die('not: ' ."<img class=\"res\" src=\"..\..\Images\error.jpg\">
			<p>Не удалось отправить данные в базу данных!<p>");
		$query = 'SELECT * FROM `animations`';
		$result = mysqli_query($dbcnx, $query) or die('not: ' 	.mysqli_error($dbcnx));
		

	}

	require_once 'connection.php';
	if (!$dbcnx) die('<p style="color:red">'.mysqli_connect_errno().' - '.mysqli_connect_error().'</p>');

	$auto=mysqli_query($dbcnx, "SHOW TABLE STATUS LIKE 'animations'");
	$auto=mysqli_fetch_assoc($auto);
	$fileID = $auto['Auto_increment'];
	$uploaddir = dirname(__FILE__)."/../../Animations/anim$fileID.css";
	$uploadfile = $uploaddir;

	if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
		writeToDB ($dbcnx,$_POST['name'], $_POST['author'], $uploadfile, "../Animations/anim$fileID.css"); 	
		echo "<img class=\"res\" src=\"../../Images/ok.jpg\">
			<p>Отправка произведена успешно!<p>";
	} else {
		echo "<img class=\"res\" src=\"../../images/error.jpg\">
			<p>Не удалось получить файл!<p>";
	}
?>
		</main>
	</body>
</html>