<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Banalics - Ayuda Alimentaria</title>
	<link rel="shortcut icon" type="image/x-icon" href="app-assets/images/ico/LogoBanalics.png">
	<link rel="shortcut icon" type="image/png" href="app-assets/images/ico/LogoBanalics.png">
	<link rel="stylesheet" href="app-assets/css/pages/landing.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
		integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
</head>

<body>
	<?php include "pages/layouts/navUser.php"; ?>

	<!-- Hero Section -->
	<section class="hero">
		<h1>Bienvenido a Banalics</h1>
		<p>Brindando ayuda alimentaria a quienes más lo necesitan.</p>
		<a href="#donate" class="cta-button">¡Donar Ahora!</a>
	</section>


	<!-- Nosotros -->
	<section class="about-us" data-aos="fade-right" data-aos-duration="1000">
		<div class="container">
			<div class="about-content">
				<h2>Nosotros</h2>
				<h5>¿Qué hacemos?</h5>
				<p>
					Somos un articulador de los esfuerzos de la empresa privada, la academia y organizaciones sin ánimo
					de lucro,
					que trabaja para ayudar a poblaciones en condiciones de vulnerabilidad que sufren de inseguridad
					alimentaria y desnutrición.
					Recibimos donaciones en forma de alimentos y bienes, los clasificamos, almacenamos y distribuimos de
					manera responsable,
					eficiente y equitativa. Gracias a la generosidad de miles de personas nos hemos convertido en uno de
					los referentes más importantes en seguridad alimentaria y la lucha contra el desperdicio del país.
					Promovemos el consumo de alimentos sanos y saludables, entregando mercados balanceados y en óptimas
					condiciones,
					contribuyendo así a la seguridad alimentaria y nutricional de nuestros beneficiados. No solo
					entregamos alimentos,
					sino también esperanza y trabajamos para desarrollar las competencias y habilidades de las
					organizaciones vinculadas,
					encaminados en construir una sociedad más humana, solidaria y equitativa.
				</p>
			</div>

			<!-- Slider de Bootstrap -->
			<div class="slider-container" data-aos="fade-up" data-aos-duration="1000">
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
							<img src="app-assets/images/carousel/Banco1.jpg" class="d-block w-90" alt="Slide 1">
						</div>
						<div class="carousel-item">
							<img src="app-assets/images/carousel/Banco2.jpg" class="d-block w-90" alt="Slide 2">
						</div>
						<div class="carousel-item">
							<img src="app-assets/images/carousel/Banco3.jfif" class="d-block w-90" alt="Slide 3">
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
		</div>
	</section>


	<!-- Contador -->
	<section class="counter-section" data-aos="fade-up">
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

	<!-- --------------------- -->
	<!-- Sección de Donaciones -->
	<!-- --------------------- -->
	<section class="donate" id="donate" data-aos="fade-left" data-aos-duration="1000">
		<h2>Haz la Diferencia</h2>
		<p>Tu contribución puede cambiar vidas. ¡Dona hoy!</p>
		<a href="#contact" class="cta-button">Contacto</a>
	</section>
	<!-- ------------------- -->
	<!-- Final de Donaciones -->
	<!-- ------------------- -->



<!-- --------------------- -->
<!-- Nuestros Donantes -->
<!-- --------------------- -->
<section class="our-donors" data-aos="fade-down" data-aos-duration="1000">
    <div class="container">
        <h2>Nuestros Donantes</h2>
        <p>Gracias a nuestros generosos donantes, podemos hacer la diferencia. ¡Únete a ellos!</p>

        <!-- Lista de Imágenes -->
        <div class="image-list">
            <!-- Imagen 1 -->
            <div class="image-item">
                <img src="https://pngimg.com/uploads/cocacola_logo/cocacola_logo_PNG4.png" alt="Donante 1">
            </div>
            <!-- Imagen 2 -->
            <div class="image-item">
                <img src="	https://seeklogo.com/images/N/nutresa-logo-92DA54AF37-seeklogo.com.png" alt="Donante 2">
            </div>
            <!-- Imagen 3 -->
            <div class="image-item">
                <img src="https://tgp-brands.com/wp-content/uploads/2019/09/logo-bimbo-768x617.jpg" alt="Donante 3">
            </div>
			<div class="image-item">
                <img src="http://1.bp.blogspot.com/_4-qsRN2vXWY/Si0juxgauLI/AAAAAAAAAFA/XI16pQZbPtw/s320/logo%2520nuevo.jpg" alt="Donante 4">
            </div>
			<div class="image-item">
                <img src="https://pluspng.com/img-png/almacenes-exito-logo-png-almacenes-exito-logo-400.jpg" alt="Donante 5">
            </div>
			<div class="image-item">
                <img src="https://th.bing.com/th/id/R.e53cb5f151b15617eaad9eabd5090b2b?rik=vdRkfb8ZAKclnQ&pid=ImgRaw&r=0&sres=1&sresct=1" alt="Donante 6">
            </div>
        </div>
    </div>
</section>
<!-- ----------------------- -->
<!-- Final Nuestros donantes -->
<!-- ----------------------- -->



	<!-- Testimonios -->
	<section class="testimonials">
		<div class="container">
			<h2>Testimonios</h2>
			<div class="slick-container">
				<div class="testimonial-slider">
					<!-- Cada testimonio es un slide -->
					<div class="testimonial-item">
						<img src="https://uploads-ssl.webflow.com/5d39841c4f1ba6511b23d83a/5e81ece85836db3eedc3f6c1_Screenshot%202019-10-16%20at%2016.16.54.png" alt="Persona 1">
						<p>¡Increíble servicio! Banalics ha hecho una diferencia real en la comunidad. Su compromiso con
							la
							ayuda a quienes más lo necesitan es inspirador.</p>
						<p class="author">Laura, Donante</p>
					</div>
				</div>
				<div class="testimonial-slider">
					<div class="testimonial-item">
						<img src="https://th.bing.com/th/id/OIP.VfBLXAWcdPxF0cGiXaZgjAAAAA?rs=1&pid=ImgDetMain" alt="Persona 2">
						<p>Estoy realmente agradecido por el impacto positivo que Banalics ha tenido en mi vida. Su
							enfoque en
							la seguridad alimentaria es crucial.</p>
						<p class="author">Carlos, Beneficiario</p>
					</div>
				</div>
				<div class="testimonial-slider">
					<div class="testimonial-item">
						<img src="https://th.bing.com/th/id/OIF.T4nfgOoruIs4ZTnGq5xTnA?rs=1&pid=ImgDetMain" alt="Persona 3">
						<p>Banalics ha demostrado ser un líder en la lucha contra la desnutrición. Su dedicación es un
							faro de
							esperanza para muchos.</p>
						<p class="author">Ana, Voluntaria</p>
					</div>
				</div>
				<div class="testimonial-slider">
					<div class="testimonial-item">
						<img src="https://www.soap-passion.com/media/cache/thumb_portrait/images/acteurs/acteur_2070_1412847343.jpg" alt="Persona 5">
						<p>Gracias a Banalics, he visto un cambio significativo en mi vida. Su apoyo va más allá de la
							entrega de
							alimentos; ofrecen esperanza.</p>
						<p class="author">Miguel, Beneficiario</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End Testimonios Section -->



	<!-- Sección de Contacto -->
	<section class="contact" id="contact" data-aos="fade-up" data-aos-duration="1000">
        <h2>Contacto</h2>
        <p>¿Tienes preguntas o comentarios? ¡Contáctanos!</p>
        <!-- Formulario de Contacto -->
        <form id="contactForm" action="procesar_contacto.php" method="post">
            <label for="name">Nombre:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="phone">Teléfono:</label>
            <input type="tel" id="phone" name="phone">

            <label for="message">Mensaje:</label>
            <textarea id="message" name="message" required></textarea>

            <button type="submit">Enviar</button>
        </form>
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
		document.addEventListener('DOMContentLoaded', function () {
        AOS.init({
            duration: 1200, // Duración de la animación en milisegundos
        });
    });

	</script>
</body>

</html>