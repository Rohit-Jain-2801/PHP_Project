<!DOCTYPE html>
<html>
	<head>
		<title>Continue Shopping</title>
		<!-- including standard requirements -->
		<?php include("../All_Includes/header.php"); ?>
	
		<style>
			@media screen and (max-width: 775px){
				.fnt{
					font-size: 4vw;
				}
			}
		</style>
	</head>
	<body>
		<!-- including navbar -->
		<?php include('../All_Includes/nvbr.php'); ?>

		<div class="container text-center" style="margin-top: 120px; margin-bottom: 40px">
			<div class="jumbotron">
				<h3 class="fnt">Make your Payment at the Time of Delivery..!</h3>	
				<h1 class="mt-4 fnt">Thank You For Shopping...!</h1>
				
				<a class="btn btn-primary py-3 mt-4 font-weight-bold" href="../Landing_Page/home.php">Continue Shopping</a>
			</div>
		</div>

		<!-- including footer -->
		<?php include('../All_Includes/footer.php'); ?>

		<!-- including js cdns -->
		<?php include("../All_Includes/btstrpjs.php") ?>
	</body>
</html>