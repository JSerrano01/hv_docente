<!DOCTYPE html>

<?php 

#--------------VALIDACION DE PERMISOS A LA VISTA-----------------------------
$allowedRoles = ['administrador','coordinador'];

include('access.php');
include('database.php'); 
include('library/library.php'); 


?>

<html lang="en">

    <head><?php include('head.php');?></head>

    <body>

        <?php include('navbar.php');?>

    <p>
<!-- -------------------TABLA DE ASAPIRANTES A SELECCIONAR EN CONVOCATORIAS-------------------------- -->
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">Aspirantes</div>

                <div class="card-body">

                    <table id="example" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th style="text-align: center">Codigo</th>
                                <th>Facultad</th>
                                <th>Materia</th>
                                <th>Candidato</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <p>
<!-- -------------------TABLA DE CONVOCATORIAS ACTUALMENTE ABIERTAS CREADAS POR EL USUARIO ACTUAL-------------------------- -->
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">Convocatorias Abiertas</div>

                <div class="card-body">

                    <table class="display" id="tableCall" style="width:100%">
                        <thead>
                            <tr>
                                <th style="text-align: center">Codigo </th>
                                <th>Facultad</th>
                                <th>Materia</th>
                                <th>N° Candidatos</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <p>
<!-- -------------------TABLA DE CONVOCATORIAS CERRADAS CREADAS POR EL USUARIO ACTUAL-------------------------- -->
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">Historial</div>

                <div class="card-body">

                    <table id="tableRecord" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th style="text-align: center">N.Serie </th>
                                <th style="text-align: center">Codigo </th>
                                <th>Facultad</th>
                                <th>Materia</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <p>

</body>

<script>

// ---------------------------- EJECUCION DE SCRIPT PARA DataTables DE INFORMACION DE PARAMETRO DOCUMENT----------------

$(document).ready(function() {


    // ---------------------------- EJECUCION DE SCRIPT PARA DataTable DE INFORMACION DE PERFILES DE ASPIRANTES----------------
    $('#example').DataTable( {
        ajax: 'crud/selectPerfil.php',

        "columnDefs": [

            {targets: 1, className: 'dt-head-center'},

            {
                "targets": 0,
                "className": "text-center",
                "width": "10%",
            },

            {
                "targets": 2,
                "className": "text-center",
                "width": "10%",
            },

            {
                "targets": 3,
                "className": "text-center",
                "width": "10%",
            },

            {
                "targets": 4,
                "className": "text-center",
                "width": "10%",
            }
          ],

        columns: [
            {data:'codigo'},
            {data:'facultad'},
            {data:'materia'},
            {data:'candidato'},
            {data:'acciones'},
        ],

        language: {
            url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json'
        },
    });

    // ---------------------- EJECUCION DE SCRIPT PARA DataTable DE INFORMACION DE PERFILES SELECCIONADOS A CONVOCATORIAS ABIERTAS----------------
    
    $('#tableCall').DataTable( {
        ajax: 'crud/selectCall.php',

        "columnDefs": [

            {targets: 1, className: 'dt-head-center'},

            {
                "targets": 0,
                "className": "text-center",
                "width": "10%",
            },

            {
                "targets": 3,
                "className": "text-center",
                "width": "10%",
            },

            {
                "targets": 4,
                "className": "text-center",
                "width": "10%",
            }
          ],

        columns: [
            {data:'codigo'},
            {data:'facultad'},
            {data:'materia'},
            {data:'ncandidatos'},
            {data:'acciones'},
        ],

        language: {
            url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json'
        },
    });

    // ---------------------------- EJECUCION DE SCRIPT PARA DataTable DE INFORMACION HISTORIAL DE CONVOCATORIAS FINALIZADAS---------------

    $('#tableRecord').DataTable( {
        ajax: 'crud/selectRecord.php',

        "columnDefs": [

            {targets: 1, className: 'dt-head-center'},

            {
                "targets": 0,
                "className": "text-center",
                "width": "10%",
            },

            {
                "targets": 1,
                "className": "text-center",
                "width": "10%",
            },

            {
                "targets": 3,
                "className": "text-center",
                "width": "10%",
            },

            {
                "targets": 4,
                "className": "text-center",
                "width": "10%",
            }
          ],

        columns: [
            {data:'serial_number'},
            {data:'codigo'},
            {data:'facultad'},
            {data:'materia'},
            {data:'acciones'},
        ],

        language: {
            url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json'
        },
    });
});

function confirmacionAbrirConvocatoria(){

if(confirm("¿Desea crear convocatoria o agregar candidato?")){return true;}
return false;}

function alertaParticipanteOcupado(){

if(confirm("Este candidato ya esta seleccionado")){return true;}
return false;}

function alertaEliminacionConvocatoria(){

if(confirm("Desea eliminar la convocatoria")){return true;}
return false;}

</script>

</html>