<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../Styles/style.css">
	<link rel="stylesheet" href="../Styles/bestPage.css">
	<title>Лучшее</title>
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
		<table>
			<tr>
				<th align="left">Название:</th>
				<th align="left">Колл-во анимаций:</th>
				<th align="right">Автор:</th>
				<th align="right">Рейтинг: </th>
				<th align="right">Выложено:</th>
			</tr>
			<?
				$dblocation = "localhost"; // Имя сервера
				$dbuser = "root";          // Имя пользователя
				$dbpasswd = "";            // Пароль
				$dbcnx = @mysql_connect($dblocation,$dbuser,$dbpasswd);
				mysql_select_db('projectbd') or die('bd');
			
				$query = "SELECT *  FROM `animations`";
				$result = mysql_query($query) or die('not:' .mysql_error());		
				$rates = array();
				
				$i = 0;
				while($row = mysql_fetch_array($result))
				{
					$rates[$i] = $row['rate'];
					$i+=1;
				}
			
				$temp;
				for ($i = 0; $i < count($rates); $i++) {
					for ($k = 0; $k < count($rates) - 1; $k++) {
						if ($rates[$k] < $rates[$k + 1]) {
							$temp = $rates[$k + 1];
							$rates[$k + 1] = $rates[$k];
							$rates[$k] = $temp;
						}
					}
				}

				for ($i = 0; $i < count($rates); $i++) {
					$rate = $rates[$i];
					$res = mysql_query("SELECT *  FROM `animations`
					WHERE `rate`= $rate") or die('not:' .mysql_error());
					$animation = mysql_fetch_array($res);
					$name = $animation['name'];
					$author = $animation['author'];
					$animCount = $animation['animationsCount'];
					$ID = $animation['ID'];
					
					$time = getdate();
					$animTime = strtotime($animation['time']);
					
					$day = $time['mday']-date("d",$animTime);
					$mounth = $time['mon']-date("m",$animTime);
					$year = $time['year']-date("Y",$animTime);
					
					$hour = $time['hours']-date("H",$animTime)-1;
					$minute = $time['minutes']-date("i",$animTime);
					
					if ($year == 0) $year = null;
					else $year = $year." лет";
					if ($mounth == 0) $mounth = null;
					else $mounth = $mounth." месяца";
					if ($day == 0) $day = null;
					else $day = $day." дней";
					if ($hour == 0) $hour = null;
					else $hour = $hour." часа";
					if ($minute == 0) $minute = null;
					else $minute = $minute." минут";
					
					echo"<tr class=\"animation\">
							<td class=\"name\">
								<a href=\"animation.php?ID=$ID\">
								$name
								</a>
							</td>
							<td>
								<span align=\"left\">
									 <a href=\"animation.php?ID=$ID\">$animCount
									 </a>
								</span>
							</td>
							<td class=\"author\">
								<a href=\"animation.php?ID=$ID\"><span style=\"float:right\" >$author</span>	
								</a>
							</td>
							<td class=\"rate\">
								<a href=\"animation.php?ID=$ID\">
								<span style=\"float:right\" >$rate</span> 
								</a>
							</td>
							<td class=\"rate\">
								<a href=\"animation.php?ID=$ID\">
									<span style=\"float:right\" >$year $mounth $day $hour $minute</span> 
								</a>
							</td>
						</a>
					</tr>
					 ";
					/*
						";*/
				}
			?>
		</table>
	</main>

	<footer>

	</footer>
</body>

</html>
