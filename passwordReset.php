<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';

include('database.php');

$code = 0;

if (isset($_POST['email'])){

    $numero = stripslashes($_REQUEST['numero_documento']);
    $email = $_POST['email'];
    $query = "UPDATE `usuarios` SET `email`= '$email' WHERE numero_documento='$numero'";
    $result = mysqli_query($connection,$query);

}

if (isset($_POST['numero_documento'])){

    $numero = stripslashes($_REQUEST['numero_documento']);
    $numero = mysqli_real_escape_string($connection,$numero); 

    $newPassword = mt_rand(100000,999999);

    $password = md5($newPassword);
    $query = "UPDATE `usuarios` SET `password`= '$password' WHERE numero_documento='$numero'";
    $result = mysqli_query($connection,$query);

    $query = "SELECT * from `usuarios` where `numero_documento` like '%$numero%' limit 1";
    $result = mysqli_query($connection,$query);
    $succes = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);

    if($succes && !empty($row['email'])){

    $name = "Banco Docente";
    $email = "edwar.villamizar@colmayor.edu.co";
    $subject= "Recuperacion de Contraseña";
    $message= "Su nueva contraseña es: ".$newPassword;

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
    $mail->addAddress($row['email']);
    $mail->Subject = ("Recuperacion de Acceso");
    $mail->Body = $message;
    $mail->send();

    mysqli_free_result($result);
    mysqli_close($connection);

    $code = 1;
    header("Location: index.php?is_recovery=1");}

    else{$code = 2; $numeroDocumento = $_POST['numero_documento'];}}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script type='text/javascript'>

        document.addEventListener("contextmenu", function(event){
            event.preventDefault();
        }, false);

        document.addEventListener("copy", function(event){
            // Change the copied text if you want
            event.clipboardData.setData("text/plain", "No se permite copiar en esta página web");
            // Prevent the default copy action
            event.preventDefault();
        }, false);

    </script>

    <?php include('head.php'); ?>

</head>

<body style="background: url(static/img/img1.jpg); background-size: cover;">

<?php if ($code == 0){?>

<div class="container" style="width: 25rem; position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%); -webkit-transform: translate(-50%, -50%);">
    <div class="card">
        <div class="card-header">
            Reiniciar Contraseña
        </div>
        <div class="card-body">

            <form class="col-12" action="passwordReset.php" method="post">

                <div class="row">
                    <div class="col">
                    <p><input type="text" class="form-control" placeholder="Numero de documento" id="numero_documento" name="numero_documento" pattern="[0-9]+" required></p>
                    </div>
                </div>
           
                <button type="submit" class="btn btn-success btn-sm"><i class="bi bi-box-arrow-counterclockwise"></i> Enviar</button>

            </form>
        </div>
    </div>
</div>

<?php } ?>

<?php if ($code == 2){?>

<div class="container" style="width: 25rem; position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%); -webkit-transform: translate(-50%, -50%);">
    <div class="card">
        <div class="card-header">
            Reiniciar Contraseña
        </div>
        <div class="card-body">

            <form class="col-12" action="passwordReset.php" method="post"  onsubmit="return verification()">

                <input type="hidden" id="numero_documento" name="numero_documento" value="<?php echo($numeroDocumento);?>">

                <div class="row">
                    <div class="col">
                    <p>Esta cuenta no tiene correo asociado, ingrese un correo.</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                    <p><input type="email" class="form-control" placeholder="Email" id="email" name="email" autocomplete="off" required></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                    <p><input type="email" class="form-control" placeholder="Ingrese de nuevo su email" id="verificacion_email" name="verificacion_email" autocomplete="off" required></p>
                    </div>
                </div>

                <button type="submit" class="btn btn-success btn-sm"><i class="bi bi-box-arrow-counterclockwise"></i> Enviar</button>

            </form>
        </div>
    </div>
</div>

<?php } ?>

<script>

function verification() {

    if($('#email').val()===$('#verificacion_email').val()){return true;}

    else{alert("los email son diferentes.");return false;}}

</script>
