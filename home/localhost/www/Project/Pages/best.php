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
				<li><a href="#">Популярное</a></li>
				<li><a href="#">Лучшее</a></li>
				<li><a href="#">Новое</a></li>
				<li><a href="#">О сайте</a></li>
			</ul>
		</nav>
		<div><svg></svg></div>
	</header>

	<main>
		<ul>
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
					
					echo "<li class=\"animation\">
					<a href=\"animation.php?ID=$ID\">
						<p>$name Колл-во анимаций: $animCount <span style=\"float:right\"><span class=\"author\">$author</span> <span class=\"rate\">Рейтинг: $rate</span> </span>
						</p>
					</a>
				</li>";
				}
			?>
		</ul>
	</main>
</body>

</html>
