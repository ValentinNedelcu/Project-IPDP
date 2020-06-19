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
		* {
			margin: 0;
			padding: 0;
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
		}

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
			background-color: tomato;
		}

		.leftcolumn{
			padding: 20px;
			margin-top: 20px;
			padding: 5px 15px 5px 5xp;
			width: 75%;
			text-align: center;
			position: relative;
			margin: 20 auto;
			float: left;
		}

		.rightcolumn {
			position: relative;
			float: left;
			width:23%;
			padding-left: 20px;
		}

		.row:after {
			content: "";
			display: table;
			clear: both;
		}

		@media screen and (max-width: 800px) {
			.leftcolumn, .rightcolumn {
			width: 100%;
			padding: 0;
			}
		}

		.container {
  		position: relative;
  		text-align: center;
  		color: white;
		}
		.textimaginewelcome {
  		position: absolute;
  		top: 35%;
		  left: 50%;
  		transform: translate(-50%, -50%);
			}
			.linkimaginewelcome {
	  		position: absolute;
	  		top: 45%;
			  left: 50%;
	  		transform: translate(-50%, -50%);
				}

				.dropticket {
					list-style: none;
					display: inline-block;
				}



				.dropdown-content-ticket {
					display: none;
					position: absolute;
					background-color: #333;
					min-width: 150px;
					box-shadow: 0px 8px 10px 0px rgba(0,0,0,0.2);
					z-index: 1;
				}

				.dropdown-content-ticket b {
					color: white;
					padding: 10px 20px;
					text-decoration: none;
					display: block;
					text-align: center;
				}

				.dropdown-content-ticket b:hover {background-color: green;}

				.dropticket:hover .dropdown-content-ticket {display: block;}

				.dropticket:hover .dropbtn-ticket {background-color: green;}

				input[type=submit]{
					background-color: #99FF33;
					border: none;
					color: black;
					padding: 10px 16px;
					text-decoration: none;
					margin: 4px 2px;
					cursor: pointer;
					width: 10.5%;
					position: relative;
				}

				input[name="sterge"] {
				 font-size: 1px;
				}

				table{
				 border-collapse: collapse;
				 width: 100%;
				}

				th, td {
				 text-align: left;
				 padding: 8px;
				}

				tr:nth-child(even){background-color: white;}
				tr:nth-child(odd){background-color: white;}

				th{
				 background-color: green;
				 color:white;
				}

				#delete_submit{
				 background-color: white;
				 text-align: left;
				}

				input[name="plasare_bilet"]{
				 width:100%;
				 background-color: #008B8B;
				}

	</style>


	<body>


	<title>Home</title>

	<div class="custom-padding">
		<nav>
			<div class="logo"><?php echo $user ?></div>
			<ul class="menu-area">
				<li><a href="logins.php" class="active">Home</a></li>
				<li><a href="sportbets.php">Sport Bets</a></li>
				<li><a href="rankings.php">Rankings</a></li>
				<div class="dropdown">
					<li class="dropdown-btn"><a href="#">My Account</a></li>
						<div class="dropdown-content">
							<a href="settings.php">Settings</a>
							<a href="mybets.php">My bets</a>
							<a href="logout.php">Logout</a>
						</div>
				</div>
			</ul>
		</nav>
	</div>

	<div class="row">
		<div class="leftcolumn">
			<h1 style="background-color: green;"> Welcome!</h1>
			<div class="imaginewelcome">
			<img src="homeimage.jpg" alt="Italian Trulli" height="650" width="1027">
			<div class="textimaginewelcome"><p style="font-size: 40px; color: white;">Site destinat pariorilor!</p></div>
			<div class="linkimaginewelcome"><a href="sportbets.php" style="font-size: 30px; color: black;">Click aici pentru a vedea ofertele</a></div>
		</div>
		</div>
		<div class="rightcolumn">
			<h1 style="background-color: gray;">Ticket</h1>

			<div class="bilet_tabela">
				<table>
					<tr>
						<th>Meci</th><th>Pariu</th><th>Cota</th><th>Sterge</th>

						<?php
						$select_ultimul_bilet1 = "SELECT bilet.id as bilet_id FROM bilet, client  WHERE bilet.idClient = client.id AND client.id = '$idClient' ORDER BY bilet.id DESC LIMIT 1";
						$stmt_select_bilet1 = $connect->prepare($select_ultimul_bilet1);
						$stmt_select_bilet1->bindValue(':client.id', $idClient);
						$stmt_select_bilet1->execute(
							array(
								':client.id' => $idClient
							)
						);
						$id_ultimul_bilet1 = $stmt_select_bilet1->fetch(PDO::FETCH_ASSOC);
						$nr_id1 = $id_ultimul_bilet1['bilet_id'];

						$select_pariuri_bilet = "SELECT DISTINCT e1.nume as eGazda, e2.nume as eOaspete, optiuni_pariu_tip.aditionalText as pariu, optiuni_pariu_tip.cota as cota, indice FROM bilet_pariuri, optiuni_pariu_tip, bilet, meciuri, echipe e1, echipe e2  WHERE bilet_pariuri.idOptiuni = optiuni_pariu_tip.id AND bilet_pariuri.idBilet = '$nr_id1' AND optiuni_pariu_tip.idMeci = meciuri.id AND e1.id = meciuri.idEchipa1 AND e2.id = meciuri.idEchipa2";
						$stmt_pariuri_bilet = $connect->prepare($select_pariuri_bilet);
						$stmt_pariuri_bilet->bindValue(':bilet_pariuri.idBilet', $nr_id1);
						$stmt_pariuri_bilet->execute();
						$randuri_pariuri = $stmt_pariuri_bilet->fetchAll();
						foreach($randuri_pariuri as $i){
							echo "
								<tr>
									<td>".$i['eGazda']." - ".$i['eOaspete']."</td>
									<td>".$i['pariu']."</td>
									<td>".$i['cota']."</td>
									<td><form action='sportbets.php' id='deleteBox' method ='post'><input name ='sterge' class ='sterge' type ='submit' value='".$i['indice']."'></form></td>
								</tr>";
						}

						if(isset($_POST["sterge"])){
							$indice =  $_POST["sterge"];
							$delete_pariu = "DELETE FROM bilet_pariuri WHERE indice = '$indice'";
							$stmt_delete_pariu = $connect->prepare($delete_pariu);
							$stmt_delete_pariu->bindValue(':indice', $indice);
							$stmt_delete_pariu->execute();
							echo "<meta http-equiv='refresh' content='0'>";
						}
						?>
						</tr>
				</table>
			</div>
			<div class="bilet_plasare_bilet">
				<form action="sportbets.php" id ="plasareBilet" method = "post">
					<input name="plasare_bilet" class="plasare_bilet" type="submit" value="Pariati">
					<?php

				 if(isset($_POST["plasare_bilet"])){

					 $plasare_bilet = "INSERT INTO bilet_client(idBilet, idClient) VALUES('$nr_id1', '$idClient')";
					 $stmt_plasare_bilet = $connect->prepare($plasare_bilet);
					 $stmt_plasare_bilet->bindValue(':idBilet', $nr_id1);
					 $stmt_plasare_bilet->bindValue(':idClient', $idClient);
					 $stmt_plasare_bilet->execute();
						if($plasare_bilet){
							$insert_bilet = "INSERT INTO bilet(idClient, dataPlasarii) VALUES('$idClient', '$date')";
							$stmt_insert_bilet = $connect->prepare($insert_bilet);
							$stmt_insert_bilet->bindValue(':idClient', $idClient);
							$stmt_insert_bilet->bindValue(':dataPlasarii', $date);
							$stmt_insert_bilet->execute();
							echo "<meta http-equiv='refresh' content='0'>";
							}

						}



				 ?>

				</form>
			</div>
		</div>

	</div>

	</body>

</html>
