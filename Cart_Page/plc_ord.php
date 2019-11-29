<?php
    // including database connectivity
    include('../All_Includes/db.php');

    if($connection){
        $query = "SELECT pid, date1, date2 FROM cart WHERE usr_id={$_GET['val']}";
        $result = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_array($result)) {
            $row['date1'] = $row['date1']>date('Y-m-d')?$row['date1']:date('Y-m-d');

            $query1 = "SELECT date1, date2 FROM product WHERE pid={$row['pid']}";
            $result1 = mysqli_fetch_array(mysqli_query($connection, $query1));

            if($row['date1']>=$result1['date1'] && $row['date2']<=$result1['date2']){
                $q2 = "SELECT date1, date2 FROM orders WHERE pid={$row['pid']}";
                $r2 = mysqli_query($connection, $q2);
                
                $chk = true;
                while($row2 = mysqli_fetch_array($r2)){
                    
                    if($row2['date1']<=$row['date1'] && $row['date1']<=$row2['date2']){
                        $chk = false;
                    } elseif($row2['date1']<=$row['date2'] && $row['date2']<=$row2['date2']){
                        $chk = false;
                    }
                }

                if($chk){
                    $query2 = "SELECT price FROM product WHERE pid={$row['pid']}";
                    $row2 = mysqli_fetch_array(mysqli_query($connection, $query2));

                    $days = strtotime($row['date1']) - strtotime($row['date2']); 
                    $d = abs(round($days / (60*60*24))) + 1;
                    $amt = $d * $row2['price'];

                    $qry = "INSERT INTO orders (usr_id, pid, price, date1, date2) VALUES({$_GET['val']}, {$row['pid']}, {$amt}, '{$row["date1"]}', '{$row["date2"]}')";
                    $res = mysqli_query($connection, $qry);
                    if(!$res){
                        echo "<h1 class='text-center align-middle'>Error 503!</h1>";
                        mysqli_close($connection);
                        break;
                    }

                    $qry = "DELETE FROM cart WHERE pid = {$row['pid']} AND usr_id = {$_GET['val']}";
                    $res = mysqli_query($connection, $qry);
                } else{
                    header("Location: add_to_wish.php?u_id={$_GET['val']}&crt_prd={$_GET['pid']}&val=1");
                }
            } else{
                header("Location: add_to_wish.php?u_id={$_GET['val']}&crt_prd={$_GET['pid']}&val=0");
            }
        }
        // closing database connection
        mysqli_close($connection);

        if($res){
            // redirect to success page
            header('Location: ../Payment_Page/success.php');
        }
    } else{
        echo "<h1 class='text-center align-middle'>Error 500!</h1>";
    }
?>