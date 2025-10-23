# Instrucciones para WebSocket en Sistema de Reclamos

## ✅ Implementación Completada

### **Características Implementadas:**

#### **1. WebSocket en Tiempo Real:**
- **Conexión Automática**: Se conecta automáticamente al servidor WebSocket al cargar la página
- **Reconexión Automática**: Si se pierde la conexión, intenta reconectar cada 3 segundos
- **Indicador de Estado**: Muestra el estado de conexión (Conectado/Desconectado/Error)

#### **2. Empleado Predefinido por Sesión:**
- **Datos de Sesión**: El empleado se obtiene automáticamente de `$_SESSION["usuario"]`
- **Información Visible**: Muestra nombre y cédula del empleado en la interfaz
- **Formulario Simplificado**: No necesita seleccionar empleado, ya está predefinido

#### **3. Funcionalidades WebSocket:**

**Envío de Reclamos:**
- Los reclamos se envían via WebSocket en tiempo real
- Se guardan directamente en la base de datos
- Notificación inmediata a todos los usuarios conectados

**Notificaciones en Tiempo Real:**
- Alertas automáticas cuando llegan nuevos reclamos
- Contador de reclamos no leídos
- Notificaciones visuales con Bootstrap alerts

**Gestión de Conexión:**
- Estado de conexión visible en la interfaz
- Manejo de errores y reconexión automática
- Cierre limpio al salir de la página

### **4. Cómo Usar:**

#### **Para el Usuario:**
1. **Acceder a la Vista**: Navegar a la página de reclamos
2. **Verificar Conexión**: El indicador debe mostrar "Conectado" (verde)
3. **Crear Reclamo**: Hacer clic en "Registrar Reclamo"
4. **Completar Formulario**:
   - Seleccionar activo del dropdown
   - El empleado ya aparece predefinido
   - Escribir descripción del reclamo
   - La fecha se establece automáticamente
5. **Enviar**: Hacer clic en "ENVIAR RECLAMO"

#### **Para el Administrador:**
1. **Iniciar Servidor WebSocket**: Ejecutar `php server.php` en la terminal
2. **Verificar Puerto**: El servidor debe estar en puerto 8080
3. **Monitorear Conexiones**: Ver logs en la consola del servidor

### **5. Archivos Modificados:**

#### **app/vista/reclamos.php:**
- ✅ WebSocket JavaScript implementado
- ✅ Empleado predefinido por sesión
- ✅ Formulario con envío via WebSocket
- ✅ Notificaciones en tiempo real
- ✅ Indicador de estado de conexión

#### **server.php:**
- ✅ Manejo de mensaje "new_reclamo"
- ✅ Inserción en base de datos con id_activo
- ✅ Broadcast de notificaciones

### **6. Estructura de Datos WebSocket:**

#### **Envío de Reclamo:**
```javascript
{
  type: "new_reclamo",
  cedula_empleado: "cedula_del_empleado",
  id_activo: "id_del_activo",
  descripcion: "descripcion_del_reclamo",
  fecha_reclamo: "2025-01-XX"
}
```

#### **Respuesta del Servidor:**
```javascript
{
  type: "notification",
  notifications: [...], // Array de reclamos
  unread_count: 5 // Contador de no leídos
}
```

### **7. Requisitos del Sistema:**

#### **Servidor:**
- PHP 7.4+ con extensiones PDO y WebSocket
- Composer con dependencias Ratchet
- Base de datos MySQL/MariaDB

#### **Cliente:**
- Navegador moderno con soporte WebSocket
- JavaScript habilitado
- Conexión a internet estable

### **8. Solución de Problemas:**

#### **Si no se conecta:**
1. Verificar que el servidor WebSocket esté ejecutándose
2. Comprobar que el puerto 8080 esté disponible
3. Revisar la consola del navegador para errores

#### **Si no se envían reclamos:**
1. Verificar que todos los campos estén completos
2. Comprobar la conexión WebSocket
3. Revisar los logs del servidor

#### **Si no llegan notificaciones:**
1. Verificar que otros usuarios estén conectados
2. Comprobar la configuración de la base de datos
3. Revisar los permisos de la tabla `reclamo_activo`

### **9. Comandos para Ejecutar:**

```bash
# Iniciar servidor WebSocket
php server.php

# El servidor mostrará:
# WebSocket server started on port 8080
# New connection! - (ID_CONEXION)
```

### **10. Características de Seguridad:**
- ✅ Validación de datos en cliente y servidor
- ✅ Prepared statements para prevenir SQL injection
- ✅ Validación de sesión de usuario
- ✅ Manejo seguro de errores

¡El sistema de reclamos con WebSocket está completamente implementado y listo para usar!
