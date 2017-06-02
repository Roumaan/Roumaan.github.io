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
		echo $styleLines[0];
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

	
	function writeToDB ($name, $author, $styleAddres, $styleAddresDB) {
		
		$animLines = findAnims($styleAddres);
		renameAnims($styleAddres, $animLines);		
				
		$animationsCount = count($animLines);
		$rate = rand(0, 2500);
		$time = date("Y-m-d H:i:s",time()-3600);
		$write = "INSERT INTO `projectbd`.`animations` (`name`, `styleFile`, `author`, `rate`, `animationsCount`, `time`) VALUES ('$name', '$styleAddresDB', '$author', $rate , $animationsCount, '$time' );";
		mysql_query($write) or die('not: ' .mysql_error());
		$query = 'SELECT * FROM `animations`';
		$result = mysql_query($query) or die('not: ' 	.mysql_error());
		
		echo "<table border=\"1px\">";
		while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
    		echo "\t<tr>";
    		foreach ($line as $col_value) {
        		echo "\t\t<td>$col_value</td>";
    		}
    		echo "\t</tr>";
		}
		echo "</table>";
	}

	require_once 'connection.php';
	mysql_select_db('projectbd') or die('bd');

	$auto=mysql_query("SHOW TABLE STATUS LIKE 'animations'");
	$auto=mysql_fetch_assoc($auto);
	$fileID = $auto['Auto_increment'];
	$uploaddir = "Z:\\home\\localhost\\www\\Project\\animations\\anim$fileID.css";
	$uploadfile = $uploaddir;

	if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
		writeToDB ($_POST['name'], $_POST['author'], $uploadfile, "..\\\\animations\\\\anim$fileID.css");
    	echo "Файл корректен и был успешно загружен.\n";
	} else {
    	echo "Возможная атака с помощью файловой загрузки!\n";
	}

print_r($_FILES);
?>
