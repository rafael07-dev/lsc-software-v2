<?php

require_once '../app/models/Word.php'; // Ajusta la ruta según la ubicación real de Video.php

$wordModel = new Word();
$selectedLetter = null;

if (isset($_GET['letter_id'])) {
    $letterId = $_GET['letter_id'];
    $selectedLetter = $wordModel->getWordByLetterId($letterId);

    //var_dump($selectedLetter);
}

if ($selectedLetter) {
    echo '<h2 class="text-gray-600 font-bold">Palabras que comienzan con la letra:</h2>';
    echo '<ul>';
    foreach ($selectedLetter as $word) {
        echo "<li class='p-2'><a class='word-link text-gray-600 font-bold' data-word-id=" . $word['id'] ." href='#'>" . $word['word'] . "</a></li>";
    }
    echo '</ul>';
} else {
    echo '<p class="text-gray-600 font-bold">No se encontró el palabra para la letra seleccionada.</p>';
}