<?php

	$animLines;//Номера строк с анимациями
	$animPoses;//Номера символов анимации, где находятся анимации (Нахуй не надо)

	// \/ Поиск анимаций в файле styleAddres
	function findAnims($styleAddres) {
		global $animLines, $animPoses; // Получаем глобальные переменные
		$styleLines = file($styleAddres); // Получаем строки файла
		
		// Отправляем в animLines и animPoses пустые массивы
		$animLines = array(); 
		$animPoses = array(); 
		
		// Если найти анимации не удасться то тут останется false
		$success = false;
		
		// Перебираем строки файла, где line_num - номер строки, а line - сама строка
		foreach ($styleLines as $line_num => $line) {
			// Записываемв pos место где встретилось keyframes в текущей строке, если её там нет, то в переменное удет false
			$pos = strripos($line, "keyframes");			
			if ($pos != false) /* Если keyframes нашли, */ {
				$success = true; // то функция выполнилась упешно
				array_push ($animLines,$line_num); // Записываем наверх массива animLines номер строки в line_num
				array_push ($animPoses, $pos ); // Записываем наверх массива animPoses номер символа в pos
			}
		}
		
		return $success; // Возвращаем нашла ли функция анимацию/и
	}

	// \/ Переименовывание анимаций в файле styleAddres
	function renameAnims($styleAddres) {
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

	// \/ Создаёт превью. Скорее всего будет удалятся поэтому не объясняю
	function createPreview ($styleAddres, $exampleAddres, $resultAddress) {
		findAnims($styleAddres);
		renameAnims($styleAddres);
		global $animLines;
		$exampleLines = file($exampleAddres);

		for ($i = 0; $i < count($exampleLines); $i++) {
			$flagPos = stripos($exampleLines[$i], "animName radio flag");

			if ($flagPos!=false) {
				
				for ($j = 1; $j <= count($animLines); $j++) {
					if ($j!=1) {
						$exampleLines[$i+$j*2] = "<p><input name=\"animName\" type=\"radio\" value=$j > anim$j</p>";
					}
					else {
						
						$exampleLines[$i+$j*2] = "<p><input name=\"animName\" type=\"radio\" value=$j checked> anim$j</p>";
					}
				}
				
			}

		}
		
		$f=fopen($resultAddress,'w');
		for ($i = 0; $i < count($exampleLines); $i++) {
			fwrite($f,$exampleLines[$i]);
		}
	}

	function writeToDB ($styleAddres) {
		global $animLines;
		
		findAnims($styleAddres);
		renameAnims($styleAddres);
		
		$dblocation = "localhost"; // Имя сервера
		$dbuser = "root";          // Имя пользователя
		$dbpasswd = "";            // Пароль
		$dbcnx = @mysql_connect($dblocation,$dbuser,$dbpasswd);
		mysql_select_db('projectbd') or die('bd');
		$query = 'SELECT * FROM `animations`';
		$result = mysql_query($query) or die('not: ' .mysql_error());
		
		
		$animationsCount = count($animLines);
		$rate = rand(0, 2500);
		$write = "INSERT INTO `projectbd`.`animations` (`name`, `styleFile`, `author`, `rate`, `animationsCount`) VALUES ('testi', '$styleAddres', 'admin', $rate , $animationsCount );";
		mysql_query($write) or die('not: ' .mysql_error());
		
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


	writeToDB ("style.css");

	

/*
НЕНУЖНАЯ ХУЙНЯ
	function getAnim($styleAddres, $animLine, $animPose) {
		$styleLines = file($styleAddres);
		$anim = "";
		$openedBrackets = 0;
		$i = $animLine;
		
		echo strripos($styleLines[10], "}") != false;
		do { 	
			
			
			if (strripos($styleLines[$i], "{") != false) {
				$openedBrackets++;
			}
			if (strripos($styleLines[$i], "}") != false) {
				$openedBrackets--;
			}
			
			$anim = "$anim $styleLines[$i] <br>";
			$i++;
					
		} while (!($openedBrackets == 1 && strripos($styleLines[$i], "}") == true));
		
		echo $anim;
	}
*/
?>
