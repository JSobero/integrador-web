<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Iniciar sesión con DNI</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Font Awesome + Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

  <!-- html5-qrcode -->
  <script src="https://unpkg.com/html5-qrcode"></script>

  <style>
    * {
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      margin: 0;
      padding: 0;
      background: linear-gradient(135deg, #2c3e50, #34495e, #5e6e8b);
      background-size: 400% 400%;
      animation: gradientAnimation 15s ease infinite;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    @keyframes gradientAnimation {
      0% {background-position: 0% 50%;}
      50% {background-position: 100% 50%;}
      100% {background-position: 0% 50%;}
    }

    .login-container {
      background-color: #ffffff;
      padding: 40px 30px;
      border-radius: 16px;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
      width: 100%;
      max-width: 400px;
      text-align: center;
      margin: 15px;
    }

    .login-container h2 {
      margin-bottom: 20px;
      color: #2c3e50;
      font-size: 24px;
    }

    .input-group {
      position: relative;
      margin-bottom: 20px;
    }

    .input-group i {
      position: absolute;
      top: 50%;
      left: 12px;
      transform: translateY(-50%);
      color: #7b8db0;
      font-size: 16px;
    }

    .input-group input {
      width: 100%;
      padding: 12px 12px 12px 40px;
      border: 1px solid #ccd6f6;
      border-radius: 8px;
      font-size: 16px;
      background-color: #eef2ff;
      color: #2c3e50;
      transition: border-color 0.3s, box-shadow 0.3s;
    }

    .input-group input:focus {
      border-color: #a5b4fc;
      box-shadow: 0 0 0 3px rgba(165, 180, 252, 0.3);
      outline: none;
    }

    label {
      display: block;
      margin-bottom: 8px;
      font-weight: 600;
      color: #34495e;
      text-align: left;
    }

    button {
      background-color: #6c5ce7;
      color: #fff;
      padding: 12px 20px;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s;
      width: 100%;
    }

    button:hover {
      background-color: #5a4db0;
    }

    .footer-icon {
      margin-top: 15px;
      color: #6c5ce7;
      font-size: 20px;
    }

    #reader {
      width: 100%;
      margin-top: 10px;
      margin-bottom: 20px;
    }

    #toggleScanner {
      margin-bottom: 10px;
      background-color: #2c3e50;
      color: white;
    }

    @media (max-width: 500px) {
      #reader {
        width: 100%;
      }
    }
  </style>
</head>
<body>
  <div class="login-container">
    <h2><i class="bi bi-person-circle"></i> Inicio de Sesión</h2>

    <form action="home/prueba.php" method="POST" id="login-form">
      <label for="dni">Ingrese su DNI:</label>
      <div class="input-group">
        <i class="bi bi-person-vcard"></i>
        <input type="text" name="dni" id="dni" required pattern="\d{8}" title="Ingrese un DNI válido de 8 dígitos">
      </div>

      <button type="button" id="toggleScanner"><i class="bi bi-camera-video"></i> Escanear con cámara</button>

      <div id="reader" style="display: none;"></div>

      <button type="submit"><i class="fas fa-sign-in-alt"></i> Entrar</button>
    </form>

    <div class="footer-icon">
      <i class="bi bi-shield-check" title="Conexión segura"> Conexión segura</i>
    </div>
  </div>

  <script>
    let scannerVisible = false;
    let html5QrCode;

    document.getElementById('toggleScanner').addEventListener('click', () => {
      const reader = document.getElementById('reader');

      if (!scannerVisible) {
        reader.style.display = "block";
        html5QrCode = new Html5Qrcode("reader");
        html5QrCode.start(
          { facingMode: "environment" },
          {
            fps: 10,
            qrbox: { width: 250, height: 100 }
          },
          (decodedText) => {
            document.getElementById("dni").value = decodedText;
            html5QrCode.stop();
            reader.style.display = "none";
            scannerVisible = false;
            document.getElementById("login-form").submit();
          },
          (errorMessage) => {
            // No mostramos errores por cada intento fallido
          }
        );
        scannerVisible = true;
      } else {
        html5QrCode.stop();
        reader.style.display = "none";
        scannerVisible = false;
      }
    });
  </script>
</body>
</html>
