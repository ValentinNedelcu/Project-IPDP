<?php
	session_start();
	require_once('connect.php');
	if(isset($_SESSION["username"]))
	{
		$user = $_SESSION["username"];
		$query_idClient = "SELECT id  FROM  client WHERE username='$user'";
		$statmt_idClient = $connect->prepare($query_idClient);
		$idClient = $statmt_idClient->execute();
		#echo '<h3 style="text-align: center;text-transform: uppercase;font-size:30px;color: blue">Welcome -'.$_SESSION["username"].'</h3>';

	}
	else
	{
		header("location:welcome.php");
		die();
	}

?>

<html>
	<style>


		body {
			background-image:url("1.jpg");
			-web-background-size: cover;
			background-repeat: no-repeat;
			background-position: center center;
			background-attachment: fixed;
			height: 100vh;
		}

		.menu-area li a {
			text-decoration: none;
			color: #fff;
			letter-spacing: 1px;
			text-transform: uppercase;
			display: block;
			padding: 0 25px;
			font-size: 14px;
			line-height: 30px;
			position: relative;
			z-index: 1;
		}

		.menu-area li {
			list-style: none;
			display: inline-block;
		}

		.custom-padding {
			padding-top: 25px;
		}

		nav {
			position: relative;
			padding: 10px 20px 10px 10xp;
			text-align: right;
			z-index: 1;
			background: #333;
			margin: 0 auto;
			width: calc(100% - 55px);
		}

		.logo {
			width: 15%;
			float: left;
			text-transform: uppercase;
			color: tomato;
			font-size: 25px;
			text-align: left;
			padding-left: 2%;
		}

		.menu-area li a:hover {
			background: tomato;
			color: #fff;
		}

		.dropdown {
			list-style: none;
			display: inline-block;
		}

		.dropbtn {
			background-color: #4CAF50;
			color: white;
			padding: 10px;
			font-size: 16px;
			border: none;
		}

		.dropdown-content {
			display: none;
			position: absolute;
			background-color: #333;
			min-width: 150px;
			box-shadow: 0px 8px 10px 0px rgba(0,0,0,0.2);
			z-index: 1;
		}

		.dropdown-content a {
			color: white;
			padding: 10px 20px;
			text-decoration: none;
			display: block;
			text-align: center;
		}

		.dropdown-content a:hover {background-color: tomato;}

		.dropdown:hover .dropdown-content {display: block;}

		.dropdown:hover .dropbtn {background-color: tomato;}

		.menu-area a.active {
			background-color: gray;
		}

		table{
			border-collapse: collapse;
		}

		th, td {
			border: 1px solid #ddd;
  		padding: 8px;
		}

		tr:nth-child(even){background-color: #FFEBCD;}
		tr:nth-child(odd){background-color: #8FBC8F;}

		th{
			background-color: black;
			color:white;
			width: 70px;
		}

		input[type=submit]{
			background-color: red;
			border: none;
			color: black;
			padding: 10px 16px;
			text-decoration: none;
			margin: 4px 2px;
			cursor: pointer;
			width: 5%;
			position: relative;
		}

		input[name="sterge"]{
		 font-size: 1px;
		}

	</style>

	<body>
	<title>My Bets</title>
		<div class="custom-padding">
			<nav>
				<div class="logo"><?php echo $user ?></div>
				<ul class="menu-area">
					<li><a href="logins.php">Home</a></li>
					<li><a href="sportbets.php">Sport Bets</a></li>
					<li><a href="rankings.php">Rankings</a></li>
					<div class="dropdown">
						<li class="dropdown-btn"><a href="#">My Account</a></li>
							<div class="dropdown-content">
								<a href="settings.php">Settings</a>
								<a href="mybets.php" class="active">My bets</a>
								<a href="logout.php">Logout</a>
							</div>
					</div>
				</ul>
			</nav>
		</div>
		<h2>Biletele mele</h2>

		<?php
						$select_bilete="SELECT bilet.id as id, dataPlasarii FROM bilet, bilet_client WHERE bilet.id = bilet_client.idBilet";
						$stmt_select_bilete = $connect->prepare($select_bilete);
						$stmt_select_bilete->execute();
						$row = $stmt_select_bilete->fetchAll();
						foreach($row as $i){
							$acumulare = 1;
							echo "#----------ZIUA-ORA";
							echo "<h3>".$i['id']."---------".$i['dataPlasarii']."</h3>";
							$select_pariuri_pe_bilet_part1 = "SELECT DISTINCT optiuni_pariu_tip.aditionalText as Pariu, optiuni_pariu_tip.cota as Cota, meciuri.id as idMeci, e1.nume as echipaGazda, e2.nume as echipaOaspete, bilet.id as iduri FROM bilet, bilet_client, bilet_pariuri, optiuni_pariu_tip, meciuri, echipe e1, echipe e2 WHERE bilet.id = bilet_client.idBilet AND bilet.id = ".$i['id']." AND bilet_pariuri.idBilet = bilet.id";
							$select_pariuri_pe_bilet_part2 = " AND bilet_pariuri.idOptiuni = optiuni_pariu_tip.id  AND bilet_pariuri.idBilet = ".$i['id']." AND optiuni_pariu_tip.idMeci = meciuri.id AND e1.id = meciuri.idEchipa1 AND e2.id = meciuri.idEchipa2 ";
							$select_pariuri_pe_bilet = $select_pariuri_pe_bilet_part1.$select_pariuri_pe_bilet_part2;
							$stmt_pariuri_pe_bilet = $connect->prepare($select_pariuri_pe_bilet);
							$stmt_pariuri_pe_bilet->bindValue(':bilet.id', $i['id']);
							$stmt_pariuri_pe_bilet->bindValue(':bilet_pariuri.idBilet', $i['id']);
							$stmt_pariuri_pe_bilet->execute();
							$randuri_pariuri = $stmt_pariuri_pe_bilet->fetchAll();
							echo "<table><tr><th>Meci</th><th>Pariu</th><th>Cota</th></tr>";
							foreach ($randuri_pariuri as $rand) {
								echo "<tr>
									<td style='width:50%;'>".$rand['echipaGazda']." - ".$rand['echipaOaspete']."</td>
									<td>".$rand['Pariu']."</td>
									<td>".$rand['Cota']."</td>
								</tr>";
								$acumulare = $acumulare * $rand['Cota'];
							}
							echo '<h3>COTA FINALA: '.$acumulare.'</h3>';
							echo '</table>';
							echo "<h3>Sterge bilet <form action='mybets.php' id='deleteBet' method ='post'><input name ='sterge' class ='sterge' type ='submit' value=".$i['id']."></form></h3>";
							echo '<br>____________________________________________________________________________________________________________________<br>';
						}

						if(isset($_POST["sterge"])){
							$bilet_sters = $_POST["sterge"];
							$delete_bilet_pariu = "DELETE FROM bilet_client WHERE idBilet = '$bilet_sters'";
							$stmt_delete_bilet = $connect->prepare($delete_bilet_pariu);
							$stmt_delete_bilet->bindValue(':idBilet', $bilet_sters);
							$stmt_delete_bilet->execute();

						 	$delete_bilet_pariu1 = "DELETE FROM bilet_pariuri WHERE idBilet = '$bilet_sters'";
						 	$stmt_delete_bilet1 = $connect->prepare($delete_bilet_pariu1);
						 	$stmt_delete_bilet1->bindValue(':idBilet', $bilet_sters);
						 	$stmt_delete_bilet1->execute();

							$delete_bilet_pariu2 = "DELETE FROM bilet WHERE id = '$bilet_sters'";
						 	$stmt_delete_bilet2 = $connect->prepare($delete_bilet_pariu2);
						 	$stmt_delete_bilet2->bindValue(':id', $bilet_sters);
						 	$stmt_delete_bilet2->execute();
							echo "<meta http-equiv='refresh' content='0'>";
						}
		?>


		<div id="chartContainer" style="height: 370px; width: 100%;"></div>
		<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
	</div>
	<br><br>
	<div class="container">
		<?php

 	$query =("SELECT meciuri.id, e1.nume AS gazda , e2.nume AS oaspete , COUNT(bilet.id) as id FROM optiuni_pariu_tip, bilet, bilet_pariuri, meciuri, echipe e1, echipe e2 WHERE bilet.id = bilet_pariuri.idBilet AND optiuni_pariu_tip.id = bilet_pariuri.idOptiuni AND meciuri.id = optiuni_pariu_tip.idMeci AND e1.id = meciuri.idEchipa1 AND e2.id = meciuri.idEchipa2 GROUP BY meciuri.id, e1.nume, e2.nume");
 	$result = $connect->prepare($query);
 	$result->execute();
 	?>

           <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
           <script type="text/javascript">
           google.charts.load('current', {'packages':['corechart']});
           google.charts.setOnLoadCallback(drawChart);
           function drawChart()
           {
                var data = google.visualization.arrayToDataTable([
                          ['Meci', 'Beturi/meci'],
                          <?php
                          while($row = $result->fetch(PDO::FETCH_BOTH))
                          {
                               echo "['".$row["gazda"].' - '.$row['oaspete']."', ".$row["id"]."],";
                          }
                          ?>
                     ]);
                var options = {
                      title: 'Beturi pe fiecare meci',
                      //is3D:true,
                      pieHole: 0.4
                     };
                var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                chart.draw(data, options);
           }
           </script>

					            <div style="width:900px;">
					                 <center><h1 style="color:black;">Beturi/meci</h1><br></center>
					                 <br />
					                 <div id="piechart" style="width: 900px; height: 500px;"></div>
					            </div>
</div>
	</body>

</html>
