<?php
    class Dependents{
        private $connect;
        private $table = 'dependents';

        //Post properties
        public $employeeid;
        public $name;
        public $phoneNumber;

        //DB constructor
        public function __construct($db) {
            $this -> connect = $db;
        }

        //Get Dependents
        public function getDependents(){
            //Create query
            $query = 'SELECT
                d.employeeid,
                d.name,
                d.phoneNumber
            FROM
                ' . $this->table . ' d';

            //preparing statement
            $stmt = $this->connect->prepare($query);

            //Execute the query
            $stmt->execute();

            return $stmt; 
        }

         // Get a single employee
         public function getSingleDependents() {
            $query = 'SELECT
                d.employeeid,
                d.name,
                d.phoneNumber
               
            FROM
                ' . $this->table . ' d
            WHERE
                d.employeeid = ?
            LIMIT 0,1';

            // Prepare statement
            $stmt = $this->connect->prepare($query);

            // Bind id
            $stmt->bindParam(1, $this->employeeid);

            // Execute Query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Set properties
            $this->name = $row['name'];
            $this->phoneNumber = $row['phoneNumber'];
        }


    }
