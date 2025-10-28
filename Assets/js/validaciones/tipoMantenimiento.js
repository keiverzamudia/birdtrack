import { validarNombre, ValidarDescripcion } from "./validacion.js";

$(document).ready(function(){


    const Nombre = $("#nombre_mtto");
    const Descripcion = $("#descripcion") ;

    const errores = {
        Nombre: true,
        Descripcion: true,
    }

    Nombre.on("input", async function(){
        const Valido = await validarNombre(Nombre);
        errores.Nombre = !Valido;
    })
    
    Descripcion.on('input', async function(){
        const Valido = await ValidarDescripcion(Descripcion);
        errores.Descripcion = !Valido;
    })

    $("#formCrearTipoMTTO").submit(function (e){

        e.preventDefault();

        for(let key in errores){
            if(errores[key] === true){
             alert('por favor ingrese todos los campos');
             return false;
        }
        alert("Formulario Enviado Corrrectamente ✅");
        $("#formCrearTipoMTTO")[0].reset();
        $("#form-control").removeClass('is-invalid');
    }


    });





});

$(document).ready(function(){


    const Nombre2 = $("#nombre_mtto2");
    const Descripcion2 = $("#descripcion2") ;

    const errores = {
        Nombre: true,
        Descripcion: true,
    }

    Nombre2.on("input", async function(){
        const Valido = await validarNombre(Nombre2);
        errores.Nombre = !Valido;
    })
    
    Descripcion2.on('input', async function(){
        const Valido = await ValidarDescripcion(Descripcion2);
        errores.Descripcion = !Valido;
    })

    $("#formEditarTipoMtto").submit(function (e){

        e.preventDefault();

        for(let key in errores){
            if(errores[key] === true){
             alert('ingrese los datos correcatemente');
             return false;
        }
        alert("Formulario Editado Corrrectamente ✅");
        $("#formCrearTipoMTTO")[0].reset();
        $("#form-control").removeClass('is-invalid');
    }
})
})