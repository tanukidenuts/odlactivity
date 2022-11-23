<!DOCTYPE HTML>  
<html>
	<head>
		<style>
		._error {color: #FF0000;}
		</style>
	</head>
	<body>  

		<?php
			$name_error = $email_error = $gender_error = $website_error = "";
			$name = $email = $gender = $comment = $website = "";

			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				if (empty($_POST["name"])) {
				$name_error = "Name is required";
				} else {
					$name = test_input($_POST["name"]);
					if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
						$name_error = "Only letters and white space allowed";
					}
				}
				  
				if (empty($_POST["email"])) {
					$email_error = "Email is required";
				} else {
					$email = test_input($_POST["email"]);
					if (!preg_match("/[A-Za-z0-9]@(gmail|yahoo).com/",$email)) {
						$email_error = "Only valid email is allowed.";
					}
					if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
						$email_error = "Invalid email format.";
					}
				}
					



				if (empty($_POST["gender"])) {
					$gender_error = "Gender is required";
				} else {
					$gender = test_input($_POST["gender"]);
				}
				}

				function test_input($data) {
					$data = trim($data);
					$data = stripslashes($data);
					$data = htmlspecialchars($data);
					return $data;
			}
		?>

		<h1 style="color: green; font-face: arial; border:2px solid DodgerBlue; width: 450px;">Isabelo PHP Form Validation</h1>
		<p><span class="_error">* required field</span></p>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
			Name: <input type="text" name="name">
			<span class="_error">* <?php echo $name_error;?></span>
			<br><br>
			E-mail: <input type="text" name="email">
			<span class="_error">* <?php echo $email_error;?></span>

			<br><br>
			Gender:
			<input type="radio" name="gender" value="female">Female
			<input type="radio" name="gender" value="male">Male
			<input type="radio" name="gender" value="other">Other
			<span class="_error">* <?php echo $gender_error;?></span>
			<br><br>
			<input type="submit" name="submit" value="Submit">  
		</form>

		<?php
			echo "<h2>My Input:</h2>";
			echo $name;
			echo "<br>";
			echo $email;
			echo "<br>";
			echo $gender;
		?>

	</body>
</html>