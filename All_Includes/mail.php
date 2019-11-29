<!-- PHP Mailer -->
<!-- <php
    // Import PHPMailer classes into the global namespace
    // These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    // Load Composer's autoloader
    // require_once("phpmailer\PHPMailerAutoload.php");
    require 'vendor/autoload.php';
    mailer();
    function mailer(){
        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = 4;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->SMTPKeepAlive = true;   
            // $mail->Mailer = “smtp”; // don't change the quotes!
            $mail->Host       = 'ssl://smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = '<EMAIL-ID>';                     // SMTP username
            $mail->Password   = 'PASSWORD';                               // SMTP password
            $mail->SMTPSecure = 'ssl';
            // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port       = 465;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom('help@entityrental.com', 'EntityRental');
            $mail->addAddress('<TO EMAIL>', 'Joe User');     // Add a recipient
            // $mail->addAddress('ellen@example.com');               // Name is optional
            // $mail->addReplyTo('info@example.com', 'Information');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');

            // Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Password Reset!';
            $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
?> -->

<!-- SendGrid -->
<!-- ?php
    require 'vendor/autoload.php';

    $email = new \SendGrid\Mail\Mail(); 
    $email->setFrom("test@example.com", "Example User");
    $email->setSubject("Sending with SendGrid is Fun");
    $email->addTo("", "Example User");
    $email->addContent("text/plain", "and easy to do anywhere, even with PHP");
    $email->addContent(
        "text/html", "<strong>and easy to do anywhere, even with PHP</strong>"
    );

    $sendgrid = new \SendGrid('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');
    try {
        $response = $sendgrid->send($email);
        // $response = $sendgrid->client->mail()->batch()->post($email);
        print $response->statusCode() . "\n";
        print_r($response->headers());
        print $response->body() . "\n";
    } catch (Exception $e) {
        echo 'Caught exception: '. $e->getMessage() ."\n";
    }
?> -->

<?php
    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    $pass = substr(str_shuffle($str_result), 0, 8);
    $mail = 0;

    $em = $_GET['var'];
    if($em!=''){
        // linking databse
        include('db.php');

        if($connection){
            $qry1 = "SELECT cust_name FROM users WHERE email='{$em}'";
            $res1 = mysqli_query($connection, $qry1);

            if($res1){
                $name = mysqli_fetch_array($res1)[0];
                $msg = "Hello {$name},\n\nYour new password is: {$pass}\n\nThank You!";
                $header = "From: Entity Rental <www.entityrental.com>";
                $succ = mail($_GET['var'], 'Password Reset', $msg, $header);

                if($succ){
                    // for encryption
                    include('hash.php');
                    $new_pass = secret($pass);

                    $qry2 = "UPDATE users SET pswrd='{$new_pass}' WHERE email='{$em}'";
                    $res2 = mysqli_query($connection, $qry2);
                    
                    if($res2){
                        $mail = 1;
                    }
                }
            }
            // closing database connection
            mysqli_close($connection);
        }
    }
    echo "<script>location.replace('../Registration_Page/login.php?mail={$mail}')</script>";
?>