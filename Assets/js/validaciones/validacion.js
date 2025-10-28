import { regExp }   from './RegExp.js';

export async function ValidarCampo(campo, condicion){
    if(condicion){
        campo.removeClass('is-invalid');
    }else{
        campo.addClass('is-invalid');
    }
}

export async function validarNombre(nombre){

    if(!regExp.nombre.test(nombre.val().trim())){
        ValidarCampo(nombre, false);
        return false;
    } else {
        ValidarCampo(nombre, true);
        return true;
    }

}
export async function ValidarListaCompra(listaCompra){
    if(!regExp.listaCompra.test(listaCompra.val().trim())){
        ValidarCampo(listaCompra, false);
        return false;
    } else {
        ValidarCampo(listaCompra, true);
        return true;
    }
}

export async function ValidarCosto(Costo){
    if(!regExp.Costo.test(Costo.val().trim())){
        ValidarCampo(Costo, false);
        return false;
    } else {
        ValidarCampo(Costo, true);
        return true;
    }
}

export async function ValidarTotalCompra(totalCompra){
    if(!regExp.TotalCompra.test(totalCompra.val().trim())){
        ValidarCampo(totalCompra, false);
        return false;
    } else {
        ValidarCampo(totalCompra, true);
        return true;
    }
}

export async function ValidarEmail(email){


    if(!regExp.email.test(email.val().trim())){
        ValidarCampo(email, false);
        return false;

    } else {
        ValidarCampo(email, true);
        return true;
    }
    }

    export async function ValidarContraseña(contraseña){

        if(!regExp.contraseña.test(contraseña.val().trim())){
            ValidarCampo(contraseña, false);
            return false;

        }
         else {
            ValidarCampo(contraseña,true);
         }
    }

    export async function ValidarDescripcion(descripcion){
        if(!regExp.descripcion.test(descripcion.val().trim())){
            ValidarCampo(descripcion, false);

            return false;
        }
        else{
            ValidarCampo(descripcion, true);
            return true;
        }
    }

    export async function validarCedula(cedula){
        if(!regExp.cedula.test(cedula.val().trim())){
            ValidarCampo(cedula, false);
            return false;
        }
        else{
            ValidarCampo(cedula, true);
            return true;
        }
    }
        export async function validarTelefono(telefono){

            if(!regExp.telefono.test(telefono.val().trim())){
                ValidarCampo(telefono, false);
                return false;
            }
            else{
                ValidarCampo(telefono, true);
                return true;
            }

        }

        export async function ValidarFecha(fecha){
            if(!fecha.val() || fecha.val() < regExp.hoy ){
                ValidarCampo(fecha, false);
                return false;
            }
            else{
                ValidarCampo(fecha, true);
                return true;
            }
        }

        export async function ValidarDireccion(Direccion){

            if(!regExp.Direccion.test(Direccion.val().trim())){
                ValidarCampo(Direccion,false);
            }
            else{
                ValidarCampo(Direccion,true);
            }
        }
    


