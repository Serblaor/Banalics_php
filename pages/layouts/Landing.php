<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banalics - Ayuda Alimentaria</title>
    <link rel="shortcut icon" type="image/x-icon" href="../../app-assets/images/ico/LogoBanalics.png">
    <link rel="shortcut icon" type="image/png" href="../../app-assets/images/ico/LogoBanalics.png">
    <link rel="stylesheet" href="../../app-assets/css/pages/landing.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
 <link
     rel="stylesheet"
     href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
     integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/"
     crossorigin="anonymous" />
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <img src="../../app-assets/images/ico/LogoBanalics.png" alt="Logo" class="logo-nav" width="100">
        </a>
        <button class="navbar-toggler" type="button" aria-label="Toggle navigation" id="btn-menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-menu">
            <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="Landing.php"><i class="fas fa-home"></i>Inicio</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fas fa-users"></i>Nosotros</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fas fa-calendar-alt"></i>Eventos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fas fa-handshake"></i>Vinculate</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fas fa-handshake"></i>Alianzas</a>
            </li>
            <li class="nav-item" runat="server" id="liLogin">
                <a class="nav-link" href="../../index.php"><i class="fas fa-sign-in-alt"></i>Login/Registro</a>
            </li>
            <li class="nav-item" runat="server" id="liProductos">
                <a class="nav-link" href="Productos.aspx"><i class="fas fa-store"></i>Productos</a>
            </li>
        </ul>
        </div>
    </div>
</nav>

    <!-- Hero Section -->
    <section class="hero">
        <h1>Bienvenido a Banalics</h1>
        <p>Brindando ayuda alimentaria a quienes más lo necesitan.</p>
        <a href="#donate" class="cta-button">¡Donar Ahora!</a>
    </section>

    <!-- Slider de Bootstrap -->
    <div class="slider-container">
        <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
            <!-- Indicadores -->
            <ol class="carousel-indicators">
                <li data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"></li>
                <li data-bs-target="#carouselExampleDark" data-bs-slide-to="1"></li>
                <li data-bs-target="#carouselExampleDark" data-bs-slide-to="2"></li>
                <li data-bs-target="#carouselExampleDark" data-bs-slide-to="3"></li>
            </ol>

            <!-- Bootstrap Carousel -->
            <div id="features" class="carousel-inner">
                <div class="carousel-item active">
                    <img src="../../app-assets/images/carousel/Banco1.jpg" class="d-block w-90" alt="Slide 1">
                </div>
                <div class="carousel-item">
                    <img src="../../app-assets/images/carousel/Banco2.jpg" class="d-block w-90" alt="Slide 2">
                </div>
                <div class="carousel-item">
                    <img src="../../app-assets/images/carousel/Banco3.jfif" class="d-block w-90" alt="Slide 3">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleDark" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleDark" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

    <!-- Contador -->
    <section class="counter-section">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="counter">
                        <i class="fas fa-users"></i>
                        <h2><span id="counter1">0</span>+</h2>
                        <p>Personas Alcanzadas</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="counter">
                        <i class="fas fa-hands-helping"></i>
                        <h2><span id="counter2">0</span>+</h2>
                        <p>Personas Ayudadas</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="counter">
                        <i class="fas fa-smile"></i>
                        <h2><span id="counter3">0</span>+</h2>
                        <p>Personas Satisfechas</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="counter">
                        <i class="fas fa-heart"></i>
                        <h2><span id="counter4">0</span>+</h2>
                        <p>Personas Inspiradas</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección de Donaciones -->
    <section class="donate" id="donate">
        <h2>Haz la Diferencia</h2>
        <p>Tu contribución puede cambiar vidas. ¡Dona hoy!</p>
        <a href="#contact" class="cta-button">Contacto</a>
    </section>

    <!-- Sección de Contacto -->
    <section class="contact" id="contact">
        <h2>Contacto</h2>
        <p>¿Tienes preguntas o comentarios? ¡Contáctanos!</p>
        <!-- Agrega un formulario de contacto aquí -->
    </section>

    <!-- Footer -->
    <footer>
    <div class="col-md-12">
     <h5 class="text-uppercase text-light">Síguenos en redes sociales</h5>
     <ul class="list-inline social-icons mt-3">
         <li class="list-inline-item">
             <a href="#" target="_blank"><i class="fab fa-facebook-f" style="color: aliceblue;"></i></a>
         </li>
         <li class="list-inline-item">
             <a href="#" target="_blank"><i class="fab fa-twitter" style="color: aliceblue;"></i></a>
         </li>
         <li class="list-inline-item">
             <a href="#" target="_blank"><i class="fab fa-instagram" style="color: aliceblue;"></i></a>
         </li>
         <li class="list-inline-item">
             <a href="#" target="_blank"><i class="fab fa-linkedin-in" style="color: aliceblue;"></i></a>
         </li>
     </ul>
 </div>
        <p>&copy; 2023 Banalics - Ayuda Alimentaria</p>
    </footer>

    <script>
        // Función para animar los contadores
        function animateCounter(elementId, targetValue, duration) {
            let current = 0;
            const element = document.getElementById(elementId);
            const step = Math.ceil(targetValue / duration);

            const timer = setInterval(() => {
                current += step;
                element.textContent = current;

                if (current >= targetValue) {
                    clearInterval(timer);
                    element.textContent = targetValue;
                }
            }, 10);
        }

        // Llamadas a la función animateCounter con los valores deseados
        animateCounter('counter1', 1500, 2000); // Personas Alcanzadas
        animateCounter('counter2', 1000, 2500); // Personas Ayudadas
        animateCounter('counter3', 800, 3000); // Personas Satisfechas
        animateCounter('counter4', 1200, 2200); // Personas Inspiradas

        const btnMenu = document.getElementById('btn-menu');
        const navbarMenu = document.querySelector('.navbar-menu');

        btnMenu.addEventListener('click', () => {
            if (navbarMenu) {
                navbarMenu.classList.toggle('show-menu');
            }
        });


    </script>
  

</body>

</html>
