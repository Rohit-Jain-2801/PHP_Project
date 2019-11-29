<!-- linking db file -->
<?php include('../All_Includes/db.php'); ?>

<!DOCTYPE HTML>
<html>
    <head>
        <title>Feedback</title>
        <!-- including standard requirements -->
        <?php include('../All_Includes/header.php'); ?>

        <!-- linking custom css file -->
        <link rel="stylesheet" type="text/css" href="feedback.css" media="screen">
    </head>

    <body style="background-color: #e6e6e6;">
        <?php 
            if($connection) {          
               if(isset($_POST['submit'])){
                    $name = $_POST['name'];
                    $email = $_POST['email'];
                    $refer = $_POST['radiobuttons'];
                    $comment = $_POST['para'];
                    $rating = $_POST['radiobutton'];

                    $query = "INSERT INTO feedback(name, emailid, recommend, comments, ratings) VALUES('{$name}', '{$email}', '{$refer}', '{$comment}', '{$rating}')";
                    $create_user_query = mysqli_query($connection, $query);
                }
                // closing database connection
                mysqli_close($connection);
            }
        ?>
        
        <header>
            <h1>Feedback Form</h1>
            <p>
                <b style="color: white;">We appreciate your Feedback..!</b>
            </p>
        </header>

        <form method="post" onsubmit="alert('Feedback has been Submitted..!')">
            <div class="divider1" name="Name">
                <div class="leftside" id="toptext">
                    <label><strong>Name:</strong></label>
                </div>
                <div class="rightside">
                    <input autofocus type="text" class="input-field" placeholder="Name" name="name" required>
                </div>
            </div>
            <div class="divider2" name="email">
                <div class="leftside" id="toptext">
                    <label><strong>Email:</strong></label>
                </div>
                <div class="rightside">
                    <input type="email" class="input-field" placeholder="Email" name="email" required>
                </div>
            </div>
            <div class="divider3" name="recommend">
                <div class="leftside">
                    <label>How likely is that you would recommend <b>EntityRent</b> to a friend?</label>
                </div>
                <div class="rightside">
                    <ul class="question">
                        <label for="definitely"><input id="definitely" name="radiobuttons" value="definitely" type="radio">Definitely</label>
                        <br>
                        <label for="maybe"><input id="maybe" name="radiobuttons" value="maybe" type="radio">Maybe</li></label>
                        <br>
                        <label for="notsure"><input id="notsure" name="radiobuttons" value="not_sure" type="radio">Not sure</li></label>
                    </ul>
                </div>
            </div>
            <div class="divider8" name="comments">
                <div class="leftside">
                    <label><strong>Any Comments or Suggestions?</strong></label>
                </div>
                <div class="rightside">
                    <textarea class="input-field" style="height:50px;resize:vertical;" name="para" placeholder="Enter your comment here..."></textarea>
                </div>
            </div>
            <div class="divider" name="rate">
                <div class="leftside">
                    <label><strong>Rate Our Services</strong></label>
                </div>
                <div class="rightside">
                    <ul class="question2">
                        <label for="poor"><input id="poor" name="radiobutton" value="Poor" type="radio">Poor</label>
                        <br>
                        <label for="good"><input id="good" name="radiobutton" value="Good" type="radio">Good</li></label>
                        <br>
                        <label for="excellent"><input id="excellent" name="radiobutton" value="Excellent" type="radio">Excellent</li></label>
                    </ul>
                </div>
            </div>
             <button class="submitbutton btn btn-primary" id="submit" type="submit" name="submit">Submit</button> 
        </form>

        <!-- linking js files -->
        <?php include('../All_Includes/btstrpjs.php'); ?>
    </body>
</html> 