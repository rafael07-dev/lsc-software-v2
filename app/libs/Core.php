<?php

class Core{

    function __construct()
    {
        $this->getUrl();
    }

    public function getUrl() {

        if (isset($_GET['letter'])) {
            return $_GET['letter'];
        }
        return null;    
    }
}