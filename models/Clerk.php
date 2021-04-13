<?php
    class Clerk{
        private $connect;
        private $table = 'clerk';

        //clerk properties
        public $mgrSSN;
        public $ID;
        public $yearsEmployed;
        public $hourlyWage;
        
        //DB constructor
        public function _constructor($db) {
            $this -> connect = $db;
        }

        //Get Clerk
        public function read(){
            //Create query
            $query = 'Select
                k.mgrSSN,
                k.ID,
                k.yearsEmployed,
                k.hourlyWage
                
            FROM
                ' . $this->table . ' k';

            //preparing statement
            $stmt = $this->connect->prepare($query);

            //Execute the query
            $stmt->execute();

            return $stmt; 
        }

    }
