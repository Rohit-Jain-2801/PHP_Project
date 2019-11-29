<?php
    // including database connectivity
    include('../All_Includes/db.php');

    // including universal delete file
    include('../All_Includes/delete.php');

    function chk($var){
        // redirect to cart page
        if(isset($_GET['val'])){
            return "val={$_GET['val']}&var={$var}";
        } else{
            return "var={$var}";
        }
    }

    if($connection){
        // checking if product is already there in wishlist
        $query1 = "SELECT * FROM wishlist WHERE usr_id={$_GET['u_id']} AND pid={$_GET['crt_prd']}";
        $result1 = mysqli_fetch_array(mysqli_query($connection, $query1));
        
        if(!$result1){
            $wishlist_qry = "INSERT INTO wishlist (usr_id, pid) VALUES({$_GET['u_id']}, {$_GET['crt_prd']})";
            $wishlist_res = mysqli_query($connection, $wishlist_qry);

            if($wishlist_res){
                delete('cart', $_GET['u_id'], $_GET['crt_prd'], "../Cart_Page/cart.php?".chk(1));
            } else{
                header("Location: cart.php?".chk(0));
            }
        } else{
            delete('cart', $_GET['u_id'], $_GET['crt_prd'], "../Cart_Page/cart.php?".chk(2));
        }

        // closing database connection
        mysqli_close($connection);
    } else{
        echo "<h1 class='text-center align-middle'>Error 500!</h1>";
    }
?>