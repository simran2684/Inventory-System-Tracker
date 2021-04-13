<?php
    class Manager{
        private $connect;
        private $table = 'manager';

        //manager properties
        public $mgrSSN;
        public $ID;
        public $storeLocation;
           
        
        //DB constructor
        public function _constructor($db) {
            $this -> connect = $db;
        }

        //Get Manager
        public function read(){
            //Create query
            $query = 'Select
                m.mgrSSN,
                m.storeLocation
                
            FROM
                ' . $this->table . ' m';

            //preparing statement
            $stmt = $this->connect->prepare($query);

            //Execute the query
            $stmt->execute();

            return $stmt; 
        }

    }
