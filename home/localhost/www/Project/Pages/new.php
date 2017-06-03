<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../Styles/style.css">
	<link rel="stylesheet" href="../Styles/topPages.css">
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
		<a href="addAnim.html"><img src="../Images/plus.png" class="add"></a>
	</header>

	<main>
		<h1 align="center">Новейшие анимации</h1>
		
		<table>
			<tr>
				<th class="left">Название:</th>
				<th class="left">Рейтинг:</th>
				<th class="left">Колл-во анимаций:</th>
				<th class="right">Автор:</th>
				<th class="right">Выложено:</th>
			</tr>
			<span>
			<?php
				require_once dirname(__FILE__).'/../Scripts/PHP/connection.php';
				if (!$dbcnx) die('<p style="color:red">'.mysqli_connect_errno().' - '.mysqli_connect_error().'</p>');
				
				$query = "SELECT *  FROM `animations`";
				$result = mysqli_query($dbcnx, $query) or die('not:' .mysqli_error($dbcnx));		
				$times = array();
				
				$i = 0;
				while(($row = mysqli_fetch_array($result)) && $i <= 30)
				{
					$times[$i] = $row['time'];
					$i++;
				}
				
				for ($i = 0; $i < count($times); $i++) {
					for ($k = 0; $k < count($times) - 1; $k++) {
						
						$animTime1 = new DateTime($times[$k]);
						$animTime2 = new DateTime($times[$k + 1]);
						
						$diff1 = $animTime1->diff($animTime2);

						$r = $diff1->format('%R');	
						if (strcmp($r,"+")==0) {						
							$temp = $times[$k + 1];
							$times[$k + 1] = $times[$k];
							$times[$k] = $temp;
						}
					}
				}

				for ($i = 0; $i < count($times); $i++) {
					$time = $times[$i];
					$res = mysqli_query($dbcnx, "SELECT *  FROM `animations`
					WHERE `time`= '$time'") or die('not:' .mysqli_error($dbcnx));
					$animation = mysqli_fetch_array($res);
					$name = $animation['name'];
					$author = $animation['author'];
					$animCount = $animation['animationsCount'];
					$rate = $animation['rate'];
					$ID = $animation['ID'];
					
					echo "<tr class=\"animation\" onclick=\"goToAnim('animation.php?ID=', $ID);\">
							<td class=\"left\">$name</td>
							<td class=\"left\">$rate</td>
							<td class=\"left\">$animCount</td>
							<td class=\"right\">$author</td>
							<td class=\"right\">
							";
					
					$time = new DateTime(date("d-m-Y G:i",time()-3600));
					$animTime = new DateTime($animation['time']);
					
					$diff = $animTime->diff($time);
						
					$day = $diff->format('%d');
					$month = $diff->format('%m');
					$year = $diff->format('%Y');
					
					$minute = $diff->format('%i');
					$hour = $diff->format('%h');
					
					if ($year != 0) {
						if ($year==1 ||
							($year>20 && $year%10==1)) 
							$year = $year." год";
						else if (($year>1 && $year<5) ||
							($year>20 && ($year%10>1 && $year%10<5))) 
							$year = $year." года";
						else if (($year>=5 && $year<=20) ||
							($year>20 && $year%10>=5 && $year%10<=9)) 
							$year = $year." лет";
						
						echo "$year назад";
					}
					else if ($month != 0){
						if ($month==1) 
							$month = $month." месяц";
						else if ($month>1 && $month<5) 
							$month = $month." месяца";
						else if ($month>=5 && $month<=20)
							$month = $minute." месяцев";
						
						echo "$month назад";
					}
					else if ($day != 0) {
						if ($day==1 ||
							($day>20 && $day%10==1)) 
							$day = $day." день";
						else if (($day>1 && $day<5) ||
							($day>20 && ($day%10>1 && $day%10<5))) 
							$day = $day." дня";
						else if (($day>=5 && $day<=20) ||
							($day>20 && $day%10>=5 && $day%10<=9)) 
							$day = $minute." дней";
						
						echo "$day назад";
					}	  						  
					else if ($hour != 0) {
						if ($hour==1 ||
							($hour>20 && $hour%10==1)) 
							$hour = $hour." час";
						else if (($hour>1 && $hour<5) ||
							($hour>20 && ($hour%10>1 && $hour%10<5))) 
							$hour = $hour." часа";
						else if ($hour>=5 && $hour<=20) 
							$hour = $hour." часов";
						
						echo "$hour назад";
					}
					else if ($minute != 0){
						if ($minute==1 ||
							($minute>20 && $minute%10==1)) 
							$minute = $minute." минуту";
						else if (($minute>1 && $minute<5) ||
							($minute>20 && ($minute%10>1 && $minute%10<5))) 
							$minute = $minute." минуты";
						else if (($minute>=5 && $minute<=20) ||
							($minute>20 && ($minute%10>=5 && $minute%10<=9) || $minute%10 == 0)) 
							$minute = $minute." минут";
							
						echo "$minute назад";
					} else {
						echo "Только что";
					}
							
					echo "		
				</td>		
			</tr>"; } ?>
			</span>
		</table>
	</main>
</body>

</html>
