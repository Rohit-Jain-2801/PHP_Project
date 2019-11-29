<!-- including database connectivity -->
<?php include('../All_Includes/db.php'); ?>

<!DOCTYPE html>
<html>
	<head>
		<title>Product Page</title>
		<!-- including standard requirements -->
		<?php include("../All_Includes/header.php"); ?>

		<!-- linking custom css file -->
		<link rel="stylesheet" type="text/css" href="gen_product.css" media="screen">
	</head>

	<body>
		<!-- including navbar -->
		<?php include('../All_Includes/nvbr.php'); ?>

		<?php 
			if($connection){
				$query1 = "SELECT pname, descript, price, date1, date2, img0, img1, img2 FROM product WHERE pid=".$_GET['val'];
				$result1 = mysqli_fetch_array(mysqli_query($connection, $query1));
				$query2 = "SELECT date1, date2 FROM orders WHERE pid=".$_GET['val'];
				$execute2 = mysqli_query($connection, $query2);
				function img($x){
					return 'data:image/jpeg;base64,'.base64_encode($x);
				}
			}
		?>

		<!-- image section -->
		<div class="left" style="margin-top: 110px;">
			<div class="text-center">
				<img id="big_img" style="height: 400px;" src="<?php echo img($result1['img0']); ?>" />
			</div>
			<div class="row mt-4">
				<div class="col-4 text-center">
					<img src="<?php echo img($result1['img0']); ?>" onclick="img_chg(this)" />
				</div>
				<div class="col-4 text-center">
					<img src="<?php echo img($result1['img1']); ?>" onerror="this.style.opacity=0" onclick="img_chg(this)" />
				</div>
				<div class="col-4 text-center">
					<img src="<?php echo img($result1['img2']); ?>" onerror="this.style.opacity=0" onclick="img_chg(this)" />
				</div>
			</div>
		</div>

		<!-- descriptive section -->
		<div class="right px-2">
			<h1 class="mt-0 ml-4 pl-4"><?php echo $result1['pname']; ?></h1>
			<p class="ml-4 pl-4"style="font-size: 25px;">&#8377;<strong><?php echo number_format($result1['price']); ?></strong>/day</p>
			<h3 class="mt-4 ml-4 pl-4 pt-2">About:</h3>
			<p class="ml-4 pl-4">
				<?php 
					if($result1['descript']){
						echo $result1['descript'];
					} else{
						echo "No Description Available!";
					}
				?>
			</p>
			
			<!-- booking section -->
			<div class="container px-0 mb-4" style="width: 29rem;" id="tbl">
				<div class="row mx-0">
					<div class="col-6">
						<br>
						<h3 class="pl-1">Issue</h3>
						<input type="date" id="from" name="date1" required>
						<span id="validity1"></span>
					</div>
					<div class="col-6">
						<br>
						<h3 class="pl-1">Return</h3>
						<input type="date" id="till" name="date2" max="<?php echo $result1['date2']; ?>" required>
						<var id="validity2" style="font-style: normal;"></var>
					</div>
					<label id="err"></label>
				</div>

				<div class="flip-card mt-2">
					<div class="flip-card-inner">
						<div class="flip-card-front">
							<button class="btn btn-success mt-4" id="chka" onclick="chkdt()" disabled>Check Availability</button>
							<button class="btn btn-warning mt-4" onclick="chk_usr(0)">Add To Wishlist</button>
						</div>
						<div class="flip-card-back">
							<button class="btn btn-success mt-4" id="crt" onclick="chk_usr(1)">Add To Cart</button>
							<button class="btn btn-warning mt-4" onclick="flip_back()">Back</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<!-- including footer -->
		<div><?php include('../All_Includes/footer.php'); ?></div>

		<!-- including js cdns -->
		<?php include("../All_Includes/btstrpjs.php"); ?>

		<!-- javascript section -->
		<script>
			var a = [];
			date1 = document.getElementById('from');
			date2 = document.getElementById('till');
			// considering check availability button
			btn = document.getElementById('chka');

			// for adding preceding zero
			function chk(x){
				if(x<10){
					x = '0'+x;
				}
				return x;
			}
			
			// runs as page is reloaded
			window.onload = function(){
				btn.style.cursor =  'not-allowed';
				
				// for setting attributes of date fields
				var d = new Date();
				var today = d.getFullYear()+"-"+chk(d.getMonth()+1)+"-"+chk(d.getDate()+1);
				console.log(today);
				date1.setAttribute("value", today);
				date1.setAttribute("min", today);
				date2.setAttribute("min", today);
				
				// for recovering dates from database
				i = 0;
				<?php
					while($result2 = mysqli_fetch_array($execute2)){
						$d1 = date_parse($result2['date1']);
						$d2 = date_parse($result2['date2']);
				?>
						a[i] = [];
						a[i][0] = new Date(String(<?php echo $d1['year']; ?>)+"/"+String(<?php echo $d1['month']; ?>)+"/"+String(<?php echo $d1['day']; ?>));
						a[i][1] = new Date(String(<?php echo $d2['year']; ?>)+"/"+String(<?php echo $d2['month']; ?>)+"/"+String(<?php echo $d2['day']; ?>));
						i+=1;
				<?php
					}
					if(isset($_GET['date1']) & isset($_GET['date2'])){
						$cart_q = "SELECT date1, date2 FROM cart WHERE usr_id={$id} AND pid={$_GET['val']}";
						$cart_r = mysqli_query($connection, $cart_q);
						$chk = true;
						while($row = mysqli_fetch_array($cart_r)){
							if($row['date1']<=$_GET['date1'] && $_GET['date1']<=$row['date2']){
								$chk = false;
							} elseif($row['date1']<=$_GET['date2'] && $_GET['date2']<=$row['date2']){
								$chk = false;
							}
						}

						if($chk){
							$cart_qry = "INSERT INTO cart (usr_id, pid, date1, date2) VALUES({$id}, {$_GET['val']}, '{$_GET['date1']}', '{$_GET['date2']}')";
							$cart_res = mysqli_query($connection, $cart_qry);
							if($cart_res){
								echo "lbl.innerHTML = 'The item is successfully added to cart!';";
							} else{
								echo "lbl.innerHTML = 'The item is NOT added to cart!';";
							}
						} else{
							echo "lbl.innerHTML = 'The item is already added to cart!';";
						}
						echo "setTimeout(function(){ lbl.innerHTML = ''; }, 2000);";
					}
				?>
			}
			console.log(a);

			function chk_usr(num){
				<?php
					if($id){
				?>
						if(num){
							val = new URL(window.location.href);
							document.location.href = '?val='+val.searchParams.get("val")+'&date1='+date1.value+'&date2='+date2.value;
						} else{
							<?php
								$wishlist_q = "SELECT * FROM wishlist WHERE usr_id={$id} AND pid={$_GET['val']}";
								$wishlist_r = mysqli_fetch_array(mysqli_query($connection, $wishlist_q));

								if(!$wishlist_r){
									$wishlist_qry = "INSERT INTO wishlist (usr_id, pid) VALUES({$id}, {$_GET['val']})";
									$wishlist_res = mysqli_query($connection, $wishlist_qry);
									if($wishlist_res){
										echo "lbl.innerHTML = 'The item is successfully added to wishlist!';";
									} else{
										echo "lbl.innerHTML = 'The item is NOT added to wishlist!';";
									}
								} else{
									echo "lbl.innerHTML = 'The item is already added to wishlist!';";
								}
							?>
						}
				<?php
					} else{
						echo "lbl.innerHTML = 'You have log-in first!';";
					}
					echo "setTimeout(function(){ lbl.innerHTML = ''; }, 2000);";
				?>
			}
		</script>

		<!-- linking custom js file -->
		<script type="text/javascript" src="gen_product.js"></script>
	</body>
</html>