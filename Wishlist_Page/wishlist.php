<!-- including database connectivity -->
<?php include('../All_Includes/db.php'); ?>

<!DOCTYPE html>
<html>
    <head>
        <title>Wishlist Page</title>
        <!-- including standard requirements -->
        <?php include("../All_Includes/header.php"); ?>

        <!-- custom css -->
        <link rel="stylesheet" type="text/css" href="wishlist.css">
    </head>

    <body>
        <!-- including navbar -->
        <?php include('../All_Includes/nvbr.php'); ?>

        <!-- wishlist main starts here -->
        <div class="container-fluid py-5">
            <h2 class="text-center py-4 mb-4" style="margin-top: 90px;">My Wishlist</h2>

            <?php
                // retrieving wishlist contents
                if($connection){
                    if($id){
                        $query = "SELECT pid FROM wishlist WHERE usr_id={$id}";
                        $result = mysqli_query($connection, $query);

            ?>
                        <table class="shadow table table-hover table-responsive-md item_length text-center align-middle">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Item</th>
                                    <th>Price (per day)</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <?php
                                // checking if contents are present
                                if (!$result ||  mysqli_num_rows($result) == 0 ) {
                                    echo "</table>";
                                    echo "<h1 class='text-center mt-4' style='margin-bottom: 159px; color: red;'>Sorry! Your wishlist is empty!</h1>";
                                } else {
                                    while ($row = mysqli_fetch_array($result)) {
                                        $query2 = "SELECT pname, price, img0 FROM product WHERE pid={$row['pid']}";
                                        $row2 = mysqli_fetch_array(mysqli_query($connection, $query2));

                                        $price = $row2['price'];
                            ?>
                                        <tbody>
                                            <tr>
                                                <td><img src="<?php echo 'data:image/jpeg;base64,'.base64_encode($row2['img0']); ?>" style="max-height: 100px;"/></td>
                                                <td style="font-size: 20px;"><strong><?php echo $row2['pname']; ?></strong></td>
                                                <td><?php echo "Rs. ".$price; ?></td>
                                                <td>
                                                    <a class="btn btn-danger" style="width: 145px;" href='<?php echo "../All_Includes/delete.php?tab=wishlist&u_id={$id}&p_id={$row['pid']}&url=".htmlspecialchars($_SERVER["PHP_SELF"]); ?>'>Delete</a>
                                                    <br>
                                                    <a class="btn btn-primary mt-3" style="width: 145px;" href="../Product_Page/gen_product.php?val=<?php echo $row['pid']; ?>">View Details</a>
                                                </td>
                                            </tr>
                            <?php 
                                    }
                                        echo "</tbody>";
                                }
                        echo "</table>";
                    } else{
                            echo "<h2 class='text-center' style='color: red; margin-bottom: 88px;'>You have to login first!</h2>";
                    }
                    // closing database connection
                    mysqli_close($connection);
                } else{
                    echo "<h2 class='text-center' style='color: red;'>Unable to connect!</h2>";
                    echo "<h2 class='text-center' style='color: red; margin-bottom: 50px;'>Please check your internet connection!</h2>";
                }
            ?>
        </div>
        
        <!-- including footer -->
        <?php include('../All_Includes/footer.php'); ?>

        <!-- including js cdns -->
        <?php include('../All_Includes/btstrpjs.php'); ?>
    </body>
</html>