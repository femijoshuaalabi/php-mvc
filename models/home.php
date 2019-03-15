<?php
class HomeModel extends Model {

    function __construct() {
        parent::__construct();
    }

    private function Query(){
        /** 
         * Query Table Row
         * Example:
         * $this->fetchDB("SQL");
         */
        $this->fetchDB("");
    }


    private function Insert(){
        /** 
         * Insert Table Row
         *  Call the insert rows Method
         *  Example:
         *  $this->InsertDB("ng_pages", [
         *    'page_name' => 'This is the Updated value'
         *  ]);
         */
        $this->InsertDB("",[]);
    }


    private function Update(){

        /** 
         * Update Table Row
         *  Call the update rows Method
         *  Example:
         *  $this->updateDB("ng_pages", [
         *    'page_name' => 'This is the Updated value'
         *  ], "page_id = '2'");
         */
        $this->updateDB("",[]);
    }

    private function Delect(){

        /** 
         * Delete Table Row
         *  Call the delete rows Method
         *  Example:
         *  $this->deleteDB("ng_pages",['page_id' => ["7","8"]]);
         */
        $this->deleteDB("",[]);
    }

}

