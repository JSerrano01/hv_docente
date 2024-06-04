<!DOCTYPE html>
<?php 

$allowedRoles = ['administrador','reclutador'];

include('access.php');
include('database.php'); 
include('library/library.php'); 

?>

<html lang="en">

<head><?php include('head.php');?></head>

    <body>

        <?php include('navbar.php');?>

    <p>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Usuarios</div>

                    <div class="card-body">

                        <table id="callersTable" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th style="text-align: center">Cedula</th>
                                    <th>Nombre</th>
                                    <th>Rol</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <p>

    <script>
    $(document).ready(function() {
    
        $('#callersTable').DataTable( {

            ajax: 'crud/selectUsers.php',
            stateSave: true,

            "columnDefs": [
                {targets: 1, className: 'dt-head-center'},

                {
                    "targets": 0,
                    "className": "text-center",
                    "width": "10%",
                },

                {
                    "targets": 1,
                    "className": "text-left",
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
                }
            ],

            columns: [
                {data:'cedula'},
                {data:'nombre'},
                {data:'rol'},
                {data:'acciones'}
            ],

            language: {
                url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json'
            },
        });
    });</script>

    </body>
    
</html>