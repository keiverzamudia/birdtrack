  <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="src/login.css">
  <link rel="stylesheet" href="Assets/css/estilos.css">
  <title>Ingreso de Birdtrack</title>
</head>
<body>
    <form method="POST" id="formulario" action="?url=login">
      <div class="logo-container">
        <img class="rounded-circle" src="Assets/img/cardenales.png" alt="...">
      </div>

      <div class="input-group">
        <label for="usuario" class="form-label">Correo</label>
        <input type="email" class="form-control" id="usuario" name="usuario" 
               placeholder="Ingresa tu correo electrónico" required />
        <i class="fas fa-envelope"></i>
        <span class="advUsuario"></span>
      </div>

      <div class="input-group">
        <label for="clave" class="form-label">Contraseña</label>
        <input type="password" class="form-control" id="clave" name="clave" 
               placeholder="Ingresa tu Contraseña" required />
        <i class="fas fa-id-card"></i>
        <span class="advContrasena"></span>
      </div>

      <div class="server-error">
        <span style="color:red;"><?php if(isset($errorBackebd)) echo $errorBackebd; ?></span>
      </div>

      <div class="forgot-password">
        <a href="#">¿Olvidaste tu contraseña?</a>
      </div>
      
      <div class="d-grid mb-2"></div>
        <button type="submit" class="btn btn-login" name="login">
          <i class="fas fa-sign-in-alt"></i>
          Ingresar
        </button>
      </div>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  
</body>
</html>
