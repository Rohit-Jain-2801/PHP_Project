<!-- including database connectivity -->
<?php include('../All_Includes/db.php'); ?>

<!DOCTYPE html>
<html>
    <head>
        <title>Cart Page</title>
        <!-- including standard requirements -->
        <?php include("../All_Includes/header.php"); ?>

        <!-- custom css -->
        <link rel="stylesheet" type="text/css" href="cart.css">
    </head>

    <body>
        <!-- including navbar -->
        <?php include('../All_Includes/nvbr.php'); ?>

        <!-- cart main starts here -->
        <div class="container-fluid">
            <h2 class="text-center py-4 mb-4" style="margin-top: 105px;">My Cart</h2>

            <?php
                if(isset($_GET['val'])){
                    if($_GET['val']){
                        echo "<h6 class='text-center' style='color: red;'>Your one item is already been booked by someone else!</h6>";
                    } else{
                        echo "<h6 class='text-center' style='color: red;'>Your item is no longer available!</h6>";
                    }
                    // echo "<h6 class='text-center' style='color: green;'>It has been moved to wishlist!</h6>";
                    // echo "<br/>";
                }
                if(isset($_GET['var'])){
                    if($_GET['var']==1){
                        echo "<h6 class='text-center' style='color: green;'>The item is successfully added to wishlist!</h6>";
                    } elseif($_GET['var']==2){
                        echo "<h6 class='text-center' style='color: green;'>The item is already added to wishlist!</h6>";
                    } else{
                        echo "<h6 class='text-center' style='color: red;'>The item is NOT added to wishlist!</h6>";
                    }
                    echo "<br/>";
                }

                if($connection){
                    $query = "SELECT pid, date1, date2 FROM cart WHERE usr_id={$id}";
                    $result = mysqli_query($connection, $query);
            ?>
                    <table class="shadow table table-hover table-responsive-lg item_length text-center align-middle">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Item</th>
                                <th>Price</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Sub-Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
            <?php
                    if (!$result ||  mysqli_num_rows($result) == 0 ) {
                        echo "</table>";
                        echo "<h1 class='text-center mt-4' style='margin-bottom: 159px; color: red;'>Sorry! Your cart is empty!</h1>";
                    } else {
                        $total_price = 0;
                        while ($row = mysqli_fetch_array($result)) {
                            $query2 = "SELECT pname, price, date1, date2, img0 FROM product WHERE pid={$row['pid']}";
                            $row2 = mysqli_fetch_array(mysqli_query($connection, $query2));

                            $sdate = $row['date1']>date('Y-m-d')?$row['date1']:date('Y-m-d');
                            $edate = $row['date2']>date('Y-m-d')?$row['date2']:date('Y-m-d');
                            $price = $row2['price'];

                            $days = strtotime($edate) - strtotime($sdate); 
                            $d = abs(round($days / (60*60*24)))+1;
                            $amt = $d * $price; 
                            $total_price += $amt;
            ?>
                            <tbody>
                                <tr>
                                    <td><img src="<?php echo 'data:image/jpeg;base64,'.base64_encode($row2['img0']); ?>" style="max-height: 100px;"/></td>
                                    <td style="font-size: 20px;"><strong><?php echo $row2['pname']; ?></strong></td>
                                    <td><?php echo "Rs. ".$price; ?></td>
                                    <td><?php echo $sdate; ?></td>
                                    <td><?php echo $edate; ?></td>
                                    <td><?php echo "Rs. ".$amt; ?></td>
                                    <td>
                                        <a class="btn btn-danger" style="width: 145px;" href='<?php echo "../All_Includes/delete.php?tab=cart&u_id={$id}&p_id={$row['pid']}&url=".htmlspecialchars($_SERVER["PHP_SELF"]); ?>'>Delete</a>
                                        <br>
                                        <a href="<?php echo "add_to_wish.php?u_id=".$id."&crt_prd=".$row['pid']; ?>" class="btn btn-primary mt-2">Move To Wishlist</a>
                                    </td>
                                </tr>
            <?php 
                        }
            ?>
                            </tbody>
                        </table>

            <?php
                        $bgd = $total_price>1000?100:0;
                        $tax = (18*$total_price)/100;
                        $deliverycharges = $total_price<500?100:0;
                        $ordertotal = $total_price + $tax + $deliverycharges - $bgd;
            ?>

                        <div class="row mt-4">
                            <div class="col-8 col-md-6 col-lg-5 mx-auto">
                                <div class="card">
                                    <div class="card-body p-0">
                                        <div class="card-header text-center"><strong>Total Amount</strong></div>
                                        <div class="card-body">
                                            <div>Bag Total<span><?php echo "Rs. ".$total_price; ?></span></div>
                                            <br>
                                            <div>Bag Discount<span><?php echo "Rs. -".$bgd; ?></span></div>
                                            <br>
                                            <div>Tax<span><?php echo "Rs. ".$tax; ?></span></div>
                                            <br>
                                            <div>Delivery Charges<span><?php echo "Rs. ".$deliverycharges; ?></span></div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <h6>Order Total<span><label><?php echo "Rs. ".$ordertotal; ?></label></span></h6>
                                    </div>
                                </div>
                                <?php
                                    function chk_addr($conn, $user){
                                        $query3 = "SELECT adrs FROM users WHERE usr_id={$user}";
                                        $result3 = mysqli_fetch_array(mysqli_query($conn, $query3))[0];
                                        mysqli_close($conn);
                                        
                                        if($result3==NULL){
                                            return "../UserProfile_Page/profile.php?addr=1";
                                        } else{
                                            return "plc_ord.php?val={$user}";
                                        }
                                    }
                                ?>
                                <a href="<?php echo chk_addr($connection, $id); ?>" class="btn btn-primary mt-3 py-2 mb-4" style="width: 100%;"><strong>PLACE ORDER</strong></a>
                            </div>
                        </div>
            <?php
                    }
                    // closing database connection
                    mysqli_close($connection);
                } else{
                    echo "<h2 class='text-center' style='color: red;'>Unable to connect!</h2>";
                    echo "<h2 class='text-center' style='color: red; margin-bottom: 51px;'>Please check your internet connection!</h2>";
                }
            ?>
        </div>
        
        <!-- including footer -->
        <?php include('../All_Includes/footer.php'); ?>

        <!-- including js cdns -->
        <?php include('../All_Includes/btstrpjs.php'); ?>
    </body>
</html>