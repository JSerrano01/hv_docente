<?php

include('database.php');

session_start();

$state = 0;

#------------------------CONSULTA PARA ENCONTRAR USUARIO QUE INICIA SESION----------------------------------------

if (isset($_POST['numero_documento'])){

    $numero = stripslashes($_REQUEST['numero_documento']);
    $numero = mysqli_real_escape_string($connection,$numero); 
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($connection,$password);    

    $query = "SELECT usuarios.id, usuarios.numero_documento, usuarios.email, maestra_roles.clase FROM `usuarios` JOIN `maestra_roles` ON usuarios.rol_id = maestra_roles.id WHERE `numero_documento`='$numero' and password='".md5($password)."'";

    $result = mysqli_query($connection,$query);
    $rows = mysqli_num_rows($result);

    if($rows == 1){

        $state = 1;
        $rows = mysqli_fetch_assoc($result);

        $_SESSION['id'] = $rows['id'];
        $_SESSION['usuario'] = $rows['numero_documento'];
        $_SESSION['email'] = $rows['email'];
        $_SESSION['role'] = $rows['clase'];
      
        mysqli_free_result($result);
        mysqli_close($connection);
        #-------------ENVIA A LA VISTA DE SU RESPECTIVO ROL--------------------
        if ($_SESSION['role'] == 'docente'){header("Location: profile.php");}
        else{header("Location: call.php");};
    }

    else{$state = 2;}}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include('head.php'); ?>
    

</head>

<body style="background: url(static/img/img1.jpg); background-size: cover;">

<div class="container" style="width: 25rem; position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%); -webkit-transform: translate(-50%, -50%);">

    <?php if(isset($_GET['is_recovery'])){?>

    <div class="alert alert-success" role="alert">
        
        Se ha enviado a su correo una nueva contraseña.

    </div>

    <?php } ?>


    <div class="card">
        <div class="card-header">
            Ingresar
        </div>
        <div class="card-body">
            <!-- ---------------------------------INICIO DE SESION DE USUARIOS YA REGISTRADOS---------------------------------------- -->
            <form class="col-12" action="index.php" method="post">

                <div class="row">
                    <div class="col">
                    <p><input type="text" class="form-control" placeholder="Numero de documento" id="numero_documento" name="numero_documento" pattern="[0-9]+" required></p>
                    </div>
                </div>
           
                <div class="row">
                    <div class="col">
                    <p><input type="password" class="form-control" placeholder="Contraseña" name="password" required></p>
                    </div>
                </div>

                <button type="submit" class="btn btn-success btn-sm"><i class="bi bi-box-arrow-in-right"></i> Ingresar </button>

            </form>
        </div>
    </div>

    <p>

    <div>
        
        <div class="alert alert-dark" role="alert">
            <!-- ---------------------------------REGISTRO DE NUEVO USUARIO---------------------------------------- -->
            <form action="signup.php">
                
                <div class="row">
                    <div class="col">
                    <p><strong><h5>¿Deseas trabajar con nostros?</h5><br>¡Registrate para poder ingresar!</strong> lo puedes hacer dando click en le siguiente boton.</p>
                    </div>
                </div>

                <button type="submit" class="btn btn-success btn-sm">Registrarse</button>

                <div class="row">
                    <div class="col">
                    <p class="text-center"><strong><h5>¿Tienes Problemas Tecnicos?</h5><br>¡Escribenos al siguiente correo!</strong> soportebancodocente@colmayor.edu.co</p>
                    </div>
                </div>

            </form>
            <!-- ---------------------------------RECUPERACION DE CONTRASEÑA---------------------------------------- -->
            <form action="passwordReset.php">
                
                <div class="row">
                    <div class="col">
                    <p><strong><h5>¿Olvidaste tu contraseña?</h5><br>¡Dale click en el siguiente boton!</strong></p>
                    </div>
                </div>

                <button type="submit" class="btn btn-success btn-sm">Obtener nueva contraseña</button>

            </form>
            
        </div>
        
    </div>

    

    

</div>

</body>
</html>
