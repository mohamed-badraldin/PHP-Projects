<?php
    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    //Load Composer's autoloader
    require 'vendor/autoload.php';

    function sendMail ($name, $code, $email){
         // send code via mail
                //Instantiation and passing `true` enables exceptions
                $mail = new PHPMailer(true);

                try {
                    //Server settings
                    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                         //Enable verbose debug output
                    $mail->isSMTP();                                              //Send using SMTP
                    $mail->Host       = 'smtp.gmail.com';                        //Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                    $mail->Username   = 'ntiecommece@gmail.com';               //SMTP username
                    $mail->Password   = 'NTI@123456';                         //SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                    $mail->Port       = 465;                                //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

                    //Recipients
                    $mail->setFrom('ntiecommece@gmail.com', 'Ecommerce');
                    $mail->addAddress($email);                     //Name is optional

                    //Content
                    $mail->isHTML(true);                                    //Set email format to HTML
                    $mail->Subject = 'Verification Code';
                    $mail->Body    = '  <p> Dear ' . $name . ',</p>
                                        <p> Your Verification Code :<b>' . $code . '</b></p>
                                        <p><b>Thank You</b></p>';

                    $mail->send();
                    header('Location:check-code.php?email='.$email);
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
    }
?>