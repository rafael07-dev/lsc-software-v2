<?php

require_once './app/models/Letter.php';
require_once './app/models/Word.php';
require_once './app/models/Video.php';

class DiccionarioController {

    protected $letterModel;
    protected $wordModel;
    protected $videoModel;

    public function __construct() {
        $this->letterModel = new Letter();
        $this->wordModel = new Word();
        $this->videoModel = new Video();
    }

    public function index() {
        $letters = $this->letterModel->getLetters();
        $selectedLetter = $this->getSelectedLetter();
        $selectedWordId = $this->getSelectedWordId();
        $words = [];
        $videoUrl = null;

        if (!empty($selectedLetter)) {
            $words = $this->wordModel->getWordsByLetter($selectedLetter);
        }

        if (!empty($selectedWordId)) {
            $videoUrl = $this->videoModel->getVideoByWordId($selectedWordId);
        }

        $this->render('diccionario', compact('letters', 'selectedLetter', 'words', 'selectedWordId', 'videoUrl'));
    }

    protected function getSelectedLetter() {
        return isset($_GET['letter']) ? $_GET['letter'] : '';
    }

    protected function getSelectedWordId() {
        return isset($_GET['word_id']) ? $_GET['word_id'] : '';
    }

    protected function render($view, $data = []) {
        require './app/views/templates/header.php';
        require "./app/views/$view.php";
        require './app/views/templates/footer.php';
    }
}
