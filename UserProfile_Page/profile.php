<?php
	// including database connectivity
	include('../All_Includes/db.php');

	// including hashing file
	include('../All_Includes/hash.php');
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Profile</title>
		<!-- including standard requirements -->
		<?php include('../All_Includes/header.php'); ?>

		<!-- linking custom css -->
		<link rel="stylesheet" type="text/css" href="profile.css">
	</head>
	<body>
		<!-- including navbar -->
		<?php include('../All_Includes/nvbr.php'); ?>

		<!-- profile main starts here -->
		<div class="container" style="margin-top: 110px;">

			<!-- dividing into two sections -->
			<div class="row">

				<div class="col-md-4 mb-4 mb-md-0">
					<div class="text-center py-2" id="shadow">
						<i class="fas fa-user-circle fa-5x"></i>
						<h5 class="mt-2">Welcome User!</h5>
					</div>

					<!-- navigation panel -->
					<div class="mt-4" id="shadow">
						<button class="slct pt-3" onclick="slct_all_frm('mo')"><i class="fas fa-box-open mr-2" style="color: blue;"></i>My Orders</button>
						<hr>
						<button class="slct" onclick="slct_all_frm('mp')"><i class="fas fa-upload mr-2" style="color: blue;"></i>My Posts</button></<i>
						<hr>
						<div class="accordion" id="accordionExample">
							<div class="card border-0">
								<div class="card-header p-0" id="headingOne">
									<button class="slct pb-3" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne"><i class="fas fa-user-cog mr-2" style="color: blue;"></i>Account Setting</button>
								</div>

								<div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
									<div class="card-body py-1" style="padding-left: 30px;">
										<button class="slct py-2" onclick="slct_all_clr('pib', 'pi')" id="pib"><i class="fas fa-caret-right mr-2"></i>Personal Information</button>
										<button class="slct py-2" onclick="slct_all_clr('mab', 'ma')" id="mab"><i class="fas fa-caret-right mr-2"></i>Manage Addresses</button>
										<button class="slct py-2" onclick="slct_all_clr('pb', 'p')" id="pb"><i class="fas fa-caret-right mr-2"></i>Privacy</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- main content section -->
				<div class="col-md-8 px-5 px-md-1 px-xl-4 mb-4" id="shadow" style="min-height: 510px;">
					<?php
						if($connection){
							if($id){
					?>
								<!-- personal information -->
								<div id="pi">
									<?php
										// checking & updating the database
										if(isset($_POST["uname"])){
											$q00 = "UPDATE users SET cust_name='{$_POST["uname"]}', gender={$_POST["gender"]}, email='{$_POST["email"]}', phone={$_POST["tel"]} WHERE usr_id={$id}";
											$r00 = mysqli_query($connection, $q00);
										}

										// retrieving contents
										$q1 = "SELECT cust_name, gender, email, phone FROM users WHERE usr_id={$id}";
										$r1 = mysqli_fetch_array(mysqli_query($connection, $q1));
									?>
									<form action="" method="POST">
										<h3 class="py-4 text-center">Personal Information</h3>

										<?php
											if($r00){
												echo "<p style='text-align: center; color: green;'>Your Personal Information is updated!</p>";
											} elseif(isset($_POST["uname"])){
												echo "<p style='text-align: center; color: red;'>Your Personal Information updation Failed!</p>";
											}
										?>

										<label for="uname" class="font-weight-bold">Name</label>
										<input class="form-control" type="text" id="uname" name="uname" placeholder="User Name" value="<?php echo $r1['cust_name']; ?>" required>

										<label class="my-3 font-weight-bold">Gender</label>
										<br>
										<input type="radio" name="gender" value="0" id="m" <?php if($r1['gender']==0){ echo 'checked'; } ?> />
										<label class="mr-2" for="m">Male</label>
										<input type="radio" name="gender" value="1" id="f" <?php if($r1['gender']==1){ echo 'checked'; } ?> />
										<label class="mr-2" for="f">Female</label>
										<input type="radio" name="gender" value="2" id="n" <?php if($r1['gender']==2){ echo 'checked'; } ?> />
										<label for="n">Prefer not to say</label>
										<br>

										<label for="email" class="font-weight-bold mt-2">Email</label>
										<input class="form-control" type="text" id="email" name="email" pattern="[a-z0-9._+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" oninvalid="this.setCustomValidity('Invalid Email!')" oninput="this.setCustomValidity('')" value="<?php echo $r1['email']; ?>" placeholder="Email-Id" required>

										<label for="tel" class="font-weight-bold mt-3">Mobile No.</label>
										<input class="form-control" type="number" id="tel" name="tel" min="1000000000" max="9999999999" oninvalid="this.setCustomValidity('Invalid Mobile No.!')" oninput="this.setCustomValidity('')" value="<?php echo $r1['phone']; ?>" placeholder="Contact No." required>

										<button type="submit" class="btn btn-primary my-3">Update</button>
									</form>
								</div>

								<!-- manage address -->
								<div id="ma">
									<?php
										// updating the database
										if(isset($_POST["addr"])){
											$q01 = "UPDATE users SET adrs='{$_POST["addr"]}', locality='{$_POST["local"]}', city='{$_POST["city"]}', pin={$_POST["pin"]}, cstate='{$_POST["state"]}' WHERE usr_id={$id}";
											$r01 = mysqli_query($connection, $q01);
										}

										// retrieving contents
										$q2 = "SELECT adrs, locality, city, pin, cstate FROM users WHERE usr_id={$id}";
										$r2 = mysqli_fetch_array(mysqli_query($connection, $q2));
									?>
									<form action="" method="POST">
										<h3 class="py-4 text-center">Change Address</h3>

										<?php
											if(isset($_GET['addr']) && $r2[0]==NULL){
												echo "<h6 class='text-center' style='color: red;'>Please fill out your Address first!</h6><br/>";
											}

											if($r01){
												echo "<p style='text-align: center; color: green;'>Your Address is updated!</p>";
											} elseif(isset($_POST["addr"])){
												echo "<p style='text-align: center; color: red;'>Your Address updation Failed!</p>";
											}
										?>

										<label for="add" class="font-weight-bold">Address</label>
										<input class="form-control mb-3" type="text" id="add" name="addr" placeholder="Address" value="<?php echo $r2['adrs']; ?>" required>
										
										<label for="local" class="font-weight-bold">Locality</label>
										<input class="form-control mb-3" type="text" id="local" name="local" placeholder="Locality" value="<?php echo $r2['locality']; ?>" required>
										
										<label for="city" class="font-weight-bold">City</label>
										<input class="form-control mb-3" type="text" id="city" name="city" placeholder="City" value="<?php echo $r2['city']; ?>" required>

										<label for="pin" class="font-weight-bold">PinCode</label>
										<input class="form-control mb-3" type="number" name="pin" min="100000" max="999999" oninvalid="this.setCustomValidity('Invalid PinCode!')" oninput="this.setCustomValidity('')" id="pin" placeholder="Pincode" value="<?php echo $r2['pin']; ?>" required>

										<label for="state" class="font-weight-bold">State</label>
										<input class="form-control" type="text" id="state" name="state" placeholder="State" value="<?php echo $r2['cstate']; ?>" required>

										<button type="submit" class="btn btn-primary my-3">Update Address</button>
									</form>
								</div>

								<!-- privacy -->
								<div id="p">
									<h3 class="py-4 text-center">Change Password</h3>
									<?php
										// updating database
										if(isset($_POST["current"])){
											// checking for new & confirm passwords
											if($_POST['new']==$_POST['confirm']){
												$q02 = "SELECT pswrd FROM users WHERE usr_id={$id}";
												$r02 = mysqli_fetch_array(mysqli_query($connection, $q02))[0];

												// checking for old password to be authentic
												if(secret($_POST['current'])==$r02){
													$new_pass = secret($_POST["new"]);
													$q03 = "UPDATE users SET pswrd='{$new_pass}' WHERE usr_id={$id}";
													$r03 = mysqli_query($connection, $q03);
													if($r03){
														echo "<p style='text-align: center; color: green;'>Your password is updated!</p>";
													}
												} else{
													echo "<p style='text-align: center; color: red;'>Current Password is Incorrect!</p>";
												}
											} else{
												echo "<p style='text-align: center; color: red;'>New & Confirm Passwords doesn't match!</p>";
											}
										}
									?>
									<form action="" method="POST">
										<label for="current" class="font-weight-bold">Current Password</label>
										<input class="form-control mb-3" type="password" id="current" name="current" required>

										<label for="new" class="font-weight-bold">New Password</label>
										<input class="form-control mb-3" type="password" id="new" name="new" required>

										<label for="confirm" class="font-weight-bold">Confirm New Password</label>
										<input class="form-control" type="password" id="confirm" name="confirm" required>

										<button type="submit" class="btn btn-primary my-3">Change Password</button>
									</form>
								</div>

								<!-- my orders -->
								<div class="container" id="mo">
									<h3 class="py-4 text-center">My Orders</h3>
						
									<?php
										// retrieving contents
										$q3 = "SELECT * FROM orders WHERE usr_id={$id}";
										$r3 = mysqli_query($connection, $q3);
										$c = 0;

										while ($row3 = mysqli_fetch_array($r3)){
											$c++;
											$q4 = "SELECT pname, img0 FROM product WHERE pid={$row3['pid']}";
											$r4 = mysqli_fetch_array(mysqli_query($connection, $q4));
											
											$dlt = "../All_Includes/delete.php?tab=orders&u_id={$id}&p_id={$row3['pid']}&url=".htmlspecialchars($_SERVER["PHP_SELF"]);
									?>
											<div class="card mb-3" id="shadow">
												<div class="row no-gutters">
													<div class="col-md-4 text-center">
														<img src='<?php echo "data:image/jpeg;base64,".base64_encode($r4["img0"]); ?>' style="height: 150px;" />
													</div>
													<div class="col-md-8">
														<div class="card-body py-auto">
															<h5 class="card-title font-weight-bold" style="display: inline-block;"><?php echo $r4['pname']; ?></h5>
															<span class="float-right">Order id: <strong><?php echo $row3['order_id']; ?></strong></span>
															<p class="card-text mb-2 mb-md-1 mb-lg-2">
																<span>Start Date: <strong><?php echo $row3['date1']; ?></strong></span>
																<span class="d-md-block float-right float-md-none float-lg-right mt-md-1 mt-lg-0">End Date: <strong><?php echo $row3['date2']; ?></strong></span>
															</p>
															<span>Price: <strong><?php echo "Rs.".$row3['price']; ?></strong></span>

															<div class="shft">
																<a href="../Product_Page/gen_product.php?val=<?php echo $row3['pid']; ?>" class="btn btn-primary ml-xl-4">View Details</a>
																<button onclick="location.href='<?php echo $dlt; ?>'" class="btn btn-danger ml-2" <?php if($row3['date1']<=date('Y-m-d')){ echo 'disabled style="cursor: not-allowed;"'; } ?>>Cancel Order</button>
															</div>
														</div>
													</div>
												</div>
											</div>
									<?php
										}
										if($c==0){
											echo "<h2 class='text-center' style='color: green; margin-top: 190px; margin-bottom: 210px;'>Place your first order!</h2>";
										}
									?>
								</div>

								<!-- my posts -->
								<div class="container" id="mp">
									<h3 class="py-4 text-center">My Posts</h3>
									
									<!-- linking selling page -->
									<a href="../Selling_Page/selling.php" class="mb-4 btn btn-light nw-pst">+ Add a New Post</a>
									
									<?php
										// retrieving contents
										$q5 = "SELECT pid, pname, img0, price, date1, date2 FROM product WHERE usr_id={$id}";
										$r5 = mysqli_query($connection, $q5);
										$c = 0;

										while ($row5 = mysqli_fetch_array($r5)){
											$c++;
											$dlt = "../All_Includes/delete.php?tab=product&u_id={$id}&p_id={$row5['pid']}&url=".htmlspecialchars($_SERVER["PHP_SELF"]);
											$chk = true;

											// for delete button availability
											$q = "SELECT date2 FROM orders WHERE pid = {$row5['pid']} AND usr_id = {$id}";
											$r = mysqli_query($connection, $q);

											while($row = mysqli_fetch_array($r)){
												if($row[0]>=date('Y-m-d')){
													$chk = false;
													break;
												}
											}
									?>
											<div class="card mb-4" id="shadow">
												<div class="row no-gutters">
													<div class="col-md-4 text-center">
														<img src='<?php echo "data:image/jpeg;base64,".base64_encode($row5["img0"]); ?>' style="height: 150px;" />
													</div>
													<div class="col-md-8">
														<div class="card-body py-auto">
															<h5 class="card-title font-weight-bold" style="display: inline-block;"><?php echo $row5['pname']; ?></h5>
															<p class="card-text mb-md-1 mb-lg-2">
																<span>Start Date: <strong><?php echo $row5['date1']; ?></strong></span>
																<span class="d-md-block float-right float-md-none float-lg-right mt-md-1 mt-lg-0">End Date: <strong><?php echo $row5['date2']; ?></strong></span>
															</p>
															<span>Price: <strong><?php echo "Rs.".$row5['price']; ?></strong></span>

															<div class="shft">
																<a href="../Selling_Page/selling.php?val=<?php echo $row5['pid']; ?>" class="btn btn-primary ml-3 ml-sm-5 ml-md-4 ml-lg-5">Update</a>
																<button onclick="location.href='<?php echo $dlt; ?>'" class="btn btn-danger ml-4" <?php if(!$chk){ echo 'disabled style="cursor: not-allowed;"'; } ?>>Delete</button>
															</div>
														</div>
													</div>
												</div>
											</div>
									<?php
										}
										if($c==0){
											echo "<h2 class='text-center' style='color: green; margin-top: 160px; margin-bottom: 180px;'>Place your first post!</h2>";
										}
									?>
								</div>

					<?php
							} else{
								echo "<h2 class='text-center' style='color: red; margin: 220px 0px;'>You have to login first!</h2>";
							}
							// closing database connection
							mysqli_close($connection);
						} else{
							echo "<h2 class='text-center' style='color: red; margin-top: 200px;'>Unable to connect!</h2>";
							echo "<h2 class='text-center' style='color: red; margin-bottom: 51px;'>Please check your internet connection!</h2>";
						}
					?>
				</div>
			</div>
		</div>
		
		<!-- including footer -->
		<?php include('../All_includes/footer.php'); ?>

		<!-- including js cdns -->
		<?php include('../All_Includes/btstrpjs.php'); ?>

		<!-- including custom js file -->
		<script type="text/javascript" src="profile.js"></script>

		<!-- deciding which setion to display after page reloads -->
		<?php
			if(isset($_POST['uname'])){ echo "<script> window.slct_all_clr('pib', 'pi'); </script>"; }
			else if(isset($_POST['addr']) || isset($_GET['addr'])){ echo "<script> window.slct_all_clr('mab', 'ma'); </script>"; }
			else if(isset($_POST['current'])){ echo "<script> window.slct_all_clr('pb', 'p'); </script>"; }
			else{ echo "<script> window.slct_all_clr('', 'mo'); </script>"; }
		?>
	</body>
</html>