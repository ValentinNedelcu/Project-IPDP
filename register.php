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
