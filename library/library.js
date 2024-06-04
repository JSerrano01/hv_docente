function isElement(element){

    if(document.getElementById(element)){
        return true
    }

    else{
        return false
    }
} 

$(document).ready(function() {
    
    if(isElement('example')){
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
                "targets": 1,
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
            }
          ],

        columns: [
            {data:'codigo'},
            {data:'materia'},
            {data:'candidato'},
            {data:'acciones'},
        ],

        language: {
            url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json'
        },
    });}

    if(isElement('tableSubjects')){

    
        $('#tableSubjects').DataTable( {
            ajax: 'crud/getSubjects.php',

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
                }
              ],
            
            columns: [
                {data:'acciones'},
                {data:'facultad'},
                {data:'programa'},
                {data:'codigoMateria'},
                {data:'materia'}
                
            ],

            stateSave: true,
    
            language: {
                url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json'
            },
        });
      }

    if(isElement('tableCall')){
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
            }
          ],

        columns: [
            {data:'codigo'},
            {data:'materia'},
            {data:'ncandidatos'},
            {data:'acciones'},
        ],

        language: {
            url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json'
        },
    });}

    

});


function confirmation() {

    if(confirm("¿Realmente desea eliminar?")){return true;}
    return false;

}

function verification() {

    if($('#numero_documento').val()===$('#verificacion_documento').val()){

        if($('#email').val()===$('#verificacion_email').val()){return true;}

        else{
            alert("los email son diferentes.");
            return false;}}

    else{ 
        alert("los numeros de identificacion son diferentes.");
        return false;}

}

function mensajeActualizacion() {

    alert('Datos Actualizados');

}

