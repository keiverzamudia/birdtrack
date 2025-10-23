<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Administrador - Birdtrack</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="Assets/css/sb-admin-2.min.css">
    <style>
        .profile-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .profile-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            border-radius: 10px;
            margin-bottom: 30px;
            text-align: center;
        }
        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 5px solid white;
            margin: 0 auto 20px;
            display: block;
            object-fit: cover;
        }
        .profile-name {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .profile-role {
            font-size: 1.1rem;
            opacity: 0.9;
        }
        .tab-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .tab-nav {
            display: flex;
            background: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
        }
        .tab-button {
            flex: 1;
            padding: 15px 20px;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 1rem;
            color: #6c757d;
            transition: all 0.3s;
        }
        .tab-button.active {
            background: white;
            color: #007bff;
            border-bottom: 3px solid #007bff;
        }
        .tab-button:hover {
            background: #e9ecef;
        }
        .tab-content {
            padding: 30px;
            display: none;
        }
        .tab-content.active {
            display: block;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
            color: #495057;
        }
        .form-control {
            width: 100%;
            padding: 12px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }
        .form-control:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
        }
        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }
        .btn-primary {
            background: #007bff;
            color: white;
        }
        .btn-primary:hover {
            background: #0056b3;
        }
        .btn-danger {
            background: #dc3545;
            color: white;
        }
        .btn-danger:hover {
            background: #c82333;
        }
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .alert-danger {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .info-card {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid #007bff;
        }
        .info-card h4 {
            margin: 0 0 10px 0;
            color: #495057;
        }
        .info-card p {
            margin: 5px 0;
            color: #6c757d;
        }
        .logout-section {
            text-align: center;
            padding: 20px;
            border-top: 1px solid #dee2e6;
            background: #f8f9fa;
        }
    </style>
</head>
<body>
<?php
require_once 'componentes/head.php';
require_once 'componentes/menu.php';
?>

<div class="profile-container">
    <!-- Header del Perfil -->
    <div class="profile-header">
        <img src="Assets/img/perfiles/<?php echo $datos_usuario['perfil'] ?? 'default.jpg'; ?>" 
             alt="Foto de Perfil" class="profile-avatar">
        <div class="profile-name"><?php echo $datos_usuario['nombre'] . ' ' . $datos_usuario['apellidos']; ?></div>
        <div class="profile-role"><?php echo strtoupper($datos_usuario['rol']); ?></div>
    </div>

    <!-- Mensajes -->
    <?php if ($mensaje): ?>
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> <?php echo $mensaje; ?>
        </div>
    <?php endif; ?>

    <?php if ($error): ?>
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-triangle"></i> <?php echo $error; ?>
        </div>
    <?php endif; ?>

    <!-- Contenedor de Pestañas -->
    <div class="tab-container">
        <div class="tab-nav">
            <button class="tab-button active" onclick="showTab('info')">
                <i class="fas fa-user"></i> Información Personal
            </button>
            <button class="tab-button" onclick="showTab('security')">
                <i class="fas fa-lock"></i> Seguridad
            </button>
        </div>

        <!-- Pestaña de Información Personal -->
        <div id="info" class="tab-content active">
            <h3><i class="fas fa-user-edit"></i> Editar Información Personal</h3>
            
            <form method="POST">
                <div class="info-grid">
                    <div class="form-group">
                        <label class="form-label" for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" 
                               value="<?php echo htmlspecialchars($datos_usuario['nombre']); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="apellidos">Apellidos</label>
                        <input type="text" class="form-control" id="apellidos" name="apellidos" 
                               value="<?php echo htmlspecialchars($datos_usuario['apellidos']); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="cedula">Cédula</label>
                        <input type="text" class="form-control" id="cedula" name="cedula" 
                               value="<?php echo htmlspecialchars($datos_usuario['cedula']); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="telefono">Teléfono</label>
                        <input type="tel" class="form-control" id="telefono" name="telefono" 
                               value="<?php echo htmlspecialchars($datos_usuario['telefono']); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="correo">Correo Electrónico</label>
                        <input type="email" class="form-control" id="correo" name="correo" 
                               value="<?php echo htmlspecialchars($datos_usuario['correo']); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="rol">Rol</label>
                        <input type="text" class="form-control" id="rol" name="rol" 
                               value="<?php echo htmlspecialchars($datos_usuario['rol']); ?>" readonly>
                    </div>
                </div>
                
                <button type="submit" name="actualizar_perfil" class="btn btn-primary">
                    <i class="fas fa-save"></i> Actualizar Perfil
                </button>
            </form>
        </div>

        <!-- Pestaña de Seguridad -->
        <div id="security" class="tab-content">
            <h3><i class="fas fa-key"></i> Cambiar Contraseña</h3>
            
            <form method="POST">
                <div class="info-grid">
                    <div class="form-group">
                        <label class="form-label" for="nueva_clave">Nueva Contraseña</label>
                        <input type="password" class="form-control" id="nueva_clave" name="nueva_clave" required>
                        <small class="text-muted">Mínimo 8 caracteres, incluyendo mayúsculas, minúsculas, números y símbolos</small>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="confirmar_clave">Confirmar Contraseña</label>
                        <input type="password" class="form-control" id="confirmar_clave" name="confirmar_clave" required>
                    </div>
                </div>
                
                <button type="submit" name="cambiar_clave" class="btn btn-primary">
                    <i class="fas fa-key"></i> Cambiar Contraseña
                </button>
            </form>
        </div>
    </div>

    <!-- Información del Sistema -->
    <div class="info-grid">
        <div class="info-card">
            <h4><i class="fas fa-info-circle"></i> Información del Sistema</h4>
            <p><strong>ID de Usuario:</strong> <?php echo $datos_usuario['id_usuario']; ?></p>
            <p><strong>Estado:</strong> <?php echo $datos_usuario['status'] ? 'Activo' : 'Inactivo'; ?></p>
            <p><strong>Último Acceso:</strong> <?php echo date("d/m/Y H:i:s"); ?></p>
        </div>
        
        <div class="info-card">
            <h4><i class="fas fa-shield-alt"></i> Seguridad</h4>
            <p><strong>Rol:</strong> <?php echo strtoupper($datos_usuario['rol']); ?></p>
            <p><strong>Tipo de Usuario:</strong> <?php echo $datos_usuario['id_tipo_usuario'] ?? 'No definido'; ?></p>
            <p><strong>Sesión Activa:</strong> Sí</p>
        </div>
    </div>

    <!-- Sección de Logout -->
    <div class="logout-section">
        <form method="POST" style="display: inline;">
            <button type="submit" name="logout" class="btn btn-danger">
                <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
            </button>
        </form>
    </div>
</div>

<script>
function showTab(tabName) {
    // Ocultar todas las pestañas
    const tabs = document.querySelectorAll('.tab-content');
    tabs.forEach(tab => tab.classList.remove('active'));
    
    // Remover clase active de todos los botones
    const buttons = document.querySelectorAll('.tab-button');
    buttons.forEach(button => button.classList.remove('active'));
    
    // Mostrar la pestaña seleccionada
    document.getElementById(tabName).classList.add('active');
    
    // Activar el botón correspondiente
    event.target.classList.add('active');
}
</script>

</body>
</html>