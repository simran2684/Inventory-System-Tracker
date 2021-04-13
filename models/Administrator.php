<?php
    class Administrator{
        private $connect;
        private $table = 'administrator';

        //administrator properties
        public $name;
        public $adminSSN;
        public $ID;
        public $storeLocation;
        
        //DB constructor
        public function _constructor($db) {
            $this -> connect = $db;
        }

        //Get Admin
        public function read(){
            //Create query
            $query = 'Select
                a.name,
                a.adminSSN,
                a.ID,
                a.storeLocation
               
                
            FROM
                ' . $this->table . ' a';

            //preparing statement
            $stmt = $this->connect->prepare($query);

            //Execute the query
            $stmt->execute();

            return $stmt; 
        }

    }
