<?php
    class Dependents{
        private $connect;
        private $table = 'dependents';

        //Post properties
        public $employeeId;
        public $name;
        public $phoneNumber;

        //DB constructor
        public function __construct($db) {
            $this -> connect = $db;
        }

        //Get Dependents
        public function read(){
            //Create query
            $query = 'Select
                d.employeeId,
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

        // Delete an employee
        public function deleteDependent() {
            // Create Query
            $query = 'DELETE FROM ' . $this->table . ' WHERE employeeId = :employeeId';

            // Prepare statement
            $stmt = $this->connect->prepare($query);

            // "Clean" data
            $this->employeeId = htmlspecialchars(strip_tags($this->employeeId));

            // Bind data
            $stmt->bindParam(':employeeId', $this->employeeId);

            // Execute Query
            if($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }

    }
