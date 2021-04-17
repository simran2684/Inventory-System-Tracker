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
        public function getDependents(){
            //Create query
            $query = 'SELECT
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

         // Get a single dependent
         public function getSingleDependents() {
            $query = 'SELECT
                d.employeeId,
                d.name,
                d.phoneNumber
               
            FROM
                ' . $this->table . ' d
            WHERE
                d.employeeId = ?
            LIMIT 0,1';

            // Prepare statement
            $stmt = $this->connect->prepare($query);

            // Bind id
            $stmt->bindParam(1, $this->employeeId);

            // Execute Query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Set properties
            $this->name = $row['name'];
            $this->phoneNumber = $row['phoneNumber'];
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
        
         public function updateDependents() {
            $query = 'UPDATE ' . $this->table . '
                SET
                    name = :name,
                    phoneNumber = :phoneNumber
                   
                WHERE
                    employeeId = :employeeId';

            // Prepare statement
            $stmt = $this->connect->prepare($query);

            // "Clean Data
            $this->employeeId = htmlspecialchars(strip_tags($this->employeeId));
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->phoneNumber = htmlspecialchars(strip_tags($this->phoneNumber));
         

            // Bind data
            $stmt->bindParam(':employeeId', $this->employeeId);
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':phoneNumber', $this->phoneNumber);
          
            //Execute query
            if($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }

    }
