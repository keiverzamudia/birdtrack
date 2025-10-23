# Controlador de Reclamos - Documentación

## ✅ Controlador Completado

### **Archivo:** `app/controlador/reclamos.php`

## **Características Implementadas:**

### **1. Estructura del Controlador:**
- **Patrón MVC**: Sigue la misma estructura que los demás controladores del proyecto
- **Namespace**: Utiliza `App\modelo` para los modelos
- **Sesión**: Incluye verificación de sesión con `componentes/sesion.php`
- **AJAX Support**: Soporte para peticiones AJAX y respuestas JSON

### **2. Modelos Utilizados:**
```php
use App\modelo\reclamosModelo;        // Modelo principal de reclamos
use App\modelo\gestionActivosModel;  // Para obtener activos
use App\modelo\gestionUsuariosModel; // Para obtener empleados
```

### **3. Operaciones CRUD Implementadas:**

#### **Registrar Reclamo (`enviar`):**
- **POST**: `enviar`
- **Campos**: `cedula_empleado`, `id_activo`, `descripcion`, `fecha_reclamo`
- **Respuesta**: JSON o redirección según tipo de petición

#### **Editar Reclamo (`editar`):**
- **POST**: `editar`
- **Validación**: Todos los campos son requeridos
- **Campos**: `id_reclamo`, `cedula_empleado`, `id_activo`, `descripcion`, `fecha_reclamo`
- **Respuesta**: JSON o redirección según tipo de petición

#### **Eliminar Reclamo (`eliminar`):**
- **POST**: `eliminar`
- **Campo**: `id_reclamo`
- **Respuesta**: JSON o redirección según tipo de petición

#### **Seleccionar Reclamo (`seleccion`):**
- **POST**: `seleccion`
- **Campo**: `id_reclamo`
- **Resultado**: Carga datos en `$editar_reclamo` para edición

### **4. Datos Disponibles para la Vista:**

#### **Variables Principales:**
```php
$reclamos = $obj_reclamos->consultar();                    // Todos los reclamos
$activos = $obj_activos->consultar();                      // Todos los activos
$empleados = $obj_usuarios->consultar();                  // Todos los empleados
$activos_asignados = $obj_reclamos->obtener_activos_asignados();    // Activos asignados
$activos_disponibles = $obj_reclamos->obtener_activos_disponibles(); // Activos disponibles
```

#### **Variables de Edición:**
```php
$editar_reclamo = $obj_reclamos->consultar_por_id();       // Datos del reclamo a editar
```

### **5. Funcionalidades Especiales:**

#### **Soporte AJAX:**
- **Detección**: Verifica si es petición AJAX con `HTTP_X_REQUESTED_WITH`
- **Respuestas JSON**: Función `sendJsonResponse()` para respuestas estructuradas
- **Compatibilidad**: Funciona tanto con AJAX como con formularios tradicionales

#### **Gestión de Activos:**
- **Activos Asignados**: Utiliza `obtener_activos_asignados()` del modelo
- **Activos Disponibles**: Utiliza `obtener_activos_disponibles()` del modelo
- **Integración**: Se integra con los modales de la vista

### **6. Flujo de Trabajo:**

#### **Acceso a la Vista:**
1. **URL**: `index.php?url=reclamos`
2. **FrontController**: Carga `app/controlador/reclamos.php`
3. **Datos**: Se cargan todos los datos necesarios
4. **Vista**: Se incluye `app/vista/reclamos.php`

#### **Operaciones:**
1. **Crear**: Formulario → POST `enviar` → Validación → Inserción → Respuesta
2. **Editar**: Botón → POST `seleccion` → Cargar datos → Formulario → POST `editar` → Actualización
3. **Eliminar**: Botón → Modal → POST `eliminar` → Eliminación → Respuesta

### **7. Integración con WebSocket:**

#### **Compatibilidad:**
- **WebSocket**: Los reclamos enviados via WebSocket se guardan automáticamente
- **Formularios**: Los formularios tradicionales también funcionan
- **Sincronización**: Ambos métodos se sincronizan en la base de datos

### **8. Validaciones Implementadas:**

#### **Campos Requeridos:**
- `cedula_empleado`: Cédula del empleado
- `id_activo`: ID del activo
- `descripcion`: Descripción del reclamo
- `fecha_reclamo`: Fecha del reclamo

#### **Validaciones de Edición:**
- Verifica que todos los campos estén presentes
- Valida que el ID del reclamo exista
- Confirma que los datos sean válidos

### **9. Mensajes de Respuesta:**

#### **Éxito:**
- "Reclamo registrado correctamente"
- "Reclamo actualizado correctamente"
- "Reclamo eliminado correctamente"

#### **Error:**
- "Error al registrar el reclamo"
- "Error al actualizar el reclamo"
- "Error al eliminar el reclamo"
- "Error: Todos los campos son requeridos"

### **10. Uso del Controlador:**

#### **Para Desarrolladores:**
```php
// El controlador se carga automáticamente con:
// index.php?url=reclamos

// Para operaciones AJAX:
// POST con HTTP_X_REQUESTED_WITH: XMLHttpRequest
// Respuesta: JSON con success, message, data
```

#### **Para Usuarios:**
1. **Navegar**: A la sección de reclamos
2. **Crear**: Usar el formulario o WebSocket
3. **Editar**: Hacer clic en el botón de editar
4. **Eliminar**: Usar el botón de eliminar con confirmación

### **11. Archivos Relacionados:**

#### **Modelo:**
- `app/modelo/reclamosModelo.php` - Lógica de datos

#### **Vista:**
- `app/vista/reclamos.php` - Interfaz de usuario

#### **Componentes:**
- `app/controlador/componentes/sesion.php` - Verificación de sesión
- `app/controlador/componentes/llamado_vistas.php` - Carga de vistas

#### **Servidor:**
- `server.php` - Servidor WebSocket para tiempo real

### **12. Características de Seguridad:**
- ✅ Verificación de sesión obligatoria
- ✅ Validación de datos de entrada
- ✅ Prepared statements en el modelo
- ✅ Sanitización de datos
- ✅ Manejo seguro de errores

¡El controlador de reclamos está completamente implementado y listo para usar!
