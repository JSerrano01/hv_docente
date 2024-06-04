<?php

include('database.php');

$state = 0;

if (!empty($_POST['numero_documento']) && !empty($_POST['password']) && !empty($_POST['email'])){
    
    $numero =$_POST['numero_documento'];
    $email =$_POST['email'];
    $password = md5($_POST['password']);
    
    $query = "SELECT * from `usuarios` where `numero_documento` like '%$numero%'";
 
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($result);

    if (!isset($row['numero_documento'])){

        $query= "INSERT INTO `usuarios` (`numero_documento`,`password`,`email`) VALUES ('$numero','$password','$email')";
        $result = mysqli_query($connection, $query);
        #mysqli_free_result($result);
        mysqli_close($connection);

    if($result){$state = 1;}

    else {$state = 2;}}

    else {$state = 3;}

}

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">-->

    <?php include('head.php'); ?>

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

</head>

<body style="background: url(static/img/img1.jpg); background-size: cover;">

<!--<div class="container" style="width: 20rem; position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%); -webkit-transform: translate(-50%, -50%);">-->

<?php if($state==1) {?>
    
    <p>
    <div class="container p-2">
        <div>
            <form action="index.php">

                <div class="alert alert-success" role="alert">
                    
                    <div class="row">
                        <div class="col">
                        <p><strong>!Registro Exitoso!, </strong>Puedes regresar dando click en le siguiente boton.</p>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-danger btn-sm">Regresar</button>

                </div>
            </form>
        </div>
    </div>

    <?php } ?>

    <?php if($state==2 || $state==3) {?>
    
    <p>

    <div class="container p-2">
        <div>
            <form action="index.php">
                <div class="alert alert-danger" role="alert">
                    
                    <div class="row">
                        <div class="col">
                        <p><strong>!Registro Fallido!, </strong>El usuario ya existe.</p>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-danger btn-sm">Regresar</button>
                </div>
            </form>
        </div>

    </div>

    <?php } ?>

<div class="container p-2">
        
    <div class="card">
        <div class="card-body">
            <form class="col-12" action="signup.php" method="post" onsubmit="return verification()">

                <h4>Registro</h4><br>

                <div class="row">
                    <div class="col">
                    <p><input type="text" class="form-control" placeholder="Numero de documento" id="numero_documento" name="numero_documento" pattern="[0-9]+" autocomplete="off" required></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                    <p><input type="text" class="form-control" placeholder="Ingrese de nuevo su numero de documento" id="verificacion_documento" name="verificacion_documento" pattern="[0-9]+" autocomplete="off" required></p>
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



                <div class="row">
                    <div class="col">
                    <p><input type="password" class="form-control" placeholder="Contraseña" name="password" required></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-check">

                            <input class="form-check-input" type="checkbox" value="" required id="flexCheckDefault">
                            
                                <label class="form-check-label" for="flexCheckDefault">
                                <a href="http://gmas.colmayor.edu.co:8080/gmas/downloadFile.public?repositorioArchivo=000000009712&ruta=/documentacion/0000003379/0000000061" target="_blank">He leído toda la información correspondiente y acepto el manejo de mi información personal.</a>
                                </label>
                        </div>
                    </div>
                </div>


                <button type="submit" class="btn btn-success btn-sm"><i class="bi bi-box-arrow-in-right"></i> Completar Registro</button>

            </form>
        </div>
    </div>
</div>
    
    
    

<!-- <div style="display: flex; justify-content: center; align-items: center;">

    

</div> -->

<!-- <div class="d-flex align-items-center justify-content-center" style="height: 350px">
        <div class="p-2 bd-highlight col-example">Flex item</div>
        <div class="p-2 bd-highlight col-example">Flex item</div>
        <div class="p-2 bd-highlight col-example">Flex item</div>
      </div> -->



</body>

<script src="library/library.js"></script>

</html>
