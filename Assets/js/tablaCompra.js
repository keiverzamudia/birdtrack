let tablaComp;
const endpoint = typeof baseUrl !== 'undefined' ? baseUrl : '?url=compras';

$(document).ready(async function () {

  tablaComp = $('#tablaCompra').DataTable({
    ajax: {
      url: '',
      method: 'POST',
      data: {
        consultar: true
      },
      dataSrc: 'data',
    },
    columns: [
      { data: "id_compra" },
      { data: "Proveedor" },
      { data: "Empleado" },
      { data: "Detalle_Compra" },
      { data: "Cantidad" },
      { data: "Costo" },
      { data: "Fecha_Compra" },

      {
        data: null,
        render: (data) => {
          return `
               <button value="${data.id_compra}" type="button" id="btnregistarcomp"  class="btn btn-warning ms-2 mt-1 btnmodificar"><i class="fa-solid fa-pen-to-square"></i></button>
                <button value="${data.id_compra}" type="button" id="btneliminarcomp"  class="btn btn-danger ms-2 mt-1 btnEliminar"><i class="fa-solid fa-trash"></i></button>`;
        },
      },],
    autoWidth: false,
    columnDefs: [
      { targets: [0, 1, 2, 3, 4, 5, 6,], ClassName: "tablaCompra" },
      { targets: [7], ClassName: "acciones", ordereable: false },
    ],
    language: { url: "https://cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json" }
  })

});


$(document).on('click', '#btneliminarcomp', function () {

  const id_compra = $(this).val();
  Swal.fire({
    title: "¿Estás seguro?",
    text: `Eliminarás el registro de compra:  #${id_compra}`,
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
          id_compra,
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

          tablaComp.ajax.reload();
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




$(document).on('click', '#btnEnviar', function (e) {
  e.preventDefault();

  const formRegcom = $('#formRegistrarCompra')[0];
  if (!formRegcom) {
    alert('No se encontró el formulario.');
    return;
  }

  const formData = new FormData(formRegcom);
  formData.append('enviar_compra', true);

  $.ajax({
    url: '',
    method: 'POST',
    dataType: 'json',
    data: formData,
    processData: false,
    contentType: false,
    success: function (mensaje) {

      $('#realizar_compra').modal('hide');
      setTimeout(() => {
        $('.modal-backdrop').remove();
        $('body').removeClass('modal-open');
        $('body').css({ 'overflow': 'auto', 'padding-right': '' });
      }, 500)

      
      tablaComp.ajax.reload();

       Swal.fire({
            icon: "success",
            title: "Registro exitoso",
            text: "El tipo de mantenimiento fue guardado correctamente ✅",
            timer: 1500,
            showConfirmButton: false
          });
    },
    error: function (xhr, status, error) {
        console.error("Error AJAX:", error, status, xhr.responseText);
        Swal.fire({
          icon: "error",
          title: "Error de conexión",
          text: "No se pudo conectar con el servidor."
        });
      }
  });
});


