<?php
    Class Employee {

        private $connect;
        private $table = 'employees';

        //Employee Properties/Attributes
        public $employeeid;
        public $name;
        public $country;
        public $city;
        public $postalCode;
        public $streetName;
        public $storeNum;

        //Constructor with DB
        public function __construct($db) {
            $this->connect = $db;
        }

        // Get Employee
        public function readEmployee() {
            // Create query
            $query = 'SELECT 
                e.employeeId,
                e.name,
                e.country,
                e.city,
                e.postalCode,
                e.streetName,
                e.storeNum
            FROM
                ' . $this->table . ' e';

            //Prepare statement
            $stmt = $this->connect->prepare($query);

            // Execute Query
            $stmt->execute();

            return $stmt;
        }


        // Get a single employee
        public function getSingleEmployee() {
            $query = 'SELECT
                e.employeeId,
                e.name,
                e.country,
                e.city,
                e.postalCode,
                e.streetName,
                e.storeNum
            FROM
                ' . $this->table . ' e
            WHERE
                e.employeeId = ?
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
            $this->country = $row['country'];
            $this->city = $row['city'];
            $this->postalCode = $row['postalCode'];
            $this->streetName = $row['streetName'];
            $this->storeNum = $row['storeNum'];
        }


        // Create Employee
        public function createEmployee() {
            //Create query
            $query = 'INSERT INTO ' . $this->table . ' 
                SET
                    employeeId = :employeeId,
                    name = :name,
                    country = :country,
                    city = :city,
                    postalCode = :postalCode,
                    streetName = :streetName,
                    storeNum = :storeNum';
                    
            // Prepare Statment
            $stmt = $this->connect->prepare($query);

            //"Clean data"
            $this->employeeId = htmlspecialchars(strip_tags($this->employeeId));
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->country = htmlspecialchars(strip_tags($this->country));
            $this->city = htmlspecialchars(strip_tags($this->city));
            $this->postalCode = htmlspecialchars(strip_tags($this->postalCode));
            $this->streetName = htmlspecialchars(strip_tags($this->streetName));
            $this->storeNum = htmlspecialchars(strip_tags($this->storeNum));


            // Bind data
            $stmt->bindParam(':employeeId', $this->employeeId);
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':country', $this->country);
            $stmt->bindParam(':city', $this->city);
            $stmt->bindParam(':postalCode', $this->postalCode);
            $stmt->bindParam(':streetName', $this->streetName);
            $stmt->bindParam(':storeNum', $this->storeNum);

            //Execute query
            if($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }


        public function updateEmployee() {
            $query = 'UPDATE ' . $this->table . '
                SET
                    name = :name,
                    country = :country,
                    city = :city,
                    postalCode = :postalCode,
                    streetName = :streetName,
                    storeNum = :storeNum
                WHERE
                    employeeId = :employeeId';

            // Prepare statement
            $stmt = $this->connect->prepare($query);

            // "Clean Data
            $this->employeeId = htmlspecialchars(strip_tags($this->employeeId));
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->country = htmlspecialchars(strip_tags($this->country));
            $this->city = htmlspecialchars(strip_tags($this->city));
            $this->postalCode = htmlspecialchars(strip_tags($this->postalCode));
            $this->streetName = htmlspecialchars(strip_tags($this->streetName));
            $this->storeNum = htmlspecialchars(strip_tags($this->storeNum));

            // Bind data
            $stmt->bindParam(':employeeId', $this->employeeId);
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':country', $this->country);
            $stmt->bindParam(':city', $this->city);
            $stmt->bindParam(':postalCode', $this->postalCode);
            $stmt->bindParam(':streetName', $this->streetName);
            $stmt->bindParam(':storeNum', $this->storeNum);

            //Execute query
            if($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }


        // Delete an employee
        public function deleteEmployee() {
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