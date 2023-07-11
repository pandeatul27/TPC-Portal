<!DOCTYPE html>
<html>
<style>
		body {
			font-family: Arial, sans-serif;
			padding: 0px;
			margin: 0px;
		}
		h1 {
			text-align: center;
		}
		table {
			border-collapse: collapse;
			width: 100%;
			margin-top: 20px;
		}
		th, td {
			text-align: left;
			padding: 8px;
			border-bottom: 1px solid #ddd;
		}
		th {
			background-color: #4CAF50;
			color: white;
		}
		tr:nth-child(even) {
			background-color: #f2f2f2;
		}
		tr:hover {
			background-color: #ddd;
		}

		nav {
			background-color: #333;
			color: #fff;
			overflow: hidden;
		}

		nav a {
			float: left;
			display: block;
			color: #fff;
			text-align: center;
			padding: 14px 16px;
			text-decoration: none;
		}

		nav a:hover {
			background-color: #ddd;
			color: #333;
		}
        a{
            display: block;
            text-decoration: none;
        }
	</style>
	 <?php 
	 session_start();
    
	 if(!isset($_SESSION['sess_user'])){
	   header('Location: login.php');
	 }
	 if ($_SERVER["REQUEST_METHOD"] === "POST") : ?> 
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
	google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Number of Students Placed'],
		  <?php
				$host = 'localhost';
				$user = 'root';
				$password = 'password123';
				$dbname = 'minipro';
				$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
				$options = [
				  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
				  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
				  PDO::ATTR_EMULATE_PREPARES => false,
				];
				try {
				  $pdo = new PDO($dsn, $user, $password, $options);
				} catch (\PDOException $e) {
				  throw new \PDOException($e->getMessage(), (int)$e->getCode());
				}
                $comp=$_POST['company'];
				for ($x = 2018; $x <= 2025; $x++) {

					$stmt = $pdo->prepare("SELECT year,count(rollno) as placed,sum(salary) as mean,max(salary) as max_salary FROM finalyPlaced WHERE company_name=:comp group by year having year=:p");
					$stmt->execute([
                        ':p'=>$x,
                        ':comp'=>$comp
                    ]);
					$row = $stmt->fetch();
					$rcount=$stmt->rowCount();
					if($rcount==0){
						$avg=0;
						$m_x=0;
						$pla=0;
						$ye=$x;
					}
					else{
						$avg=$row['mean']/$row["placed"];
						$m_x=$row["max_salary"];
						$pla=$row['placed'];
						$ye=$x;
					}
					echo "['".$ye."',".$pla."],";
				}
				?>
		]);
		var option = {
		title: 'Placements',
          legend: { position: 'bottom' }

          };

          var chart = new google.visualization.LineChart(document.getElementById('b_max'));
          chart.draw(data, option);
        }
	</script>
    <?php endif; ?> 

<head>
	<title>Overall</title>
</head>
<body>
<nav>
	<a href="http://localhost/minpro/coordinator_dashboard.php">HOME</a>
	<a href="http://localhost/minpro/addFinalyPlaced.php">ADD</a>
	    <a href="http://localhost/minpro/stats.php">stats</a>
		<a href="http://localhost/minpro/overview.php">overview</a>
		<a href="http://localhost/minpro/companywise.php">Company Wise</a>
		<a href="logout.php" style="float: right; background-color: red;">Logout</a>

	</nav>
	<h1>Overall Statistics</h1> 

    <form method="post">
    <label for="comapny">Select Company:</label>
		<select name="company" id="company">
		<option value=" ">--Select Comapny--</option>
		<?php
    ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
	session_start();
    
    if(!isset($_SESSION['sess_user'])){
      header('Location: login.php');
    }
		$host = 'localhost';
        $user = 'root';
        $password = 'password123';
        $dbname = 'minipro';
        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
        $options = [
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
          PDO::ATTR_EMULATE_PREPARES => false,
        ];
        try {
          $pdo = new PDO($dsn, $user, $password, $options);
        } catch (\PDOException $e) {
          throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
			// echo "asdfa";
			// echo "<option value=\"sdfgsdf\">sdfgsdfg</option>";
            $st=$pdo->prepare("SELECT distinct company_name FROM finalyPlaced;");        
			$st->execute();
			while($comp=$st->fetch()){
			$cnam=$comp['company_name'];
			echo "<option value=\"$cnam\">$cnam</option>";
		   }
		?>
        <input type="submit" name="submit" value="Submit">
        </select>
        </form>
        <br>

	<table>
		<thead>
			<tr>
				<th>Year</th>
				<th>Placements</th>
				<th>Average CTC</th>
				<th>Median CTC</th>
				<th>Max CTC</th>
				<th>Min CTC</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$host = 'localhost';
				$user = 'root';
				$password = 'password123';
				$dbname = 'minipro';
				$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
				$options = [
				  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
				  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
				  PDO::ATTR_EMULATE_PREPARES => false,
				];
				try {
				  $pdo = new PDO($dsn, $user, $password, $options);
				} catch (\PDOException $e) {
				  throw new \PDOException($e->getMessage(), (int)$e->getCode());
				}

			
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $comp=$_POST['company'];
					$stmt = $pdo->prepare("SELECT min(year) FROM finalyPlaced  WHERE company_name= :comp ");
					$stmt->execute([
						':comp'=>$comp

					]);	
					$row = $stmt->fetch();
					$start=$row['min(year)'];
                for ($x = $start; $x <= date('Y'); $x++) {
				$stmt = $pdo->prepare("SELECT year,count(rollno) as placed,sum(salary) as mean,max(salary) as max_salary,min(salary) as min_salary FROM finalyPlaced  WHERE company_name= :comp group by year having year=:p");
                $stmt->execute([
                    ':p'=>$x,
                    ':comp'=>$comp
                ]);
                $row = $stmt->fetch();
				$rcount=$stmt->rowCount();

				$st=$pdo->prepare("SELECT year, AVG(salary) AS median_salary FROM (   SELECT year, salary,          @year_rank := IF(@current_year = year, @year_rank + 1, 1) AS year_rank,          @current_year := year   FROM finalyPlaced
				CROSS JOIN (SELECT @current_year := NULL, @year_rank := 0) AS vars   ORDER BY year, salary ) ranked WHERE year_rank IN (FLOOR((@year_rank + 1)/2), FLOOR((@year_rank + 2)/2)) GROUP BY year having year=:placed_year;");
				$st->execute([':placed_year'=>$x]);
				$r=$st->fetch();


				if($rcount==0){
					$avg=0;
					$m_x=0;
					$pla=0;
					$ye=$x;
					$min_x=0;
					$medi=0;
				}
				else{
					$avg=$row['mean']/$row["placed"];
					$m_x=$row["max_salary"];
					$pla=$row['placed'];
					$ye=$x;
					$min_x=$row["min_salary"];
					$medi=$r["median_salary"];
				}

			echo "<tr>";
							echo "<td>" . $ye . "</td>";
							echo "<td>" . $pla . "</td>";
							echo "<td>" . $avg . "</td>";
							echo "<td>" . $medi . "</td>";
							echo "<td>" . $m_x . "</td>";
							echo "<td>" . $min_x . "</td>";
							echo "</tr>";
		  }
        }
	
			?>

			
		</tbody>
	</table>
<br>
<div id="b_max" style="width: 1300px; height: 500px;"></div>


</body>
</html>
