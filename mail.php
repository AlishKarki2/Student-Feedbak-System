<?php

require 'PHPMailer/PHPMailer/PHPMailer.php';
require 'PHPMailer/PHPMailer/SMTP.php';
require 'PHPMailer/PHPMailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer();

$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'tls';
$mail->Username = 'thisisdemo2023@gmail.com';
$mail->Password = 'orchid@2023';

$mail->setFrom('thisisdemo2023@gmail.com', 'Thisis Demo');
$mail->addAddress('alishkarki14@gmail.com');
$mail->Subject = 'Email Test via PHP using Localhost';
$mail->Body = 'Hi there, this is a test email sent from localhost using SMTP';

if ($mail->send()) {
    echo 'Email sent successfully!';
} else {
    echo 'Error: ' . $mail->ErrorInfo;
}
?>
