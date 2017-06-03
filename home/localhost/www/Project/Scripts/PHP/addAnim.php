<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../../Styles/style.css">
	<link rel="stylesheet" href="../../Styles/topPages.css">
	<script src="../Scripts/JS/animLink.js"></script>
	<title>Новое</title>
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
		<div><svg></svg></div>
	</header>


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
		mysqli_query($dbcnx, $write) or die('not: ' .mysql_error($dbcnx));
		$query = 'SELECT * FROM `animations`';
		$result = mysqli_query($dbcnx, $query) or die('not: ' 	.mysqli_error($dbcnx));
		
		echo "<table border=\"1px\">";
		while ($line = mysqli_fetch_array($result, MYSQL_ASSOC)) {
    		echo "\t<tr>";
    		foreach ($line as $col_value) {
        		echo "\t\t<td>$col_value</td>";
    		}
    		echo "\t</tr>";
		}
		echo "</table>";
	}

	require_once 'connection.php';
	if (!$dbcnx) die('<p style="color:red">'.mysqli_connect_errno().' - '.mysqli_connect_error().'</p>');

	$auto=mysqli_query($dbcnx, "SHOW TABLE STATUS LIKE 'animations'");
	$auto=mysqli_fetch_assoc($auto);
	$fileID = $auto['Auto_increment'];
	$uploaddir = dirname(__FILE__)."\\..\\..\\Animations\\anim$fileID.css";
	$uploadfile = $uploaddir;

	if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
		echo "<p>Файл корректен и был успешно загружен.<p>";
		writeToDB ($dbcnx,$_POST['name'], $_POST['author'], $uploadfile, "../Animations/anim$fileID.css"); 	
	} else {
    	echo "Возможная атака с помощью файловой загрузки!\n";
	}
?>
	</body>
</html>