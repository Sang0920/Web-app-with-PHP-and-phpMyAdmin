<?php
spl_autoload_register(function ($classname) {
    require_once "./classes/{$classname}.php";
});

require_once './config.php';

$pdo = (new Database($DB_USER, $DB_USER_PWD, $DB_HOST, $DB_NAME))->getConn();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './vendor/PHPMailer/src/Exception.php';
require './vendor/PHPMailer/src/PHPMailer.php';
require './vendor/PHPMailer/src/SMTP.php';

function _sendConfirmationEmail($user, $email_pwd)
{
    $mail = new PHPMailer(true);

    try {
        //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'noreply@aes.edu.sg';                     //SMTP username
        $mail->Password   = $email_pwd;                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('noreply@aes.edu.sg', 'ShoeShop');
        $mail->addAddress($user->email, $user->firstname . $user->lastname);     //Add a recipient
        // $mail->addAddress('ellen@example.com');               //Name is optional
        // $mail->addReplyTo('info@example.com', 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        // //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'ShoeShop Email Confirmation';
        $mail->Body    = 'Your confimation code is ' . $user->confirmationtoken;
        $mail->AltBody = 'Your confimation code is ' . $user->confirmationtoken;
        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}