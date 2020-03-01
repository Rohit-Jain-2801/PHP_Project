<?php
	// linking database
	include('../All_Includes/db.php');

	// for encryption
	include('../All_Includes/hash.php');

	// for google login
	// require_once "../All_Includes/google_setup.php";
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>User Authentication</title>
		<!-- including standard requirements -->
		<?php include('../All_Includes/header.php'); ?>

		<!-- linking custom css file -->
		<link rel="stylesheet" type="text/css" href="login.css" media="screen">
	</head>
	<body>
		<button onclick="location.href = '../Landing_Page/home.php';" class="p-1 ml-2 mb-4" style="width: 100px;"><i class="fas fa-arrow-circle-left mr-2"></i>Home</button>
		<div class="container" id="container">
			<div class="form-container sign-up-container">
				<form action="?val=1" method="POST">
					<h2 class="mb-2 text-center">Create Account</h2>
					<?php
						if(!isset($_SESSION)){
							session_start();
						}
						if(!isset($_SESSION['pg'])){
							$_SESSION['pg'] = 2;
						}

						if($connection){
							// for sign-in
							if(isset($_POST['sign'])){
								$name = $_POST['name'];
								$email_id = $_POST['email_id'];
								$password = secret($_POST['password']);
								$phone_no = $_POST['phone_no'];

								$query = "SELECT * FROM users WHERE email = '{$email_id}'";
								$feth_query =  mysqli_fetch_array(mysqli_query($connection, $query));
						
								if($feth_query!=null){
									echo "<h6 style='color: red;'>Email Already Registered!</h6>";
									$_SESSION['pg']++;
								} else {
									$query = "INSERT INTO users(cust_name, email, pswrd, phone) VALUES('{$name}', '{$email_id}', '{$password}', {$phone_no})";
									$create_user_query = mysqli_query($connection, $query);
									$_SESSION['pg']++;
									echo "<h6 style='color: green;'>Registeration Successfull!</h6>";
								}
							}
						}
					?>
					<input type="text" placeholder="Name" name="name" required/>
					<input type="text" placeholder="Email" pattern="[a-z0-9._+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" oninvalid="this.setCustomValidity('Invalid Email!')" oninput="this.setCustomValidity('')" name="email_id" required/>
					<input type="password" placeholder="Password" name="password" required/>
					<input type="number" min="1000000000" max="9999999999" oninvalid="this.setCustomValidity('Invalid Mobile No.!')" oninput="this.setCustomValidity('')" placeholder="Phone Number" name="phone_no" required/>
					<button class="mt-2" id="sign" type="submit" style="border-radius: 10px;" name="sign">Sign Up</button>
					<!-- <label class="my-2">OR</label> -->
					<!-- <button type="button" onclick="window.location = '<php echo $client->createAuthUrl(); ?>';" style="border-radius: 10px;"><i class="fab fa-google mr-2"></i>Sign In With Google</button> -->
				</form>
			</div>

			<div class="form-container sign-in-container">
				<form action="" method="POST">
					<h2 class="mb-2 text-center">Login</h2>
					<?php
						if($connection){
							// for login
							if(isset($_POST['login'])){
								$email_id = $_POST['email'];
								$password = secret($_POST['password']);

								$query = "SELECT usr_id, pswrd FROM users WHERE email = '{$email_id}'";    // SELECT usr_id, pswrd FROM users WHERE email = 'rohitrocks2801@gmail.com';
								// $query = "SELECT usr_id, pswrd FROM users WHERE email = ".$email_id;    // SELECT usr_id, pswrd FROM users WHERE email = rohitrocks2801@gmail.com; => WRONG
								$user_query = mysqli_query($connection, $query);
								
								if($user_query){
									$fetch_query = mysqli_fetch_array($user_query);
									$db_password = $fetch_query['pswrd'];
									
									if($db_password == $password){
										// including session section
										include('../All_Includes/session.php');
										
										set_sess($fetch_query['usr_id'], $email_id);
										
										$var = $_SESSION['pg'];
										unset($_SESSION['pg']);
										echo "<script> history.go(-{$var}) </script>";
									} else {
										echo "<h6 style='color: red'>Incorrect Email or Password!</h6>";
										$_SESSION['pg']++;
									}
								}
							}
						}
						// closing database connection
						mysqli_close($connection);
					?>
					<h6 id="em_lbl"></h6>
					<?php
						if(isset($_GET['mail'])){
							$_SESSION['pg']++;
						}
					?>
					<input type="email" name="email" placeholder="Email" required />
					<input type="password" name="password" placeholder="Password" required />
					<a onclick="mail_chk()" id="pswrd">Forgot your password?</a>
					<button id="login" name="login" style="border-radius: 10px;" type="submit">Login</button>
				</form>
			</div>

			<div class="overlay-container">
				<div class="overlay">
					<div class="overlay-panel overlay-left">
						<h1>Welcome Back!</h1>
						<p>To keep connected with us please login with your personal info</p>
						<button class="ghost" id="signIn">LOGIN</button>
					</div>
					<div class="overlay-panel overlay-right">
						<h1>Hello, Friend!</h1>	
						<p>Enter your personal details and start journey with us</p>
						<button class="ghost" id="signUp">SIGN UP</button>
					</div>
				</div>
			</div>
		</div> 
		
		<!-- including js cdns -->
		<?php include('../All_Includes/btstrpjs.php'); ?>

		<!-- linking custom javascript file -->
		<script type="text/javascript" src="login.js"></script>
	</body>
</html>