<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';

#$name = htmlentities($_POST['name']);
#$email = htmlentities($_POST['email']);
#$subject = htmlentities($_POST['subject']);
#$message = htmlentities($_POST['message']);

$name = "Edwar";
$email = "edwar.villamizar@colmayor.edu.co";
$subject= "Recuperacion de Contraseña";
$message= "Recuperacion de Contraseña";

$name = htmlentities($name);
$email = htmlentities($email);
$subject = htmlentities($subject);
$message = htmlentities($message);

$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'soportebancodocente@colmayor.edu.co';
$mail->Password = 'vyvfjnvptlksnycy';
$mail->Port = 465;
$mail->SMTPSecure = 'ssl';
$mail->isHTML(true);
$mail->setFrom($email, $name);
$mail->addAddress('edwar.villamizar@colmayor.edu.co');
$mail->Subject = ("$email ($subject)");
$mail->Body = $message;
$mail->send();

#header("Location: ./response.html");

?>