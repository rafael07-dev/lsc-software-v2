<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplicación para Sordos</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>

<body>
    <main class="main container">
        <div class="wrapper-letter">
            <div class="sidebar">
                <?php if (!empty($data['letters'])) : ?>
                    <ul>
                        <?php foreach ($data['letters'] as $letter) : ?>
                            <li><a href="index.php?page=diccionario&letter=<?= $letter['letter'] ?>"><?php echo $letter['letter'] ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                <?php else : ?>
                    <p>No hay letras disponibles.</p>
                <?php endif; ?>
            </div>
        </div>

        <div class="wrapper-word">

            <div class="content">

                <?php if (!empty($data['selectedLetter'])) : ?>
                    <h2>Palabras que comienzan con la letra <?php echo $data['selectedLetter']; ?>:</h2>
                <?php endif; ?>

                <?php if (!empty($data['words'])) : ?>
                    <ul>
                        <?php foreach ($data['words'] as $word) : ?>
                            <li><a href="#" class="word-link" data-word-id="<?= $word['id'] ?>"><?= $word['word'] ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                <?php else : ?>
                    <p>No hay palabras disponibles para la letra seleccionada.</p>
                <?php endif; ?>
            </div>
        </div>

        <div class="wrapper-gifs" id="video-panel">
            <!-- Este contenedor se actualizará dinámicamente con el video -->
            <?php if (!empty($data['videoUrl'])) : ?>
                <h2>Vídeo para la palabra seleccionada:</h2>
                <video width="320" height="240" controls autoplay loop>
                    <source src="<?= $data['videoUrl'] ?>" type="video/mp4">
                    Tu navegador no soporta la etiqueta de vídeo.
                </video>
            <?php else : ?>
                <p>Seleccione una palabra para ver su vídeo asociado.</p>
            <?php endif; ?>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const wordLinks = document.querySelectorAll('.word-link');

            wordLinks.forEach(link => {
                link.addEventListener('click', function(event) {
                    event.preventDefault();
                    const wordId = this.getAttribute('data-word-id');

                    fetch(`ajax/getVideo.php?word_id=${wordId}`)
                        .then(response => response.text())
                        .then(html => {
                            const videoPanel = document.getElementById('video-panel');
                            if (videoPanel) {
                                videoPanel.innerHTML = html;
                            } else {
                                console.error('Elemento video-panel no encontrado');
                            }
                        })
                        .catch(error => console.error('Error al cargar el vídeo:', error));
                });
            });
        });
    </script>
</body>

</html>