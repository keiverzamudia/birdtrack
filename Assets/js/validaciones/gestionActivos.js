import{ validarNombre, ValidarDescripcion, ValidarFecha } from './validacion.js';

$(document).ready(function(){

    const id_activo = $("#id_activo");
    const id_ubicacion = $("#id_ubicacion");
    const Nombre = $("#Nombre");
    const Descripcion = $("#Descripcion");
    const Fecha = $("#Fecha");

    const errores = {
        id_tipo_activo: true,
        id_ubicacion: true,
        Nombre: true,
        Descripcion: true,
        Fecha: true,
    };

    Nombre.on('input', async function(){
        const Valido = await validarNombre(Nombre);
        errores.Nombre = !Valido;
    })

    Descripcion.on('input', async function(){
        const Valido = await ValidarDescripcion(Descripcion);
        errores.Descripcion = !Valido;
    });

  Fecha.on('input', async function(){
    const Valido = await ValidarFecha(Fecha);
    errores.Fecha = !Valido;
    
  });

      $("#formRegistrarActivo select").on("change click", function() {
    const valor = $(this).val();
    if (valor === '' || valor === null) {
      $(this).addClass('is-invalid').removeClass('is-valid');
    } else {
      $(this).addClass('is-valid').removeClass('is-invalid');
    }
  });



  // --- VALIDACIÓN AL ENVIAR EL FORMULARIO ---
  $("#formRegistrarActivo").submit(function (e){
    e.preventDefault();
    let valido = true;

    // Revisar errores en los inputs
    for (let key in errores) {
      if (errores[key] === true) {
        alert('⚠️ Por favor completa correctamente todos los campos.');
        valido = false;
        break;
      }
    }

    // Revisar selects vacíos
    $(this).find('select').each(function() {
      if ($(this).val() === '' || $(this).val() === null) {
        $(this).addClass('is-invalid').removeClass('is-valid');
        valido = false;
      }
    });

   if (!valido) {
      Swal.fire({
        icon: "warning",
        title: "Campos incompletos ⚠️",
        text: "Por favor, completa correctamente todos los campos antes de guardar.",
        confirmButtonColor: "#f0ad4e",
      });
      return;
    }

    // ✅ Si todo está correcto
    Swal.fire({
      icon: "success",
      title: "✅ Cambios guardados correctamente",
      text: "Los datos del mantenimiento se han actualizado.",
      showConfirmButton: false,
      timer: 2000,
      timerProgressBar: true,
    });

      

});
});

$(document).ready(function(){
        const id_activo = $("#id_activoEdit");
    const id_ubicacion = $("#id_ubicacionEdit");
    const Nombre = $("#NombreEdit");
    const Descripcion = $("#DescripcionEdit");
    const Fecha = $("#FechaEdit");

    const errores = {
        id_tipo_activo: true,
        id_ubicacion: true,
        Nombre: true,
        Descripcion: true,
        Fecha: true,
    };

    Nombre.on('input', async function(){
        const Valido = await validarNombre(Nombre);
        errores.Nombre = !Valido;
    })

    Descripcion.on('input', async function(){
        const Valido = await ValidarDescripcion(Descripcion);
        errores.Descripcion = !Valido;
    });

  Fecha.on('input', async function(){
    const Valido = await ValidarFecha(Fecha);
    errores.Fecha = !Valido;
    
  });

      $("#formEditarTipoActivo select").on("change click", function() {
    const valor = $(this).val();
    if (valor === '' || valor === null) {
      $(this).addClass('is-invalid').removeClass('is-valid');
    } else {
      $(this).addClass('is-valid').removeClass('is-invalid');
    }
  });



  // --- VALIDACIÓN AL ENVIAR EL FORMULARIO ---
  $("#formEditarTipoActivo").submit(function (e){
    e.preventDefault();
    let valido = true;

    // Revisar errores en los inputs
    for (let key in errores) {
      if (errores[key] === true) {
        alert('⚠️ Por favor completa correctamente todos los campos.');
        valido = false;
        break;
      }
    }

    // Revisar selects vacíos
    $(this).find('select').each(function() {
      if ($(this).val() === '' || $(this).val() === null) {
        $(this).addClass('is-invalid').removeClass('is-valid');
        valido = false;
      }
    });

   if (!valido) {
      Swal.fire({
        icon: "warning",
        title: "Campos incompletos ⚠️",
        text: "Por favor, completa correctamente todos los campos antes de guardar.",
        confirmButtonColor: "#f0ad4e",
      });
      return;
    }

    // ✅ Si todo está correcto
    Swal.fire({
      icon: "success",
      title: "✅ Cambios guardados correctamente",
      text: "Los datos del mantenimiento se han actualizado.",
      showConfirmButton: false,
      timer: 2000,
      timerProgressBar: true,
    });

}); 




});

$(document).ready(function(){
        const NombreTipoActivo = $("#nombre_tipo_activo");
    const DescripcionTipoActivo = $("#descripcion_tipo_activo");

    const errores = {
        Nombre: true,
        Descripcion: true,
    }

    NombreTipoActivo.on("click", async function(){
        const Valido = await validarNombre(NombreTipoActivo);
        errores.Nombre = !Valido;
    })
    
    DescripcionTipoActivo.on('click', async function(){
        const Valido = await ValidarDescripcion(DescripcionTipoActivo);
        errores.Descripcion = !Valido;
    })

    $("#formEditarTipoActivo").submit(function (e){

        e.preventDefault();

        for(let key in errores){
            if(errores[key] === true){
             alert('ingrese los datos correcatemente');
             return false;
        }
        alert("Formulario Editado Corrrectamente ✅");
        $("#formEditarTipoActivo")[0].reset();
        $("#form-control").removeClass('is-invalid');
    }


})})