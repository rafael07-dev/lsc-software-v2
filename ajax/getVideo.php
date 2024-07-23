<?php

require_once '../app/models/Video.php'; // Ajusta la ruta según la ubicación real de Video.php

$videoModel = new Video();
$videoUrl = null;

if (isset($_GET['word_id'])) {
    $wordId = $_GET['word_id'];
    $videoUrl = $videoModel->getVideoByWordId($wordId);
}

if ($videoUrl) {
    echo '<h2 class="text-gray-600 font-bold">Vídeo para la palabra seleccionada:</h2>';
    echo '<video width="320" height="240" controls autoplay loop>';
    echo '<source src="' . $videoUrl . '" type="video/mp4">';
    echo 'Tu navegador no soporta la etiqueta de vídeo.';
    echo '</video>';
} else {
    echo '<p class="text-gray-600 font-bold">No se encontró el vídeo para la palabra seleccionada.</p>';
}
