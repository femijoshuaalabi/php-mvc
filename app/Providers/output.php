<?php
class Output {

    function __construct() {
        
    }
    
    public function page($_page,$_pageDefaultOutputPath = 'views/'){
        $_outputPath = $_pageDefaultOutputPath . $_page . '.php';
        if(file_exists($_outputPath)){
            require $_outputPath;
        }
    }

}

