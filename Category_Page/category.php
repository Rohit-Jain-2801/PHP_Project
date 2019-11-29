<!-- including database connectivity -->
<?php include('../All_Includes/db.php'); ?>

<!DOCTYPE html>
<html>
    <head>
        <title>Categories Page</title>
        <!-- including standard requirements -->
        <?php include("../All_Includes/header.php"); ?>

        <!-- linking css file -->
        <link rel="stylesheet" type="text/css" href="category.css">
    </head>

    <body>
        <!-- including navbar -->
        <?php include('../All_Includes/nvbr.php'); ?>

        <!-- sidebar section -->
        <div id="sidebar" style="margin-top: 100px">
            <ul>
                <h2 class="align-middle text-center my-3" style="color: #ffffff;">Categories</h2>
                <?php 
                    if($connection){
                        $query = "SELECT cid, cname FROM categories";
                        $execute = mysqli_query($connection, $query);

                        while($row = mysqli_fetch_array($execute)){
                            $var = $_SERVER["PHP_SELF"].'?val='.$row['cid'];
                ?>
                            <li>
                                <a id="<?php echo $row['cid']; ?>" href="<?php echo $var; ?>"><?php echo $row['cname']; ?></a>
                            </li>
                <?php
                        }
                    }
                ?>
            </ul>

            <div id="sidebar-btn">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>

        <!-- FOR LOADING ITEMS LAYOUT -->
        <?php
            $qry = "SELECT pid, pname, price, img0 FROM product WHERE ";
            if(isset($_GET['search'])){
                $search = "%".$_GET['search']."%";
                $query = $qry."tags LIKE '{$search}' OR pname LIKE '{$search}'";
            } else{
                $query = $qry."cid=".$_GET['val'];
            }
            $result = mysqli_query($connection, $query);
        ?>
        <!-- number of match section -->
        <h3 class="text-center ml-4 pt-3" style="margin-top: 100px"><?php echo mysqli_num_rows($result); ?> match found!</h3>

        <!-- product cards -->
        <div class="row text-center mx-0 px-0" style="min-height: 39vh;">
            <?php
                while($column = mysqli_fetch_array($result)){
                    $var = "../Product_Page/gen_product.php".'?val='.$column['pid'];
            ?>
                    <div class="col-lg-4 col-sm-6 mx-4 px-4 px-sm-0 mx-sm-0 px-md-4 my-4">
                        <div class="card mx-4 mx-sm-3 mx-md-4 mx-lg-0 mx-xl-3" style="border: 1px; box-shadow: 5px 10px 18px #888888;">
                            <div class="inner" style="overflow: hidden; background-color: rgba(0,0,0, 0.1);">
                                <img style="height: 250px;" src="<?php echo 'data:image/jpeg;base64,'.base64_encode($column['img0']); ?>" />
                            </div>
                            <div class="card-body text-center">
                                <h3 class="card-title my-0" ><strong><?php echo $column['pname']; ?></strong></h3>
                                <div><strong> Price: <?php echo $column['price']; ?>/day</strong></div>
                                <a href="<?php echo $var; ?>" class="btn btn-primary mt-3 mx-0">View Details</a>
                            </div>
                        </div>
                    </div>
            <?php 
                }
                // closing database connection
                mysqli_close($connection);
            ?>
        </div>
        
        <!-- including footer -->
        <?php include('../All_Includes/footer.php'); ?>
        
        <!-- including js cdns -->
        <?php include("../All_Includes/btstrpjs.php"); ?>

        <!-- linking javasript file -->
        <script type="text/javascript" src="category.js"></script>
    </body>
</html>