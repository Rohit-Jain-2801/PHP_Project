<!-- including database connectivity -->
<?php include('../All_Includes/db.php'); ?>

<!DOCTYPE HTML>
<html>
    <head>
        <title>Renting Page</title>
        <!-- including standard requirements -->
        <?php include('../All_Includes/header.php'); ?>

        <!-- linking custom css file -->
        <link rel="stylesheet" type="text/css" href="selling.css" media="screen">
    </head>
    
    <body>
        <?php
            // including navbar
            include('../All_Includes/nvbr.php');

            if($connection){
                if($id){
                    // for updating previous post by user
                    $frwd_res = null;
                    if(isset($_GET['val'])){
                        $frwd_qry = "SELECT * FROM product WHERE pid={$_GET['val']}";
                        $frwd_res = mysqli_fetch_array(mysqli_query($connection, $frwd_qry));

                        $dfq = "SELECT cname FROM categories WHERE cid={$frwd_res['cid']}";
                        $frwd_res['cname'] = mysqli_fetch_array(mysqli_query($connection, $dfq))[0];
                    }

                    // Checking if 'submit' button is clicked for updating database
                    if(isset($_POST["submit"])){
                        // Storing all the data from form
                        $pname = $_POST['pname'];
                        $description = $_POST['description'];
                        $tags = $_POST['tags'];
                        $price = $_POST['price'];
                        $date1 = $_POST['date1'];
                        $date2 = $_POST['date2'];
                        $category = $_POST['category'];
                        $img0 = NULL;
                        $img1 = NULL;
                        $img2 = NULL;
                        $count = $_POST['count_img'];
                        $count = $count>0?$count-1:$count;

                        // Checking for 'from' date
                        // $date_selected = date_parse(date_create($date1)->format('Y/m/d'));
                        // $date_today = date_parse(date_create(date("Y/m/d"))->format('Y/m/d'));
                        // if($date_selected['month'] == $date_today['month'] && $date_selected['year'] == $date_today['year']){
                        //     $day_selected = $date_selected['day'];
                        //     $day_today = $date_today['day'];
                        //     if($day_selected < $day_today){
                        //         // If date selected is prior to today's date then date selected will be replaced by today's date
                        //         $date1 = date_create(date("Y/m/d"))->format('Y/m/d');
                        //     }
                        // }

                        // for acessing files(images in our case)
                        // echo var_dump($_FILES['mimg']);
                        $var = $_FILES['mimg']['tmp_name'];

                        if($var[0]){
                            $name = 'img'.$count;
                            $$name = addslashes(file_get_contents($var[0]));
                            $count+=1;

                            if(count($var)!=1){
                                $name = 'img'.$count;
                                $count+=1;
                                $$name = addslashes(file_get_contents($var[1]));

                                if(count($var)>2){
                                    $name = 'img'.$count;
                                    $$name = addslashes(file_get_contents($var[2]));
                                }
                            }
                        }

                        // fetching category id from database
                        $query0 = "SELECT cid FROM categories WHERE cname = '{$category}'";
                        $execute0 = mysqli_fetch_array(mysqli_query($connection, $query0))[0];

                        if(!$_POST['gpid']){
                            // inserting form data into the database
                            $query1 = "INSERT INTO product (usr_id, cid, tags, pname, descript, price, date1, date2, img0, img1, img2) VALUES($id, $execute0, '$tags', '$pname', '$description', $price, '$date1', '$date2', '$img0', '$img1', '$img2')";
                        } else{
                            $app_str = "";
                            if($img0){ $app_str=$app_str.", img0='{$img0}'"; }
                            if($img1){ $app_str=$app_str.", img1='{$img1}'"; }
                            if($img2){ $app_str=$app_str.", img2='{$img2}'"; }
                            if(!$img1 && !$img2){ $app_str=$app_str.", img1='', img2=''"; }
                            $query1 = "UPDATE product SET cid={$execute0}, tags='{$tags}', pname='{$pname}', descript='{$description}', price={$price}, date1='{$date1}', date2='{$date2}'".$app_str." WHERE pid={$_POST['gpid']}"; 
                        }
                        $execute1 = mysqli_query($connection, $query1);
                        if($execute1){
                            echo "<script type='text/javascript'> alert('Product Successfully Submitted! You will be redirected to your profile.'); </script>";
                            // header("Location: ../UserProfile_Page/profile.php");
                            echo "<script type='text/javascript'> location.href='../UserProfile_Page/profile.php'; </script>";
                        }else{
                            echo "<script type='text/javascript'> alert('Error occurred while uploading on server!'); </script>";
                        }
                    }
        ?>

                    <div class="container" style="margin-top: 115px;">
                        <div class="jumbotron px-5 mt-3">
                            <h1 style="text-align: center;">Rent your Product!</h1>
                
                            <!-- The $_SERVER["PHP_SELF"] is a super global variable that returns the filename of the currently executing script. -->
                            <!-- The htmlspecialchars() function converts special characters to HTML entities.
                            This means that it will replace HTML characters like < and > with &lt; and &gt;.
                            This prevents attackers from exploiting the code by injecting HTML or Javascript code (Cross-site Scripting attacks) in forms. -->
                            <form  onsubmit="return img_val();" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" method="POST">
                                <div class="form-group">
                                    <label for="ProdName"><b>Product Name</b></label>
                                    <input type="text" class="form-control" id="ProdName" placeholder="Your Product Name" name="pname" value="<?php echo $frwd_res['pname']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="Descript"><b>Description</b></label>
                                    <textarea type="text" class="form-control" id="Descript" placeholder="About your product" name="description" style="height:100px;" required><?php echo $frwd_res['descript']; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="tags"><b>Tags</b></label>
                                    <textarea type="text" class="form-control" id="tags" placeholder="For Search engine" name="tags" style="height:50px;" required><?php echo $frwd_res['tags']; ?></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-6 form-group">
                                        <label for="category" class="mr-2"><b>Category</b></label>
                                        <select class="dt form-control" id="category" name="category" required>
                                            <!-- retrieving category names from database -->
                                            <?php
                                                $query2 = "SELECT cname FROM categories";
                                                $execute2 = mysqli_query($connection, $query2);
                                                
                                                while($exe = mysqli_fetch_array($execute2)){
                                                    echo "<option";
                                                    if($exe['cname']==$frwd_res['cname']){
                                                        echo " selected";
                                                    }
                                                    echo ">".$exe['cname']."</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-6 form-group">
                                        <label for="amount"><b>Price (Rs.)</b></label>
                                        <input type="number" class="form-control" id="amount" placeholder="Per day charge" name="price" value="<?php echo $frwd_res['price']; ?>" required>  
                                    </div>
                                    <div class="col-6 form-group">
                                        <label for="start" class="mr-2"><b>From</b></label>
                                        <input type="date" class="dt form-control" id="start" name="date1" value="<?php echo $frwd_res['date1']; ?>" required>
                                    </div>
                                    <div class="col-6 form-group">
                                        <label for="till" class="mr-2"><b>Till</b></label>
                                        <input type="date" class="dt form-control" id="till" name="date2" value="<?php echo $frwd_res['date2']; ?>" required>
                                    </div>
                                </div>
                                <div class="mb-3" id="imgs">
                                    <?php
                                        if($frwd_res){
                                            echo '<img src = "data:image/jpeg;base64,'.base64_encode($frwd_res['img0']).'" name="img0"/>';
                                            if($frwd_res['img1']){
                                                echo '<img src = "data:image/jpeg;base64,'.base64_encode($frwd_res['img1']).'" name="img1"/>';
                                            }
                                            if($frwd_res['img2']){
                                                echo '<img src = "data:image/jpeg;base64,'.base64_encode($frwd_res['img2']).'" name="img2"/>';
                                            }
                                        }
                                    ?>
                                </div>
                                <input type="text" id="count_img" name="count_img" style="display: none;" value="0">
                                <input type="text" name="gpid" style="display: none;" value="<?php echo $frwd_res['pid']; ?>">
                                <div class="row">
                                    <div class="col-7 col-md-8 col-lg-9 col-xl-10 pr-0">
                                        <label for="customFile" id="txt" class="lbl p-2">Upload Images!</label>
                                        <!-- mimg[] is important or otherwise php will consider only one file -->
                                        <input type="file" accept="image/*" id="customFile" name="mimg[]" style="display: none;" multiple>
                                    </div>
                                    <div class="col-5 col-md-4 col-lg-3 col-xl-2">
                                        <input type="button" value="Choose Images" onclick="document.getElementById('customFile').click();" class="mb-2 dt btn btn-warning" style="width: 100%;"/>
                                        <input type="button" value="Clear" onclick="clrd()" class="dt btn btn-danger" style="width: 100%;"/>
                                    </div>
                                </div>
                                <!-- type should be equal to submit to do action specified in form tag above -->
                                <button class="btn btn-success mt-4" type="submit" name="submit">Submit</button>
                                <button class="btn btn-primary mt-4 ml-2" name="back" onclick="history.go(-1)">Back</button>
                            </form>
                        </div>
                    </div>
        <?php
                } else{
                    echo "<h2 class='text-center' style='color: red; margin-top: 214px; margin-bottom: 170px;'>You have to login first!</h2>";
                }
                // closing database connection
                mysqli_close($connection);
            } else{
                echo "<h2 class='text-center' style='color: red; margin-top: 210px;'>Unable to connect!</h2>";
                echo "<h2 class='text-center' style='color: red; margin-bottom: 129px;'>Please check your internet connection!</h2>";
            }
        ?>
        
        <!-- including footer -->
        <?php include('../All_Includes/footer.php'); ?>

        <!-- including js cdns -->
        <?php include('../All_Includes/btstrpjs.php'); ?>

        <!-- linking custom javasript file -->
        <script type="text/javascript" src="selling.js"></script>
    </body>
</html>