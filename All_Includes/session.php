<?php
    function des_sess(){
        // Start the session
        if(!isset($_SESSION)){
            session_start();
        }

        // remove all session variables
        // session_unset();

        $_SESSION['status'] = 0;
        unset($_SESSION['id']);
        unset($_SESSION['email']);

        // destroy the session
        // session_destroy();

        return 1;
    }
    
    function ext_sess(){
        // Start the session
        if(!isset($_SESSION)){
            session_start(); 
        }

        if(isset($_SESSION['status']) && $_SESSION['status']){
            include('../All_Includes/db.php');

            $query = "SELECT email FROM users WHERE usr_id = {$_SESSION['id']}";
            $result = mysqli_fetch_array(mysqli_query($connection, $query));

            if($result){
                if($result['email']==$_SESSION['email']){
                    return $_SESSION['id'];
                } else{
                    des_sess();
                    return 0;
                }
            }
            else{
                des_sess();
                return 0;
            }
        }
    }

    function set_sess($id, $email){
        // Start the session
        if(!isset($_SESSION)){
            session_start();
        }

        $_SESSION['status'] = 1;
        $_SESSION['id'] = $id;
        $_SESSION['email'] = $email;
    }
?>