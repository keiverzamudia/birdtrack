
import {ValidarCampo}from './validacion.js';

//validacion del formulario de registro de mantenimiento
$(document).ready(function(){

    const id = ("#id_activo");
    const empleado = ("#cedula_empleado");
    const tipo = ("#id_tipo_mantenimiento");

    const errores = {
        id: true,
        empleado: true,
        tipo: true,
    }
    
    
    
  // --- VALIDACIÓN INSTANTÁNEA DE SELECTS ---
  $("#formRegistroMTTO select").on("change click", function() {
    const valor = $(this).val();
    if (valor === '' || valor === null) {
      $(this).addClass('is-invalid').removeClass('is-valid');
    } else {
      $(this).addClass('is-valid').removeClass('is-invalid');
    }
  });



  // --- VALIDACIÓN AL ENVIAR EL FORMULARIO ---
  $("#formRegistroMTTO").submit(function (e){
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

$(document).ready(function() {

  const $form = $("#formEditarMTTO");

  // Seleccionar correctamente los elementos
  const $id = $("#id");
  const $empleado = $("#cedula_empleadoEdit");
  const $tipo = $("#id_tipo_mantenimientoEdit");
  const $estado = $("#estadoEdit");

  const errores = {
    id: false,
    empleado: false,
    tipo: false,
    estado: false,
  };

  // --- VALIDACIÓN INSTANTÁNEA DE SELECTS ---
  $form.find("select").on("change click", function() {
    const valor = $(this).val();

    if (valor === '' || valor === null) {
      $(this).addClass('is-invalid').removeClass('is-valid');
    } else {
      $(this).addClass('is-valid').removeClass('is-invalid');
    }
  });

  // --- VALIDACIÓN AL ENVIAR EL FORMULARIO ---
  $form.on("submit", function(e) {
    e.preventDefault();
    let valido = true;

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

    // Cierra el modal después de 2 segundos
    setTimeout(() => {
      const modal = bootstrap.Modal.getInstance($("#editarMTTOModal")[0]);
      if (modal) modal.hide();

      // Limpiar el formulario
      $form[0].reset();
      $form.find('.is-valid, .is-invalid').removeClass('is-valid is-invalid');
    }, 2000);
  });

  // Limpia las clases de validación cuando se cierra el modal manualmente
  $('#editarMTTOModal').on('hidden.bs.modal', function() {
    $form[0].reset();
    $form.find('.is-valid, .is-invalid').removeClass('is-valid is-invalid');
  });

});
