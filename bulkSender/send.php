<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

if (isset($_POST["send"])){
    
    $sender_name = $_POST["sender_name"];
    $sender = $_POST["sender"];
    $subject = $_POST["subject"];
    $recipients = explode(',', $_POST["recipient"]);
    $body = "WHAT_YOU_WANT_TO_SEND";



    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                     
        $mail->isSMTP();                                            
        $mail->Host       = 'YOUR_SMTP_HOST';//FOR EXAMPLEM'smtp.gmail.com';
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'YOUR_EMAIL';                    
        $mail->Password   = '_YOUR_PASSWORD';
        $mail->SMTPSecure = "tls";            
        $mail->Port       = 465;                                    

        $mail->setFrom($sender, $sender_name);
        foreach($recipients as $recipient){
            $mail->addAddress($recipient); 
        }
      

        
        $mail->isHTML(true);                               
        $mail->Subject = $subject;
        $mail->Body    = $body;
        

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

}