<?php
    class Post{
        private $connect;
        private $table = 'Dependents';

        //Post properties
        public $employeeid;
        public $name;
        public $phone_number;

        //DB constructor
        public function _constructor($db) {
            $this -> connect = $db;
        }

        //Get Dependents
        public function readDependents(){
            //Create query
            $query = 'Select
                d.employeeid,
                d.name,
                d.phone_number
            FROM
                ' .$this->table . ' d ';

            //preparing statement
            $stmt = $this->connect->prepare($query);

            //Execute the query
            $stmt->execute();

            return $stmt; 
        }

    }
