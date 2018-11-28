<?php
class IndexController extends Controller {

    function __construct() {
        parent::__construct();
    }
    
    public function index(){
        //$this->output->variable = 'Test';
        $this->output->page('index/index');
    }

}
