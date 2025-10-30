let tablaProv;
const endpoint = typeof baseUrl !== 'undefined' ? baseUrl : '?url=gestionProveedores';

$(document).ready(async function () {

const tablaProv = $('#tablaProv').DataTable({
    ajax: {
      url: '',
      method: 'POST',
      data: {
        consultar: true
      },
      dataSrc: '',
    },
    columns: [
      { data: "cod_proveedor" },
      { data: "Nombre_Proveedor" },
      { data: "Direccion" },
      { data: "Numero_telefono" },
      { data: "Correo_elect" },
      {
        data: null,
        render: (data) => {
          return `
               <button value="${data.cod_proveedor}" type="button" id="btnregistarprov"  class="btn btn-warning ms-2 mt-1 btnmodificar"><i class="fa-solid fa-pen-to-square"></i></button>
                <button value="${data.cod_proveedor}" type="button" id="btneliminarprov" name="eliminar"  class="btn btn-danger ms-2 mt-1 btnEliminar"><i class="fa-solid fa-trash"></i></button>`;
        },
      },],
    autoWidth: false,
    columnDefs: [
      { targets: [0, 1, 2, 3, 4], ClassName: "tablaProv" },
      { targets: [5], ClassName: "acciones", ordereable: false },
    ],
    language: { url: "https://cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json" }
  })

$(document).on('click', '#btneliminarprov', function () {

  const cod_proveedor = $(this).val();
  Swal.fire({
    title: "¿Estás seguro?",
    text: `Eliminarás el registro de compra:  #${cod_proveedor}`,
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Sí, eliminar",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: endpoint,
        method: 'POST',
        dataType: 'json',
        data: {
          cod_proveedor,
          eliminar: true
        },
        success: function (respuesta) {
          Swal.fire({
            icon: "success",
            title: "Eliminado",
            text: "El registro fue eliminado correctamente.",
            timer: 1500,
            showConfirmButton: false,
          });

          tablaProv.ajax.reload();
        },
        error: function (xhr, status, error) {
          console.error("Error AJAX:", error);
          Swal.fire({
            icon: "error",
            title: "Error",
            text: "No se pudo eliminar el registro.",
          });
        },
      });
    }
  });
});




$("#btnregistrarprov").on('click', function (e) {
  e.preventDefault();
  $.ajax({
    url: '',
    method: 'POST',
    dataType: 'json',
    data: 
    {
      Nombre_Proveedor : $('#Nombre_Proveedor').val(),
      Direccion : $('#Direccion').val(),
      Numero_telefono : $('#Numero_telefono').val(),
      Correo_elect : $('#Correo_elect').val(),
    },
    success: function (respuesta) {
          Swal.fire({
            icon: "success",
            title: "Registro",
            text: "El registro se hizo correctamente.",
            timer: 1500,
            showConfirmButton: false,
          });

          
      $('#registro_proveedor').modal('hide');
      setTimeout(() => {
        $('.modal-backdrop').remove();
        $('body').removeClass('modal-open');
        $('body').css({ 'overflow': 'auto', 'padding-right': '' });
      }, 500)

          tablaProv.ajax.reload();
        },
        error: function (xhr, status, error) {
      console.error("Error AJAX:", error);
      console.log(xhr.responseText);
      Swal.fire({
        icon: "error",
        title: "Error",
        text: "No se pudo registrar el proveedor.",
      });
    }
  });
}); 


$('#btn-modal-activo').on('click', function () {
$('#Nombre_Proveedor').val('')
$('#Direccion').val('')
$('#Numero_telefono').val('')
$('#Correo_elect').val('')
$('#btnregistrarprov').text('REGISTRAR')
$('#btnregistrarprov').val('registrar')
  });





})