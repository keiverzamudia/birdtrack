export const regExp ={

    email: /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/,
    contraseña: /^[a-zA-Z0-9]{8,}$/,
    descripcion:  /^[A-Za-zÁÉÍÓÚáéíóúÑñ0-9!@#$%^&*(),.?":{}|<>_\-+=\[\]\\/ ]+$/,
    nombre: /^[A-Za-zÁÉÍÓÚáéíóúÑñ_\-.,;:/\*\+\$ ]+$/,
    cedula: /^[0-9]{8}$/,
    telefono: /^[0-9]{11}$/,
    hoy: new Date().toISOString().split("T")[0],
    Direccion: /^[\p{L}0-9.,\/_\-'" ]+$/u,
    TotalCompra:/^[0-9]+$/ ,
    Costo: /^[0-9]+([.,][0-9]{2})$/,
    listaCompra:  /^[\p{L}0-9 ]+(?:\s*,\s*[\p{L}0-9 ]+)*$/u,


};