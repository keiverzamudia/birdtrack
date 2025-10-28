import { validarNombre, ValidarDescripcion, ValidarFecha } from "./validacion.js";

$(document).ready(function(){

  // Seleccionar los elementos del formulario
  const tipoActivo = $("#id_activo_create");
  const Empleado = $("#cedula_empleado_create");
  const Descripcion = $("#descripcion");
  const Fecha = $("#fecha");

  // Objeto para controlar los errores
  const errores = {
    Descripcion: true,
    Fecha: true,
  };

  // --- VALIDACIÓN DE DESCRIPCIÓN ---
    Descripcion.on('input', async function(){
        const Valido = await ValidarDescripcion(Descripcion);
        errores.Descripcion = !Valido;
    })


  // --- VALIDACIÓN DE FECHA ---

  Fecha.on('input', async function(){
    const Valido = await ValidarFecha(Fecha);
    errores.Fecha = !Valido;
    
  })


  // --- VALIDACIÓN INSTANTÁNEA DE SELECTS ---
  $("#formCrearAsignacion select").on("change click", function() {
    const valor = $(this).val();
    if (valor === '' || valor === null) {
      $(this).addClass('is-invalid').removeClass('is-valid');
    } else {
      $(this).addClass('is-valid').removeClass('is-invalid');
    }
  });



  // --- VALIDACIÓN AL ENVIAR EL FORMULARIO ---
  $("#formCrearAsignacion").submit(function (e){
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

    if (!valido) return;

    // Si todo es correcto
    alert("✅ Formulario enviado correctamente");
    $(this)[0].reset();
    $(this).find('.is-valid, .is-invalid').removeClass('is-valid is-invalid');
  });
});



$(document).ready(function(){
  
      const tipoActivo = $("#id_activo_edit");
  const Empleado = $("#cedula_empleado_edit");
  const Descripcion = $("#descripcionEdit");
  const Fecha = $("#fechaEdit");

  // Objeto para controlar los errores
  const errores = {
    Descripcion: true,
    Fecha: true,
  };

  // --- VALIDACIÓN DE DESCRIPCIÓN ---
    Descripcion.on('input', async function(){
        const Valido = await ValidarDescripcion(Descripcion);
        errores.Descripcion = !Valido;
    })


  // --- VALIDACIÓN DE FECHA ---

  Fecha.on('input', async function(){
    const Valido = await ValidarFecha(Fecha);
    errores.Fecha = !Valido;
    
  })


  // --- VALIDACIÓN INSTANTÁNEA DE SELECTS ---
  $("#formEditarAsignacion select").on("change click", function() {
    const valor = $(this).val();
    if (valor === '' || valor === null) {
      $(this).addClass('is-invalid').removeClass('is-valid');
    } else {
      $(this).addClass('is-valid').removeClass('is-invalid');
    }
  });



  // --- VALIDACIÓN AL ENVIAR EL FORMULARIO ---
  $("#formEditarAsignacion").submit(function (e){
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

    if (!valido) return;

    // Si todo es correcto
    alert("✅ Formulario enviado correctamente");
    $(this)[0].reset();
    $(this).find('.is-valid, .is-invalid').removeClass('is-valid is-invalid');
  });
});
