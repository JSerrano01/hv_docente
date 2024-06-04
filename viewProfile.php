<!DOCTYPE html>

<?php 

$allowedRoles = ['administrador','coordinador'];

include('access.php');
include('database.php'); 
include('library/library.php'); 

?>

<html lang="en">

    <head><?php include('head.php');?></head>

    <body>

        <?php include('navbar.php');

        if (isset($_GET['user'])){?>

        <div class="container p-2">

            <?php 
                        
                $result = connection()->query("SELECT * FROM `perfiles` 
                JOIN `usuarios` ON perfiles.usuario_id = usuarios.id
                JOIN `maestra_documento` ON perfiles.documento_id = maestra_documento.id
                JOIN `maestra_ciudades` ON perfiles.ciudad_id = maestra_ciudades.id
                JOIN `maestra_departamentos` ON perfiles.departamento_id = maestra_departamentos.id
                WHERE `usuario_id` = '$_GET[user]' LIMIT 1");  

                $row = mysqli_fetch_array($result);

                $numeroDocumento = $row['numero_documento'];?>

                    


            <div class="row">

                <div class="col-4 align-self-center">

                    <div class="card">
                        <div class="card-body" style="text-align: center">
                            <img src="img/img1.png" style = "height: 18rem" class="d-inline-block align-top" alt="">
                        </div>
                    </div>

                </div>

                <div class="col">

                    <ul class="list-group">

                        <li class="list-group-item"><strong>Nombre Completo: </strong><?php echo $row['primer_nombre'].' '.$row['primer_apellido'];?></li>
                        <li class="list-group-item"><strong>Cedula: </strong><?php echo $row['numero_documento'];?><strong>  Tipo: </strong><?php echo $row['name'];?></li>
                        <li class="list-group-item"><strong>Correo: </strong><?php echo $row['correo'];?></li>
                        <li class="list-group-item"><strong>Telefono Celular: </strong><?php echo $row['celular'];?></li>
                        <li class="list-group-item"><strong>Fecha de Nacimiento: </strong><?php echo $row['nacimiento'];?></li>
                        <li class="list-group-item"><strong>Direccion: </strong><?php echo $row['direccion'];?></li>
                        <li class="list-group-item"><strong>Municipio: </strong><?php echo $row['MUNICIPIO'];?></li>
                        <li class="list-group-item"><strong>Departamento: </strong><?php echo $row['DEPARTAMENTO'];?></li>

                    </ul>

                </div>

            </div>

            <div class="row mt-3">               

                <div class="col">

                    <ul class="list-group">
                        <li class="list-group-item">Estudios Realizados</li>
                        <li class="list-group-item">

                            <table class="table table-striped">
                                <thead>

                                    <tr>
                                        <th scope="col">Titulo</th>
                                        <th scope="col">Tipo</th>
                                        <!--<th scope="col">Fecha Inicial</th>
                                        <th scope="col">Fecha Final</th>-->
                                        <th scope="col">Fecha de Graduacion</th>
                                        <!--<th style="text-align: center" scope="col">Duracion</th>-->
                                        <th style="text-align: center" scope="col">Documento</th>
                                        
                                    </tr>
                                    
                                </thead>
                                <tbody>

                                    <?php

                                        $result = connection()->query("SELECT * FROM `estudios` 
                                        INNER JOIN `maestra_titulo` ON estudios.tipo = maestra_titulo.id 
                                        WHERE estudios.usuario_id='$_GET[user]'");
                                        while($row = mysqli_fetch_array($result)){

                                        $date1 = new DateTime($row['fecha_inicio']);
                                        $date2 = new DateTime($row['fecha_final']);
                                        $diff = $date1->diff($date2);
                                        $date = round(($diff->y * 12) + $diff->m + ($diff->d/28),2)." Meses";
                                        $path = "storage/".$numeroDocumento."/studies/".$row['file'];

                                    ?>

                                    <tr>
                                        <td><?php echo $row['titulo'];?></td>
                                        <td><?php echo $row['name'];?></td>
                                        <!--<td><?php echo $row['fecha_inicio'];?></td>
                                        <td><?php echo $row['fecha_final'];?></td>-->
                                        <td><?php echo $row['fecha_graduacion'];?></td>
                                        <!--<td width="10%" style="text-align: center"><?php echo $date;?></td>-->
                                        <td width="10%" style="text-align: center"><button type="button" class="btn btn-sm btn-info" onclick="window.open('<?php echo $path;?>', '_blank');"><i class="bi bi-file-earmark-check"></i></button></td>           
                                    </tr>

                                    <?php } ?>

                                </tbody>
                            </table>
                        </li>
                    </ul>
                </div>
            </div>   

            <div class="row mt-3">               

                <div class="col">

                    <ul class="list-group">
                        <li class="list-group-item">Experiencia Laboral</li>
                        <li class="list-group-item">

                            <table class="table table-striped">
                                <thead>

                                    <tr>
                                        <th scope="col">Descripcion del Perfil</th>
                                        <th scope="col">Entidad</th>
                                        <th scope="col">Fecha Inicial</th>
                                        <th scope="col">Fecha Final</th>
                                        <th style="text-align: center" scope="col">Duracion</th>
                                        <th style="text-align: center" scope="col">Documento</th>
                                        
                                    </tr>
                                    
                                </thead>
                                <tbody>

                                    <?php

                                        $result = connection()->query("SELECT * FROM `experiencia` WHERE experiencia.usuario_id='$_GET[user]'");
                                        while($row = mysqli_fetch_array($result)){

                                        $date1 = new DateTime($row['fecha_inicio']);
                                        $date2 = new DateTime($row['fecha_final']);
                                        $diff = $date1->diff($date2);
                                        $date = round(($diff->y * 12) + $diff->m + ($diff->d/28),2)." Meses";
                                        $path = "storage/".$numeroDocumento."/experience/".$row['file'];

                                    ?>

                                    <tr>
                                        <td width="40%"><?php echo $row['funcion'];?></td>
                                        <td><?php echo $row['entidad'];?></td>
                                        <td><?php echo $row['fecha_inicio'];?></td>
                                        <td><?php echo $row['fecha_final'];?></td>
                                        <td width="10%" style="text-align: center"><?php echo $date;?></td>
                                        <td width="10%" style="text-align: center"><button type="button" class="btn btn-sm btn-info" onclick="window.open('<?php echo $path;?>', '_blank');"><i class="bi bi-file-earmark-check"></i></button></td>           
                                    </tr>

                                    <?php } ?>

                                </tbody>
                            </table>
                        </li>
                    </ul>
                </div>
            </div> 
            
            <div class="row mt-3">               

                <div class="col">

                    <ul class="list-group">
                        <li class="list-group-item">Documentos</li>
                        <li class="list-group-item">

                            <table class="table table-striped">
                                <thead>

                                    <tr>
                                        <th scope="col">Tipo</th>
                                        <th scope="col" style="text-align: center">Documento</th>
                                        
                                    </tr>
                                    
                                </thead>
                                <tbody>

                                    <?php

                                        $result = connection()->query("SELECT * FROM `documentos` 
                                        INNER JOIN `maestra_documento` ON documentos.tipo_id = maestra_documento.id 
                                        WHERE documentos.usuario_id='$_GET[user]' LIMIT 1");

                                        $row = mysqli_fetch_array($result);
                                        $path = "storage/".$numeroDocumento."/documents/".$row['file'];

                                    ?>

                                    <tr>
                                        <td width="40%"><?php echo $row['name'];?></td>
                                        <td style="text-align: center"><button type="button" class="btn btn-sm btn-info" onclick="window.open('<?php echo $path;?>', '_blank');"><i class="bi bi-file-earmark-check"></i></button></td>           
                                    </tr>

                                </tbody>
                            </table>
                        </li>
                    </ul>
                </div>
            </div>   
        </div>

    <?php } ?>

    </body>
    
    <script src="library/library.js"></script>

</html>