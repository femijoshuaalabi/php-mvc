<?php

class App {
    
    private $_loadControllerPath = 'controllers/';
    private $_loadDefaultPagePath = 'index.php';
    private $_loadDefaultModelPath = 'models/';
    private $_initiateController = null;
    
    public $_url;
    
    function load() {
        $http = new Http();
        $this->_url = $http->url();
        if (empty($this->_url[0]) || $this->_url[0] == 'index') {
            $this->_loadDefaultPage();
            return false;
        }
    }
    
    private function _loadDefaultPage(){
        require $this->_loadControllerPath . $this->_loadDefaultPagePath;
        $this->_initiateController = new IndexController();
        $this->_initiateController->index();
        $this->_initiateController->_loadDefaultModel('index', $this->_loadDefaultModelPath);
    }

}
