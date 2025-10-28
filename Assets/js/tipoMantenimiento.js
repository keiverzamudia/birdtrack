$(document).ready(async function(){

    $("#formCrearTipoMTTO").submit(function(e){

        const formData = new FormData(e.target);
        formData.append("enviarMTTO", true);
        console.log(formData.get("nombre_mtto"));
        console.log(formData.get("descripcion"));

        $.ajax({
            url: ' ',
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,

            success: (function(response){

                console.log(response);

                if(response == true){

                    alert("El tipo de mantenimiento ha sido creado correctamente");
                }
                else{
                    alert("Error al crear el tipo de mantenimiento");
                }

            })
        })


    })


})