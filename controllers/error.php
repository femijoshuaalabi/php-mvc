<?php
class Errors extends Controller {

    function __construct() {
        parent::__construct();
    }
    
    public function index(){
        $this->output->page('error/index');
    }

}
