<?php
    function delete($w, $x, $y, $z){
        // including database connectivity
        include('../All_Includes/db.php');

        // including standard requirements
        include("../All_Includes/header.php");

        if($connection){
            $qry = "DELETE FROM {$w} WHERE usr_id = {$x} AND pid = {$y}";
            $res = mysqli_query($connection, $qry);
            
            // closing database connection
            mysqli_close($connection);

            if(!$res){
                echo "<h1 class='text-center' style='margin-top: 45vh;'>Error 503!</h1>";
            } else{
                // redirect to cart page
                // header_remove();
                // header("Location: ..{$z}");
                echo "<script type='text/javascript'> location.href='..{$z}' </script>";
            }
        } else{
            echo "<h1 class='text-center' style='margin-top: 45vh;'>Error 500!</h1>";
        }
    }

    if(isset($_GET['u_id'])){
        delete($_GET['tab'], $_GET['u_id'], $_GET['p_id'], $_GET['url']);
    }
?>