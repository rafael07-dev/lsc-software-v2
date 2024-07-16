<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>LSC Software</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Estilos adicionales específicos que no están en Tailwind pueden agregarse aquí */
    </style>
    <style>
        /* Animación de scroll suave */
        html {
            scroll-behavior: smooth;
        }
    </style>
    <script src="https://unpkg.com/scrollreveal"></script>

</head>

<body class="bg-gray-100">

    <?php require_once(__DIR__ . "/templates/header.php"); ?>

    <main class="container mx-auto py-12">

        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold">Bienvenido a LSC Software</h1>
            <p class="text-lg">¡Aquí encontrarás contenido interesante y útil!</p>
        </div>

        <section id="como-funciona" class="mb-12">
            <h2 class="text-2xl font-bold mb-4">¿Cómo Funciona?</h2>
            <p class="mb-4">Nuestro traductor de lenguaje de señas utiliza tecnología avanzada para convertir gestos y
                señas en palabras y viceversa. Para usar nuestra plataforma, simplemente sigue estos pasos:</p>
            <ol class="list-decimal list-inside mb-4">
                <li>Regístrate en nuestro sitio web.</li>
                <li>Selecciona el idioma de señas que prefieres.</li>
                <li>Utiliza la cámara de tu dispositivo para realizar las señas, o escribe el mensaje que deseas
                    traducir.</li>
                <li>Nuestro sistema traducirá el mensaje y lo mostrará en tiempo real.</li>
            </ol>
        </section>

        <section id="nuestra-mision" class="mb-12">
            <h2 class="text-2xl font-bold mb-4">Nuestra Misión</h2>
            <p class="mb-4">Estamos comprometidos a empoderar a la comunidad sorda y promover la inclusión en la
                sociedad.
                Creemos que la comunicación es un derecho fundamental, y trabajamos arduamente para hacerla accesible a
                todos.
                Nuestra plataforma es una herramienta para romper las barreras de comunicación y construir puentes
                entre
                personas sordas y oyentes.</p>
        </section>

        <section id="nuestro-equipo" class="mb-12">
            <h2 class="text-2xl font-bold mb-4">Nuestro Equipo</h2>
            <p class="mb-4">El equipo de LSC Software está formado por expertos en tecnología y lenguaje de señas,
                comprometidos
                con crear soluciones innovadoras para mejorar la comunicación entre personas sordas y oyentes.</p>
        </section>

        <section id="contacto" class="mb-12">
            <h2 class="text-2xl font-bold mb-4">Contacto</h2>
            <p class="mb-4">Para más información o consultas, no dudes en contactarnos.</p>
            <div class="flex justify-center">
                <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white px-6 py-3 rounded-full transition duration-300 ease-in-out">Contáctanos</a>
            </div>
        </section>

    </main>

    <script>
        // Animación de scroll suave para todos los enlaces internos
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();

                const target = document.querySelector(this.getAttribute('href'));
                target.scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Inicializar ScrollReveal
        ScrollReveal().reveal('.mb-12', {
            delay: 200,
            distance: '50px',
            easing: 'ease-in-out',
            interval: 200
        });
    </script>

</body>

</html>