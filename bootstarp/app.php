<?php

class App {
    
    private $_loadControllerPath = 'controllers/';
    private $_loadDefaultPagePath = 'index.php';
    private $_loadDefaultModelPath = 'models/';
    private $_initiateController = null;
    
    public $_url;

    function __construct(){
        $http = new Http();
        $this->_url = $http->url();
    }
    
    function load() {
        if (empty($this->_url[0]) || $this->_url[0] == "index") {
            $this->_loadDefaultController();
            $this->_loadControllerMethod(); return;
        }else{
            $this->_loadController();
            $this->_loadControllerMethod();return;
        }
    }
    
    private function _loadDefaultController(){
        require $this->_loadControllerPath . $this->_loadDefaultPagePath;
        $this->_initiateController = new Index();
        $this->_initiateController->_loadDefaultModel('index', $this->_loadDefaultModelPath);
    }

    private function _loadController(){
        $path = $this->_loadControllerPath . $this->_url[0] . '.php';
        if(file_exists($path)){
            require $path;
            $this->_initiateController = new $this->_url[0]();
            $this->_initiateController->_loadDefaultModel($this->_url[0], $this->_loadDefaultModelPath);
        }else{
            $this->_loadError(); exit;
        }
    }

    private function _loadControllerMethod(){
        if(count($this->_url) > 1){
            if (!method_exists($this->_initiateController, $this->_url[1])) {
                $this->_loadError(); exit;
            }
        }
        switch (count($this->_url)) {
            case 5:
                $this->_initiateController->{$this->_url[1]}($this->_url[2], $this->_url[3], $this->_url[4]);
                break;
            case 4:
                $this->_initiateController->{$this->_url[1]}($this->_url[2], $this->_url[3]);
                break;
            case 3:
                $this->_initiateController->{$this->_url[1]}($this->_url[2]);
                break;
            case 2:
                $this->_initiateController->{$this->_url[1]}();
                break;
            default:
                $this->_initiateController->index();
                break;
        }
    }

    private function _loadError(){
        require $this->_loadControllerPath . 'error.php';
        $this->_initiateController = new Errors();
        $this->_initiateController->_loadDefaultModel('error', $this->_loadDefaultModelPath);
        $this->_initiateController->index();
    }

}
