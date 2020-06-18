<?php
	session_start();
	require_once('connect.php');
	$message = "";

	if(isset($_POST["login"]))
	{
		if(empty($_POST["username"]) || empty($_POST["password"]))
		{
			$message = '<label>All fields are required !</label>';
		}
		else
		{	if(isset($_POST["username"]))
			{
			$user = $_POST["username"];
			}
			if(isset($_POST["password"]))
			{
			$pass = $_POST["password"];
			}

			$query = "SELECT COUNT(username) AS num FROM client WHERE username = '$user' AND passwordd = '$pass'";
			$statement = $connect->prepare($query);
			$statement->bindValue(':username', $user);
			$statement->bindValue(':passwordd', $pass);
			$statement->execute(
				array(
					':username' => $user,
					':passwordd' => $pass
				)
			);
			$count = $statement->fetch(PDO::FETCH_ASSOC);
			if($count['num'] > 0)
			{
				$_SESSION["username"] = $_POST["username"];
				header("location:logins.php");
			}
			else
			{
				$message= '<label>Wrong username or password !</label>';
			}
		}
	}
?>

<html>
	<style>
		body {
			background-image:url("1.jpg");
			background-repeat: no-repeat;
			background-position: left top;
			background-attachment: fixed;
		}

		#bunvenit{
			text-align: center;
			text-transform: uppercase;
		}

		#form1{
			text-align: center;
		}

		#username{
			width: 30%;
			padding: 15px 18px;
			margin: 8px 0;
			box-sizing: border-box;
			border: 2px solid black;
			border-radius: 4px;
		}

		#password{
			width: 30%;
			padding: 15px 18px;
			margin: 8px 0;
			box-sizing: border-box;
			border: 2px solid black;
			border-radius: 4px;
		}

		#submit{
			width: 10%;
			height: 40px;
		}

		#register {
			width: 10%;
			height: 40px;
		}

		#noaccount {
			text-align: center;
		}


	</style>


	<body>


		<title>Welcome</title>
	
		<h1 id="bunvenit">Welcome! <br>
		Login to continue</h1>
		<br><br><br><br><br><br>
		<form id="form1" method="post">
			<label for="username">Username:</label><br>
			<input type = "text" id="username" name="username"><br>
			<label for="password">Password:</label><br>
			<input type="password" id="password" name="password"><br>
			<input type ="submit" id="submit" name="login" value="Sign-in">
		</form>

		<p id="noaccount">
			Not user? <a id="registerurl" href="register.php">Register</a>
		</p>

		<?php
		if(isset($message))
		{
			echo '<label class="text-danger" style="font-size:30px; color:red; text-transform:uppercase;">'.$message.'</label>';
		}

		?>
	</body>
</html>
