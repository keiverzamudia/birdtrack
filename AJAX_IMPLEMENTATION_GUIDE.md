# Guía de Implementación AJAX para Módulos BirdTrack

## Análisis del Flujo Actual vs AJAX

### Flujo Actual (Sin AJAX):
```
Frontend → Controlador → Modelo → Base de Datos
Base de Datos → Modelo → Controlador → Frontend (con redirect)
```

### Flujo AJAX (Recomendado):
```
Frontend → AJAX → Controlador → Modelo → Base de Datos
Base de Datos → Modelo → Controlador → JSON Response → Frontend
```

## Implementación Correcta

### 1. Modificar el Controlador

Agregar al inicio del controlador:

```php
// Función para enviar respuesta JSON
function sendJsonResponse($success, $message, $data = null) {
    header('Content-Type: application/json');
    echo json_encode([
        'success' => $success,
        'message' => $message,
        'data' => $data
    ]);
    exit();
}

// Verificar si es una petición AJAX
$isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
          strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
```

### 2. Modificar cada operación CRUD

**Antes:**
```php
if(isset($_POST['enviar'])){
    // ... lógica ...
    if($obj_model->registrar()) {
        $mensaje = "Registro exitoso";
    } else {
        $mensaje = "Error al registrar";
    }
    header("Location: index.php?url=modulo");
    exit();
}
```

**Después:**
```php
if(isset($_POST['enviar'])){
    // ... lógica ...
    if($obj_model->registrar()) {
        if($isAjax) {
            sendJsonResponse(true, "Registro exitoso");
        } else {
            $mensaje = "Registro exitoso";
            header("Location: index.php?url=modulo");
            exit();
        }
    } else {
        if($isAjax) {
            sendJsonResponse(false, "Error al registrar");
        } else {
            $mensaje = "Error al registrar";
            header("Location: index.php?url=modulo");
            exit();
        }
    }
}
```

### 3. Crear archivo JavaScript

Crear `Assets/js/nombreModulo.js`:

```javascript
$(document).ready(function() {
    // Configurar headers AJAX
    $.ajaxSetup({
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    });

    // Manejar formularios
    $('#formCrear').on('submit', function(e) {
        e.preventDefault();
        enviarFormulario(this, 'enviar');
    });

    $('.formEditar').on('submit', function(e) {
        e.preventDefault();
        enviarFormulario(this, 'editar');
    });

    // Función genérica para enviar formularios
    function enviarFormulario(form, accion) {
        const formData = new FormData(form);
        formData.append(accion, '1');
        
        $.ajax({
            url: 'index.php?url=nombreModulo',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    showAlert('success', response.message);
                    $('.modal').modal('hide');
                    location.reload();
                } else {
                    showAlert('danger', response.message);
                }
            },
            error: function(xhr, status, error) {
                showAlert('danger', 'Error en la comunicación con el servidor');
            }
        });
    }

    // Función para mostrar alertas
    function showAlert(type, message) {
        const alertHtml = `
            <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        `;
        $('.alert').remove();
        $('.container-fluid').prepend(alertHtml);
        setTimeout(() => $('.alert').fadeOut(), 5000);
    }
});
```

### 4. Modificar la Vista

1. Agregar IDs a los formularios:
```html
<form method="POST" id="formCrear">
<form method="POST" class="formEditar">
```

2. Incluir el archivo JavaScript:
```html
<script src="Assets/js/nombreModulo.js"></script>
```

## Módulos a Convertir

1. ✅ **asignacionActivo** - Completado
2. ⏳ **gestionUsuarios** - Pendiente
3. ⏳ **gestionActivos** - Pendiente
4. ⏳ **gestionMantenimiento** - Pendiente
5. ⏳ **gestionProveedores** - Pendiente
6. ⏳ **compras** - Pendiente
7. ⏳ **tipoMantenimiento** - Pendiente

## Ventajas de la Implementación AJAX

1. **Mejor UX**: No hay recargas de página
2. **Respuesta más rápida**: Solo se actualiza lo necesario
3. **Feedback inmediato**: Alertas dinámicas
4. **Compatibilidad**: Mantiene funcionalidad sin JavaScript
5. **Escalabilidad**: Fácil de implementar en otros módulos

## Consideraciones Importantes

- Mantener compatibilidad con navegadores sin JavaScript
- Validar datos tanto en frontend como backend
- Manejar errores de red apropiadamente
- Usar FormData para formularios con archivos
- Implementar CSRF tokens si es necesario
