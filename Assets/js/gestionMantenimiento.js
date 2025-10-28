$(document).ready(function(){

  // Enviar formulario por AJAX
  $('#RegistroMTTO').on('submit', function(e){
      e.preventDefault(); // Evita el envío normal del formulario
      
      $.ajax({
          url: 'index.php?url=gestionMantenimiento',
          type: 'POST',
          data: $(this).serialize() + '&insertGestionMTTO=true', 
          // indicamos la acción
          
       success: function(response){
    $('#Registrar').modal('hide');

    // Espera al cierre completo del modal
    $('#Registrar').on('hidden.bs.modal', function () {
        $('#RegistroMTTO')[0].reset();
        $('#TablaMTTO').DataTable().ajax.reload(null, false);

        Swal.fire({
            icon: 'success',
            title: '¡Registrado!',
            text: 'El mantenimiento fue agregado correctamente',
            timer: 2000,
            showConfirmButton: false
        });
    });
}


})
      })});