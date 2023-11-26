<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
   
    <title>BANALICS</title>
    <link rel="shortcut icon" type="image/x-icon" href="../app-assets/images/ico/LogoBanalics.png">
    <link rel="shortcut icon" type="image/png" href="../app-assets/images/ico/LogoBanalics.png">
    
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/all.css'>
  <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/fontawesome.css'>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../app-assets/css/Login.css">
    <!-- END ROBUST CSS-->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <style>
      body {
        background-image: url('../app-assets/images/ico/Campo1.jpg');
        background-size: cover;
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
      }
      .container {
	display: flex;
	align-items: center;
	justify-content: center;
	min-height: 100vh;
}

.screen {		
	background: linear-gradient(90deg, #de0051, #0062a9);		
	position: relative;	
	height: 600px;
	width: 360px;	
	box-shadow: 0px 0px 24px #5C5696;
}


.screen__content {
	z-index: 1;
	position: relative;	
	height: 100%;
}

.screen__background {		
	position: absolute;
	top: 0;
	left: 0;
	right: 0;
	bottom: 0;
	z-index: 0;
	-webkit-clip-path: inset(0 0 0 0);
	clip-path: inset(0 0 0 0);	
}

.screen__background__shape {
	transform: rotate(45deg);
	position: absolute;
}

.screen__background__shape1 {
	height: 520px;
	width: 520px;
	background: #f2f2f2;	
	top: -40px;
	right: 120px;	
	border-radius: 0 72px 0 0;
}

.screen__background__shape2 {
	height: 220px;
	width: 220px;
	background: #0062a9;	
	top: -172px;
	right: 0;	
	border-radius: 32px;
}

.screen__background__shape3 {
	height: 540px;
	width: 190px;
	background: linear-gradient(270deg,#004c95, #0062a9,#0079bd, #c80041, #de0051, #f30061);
	top: -24px;
	right: 0;	
	border-radius: 32px;
}

.screen__background__shape4 {
	height: 400px;
	width: 200px;
	background: linear-gradient(290deg,#004c95, ,#0079bd, #c80041);
	top: 420px;
	right: 50px;	
	border-radius: 60px;
}

.login {
	width: 320px;
	padding: 30px;
	padding-top: 50px;
}

.login__field {
	padding: 20px 0px;	
	position: relative;	
}

.login__icon {
	position: absolute;
	top: 30px;
	color:  #0062a9;
}

.login__input {
	border: none;
	border-bottom: 2px solid #D1D1D4;
	background: none;
	padding: 5px;
	padding-left: 24px;
	font-weight: 700;
	width: 80%;
	transition: .2s;
}

.login__input:active,
.login__input:focus,
.login__input:hover {
	outline: none;
	border-bottom-color: #6A679E;
}

.login__submit {
	background: #fff;
	font-size: 14px;
	margin-top: 30px;
	padding: 16px 20px;
	border-radius: 26px;
	border: 1px solid #D4D3E8;
	text-transform: uppercase;
	font-weight: 700;
	display: flex;
	align-items: center;
	width: 100%;
	color: #0062a9;
	box-shadow: 0px 2px 2px #5C5696;
	cursor: pointer;
	transition: .2s;
}

.login__submit:active,
.login__submit:focus,
.login__submit:hover {
	border-color: #6A679E;
	outline: none;
}

.button__icon {
	font-size: 24px;
	margin-left: auto;
	color: #7875B5;
}

.social-login {	
	position: absolute;
	height: 140px;
	width: 160px;
	text-align: center;
	bottom: 0px;
	right: 0px;
	color:white;
}

.social-icons {
	display: flex;
	align-items: center;
	justify-content: center;
}

.social-login__icon {
	padding: 20px 10px;
	color:#fff;
	text-decoration: none;	
	text-shadow: 0px 0px 8px #7875B5;
}

.social-login__icon:hover {
	transform: scale(1.5);	
  
}
.img img{
  width: 150px;
  margin-top: 10px;
}
.registrar{
  position: absolute;
	
	width: 100px;
	text-align: left;
	bottom: 150px;
	left: 25px;
  z-index: 2;
	
}

    </style>
  </head>
  <body>
  <div class="container">
	<div class="screen">
		<div class="screen__content">
    <div class="img">
    <img src="../app-assets/images/ico/LogoBanalics.png" alt="" >
  </div>
  <form class="login" method="post" action="../procesar_formulario.php" onsubmit="return validarFormulario()">
        <div class="login__field">
            <i class="login__icon fas fa-user"></i>
            <input type="text" class="login__input" placeholder="Email" name="Email" id="Email">
        </div>
        <div class="login__field">
            <i class="login__icon fas fa-lock"></i>
            <input type="password" class="login__input" placeholder="Contraseña" name="Contraseña" id="Contraseña">
        </div>
        <button class="button login__submit" type="submit">
            <span class="button__text">Iniciar Sesión</span>
            <i class="button__icon fas fa-chevron-right"></i>
        </button>
    </form>
</form>
			<div class="social-login">
				<h3>Inicia sesión con:</h3>
				<div class="social-icons">
					<a href="#" class="social-login__icon fab fa-instagram"></a>
					<a href="#" class="social-login__icon fab fa-facebook"></a>
					<a href="#" class="social-login__icon fab fa-twitter"></a>
				</div>
			</div>
		</div>
    <div class="registrar">¿No tienes una cuenta ? <a href="#">¡Registrate!</a></div>
		<div class="screen__background">
			<span class="screen__background__shape screen__background__shape4"></span>
			<span class="screen__background__shape screen__background__shape3"></span>		
			<span class="screen__background__shape screen__background__shape2"></span>
			<span class="screen__background__shape screen__background__shape1"></span>
		</div>		
	</div>
</div>
<script>
  function validarFormulario() {
    var email = document.getElementById("Email").value;
    var contrasena = document.getElementById("Contraseña").value;

    if (email.trim() === '' || contrasena.trim() === '') {
        Swal.fire({
            icon: 'error',
            title: 'Campos Vacíos',
            text: 'Por favor, complete todos los campos.',
        });
        return false;
    }

    // Verificar si el campo de correo contiene un "@".
    if (email.indexOf('@') === -1) {
        Swal.fire({
            icon: 'error',
            title: 'Correo Inválido',
            text: 'El campo de correo debe contener un \'@\'.',
        });
        return false;
    }

    // Verificar si la contraseña tiene al menos 5 caracteres.
    if (contrasena.length < 5) {
        Swal.fire({
            icon: 'error',
            title: 'Contraseña Corta',
            text: 'La contraseña debe tener al menos 5 caracteres.',
        });
        return false;
    }

    return true;
}

</script>

  </body>
</html>
