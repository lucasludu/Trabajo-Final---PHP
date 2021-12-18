<?php
//$to = 'pabloemanuelmorales@gmail.com';
//$subject = 'Hello from XAMPP!';
//$message = 'This is a test';
//$headers = "From: pabloemanuelmorales@gmail.com\r\n";
//if (mail($to, $subject, $message, $headers)) {
//    echo "SUCCESS";
//} else {
//    echo "ERROR";
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

$mail = new PHPMailer;

//    $fname = $_POST['fname'];
//    $toemail = $_POST['toemail'];
//    $subject = $_POST['subject'];
//    $message = $_POST['message'];
    $mail->isSMTP();
    $mail->Host = 'smtp.office365.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'vivalalibertad2@hotmail.com';
    $mail->Password = 'milei2023';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->setFrom('vivalalibertad2@hotmail.com', 'RRHH');
    $mail->addReplyTo('segrocar@gmail.com', 'RRHH');
    $mail->addAddress('segrocar@gmail.com');

    $mail->isHTML(true);

    $bodyContent = "hey";

    $mail->Subject = "RRHH";
    $bodyContent = 'Estimado:';
    $bodyContent .='<p>'."Usted quedo seleccionado para el puesto laboral solictado. En breve se va a contactar el personal de  RRHH. Saludos cordiales ".'</p>';
    $mail->Body = $bodyContent;

    if(!$mail->send())
        echo 'Error: '.$mail->ErrorInfo;
    else
        echo 'Enviado!';

?>