<?php
class Controller {

    function __construct() {
        $this->output = new Output();
    }
    
    public function _loadDefaultModel($_page,$_pageDefaultModelPath = 'models/'){
        $_defaultModelPath = $_pageDefaultModelPath . $_page. '.php';
        if(file_exists($_defaultModelPath)){
            require $_defaultModelPath;
            $model = $_page . 'Model';
            $this->model = new $model();
        }
    }

}