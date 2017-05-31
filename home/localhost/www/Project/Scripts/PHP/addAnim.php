<?php


	// \/ Поиск анимаций в файле styleAddres
	function findAnims($styleAddres) {
		$styleLines = file($styleAddres); // Получаем строки файла
		
		// Отправляем в animLines пустой массив
		$animLines = array(); 
		
		// Если найти анимации не удасться то тут останется false
		$success = false;
		
		// Перебираем строки файла, где line_num - номер строки, а line - сама строка
		foreach ($styleLines as $line_num => $line) {
			// Записываемв pos место где встретилось keyframes в текущей строке, если её там нет, то в переменное удет false
						
			if (strripos($line, "keyframes") != false) /* Если keyframes нашли, */ {
				$success = true; // то функция выполнилась упешно
				array_push ($animLines,$line_num); // Записываем наверх массива animLines номер строки в line_num
			}
		}
		
		return $animLines;
	}

	// \/ Переименовывание анимаций в файле styleAddres
	function renameAnims($styleAddres, $animLines) {
		global $animLines, $animPoses; //Получаем глобальные переменные
		$styleLines = file($styleAddres); // Получаем строки файла
		
		// Проходимся по всем анимациям
		for ($i = 0; $i < count($animLines); $i++) {
			$deleteFrom = stripos($styleLines[$animLines[$i]],"keyframes")+9; //Удаляем с появления keframes + 9 символов
			$deleteTo = 999; // Удаляем до 999 символа
			
			// Если видим скобку, то удаляем до её появления
			if (strripos($styleLines[$animLines[$i]], "{") != false) {
				$deleteTo = strripos($styleLines[$animLines[$i]], "{");
			}
			
			// Удаляем все символы с deleteFrom до deleteTo
			for ($j = $deleteFrom; $j < $deleteTo; $j++) {
				$styleLines[$animLines[$i]][$j]='';
			}
			
			$animID = $i+1; // ID анимации
			$styleLines[$animLines[$i]] = substr_replace ($styleLines[$animLines[$i]], " anim$animID ", $deleteFrom, -3); // Заменяем часть строки с именем анимации от deleteFrom до 3 символа с конца на " anim$animID "
			
		}
		
		$f=fopen($styleAddres,'w'); // Открываем на запись styleAddres
		// Полностью перезаписываем styleAddres
		for ($i = 0; $i < count($styleLines); $i++) {
			fwrite($f,$styleLines[$i]);
		}
	}

	
	function writeToDB ($name, $author, $styleAddres, $styleAddresDB) {
		
		$animLines = findAnims($styleAddres);
		renameAnims($styleAddres, $animLines);		
				
		$animationsCount = count($animLines);
		$rate = rand(0, 2500);
		$time = date("Y-m-d H:i",time()-3600);
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


	function conectToDB () {
		$dblocation = "localhost"; // Имя сервера
		$dbuser = "root";          // Имя пользователя
		$dbpasswd = "";            // Пароль
		$dbcnx = @mysql_connect($dblocation,$dbuser,$dbpasswd);
		mysql_select_db('projectbd') or die('bd');
	}

	conectToDB();
	$auto=mysql_query("SHOW TABLE STATUS LIKE 'animations'");
	$auto=mysql_fetch_assoc($auto);
	$fileID = $auto['Auto_increment'];
	echo $fileID;
	$uploaddir = "Z:\\\\home\\\\localhost\\\\www\\\\Project\\\\animations\\\\anim$fileID.css";
	$uploadfile = $uploaddir;

	if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
		writeToDB ($_POST['name'], $_POST['author'], $uploadfile, "..\\\\animations\\\\anim$fileID.css");
    	echo "Файл корректен и был успешно загружен.\n";
	} else {
    	echo "Возможная атака с помощью файловой загрузки!\n";
	}

print_r($_FILES);
?>
