<?php
require 'bootstarp/config.php';
require 'bootstarp/app.php';

$class = 'Controller';
spl_autoload_register(function($class){
    require LIBS . $class .".php";
});

require 'app/supplier/http.php';
require 'app/supplier/request.php';
// Load the Bootstrap!
$bootstrap = new App();
$bootstrap->load();