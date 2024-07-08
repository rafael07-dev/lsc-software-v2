<?php 

class Utils{
    public static function getUrl(){
        if(isset($_GET['letter'])){
            return $_GET['letter'];
        }
        return;
    }
}