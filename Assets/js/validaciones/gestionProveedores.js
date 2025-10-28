import{ validarNombre, validarTelefono, ValidarEmail, ValidarDireccion} from './validacion.js';

$(document).ready(function(){

    const Nombre = $("#NombreProveedor")
    const Direccion = $("#DireccionProveedor")
    const Telefono = $("#TelefonoProoveedor")
    const Correo = $("#CorreoProveedor")

    const errores = {
        Nombre: true,
        Direccion: true,
        Telefono: true,
        Correo: true,
    }

    Nombre.on("input click", async function(){
        const Valido = await validarNombre(Nombre);
        errores.Nombre = !Valido;
    })

    Direccion.on("input click" , async function(){
        const Valido = await ValidarDireccion(Direccion);
        errores.Direccion = !Valido;
    })
    Telefono.on("input click", async function(){
        const Valido = await validarTelefono(Telefono);
        errores.Telefono = !Valido;
    })
    Correo.on("input click", async function(){
        const Valido = await ValidarEmail(Correo);
        errores.Correo = !Valido;
    })


    $("#formRegistrarProveedor").submit(function (e){
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

        // Si todo es correcto
        alert("✅ Formulario enviado correctamente");
        $(this)[0].reset();
        $(this).find('.is-valid, .is-invalid').removeClass('is-valid is-invalid');
    });
});

$(document).ready(function(){
        const Nombre = $("#NombreProveedorEdit");
        const Direccion = $("#DireccionProveedorEdit");
        const Telefono = $("#TelefonoProveedorEdit");
        const Correo = $("#CorreoProveedorEdit");

        const errores = {
            Nombre: true,
            Direccion: true,
            Telefono: true,
            Correo: true,
        }

        Nombre.on("input click", async function(){
            const Valido = await validarNombre(Nombre);
            errores.Nombre = !Valido;
        })

        Direccion.on("input click" , async function(){
            const Valido = await ValidarDireccion(Direccion);
            errores.Direccion = !Valido;
        })
        Telefono.on("input click", async function(){
            const Valido = await validarTelefono(Telefono);
            errores.Telefono = !Valido;
        })
        Correo.on("input click", async function(){

            const Valido = await ValidarEmail(Correo);
            errores.Correo = !Valido;
        })
            $("#editarForm").submit(function (e){
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

                // Si todo es correcto
                alert("✅ Formulario enviado correctamente");
                $(this)[0].reset();
                $(this).find('.is-valid, .is-invalid').removeClass('is-valid is-invalid');
            }); 
})