import { validarCedula, validarNombre, ValidarEmail, ValidarDescripcion } from './validacion.js';

$(document).ready(function() {

  // --- Referencias a los campos ---
  const cargo = $("#cargo");
  const departamento = $("#departamento");
  const Nombre = $("#nombre");
  const Correo = $("#correo");
  const Cedula = $("#cedula");

  // --- Estado de validaciones ---
  const errores = {
    Nombre: true,
    Correo: true,
    Cedula: true,
  };

  // --- Validación en tiempo real: CÉDULA ---
  Cedula.on("input", async function() {

        const Valido = await validarCedula(Cedula);
        errores.Cedula = !Valido;
  });

  // --- Validación en tiempo real: NOMBRE ---
  Nombre.on("input", async function() {
        const Valido = await validarNombre(Nombre);
        errores.Nombre = !Valido;
  });

  // --- Validación en tiempo real: CORREO ---
  Correo.on("input", async function() {
        const Valido = await ValidarEmail(Correo);
        errores.Correo = !Valido;

   });

  // --- Validación instantánea de selects ---
  $("#formCrearUsuario select").on("change click", function() {
    const valor = $(this).val();

    if (valor === '') {
      $(this).addClass('is-invalid').removeClass('is-valid');
    } else {
      $(this).addClass('is-valid').removeClass('is-invalid');
    }
  });

  // --- Validación general al enviar ---
  $("#formCrearUsuario").on("submit", function(e) {
    e.preventDefault();
    let valido = true;

    // Revisar los errores individuales
    for (let key in errores) {
      if (errores[key] === true) {
        alert('⚠️ Por favor completa correctamente todos los campos.');
        valido = false;
        break;
      }
    }

    // Revisar selects vacíos
    $(this).find('select').each(function() {
      if ($(this).val() === '') {
        $(this).addClass('is-invalid').removeClass('is-valid');
        valido = false;
      }
    });

    // Si algo falla, no se envía
    if (!valido) return;

    // Si todo está bien:
    alert("✅ Formulario enviado correctamente");
    $("#formCrearUsuario")[0].reset();
    $("#formCrearUsuario").find('.is-valid, .is-invalid').removeClass('is-valid is-invalid');
  });

});

$(document).ready(function(){

    
  // --- Referencias a los campos ---
  const cargo = $("#cargo");
  const departamento = $("#departamento");
  const Nombre = $("#nombre");
  const Correo = $("#correo");
  const Cedula = $("#cedula");

  // --- Estado de validaciones ---
  const errores = {
    Nombre: true,
    Correo: true,
    Cedula: true,
  };

  // --- Validación en tiempo real: CÉDULA ---
  Cedula.on("input", async function() {

        const Valido = await validarCedula(Cedula);
        errores.Cedula = !Valido;
  });

  // --- Validación en tiempo real: NOMBRE ---
  Nombre.on("input", async function() {
        const Valido = await validarNombre(Nombre);
        errores.Nombre = !Valido;
  });

  // --- Validación en tiempo real: CORREO ---
  Correo.on("input", async function() {
        const Valido = await ValidarEmail(Correo);
        errores.Correo = !Valido;

   });

  // --- Validación instantánea de selects ---
  $("#formEditarUsuario select").on("change click", function() {
    const valor = $(this).val();

    if (valor === '') {
      $(this).addClass('is-invalid').removeClass('is-valid');
    } else {
      $(this).addClass('is-valid').removeClass('is-invalid');
    }
  });

  // --- Validación general al enviar ---
  $("#formEditarUsuario").on("submit", function(e) {
    
    e.preventDefault();


    // Revisar los errores individuales
    for (let key in errores) {
      if (errores[key] === false) {
        alert('⚠️ Por favor completa correctamente todos los campos.');
        errores = false;
        break;
      }
    }

    // Revisar selects vacíos
    $(this).find('select').each(function() {
      if ($(this).val() === '') {
        $(this).addClass('is-invalid').removeClass('is-valid');
        errores = false;
      }
    });

    // Si algo falla, no se envía
    if (!errores) return;

    // Si todo está bien:
    alert("✅ Formulario enviado correctamente");
    $("#formEditarUsuario")[0].reset();
    $("#formEditarUsuario").find('.is-valid, .is-invalid').removeClass('is-valid is-invalid');
  });

})

$(document).ready(function(){

    const Nombre = $("#nombre_cargo");

    const errores = {
        Nombre: true,
      
    }

    Nombre.on("input", async function(){
        const Valido = await validarNombre(Nombre);
        errores.Nombre = !Valido;
    })

    $("#formRegistrarCargo").submit(function (e){

        e.preventDefault();

        for(let key in errores){
            if(errores[key] === true){
             alert('por favor ingrese todos los campos');
             return false;
        }
        alert("Formulario Enviado Corrrectamente ✅");
        $("#formRegistrarCargo")[0].reset();
        $("#form-control").removeClass('is-invalid');
    }


    });
})

$(document).ready(function(){

    const Nombre = $("#nombre_departamento");
    const Descripcion = $("#descripcion_departamento");

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

    $("#formRegistrarDepartamento").submit(function (e){

        e.preventDefault();

        for(let key in errores){
            if(errores[key] === true){
             alert('por favor ingrese todos los campos');
             return false;
        }
        alert("Formulario Enviado Corrrectamente ✅");
        $("#formRegistrarDepartamento")[0].reset();
        $("#form-control").removeClass('is-invalid');
    }});
})