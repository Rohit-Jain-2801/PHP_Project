<!DOCTYPE html>
<html>
	<head>
		<title>Payment Page</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	</head>
<body style="background-color: #e6e6e6;">
	<h2 style="text-align: center;margin-top: 50px;">Make your Payment Here:</h2>

	<div class="container" style="margin-top: 80px;padding-left: 140px;padding-right: 140px;">
		<div class="accordion" id="accordionExample" >
			  <div class="card">
			    <div class="card-header" id="headingOne">
			      <h2 class="mb-0">
			        <button style="background-color: white;border:0px solid white" class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
			           <h4>CREDIT/DEBIT CARDS</h4>
			        </button>
			      </h2>
			    </div>

			    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
			      <div class="card-body">
			      	<form>
				        <div id="CD"  style="padding-left: 200px;padding-right: 200px;">
							<div style="font-size: 20px;font-weight: 700;margin: 20px auto;">Name On Card: </div>
								<input style="height: 40px;width: 300px;" type="text" name="" placeholder="Name On Card" required>
							<div style="font-size: 20px;font-weight: 700;margin: 20px auto;">Credit/Debit Card: </div>
								<input style="height: 40px;width: 300px;" type="Number" name="" placeholder="Card Number" required>
							<div style="margin: 30px auto;">
								<span style="font-size: 20px;font-weight: 700;margin: 20px auto;" >Expiry Date: </span>
									<input style="height: 40px;width: 150px;" type="Date" name=""  required>
								<span style="font-size: 20px;font-weight: 700;margin-left: 35px;">CVV: </span>
									<input style="height: 40px;width: 50px;" type="text" name=""  required> 
							</div>
							<div style="margin: 30px auto;">
								<button class="btn btn-primary " style="width: 140px;margin-left: 140px;  "><strong>PAY NOW</strong></button>
							</div>
						</div>
					</form>	
			      </div>
			    </div>
			  </div>
			  <div class="card">
			    <div class="card-header" id="headingTwo">
			      <h2 class="mb-0">
			        <button style="background-color: white;border:0px solid white;text-decoration:none!important;" class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
			          <h4>NETBANKING</h4>
			        </button>
			      </h2>
			    </div>
			    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
			      <div class="card-body">
			        <div id="NB" style="padding-right: 200px;padding-left: 200px;">
			        	<form>
							<div style="font-size: 20px;font-weight: 700;margin: 10px auto;">Bank Name: </div>
								<input style="margin-left: 100px;font-weight: 700;font-size: 100px;" type="radio" name="Bank"><span style="font-weight: 700;font-size: 18px;">HSBC</span> 
								<input style="margin-left: 100px;font-weight: 700;font-size: 100px;" type="radio" name="Bank"><span style="font-weight: 700;font-size: 18px;">ICICI</span> <br>
								<input style="margin-left: 100px;font-weight: 700;font-size: 100px;" type="radio" name="Bank"><span style="font-weight: 700;font-size: 18px;">HDFC</span> 
								<input style="margin-left: 100px;font-weight: 700;font-size: 100px;" type="radio" name="Bank"><span style="font-weight: 700;font-size: 18px;">AXIS</span> <br>
							<div style="font-weight: 700;font-size: 20px;margin: 20px auto;">Customer ID:</div>
								<input style="height: 40px;width: 300px;" type="Number" name="" placeholder="" required>
							<div style="font-weight: 700;font-size: 20px;margin: 20px auto;">Password:</div>
								<input style="height: 40px;width: 200px;" type="password" name="">
							<div style="margin: 30px auto;">
								<button class="btn btn-primary " style="width: 140px;margin-left: 140px;  "><strong>PAY NOW</strong></button>
							</div>
						</form>
					</div>
			      </div>
			    </div>
			  </div>
			  <div class="card">
			    <div class="card-header" id="headingThree">
			      <h2 class="mb-0">
			        <button style="background-color: white;border:0px solid white" class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
			          <h4>CASH ON DELIVERY</h4>
			        </button>
			      </h2>
			    </div>
			    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
			      <div class="card-body">
			        <div id="PD" style="padding-left: 200px;padding-right: 200px;">
			        	<form>
							<div style="font-weight: 700;font-size: 20px;margin: 20px auto;">Total Amount To be Paid:</div>
							<div style="margin: 30px auto;">
								<button class="btn btn-primary " style="width: 140px;margin-left: 140px;  "><strong>PAY NOW</strong></button>
							</div>
						</form>
					</div>
			      </div>
			    </div>
			  </div>
		</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>