<?php
    include('../All_Includes/session.php'); 
    $id = ext_sess();
    if(isset($_SESSION['pg'])){
        unset($_SESSION['pg']);
    }
?>

<!-- linking css file -->
<link rel="stylesheet" type="text/css" href="../All_Includes/nvbr.css" media="screen">

<!-- Navbar Code -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top py-3" id="mainNav">
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="../Landing_Page/home.php">Entity Rent</a>
        <button class="navbar-toggler navbar-toggler-right ml-auto mr-2" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">MENU<i class="fas fa-bars ml-2"></i></button>
        
        <?php
            if($id){
        ?>
            <div class="" id="first_dd">
                <div class="dropdown ml-2">
                    <a class="dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-circle fa-lg"></i></a>
                    <div class="dropdown-menu dropdown-menu-right mt-2" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="../UserProfile_Page/profile.php"><i class="fas fa-user-cog mr-2"></i>Your Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="../All_Includes/logout.php"><i class="fas fa-sign-out-alt mr-2"></i>LogOut</a>
                    </div>
                </div>
            </div>
        <?php
            }
        ?>

        <div class="collapse navbar-collapse" id="navbarResponsive">
            <?php
                if($id){
            ?>
                    <ul class="navbar-nav text-uppercase ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="../Wishlist_Page/wishlist.php"><i class="fas fa-heart mr-2"></i>Your WishList</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../Cart_Page/cart.php"><i class="fas fa-shopping-cart mr-2"></i>Your Cart</a>
                        </li>
                    </ul>
            <?php
                }
            ?>

                <!-- linking search section -->
                <?php include('../All_Includes/srch.php'); ?>

            <?php
                if(!$id){
            ?>
                <div>
                    <ul class="navbar-nav text-uppercase ml-auto">
                        <li class="nav-item">
                            <a href="../Registration_Page/login.php" class="nav-link">Login | Signup</a>
                        </li>
                    </ul>
                </div>
            <?php
                }
            ?>
        </div>

        <?php
            if($id){
        ?>
        
            <div class="navbar-nav" id="second_dd" style="display: none;">
                <div class="nav-item dropdown ml-2">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-circle fa-lg"></i> </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="../UserProfile_Page/profile.php"><i class="fas fa-user-cog mr-2"></i>Your Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="../All_Includes/logout.php"><i class="fas fa-sign-out-alt mr-2"></i>LogOut</a>
                    </div>
                </div>
            </div>
        <?php
            }
        ?>
    </div>
</nav>  