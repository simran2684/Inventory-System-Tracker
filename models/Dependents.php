<?php
    class Dependents{
        private $connect;
        private $table = 'dependents';

        //Post properties
        public $employeeid;
        public $name;
        public $phoneNum;

        //DB constructor
        public function _constructor($db) {
            $this -> connect = $db;
        }

        //Get Dependents
        public function read(){
            //Create query
            $query = 'Select
                d.employeeid,
                d.name,
                d.phoneNum
            FROM
                ' . $this->table . ' d';

            //preparing statement
            $stmt = $this->connect->prepare($query);

            //Execute the query
            $stmt->execute();

            return $stmt; 
        }

    }
