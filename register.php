<?php
	require_once('connect.php');

	$message="";
	$message1="";



	if(isset($_POST["register"]))
	{
		if(empty($_POST["newuser"]) || (empty($_POST["newpw"])) || (empty($_POST["cnewpw"])))
		{
			$message = "All fields must be completed";
		}
		else if($_POST["newpw"] !== $_POST["cnewpw"])
		{
			$message = "Passwords don't matched";
		}
		else
		{
			try
			{
				$user = $_POST["newuser"];
				$pass = $_POST["newpw"];
				$query = "SELECT COUNT(username) AS num FROM client WHERE username = '$user'";
				$statement = $connect->prepare($query);
				$statement->bindValue(':username', $user);
				$statement->execute(
					array (
						':username' => $user
					)
				);
				$row = $statement->fetch(PDO::FETCH_ASSOC);

				if($row['num'] > 0)
				{
					$message = "That username already exists";
				}
				else
				{
					$passwordHash = password_hash($_POST["newpw"], PASSWORD_BCRYPT, array("cost" => 12));

					$query = "INSERT INTO client (username, passwordd) VALUES ('$user', '$pass')";
					$statement = $connect->prepare($query);
					$statement->bindValue(':username', $user);
					$statement->bindValue(':passwordd', $passwordHash);

					$result = $statement->execute();

					if($result)
					{
						$message = "Account created";
						$messag1 = "Please login ";

					}
				}
			}
			catch(PDOException $e) {
				echo $e->getmessage();
				exit();
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

		#cap {
			text-align: center;
		}

		#form1 {
			text-align: center;
		}

		#newuser {
			width: 30%;
			padding: 15px 18px;
			margin: 8px 0;
			box-sizing: border-box;
			border: 2px solid black;
			border-radius: 4px;
		}

		#newpw {
			width: 30%;
			padding: 15px 18px;
			margin: 8px 0;
			box-sizing: border-box;
			border: 2px solid black;
			border-radius: 4px;
		}

		#registersubmit {
			width: 10%;
			height: 40px;
		}

		#cnewpw {
			width: 30%;
			padding: 15px 18px;
			margin: 8px 0;
			box-sizing: border-box;
			border: 2px solid black;
			border-radius: 4px;
		}

		#questions {
			width: 30%;
			padding: 15px 18px;
			margin: 8px 0;
			box-sizing: border-box;
			border: 2px solid black;
			border-radius: 4px;
		}

		#answer {
			width: 30%;
			padding: 15px 18px;
			margin: 8px 0;
			box-sizing: border-box;
			border: 2px solid black;
			border-radius: 4px;
		}


	</style>
	<body>
		<title>Register</title>

		<h1 id="cap">Register</h1>

		<form id="form1" method="post">
			<label for="newuser">New user:</label><br>
			<input type="text" id="newuser" name="newuser"><br>
			<label for="newpw">New password:</label><br>
			<input type="password" id="newpw" name="newpw"><br>
			<label for="confirmnewpw">Confirm new password:</label><br>
			<input type="password" id="cnewpw" name="cnewpw"><br>
			<input type="submit" id="registersubmit" name="register" value="Register">
		</form>

		<?php
		if(isset($message))
		{
			echo '<label class="text-danger" style="font-size:30px; color:red; text-transform:uppercase;">'.$message.'</label>';
			echo '<label style="font-size:30px;text-transform:uppercase;">'.$message1.'.<a href="welcome.php"><br>Back</a></label>';
		}

		?>
	</body>
</html>
