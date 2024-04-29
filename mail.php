<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);
$mail->CharSet = 'utf-8';

$fullname = $_POST['fullname'];
$phone = $_POST['phone'];
$email = $_POST['email'];

$from = file_get_contents("senderEmail.txt");
$smtpPassword = file_get_contents('smtp_password.txt');
$to = file_get_contents('myEmail.txt');
try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.mail.ru';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = $from;                     //SMTP username
    $mail->Password   = $smtpPassword;                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
    $mail->Port       = 465;                               

    //Recipients
    $mail->setFrom('sereshka1408@mail.ru', $fullname);
    $mail->addAddress($to, 'Admin');
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Заявка на получение зачета';
    $mail->Body    = "<h2>Имя: " . $fullname . "</h2>";
    $mail->Body .= "<h2>Телефон: " .$phone . "</h2>";
    $mail->Body .= "<h2>Email: " .$email . "</h2>";
    $mail->AltBody = 'Что-то пошло не так';

    $mail->send();
    echo "Спасибо! Мы обязательно свяжемся с вами!";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>