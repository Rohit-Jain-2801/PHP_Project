<?php 
    include('../All_Includes/session.php');
    $flag = des_sess();
    if($flag){
        $previous = '<script>history.go(-1)</script>';
		echo $previous;
    }
?>