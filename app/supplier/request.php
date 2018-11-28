<?php

class Requests {

    public static function POST($name = null) {
        if (!empty($name)) {
            return isset($_POST[$name]) ? $_POST[$name] : null;
        }
    }
    
    public static function GET($name = null) {
        if (!empty($name)) {
            return isset($_GET[$name]) ? $_GET[$name] : null;
        }
    }

}
