<?php
  // including database connectivity
  include('../All_Includes/db.php');

  if(!isset($_SESSION)){
    session_start();
  }
  if(isset($_SESSION['pg'])){
    unset($_SESSION['pg']);
  }
?>
<!DOCTYPE HTML>
<html style="scroll-behavior: smooth;">
  <head>
    <title>Entity Rent</title>
    <!-- including standard requirements -->
    <?php include("../All_Includes/header.php"); ?>

    <!-- linking custom css file -->
    <link rel="stylesheet" type="text/css" href="home.css" media="screen">
  </head>

  <body id="page-top">
    <!-- Navbar Code -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top py-3" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">Entity Rent</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">MENU<i class="ml-2 fas fa-bars"></i></button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav text-uppercase ml-auto">
            <li class="nav-item">
              <a class="nav-link" id="nav-services" href="#services">Services</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="nav-category" href="#category">Categories</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="nav-team" href="#team">Team</a>
            </li>
            
            <!-- including search section -->
            <?php include('../All_Includes/srch.php'); ?>
          </ul>
        </div>
      </div>
    </nav>

    <!-- HEADER -->
    <div class="container-fluid hdr">
      <h1 class="text-center" style="padding-top: 250px;">Welcome Here!</h1>
      <?php
        // including session section
        include('../All_Includes/session.php'); 
        $id = ext_sess();

        if(!$id){
      ?>
        <button type="button" onClick="location.href='../Registration_Page/login.php'" class="btn btn-warning lsr">LOGIN | SIGNUP</button>
      <?php
        } else{
      ?>
          <div class="dropdown mr-2" style="display: inline-block;">
            <button class="btn btn-warning dropdown-toggle lsr" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">PROFILE </button>
            <div class="dropdown-menu dropdown-menu-right py-0" style="border-radius: .25rem;" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item py-2" href="../UserProfile_Page/profile.php">Your Profile</a>
              <a class="dropdown-item py-2" href="../All_Includes/logout.php">LogOut</a>
            </div>
          </div>
          <div class="dropdown" style="display: inline-block;">
            <button class="btn btn-warning dropdown-toggle lsr" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">ACTIVITIES </button>
            <div class="dropdown-menu py-0" style="border-radius: .25rem;" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item py-2" href="../Wishlist_Page/wishlist.php">Wishlist</a>
              <a class="dropdown-item py-2" href="../Cart_Page/cart.php">Cart</a>
            </div>
          </div>
      <?php
        }
      ?>
    </div>

    <!-- OUR SERVICES -->
    <div class="container py-4 mb-3" id="services">
      <h1 class="text-center my-4">SERVICES PROVIDED</h1>
      <div class="row">
        <?php
          $sqry = "SELECT s_name, s_dis, s_img FROM services";
          $sres = mysqli_query($connection, $sqry);

          while($attr = mysqli_fetch_array($sres)){
            echo "<div class='col-lg-4'>";
              echo "<img class='circle' src='data:image/jpeg;base64,".base64_encode($attr['s_img'])."' />";
              echo "<h3 class='text-center mt-3'>{$attr['s_name']}</h3>";
              echo "<p class='text-center mb-4'>{$attr['s_dis']}</p>";
            echo "</div>";
          }
        ?>
      </div>
    </div>

    <!--  CATEGORIES AND PRODUCTS -->  
    <div class="jumbotron jumbotron-fluid pt-4" id="category">
      <h1 class="text-center pt-4" >PRODUCT CATEGORIES</h1>
      <div class="container px-sm-0">
        <div  class="row mx-0 px-0">
          <?php
            if($connection){
              $query = "SELECT cid,cname,cdis,cimg FROM categories";
              $execute = mysqli_query($connection, $query);

              while($row = mysqli_fetch_array($execute)){
          ?>
                <div class="col-xl-4 col-sm-6 my-4 px-4 px-sm-1 px-lg-2">
                  <div class="card mx-4 mx-sm-0 mx-md-2 mx-lg-4">
                    <img class="card-img-top" style="height: 200px;" src="<?php echo 'data:image/jpeg;base64,'.base64_encode($row['cimg']); ?>"/>
                    <div class="card-body">
                      <h5 class="card-title text-center"><?php echo $row['cname']; ?></h5>
                      <p class="card-text text-center"><?php echo $row['cdis']; ?></p>
                    </div>
                    <div class="card-footer" style="background-color: lightblue;">
                        <a href="<?php echo '../Category_Page/category.php?val='.$row['cid']; ?>" class="btn btn-dark" style="margin-left: 30%">Know More</a>
                    </div>
                  </div> 
                </div>
          <?php 
              }
            }
          ?>
        </div>
      </div>
    </div>

    <!-- TEAM -->
    <div class="container py-2 mb-3" id="team">
      <h3 class="text-center py-4"><strong>OUR TEAM</strong></h3>

      <div class="row">
        <?php
          $qry = "SELECT d_name, d_img FROM developer";
          $res = mysqli_query($connection, $qry);

          while($tuple = mysqli_fetch_array($res)){
            echo "<div class='col-lg-3 col-6 pb-3'>";
              echo "<img class='circle' src='data:image/jpeg;base64,".base64_encode($tuple['d_img'])."' />";
              echo "<h4 class='text-center my-3'>{$tuple['d_name']}</h4>";
            echo "</div>";
          }
          // closing database connection
          mysqli_close($connection);
        ?>
      </div>
    </div>
    
    <!-- including footer -->
    <?php include("../All_Includes/footer.php"); ?>

    <!-- including js cdns -->
    <?php include("../All_Includes/btstrpjs.php"); ?>

    <!-- linking custom javasript file -->
    <script type="text/javascript" src="home.js"></script>
  </body>
</html>