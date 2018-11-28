<?php
class Controller {

    function __construct() {
        $this->output = new Output();
    }
    
    public function _loadDefaultModel($_page,$_pageDefaultModelPath = 'models/'){
        $_modelPath = $_pageDefaultModelPath . $_page . '/index.php';
        $_defaultModelPath = $_pageDefaultModelPath . '/index.php';
        if(file_exists($_modelPath)){
            require $_modelPath;
            $this->model = new $_page . 'Model'();
        }elseif(file_exists($_defaultModelPath)){
            require $_defaultModelPath;
            $this->model = new IndexModel();
        }
    }

}