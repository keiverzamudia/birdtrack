import { ValidarCampo, ValidarFecha, ValidarCosto, ValidarTotalCompra, ValidarListaCompra } from "./validacion.js";

$(document).ready(function () {

  // Selección de campos
  const cod_proveedor = $("#cod_proveedor");
  const cedula_empleado = $("#cedula_empleado");
  const Detalle_Compra = $("#Detalle_Compra");
  const Cantidad = $("#Cantidad");
  const Costo = $("#Costo");
  const Fecha_Compra = $("#Fecha_Compra");

  // Estado de errores
  const errores = {
    cod_proveedor: true,
    cedula_empleado: true,
    Detalle_Compra: true,
    Cantidad: true,
    Costo: true,
    Fecha_Compra: true,
  };

  // --- VALIDACIONES INDIVIDUALES ---

  // Textarea detalle (usa tu función personalizada)
  Detalle_Compra.on("input click", async function () {
    const Valido = await ValidarListaCompra(Detalle_Compra)
    errores.Detalle_Compra = !Valido;
  });

  // Input cantidad
  Cantidad.on("input click", async function () {
    const Valido = await ValidarCampo(Costo);
    errores.Cantidad = !Valido;
  });

  // Input costo
  Costo.on("input click", async function () {
    const Valido = await ValidarCampo(Cantidad);
    errores.Costo = !Valido;
  });

  // Fecha de compra
  Fecha_Compra.on("input click", async function () {
    const Valido = await ValidarFecha(Fecha_Compra);
    errores.Fecha_Compra = !Valido;
  });

  $("#formRegistrarCompra select").on("change click", function() {
    const valor = $(this).val();
    if (valor === '' || valor === null) {
      $(this).addClass('is-invalid').removeClass('is-valid');
    } else {
      $(this).addClass('is-valid').removeClass('is-invalid');
    }
  });

  // --- VALIDACIÓN FINAL AL ENVIAR ---
  $("#formRegistrarCompra").on("submit", function (e) {
    e.preventDefault();
    let valido = true;

    // Revisión general del objeto de errores
    for (let key in errores) {
      if (errores[key] === true) {
        alert("⚠️ Por favor completa correctamente todos los campos.");
        valido = false;
        break;
      }
    }

    // Revisión adicional de selects vacíos
    $(this)
      .find("select")
      .each(function () {
        if ($(this).val() === "" || $(this).val() === null) {
          $(this).addClass("is-invalid").removeClass("is-valid");
          valido = false;
        }
      });

    // Si hay errores, detener envío
    if (!valido) return;

    // ✅ Si todo es correcto
    alert("✅ Formulario enviado correctamente");

    // Limpiar formulario y clases visuales
    $(this)[0].reset();
    $(this).find(".is-valid, .is-invalid").removeClass("is-valid is-invalid");
  });
});
