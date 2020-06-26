<?php
	require_once('connect.php');
	session_start();
	$message="";
	if(isset($_SESSION["username"]))
	{
		$user = $_SESSION["username"];
		#echo '<h3 style="text-align: center;text-transform: uppercase;font-size:30px;color: blue">Welcome -'.$_SESSION["username"].'</h3>';

	}
	else
	{
		header("location:welcome.php");
		die();
	}

	$query = "SELECT COUNT(bilet.id) AS numBets FROM bilet,client WHERE client.id = bilet.idClient AND client.username='$user'";
	$statement = $connect->prepare($query);
	$statement->bindValue(':client.username', $user);
	$statement->execute(
		array(
			':client.username' => $user
		)
	);
	$row = $statement->fetch(PDO::FETCH_ASSOC);
	$result = $row['numBets'];

if(isset($_POST["change"])){
	if(empty($_POST["curPass"]) || (empty($_POST["newPass"])) || (empty($_POST["newPassConf"]))){
		$message = "All fields must be completed";
	}
	else if($_POST["newPass"] !== $_POST["newPassConf"]){
			$message = "New password fields does not match!!";
	}
	else{
		$curr = $_POST["curPass"];
		$newPass = $_POST["newPass"];
		$q = "SELECT passwordd FROM client WHERE username ='$user'";
		$s = $connect->prepare($q);
		$s->execute();
		$r = $s->fetchAll();

		foreach ($r as $rr) {
				if($rr['passwordd'] !== $_POST["curPass"]){
					$message = "Sorry! Current password isn't this.Try Again!";
			}
			else{
				try{
					$newPassHash = password_hash($_POST["newPass"], PASSWORD_BCRYPT, array("cost" => 12));
					$query_Update = "UPDATE client SET passwordd ='$newPass'  WHERE username = '$user'";
					$stmt = $connect->prepare($query_Update);
					$res = $stmt->execute();

					if($res)
					{
						$message="Password changed!";
					}

				}
				catch(PDOException $e){
					echo $e->getmessage();
					exit();
				}
			}
		}


	}


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
			background-color: gray;
		}

		@viewport{
			zoom: 1.0;
			width: extend-to-zoom;
		}
		@-ms-viewport{
			width:extend-to-zoom;
			zoom: 1.0;
		}

		#formsettings{
			text-align: center;
		}



	</style>


	<head>
		<meta name = "viewport" content="width=device-width, initial-scale =1">
	<title>Settings</title>
	</head>
	<body>
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
								<a href="settings.php"  class="active">Settings</a>
								<a href="mybets.php">My bets</a>
								<a href="logout.php">Logout</a>
							</div>
					</div>
				</ul>
			</nav>
		</div>

		<br><br><h1 style="text-align: center;">Your account!</h1>
		<p style="text-indent:30px;">-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</p>
		<br><br><h2 style="text-indent: 80px;">Your username: <?php echo $user ?> </h2>

		<br><br><h2 style="text-indent: 80px;">Number of bets: <?php echo $result ?> </h2>

		<br><br><br><h2 style="text-indent: 200px;">Change your password: </h2>
		<br>
		<form id="formsettings" method="post">
			<label for="curPass"><h3>Current password: </h3></label>
			<input type="password" id="curPass" name="curPass"><br><br>
			<label for="newPass"><h3>New password: </h3></label>
			<input type="password" id="newPass" name="newPass"><br><br>
			<label for="newPassConf"><h3>New password confirmation: </h3></label>
			<input type="password" id="newPassConf" name="newPassConf"><br><br>
			<input type = "submit"  id = "changePass_submit" name="change" value="Update password">
		</form>

		<?php
		if(isset($message)){
			echo '<label class="text-danger" style="font-size:30px; color:red; text-transform:uppercase; text-align:center;">'.$message.'</label>';
		}
		?>

	</body>

</html>
